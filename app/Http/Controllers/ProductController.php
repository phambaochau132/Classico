<?php

namespace App\Http\Controllers;


use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function allProduct()
    {
        $products = Product::all(); // Lấy tất cả sản phẩm
        return view('products.products', compact('products'));
    }

    public function create()
    {
        $categories = Category::all(); // Lấy danh sách danh mục
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    if (preg_match('/\s{2,}/', $value)) {
                        $fail('Product name không được chứa nhiều khoảng trắng liên tiếp.');
                    }
                }
            ],
            'product_description' => [
                'nullable',
                'string',
                'max:1000',
                function ($attribute, $value, $fail) {
                    if (preg_match('/\d/', $value)) {
                        $fail('Product description không được chứa số.');
                    }
                }
            ],
            'price' => [
                'required',
                'numeric',
                function ($attribute, $value, $fail) {
                    $number = explode('.', (string)$value)[0];
                    if (strlen($number) > 10) {
                        $fail('Giá sản phẩm không được vượt quá 10 chữ số.');
                    }
                }
            ],
            'stock_qua  ntity' => 'nullable|integer',
            'category_id' => 'nullable|integer',
            'product_photo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'create_at' => 'nullable|date',
            'product_view' => 'nullable|integer'
        ]);

        $data = $request->only([
            'product_name',
            'product_description',
            'price',
            'stock_quantity',
            'product_view',
            'category_id',
            'create_at'
        ]);

        if (!isset($data['stock_quantity'])) {
            $data['stock_quantity'] = 0;
        }

        if ($request->hasFile('product_photo')) {
            $file = $request->file('product_photo');
            if ($file->isValid()) {
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/products/'), $filename);
                $data['product_photo'] = $filename;
            } else {
                return back()->withErrors(['product_photo' => 'Ảnh không hợp lệ!']);
            }
        }

        Product::create($data);

        return redirect()->route('products.allProduct')->with('success', 'Product created successfully!');
    }


    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'product_name' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    if (preg_match('/\s{2,}/', $value)) {
                        $fail('Product name không được chứa nhiều khoảng trắng liên tiếp.');
                    }
                }
            ],
            'product_description' => [
                'nullable',
                'string',
                'max:1000',
                function ($attribute, $value, $fail) {
                    if (preg_match('/\d/', $value)) {
                        $fail('Product description không được chứa số.');
                    }
                }
            ],
            'price' => [
                'required',
                'numeric',
                function ($attribute, $value, $fail) {
                    $number = explode('.', (string)$value)[0];
                    if (strlen($number) > 10) {
                        $fail('Giá sản phẩm không được vượt quá 10 chữ số.');
                    }
                }
            ],
            'stock_quantity' => 'nullable|integer',
            'category_id' => 'nullable|integer',
            'product_photo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'created_at' => 'nullable|date',
            'product_view' => 'nullable|integer'
        ]);

        $data = $request->only([
            'product_name',
            'product_description',
            'price',
            'stock_quantity',
            'product_view',
            'category_id',
            'created_at'
        ]);

        // Gán mặc định nếu không có số lượng tồn
        if (!isset($data['stock_quantity'])) {
            $data['stock_quantity'] = 0;
        }

        // Xử lý ảnh nếu người dùng upload ảnh mới
        if ($request->hasFile('product_photo')) {
            $file = $request->file('product_photo');

            if ($file->isValid()) {
                $filename = time() . '.' . $file->getClientOriginalExtension();

                $file->move(public_path('images/products/'), $filename);

                // Xóa ảnh cũ nếu có
                if ($product->product_photo && file_exists(public_path('images/products/' . $product->product_photo))) {
                    unlink(public_path('images/products/' . $product->product_photo));
                }

                $data['product_photo'] = $filename;
            } else {
                return back()->withErrors(['product_photo' => 'Ảnh không hợp lệ!']);
            }
        }

        $product->update($data);

        return redirect()->route('products.allProduct')->with('success', 'Product updated successfully!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }



    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->photo) {
            Storage::disk('public')->delete($product->photo);
        }

        $product->delete();

        return redirect()->route('products.allProduct')->with('success', 'Product deleted successfully!');
    }
    public function index(Request $request)
    {
        if (Auth::guard('customer')->check()) {
            $categories = Category::all();
            $products = Product::all();
            $cateproducts = Product::all();
            $newProducts = Product::orderBy('create_at', 'desc')->limit(10)->get();
            //Lọc sản phẩm theo tiêu chí(mới nhất hoặc nổi bậtbật)
            $productBy = $newProducts;
            foreach ($categories as $cate) {
                $query = Product::where('category_id', $cate->category_id)->get();
                $cateproducts[$cate->category_id] = $query;
            }
            return view('dasboard_customer.dashboard', compact('products', 'cateproducts', 'categories', 'productBy'));
        } else {
            // chuyển hướng về trang đăng nhập hoặc báo lỗi
            return redirect()->route('customer.login')->withErrors(['auth' => 'Bạn cần đăng nhập trước.']);
        }
    }
    public function all(Request $request)
    {
        $categories = Category::all();
        $products = Product::all();
        return view('dasboard_customer.all_product', compact('products', 'categories'));
    }
    public function detail(Request $request)
    {
        $categories = Category::all();
        $id = $request->get('id');
        $item = Product::find($id);
        return view('dasboard_customer.detail', compact('item', 'categories'));
    }
    public function get_products(Request $request)
    {
        $order_by = $request->get('order_by', '');

        //Lọc sản phẩm theo tiêu chí(mới nhất hoặc nổi bật)
        $featureProducts = Product::orderBy('product_view', 'desc')->limit(10)->get();
        $newProducts = Product::orderBy('create_at', 'desc')->limit(10)->get();
        $productBy = $newProducts;
        if ($order_by == 'FEATURED PRODUCTS') {
            $productBy = $featureProducts;
        }
        return response()->json($productBy);
    }
    public function search(Request $request)
    {
        $key = $request->get('key', '');
        $categories = Category::all();
        $products = Product::where('product_name', 'like', '%' . $key . '%')->get();
        return view('dasboard_customer.all_product', compact('products', 'categories', 'key'));
    }
    public function productCategorie(Request $request)
    {
        $category = $request->get('category', '');
        $categories = Category::all();
        $products = Product::where('category_id', $category)->get();
        return view('dasboard_customer.all_product', compact('products', 'categories'));
    }

    //thong ke san pham /ndong 
    public function statistics()
{
    $products = \App\Models\Product::all(); // Lấy tất cả sản phẩm

    // Tổng sản phẩm
    $totalProducts = $products->count();

    // Tổng số lượt xem sản phẩm
    $totalViews = $products->sum('product_view');

    // Tổng số lượng tồn kho
    $totalStock = $products->sum('stock_quantity');

    // Giá trung bình
    $avgPrice = $products->avg('price');

     // Tổng giá trị kho = tổng (price * stock_quantity)
    $totalStockValue = $products->sum(function($product) {
        return $product->price * $product->stock_quantity;
    });

    return view('products.statistics', compact('products', 'totalProducts', 'totalViews', 'totalStock', 'avgPrice', 'totalStockValue'));
}
}
