<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Payment;
use App\Models\Delivery;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        return view('payment.order_delivery');
    }
    public function delivery(Request $request)
    {
        $delivery = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required'
        ]);
        session(['delivery' => $delivery]);

        return redirect()->route('payment.confirmOrder');
    }

    public function confirmOrder(Request $request){
        $cart = session('cart',[]);
        $quantity = session('quantity',[]);
        $delivery= session('delivery',[]);
        $products = [];
        $totalItems = 0;
        $totalPrice=0;
        $customer = Auth::guard('customer')->user();

        foreach ($cart as $id) {
            $product = Product::find($id);
            if ($product) {
                $products[] = $product;
                $totalItems += $quantity[$id] ?? 0;
                $totalPrice+=$quantity[$id]*$product['price'];
            }
        }

        $order = Order::create([
            'customer_id' => $customer->customer_id,
            'total_price' => $totalPrice,
            'status' => 0,
        ]);
        $order = Order::latest('order_date')->first();
        if (!$order) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Lỗi tạo đơn hàng']);
        }
        foreach ($cart as $id) {
            $product = Product::find($id);
            if ($product) {
                OrderDetail::create([
                    'order_id' => $order->order_id,
                    'product_id' => $product->product_id,
                    'quantity' => $quantity[$id],
                    'price' => $quantity[$id]*$product['price']
                ]);   
                
                Product::update(['stock_quantity'=>$product->stock_quantity-1]);
            }
        }
        Delivery::create([
            'order_id' => $order->order_id,
            'name' => $delivery['name'],
            'phone' => $delivery['phone'],
            'address' => $delivery['address']
        ]);
        

        $order->load('payment');
        return redirect()->route('payment.review',['order_id'=>$order->order_id]);
    }


    public function review(Request $request){
        $order = Order::with('payment')->findOrFail($request->get('order_id'));

        if (!$order) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Không tìm thấy đơn hàng']);
        }
    
        $order->load('order_details.product');
    
        return view('payment.order_review', compact('order'));
    }    


    public function confirmPayment(Request $request)
    {
        $data = $request->validate([
            'order_id'=>'required',
            'payment_method' => 'required' // 0: COD, 1: chuyển khoản
        ]);

        $method=$data['payment_method'];
        
        $order = Order::with('payment')->findOrFail($request->post('order_id'));
        
        if (!$order) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Không tìm thấy mã đơn hàng']);
        }
    
        return $this->payTransfer($order->order_id, $method);
        
    }

    public function payTransfer(string $order_id, int $method)
    {
        $order = Order::findOrFail($order_id);
        $payment = Payment::where('order_id', $order_id)->first();
    
        if ($payment) {
            $payment->update([
                'payment_method' => $method,
                'payment_status'=>0
            ]);
        } else {
            Payment::create([
                'order_id' => $order_id,
                'payment_method' => $method,
                'payment_status'=>0
            ]);
        }
    
        $bankInfo = (object)[
            'bank_name' => 'mbbank',
            'account_number' => '0587558698',
            'account_name' => 'Phạm Thị Bảo Châu'
        ];
    
        if ($method === 0) {
            $order->update(['status' => 1]);
            return redirect()->route('history.index');
        }
    
        return view('payment.order_pay', compact('order', 'bankInfo'));
    }
    
    public function cancel(Request $request)
    {
        $order = Order::findOrFail($request->post('order_id'));
        $order->update(['status' => -1]);
    
        return redirect()->route('history.index')->with('success', 'Đơn hàng đã được huỷ thành công.');
    }
    

    public function orderTransfer(string $content)
    {
        try {
            $orderId = str_replace('classico', '', $content);

            if (!is_numeric($orderId)) {
                return response()->json(['error' => 'Mã đơn hàng không hợp lệ'], 400);
            }
            $this->getHistoryTransfer('classico');
            $paid = Payment::where('order_id', $orderId)->value('payment_status');

            return response()->json(['paid' =>(bool) $paid]);
        } catch (\Throwable $e) {
            \Log::error("Lỗi kiểm tra thanh toán: " . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    
    public function getHistoryTransfer(string $content)
    {
        $bank = "mbbank";
        $api_token = "23fdd1ed6c153ed5fab6e8e8c480dc76";
        $description ="";
        if ($bank === 'mbbank') {
            $response = $this->getMbbankHistory($api_token);
            if (!$response) return 0;
        
            $result = json_decode($response, true);
            if (json_last_error() !== JSON_ERROR_NONE) return 0;
        
            if (!isset($result['TranList']) || !is_array($result['TranList'])) return 0;
        
            foreach ($result['TranList'] as $item) {
                $description = $item['description'] ?? '';
                $amount=(float)$item['creditAmount'];
                $keyword = $content;
                $pos = strpos($description, $keyword);

                if ($pos !== false) {
                    $start = $pos + strlen($keyword);

                    // Lấy 10 ký tự sau từ "classico"
                    $orderId = substr($description, $start, 10);

                    if ($orderId) {
                        $order= Order::where('order_id', $orderId)->first();
                        $payment = Payment::where('order_id', $orderId)->first();
                        if ($payment && $payment->payment_status != 1 && $amount===$order->total_price) {
                            $payment->update(['payment_status' => 1]);
                            $order->update(['status' => 1]);
                        }
                    }
                }
            }
        
        }
    }

    

    private function getMbbankHistory(string $api_token): ?string
    {
        $url = 'https://app.apingon.com/historyapimbbank/' . $api_token;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $this->error('Curl error: ' . curl_error($ch));
            curl_close($ch);
            return null;
        }

        curl_close($ch);
        return $response;
    }
}
