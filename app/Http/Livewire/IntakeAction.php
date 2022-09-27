<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Onboardings;

class IntakeAction extends Component
{
    public $intakeId;


    public function render()
    {
        return view('livewire.intake-action');
    }

    public function deleteIntake($intakeId)
    {

        $batch = Onboardings::where('id',$intakeId)->first();
        $batch_no = $batch->batch_no;
        Onboardings::where('id', $intakeId)->delete();

        $message = ['text' =>  'Entry removed','type' => 'success'];
        $this->emit('toast', $message);
        $this->emit('updateTable',$batch_no);

    }

    public function editIntake($intakeId)
    {
        $this->emit('updateModal',$intakeId);
    }
}
