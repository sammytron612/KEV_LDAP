<div class="mb-2">
    <div wire:loading.remove>
        @if($completed)
            <button wire:click="CompleteToggle({{$onboarding}})" class="btn btn-success btn-sm pt-0 pb-1 px-1">Mark as not Complete</button>
        @else
            <button wire:click="CompleteToggle({{$onboarding}})" class="btn btn-danger btn-sm pt-0 pb-1 px-1">Mark as Complete</button>
        @endif
    </div>
    <div wire:loading>
        <div class="ml-5 spinner-border spinner-border-sm text-primary" role="status">
        </div>
    </div>
</div>
