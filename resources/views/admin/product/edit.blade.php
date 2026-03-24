@extends('layout.admin')
@section('content')
    <div class="container-fluid pt-3">
        <h3>{{ $title ?? 'Edit product' }}</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('product.update', $product) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" class="form-control">
                    <option value="">-- Select category --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            @selected(old('category_id', $product->category_id) == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control"
                    value="{{ old('name', $product->name) }}" required>
            </div>

            <div class="form-group">
                <label for="sku">SKU</label>
                <input type="text" id="sku" name="sku" class="form-control"
                    value="{{ old('sku', $product->sku) }}">
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" step="0.01" min="0" id="price" name="price" class="form-control"
                    value="{{ old('price', $product->price) }}" required>
            </div>

            <div class="form-group">
                <label for="sale_price">Sale price</label>
                <input type="number" step="0.01" min="0" id="sale_price" name="sale_price" class="form-control"
                    value="{{ old('sale_price', $product->sale_price) }}">
            </div>

            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" min="0" id="stock" name="stock" class="form-control"
                    value="{{ old('stock', $product->stock) }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control" rows="3">{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="image">Image path</label>
                <input type="text" id="image" name="image" class="form-control"
                    value="{{ old('image', $product->image) }}">
            </div>

            <div class="form-group form-check">
                <input type="checkbox" id="is_active" name="is_active" class="form-check-input" value="1"
                    @checked(old('is_active', $product->is_active))>
                <label class="form-check-label" for="is_active">Active</label>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('product.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
@endsection
