<?php

namespace App\Http\Livewire\Teams;

use Livewire\Component;
use App\Models\Teams;
use App\Models\TeamMembers;
use App\Models\User;
use App\Models\NewStarters;

class TeamsComponent extends Component
{
    public $showing;
    public $showInput = false;
    public $manager;
    public $newMembers = [];
    public $searchTerm;
    public $chosenMember;
    public $StartDate;
    public $members;


    protected $listeners = ['changeTeam','deleteTeam'];

    public function mount()
    {

        $this->manager = Teams::find($this->showing);
        $this->members = TeamMembers::where('team_id', $this->showing)->get();


        return view('livewire.teams.teams-component');
    }

    public function render()
    {
        $this->manager = Teams::find($this->showing);
        $this->members = TeamMembers::where('team_id', $this->showing)->get();

        if($this->searchTerm == '')
        {
            $this->newMembers = [];
        }
        else
        {
            $search = '%' . $this->searchTerm . '%';
            $this->newMembers = User::where('name','like',$search)->orderBy('name')->limit(10)->get();

        }

        return view('livewire.teams.teams-component');

    }

    public function changeTeam($teamId)
    {
        $this->showing = $teamId;
    }

    public function userSearch($search)
    {
        //dd($search);

        if($search == '')
        {
            $this->newMembers = [];
        }
        else
        {
            $search = '%' . $search . '%';
            $this->newMembers = User::where('name','like',$search)->orderBy('name')->limit(10)->get();
        }

    }

    public function newMember($member)
    {
        $data = ['team_id' => $this->showing,
                'user_id' => $member
        ];

        TeamMembers::create($data);
        $this->showInput = false;

        $this->emit('renderStats');
        $this->emit('reRenderButtons', $this->showing);
        $this->clearSearch();
        $this->render();

    }

    public function deleteMember($id)
    {

        TeamMembers::where('team_id',$this->showing)->where('user_id',$id)->delete();

        $this->emit('renderStats');
        $this->emit('reRenderButtons', $this->showing);
        $this->render();

        $message = ['text' =>  'Updated','type' => 'success'];
        $this->emit('toast', $message);
    }

    public function clearSearch()
    {
        $this->reset('newMembers');
        $this->reset('searchTerm');

    }

    public function deleteTeam($id)
    {

        TeamMembers::where('team_id',$id)->delete();

        Newstarters::where('team_id',$id)->delete();

        Teams::where('id',$id)->delete();
        return redirect()->to('/teams');
        //$this->emit('reRenderButtons', 32);

    }

}
