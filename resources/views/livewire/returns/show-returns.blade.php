<div>
    <div class="mt-3 form-group col-12 col-md-6">
        <label style="font-weight: 700" class="text-eco-blue h4 mr-1" for="search">Search</label>
        <input wire:model="searchTerm" type="search" class="w-100 w-md-50 form-control" id="search" placeholder="Search...">
    </div>
    <div class="pt-5 pb-2">
        <span>Returned</span>
        <div class="d-inline-block bg-light-success" style="height:11px;width:24px"></div>
        <span class="ml-2 mt-2">Approved</span>
        <div class="d-inline-block bg-warning" style="height:11px;width:24px"></div>
        <span class="ml-2 mt-2">Neither</span>
        <div class="d-inline-block bg-white" style="height:11px;width:24px; border:1px solid black"></div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="mt-2 table-responsive">
                <table class="table table-sm">
                    <thead class="slate-gradient text-white">
                        <tr>
                            <th>Name</th>
                            <th>Campaign</th>
                            <th>Site</th>
                            <th>Return Date</th>
                            <th style="width:300px">Notes</th>
                            <th>Returned</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($returns as $return)

                            <tr @if($return->actioned == 1 ) class="bg-light-warning"  @elseif($return->actioned == 2) class="bg-light-success" @endif>
                                <td>{{$return->name}}</td>
                                <td class="text-truncate">{{$return->campaign}}</td>
                                <td class="text-capitalize">{{$return->site}}</td>
                                <td>{{ \Carbon\Carbon::parse($return->date_time)->format('d/m/Y, H:i') }}</td>
                                <td>
                                    @if($return->notes)
                                    <a href="javascript:void(0);" type="button" class="no-opacity btn btn-sm btn-primary px-1 py-0" data-toggle="popover" title="Notes" data-content="{{$return->notes}}">Notes</a>
                                    @endif
                                </td>
                                <td>@if($return->date_returned){{ \Carbon\Carbon::parse($return->date_returned)->format('d/m/Y, H:i') }}@endif</td>
                                <td>
                                    <div class="btn-group dropleft">
                                        <button type="button" class="btn btn-teal btn-sm pr-3 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                        </button>
                                        <div class="dropdown-menu">
                                        @if($return->actioned < 1)<a wire:loading.remove class="dropdown-item text-success text-center" href="javascript:void[0]" wire:click="view({{$return->id}})">View</a>@endif
                                        @if($return->actioned == 1)<a wire:loading.remove class="dropdown-item text-primary text-center" href="javascript:void[0]" wire:click="complete({{$return->id}})">Complete</a>@endif
                                        <div class="dropdown-divider"></div>
                                        <a onclick="return confirm('Confirm delete?');event.stopImmediatePropagation();event.preventDefault()" class="dropdown-item text-danger text-center" wire:click.prevent="delete({{$return->id}})">Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-5">
                {{$returns->links()}}
            </div>
        </div>
        <div class="col-12 col-md-6">
            @if($show)
            <div>
                <div class="form-group">
                    <label>Name</label>
                    <input class="form-control" type="text" wire:model.defer="view_name" readonly>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" type="text" wire:model.defer="view_email" readonly>
                </div>
                <div class="form-group">
                    <label>Campaign</label>
                    <input class="form-control" type="text" wire:model.defer="view_campaign" readonly>
                </div>
                <div class="form-group">
                    <label>Leaver notes</label>
                    <input class="form-control" type="text" wire:model.defer="view_notes" readonly>
                </div>
                <div class="form-group">
                    <label>IT Notes</label>
                    <input class="form-control" type="text" wire:model.defer="it_notes">
                </div>
                <div class="form-group">
                    <div wire:loading>
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                    <a wire:loading.remove class="btn btn-success" href="javascript:void[0]" wire:click="approve({{$return->id}})">Approve</a>
                    <a wire:loading.remove class="btn btn-danger" href="javascript:void[0]" wire:click="reject({{$return->id}})">Reject</a>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        $('[data-toggle="popover"]').popover();
});

    </script>
</div>
