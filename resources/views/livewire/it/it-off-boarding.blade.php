<div>
    <h3 class="text-eco-blue">Offboarding requests</h3>
    <hr>
    <h4>Search</h4>
    <input class="form-control w-100 w-md-25" type="search" wire:model="searchTerm" placeholder="Search..." disabled>
    <div class="table-responsive mt-4">
        <table class="mt-3 table">
            <thead class="slate-gradient text-white">
                <th>User</th>
                <th>Type</th>
                <th>Date leaving</th>
                <th>Submitted by</th>
                <th>Completed</th>
                <th></th>
            </thead>
            <tbody>
                @foreach($offboardings as $offboarding)
                    <tr>
                        @if(!$offboarding->name)
                            <td>{{$offboarding->usersTrashed?->name}}</td>
                        @else
                            <td>{{$offboarding->name}}</td>
                        @endif
                        <td>{{$offboarding->type}}</td>
                        <td>{{ \Carbon\Carbon::parse($offboarding->leave_date)->format('d/m/Y') }}</td>
                        <td>{{$offboarding->requestor?->name}}</td>
                        @if($offboarding->completed)
                        <td>{{ \Carbon\Carbon::parse($offboarding->completed)->format('d/m/Y H:m:s') }}</td>
                        @else
                        <td>No</td>
                        @endif
                        <td><button class="btn btn-danger btn-sm" wire:click="delete({{$offboarding->id}})">Delete</button></td>
                    </tr>
                @endforeach
                <tr>
            </tbody>
        </table>
        <div class="mt-5">
            {{$offboardings->links()}}
        </div>
    </div>
</div>
