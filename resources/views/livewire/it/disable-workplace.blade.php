<div>
    @if(!$selected)
        <h4>Search</h4>
        <div class="form-group">
            <input class="form-control w-100" type="search" wire:model.debounce.500ms="searchTerm" placeholder="Search...">
        </div>
        @if($searchTerm && count($wps) > 0)
            <div class="mt-5 table-responsive">
                <table class="table">
                    <thead class="slate-gradient text-white">
                        <tr>
                            <th class="text-right mr-5">Action</th>
                            <th>Name</th>
                            <th>Title</th>
                            <th>Division</th>
                            <th>Site</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($wps as $wp)
                        <tr>
                            <td>
                                <button class="btn btn-danger btn-sm" wire:click="selectedUser({{$wp->workplace_id}})">Select</button>
                            </td>
                            <td class="text-truncate">{{$wp->name}}</td>
                            <td class="text-truncate">{{$wp->title}}</td>
                            <td class="text-truncate">{{$wp->department}}</td>
                            <td class="text-truncate">{{ $wp->site}}</td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>
        @elseif(strlen($searchTerm) > 0 && count($wps) == 0)
            <h4 class="text-center">Nothing to show</h4>
        @endif
    @else
        <div>
            <h3>Offboard</h3>
            <hr>
                <div class="form-group mt-3">
                    <h5 class="text-danger">Make this offboarding immediate</h5>
                    <input type="checkbox" wire:model="immediate">
                </div>

            <div class="form-group mt-3">

                <h5>Choose an offboarding date for <span class="h4 text-danger">{{$user->name}}</span></h5>
                <div class="text-danger">@error('leaveDate')@enderror</div>
                <input class="mt-2 form-control w-100 w-md-50" min="{{$today}}" wire:model.defer="leaveDate" type="date">
                @error('leaveDate') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div>
            <div wire:loading>
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
                <button wire:loading.remove wire:click="disableUser" class="btn btn-danger">Submit</button>
            </div>
        </div>

    @endif
</div>
