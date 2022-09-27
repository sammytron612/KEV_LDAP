@extends('layouts.app', ['title' => 'New Training module'])

@section('content')
<div class="container bg-white p-5">
    <form method="POST" action="{{ route('storeModule') }}" enctype="multipart/form-data">
        @csrf
        <div>
            <h4 class="text-eco-blue">Module title</h4>
        </div>
        <div class="form-group">
            <input type="hidden" name="categoryId" value="{{$categoryId}}">
            <input class="form-control w-100 w-md-50" name="title" type="text" required placeholder="Module name">
        </div>
        <div class="form-group">
            <input class="form-control w-100 w-md-50" name="desc" type="text" required placeholder="Module description">
        </div>

        <div class="form-group">
            <label><h4>Image for module</h4></label>
            <input class="form-control w-100 w-md-50" type="file" name="moduleImage" required placeholder="Upload">
        </div>
        <div>
            <button type="submit" class="btn btn-teal">Save</button>
        </div>
    </form>
</div>
@endsection
