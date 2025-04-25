<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('category.category', compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|integer|unique:categories,category_id',
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

    // Xoá tất cả sản phẩm thuộc danh mục này
    Product::where('category_id', $category->category_id)->delete();

    // Xoá danh mục
    $category->delete();

    return redirect()->route('categories.index')->with('success', 'Xóa danh mục thành công!');
}

}
