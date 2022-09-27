<div>
    <div class="form-group">
        <label class="mb-3 h4 font-weight-bold">Intake groups</label>

            <select wire:change="updateCampaign" wire:model="selected" class="w-100 w-md-50 form-control">
                @foreach($batches as $batch)
                    <option value="{{$batch->batch_no}}">#{{$batch->batch_no}} -
                        {{$batch->campaigns->title}} -
                        {{$batch->site}} -
                        {{ \Carbon\Carbon::parse($batch->start_date)->format('d/m/Y') }} - Heads:{{$batch->total}}
                    </option>
                @endforeach
            </select>

    </div>

    <div class="mt-5 table-responsive">
        <table class="table">
            <thead class="slate-gradient text-white">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Campaign</th>
                    <th class="text-right mr-5">Action</th>
                </tr>
            </thead>
            <tbody>

                @foreach($users as $user)
                <tr>
                    <td>{{$user->first_name}} {{$user->last_name}}</td>
                    <td class="text-truncate">{{$user->email}}</td>
                    <td class="text-truncate">{{$user->campaigns->title}}</td>
                    <td>
                        <livewire:it.workplace-button userId="{{$user->id}}" wire:key="{{$user->id}}" />
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>
