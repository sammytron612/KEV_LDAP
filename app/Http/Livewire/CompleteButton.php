<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Onboardings;

class CompleteButton extends Component
{

    public $completed;
    public $onboarding;


    public function render()
    {

        return view('livewire.complete-button');
    }

    public function CompleteToggle(Onboardings $onboarding)
    {

        if($this->completed == 0)
        {
            $this->completed = 1;
        }
        elseif($this->completed == 1)
        {
            $this->completed = 0;
        }

       $onboarding->completed = $this->completed;
       $onboarding->save();

       return;

    }
}
