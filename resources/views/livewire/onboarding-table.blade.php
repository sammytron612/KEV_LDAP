<div>
    @if(count($additions))
        <div class="mt-3 col form-group">
            <label class="font-weight-bold"><h4 class="text-eco-blue">Current intakes in this group</h4></label>
            <div style="height:170px; max-height:300px;max-width:80vw" class="overflow-auto w-100 border p-2 bg-white h-100">
                <table class="table table-hover table-bordered">
                    <thead class="slate-gradient text-white">
                        <tr>
                            <th class="text-truncate">Name</th>
                            <th class="text_truncate">Transfer</th>
                            <th class="text-truncate">Email</th>
                            <th class="text-truncate">Telephone</th>
                            <th class="text-truncate">Campaign</th>
                            <th class="text-truncate">Site</th>
                            <th class="text-truncate">Start date</th>
                            <th class="text-truncate">Ethernet</th>
                            <th class="text-truncate">Internet provider</th>
                            <th>Setup location</th>
                            <th class="text-truncate">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($additions as $addition)
                            <tr id="row-{{$addition->id}}">
                                <td class="text-truncate">{{$addition->first_name }} {{$addition->last_name}}</td>
                                <td class="text_truncate">@if($addition->internal_transfer) Yes @else No @endif
                                <td class="text-truncate">{{$addition->email }}</td>
                                <td class="text-truncate">{{$addition->telephone}}
                                <td class="text-truncate">{{$addition->campaigns->title}}</td>
                                <td class="text-truncate text-capitalize">{{$addition->site}}</td>
                                <td class="text-truncate">{{$addition->start_date}}</td>
                                <td class="text-truncate">@if(!$addition->ethernet_cable) na @else {{$addition->ethernet_cable}} @endif</td>
                                <td class="text-truncate">@if(!$addition->internet_provider) na @else {{$addition->internet_provider}} @endif</td>
                                <td class="text-truncate">@if(!$addition->setup_location) na @else {{$addition->setup_location}} @endif</td>
                                <td>
                                    @if(count($additions) > 1)
                                    <livewire:intake-action intakeId="{{$addition->id}}" wire:key="{{$addition->id}}">
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <h4 class="text-center">Intake progress</h4>
        <div class="progress w-50 mx-auto">

            <div class="progress-bar" role="progressbar" style="width: {{$pct}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{$pct}}%</div>
        </div>
        <hr>
    @endif
</div>
