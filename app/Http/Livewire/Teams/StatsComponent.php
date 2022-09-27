<?php

namespace App\Http\Livewire\Teams;

use Livewire\Component;
use App\Models\TeamMembers;
use App\Models\NewStarters;

class StatsComponent extends Component
{
    public $showing;
    public $teamMembers;
    public $newStarters;

    protected $listeners = ['changeTeam','renderStats'];

    public function render()
    {
        $this->teamMembers = TeamMembers::where('team_id', $this->showing)->count();
        $this->newStarters = NewStarters::where('team_id', $this->showing)->where('user_id', '<>', 0)->count();



        return view('livewire.teams.stats-component');
    }

    public function changeTeam($id)
    {

        $this->showing = $id;

    }

    public function renderStats()
    {
        $this->render();
    }
}
