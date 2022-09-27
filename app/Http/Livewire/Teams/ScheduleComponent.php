<?php

namespace App\Http\Livewire\Teams;

use Livewire\Component;
use App\Models\NewStarters;


class ScheduleComponent extends Component
{
    public $showing;
    public $starters = [];
    public $newUsers = [];
    public $searchTerm;
    public $chosenStarter;
    public $StartDate;





    protected $listeners = ['changeTeam','reRenderParent'];


    public function mount()
    {

        $dates = NewStarters::distinct()->where('team_id',$this->showing)->orderBy('start_date')->get(['start_date']);

        foreach($dates as $date)
        {
            $this->starters[] = NewStarters::where('team_id', $this->showing)->where('start_date', $date->start_date)->orderBy('user_id')->get();
        }



        return view('livewire.teams.schedule-component');
    }

    public function changeTeam($teamId)
    {
        $this->showing = $teamId;
        $this->reset('starters');
        $this->mount();
    }

    public function deleteMember($id, $start_date)
    {

        NewStarters::find($id)->delete();

        $count = NewStarters::where('team_id', $this->showing)->where('start_date',$start_date)->count();

        if($count == 1)
        {
            NewStarters::where('team_id', $this->showing)->where('start_date',$start_date)->delete();


        }

        $this->starters = [];

        $dates = NewStarters::distinct()->where('team_id',$this->showing)->orderBy('start_date')->get(['start_date']);

        foreach($dates as $date)
        {
            $this->starters[] = NewStarters::where('team_id', $this->showing)->where('start_date', $date->start_date)->get();
        }

        $this->emit('renderStats');
        $this->emit('reRenderButtons', $this->showing);

        $message = ['text' =>  'Updated','type' => 'success'];
        $this->emit('toast', $message);



    }

    public function reRenderParent()
    {

        $this->starters = [];
        $this->mount();
        $message = ['text' =>  'Updated','type' => 'success'];
        $this->emit('toast', $message);
    }

}
