<div>
    <div class="btn-group dropleft">
        <button type="button" class="btn btn-teal btn-sm pr-3 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Action
        </button>
        <div class="dropdown-menu text-center">
            <a href="javascript:void[0]"  data-toggle="modal" data-target="#modelId" class="text-primary text-decoration-none"  wire:click="editIntake({{$intakeId}})">View/Edit</a>
            <div class="dropdown-divider"></div>
            <a onclick="confirm('Are you sure you want to remove this?') || event.stopImmediatePropagation()" href="javascript:void[0]" class="text-danger text-decoration-none"  wire:click="deleteIntake({{$intakeId}})">Delete</a>
        </div>
    </div>
</div>

