@extends('template.index')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Tambah Data User</div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
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
                        <form action="{{ route('adm.updateuser') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Nama</label>
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                <input type="text" name="name" class="form-control" value="{{ $user->name }}" placeholder="Input Nama Lengkap">
                                @if ($errors->has('name'))<small class="text-danger" role="alert">{{ $errors->first('name') }}</small>@endif
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Username</label>
                                <input type="text" name="username" class="form-control" value="{{ $user->username }}" placeholder="Input Username">
                                @if ($errors->has('username'))<small class="text-danger" role="alert">{{ $errors->first('username') }}</small>@endif
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" value="" placeholder="Input Password">
                                @if ($errors->has('password'))<small class="text-danger" role="alert">{{ $errors->first('password') }}</small>@endif
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control" value="" placeholder="Confirm Password">
                                @if ($errors->has('password_confirmation'))<small class="text-danger" role="alert">{{ $errors->first('password_confirmation') }}</small>@endif
                            </div>
                            <div class="mb-3">
                                <label for="defaultSelect">Role</label>
                                <select class="form-control form-control" name="role_id" id="defaultSelect">
                                    <option value="0" {{ $user->role_id == 0 ? 'selected' : '' }}>User</option>
                                    <option value="1" {{ $user->role_id == 1 ? 'selected' : '' }}>Admin</option>
                                </select>
                                @if ($errors->has('role_id'))<small class="text-danger" role="alert">{{ $errors->first('email') }}</small>@endif
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-success" type="submit">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
