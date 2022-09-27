<?php

namespace App\Http\Livewire\It;

use Livewire\Component;
use App\Models\Batches;
use App\Models\Onboardings;


class WorkplaceTable extends Component
{
    public $batches;
    public $users;
    public $selected;

    public function mount()
    {
        $this->batches = Batches::orderBy('created_at','desc')->get();

        $this->users = Onboardings::where('batch_no',$this->batches[0]->batch_no)->get();

    }

    public function render()
    {

        return view('livewire.it.workplace-table');

    }

    public function updateCampaign()
    {
//$users = Onboardings::where('batch_no',$this->selected)->get();

        $this->users = Onboardings::where('batch_no',$this->selected)->get();


    }
}
