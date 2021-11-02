@extends('template.index')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Ticket </h3>
    </div>
    <div class="card-body">
          <form action="" method="post">
          <div class="mb-3 row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
              <span class="form-control">{{ $ticket->nama }}</span>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Pesan</label>
            <div class="col-sm-10">
                <span class="form-control">{{ $ticket->pesan }}</span>
            </div>
          </div>
          @if(!empty($ticket->image))
          <div class="mb-3 row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Lampiran</label>
            <div class="col-sm-10">
                @foreach(json_decode($ticket->image) as $image)
                <a href="{{url('img/photo/'.$image)}}"><img src="{{url('img/photo/'.$image)}}" width="150px" alt="{{$image}}"></a>
                @endforeach
            </div>
          </div>
          @endif
          <div class="mb-3 row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Tanggal Dibuat</label>
            <div class="col-sm-10">
              <span class="form-control">{{ $ticket->updated_at }} WIB</span>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Update Terakhir</label>
            <div class="col-sm-10">
              <span class="form-control">{{ $ticket->updated_at }} WIB</span>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-10">
                @if($ticket->status==0)
                <span class="badge badge-warning">Belum Diatasi </span>

                <a href="{{ route('usr.ticketsolved',$ticket->id) }}" onclick="return confirm('Apakah anda yakin ?');" class="btn btn-success btn-sm ml-3">Ubah Status</a>

                @elseif($ticket->status==1)
                <span class="badge badge-success">Teratasi</span>
                @else
                <span class="badge badge-danger">Tidak Dapat Diatasi</span>
                @endif
            </div>
          </div>

          <div class="mb-3 row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Kirim Pesan ke user</label>
            <div class="col-sm-10">
                <div class="form-floating">
                  <textarea class="form-control" name="message" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>

                </div>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="staticEmail" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10">
              <button class="btn btn-success">Kirim</button>
              <a href="{{ route('usr.ticket') }}" class="btn btn-success">Kembali</a>
            </div>

          </div>
          </form>

    </div>
</div>
@endsection
