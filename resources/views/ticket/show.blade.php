@extends('template.index')

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/chatbox.css') }}">
    <div class="row">
        <div class="col-8">

            <div class="card">
                <div class="card-header">
                    <h3>Ticket </h3>
                </div>
                <div class="card-body">
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
                    @if (!empty($ticket->image))
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Lampiran</label>
                            <div class="col-sm-10">
                                @foreach (json_decode($ticket->image) as $image)
                                    <a href="{{ url('img/photo/' . $image) }}"><img
                                            src="{{ url('img/photo/' . $image) }}" width="150px"
                                            alt="{{ $image }}"></a>
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
                        <div class="col-lg">
                            @if ($ticket->status == 0)
                                <span class="badge badge-warning mr-3">Belum Diatasi </span>
                            @elseif($ticket->status==1)
                                <span class="badge badge-success">Teratasi</span>
                            @else
                                <span class="badge badge-danger">Tidak Dapat Diatasi</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            @if(Auth::user()->role_id ==0 && $ticket->status==0)
                                <button class="btn btn-danger">Batalkan Ticket</button>
                            @elseif(Auth::user()->role_id==1 && $ticket->status==0)
                            <a href="{{ route('usr.ticketsolved', $ticket->id) }}"
                                onclick="return confirm('Apakah anda yakin ?');"
                                class="btn btn-success mr-3">Ubah Status</a>
                            @endif
                            <a href="{{ route('usr.ticket') }}" class="btn btn-success">Kembali</a>
                        </div>

                    </div>
                    </form>

                </div>
            </div>
        </div>

        {{-- Message --}}
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <h3>Pesan </h3>
                </div>
                <div class="card-body">
                    <div class="chat-box">
                        @foreach ($pesan as $p)
                            <div class="mb-3 row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">{{ $p->nama }}</label>
                                <div class="col-sm-10">
                                    <span class="form-control">{{ $p->pesan }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="send-message">
                        <form action="{{ route('usr.kirimpesan') }}" method="post">
                        @csrf
                        <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                        <input type="hidden" name="nama" value="{{ Auth::user()->name }}">
                        <textarea class="form-control" name="pesan" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                        <button class="btn btn-success">Kirim</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
