@extends('layout.admin')
@section('content')
    <button style="margin: 10px">
        <a href="{{ route('category.add') }}">Add new category</a>
    </button>
    <table id="categoryTable" class="table table-bordered table-hover">
        <tr>
            <td>id</td>
            <td>name</td>
            <td>parent</td>
            <td>active</td>
            <td>action</td>
        </tr>
        @foreach ($categories as $category)
            <tr>
                <td>{{ $category['id'] }}</td>
                <td>{{ $category['name'] }}</td>
                <td>{{ optional($categories->firstWhere('id', $category['parent_id']))->name ?? '-' }}</td>
                <td>{{ $category['is_active'] ? 'Yes' : 'No' }}</td>
                <td>
                    <a href="{{ route('category.edit', ['id' => $category['id']]) }}"
                        class="btn btn-sm btn-warning">
                        Edit
                    </a>
                    <form action="{{ route('category.destroy', ['id' => $category['id']]) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this category?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
