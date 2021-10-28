@extends('template.index')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Tambah Data Ticket</div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <form action="{{ route('usr.storeticket') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Nama</label>
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <input type="text" name="nama" class="form-control" value="<?= old('nama') ?>" placeholder="Input Nama Lengkap">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Pesan</label>
                                <textarea class="form-control" value="<?= old('pesan') ?>" name="pesan" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label style="mb-3" for="exampleFormControlFile1">Input Screenshot</label>
                                <input type="file" name="image[]" multiple="multiple" class="form-control-file mt-2" id="exampleFormControlFile1">
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
