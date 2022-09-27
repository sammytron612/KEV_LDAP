@extends('layouts.app', ['title' => 'Module assessment'])

@section('content')
<div class="container-fluid bg-white p-5">
    <h3 class="text-center mb-5">Assessment for module - {{$module->title}}.</h3>
    <hr>
    <form action="{{route('finishAssessment')}}" method="post">
        @csrf
        <input type="hidden" name="module_id" value="{{ $module->id}}">
        @foreach($module->assessments as $questions)
            @php $index = $loop->index; @endphp
            <div class="my-5">
                <h4>Question({{$loop->index+1}}) - {{$questions->question}}?</h4>
                <div class="mt-3">
                    @php $answers = $questions->answers;
                        shuffle($answers);
                      // dd($answers);
                    @endphp
                    @foreach($answers as $a)
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input"
                                @php
                                    if($a['boolean'])
                                    {echo "value='1'";}
                                    else
                                    {echo "value='0'";}
                                 @endphp
                                    name="answer{{$index}}">
                                <h5>{{$a['answer']}}</h5>
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
        <button class="btn btn-primary" type="submit">Finish</button>
    </form>
</div>
@endsection
