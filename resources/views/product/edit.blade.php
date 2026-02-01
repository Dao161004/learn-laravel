<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit product</title>
</head>
<body>
    <h1>Edit Product</h1>
    <form method="POST" action="/product/edit/{{ $product->id }}">
        @method('PUT')
        @csrf
        <div>
            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" value="{{ $product->name }}" required>
        </div>
        <div>
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" value="{{ $product->price }}" required>
        </div>
        <div>
            <label for="stock">Stock:</label>
            <input type="number" id="stock" name="stock" value="{{ $product->stock }}" required>
        </div>
        <div>
            <button type="submit">Edit Product</button>
        </div>
    </form>
    <p><a href="/product">Back to Product List</a></p>
</body>
</html>