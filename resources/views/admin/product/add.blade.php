@extends('layout.admin')
@section('content')
    <h1>Add New Product</h1>
    <form method="POST" action="/product/store">
        @csrf
        <div>
            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" required>
        </div>
        <div>
            <label for="price">Price:</label>
            <input type="" id="price" name="price" required>
        </div>
        <div>
            <label for="stock">Stock:</label>
            <input type="number" id="stock" name="stock" required>
        </div>
        <div>
            <button type="submit">Add Product</button>
        </div>
    </form>
@endsection
