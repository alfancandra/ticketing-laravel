@extends('template.index')

@section('content')
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
            <a href="{{ route('adm.adduser') }}" class="btn btn-primary">Tambah</a>
            <hr />
            <table class="table table-hover table-bordered" id="table1">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Tanggal Dibuat</th>
                    <th style="width: 180px">Action</th>
                </tr>
                </thead>
                <tbody>
                    @php $i = 1; @endphp
                    @foreach($user as $row)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->username }}</td>
                        <td style="width:15%">@if($row->role_id==0)
                            <span class="text-success">User</span>
                            @elseif($row->role_id==1)
                            <span class="text-success">Admin</span><br>
                            @endif</td>
                        <td style="width:15%">{{ date('d-m-Y', strtotime($row->created_at)) }}<br>{{ date('H:i', strtotime($row->created_at)) }} WIB</td>

                        <td style="width: 35%"><a href="{{ route('usr.showticket',$row->id) }}" onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-danger btn-sm">Hapus</a>

                            <a href="{{ route('adm.edituser',$row->id) }}" class="btn btn-success btn-sm">Edit</a>

                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Ubah Role
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                @if($row->role_id==0)
                                  <a class="dropdown-item" href="{{ route('adm.changerole',$row->id) }}">Admin</a>
                                @else
                                  <a class="dropdown-item" href="{{ route('adm.changerole',$row->id) }}">User</a>
                                @endif
                                </div>
                            </div>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
