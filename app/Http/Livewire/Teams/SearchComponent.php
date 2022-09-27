<?php

namespace App\Http\Livewire\Teams;

use Livewire\Component;
use App\Models\User;
use App\Models\NewStarters;

class SearchComponent extends Component
{
    public $showing;
    public $startDate;
    public $starters = [];
    public $results = false;
    public $searchTerm;



    public function mount()
    {
        return view('livewire.teams.search-component');
    }
    public function render()
    {

        if($this->searchTerm == '')
        {
            $newStarters = [];
            $this->results = false;
        }
        else
        {
            $newStarters = User::where('name','like','%' . $this->searchTerm . '%')->orderBy('name')->limit(10)->get();
            $this->results = true;
        }



        return view('livewire.teams.search-component', ['new' => $newStarters]);
    }

    public function addStarter($id)
    {
        $data = ['team_id' => $this->showing,
                'user_id' => $id,
                'start_date' => $this->startDate

    ];
        Newstarters::create($data);
        $this->results = false;

        $this->showSearch = false;
        $this->reset('searchTerm');
        $this->emit('reRenderParent');
        $this->emit('renderStats');
        $this->emit('reRenderButtons',$this->showing);

        $message = ['text' =>  'Updated','type' => 'success'];
        $this->emit('toast', $message);
    }

    public function test()
    {
        if(strlen($this->searchTerm > 0))
        {
        $data = ['team_id' => $this->showing,
                'user_id' => rand(-5000,-1),
                'name' => $this->searchTerm,
                'start_date' => $this->startDate
        ];

        NewStarters::create($data);

        $this->showInput = false;
        $this->reset('searchTerm');
        $this->emit('reRenderParent');

        $message = ['text' =>  'Updated','type' => 'success'];
        $this->emit('toast', $message);
        }
    }
}
