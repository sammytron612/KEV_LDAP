@extends('layouts.app', ['title' => 'Login details'])
@section('content')

<div class="container-fluid bg-white pt-5">
    @if(isset($users[0]))
    <div class="mb-2">
        <h4><b>Campaign</b> - {{$users[0]->campaigns->title}}, {{$users[0]->divisions->title}}
            <a href="{{route('logins')}}" class="btn btn-primary float-right">Back</a>
        </h4>
        <h5><b>Site</b> - {{ucfirst($users[0]->site)}}</h5>
        <h5><b>Start date</b> - {{ \Carbon\Carbon::parse($users[0]->start_date)->format('d/m/Y') }}</h5>
        <h5><b>Initial Password</b> - Welcome=123</h5>
    </div>
    <br>
    <div class="mt-2 table-responsive">
        <table class="table">
            <thead class="eco-red text-white">
                <th>Name</th>
                <th>Login</th>
                <th>Internal transfer
                <th>Account created</th>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{$user->first_name}}&nbsp{{$user->last_name}}</td>
                    <td><h5><b>{{$user->sam}}</b></h5></td>
                    <td>@if($user->internal_transfer) Yes @else No @endif</td>
                    <td>@if($user->account) Yes @else No @endif</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    @else
    <div class="pb-5">
        <h4 class="text-center">This Group is not finalized</h4>
    </div>
    @endif
</div>

@endsection
