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
            @if(Auth::user()->role_id!=2)
                <a href="{{ route('usr.addticket') }}" class="btn btn-primary">Tambah</a>
            @endif
            <hr />
            <table class="table-responsive table-hover table-bordered dataTable" style="width: 100%" cellpadding="4" id="basic-datatables">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Permasalahan</th>
                    <th>Ticket</th>
                    <th>Support</th>
                    <th>Priority</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @php $i = 1; @endphp
                    @foreach($ticket as $row)
                    <tr>
                        <td style="width:5%" class="align-top">{{ $i++ }}</td>
                        <td style="width:15%" class="align-top">{{ $row->nama }}</td>

                        <td style="width:60%" class="align-top">
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
                        <td style="width:10%" class="align-top"><span class="badge badge-info">Dikirim</span><br>{{ date('d-m-Y', strtotime($row->created_at)) }}<br>{{ date('H:i', strtotime($row->created_at)) }} WIB</td>
                        <td class="align-top" style="width:10%">@if($row->status==0)
                            <span class="badge badge-warning">Belum Diatasi</span>
                            @elseif($row->status==1)
                            <span class="badge badge-success">Teratasi</span><br>
                            <span>{{ date('d-m-Y', strtotime($row->updated_at)) }}<br>{{ date('H:i', strtotime($row->updated_at)) }} WIB</span>
                            @elseif($row->status==2)
                            <span class="badge badge-danger">Tidak Dapat Diatasi</span>
                            @else
                            <span class="badge badge-danger">Ticket Dibatalkan</span>
                            @endif</td>
                        <td class="align-top" style="width:10%">
                            @if($row->priority==0)
                                <span class="badge badge-warning">Rendah</span>
                                @elseif($row->priority==1)
                                <span class="badge badge-custom" style="background: #349342;color:white">Sedang</span><br>
                                @elseif($row->priority==2)
                                <span class="badge badge-danger">Tinggi</span>
                                @endif</td>
                        <td style="width: 10%" class="align-top">
                            <a href="{{ route('usr.showticket',$row->id) }}" class="btn btn-primary btn-sm">Detail</a>

                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @push('js')
    <script >
		$(document).ready(function() {
			$('#basic-datatables').DataTable({

			});

			$('#multi-filter-select').DataTable( {
				"pageLength": 5,
				initComplete: function () {
					this.api().columns().every( function () {
						var column = this;
						var select = $('<select class="form-control"><option value=""></option></select>')
						.appendTo( $(column.footer()).empty() )
						.on( 'change', function () {
							var val = $.fn.dataTable.util.escapeRegex(
								$(this).val()
								);

							column
							.search( val ? '^'+val+'$' : '', true, false )
							.draw();
						} );

						column.data().unique().sort().each( function ( d, j ) {
							select.append( '<option value="'+d+'">'+d+'</option>' )
						} );
					} );
				}
			});

			// Add Row
			$('#add-row').DataTable({
				"pageLength": 5,
			});

			var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

			$('#addRowButton').click(function() {
				$('#add-row').dataTable().fnAddData([
					$("#addName").val(),
					$("#addPosition").val(),
					$("#addOffice").val(),
					action
					]);
				$('#addRowModal').modal('hide');

			});
		});
	</script>
    @endpush
@endsection
