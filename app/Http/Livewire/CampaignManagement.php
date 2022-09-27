<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Campaign;
use Livewire\WithPagination;



class CampaignManagement extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $campaignId = 0;
    public $title;
    public $editMode = false;

    protected $rules = [
        'title' => 'required',
    ];

    protected $listeners = [
        'updateTable' => 'refreshTable',
        'editEntry' => 'edit'
    ];



    public function render()
    {

        $campaigns = Campaign::orderBy('site')->orderBy('title')->paginate(15);
        return view('livewire.campaign-management',['campaigns' => $campaigns]);
    }


    public function refreshTable()
    {
        $campaigns = Campaign::orderBy('site','asc')->orderBy('title')->paginate(15);
    }

    public function edit($campaignId)
    {
        $campaign = Campaign::find($campaignId);

        $this->campaignId = $campaignId;
        $this->title = $campaign->title;

        $this->editMode = true;


    }
    public function newCampaign()
    {
        $this->validate();

        $data = ['title' => $this->title,

    ];

        Campaign::create($data);
        $message = ['text' =>  'Added','type' => 'success'];
        $this->emit('toast', $message);
        $this->reset();
    }

    public function updateCampaign()
    {

        $this->validate();

        $campaign = Campaign::find($this->campaignId);
        $campaign->title = $this->title;
        $campaign->site = $this->site;
        $campaign->template = $this->template;
        $campaign->save();

        $message = ['text' =>  'Updated','type' => 'success'];
        $this->emit('toast', $message);
        $this->reset();
        $this->editMode = false;

    }


}

