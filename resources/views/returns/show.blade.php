@extends('layouts.app', ['title' => 'ECO Returns'])
@section('content')

<div class="container bg-white py-4">
    @if(session()->has('success'))
        <div class="alert alert-success">
            <h3>{{ session()->get('success') }}</h3>
        </div>
    @endif

    @livewire('returns.show-returns')

</div>

@endsection
