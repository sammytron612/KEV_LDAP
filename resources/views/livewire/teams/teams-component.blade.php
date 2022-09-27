<div x-data="{show: @entangle('showInput')}" class="w-100 mx-auto">
    <table class="table table-bordered table-sm table-hover text-left">
        <thead>
            <tr>
                <th class="h6 bg-success text-white pb-1 text-center"><h5>Team {{$manager->User->name}}<h5></th>
                <th style="width:10px; vertical-align: middle;" class="text-center text-primary hov align-item" x-on:click="show = !show">+</th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $member)
                <tr>
                    @if($member->name)
                        <td class="bg-white">{{$member->name}}
                    @else
                        <td class="bg-white">{{$member->User->name}}</td>
                    @endif
                    <td class="bg-white">
                        <a wire:click="deleteMember({{$member->user_id}})" class="hov text-danger fas fa-trash"></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div x-show="show" x-transition @click.away="show = false">
        <div x-data="{ open: false }" class="">
            <label class="font-weight-bold">New team member</label></td>
            <div style="poition:relative" class="w-100">

                <input id="members" @click="open=true" wire:model="searchTerm" @click.away="$wire.clearSearch()" type="text" class="form-control w-100" value="" id="popup-reference" placeholder="Search..." aria-label="Search" autocomplete="off" required>

            </div>

            <div x-transition x-show="open" @click.away="open = false" style="z-index:99;max-height:200px; height:auto;overflow-y:scroll;" class="shadow w-100" id="popup">
                @foreach($newMembers as $newMember)
                    <button id="{{$newMember->id}}" onclick="handleClick(this.id);open=false" class="list-group-item list-group-item-action" aria-current="true">
                <b>{{$newMember->name}}</b></button>
                @endforeach
            </div>
        </div>
    </div>

    <br>
<script>
    function handleClick(e) {
        @this.call('newMember',e)
    }

</script>
</div>
