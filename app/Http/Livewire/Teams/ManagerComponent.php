<?php

namespace App\Http\Livewire\Teams;

use Livewire\Component;
use App\Models\User;
use App\Models\Teams;

class ManagerComponent extends Component
{
    public $showing;
    public $managers;
    public $searchTerm;

    public function render()
    {

        if($this->searchTerm == '')
        {
            $this->managers = [];

        }
        else
        {
            $this->managers = User::where('name','like','%' . $this->searchTerm . '%')->orderBy('name')->limit(10)->get();

        }

        return view('livewire.teams.manager-component');
    }

    public function addManager($id)
    {
        $data = ['manager' => $id];

        Teams::create($data);

        $this->emit('reRenderButtons', $this->showing);
    }
}
