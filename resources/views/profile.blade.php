@extends('template.index')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if ($message = Session::get('success'))
                <div id="alert" class="alert alert-success alert-block mb-3">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    {{ $message }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Account Setting</div>
                </div>
                <form action="{{ route('usr.updateprofile') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="email2">Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ $user->name }}"
                                        placeholder="Enter Name">
                                    @if ($errors->has('name'))<small class="text-danger" role="alert">{{ $errors->first('name') }}</small>@endif
                                </div>
                                <div class="form-group">
                                    <label for="email2">Username</label>
                                    <input type="text" class="form-control" name="username"
                                        value="{{ $user->username }}" placeholder="Enter Email">
                                    @if ($errors->has('username'))<small class="text-danger" role="alert">{{ $errors->first('username') }}</small>@endif
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="Password">
                                    @if ($errors->has('password'))<small class="text-danger" role="alert">{{ $errors->first('password') }}</small>@endif
                                </div>
                                <div class="form-group">
                                    <label for="password">Confirm Password</label>
                                    <input type="password" class="form-control" name="password_confirmation"
                                        placeholder="Password Confirmation">
                                    @if ($errors->has('password_confirmation'))<small class="text-danger" role="alert">{{ $errors->first('password_confirmation') }}</small>@endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-action">
                        <button type="submit" class="btn btn-success">Save</button>
                        <a href="{{ route('usr.dashboarduser') }}" class="btn btn-primary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
