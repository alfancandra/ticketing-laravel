@extends('template.index')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Tambah Data Kegiatan</div>
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
                        <form action="{{ route('adm.storealfan') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Kegiatan</label>
                                <input type="text" name="kegiatan" class="form-control" value="<?= old('kegiatan') ?>" placeholder="Input kegiatan">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Tanggal</label>
                                <input type="date" style="width: 200px" name="tanggal" class="form-control" value="<?= old('tanggal') ?>" placeholder="Input Username">
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
