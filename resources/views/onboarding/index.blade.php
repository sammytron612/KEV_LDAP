@extends('layouts.app', ['title' => 'Onboarding'])

@section('content')
<div class="container-fluid bg-white p-5">
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    <div class="row row-cols-1 row-cols-md-2">
        <x-card  route="{{route('newStarter')}}" title="New hires" text="Enter new hire details" image="{{url('images/new1.jpg')}}"/>

        <x-card route="{{route('viewAll')}}" title="Continue \ finish new hire details" text="Continue or finish up" image="{{url('images/new2.jpeg')}}"/>
    </div>
</div>
@endsection
