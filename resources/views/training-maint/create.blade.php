@extends('layouts.app', ['title' => 'New module'])

@section('content')
<div class="container bg-white p-5">

    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    @if(session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('Error') }}
        </div>
    @endif

    <div class="mt-5">
        <a href="{{route('newModule',$categoryId)}}" type="button" class="mr-2 float-right btn btn-teal">New training Module</a>
        @if(count($modules))
        <div class="col-12 col-md-6">
            <h3 class="mb-4 text-eco-blue">Training modules for category {{$title}}</h3>
                <div id="accordion">
                    @foreach($modules as $module)
                    <div class="card mt-2">
                        <a href class="stretched-link text-decoration-none" data-toggle="collapse" data-target="#collapse-{{$module->id}}" aria-expanded="true" aria-controls="collapse-{{$module->id}}">
                        <div class="card-header eco-blue-gradient" id="heading-{{$module->id}}">
                            <h5 class="mb-0 text-white">
                                <input type="button" class="btn btn-link bg-gradient text-white mr-2"/>
                                {{$module->title}}
                                <i class="text-white float-right fas fa-chevron-down"></i>
                            </h5>
                        </div>
                        </a>
                      <div id="collapse-{{$module->id}}" class="collapse" aria-labelledby="heading-{{$module->id}}" data-parent="#accordion">
                        <div class="card-body">
                            <div>
                                @livewire('training-list')
                            </div>
                            <div>
                                <a href="{{route('createLesson', $module->id)}}">New training lesson</a>
                            </div>

                            @if(!count($module->assessments))
                                <div class="mt-2">
                                    <a href="{{route('createAssessment', $module->id)}}" id="m-{{$module->id}}">New training assessment</a>
                                </div>
                            @endif
                        </div>
                      </div>
                    </div>
                    @endforeach
                </div>
        </div>
        @else
            <h3 class="text-center">There is none</h3>
        @endif
    </div>

</div>
<script>
    document.addEventListener('DOMContentLoaded', function(event) {
        $('#accordion').on('show.bs.collapse', function (event) {
    //alert(event.target.id)
    let str = event.target.id;
    id = str.split("-").pop();
    //$('#div1').html('')

    Livewire.emit('showlList',id)
  })
})

</script>

@endsection
