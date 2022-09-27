@extends('layouts.app', ['title' => 'Workplace management'])
@section('content')

<div class="container-fluid bg-white py-4">
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

        <div class="row row-cols-1 row-cols-md-3 justify-content-center">

            <x-card width="75" route="{{route('syncWP')}}" title="Sync" text="Sync WP users to local DB" image="{{url('images/sync.png')}}"/>

            <x-card width="75" route="{{route('createWP')}}" title="Create" text="Create WP accounts" image="{{url('images/workplace89.png')}}"/>


        </div>
</div>
@endsection
