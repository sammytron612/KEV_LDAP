@extends('layouts.app', ['title' => 'My apps'])

@section('content')
<div class="container-fluid bg-white p-5">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 justify-content-center">

        <div class="col">
            <x-card  width="75" route="{{route('myTraining')}}" title="My training" text="Training assigned to you" image="{{url('images/trainingjpg.jpg')}}"/>
        </div>
        @can('onBoarding')
            <div>
                <x-card width="75" route="{{route('onBoarding')}}" title="Onboarding" text="Provision new hires" image="{{url('images/onboarding.jpg')}}"/>
            </div>
        @endcan
        @can(['trainingMaintenance'])
            <div class="col">
                <x-card width="75" route="{{ route('trainingsplash')}}" title="E learning" text="All things related to training" image="{{ asset('images/elearning.png')}}"/>
            </div>
        @endcan

        @can(['offBoarding'])
            <div class="col">
                <x-card  width="75" route="{{route('offBoarding')}}" title="Offboarding" text="Submit an offboarding request" image="{{ asset('images/off-boarding.png')}}"/>
            </div>
        @endcan
        @can(['team-planner'])
            <div class="col">
                <x-card width="75" route="{{route('teams')}}" title="Team planner" text="Organise team intakes" image="{{ asset('images/team-planner.jpg')}}"/>
            </div>
        @endcan
        @can(['credentials'])
            <div class="col">
                <x-card width="75" route="{{route('logins')}}" title="Logins" text="View login details for new intake groups" image="{{ asset('images/login_details.jpg')}}"/>
            </div>
        @endcan

    </div>

</div>
@endsection
