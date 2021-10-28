@extends('template.index')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Ticket </h3>
        <a href="{{ route('usr.ticket') }}" class="btn btn-success">Kembali</a>
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
          <div class="mb-3 row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Update Terakhir</label>
            <div class="col-sm-10">
              <span class="form-control">{{ $ticket->updated_at }}</span>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-10">
                @if($ticket->status==0)
                <span class="form-control text-warning">Belum Diatasi</span>
                @elseif($ticket->status==1)
                <span class="form-control text-success">Sudah Diatas</span>
                @else
                <span class="form-control text-danger">Tidak Dapat Diatasi</span>
                @endif
            </div>
          </div>

          @if(!empty($ticket->image))
          <div class="mb-3 row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Foto</label>
            <div class="col-sm-10">
                @foreach(json_decode($ticket->image) as $image)
                <a href="{{url('img/photo/'.$image)}}"><img src="{{url('img/photo/'.$image)}}" width="150px" alt="{{$image}}"></a>
                @endforeach
            </div>
          </div>
          @endif

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
            </div>
          </div>
          </form>

          <div class="mb-3 row">
            <label for="staticEmail" class="col-sm-2 col-form-label"></label>
            <a title="Edit" onclick="return confirm('Yakin untuk Solve Ticket ini?');" href="" class="btn btn-success">Solved</a>

          </div>

    </div>
</div>
@endsection
