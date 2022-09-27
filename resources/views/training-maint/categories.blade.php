@extends('layouts.app', ['title' => 'Training categories'])

@section('content')
    <div class="container bg-white p-5">
        @if(session()->has('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Success</strong>
        </div>
        @endif

        <div class="row col-12 justify-content-end">
            <button class="btn btn-teal btn-lg" data-toggle="modal" data-target="#modelId">Add a Category</button>
        </div>
        <hr>
        <div class="mt-3 row row-cols-1 row-cols-md-2 justify-content-center">
            @foreach($categories as $category)
                <x-card route="{{route('createTraining', $category->id)}}" title="{{$category->title}}" text="{{$category->desc}}" image="{{ asset('storage/images/'. $category->image)}}"/>
            @endforeach
        </div>
    </div>


<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form  action="{{route('createCategory')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                        <h5 class="modal-title">Add a category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
            <div class="modal-body">
                <div class="container-fluid">

                        <div class="form-group">
                            <input class="form-control" type="text" name ="title" placeholder="Title">
                        </div>

                        <div class="form-group">
                            <input class="form-control" type="text" name ="desc" placeholder="Description">
                        </div>

                        <div class="form-group">
                            <input class="custform-control" type="file" name ="image" placeholder="Upload a image">
                        </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-teal">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
