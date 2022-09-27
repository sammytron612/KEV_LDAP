<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use App\Models\workplace;



class UserCompliance extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $searchTerm;
    public $filter = 0;
    public $siteFilter ='%';
    private $operator;



    public function render()
    {


        if($this->filter == 0)
        {
            $operator = '<=';
        }
        elseif($this->filter == 1)
        {
            $operator = '=';
        }
        elseif($this->filter == 2)
        {
            $operator = '<';
        }


        ######THIS QUERY SHOWS ALL #########

        ##### USE THIS QUERY AS A GUIDE TO DLETE USERS (BLANK WP MAYBE ABLE TO DELETE ???)

       /* $users = User::with('workplaces')->whereHas('assigned_training', function($query) use ($operator) {
            return $query->where('completed',$operator,100);})->with('workplaces', function($query)
                    {
                        $query->where('site','like','%'.$this->siteFilter .'%');
                    })
                ->where('name','like','%'.$this->searchTerm .'%')
                ->orderBy('name')->paginate(40);*/

        $users = User::whereHas('workplaces')->whereHas('assigned_training', function($query) use ($operator) {
            return $query->where('completed',$operator,100);})->with('workplaces', function($query)
                    {
                        $query->where('site','like','%'.$this->siteFilter .'%');
                    })
                ->where('name','like','%'.$this->searchTerm .'%')
                ->orderBy('name')->paginate(40);




//$users = Workplace::whereHas('users')->paginate(40);


        return view('livewire.user-compliance', ['users' => $users]);
    }

    public function updatingSearchterm()
    {
        $this->resetPage();
    }

    public function updatingFilter()
    {

        $this->resetPage();
    }


}
