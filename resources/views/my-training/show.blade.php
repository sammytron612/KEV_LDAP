@extends('layouts.app', ['title' => "My training"])

@section('content')
<div class="container-fluid bg-white p-5">
    <div class="pb-2">
        @if($lesson->document)
            <a class="btn btn-outline-primary" href="{{url ('/storage/documents/' . $lesson->document)}}" download>Download lesson</a>
        @endif
    </div>
    <h3>{{$lesson->title}}</h3>
    <hr>
    <h4 class="text-center">Progress</h4>
    <div class="progress w-100 w-md-50 mx-auto mb-5">
        <div class="progress-bar bg-success" style="width:{{$progress}}%">{{$progress}}%</div>
    </div>
    <div class="d-flex justify-content-center">
        <div style="overflow-y: auto">@php echo $lesson->body; @endphp</div>
    </div>
    <div class="mt-5 d-flex justify-content-center" id="action_button">
        @if(!$end)
            @if(!$completed)
                <div class="w-100">
                    <livewire:complete-lesson :moduleId="$lesson->module_id" :lessonId="$lesson->id">
                </div>
                @else
                    <div class="mt-5 w-100 text-center">
                        <a href="{{url('view-training/' . $module . '/'. $index)}}" type="button" class="btn w-100 w-md-50 btn-primary">Next</a>
                    </div>
            @endif
        @endif
    </div>
</div>

<script>
    window.addEventListener('lessonCompleted', event => {

        let str = window.location.href

        let url = (str.substring(0, str.lastIndexOf('/'))) + '/' + {{$index + 1}}

        let html = "<a href='" + url + "' type='button' class='btn w-100 w-md-50 btn-success'>Next</a>"
        $('#action_button').html(html)
})

    window.addEventListener('moduleCompleted', event => {

        let html = "<a href='" + '{{url('finish-module/' . $module)}}' + "' type='button' class='btn w-100 w-md-50 btn-success'>Finish module</a>"
        $('#action_button').html(html)
})
</script>
@endsection
