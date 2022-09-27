<!doctype html>
<html lang="en">
  <head>
  	<title>ECO Jarvis</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('images/eco1.png')}}" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
    @livewireScripts
    <script src="{{asset('js/alpine.min.js')}}" defer></script>
    @livewireStyles
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <link rel="stylesheet" href="{{ asset('css/app.css')}}">

  </head>
  <body>
        <main id="app">
            @yield('content')
        </main>
    <script src="{{ asset('js/app.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
  </body>
</html>
