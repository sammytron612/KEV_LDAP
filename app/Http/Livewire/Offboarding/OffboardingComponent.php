<?php

namespace App\Http\Livewire\Offboarding;

use App\Models\User;
use Livewire\WithPagination;
use Livewire\Component;
use Carbon\Carbon;
use App\Models\Offboarding;
use App\Http\Helpers\Offboard;
use App\Http\Traits\RemovePlannerEntry;
use Auth;

class OffboardingComponent extends Component
{
    use RemovePlannerEntry;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $user;
    public $leaveDate;
    public $domain;
    public $userName;
    public $selected = false;
    public $searchTerm = '';
    public $immediate;
    public $today;

    protected $rules = [
        'leaveDate' => 'required',
    ];



    public function render()
    {
        $this->today = Carbon::today()->format('Y-m-d');

        $exempt = [''];

        if($this->searchTerm)
        {

            $users = User::select('id','name','username','domain')->where('name','like', '%' . $this->searchTerm . '%')
                            ->whereNotin('name', $exempt)
                            ->orderBy('name')->limit(30)
                            ->get();

        }
        else
        {
        $users = [];
        }


        return view('livewire.offboarding.offboarding-component', ['users' => $users]);

    }

    public function selectedUser(User $user)
    {
        $this->user = $user;

        $this->selected = true;
    }

    public function offBoard()
    {


        $validatedData = $this->validate([
            'leaveDate' => 'required',

        ]);

        $leaving = new Offboarding;
        $leaving->user_id = $this->user->id;
        $leaving->leave_date = $this->leaveDate;
        $leaving->domain = $this->user->domain;
        $leaving->type = 'AD';
        $leaving->actioned = 1;
        $leaving->submitted_by = Auth::user()->id;
        $leaving->name = $this->user->name;
        $leaving->save();

        if($this->immediate)
        {
            $this->PlannerRemove($leaving->user_id);
            $offboard = new Offboard;
            $offboard->immediate($leaving->user_id);
        }


        $message = ['text' =>  'Updated','type' => 'success'];
        $this->emit('toast', $message);

        $this->reset();
        $this->dispatchBrowserEvent('modal');
        $this->reset('leaveDate');

    }

    public function updatedImmediate()
    {
        $this->leaveDate = Carbon::today()->format('Y-m-d');
    }

}
