@extends('layouts.app', ['title' => 'Onboarding'])

@section('content')

<div class="container">


    <form method="post" action="{{route('naturalHr')}}">

        <input name="kev" value="kev">
        <button type="submit">test</button>
    </form>
<!--
    <iframe title="vimeo-player" src="https://player.vimeo.com/video/665711772?h=3f9b9772ec" width="640" height="360" frameborder="0" allowfullscreen></iframe>

    <iframe style="width: 100%; height: 450px;" src="http://docs.google.com/gview?url=https://jarvis.ecoutsourcing.co.uk/storage/documents/test.docx&amp;embedded=true" frameborder="0"></iframe>;
-->
</div>

@endsection
