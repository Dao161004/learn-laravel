<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Middleware\CheckTimeAccess;
use Illuminate\Routing\Controllers\HasMiddleware;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [CheckTimeAccess::class];
    }

    public function index()
    {
        $title = 'Product list';
        $keyword = request('keyword');
        $categoryId = request('category_id');

        $products = Product::with('category')
            ->where('is_delete', 0)
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->when($categoryId, function ($query) use ($categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->orderByDesc('id')
            ->get();

        $categories = Category::where('is_delete', 0)->orderBy('name')->get();

        return view('admin.product.index', [
            'title' => $title,
            'products' => $products,
            'categories' => $categories,
            'keyword' => $keyword,
            'categoryId' => $categoryId,
        ]);
    }

    public function create()
    {
        $title = 'Create product';
        $categories = Category::where('is_delete', 0)->orderBy('name')->get();

        return view('admin.product.add', [
            'title' => $title,
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'nullable|exists:categories,id',
            'name' => 'required|string|max:255',
            'sku' => 'nullable|string|max:100',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lte:price',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|string|max:255',
        ]);

        $validated['is_active'] = $request->has('is_active') ? 1 : 0;
        $validated['is_delete'] = 0;

        Product::create($validated);

        return redirect()->route('product.index');
    }

    public function edit(Product $product)
    {
        $title = 'Edit product';
        $categories = Category::where('is_delete', 0)->orderBy('name')->get();

        return view('admin.product.edit', [
            'title' => $title,
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => 'nullable|exists:categories,id',
            'name' => 'required|string|max:255',
            'sku' => 'nullable|string|max:100',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lte:price',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|string|max:255',
        ]);

        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        $product->update($validated);

        return redirect()->route('product.index');
    }

    public function destroy(Product $product)
    {
        $product->is_delete = 1;
        $product->save();

        return redirect()->route('product.index');
    }
}
