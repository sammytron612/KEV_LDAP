<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Campaign;


class CampaignButton extends Component
{

    public $campaignId;


    public function render()
    {
        return view('livewire.campaign-button');
    }

    public function deleteCampaign()
    {
        if(Campaign::findOrFail($this->campaignId)->delete())
        {
            $this->emit('updateTable');
            $message = ['text' =>  'Removed','type' => 'success'];
            $this->emit('toast', $message);
        }
        else{
            $message = ['text' =>  'There was a problem','type' => 'error'];
            $this->emit('toast', $message);
        }
    }

    public function editCampaign()
    {
        $this->emit('editEntry',$this->campaignId);
    }
}
