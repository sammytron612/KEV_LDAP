<div>
    <div x-data="{showInput:true}" >
        <label class="font-weight-bold">New intake</label>
        <div style="poition:relative" class="input-group flex-nowrap" >
            <span class="input-group-text" id="addon-wrapping">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg>
            </span>
            <div class="w-100" @click.away="$wire.test()">
                <input wire:model="searchTerm" type="text" class="form-control"  placeholder="Search..." aria-label="Search" autocomplete="off" required>
                <div x-cloak x-transition.duration.750ms style="z-index:99;max-height:200px; height:auto;overflow-y:scroll;margin-bottom:5%;" class="position-absolute list-group shadow w-100" id="popup">

                    @foreach($new as $newStarter)
                        <button id="{{$newStarter->id}}" x-on:click="showInput = false" wire:click="addStarter({{$newStarter->id}})" type="button" class="list-group-item list-group-item-action" aria-current="true">
                    <b>{{$newStarter->name}}</b></button>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
