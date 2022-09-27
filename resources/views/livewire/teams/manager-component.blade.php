<div x-data="{show: false}" class="mx-auto">
    <div x-transition.duration.500ms @click.away="show = false" class="d-inline-block w-50 w-md-25">
        <div class="text-center">
            <button x-show="!show" x-on:click="show=true" class="mt-3 px-5 pt-2 btn btn-teal rounded-0"><h5>New team</h5></button>
        </div>
            <div x-cloak x-transition.duration.500ms class="mt-2" x-show="show">
                <input wire:model="searchTerm" type="text" class="form-control"  placeholder="Search..." aria-label="Search" autocomplete="off" required>
                <div style="z-index:99;max-height:200px; height:auto;overflow-y:scroll;margin-bottom:5%;" class="w-50 w-md-25 position-absolute list-group" id="popup">
                    @foreach($managers as $manager)
                        <button id="{{$manager->id}}" x-on:click="showInput = false" wire:click="addManager({{$manager->id}})" type="button" class="list-group-item list-group-item-action" aria-current="true">
                    <b>{{$manager->name}}</b></button>
                    @endforeach

                </div>
            </div>

    </div>
</div>
