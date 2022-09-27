<?php

namespace App\Http\Livewire\Teams;

use Livewire\Component;
use App\Models\NewStarters;

class IntakeComponent extends Component
{
    public $showing;
    public $StartDate;

    protected $listeners = ['changeTeam'];

    public function render()
    {
        return view('livewire.teams.intake-component');
    }

    public function updatedStartDate()
    {
        $data = ['team_id' => $this->showing,
                'user_id' => 0,
                'start_date' => $this->StartDate
    ];

        NewStarters::create($data);


        $this->emit('reRenderParent');

        $this->reset('StartDate');
        $message = ['text' =>  'Updated','type' => 'success'];
        $this->emit('toast', $message);


    }

    public function changeTeam($id)
    {
        $this->showing = $id;

    }
}
