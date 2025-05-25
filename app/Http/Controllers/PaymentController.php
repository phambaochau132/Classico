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

        return redirect()->route('payment.review');
    }

    public function review(){
        $cart = session('cart',[]);
        $quantity = session('quantity',[]);

        $products = [];
        $totalItems = 0;
        $totalPrice=0;

        foreach ($cart as $id) {
            $product = Product::find($id);
            if ($product) {
                $products[] = $product;
                $totalItems += $quantity[$id] ?? 0;
                $totalPrice+=$quantity[$id]*$product['price'];
            }
        }

        return view('payment.order_review', compact('products', 'quantity', 'totalPrice'));
    }


    public function confirmPayment(Request $request)
    {
        $data = $request->validate([
            'payment_method' => 'required' // 0: COD, 1: chuyển khoản
        ]);
        $method=$data['payment_method']=='cash'?0:1;
        $customerId = 1;

        $cart = session('cart',[]);
        $quantity = session('quantity',[]);

        $totalPrice=0;

        foreach ($cart as $id) {
            $product = Product::find($id);
            if ($product) {
                $totalPrice+=$quantity[$id]*$product['price'];
            }
        }

        $order = Order::create([
            'customer_id' => $customerId,
            'total_price' => $totalPrice,
            'status' => 0,
        ]);
        $latestOrder = Order::orderBy('order_id', 'desc')->first();


        if (!$order) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Lỗi tạo đơn hàng']);
        }
        return $this->payTransfer($latestOrder->order_id, $method);
    }

    public function payTransfer(string $order_id, int $method)
    {
        $order = Order::findOrFail($order_id);
        $payment = Payment::where('order_id', $order_id)->first();
    
        if ($payment) {
            $payment->update([
                'payment_method' => $method
            ]);
        } else {
            Payment::create([
                'order_id' => $order_id,
                'payment_method' => $method
            ]);
        }
    
        $bankInfo = (object)[
            'bank_name' => 'mbbank',
            'account_number' => '0587558698',
            'account_name' => 'Phạm Thị Bảo Châu'
        ];
    
        if ($method === 0) {
            return view('payment.order_delivery');
        }
    
        return view('payment.order_pay', compact('order', 'bankInfo'));
    }
    
    public function cancel(){ 
    }

    public function orderTransfer(string $content)
    {
        try {
            $orderId = str_replace('classico', '', $content);

            if (!is_numeric($orderId)) {
                return response()->json(['error' => 'Mã đơn hàng không hợp lệ'], 400);
            }

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
                $keyword = 'classico';
                $pos = strpos($description, $keyword);

                if ($pos !== false) {
                    // Tìm vị trí bắt đầu sau từ "classico"
                    $start = $pos + strlen($keyword);

                    // Cắt phần còn lại sau từ "classico"
                    $sub = substr($description, $start);

                    // Tách đến dấu "-" kế tiếp
                    $parts = explode('-', $sub);
                    $orderId = $parts[0] ?? null;

                    if ($orderId) {
                        $totalPrice= Order::find('order_id', $orderId)->value('total_price');
                        $payment = Payment::where('order_id', $orderId)->first();
                        if ($payment && $payment->payment_status != 1 && $amount===$totalPrice) {
                            $payment->update(['payment_status' => 1]);
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
