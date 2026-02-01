<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Middleware\CheckTimeAccess;
use Illuminate\Routing\Controllers\HasMiddleware;
use App\Models\Product;

class ProductController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [CheckTimeAccess::class];
    }

    public function index()
    {
        $title = "Product List";
        $products = Product::all();
        return view('product.index', ['title' => $title, 'products' => $products]);
    }

    public function getdetail(string $id = '123')
    {
        return view('product.detail', ['id' => $id]);
    }

    public function create()
    {
        return view('product.add');
    }

    public function store(Request $request)
    {
        $product = new Product;
        $product->name = $request->input('product_name');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');
        $product->save();
        return redirect('/product');
    }

    public function editView($id)
    {
        $product = Product::find($id);
        return view('product.edit', ['product'=>$product]);
    }
    
    public function edit(Request $request, string $id)
    {
        $product = Product::find($id);
        $product->name = $request->input('product_name');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');
        $product->save();
        return redirect('/product');
    }
}
