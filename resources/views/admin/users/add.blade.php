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
                        <form action="{{ route('adm.storeuser') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Nama</label>
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <input type="text" name="name" class="form-control" value="<?= old('name') ?>" placeholder="Input Nama Lengkap">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Username</label>
                                <input type="text" name="username" class="form-control" value="<?= old('username') ?>" placeholder="Input Username">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" value="<?= old('password') ?>" placeholder="Input Password">
                            </div>
                            <div class="mb-3">
                                <label for="defaultSelect">Role</label>
                                <select class="form-control form-control" name="role_id" id="defaultSelect">
                                    <option value="2">Executive</option>
                                    <option value="0">Admin</option>
                                    <option value="1">Super Admin</option>
                                    
                                </select>
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
