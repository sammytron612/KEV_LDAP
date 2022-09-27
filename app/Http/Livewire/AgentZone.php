<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\AgentLinks;

class AgentZone extends Component
{
    public $campaign = 0;
    public $campaignLinks = [];

    public function render()
    {
        return view('livewire.agent-zone');
    }

    public function select()
    {

        $campaign = $this->campaign;
        $this->campaignLinks = AgentLinks::whereIn('campaign_id',['99',$campaign])->get();

    }

}
