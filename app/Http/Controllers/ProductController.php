<?php

namespace App\Http\Controllers;


use App\Models\Product;
use App\Models\Category;
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
            'product_name'    => 'required|string|max:255',
            'description'     => 'nullable|string',
            'price'           => 'required|numeric',
            'stock_quantity'  => 'nullable|integer',
            'category_id'     => 'nullable|integer',
            'photo'           => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'created_at'      => 'nullable|date',
        ]);

        $data = $request->only(['product_name', 'description', 'price', 'stock_quantity', 'category_id', 'created_at']);

        if (!isset($data['stock_quantity'])) {
            $data['stock_quantity'] = 0;
        }

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('products', 'public'); // Lưu trong storage/app/public/products
            $data['photo'] = $path; // Lưu vào cột photo
        }

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all(); // lấy tất cả danh mục ra
    
        return view('products.edit', compact('product', 'categories'));
    }
    
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'product_name'    => 'required|string|max:255',
            'description'     => 'nullable|string',
            'price'           => 'required|numeric',
            'stock_quantity'  => 'nullable|integer',
            'category_id'     => 'nullable|integer',
            'photo'           => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'created_at'      => 'nullable|date',
        ]);

        $data = $request->only(['product_name', 'description', 'price', 'stock_quantity', 'category_id', 'created_at']);

        if ($request->hasFile('photo')) {
            // Xóa ảnh cũ nếu có
            if ($product->photo) {
                Storage::disk('public')->delete($product->photo);
            }
            // Lưu ảnh mới
            $path = $request->file('photo')->store('products', 'public');
            $data['photo'] = $path;
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->photo) {
            Storage::disk('public')->delete($product->photo);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
 	public function index(Request $request)
    {
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
        return view('dashboard', compact('products', 'cateproducts', 'categories', 'productBy'));
    }
    public function all(Request $request)
    {
        $products = Product::all();
        return view('all_product', compact('products'));
    }
    public function detail(Request $request)
    {
        $id = $request->get('id');
        $item = Product::find($id);
        return view('detail', compact('item'));
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
    public function search(Request $request){
        $key = $request->get('key', '');
        $searchProducts=Product::where('product_name','like','%'.$key.'%')->get();
        return view('search', compact('searchProducts'));
    }

}

