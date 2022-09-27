<!doctype html>
<html lang="en">
  <head>
  	<title>ECO Jarvis</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="shortcut icon" type="image/x-icon" href="{{asset('images/eco1.png')}}" />

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    @stack('material-css')

    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
    @livewireScripts
    <script src="{{asset('js/alpine.min.js')}}" defer></script>
    @livewireStyles

  </head>
  <body style="font-family: Calibri, sans-serif">

	<div class="wrapper d-flex align-items-stretch">
		<nav id="sidebar">

          <div class="img bg-wrap text-center py-4" style="background-image: url('/images/eco_outside.jpg');">
              <div class="user-logo">
                    @if(Auth::user()->profile_image)
                        <div class="img" style="background-image: url('/storage/profiles/{{Auth::user()->profile_image}}');"></div>
                    @endif
                  <h3>{{ Auth::user()->name}}</h3>
              </div>
          </div>
          <img style="border-bottom:1px solid #202092" class="w-100" src="{{asset('storage/images/jj.jpg')}}">

            <ul class="list-unstyled mb-5" style="font-size:15px">
            <li  class="{{ request()->is('home') || request()->is('/') ? 'active' : '' }}">
                <a style="font-size:18px" class="text-decoration-none" href="{{ route('home')}}"><span class="mr-2 fa fa-home"></span> Home</a>
            </li>
            @can('hr')
                    <li class="{{ (request()->is('human-resources')) ? 'active' : '' }}">
                        <a style="font-size:18px" class="text-decoration-none" href="{{route('humanResources')}}"><i class="mr-2 fas fa-user-circle"></i> HR</a>
                    </li>
            @endcan
            @can('it')
                    <li class="{{ (request()->is('it')) ? 'active' : '' }}">
                        <a style="font-size:18px" class="text-decoration-none" href="{{route('it')}}"><i class="mr-2 fas fa-desktop"></i> IT</a>
                    </li>
            @endcan
            <li class="{{ (request()->is('my-training')) ? 'active' : '' }}">
                @if(session('trainingOut') > 0)
                <a style="font-size:18px" class="text-decoration-none" href="{{ route('myTraining')}}"><span class="mr-2 notif "><i class="fa fa-graduation-cap"></i><small class="d-flex align-items-center justify-content-center"> {{session('trainingOut')}} </small> My training</a>
                @else
                    <a style="font-size:18px" class="text-decoration-none" href="{{ route('myTraining')}}"><i class="mr-2 fa fa-graduation-cap"></i> My training</a>
                @endif
            </li>
            @can('featureOff')
            <li class="{{ (request()->is('my-profile')) ? 'active' : '' }}">
                <a style="font-size:18px" class="text-decoration-none" href="{{route('myProfile')}}"><i class="mr-2 fas fa-user-circle"></i> My profile</a>
            </li>
            @endcan
            <li class="{{ (request()->is('my-apps')) ? 'active' : '' }}">
                <a style="font-size:18px" class="text-decoration-none" href="{{ route('my-apps') }}"><i class="mr-2 fab fa-app-store"></i> My apps</a>
            </li>
            @can('featureOff')
                <li class="{{ (request()->is('agent-zone')) ? 'active' : '' }}">
                    <a style="font-size:18px" class="text-decoration-none" href="{{route('agentZone')}}"><span class="mr-2 fas fa-headset"></span> Agent zone</a>
                </li>
            @endcan


            <li>
                <a style="font-size:18px" class="text-decoration-none"href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"><i class="mr-2 fas fa-sign-out-alt"></i> Logout
                </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
            </li>
            </ul>
        </nav>

        <!-- Page Content  -->
      <div id="content" style="background-color: #b8c6db;
      background-image: linear-gradient(315deg, #b8c6db 0%, #f5f7fa 74%);" class="pb-5 pl-0 pr-0 pl-md-5 pr-md-5 pt-3">
        <nav class="shadow sticky-top navbar navbar-expand-lg navbar-light bg-white py-3 rounded">
          <div class="container-fluid">


            <button type="button" id="sidebarCollapse" class="text-white btn btn-dark">
              <i class="fa fa-bars"></i>
              <span class="sr-only">Toggle Menu</span>
            </button>

            <h3 class="text-left mx-auto ml-md-3 text-eco-blue">{{ ucfirst($title ?? '')}}</h3>
            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <span class="ml-auto d-none d-md-block text-dark-teal">{{  \Carbon\Carbon::parse(now())->format('l, d F, Y') }}</span>

                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('home')}}"><img style="height:35px;width:35px" src="{{asset('images/eco.png')}}"></a>
                    </li>
                </ul>

            </div>
          </div>
        </nav>

        <main id="app" class="py-2">
            @yield('content')
        </main>

	</div>

    @stack('material-scripts')
    <script src="{{ asset('js/app.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>

  </body>
</html>
