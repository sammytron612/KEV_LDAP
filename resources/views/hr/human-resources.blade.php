@extends('layouts.app', ['title' => 'Human resources'])
@section('content')
<div class="container-fluid bg-white py-5">
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    <div class="row row-cols-1 row-cols-md-3 justify-content-center">
        @can('onBoarding')
            <x-card  width="75" route="{{route('onBoarding')}}" title="Onboarding" text="Provision new hires" image="{{url('images/onboarding.jpg')}}"/>
        @endcan

        @can(['offBoarding'])
            <div class="col">
                <x-card  width="75" route="{{route('offBoardingSplash')}}" title="Offboarding" text="Manage leavers" image="{{ asset('images/offboarding.png')}}"/>
            </div>
        @endcan

    </div>
</div>
@endsection
