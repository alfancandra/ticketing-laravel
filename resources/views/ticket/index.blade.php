@extends('template.index')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Data Ticket Aktif</h3>
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
            <a href="{{ route('usr.addticket') }}" class="btn btn-primary">Tambah</a>
            <hr />
            <table class="table table-responsive" id="table1">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Status</th>
                    <th>Pesan</th>
                    <th>Gambar</th>
                    <th>Update Terakhir</th>
                    <th style="width: 180px">Action</th>
                </tr>
                </thead>
                <tbody>
                    @php $i = 1; @endphp
                    @foreach($ticket as $row)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $row->nama }}</td>
                        <td>@if($row->status==0)
                            <span class="text-warning">Belum Diatasi</span>
                            @elseif($row->status==1)
                            <span class="text-success">Sudah Diatasi</span>
                            @else
                            <span class="text-danger">Tidak Dapat Diatasi</span>
                            @endif</td>
                        <td>{{ $row->pesan }}</td>
                        <td>
                            @php if(!empty($row->image)){
                                $json = json_decode($row->image);
                                $image = $json[0];
                                $foto = true;
                            }else{
                                $foto = false;
                            } @endphp
                            @if($foto==true && count($json)>1)
                            <a href="{{ route('usr.showticket',$row->id) }}">
                            <img class="" width="70" src="{{ asset('img/photo/' . $image) }}">
                            </a>
                            @elseif($foto==true)
                            <a href="{{url('img/photo/'.$image)}}">
                            <img class="" width="70" src="{{ asset('img/photo/' . $image) }}">
                            </a>
                            @endif
                        </td>
                        <td>{{ date('d-F-Y H:i', strtotime($row->updated_at)) }}</td>
                        <td><a href="{{ route('usr.showticket',$row->id) }}" class="btn btn-info btn-sm">Show</a>
                            <a href="" class="btn btn-success btn-sm">Solved</a>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
