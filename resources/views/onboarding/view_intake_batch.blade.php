@extends('layouts.app', ['title' => 'Onboarding'])

@section('content')

<div class="container-fluid">
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif


</div>


@endsection
