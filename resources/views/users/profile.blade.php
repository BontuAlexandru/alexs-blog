@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card-header justify-content-center">
            <h2> {{$user->name}}'s Profile</h2>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-12 col-md-offset-1 mt-4">
                    <div class="mr-3">
                        <img src="{{ asset('/storage/images/users/'.$user->avatar) }}" style="width: 250px; height: 250px; float: left; border-radius: 50%; margin-right: 150px;" alt="NoAvatar">
                    </div>

                    <div>
                        <h1> {{$user->name}} </h1>
                    </div>

                    <div>
                        <h5>{{$user->email}} - {{ ucfirst($user->role) }}</h5>
                    </div>

                    <div class="mb-5">
                        <div> {{ $user->about }} </div>
                    </div>

                    <form enctype="multipart/form-data" action="{{ route('user.upload') }}" method="POST">
                        @csrf
                        <div>
                            <h3><b>Default avatar. Or upload your own...</b></h3>
                        </div>

                        <input type="file" name="image">
                        <button type="submit" class="btn btn-primary">Submit</button>

                        <div class="card-header mb-5" style="margin-top: 5rem">
                            <h2> Account </h2>
                        </div>

                        <div class="form-group row">
                            <label for="title" class="col-sm-2 col-form-label">{{ __('Title') }}</label>
                            <div class="col-sm-10">
                                <input id="title" type="text" class="form-control" name="title" value="{{ ucfirst($user->role) }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">{{ __('Username') }}</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">{{ __('E-Mail Address') }}</label>
                            <div class="col-sm-10">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-sm-2 col-form-label">{{ __('Password') }}</label>
                            <div class="col-sm-10">
                                <input id="password" type="password" class="form-control" name="password" value="{{ $user->password }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="about" class="col-sm-2 col-form-label">{{ __('About me') }}</label>
                            <div class="col-sm-10">
                                <input id="about" type="text" class="form-control" name="about" value="{{ $user->about }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="registered" class="col-sm-2 col-form-label">{{ __('Join Date') }}</label>
                            <div class="col-sm-10">
                                <input id="registered" type="text" class="form-control" name="registered" value="{{ date('d-m-Y', strtotime($user->created_at)) }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection






