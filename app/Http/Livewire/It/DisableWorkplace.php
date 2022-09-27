<?php

namespace App\Http\Livewire\It;

use Livewire\Component;
use App\Models\workplace as localWP;
use App\Http\Helpers\Workplace;
use Illuminate\Support\Facades\Notification;
use App\Notifications\DisableWorkplaceSuccess;
use App\Notifications\DisableWorkplaceFailure;
use App\Http\Helpers\NotificationEmails;
use Carbon\Carbon;
use Auth;
use App\Models\Offboarding;

use Livewire\WithPagination;

class DisableWorkplace extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $searchTerm;
    public $selected = false;
    public $immediate;
    public $today;
    public $leaveDate;
    public $user;

    protected $rules = [
        'leaveDate' => 'required',
    ];

    public function render()
    {

        $this->today = Carbon::today()->format('Y-m-d');

        if($this->searchTerm)
            {
                $searchTerm = '%' . $this->searchTerm . '%';
                $exempt = [''];

                $wps = localWP::where('name', 'like', $searchTerm)
                    ->whereNotin('name',$exempt)
                    ->limit(30)->get();
            }
            else
            {
            $wps = [];
            }

        return view('livewire.it.disable-workplace',['wps' => $wps]);

    }

    public function selectedUser($workplace_id)
    {
        $this->user = localWP::where('workplace_id',$workplace_id)->first();
        $this->selected = true;
    }

    public function disableUser()
    {

        //$wplace = localWP::where('workplace_id', $this->user->workplace_id)->first();

        if($this->immediate)
        {

            $wp = new Workplace;
            $response = $wp->disableWP($this->user->workplace_id);

            $data = ['user_id' => 999,
                    'workplace_id' => $this->user->workplace_id,
                    'name' => $this->user->name,
                    'type' => 'WP',
                    'domain' => 'na',
                    'submitted_by' => Auth::user()->id,
                    'leave_date' => $this->leaveDate,
                    'completed' => now(),
                    'actioned' => 1
                ];


            Offboarding::create($data);

            localWP::where('workplace_id', $this->user->workplace_id)->delete();

            $data = ['name' => $this->user->name,
                    'requestor' => Auth::user()->name,
        ];

            if($response->successful())
            {

                $message = ['text' =>  'Success','type' => 'success'];
                $this->emit('toast', $message);


                if(NotificationEmails::emailOn())
                {
                    Notification::route('mail', [''])
                        ->notify(new DisableWorkplaceSuccess($data));
                }


            }
                else
            {
                $message = ['text' =>  'OOPs the was a problem!','type' => 'error'];
                $this->emit('toast', $message);

                if(NotificationEmails::emailOn())
                {
                    Notification::route('mail', [''])
                        ->notify(new DisableWorkplaceFailure($data));
                }

            }

        }
        else
        {

            $validatedData = $this->validate([
                'leaveDate' => 'required',

            ]);

            $data = ['user_id' => 999,
                    'workplace_id' => $this->user->workplace_id,
                    'name' => $this->user->name,
                    'type' => 'WP',
                    'domain' => 'na',
                    'submitted_by' => Auth::user()->id,
                    'leave_date' => $this->leaveDate,
                    'actioned' => 1
                ];

            $response = Offboarding::create($data);

            if($response)
            {

                $message = ['text' =>  'Success','type' => 'success'];
                $this->emit('toast', $message);
            }
            else
            {
                $message = ['text' =>  'OOPs the was a problem!','type' => 'error'];
                $this->emit('toast', $message);
            }

        }

        $this->selected = False;
        $this->reset('immediate');
        $this->reset('leaveDate');
        $this->reset('searchTerm');

        return;

    }

    public function updatedImmediate()
    {
        $this->leaveDate = Carbon::today()->format('Y-m-d');
    }
}
