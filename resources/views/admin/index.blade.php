@extends('template.index')

@section('content')
<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">Dashboard</h2>
                <h5 class="text-white op-7 mb-2">Support Ticket BKPP Kabupaten Sleman</h5>
            </div>
            <div class="ml-md-auto py-2 py-md-0">
                <a href="{{ route('usr.ticket') }}" class="btn btn-white btn-border btn-round mr-2">Ticket Aktif</a>
                @if(Auth::user()->role_id!=2)
                <a href="{{ route('usr.addticket') }}" class="btn btn-secondary btn-round">Tambah Ticket</a>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="page-inner mt--5">
    <div class="row mt--2">
        <div class="col">
            <div class="card card-stats card-light card-round">
                <div class="card-body">
                    <div class="card-title">Total Ticket</div>
                    <div class="card-category">Statistic</div>
                    <div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
                        <div class="px-2 pb-2 pb-md-0 text-center">
                            <div id="circles-1"></div>
                            <a href="{{route('usr.ticket')}}" style="text-decoration:none;color:#575962"><h6 class="fw-bold mt-3 mb-0">Belum Diatasi</h6></a>
                        </div>
                        <div class="px-2 pb-2 pb-md-0 text-center">
                            <div id="circles-2"></div>
                            <a href="{{route('usr.ticketnonaktif')}}" style="text-decoration:none;color:#575962"><h6 class="fw-bold mt-3 mb-0">Sudah Diatasi</h6></a>
                        </div>
                        <div class="px-2 pb-2 pb-md-0 text-center">
                            <div id="circles-3"></div>
                            <a href="{{route('usr.ticketdibatalkan')}}" style="text-decoration:none;color:#575962"><h6 class="fw-bold mt-3 mb-0">Dibatalkan</h6></a>
                        </div>
                        <div class="px-2 pb-2 pb-md-0 text-center">
                            <div id="circles-4"></div>
                            <a href="{{route('usr.allticket')}}" style="text-decoration:none;color:#575962"><h6 class="fw-bold mt-3 mb-0">Semua Ticket</h6></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        @php

        @endphp
    <div class="row mt--2">
        <div class="col">
            <div class="card full-height">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="card-title">Data Ticket 30 Hari Terakhir</div>
                            <div class="card-category">Statistic</div>
                            <div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
                                <div class="col">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="chart-container">
                                                <canvas id="pieChart" style="width: 50%; height: 50%"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card-title">Data Ticket Perbulan</div>
                            <div class="card-category">Statistic</div>
                            <div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
                                <div class="col">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="chart-container">
                                                <canvas id="lineChart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    Circles.create({
            id:'circles-1',
            radius:45,
            value:{{ count($ticket['belum']) }},
            maxValue:{{ count($ticket['semua']) }},
            width:7,
            text: {{ count($ticket['belum']) }},
            colors:['#f1f1f1', '#FF9E27'],
            duration:400,
            wrpClass:'circles-wrp',
            textClass:'circles-text',
            styleWrapper:true,
            styleText:true
        })

        Circles.create({
            id:'circles-2',
            radius:45,
            value:{{ count($ticket['sudah']) }},
            maxValue:{{ count($ticket['semua']) }},
            width:7,
            text: {{ count($ticket['sudah']) }},
            colors:['#f1f1f1', '#2BB930'],
            duration:400,
            wrpClass:'circles-wrp',
            textClass:'circles-text',
            styleWrapper:true,
            styleText:true
        })

        Circles.create({
            id:'circles-3',
            radius:45,
            value:{{ count($ticket['batal']) }},
            maxValue:{{ count($ticket['semua']) }},
            width:7,
            text: {{ count($ticket['batal']) }},
            colors:['#f1f1f1', '#F25961'],
            duration:400,
            wrpClass:'circles-wrp',
            textClass:'circles-text',
            styleWrapper:true,
            styleText:true
        })

        Circles.create({
            id:'circles-4',
            radius:45,
            value:{{ count($ticket['semua']) }},
            maxValue:{{ count($ticket['semua']) }},
            width:7,
            text: {{ count($ticket['semua']) }},
            colors:['#f1f1f1', '#2878dd'],
            duration:400,
            wrpClass:'circles-wrp',
            textClass:'circles-text',
            styleWrapper:true,
            styleText:true
        })
    var pieChart = document.getElementById('pieChart').getContext('2d');
    var lineChart = document.getElementById('lineChart').getContext('2d');
    var myPieChart = new Chart(pieChart, {
     type: 'pie',
     data: {
        datasets: [{
           data: [{{ count($ticket['harian_sudah']) }}, {{ count($ticket['harian_belum']) }},{{ count($ticket['harian_batal']) }}],
           backgroundColor :["#31ce36","#fdaf4b","#f3545d"],
           borderWidth: 0
       }],
       labels: ['Teratasi', 'Belum', 'Batal']
   },
   options : {
    responsive: true,
    maintainAspectRatio: false,
    legend: {
       position : 'bottom',
       labels : {
          fontColor: 'rgb(154, 154, 154)',
          fontSize: 11,
          usePointStyle : true,
          padding: 20
      }
  },
  pieceLabel: {
   render: 'value',
   fontColor: 'white',
   fontSize: 14,
},
tooltips: false,
layout: {
   padding: {
      left: 20,
      right: 20,
      top: 20,
      bottom: 20
  }
}
}
})
    var myLineChart = new Chart(lineChart, {
     type: 'line',
     data: {
        labels: [
        @php
        foreach($ticket['bulanan'] as $d) {
            echo "'".$d->month_name."',";
        }
        @endphp
        ],
        datasets: [{
           label: "Data Ticket",
           borderColor: "#31ce36",
           pointBorderColor: "#FFF",
           pointBackgroundColor: "#31ce36",
           pointBorderWidth: 2,
           pointHoverRadius: 4,
           pointHoverBorderWidth: 1,
           pointRadius: 4,
           backgroundColor: 'transparent',
           fill: true,
           borderWidth: 2,
           data: [
           @php
           foreach($ticket['bulanan'] as $d) {
            echo $d->count.',';
        }
        @endphp
        ]
    }]
},
options : {
    responsive: true,
    maintainAspectRatio: false,
    legend: {
       position: 'bottom',
       labels : {
          padding: 10,
          fontColor: '#31ce36',
      }
  },
  tooltips: {
   bodySpacing: 4,
   mode:"nearest",
   intersect: 0,
   position:"nearest",
   xPadding:10,
   yPadding:10,
   caretPadding:10
},
layout:{
   padding:{left:15,right:15,top:15,bottom:15}
}
}
});

</script>
@endpush
