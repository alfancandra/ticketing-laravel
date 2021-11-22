@extends('template.index')

@section('content')
@php
if($ticket->status==0 && Auth::user()->role_id==0){
    $user = true;
}else{
    $user = false;
}
@endphp
    <link rel="stylesheet" href="{{ asset('assets/css/chatbox.css') }}">
    <div class="row">
        <div class="col-md-8">
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
            <form action="{{ route('usr.updateticket') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header">
                    <h3>Detail Ticket</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="hidden" name="id" value="{{ $ticket->id }}">
                            @if($user)
                            <input class="form-control read" name="nama" style="color:black" value="{{ $ticket->nama }}" {{ $user == true ? '' : 'readonly' }}>
                            @else
                            <textarea class="" name="nama" rows="1" style="padding:10px;width:100%;border:1px solid #e4e3e3cb;height:100%;-webkit-text-fill-color: black;color:black" value="{{ $ticket->nama }}" {{ $user == true ? '' : 'readonly' }}>{{ $ticket->nama }}</textarea>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Pesan</label>
                        <div class="col-sm-10">
                            <textarea class="" name="pesan" rows="5" style="padding:10px;width:100%;border:1px solid #e4e3e3cb;height:100%;-webkit-text-fill-color: black;color:black" value="{{ $ticket->pesan }}" {{ $user == true ? '' : 'readonly' }}>{{ $ticket->pesan }}</textarea>
                        </div>
                    </div>
                    @if (!empty($ticket->image))
                    <input type="hidden" name="gambar" value="{{ $ticket->image }}">
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Lampiran</label>
                            <div class="col-sm-10">
                                @foreach (json_decode($ticket->image) as $image)
                                    <a href="" data-toggle="modal" data-target=".bd-example-modal-lg"><img
                                            src="{{ url('img/photo/' . $image) }}" width="150px"
                                            alt="{{ $image }}"></a>
                                @endforeach
                            </div>
                        </div>
                        <!-- Large modal -->
                        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
                            aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    @php $i = 1; @endphp
                                    @foreach (json_decode($ticket->image) as $image)
                                        <span class="text-center">Gambar {{ $i++ }}</span>
                                        <a href="{{ url('img/photo/' . $image) }}">
                                            <img src="{{ url('img/photo/' . $image) }}" style="width: 100%"
                                                alt="{{ $image }}">
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (Auth::user()->role_id == 0 && $ticket->status == 0)
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Tambah Lampiran</label>
                        <div class="col-sm-10">
                            <input type="file" name="image[]" multiple="multiple" class="form-control-file mt-2" id="exampleFormControlFile1">
                        </div>
                    </div>
                    @endif


                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Status</label>
                        <div class="col">

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" {{ $ticket->priority==0 ? 'checked' : '' }} name="priority" value="0" id="inlineRadio1" {{ Auth::user()->role_id==2 ? 'disabled' : '' }}>
                                @if($ticket->priority==0)
                                <span class="badge badge-info">Rendah</span>
                                @else
                                <label class="form-check-label" style="margin-top: 5px" for="inlineRadio1">Rendah</label>
                                @endif
                            </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" {{ $ticket->priority==1 ? 'checked' : '' }} name="priority" value="1" id="inlineRadio2" {{ Auth::user()->role_id==2 ? 'disabled' : '' }}>
                                @if($ticket->priority==1)
                                <span class="badge badge-secondary" for="inlineRadio2">Sedang</span>
                                @else
                                <label class="form-check-label" style="margin-top: 5px" for="inlineRadio2">Sedang</label>
                                @endif
                            </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="priority" {{ $ticket->priority==2 ? 'checked' : '' }} value="2" id="inlineRadio3" {{ Auth::user()->role_id==2 ? 'disabled' : '' }}>
                                @if($ticket->priority==2)
                                <span class="badge badge-danger">Tinggi</span>
                                @else
                                <label class="form-check-label" style="margin-top: 5px" for="inlineRadio3">Tinggi</label>
                                @endif
                            </div>
                        </div>
                    </div>


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
                        <div class="col">
                            {{-- @if ($ticket->status == 0)
                                <span class="badge badge-warning mr-3">Belum Diatasi </span>

                            @elseif($ticket->status==1)
                                <span class="badge badge-success">Teratasi</span>

                            @elseif($ticket->status==2)
                                <span class="badge badge-danger">Tidak Dapat Diatasi</span>
                            @else
                                <span class="badge badge-danger">Ticket Dibatalkan</span>
                            @endif --}}
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" {{ $ticket->status==1 ? 'checked' : '' }} name="statusticket" value="1" id="inlineRadio1" value="option1" {{ Auth::user()->role_id==2 ? 'disabled' : '' }}>
                                @if($ticket->status==1)
                                <span class="badge badge-success">Teratasi</span>
                                @else
                                <label class="form-check-label" style="margin-top: 5px" for="inlineRadio1">Teratasi</label>
                                @endif
                            </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" {{ $ticket->status==0 ? 'checked' : '' }} name="statusticket" value="0" id="inlineRadio2" value="option1" {{ Auth::user()->role_id==2 ? 'disabled' : '' }}>
                                @if($ticket->status==0)
                                <span class="badge badge-warning" for="inlineRadio2">Belum Diatasi</span>
                                @else
                                <label class="form-check-label" style="margin-top: 5px" for="inlineRadio2">Belum Diatasi</label>
                                @endif
                            </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="statusticket" {{ $ticket->status==3 ? 'checked' : '' }} value="3" id="inlineRadio3" value="option2" {{ Auth::user()->role_id==2 ? 'disabled' : '' }}>
                                @if($ticket->status==3)
                                <span class="badge badge-danger">Ticket Dibatalkan</span>
                                @else
                                <label class="form-check-label" style="margin-top: 5px" for="inlineRadio3">Batalkan Ticket</label>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                        @if(Auth::user()->role_id!=2)
                                <button type="submit" class="btn btn-success">Simpan</button>
                        @endif
                        </form>
                            <a href="{{ route('usr.ticket') }}" class="btn btn-primary">Kembali</a>
                        </div>

                    </div>
                    </form>

                </div>
            </div>
        </div>

        {{-- Message --}}
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3>Pesan </h3>
                </div>
                <div class="card-body">
                    <div class="chat-box">
                        @foreach ($pesan as $p)
                            <div class="mb-3 row">
                                @if (Auth::check())
                                    <div class="{{ Auth::user()->name == $p->nama ? 'left-chat' : 'right-chat' }}">
                                        @if (Auth::user()->name == $p->nama)
                                            <label for="staticEmail"
                                                class="col col-form-label"><b>{{ $p->nama }}</b></label>
                                            <div class="col">
                                                <span class="form-control"
                                                    style="float: left;text-align:left;background-color:#66AEFF;color:white;width:auto">{{ $p->pesan }}</span>

                                            </div>
                                            <label for="staticEmail"
                                                class="col col-form-label" style="font-size: 12px !important;color:#8E8E8E !important">{{ $p->created_at->diffForHumans() }}</label>

                                        @else
                                            <label for="staticEmail" class="col col-form-label"
                                                style="float: right;text-align:right"><b>{{ $p->nama }}</b></label><br>
                                            <div class="col" style="float: right">
                                                <span class="form-control"
                                                    style="float: right;text-align:right;background-color:#549D47;color:white;width:auto">{{ $p->pesan }}</span>
                                            </div>
                                            <label for="staticEmail"
                                                class="col col-form-label" style="float: right;text-align:right;font-size: 12px !important;color:#8E8E8E !important">{{ $p->created_at->diffForHumans() }}</label>

                                        @endif
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <div class="send-message">
                        <form action="{{ route('usr.kirimpesan') }}" method="post">
                            @csrf
                            <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                            <input type="hidden" name="nama" value="{{ Auth::user()->name }}">
                            <div class="form-group row">
                                @if(Auth::user()->role_id!=2)
                                <div class="col-sm-10" style="margin-left: -20px">
                                    <input type="text" class="form-control" name="pesan" placeholder="Isi Pesan">
                                </div>

                                <div class="col-sm-2" style="margin-left: -25px">
                                    <button class="btn btn-success">Kirim</button>
                                </div>
                                @endif
                            </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
