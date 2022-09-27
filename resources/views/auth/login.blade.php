@extends('layouts.login')

@section('content')
<div class="container-fluid min-vh-100">
    <div class="row justify-content-center">
        <div style='-webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;background-repeat: no-repeat;background-image: url("images/solar-min.jpg");' class="min-vh-100 d-none d-md-block col-md-6">
        </div>
        <div class="col-md-6 my-auto">
            <div class="card">
                <div class="card-header"><img class="mr-2" style="height:35px;width:35px" src="{{asset('images/eco.png')}}"><span class="h4 mx-auto">ECO Jarvis login</span>
                </div>

                <div class="card-body w-100 mx-auto">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <h5 class="text-center">Choose your Domain</h5>
                        <div class="form-group row">

                            <select class="w-100 w-sm-75 form-control mx-auto" name="domain">
                                @foreach(['overwatch' => 'Overwatch', 'hydra' => 'Hydra','cybertron' => 'Cybertron'] as $guard => $name)
                                <option value="{{ $guard }}" {{ old('domain') == $guard ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group row px-5 mx-auto w-100 w-md-75">
                                <div class="text-danger mx-auto mb-2" style="font-size: 12px">Username is firstname.lastname</div>
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" placeholder="firstname.lastname" required autocomplete="username" autofocus/>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                        </div>

                        <div class="form-group row mx-auto px-5 w-100 w-md-75">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row mb-0 justify-content-center">

                                <button type="submit" class="btn bg-eco-blue text-white">
                                    {{ __('Login') }}
                                </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
