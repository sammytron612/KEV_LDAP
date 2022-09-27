<div>
    <div wire:loading.remove>
        <button wire:click="createWP({{$userId}})" class="btn btn-primary">Create</button>
    </div>
    <div wire:loading>
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</div>
