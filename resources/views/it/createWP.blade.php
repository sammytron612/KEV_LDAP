@extends('layouts.app', ['title' => 'Workplace creation'])
@section('content')

<div class="container-fluid bg-white py-4">
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    @livewire('it.workplace-table')

</div>
@endsection
