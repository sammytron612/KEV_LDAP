<?php

namespace App\Http\Livewire\Returns;

use Livewire\Component;
use App\Models\Returns;
use App\Notifications\ReturnAccepted;
use App\Notifications\ReturnRejected;
use App\Notifications\ReturnCompleted;
use Livewire\WithPagination;
use App\Http\Helpers\NotificationEmails;
use Illuminate\Support\Facades\Notification;


class ShowReturns extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $searchTerm;
    public $return_id;
    public $show = false;
    public $view_name;
    public $view_email;
    public $view_date;
    public $view_campaign;
    public $view_notes;
    public $it_notes;


    public function render()
    {
        if ($this->searchTerm != '')
        {
            $searchTerm = '%' . $this->searchTerm . '%';

        }
        else
        {
            $searchTerm = '%';

        }

        $returns = Returns::where('name','like',$searchTerm)
                    ->orderBy('actioned','asc')
                    ->orderByRaw("CONVERT(DATETIME,date_time,103) ASC")
                    ->paginate(10);


        return view('livewire.returns.show-returns', ['returns' => $returns]);

    }

    public function view($id)
    {

        $return = Returns::find($id);

        $this->view_name = $return->name;
        $this->view_email = $return->email;
        $this->view_date = $return->date_time;
        $this->view_campaign = $return->campaign;
        $this->view_notes = $return->notes;
        $this->return_id = $id;
        $this->show = true;

        return;
    }

    public function approve()
    {
        if($this->it_notes == ''){$this->it_notes == "None";}

        $return = Returns::find($this->return_id);
        $return->actioned = 1;
        $return->it_notes = $this->it_notes;
        $return->save();

        $this->show = false;

        if($this->it_notes == ''){$this->it_notes == "None";}

        $data = ['name' => $this->view_name,
                'date_time' => $this->view_date,
                'it_notes' => $this->it_notes
    ];


        if(NotificationEmails::emailOn())
        {
        Notification::route('mail', [$return->email])
            ->notify(new ReturnAccepted($data));
        }


        $message = ['text' =>  'Email sent','type' => 'success'];
        $this->emit('toast', $message);

        return;
    }

    public function reject($id)
    {

        $return = Returns::find($id);

        $data = ['name' => $return->name,
                'date_time' => $return->date_time,
                'it_notes' => $this->it_notes

    ];

        if(NotificationEmails::emailOn())
        {
        Notification::route('mail', [$return->email])
            ->notify(new ReturnRejected($data));
        }



        $message = ['text' =>  'Email sent','type' => 'success'];
        $this->emit('toast', $message);

        $return->delete();
        $this->show = false;

        return;
    }

    public function complete($id)
    {
        $return = Returns::find($id);
        $return->actioned = 2;
        $return->date_returned = now();
        $return->save();

        $data = ['name' => $return->name];

        if(NotificationEmails::emailOn())
            {
            Notification::route('mail', [$return->email])
                ->notify(new ReturnCompleted($data));
            }


        $message = ['text' =>  'Email sent','type' => 'success'];
        $this->emit('toast', $message);

        return;
    }

    public function delete($id)
    {
        $message = ['text' =>  'Deleted','type' => 'success'];
        $this->emit('toast', $message);

        $return = Returns::find($id)->delete();
    }
}

