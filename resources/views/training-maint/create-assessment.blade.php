@extends('layouts.app', ['title' => 'Assessment creation'])

@section('content')
<div class="container bg-white p-5">

    <livewire:assessment-component :moduleId="$moduleId">

</div>
@endsection
