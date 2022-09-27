@extends('layouts.app', ['title' => 'Recruitment provisioning'])
@section('content')

<div class="container bg-white py-4">
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

@livewire('campaign-provision')

</div>
@endsection
