<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>product list</title>
</head>
<body>
    <h1>{{ $title }}</h1>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <td>id</td>
            <td>name</td>
            <td>price</td>
        </tr>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product['id'] }}</td>
                <td>{{ $product['name'] }}</td>
                <td>{{ $product['price'] }}</td>
            </tr>
        @endforeach
    </table>
    <button style="margin: 10px">
        <a href="{{ route('product.add') }}">Add new product</a>
    </button>
</body>
</html>