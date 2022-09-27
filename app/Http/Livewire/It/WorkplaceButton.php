<?php

namespace App\Http\Livewire\It;

use Livewire\Component;
use App\Http\Helpers\Workplace as wp;
use App\Models\Onboardings;



class WorkplaceButton extends Component
{

    public $userId;


    public function render()
    {
        return view('livewire.it.workplace-button');
    }

    public function createWP(Onboardings $user)
    {

        $wp = new wp;
        $wp->create($user);

        dd("Check for account success");

    }
}
