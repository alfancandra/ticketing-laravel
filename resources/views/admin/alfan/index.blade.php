@extends('template.index')

@section('content')
    @push('css')
        <style>
            .modal-dialog {
                max-width: 95% !important;
                margin: 0;
                top: 0;
                bottom: 0;
                left: 0;
                right: 0;
                height: 100vh;
                display: flex;
            }
        </style>
    @endpush
    <button type="button" style="float: right" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg">.</button>

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="card">
                <div class="card-header">
                    <h3>Data Users</h3>
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
                    <a href="{{ route('adm.addalfan') }}" class="btn btn-primary">Tambah</a>
                    <hr />
                    <table class="table table-hover table-bordered" id="table1">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Kegiatan</th>
                            <th>Tanggal</th>
                            {{-- <th style="width: 180px">Action</th> --}}
                        </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach($alfan as $row)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $row->kegiatan }}</td>
                                <td>{{ $row->tanggal }}</td>
                                {{-- <td style="width:15%">@if($row->isread==0)
                                    <span class="text-warning">Belum Dibaca</span>
                                    @elseif($row->isread==1)
                                    <span class="text-success">Sudah Dibaca</span><br>
                                    @endif</td> --}}
                                {{-- <td style="width: 35%"><a href="{{ route('usr.showticket',$row->id) }}" onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-danger btn-sm">Hapus</a>

                                    <a href="{{ route('adm.edituser',$row->id) }}" class="btn btn-success btn-sm">Edit</a>


                                </td> --}}

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
