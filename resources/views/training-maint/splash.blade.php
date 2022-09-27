@extends('layouts.app', ['title' => 'Training maintenance'])

@section('content')
<div class="container bg-white p-5">
    <div class="row row-cols-1 row-cols-md-2 justify-content-center">
        <x-card  route="{{route('trainingInvite')}}" title="Invites" text="Invite users to E learning" image="{{ asset('images/invitation.jpg')}}"/>

        <x-card  route="{{route('categories')}}" title="Create, view add to" text="Create new E learning categories, modules and content" image="{{ asset('images/new_module.png')}}"/>

        <x-card  route="{{route('traineeProgress')}}" title="Training compliance" text="Monitor users training compliance" image="{{ asset('images/training.jpg')}}"/>
    </div>
</div>
@endsection
