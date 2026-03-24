@extends('layout.admin')
@section('content')
    <div class="container-fluid pt-3">
        <h3>{{ $title ?? 'Product list' }}</h3>

        <form method="GET" action="{{ route('product.index') }}" class="mb-3">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="keyword" class="form-control" placeholder="Search by product name"
                        value="{{ $keyword }}">
                </div>
                <div class="col-md-4">
                    <select name="category_id" class="form-control">
                        <option value="">-- All categories --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected((string) $categoryId === (string) $category->id)>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('product.create') }}" class="btn btn-success">Add new product</a>
                </div>
            </div>
        </form>

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Sale price</th>
                    <th>Stock</th>
                    <th>Active</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->category?->name ?? '-' }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->sale_price ?? '-' }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->is_active ? 'Yes' : 'No' }}</td>
                        <td>
                            <a href="{{ route('product.edit', $product) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('product.destroy', $product) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Delete this product?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No product found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
