@extends('layouts.app', ['title' => 'Account creation'])

@section('content')
<div class="container-fluid bg-white p-5">
    @if(session()->has('success'))
        <div class="mb-5 alert alert-success">
            <h4 class="text-center">{{ session()->get('success') }}</h4>
        </div>
    @endif

    <div class="modal fade" id="loadingModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered d-flex justify-content-center" role="document">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>
    <h3 class="text-eco-blue">{{ count($starters) }} new user(s) in this intake group.</h3>
    <h3>{{$transfers}} are transfers from another campaign.</h3>
    <div>
        <h5 class="font-weight-bold">Intake Group No:</label>&nbsp<span class="font-italic">&nbsp{{$starters[0]->batch_no}}</h5>
    </div>
    <hr>

    @foreach($starters as $starter)
    <div class="h5 row">
        <div class="col-12 col-md-4 border-right">
            <div>
                @if(!$starter->account)
                    @livewire('complete-button', ['onboarding' => $starter->id, 'completed' => $starter->completed], key($starter->id))
                @else
                    <label class="font-weight-bold">Completed:<span class="text-success"> Yes&nbsp</span></label>
                @endif
            </div>
            <div>
                <label class="font-weight-bold">Name:</label><span class="font-italic">&nbsp{{$starter->first_name}} {{$starter->last_name}}</span>
            </div>
            <div>
                @if(is_numeric(substr($starter->sam, -1)))
                    <label class="font-weight-bold">Duplicate AD account:</label><span class="text-danger">&nbspYES</span>
                @else
                    <label class="font-weight-bold">Duplicate AD account:</label><span class="text-success">&nbspNO</span>
                @endif
            </div>
            <div>
                @if($starter->account)
                <label class="font-weight-bold">AD account:<span class="font-italic text-success"> Yes</span></label>
                @else
                <label class="font-weight-bold">AD Account:<span class="font-italic text-danger"> No</span></label>
                @endif
                <div>
                    @if($starter->workplace == "Created")
                        <label class="font-weight-bold">WP account:<span class="font-italic text-success">Yes</span></label>
                    @elseif ($starter->workplace == "Fail" )
                        <label class="font-weight-bold">WP account:<span class="font-italic text-danger">Fail</span></label>
                    @elseif ($starter->workplace == "Not provisioned")
                        <label class="font-weight-bold">WP account:<span class="font-italic text-info">Not provisioned</span></label>
                    @else
                        <label class="font-weight-bold">WP account:<span class="font-italic text-danger">No</span></label>
                    @endif
                </div>

            </div>
        </div>
        <div class="col-12 col-md-4 border-right">
            <div>
                @livewire('onboarding.transfer-toggle',['internalTransfer' => $starter->internal_transfer, 'onboardId' => $starter->id],key($loop->index))
            </div>
            <div>
                <label class="font-weight-bold">Telephone:</label>&nbsp<span class="font-italic">&nbsp{{$starter->telephone}}</span>
            </div>
            <div>
                <label class="font-weight-bold">Email:</label><span class="font-italic">&nbsp{{$starter->email}}</span>
            </div>
            <div>
                <label class="font-weight-bold">Campaign:</label><span class="font-italic">&nbsp{{$starter->campaigns->title}}</span>
            </div>
            <div>
                <label class="font-weight-bold">Division:</label><span class="font-italic text-capitalize">&nbsp{{ $starter->divisions->title}}</span>
            </div>

            <div>
                <label class="font-weight-bold">Site:</label><span class="font-italic text-capitalize">&nbsp{{ $starter->site}}</span>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div>
                @if($starter->internet_provider)
                    <label class="font-weight-bold">Internet Provider:</label><span class="font-italic">&nbsp{{$starter->internet_provider}}</span>
                @endif
            </div>
            @if($starter->setup_location)
                <div>
                    <label class="font-weight-bold">Setup location:</label><span class="font-italic">&nbsp{{$starter->setup_location}}</span>
                </div>
            @endif
            @if($starter->ethernet_cable)
                <div>
                    <label class="font-weight-bold">Ethernet:</label>&nbsp<span class="font-italic">&nbsp{{$starter->ethernet_cable}}</span>
                </div>
            @endif
            @if($starter->equipment_collection)
                <div>
                    <label class="font-weight-bold">Collection date:&nbsp</label><span class="font-italic">&nbsp{{ \Carbon\Carbon::parse($starter->equipment_collection)->format('d/m/Y h:m:s') }}</span>
                </div>
            @endif
            <div>
                @if($starter->notes)
                    <label class="font-weight-bold">Notes:</label>&nbsp<span class="font-italic">&nbsp{{$starter->notes}}</span>
                @endif
            </div>
            <div>
                <label class="font-weight-bold">Start date:</label><span class="font-italic">&nbsp{{\Carbon\Carbon::parse($starter->start_date)->format('d/m/Y') }}</span>
            </div>
            <div>
                <label class="font-weight-bold">Created:</label>&nbsp<span class="font-italic">&nbsp{{ \Carbon\Carbon::parse($starter->created_at)->format('d/m/Y') }}</span>
            </div>
        </div>
    </div>
    <hr>
    @endforeach
    <div>{{$starters->links()}}</div>
    <hr>
    <div class="pt-4">
        @if($count)
            <form id="complete_form" method="post" action="{{route('completeIntake')}}">
                @method('post')
                @csrf
                <input type="hidden" name="batch_no" value="{{$batch_no}}">
                <button type="submit" class="btn btn-primary">Mark all as completed</button>
            </form>
        @endif
        <form id="create_accounts" method="post" action="{{route('createAccounts')}}">
            @csrf
            <input type="hidden" name="batch_no" value="{{$batch_no}}">

            <div class="form-group mt-3">

                <h6 class="font-weight-bold text-uppercase">Domain: {{$domain}}</h6>
                <select class="form-control w-100 w-md-50 w-lg-25" name="ou" required>
                    <option value=""><--Choose--></option>
                    @foreach($domainOus as $ou)
                            <option value="{{$ou}}">{{$ou}}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-2 form-check">
                <input name="workplace" type="checkbox" class="form-check-input">
                <label class="form-check-label"><h5>Provision workplace accounts</h5></label>
            </div>

            <div class="mt-2 form-check">
                <input name="email" type="checkbox" class="form-check-input">
                <label class="form-check-label" for="exampleCheck1"><h5>Mail Enabled</h5></label>
            </div>

            <button type="submit" class="btn btn-success text-white mt-1">Provision accounts</button>
        </form>
    </div>
</div>

@endsection
