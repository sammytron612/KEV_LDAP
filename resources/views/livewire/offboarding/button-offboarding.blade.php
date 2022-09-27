<div>
    <a onclick="confirm('Are you sure you want to remove this?') || event.stopImmediatePropagation()" class="btn btn-danger btn-sm text-center" wire:click="delete({{$offboardId}})" href="javascript:void[0]">Delete</a>
</div>
