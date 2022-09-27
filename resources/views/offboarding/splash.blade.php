@extends('layouts.app', ['title' => 'Offboarding'])

@section('content')
<div class="container bg-white p-5">
    <div class="row row-cols-1 row-cols-md-3 justify-content-center">
        @can(['offBoarding'])
            <div class="col">
                <x-card  width="75" route="{{route('offBoarding')}}" title="Offboarding" text="Submit an offboarding request" image="{{ asset('images/off-boarding.png')}}"/>
            </div>
        @endcan
</div>
@endsection
