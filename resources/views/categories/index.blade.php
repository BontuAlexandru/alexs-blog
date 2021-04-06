@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('categories.create') }}" class="btn btn-success">Add Category</a>
    </div>

    <div class="card card-default">
        <div class="card-header">Categories</div>
        <div class="card-body">
            @if($categories->count() > 0)
                <table class="table">
                    <thead class="thead-dark">
                    <th>Name</th>
                    <th>Posts Count</th>
                    <th>Action</th>
                    </thead>

                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td> {{ $category->name }} </td>

                            <td> {{ $category->posts->count() }} </td>

                            <td>
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-info btn-sm">Edit</a>
                                <button class="btn btn-danger btn-sm" onclick="event.preventDefault();
                                    if(confirm('Are you really want to delete?')){
                                    document.getElementById('form-delete-{{$category->id}}')
                                    .submit()}">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <form id="{{'form-delete-'.$category->id}}" action="{{ route('categories.destroy', $category->id) }}" method="post" style="display: none;">
                    @csrf
                    @method('delete')
                </form>
            @else
                <h3 class="text-center">No categories yet. </h3>
            @endif
        </div>
    </div>

@endsection
