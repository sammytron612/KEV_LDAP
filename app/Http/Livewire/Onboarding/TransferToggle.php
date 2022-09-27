<?php

namespace App\Http\Livewire\Onboarding;

use Livewire\Component;
use App\Models\Onboardings;

class TransferToggle extends Component
{

    public $internalTransfer;
    public $onboardId;

    public function render()
    {
        return view('livewire.onboarding.transfer-toggle');
    }

    private function duplicateSam($sam)
    {
        if(is_numeric(substr($sam, -1)))
        {
            return true;
        }
        else
        {
            return false;
        }

    }
    public function toggle(Onboardings $onboard)
    {
        if($this->duplicateSam($onboard->sam))
        {
            $onboard->sam = substr_replace($onboard->sam, "", -1);
        }

        $this->internalTransfer = !$this->internalTransfer;
        $onboard->update(['internal_transfer' => $this->internalTransfer]);
        $onboard->save();

    }
}
