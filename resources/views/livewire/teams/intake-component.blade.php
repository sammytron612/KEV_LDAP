<div>
    <div x-data="{dateShow: false,
        buttonShow: true
        }">
        <div @click.away="buttonShow=true; dateShow=false" x-cloak x-transition.duration.750ms x-show="dateShow">
            <label><h4>Choose a start date</h4></label>
            <input wire:model.lazy="StartDate" class="mx-auto w-100 form-control" type="date">
        </div>
        <div x-transition.duration.750ms x-show="buttonShow" x-on:click="dateShow = !dateShow; buttonShow = !buttonShow">
            <button class="btn btn-primary rounded-0">New intake group for current team</button>
        </div>
    </div>
</div>
