@extends('layouts.app', ['title' => 'Disable workplace accounts'])
@section('content')

<div class="container-fluid bg-white py-4">
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

        @livewire('it.disable-workplace')
</div>
@endsection
