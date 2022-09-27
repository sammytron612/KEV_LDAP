<?php

namespace App\Http\Livewire\Teams;

use Livewire\Component;
use App\Models\Teams;
use App\Models\TeamMembers;
use App\Models\Newstarters;


class ButtonComponent extends Component
{
    public $showing;
    public $teams;
    public $teamCount;
    public $newStarter;



    protected $listeners = ['reRenderButtons','changeTeam'];

    public function render()
    {
        $this->teams = Teams::orderBy('id')->get();

        $this->reset('teamCount');
        $this->reset('newStarter');

        foreach($this->teams as $team){

            $this->teamCount[] = TeamMembers::where('team_id',$team->id)->count();
            $this->newStarter[] = NewStarters::where('team_id', $team->id)->where('user_id','<>',0)->count();

        }

        return view('livewire.teams.button-component');
    }

    public function reRenderButtons($showing)
    {

        $this->showing = $showing;

        $this->render();

    }

    public function changeTeam($id)
    {

        $this->showing = $id;

    }

    public function deleteTeam($id)
    {

        $this->emit('deleteTeam', $id);


    }
}
