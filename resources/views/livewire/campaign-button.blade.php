<div class="btn-group dropleft">
    <button type="button" class="btn btn-primary btn-sm pr-3 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Action
    </button>
    <div class="dropdown-menu">
        <a data-toggle="modal" data-target="#modelId" href="javascript:void[0]" wire:click="editCampaign({{$campaignId}})" class="dropdown-item text-primary text-center">Edit</a>
    <div class="dropdown-divider"></div>
        <a onclick="confirm('Are you sure you want to remove this?') || event.stopImmediatePropagation()" class="dropdown-item text-danger text-center" wire:click="deleteCampaign({{$campaignId}})" href="javascript:void[0]">Delete</a>
    </div>
</div>
