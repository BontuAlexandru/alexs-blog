@extends('layouts.app')

@section('content')

    <div class="card card-default">
        <div class="card-header">Users</div>

        <div class="card-body">
            @if($users->count() > 0 )
                <table class="table">
                    <thead class="thead-dark">
                        <th scope="col">Image</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Date registered</th>
                        <th scope="col">Posts</th>
                        <th scope="col">Role</th>
                        <th scope="col">Actions</th>
                    </thead>

                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>
                                <img width="50px" height="50px" style="border-radius: 50%" src="{{ asset('/storage/images/users/'.$user->avatar) }}" alt="No avatar">
                            </td>

                            <td> {{ $user->name }} </td>

                            <td>{{ $user->email }}</td>

                            <td>{{ date('d-m-Y', strtotime($user->created_at)) }}</td>

                            <td>{{ $user->posts->count() }}</td>

                            <td>{{ ucfirst($user->role) }}</td>

                            <td class="d-flex">
                                @if( ! $user->isAdmin())
                                    <form action="{{ route('user.make-admin', $user->id) }}" method="POST" >
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm mr-2">Make admin</button>
                                    </form>
                                @endif

                                    <button class="btn btn-danger btn-sm" onclick="event.preventDefault();
                                        if(confirm('Are you really want to delete?')){
                                        document.getElementById('user-delete-{{$user->id}}')
                                        .submit()}">
                                        Delete
                                    </button>

                                    <form id="{{'user-delete-'.$user->id}}" action="{{ route('user.destroy', $user->id) }}" method="post" style="display: none;">
                                        @csrf
                                        @method('delete')
                                    </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <h3 class="text-center">No users yet.</h3>
            @endif
        </div>
    </div>
@endsection

