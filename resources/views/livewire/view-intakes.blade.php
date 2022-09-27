<div>
    @if(count($intakes))
    <div class="form-group">
        <label><h4>Search</h4></label>
        <input class="form-control w-100 w-md-25" type="search" wire:model="searchTerm">
    </div>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="slate-gradient text-white">
                <tr>
                    <th style="min-width:200px;">Name</th>
                    <th>Email</th>
                    <th style="min-width:200px;">Campaign</th>
                    <th>Intake no</th>
                    <th style="min-width:200px;">Keyed by</th>
                    <th>Completed</th>
                    <th style="min-width:200px;">Created</th>
                    <th style="min-width:200px;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($intakes as $intake)
                    <tr x-data="{completed: {{$intake->completed}}}">
                        <td><b>{{$intake->first_name}} {{$intake->last_name}}</b></td>
                        <td>{{ $intake->email}}</td>
                        <td>{{ $intake->campaign}}</td>
                        <td>{{$intake->batch_no}}</td>
                        <td>{{$intake->batch->user->name}}</td>
                        <td>
                            @if(!$intake->completed)
                                <span>No</span>
                            @else
                                <span>Yes</span>
                            @endif
                        </td>
                        <td>{{$intake->created_at}}</td>
                        <td><button data-toggle="modal" data-target="#showModal" wire:click='showModal({{$intake->id}})' class="btn btn-info btn-sm mr-1">View</button>
                            <button wire:click="complete({{$intake->id}});completed = 1" class="btn btn-sm btn-danger" :class="{ 'btn btn-sm btn-primary' : completed === 1 }">Complete</button>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div>
        {{$intakes->links()}}
    </div>
    @else
        <h3 class="text-center text-eco-blue">Nothing here</h3>
    @endif

<!-- Modal -->
    <div wire:ignore.self class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div  class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@isset($newUser->first_name) <h4>{{$newUser->first_name}} {{$newUser->last_name}}</h4> @endisset</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    @isset($newUser->first_name)
                    <div class="row form-group">
                        <div class="col">
                            <label><b>Telephone:</b></label> {{$newUser->telephone}}
                        </div>
                        <div class="col">
                            <label><b>Email:</b></label> {{$newUser->email}}
                        </div>
                        <div class="col">
                            <label><b>Campaign:</b></label> {{$newUser->campaign}}
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col">
                            <label><b>Start date:</b></label> {{$newUser->start_date}}
                        </div>
                        <div class="col">
                            <label><b>Internet provider:</b></label> {{$newUser->internet_provider}}
                        </div>
                        <div class="col">
                            <label><b>Setup location:</b></label> {{$newUser->setup_location}}
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col">
                            <label><b>Ethernet cable:</b></label> {{$newUser->ethernet_cable}}
                        </div>
                        <div class="col">
                            <label><b>collection date:</b></label> {{$newUser->equipment_collection}}
                        </div>
                        <div class="col">
                            <label><b>Notes:</b></label> {{$newUser->notes}}
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col">
                            <label><b>Intake No:</b></label> {{$newUser->batch_no}}
                        </div>
                        <div class="col">
                            <label><b>Completed:</b></label>@if($newUser->completed)<span>Yes</span> @else <span>No</span> @endif
                        </div>
                        <div class="col">
                        </div>
                    </div>
                    @endisset
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
