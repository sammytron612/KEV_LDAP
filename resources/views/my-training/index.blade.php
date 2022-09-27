@extends('layouts.app', ['title' => 'My training'])

@section('content')
@if(count($modules))
<div class="container-fluid bg-white p-5">

    <h3 class="text-center pb-5 text-eco-blue">Hello, {{Auth::user()->name}}. You have {{$modules->total()}} training modules</h3>

    @foreach($modules as $module)

        <div class="row my-2 justify-content-center">
            <div class="col-9 col-md-3 mb-2 mb-md-0 text-center">
                <a href="{{url('view-training/' . $module->module_id . '/'. 1)}}"><img  class="border shadow" style="max-width:270px;width:100%;min-width:100px;height:150px" src="{{asset('storage/images/'. $module->module->image) }}"></a>
                <div class="text-center mt-2 font-weight-bold">Completion</div>

                <div style="max-width:250px;width:100%" class="progress mt-2 mx-auto">
                    <div class="progress-bar bg-success" role="progressbar" aria-valuenow="{{$module->completed}}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $module->completed}}%;">
                    </div>
                    <span class="progress-completed py-2">{{ $module->completed}}%</span>
                </div>
                @if($module->assessment >= 60)
                    <div clsss="mt-2 text-center">Assessment - {{$module->assessment}}%</div>
                @else
                    @if($module->completed == 100 && count($module->assessments) && !$module->assessment)
                        <div class="mt-2 text-center"><a class="text-danger" href="{{route('beginAssessment', $module->module_id)}}"> Assessment outstanding</a></div>
                    @endif
                @endif
            </div>
            <div class="col-12 col-md-8" id="accordion">
                <div class="ml-0 ml-md-3 card">
                    <a href class="stretched-link text-decoration-none" data-toggle="collapse" data-target="#collapse-{{$module->module->id}}" aria-expanded="true" aria-controls="collapse-{{$module->module->id}}">
                        <div class="card-header eco-blue-gradient text-white" id="heading-{{$module->module->id}}">
                            <h5 class="mb-0">
                                <div class="text-center text-md-left w-100 d-inline-block">
                                {{$module->module->title}}
                                </div>
                            </h5>
                        </div>
                    </a>

                    <div id="collapse-{{$module->module->id}}" class="collapse" aria-labelledby="heading-{{$module->module->id}}" data-parent="#accordion">
                        <div class="card-body">
                            @if($module->module->desc)
                                <div class="py-2">{{$module->module->desc}}</div>
                            @endif
                            <a class="text-decoration-none" href="{{url('view-training/' . $module->module_id . '/'. 1)}}"><h5>Start this module</h5></a>
                            <div>
                                <ul class="list-unstyled">
                                    @php $lessons = $completed[$loop->index];
                                    @endphp
                                    @foreach($module->module->lessons as $lesson)
                                    @php $flag = false; @endphp
                                        @if($lessons)
                                            @foreach($lessons as $l)
                                                @if($l['lesson'] == $lesson->id)
                                                    <div><li class="shadow m-1 pl-2 border py-2" style="background-color: ghostwhite;">{{$lesson->title}}<i class="float-right fas fa-check text-success mr-2"></i></li></div>
                                                    @php $flag = true; @endphp
                                                    @break
                                                @endif
                                            @endforeach
                                        @endif
                                        @if(!$flag)
                                        <div><li class="shadow m-1 pl-2 border py-2" style="background-color: ghostwhite;">{{$lesson->title}}<i class="float-right text-danger mr-2 fas fa-times"></i></li></div>
                                        @endif
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        @endforeach
        {{$modules->links()}}

</div>
@else
    <h3 class="text-center text-eco-blue">You have none!</h3>
@endif
@endsection
