<div div class="row">
    <div class="col-12 col-md-6 border-right">
        <h4 class="text-eco-blue">Current campaigns</h4>
        <div class="table-responsive mt-4">
                <table class="table table-hover bordered">
                    <thead class="slate-gradient text-white">
                        <th>Campaign</th>
                        <th>Action</th>
                    </thead>
                <tbody>
                    @foreach($campaigns as $campaign)
                    <tr class="text-truncate">
                        <td>{{$campaign->title}}</td>
                        <td>
                            <livewire:campaign-button campaignId="{{$campaign->id}}" wire:key="{{$campaign->id}}" />
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </thead>
        </div>
        <div class="mt-5">{{$campaigns->links()}}</div>
    </div>
    <div class="col-12 col-md-6">
        <h4>New entry</h4>
        <div>
            <div class="form-group">
                <label>Title</label>
                <input class="form-control" type="text" wire:model.defer='title' required>
                @error('title') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                @if($editMode)
                    <div wire:loading:remove class="mt-5">
                        <button wire:click="updateCampaign" class="btn btn-teal">Update</button>
                    </div>
                @else
                    <div wire:loading:remove class="mt-5">
                        <button wire:click="newCampaign" class="btn btn-teal">Save</button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
