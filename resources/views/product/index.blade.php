<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>product list</title>
</head>
<body>
    <h1>Product List</h1>
    <p><a href="{{ route('product.add') }}">Thêm mới sản phẩm</a></p>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
        <tr>
            <td>1</td>
            <td>Sample Product 1</td> 
            <td>1000đ</td>
            <td>
                <a href="{{ route('product.detail', ['id' => 1]) }}">Detail</a>
            </td>
        </tr>
        <tr>
            <td>2</td>
            <td>Sample Product 2</td> 
            <td>2000đ</td>
            <td>
                <a href="{{ route('product.detail', ['id' => 2]) }}">Detail</a>
            </td>
        </tr>
    </table>
</body>
</html>