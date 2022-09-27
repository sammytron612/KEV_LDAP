@extends('layouts.app', ['title' => 'Trainee compliance'])

@section('content')
<div class="container bg-white p-5">
    <div class="row row-cols-1 row-cols-md-2">
        <div class="col">
            <div id="piechart" style="width: auto; height: auto;"></div>
        </div>
        <div class="col">
            <h4>Trainee : <i>{{$user->name}}</i></h4>
            <hr>
            <h4>Modules assigned : <i>{{$assigned}}</i></h4>
            <hr>
            <h4>Modules completed : <i>{{$completed}}</i></h4>
            <hr>
        </div>
    </div>

        <div class="row">
            <div class="col">
                <h4 class="text-eco-blue">Modules assigned</h4>
                <div class="mt-3" id="accordianId" role="tablist" aria-multiselectable="true">
                    @foreach($user->assigned_training as $assigned)
                    <div class="card">
                        <div class="card-header eco-blue-gradient" role="tab" id="section1HeaderId">
                            <a class="text-decoration-none stretched-link"data-toggle="collapse" href="#section-{{$assigned->module->id}}" aria-expanded="true" aria-controls="section1ContentId">
                                <h5 class="mb-0">
                                    <div class="text-white text-center text-md-left w-100 d-inline-block">
                                        {{$assigned->module->title}} - {{$assigned->completed}}%&nbsp Completed
                                    </div>
                                </h5>
                            </a>
                        </div>
                        <div id="section-{{$assigned->module->id}}" class="collapse in" role="tabpanel" aria-labelledby="section1HeaderId">
                            <ul class="list-unstyled">
                                <div class="card-body">
                                    @foreach($assigned->module->lessons as $lesson)
                                        @php $flag = 0; @endphp
                                        @if($assigned->lessons_complete)
                                            @foreach($assigned->lessons_complete as $comp_lesson)
                                                @if($comp_lesson['lesson'] == $lesson->id)
                                                    <li class="shadow m-1 pl-2 border py-2" style="background-color: ghostwhite;">{{$lesson->title}} - {{\Carbon\Carbon::parse($comp_lesson['completed_date'])->toDayDateTimeString()}}<i class="float-right fas fa-check text-success mr-2"></i></li>
                                                    @php $flag = true; @endphp
                                                    @break
                                                @endif
                                            @endforeach
                                            @if(!$flag)
                                                <li class="shadow m-1 pl-2 border py-2" style="background-color: ghostwhite;">{{$lesson->title}}<i class="float-right text-danger mr-2 fas fa-times"></i></li>
                                            @endif
                                        @endif
                                    @endforeach
                                    @if(count($assigned->assessments))
                                        @if($assigned->assessment >= 60)
                                            <h5 class="ml-2 mt-5 text-success">Assessment completed</h5>
                                        @else
                                            <h5 class="ml-2 mt-5 text-danger">Assessment not completed</h5>
                                        @endif
                                    @endif
                                </div>
                            </ul>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
    </div>
</div>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

    var data = google.visualization.arrayToDataTable([
        ['Year', 'Training modules'],
          ['Completed',  {{$pct_completed}}],
          ['Not completed',  {{$pct_not}}],



    ]);

      var options = {
        title: 'Trainee compliance',
        is3D: true,
        width: 400,
        height: 300
      };

      var chart = new google.visualization.PieChart(document.getElementById('piechart'));

      chart.draw(data, options);
    }
  </script>
@endsection
