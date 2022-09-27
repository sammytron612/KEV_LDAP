@extends('layouts.login')
@section('content')

<div class="container bg-white py-4">
    @if(session()->has('success'))
        <div class="alert alert-success">
            <h3>{{ session()->get('success') }}</h3>
        </div>
    @endif

    <div class="col-12 col-md-2">
        <img style="width:150px;height:150px" src="{{asset('images/eco.png')}}">
    </div>
    <h3 class="py-5">Your request has been submited for approval</h3>
    <div>
        <a type="button" href="https://google.co.uk" class="btn btn-success btn-block">Click Here</a>
    </div>

@endsection
