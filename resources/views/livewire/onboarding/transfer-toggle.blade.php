<div>
    <label class="font-weight-bold">Transfer:</label><span class="font-italic">&nbsp @if($internalTransfer) <span class="h4 text-danger">Yes</span> @else No @endif</span>
    <span wire:loading.remove>
        <button wire:click="toggle({{$onboardId}})" class="btn py-0 btn-primary btn-sm">Toggle</button>
    </span>
    <div wire:loading>
        <div class="ml-3 spinner-border spinner-border-sm text-primary" role="status">
        </div>
    </div>
</div>
