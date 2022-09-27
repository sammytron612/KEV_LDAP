@extends('layouts.app', ['title' => 'IT'])
@section('content')

<div class="container-fluid bg-white py-4">
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">

            <x-card width="75" route="{{route('viewAllIntakes')}}" title="View intakes" text="Confirmed by HR new intake details" image="{{url('images/itintake.jpg')}}"/>

            <x-card width="75" route="{{route('itOffBoarding')}}" title="Offboarding" text="Complete offboarding requests" image="{{url('images/off-boarding.png')}}"/>


            <x-card width="75" route="{{route('returnsShow')}}" title="Returns" text="IT returns" image="{{url('images/returns.jpg')}}"/>

            <x-card width="75" route="{{route('siteSettings')}}" title="Settings" text="Site settings" image="{{url('images/settings.jpg')}}"/>

            <x-card width="75" route="{{route('managementWP')}}" title="Workplace" text="Workplace management" image="{{url('images/workplace89.png')}}"/>

            <x-card width="75" route="{{route('campaignManagement')}}" title="Manage campaigns" text="Manage campaigns" image="{{url('images/ad.jpg')}}"/>

        </div>
</div>
@endsection
