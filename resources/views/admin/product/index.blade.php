@extends('layout.admin')
@section('content')
    <button style="margin: 10px">
        <a href="{{ route('product.add') }}">Add new product</a>
    </button>
    <table id="productTable" class="table table-bordered table-hover">
        <tr>
            <td>id</td>
            <td>name</td>
            <td>price</td>
            <td>stock</td>
            <td>action</td>
        </tr>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product['id'] }}</td>
                <td>{{ $product['name'] }}</td>
                <td>{{ $product['price'] }}</td>
                <td>{{ $product['stock'] }}</td>
                <td>
                    <a href="{{ route('product.editView', ['id' => $product['id']]) }}"
                        class="btn btn-sm btn-warning">
                        Edit
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
