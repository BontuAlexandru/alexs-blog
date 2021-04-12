@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('posts.create') }}" class="btn btn-success">Add Posts</a>
    </div>

    <div class="card card-default">
        <div class="card-header">Posts</div>

        <div class="card-body">

            @if($posts->count() > 0 )
                <table class="table">
                    <thead class="thead-dark">
                        <th>Image</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Author</th>
                        <th>Action</th>
                        <th></th>
                    </thead>

                    <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>
                                <img src="{{ asset($post->image_path) }}" alt="No Image" width="120px" height="100px">
                            </td>

                            <td> {{ $post->title }} </td>

                            <td>
                                <a href="{{ route('categories.edit', $post->category->id) }}">
                                    {{ $post->category->name }}
                                </a>
                            </td>

                            <td> {{ $post->user->name }}</td>

                            <td class="d-flex">
                            @if( ! $post->trashed())
                                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-info btn-sm mr-2">Edit</a>
                            @else
                                    <form action="{{ route('restore-posts', $post->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-info btn-sm mr-2">Restore</button>
                                    </form>
                            @endif
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        {{ $post->trashed() ? 'Delete': 'Trash' }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <h3 class="text-center">No posts yet.</h3>
            @endif
        </div>
    </div>

    <div class="d-flex justify-content-center mb-5">
        {{ $posts->links() }}
    </div>
@endsection

