<div>
    <h2 class="ml-2 text-eco-blue">Site settings</h2>

    <div class="form-check form-switch px-5 mt-5">
        <input class="form-check-input" type="checkbox" wire:model="notifications" type="checkbox" id="notify" @if(!(session('notifications'))) @else checked @endif/>
        <label class="ml-3 form-check-label" for="notify"><h4 class="text-eco-blue">Disable email notifications (only to be used for purposes of testing)</h4></label>
    </div>
    <div class="form-check form-switch px-5 mt-3">
        <input class="form-check-input" type="checkbox" type="checkbox" id="slider2" />
        <label class="ml-3 form-check-label" for="slider2"><h4 class="text-eco-blue">Setting 1</h4></label>
    </div>
    <div class="form-check form-switch px-5 mt-3">
        <input class="form-check-input" type="checkbox"  type="checkbox" id="slider3" />
        <label class="ml-3 form-check-label" for="slider3"><h4 class="text-eco-blue">Setting 2</h4></label>
    </div>
    <div class="form-check form-switch px-5 mt-3">
        <input class="form-check-input" type="checkbox"  type="checkbox" id="slider4" />
        <label class="ml-3 form-check-label" for="slider4"><h4 class="text-eco-blue">Setting 3</h4></label>
    </div>

</div>
