@extends('layout.admin')
@section('content')
    <h1>Add New Category</h1>
    <div class="row">
        <div class="col-md-6">
            <form method="POST" action="/category/store">
                @csrf
                <div>
                    <label for="name">Category Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div>
                    <label for="description">Description:</label>
                    <input type="text" class="form-control" id="description" name="description">
                </div>
                <div>
                    <label for="image">Image:</label>
                    <input type="text" class="form-control" id="image" name="image">
                </div>
                <div>
                    <label for="parent_id">Parent Category:</label>
                    <select id="parent_id" name="parent_id" class="form-control">
                        <option value="">None</option>
                        @foreach ($parents as $parent)
                            <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="is_active">
                        <input type="checkbox" id="is_active" name="is_active" value="1" checked>
                        Active
                    </label>
                </div>
                <div>
                    <button type="submit">Add Category</button>
                </div>
            </form>
        </div>
    </div>
@endsection
