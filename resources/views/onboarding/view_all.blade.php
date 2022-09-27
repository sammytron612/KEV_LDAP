@extends('layouts.app', ['title' => 'Onboarding'])

@section('content')

<div class="container-fluid bg-white p-5">

    @isset($result)
        @if($result == "success")
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Success</strong>
            </div>

        @else
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Oops something went wrong<strong>
            </div>
        @endif
    @endisset

    @if(count($batches))
    <h2 class="py-3 text-eco-blue">Intake groups</h2>
    <hr>
    <div id="table" class="table-responsive">
        <table class="table table-hover">
            <thead class="slate-gradient text-white">
                <tr>
                    <th class="text-truncate">Intake group</th>
                    <th class="text-truncate">Campaigns</th>
                    <th class="text-truncate">Division</th>
                    <th class="text-truncate">Progress</th>
                    <th class="text-truncate">Site</th>
                    <th>Start Date</th>
                    <th>Created by</th>
                    <th>Count</th>
                    <th class="text-truncate">Created date</th>
                    <th class="text-truncate">Completed \  Emailed to IT</th>
                    <th></th>

                </tr>
            </thead>
            <tbody>
                @foreach($batches as $batch)
                    <tr @if($batch->completed) class="bg-light-success" @endif>
                        <td>{{$batch->batch_no}}</td>
                        <td class="text-truncate">{{$batch->campaigns->title}}</td>
                        <td class="text-truncate">{{$batch->division->title}}</td>
                        <td>
                            @php
                                $t = ($count[$loop->index] / $batch->total) * 100;
                                $pct = round($t);
                            @endphp
                            <div class="progress mt-2">
                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="{{$pct}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$pct}}%;">
                            </div>
                                <span class="progress-completed py-2">{{$pct}}%</span>
                            </div>
                        </td>
                        <td class="text-capitalize">{{$batch->site}}</td>
                        <td>{{ \Carbon\Carbon::parse($batch->start_date)->format('d/m/Y') }}</td>
                        <td class="text-truncate">{{$batch->user?->name}}</td>
                        <td>{{$count[$loop->index]}}</td>
                        <td>{{ \Carbon\Carbon::parse($batch->created_at)->format('d/m/Y') }}</td>
                        <td>@php if($batch->completed){echo "Yes";} else {echo "No";}@endphp</td>
                        <td>
                            @if(!$batch->completed)
                            <div class="btn-group dropleft">
                                <button type="button" class="btn btn-primary btn-sm pr-3 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                                </button>
                                <div class="dropdown-menu text-center">
                                    <a href="{{route('newStarter',$batch->batch_no)}}" class="dropdown-item text-primary">Continue</a>
                                    @if($batch->onboardings->count())
                                        <a href="{{route('finishUp',$batch->batch_no)}}" class="dropdown-item text-success">Finish</a>
                                    @endif
                                    <div class="dropdown-divider"></div>
                                    <a onclick="return confirm('Confirm delete?');event.stopImmediatePropagation();event.preventDefault()" href="{{route('deleteBatch',$batch->batch_no)}}" class="dropdown-item text-danger">Delete</a>
                                </div>
                            </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-5">
    {{$batches->links()}}
    </div>
    @else
        <h3 class="text-center">Nothing here</h3>
    @endif

</div>

@endsection
