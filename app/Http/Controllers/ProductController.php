<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Middleware\CheckTimeAccess;
use Illuminate\Routing\Controllers\HasMiddleware;


class ProductController extends Controller implements HasMiddleware
{
    public static function middleware(){
        return [CheckTimeAccess::class];
    }

    public function index(){
        $title = "Product List";
        return view('product.index', ['title' => $title, 
        'products' => [
            ['id' => 1, 'name' => 'Product A', 'price' => 100],
            ['id' => 2, 'name' => 'Product B', 'price' => 200],
            ['id' => 3, 'name' => 'Product C', 'price' => 300],
        ]]);
    }

    public function getdetail(string $id = '123'){
        return view('product.detail', ['id' => $id]);
    }

    public function create(){
        return view('product.add');
    }

    public function store(Request $request){
       return $request -> all();
    }
}
