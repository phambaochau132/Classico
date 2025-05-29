<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        // $categories = Category::all();
        $categories = Category::paginate(10); // Mỗi trang 10 dòng
        return view('category.category', compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
           
            'category_name' => 'required|string|max:100',
        ]);

        Category::create($request->all());

        return redirect()->route('categories.index')->with('success', 'Thêm danh mục thành công');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required|string|max:100',
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'category_name' => $request->category_name,
        ]);

        return redirect()->route('categories.index')->with('success', 'Cập nhật danh mục thành công');
    }

    public function destroy($id)  
{  
    $category = Category::findOrFail($id);  
    
    // Lấy tất cả sản phẩm thuộc danh mục này  
    $products = Product::where('category_id', $category->category_id)->get();  
    
    // Nếu có sản phẩm, không cho phép xóa danh mục và thông báo cho người dùng  
    if ($products->isNotEmpty()) {  
        return redirect()->route('categories.index')->with('error', 'Không thể xóa danh mục này vì còn sản phẩm liên quan!');  
    }  
    
    // Nếu không có sản phẩm, xóa danh mục  
    $category->delete();  
    
    return redirect()->route('categories.index')->with('success', 'Xóa danh mục thành công!');  
}  
}
