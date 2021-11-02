@extends('template.index')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>{{ $title }}</h3>
        </div>
        <div class="card-body">
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
            <a href="{{ route('usr.addticket') }}" class="btn btn-primary">Tambah</a>
            <hr />
            <table class="table table-hover table-bordered" cellpadding="4" id="table1">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Permasalahan</th>
                    <th>Ticket</th>
                    <th>Support</th>
                    <th style="width: 180px">Action</th>
                </tr>
                </thead>
                <tbody>
                    @php $i = 1; @endphp
                    @foreach($ticket as $row)
                    <tr>
                        <td class="align-top">{{ $i++ }}</td>
                        <td class="align-top">{{ $row->nama }}</td>

                        <td class="align-top">
                            {{ $row->pesan }}
                            @php if(!empty($row->image)){
                                $json = json_decode($row->image);
                                $image = $json[0];
                                $foto = true;
                            }else{
                                $foto = false;
                            } @endphp
                            @if($foto==true)
                            <a href="{{ route('usr.showticket',$row->id) }}">
                                <i class="icon-paper-clip"></i>
                            </a>
                            @endif
                        </td>
                        <td style="width:15%" class="align-top"><span class="badge badge-info">Dikirim</span><br>{{ date('d-m-Y', strtotime($row->created_at)) }}<br>{{ date('H:i', strtotime($row->created_at)) }} WIB</td>
                        <td class="align-top" style="width:15%">@if($row->status==0)
                            <span class="badge badge-warning">Belum Diatasi</span>
                            @elseif($row->status==1)
                            <span class="badge badge-success">Teratasi</span><br>
                            <span>{{ date('d-m-Y', strtotime($row->updated_at)) }}<br>{{ date('H:i', strtotime($row->updated_at)) }} WIB</span>
                            @else
                            <span class="badge badge-danger">Tidak Dapat Diatasi</span>
                            @endif</td>
                        <td style="width: 25%" class="align-top">
                            <a href="{{ route('usr.showticket',$row->id) }}" class="btn btn-info btn-sm">Detail</a>

                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
