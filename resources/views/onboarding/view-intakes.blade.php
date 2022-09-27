@extends('layouts.app', ['title' => 'Onboarding'])

@section('content')

@if(count($batches))
<div class="container bg-white py-4">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h2 class="py-3 text-eco-blue">Intake groups</h2>
    <div class="pb-5">
        <span>Fully completed</span>
        <div class="d-inline-block bg-success" style="height:11px;width:24px"></div>
        <span class="ml-2 mt-2">Finalized by HR not IT</span>
        <div class="d-inline-block bg-warning" style="height:11px;width:24px"></div>
        <span class="ml-0 ml-md-2 mt-2">Finalized by neither</span>
        <div class="d-inline-block bg-white" style="height:11px;width:24px; border:1px solid black"></div>
    </div>
    <div id="table" class="table-responsive">
        <table class="table">
            <thead class="slate-gradient text-white">
                <tr>
                    <th class="text-truncate">#</th>
                    <th class="text-truncate">Campaign</th>
                    <th>Division</th>
                    <th class="text-truncate">Progress</th>
                    <th class="text-truncate">Site</th>
                    <th class="text-truncate">Created by</th>
                    <th class="text-truncate">#</th>
                    <th class="text-truncate">Created</th>
                    <th class="text-truncate">Start date</th>
                    <th class="text-truncate">Finalized by HR</th>
                    <th class="text-truncate">Completed by IT</th>
                    <th class="text-truncate">Accounts created</th>
                    <th class="text-truncate">Action</th>

                </tr>
            </thead>
            <tbody>
                @foreach($batches as $batch)
                    @if($batch->completed && $completed[$loop->index] == $count[$loop->index] && $batch->accounts_created)
                        <tr class="bg-light-success">

                    @elseif($batch->completed)
                        <tr style="background-color: #FFFFE0">

                    @else
                        <tr>
                    @endif
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
                        <td class="text-capitalize text-truncate">{{$batch->site}}</td>
                        <td class="text-truncate">{{$batch->user?->name}}</td>
                        <td class="text-truncate">{{$count[$loop->index]}}</td>
                        <td class="text-truncate">{{\Carbon\Carbon::parse($batch->created_at)->format('d/m/Y')}}</td>
                        <td class="text-truncate">{{ \Carbon\Carbon::parse($batch->start_date)->format('d/m/Y') }}</td>
                        <td class="text-truncate">@if($batch->completed) <span class="badge badge-success">Yes</span> @else <span class="badge badge-danger">No</span> @endif</td>
                        <td class="text-truncate">
                            @if($completed[$loop->index] === $count[$loop->index])
                            <span class="badge badge-success">Yes</span>
                            @else
                            <span class="badge badge-warning">No</span>
                            @endif
                        </td>
                        <td>@if($batch->accounts_created) <span class="badge badge-success">Yes</span> @else <span class="badge badge-danger">No</span> @endif</td>
                        <td>
                            <div class="btn-group dropleft">
                                <button type="button" class="btn btn-primary btn-sm pr-3 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                                </button>
                                <div class="dropdown-menu text-center">
                                    <a href="{{route('view_new_starter',$batch->batch_no)}}" class="dropdown-item text-primary">View</a>
                                    <div class="dropdown-divider"></div>
                                    <a onclick="return confirm('Confirm delete?');event.stopImmediatePropagation();event.preventDefault()" href="{{route('deleteBatch',$batch->batch_no)}}" class="dropdown-item text-danger">Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-5">
        {{$batches->links()}}
    </div>
</div>
@else
    <h3 class="text-center">Nothing here</h3>
@endif

@endsection
