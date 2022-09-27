@extends('layouts.app', ['title' => 'Onboarding'])

@section('content')
    @livewire('onboarding-form', ['batch_no' => $batch_no])
@endsection
