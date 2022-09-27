@extends('layouts.app', ['title' => 'Assessment completion'])

@section('content')
<div class="container-fluid bg-white p-5">
    <h3 class="text-center">Well done, you have passed the assessment on module '{{$moduleTitle}}' with a score of {{$score}}%.</h3>
    <div class="text-center mt-5"><img src="{{asset('images/Pass.jpg')}}"></div>
    <h3 class="mt-5 text-center"><a href="{{route('myTraining')}}" class="btn btn-outline-primary">Go back to my training</a></h3>
</div>
@endsection
