@extends('layouts.app', ['title' => 'Training compliance'])
@push('material-scripts')
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.js"
></script>
@endpush
@push('material-css')
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.css"
  rel="stylesheet"
/>
@endpush
@section('content')
<div class="container bg-white p-5">

    <div class="row row-cols-1 row-cols-md-2">
        <div class="col">
            <div style="width: 100%;" id="chart"></div>
        </div>
    </div>

    @livewire('user-compliance')

</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

    var data = google.visualization.arrayToDataTable([
        ['Not completed', 'Completed', { role: 'style' }],
          ['Not completed',  {{$not_completed}}, 'red'],
          ['Completed',  {{$completed}}, 'blue'],

    ]);

      var options = {
        title: 'Overall training compliance',
        is3D: true,

        height: 300
      };

      var chart = new google.visualization.ColumnChart(document.getElementById('chart'));

      chart.draw(data, options);
    }
  </script>
@endsection
