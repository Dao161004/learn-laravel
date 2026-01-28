<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add product</title>
</head>
<body>
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
            <button type="submit">Add Product</button>
        </div>
    </form>
    <p><a href="/product">Back to Product List</a></p>
</body>
</html>