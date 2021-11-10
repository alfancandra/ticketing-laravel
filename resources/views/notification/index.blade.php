@extends('template.index')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Notifications</h3>
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
        <hr />
        <div class="row">
            <div class="col">
                <div class="card">
                @foreach ($notification as $notif)
                <a href="{{ route('usr.markread', $notif->id) }}" style="text-decoration: none">
                    <div class="card-body" style="border:1px solid #E3E3E3;{{ empty($notif->read_at) ? 'background: #DCDCDC' : '' }}">
                        <span class="block">
                            {{ $notif->data['message'] }} [{{ $notif->data['name'] }}]
                        </span>
                        <span class="time" style="float: right;color: gray">{{ \Carbon\Carbon::parse($notif->created_at)->diffForHumans() }}</span>
                    </div>
                </a>
                <hr>
                @endforeach
                </div>
            </div>
        </div>
@endsection
