@extends('layouts.app', ['title' => 'Assessment fail'])

@section('content')
<div class="container-fluid bg-white p-5">
    <h3 class="text-center">You failed the assessment on module '{{$moduleTitle}}' with a score of {{$score}}%.</h3>
    <h5 class="text-center">A 60% is the pass is mark needed</h5>
    <div class="text-center mt-5"><img src="{{asset('images/fail.jpg')}}"></div>
    <h3 class="mt-5 text-center"><a href="{{route('myTraining')}}" class="btn btn-outline-primary">Go back to my training</a></h3>
</div>
@endsection
