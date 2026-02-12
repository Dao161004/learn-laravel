@extends('layout.admin')
@section('content')
    <h1>Edit Category</h1>
    <div class="row">
        <div class="col-md-6">
            <form method="POST" action="/category/update/{{ $category->id }}">
                @method('PUT')
                @csrf
                <div>
                    <label for="name">Category Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}" required>
                </div>
                <div>
                    <label for="description">Description:</label>
                    <input type="text" class="form-control" id="description" name="description" value="{{ $category->description }}">
                </div>
                <div>
                    <label for="image">Image:</label>
                    <input type="text" class="form-control" id="image" name="image" value="{{ $category->image }}">
                </div>
                <div>
                    <label for="parent_id">Parent Category:</label>
                    <select class="form-control" id="parent_id" name="parent_id">
                        <option value="">None</option>
                        @foreach ($parents as $parent)
                            <option value="{{ $parent->id }}" @selected($category->parent_id == $parent->id)>
                                {{ $parent->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="is_active">
                        <input type="checkbox" id="is_active" name="is_active" value="1" @checked($category->is_active)>
                        Active
                    </label>
                </div>
                <div>
                    <button type="submit">Edit Category</button>
                </div>
            </form>
        </div>
    </div>
@endsection
