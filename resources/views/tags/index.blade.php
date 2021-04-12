@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('tags.create') }}" class="btn btn-success">Add Tag</a>
    </div>

    <div class="card card-default">
        <div class="card-header">Tags</div>

        <div class="card-body">
            @if($tags->count() > 0)
                <table class="table">
                    <thead class="thead-dark">
                    <th>Name</th>
                    <th>Posts Count</th>
                    <th>Action</th>
                    </thead>

                    <tbody>
                    @foreach($tags as $tag)
                        <tr>
                            <td> {{ $tag->name }} </td>

                            <td> {{ $tag->posts->count() }} </td>

                            <td>
                                <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-info btn-sm">Edit</a>
                                <button class="btn btn-danger btn-sm" onclick="event.preventDefault();
                                    if(confirm('Are you really want to delete?')){
                                    document.getElementById('form-delete-{{$tag->id}}')
                                    .submit()}">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <form id="{{'form-delete-'.$tag->id}}" action="{{ route('tags.destroy', $tag->id) }}" method="post" style="display: none;">
                    @csrf
                    @method('delete')
                </form>
            @else
                <h3 class="text-center">No tags yet. </h3>
            @endif
        </div>
    </div>

    <div class="d-flex justify-content-center mb-5">
        {{ $tags->links() }}
    </div>
@endsection


