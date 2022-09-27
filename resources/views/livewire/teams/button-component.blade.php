<div>
    @foreach($teams as $team)
        @if($team->id == $showing)
        <a ondblclick="confirm('Are you sure you want to remove this team?') || event.stopImmediatePropagation()" wire:dblclick="deleteTeam({{$team->id}})" id="{{$team->id}}" href="javascript:void(0)" style="min-width:190px;width:15%;" onclick='change_team({{$team->id}},this.id)'  class="mt-2 btn btn-eco-red mr-1 pr-1 rounded-0"><span>Team</span>
            <span class="float-right badge badge-success">{{$teamCount[$loop->index]}}</span><br>
            <h5>{{$team->User->name}}<span style="font-size: 10px; position:absoulte;top:15px;" class="float-right badge badge-warning">{{$newStarter[$loop->index]}}</span></h5>
        </a>
        @else
        <a ondblclick="confirm('Are you sure you want to remove this team?') || event.stopImmediatePropagation()" wire:dblclick="deleteTeam({{$team->id}})" id="{{$team->id}}" href="javascript:void(0)" style="min-width:190px;width:15%" onclick='change_team({{$team->id}},this.id)'  class="mt-2 btn shadow btn-outline-eco-red mr-1 pr-1 rounded-0"><span>Team</span>
            <span class="float-right badge badge-success">{{$teamCount[$loop->index]}}</span><br>
            <h5>{{$team->User->name}}<span style="font-size: 10px;position:absoulte;top:15px;" class="float-right badge badge-warning">{{$newStarter[$loop->index]}}</span></h5>
        </a>
        @endif
    @endforeach
</div>
