@extends('layouts.app', ['title' => 'Module completion'])

@section('content')
<div class="container-fluid bg-white p-5">
    <h3 class="text-center">Well done. You have finished the module {{$module->title}}.</h3>
    @if($assessment)
        <h3 class="mt-4 text-center"><a href="{{route('beginAssessment',$module->id)}}" class="btn btn-outline-primary">Click to begin your assessment</a></h3>
    @else
    <h3 class="mt-4 text-center"><a href="{{route('myTraining')}}" class="btn btn-eco-red text-white">Click to go back to my traininig</a></h3>
    @endif
</div>
@endsection
