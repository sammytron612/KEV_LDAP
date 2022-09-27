<div>
    <div class="row">
        <div class="form-group col-12 col-md-3">
            <label class="ml-3"><h4 class="text-eco-blue">Search</h4></label>
            <input class="form-control py-2" type="search" wire:model.debounce.500ms="searchTerm" id="example-search-input">
        </div>

        <div class="from-group col-12 col-md-3">
            <label><h4>Filter</h4></label>
            <select wire:model="filter" class="form-control py-2">
                <option value="0">No filter</option>
                <option value="1">Compliant</option>
                <option value="2">Non compliant</option>
            </select>
        </div>
        <div class="from-group col-12 col-md-3">
            <label><h4>Site</h4></label>
            <select wire:model="siteFilter" class="form-control py-2">
                <option selected value="%">All</option>
                <option value="%Boldon%">Boldon</option>
                <option value="%Sheffield">Sheffield</option>
                <option value="%Doxford%">Doxford</option>
                <option value="%Multi%">Multi-Site</option>
            </select>
        </div>
    </div>

    @if(count($users))
        <div class="col-12 mt-5">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="slate-gradient text-white">
                        <tr>
                            <th>User</th>
                            <th>Assigned</th>
                            <th>Completed</th>
                            <th>Dept</th>
                            <th>Title</th>
                            <th>Site</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td class="text-truncate">{{$user->name}} - {{$user->username}} - <span class="text-capitalize font-weight-bold">{{$user->domain}}</span></td>
                                <td>{{ count($user->assigned_training)}}</td>
                                    @php $count = count($user->assigned_training->where('completed','=','100')); @endphp
                                <td>{{$count}}</td>
                                <td>@if(isset($user->workplaces->department)) {{$user->workplaces->department}}@endif
                                <td>@if(isset($user->workplaces->title)) {{$user->workplaces->title}}@endif
                                <td>@if(isset($user->workplaces->site)) {{$user->workplaces->site}}@endif
                                <td><a href="{{route('traineeCompliance', $user->id)}}"  class="btn btn-teal">View</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-5 pagination">
                    {{$users->links()}}
                </div>
            </div>
        </div>

    @else
    <h3 class="mt-5 text-center">Nothing to show!</h3>
    @endif

</div>
