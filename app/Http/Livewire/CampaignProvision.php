<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Recruitment;
use Carbon\Carbon;
use Auth;
use App\Notifications\RecruitmentNotification;
use App\Notifications\RecruitmentUpdateNotification;
use Illuminate\Support\Facades\Notification;
use App\Models\Campaign;
use Livewire\WithPagination;
use App\Http\Helpers\NotificationEmails;

class CampaignProvision extends Component
{
    public $intake;
    public $comment;
    public $tomorrow;

    public $intakeId;
    public $campaign_id;
    public $site;
    public $intake_date;
    public $heads;
    public $webcams;
    public $headsets;
    public $date_pc_required;
    public $work_location;
    public $training_location;
    public $trainer;
    public $notes;
    public $newNote;

    public $modalCampaigns;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {

        $this->tomorrow = Carbon::tomorrow()->format('Y-m-d');
        $intakes = Recruitment::with('campaigns')->OrderBy('date_pc_required','asc')->paginate(10);

        $allCampaigns = Campaign::orderBy('site')->orderBy('title')->get();

        return view('livewire.campaign-provision', ['intakes' => $intakes, 'allCampaigns' => $allCampaigns]);
    }


    public function showModal($id)
    {


        $intake = Recruitment::where('id',$id)->first();

        $this->intakeId = $id;
        $this->campaign_id = $intake->campaign_id;
        $this->site = $intake->site;
        $this->intake_date = $intake->intake_date;
        $this->heads = $intake->heads;
        $this->webcams = $intake->webcams;
        $this->headsets = $intake->headsets;
        $this->date_pc_required = $intake->date_pc_required;
        $this->work_location = $intake->work_location;
        $this->training_location = $intake->training_location;
        $this->trainer = $intake->trainer;
        $this->notes = $intake->notes;

        $this->tomorrow = Carbon::tomorrow()->format('Y-m-d');
        $allCampaigns = Campaign::all();
        $intakes = Recruitment::with('campaigns')->OrderBy('intake_date','desc')->paginate(20);

        return view('livewire.campaign-provision', ['intakes' => $intakes, 'allCampaigns' => $allCampaigns]);
    }

    public function submit()
    {

        $data = ['campaign_id' => $this->campaign_id,
                'site' => $this->site,
                'intake_date' => $this->intake_date,
                'heads' => $this->heads,
                'webcams' => $this->webcams,
                'headsets' => $this->headsets,
                'date_pc_required' => $this->date_pc_required,
                'work_location' => $this->work_location,
                'training_location' => $this->training_location,
                'completed' => 0,
                'trainer' => $this->trainer,


    ];


        $id = Recruitment::create($data);

        if($this->notes)
        {
            $notes[] = ['notes' => $this->notes,
                        'user_id' => Auth::user()->id,
                        'date' => now()];

            $data = Recruitment::find($id->id);
            $data->notes = $notes;
            $data->save();
        }

        $this->reset();

        $data = ['recruitmentId' => $id->id,
                'userName' => Auth::user()->name
        ];

        if(NotificationEmails::emailOn())
            {

                Notification::route('mail', [''])
                    ->notify(new RecruitmentNotification($data));

        }



    }

    public function update()
    {

        $data = ['campaign_id' => $this->campaign_id,
                'site' => $this->site,
                'intake_date' => $this->intake_date,
                'heads' => $this->heads,
                'webcams' => $this->webcams,
                'headsets' => $this->headsets,
                'date_pc_required' => $this->date_pc_required,
                'work_location' => $this->work_location,
                'training_location' => $this->training_location,
                'completed' => 0,
                'trainer' => $this->trainer,


    ];


        $rec = Recruitment::find($this->intakeId)->update($data);

        if($this->newNote)
        {
            $note = ['notes' => $this->newNote,
                        'user_id' => Auth::user()->id,
                        'date' => now()];

            $data = Recruitment::find($this->intakeId);
            if($data->notes)
            {
                $array = $data->notes;
                array_push($array, $note);
            }
            else
            {
                $array[] = $note;
            }

            $data->notes = $array;
            $data->save();
        }


        $message = ['text' =>  'Updated','type' => 'success'];


        $this->dispatchBrowserEvent('closeModal', ['newName' => 1]);


        $this->emit('toast', $message);

        $data = ['recruitmentId' => $this->intakeId,
                'userName' => Auth::user()->name
        ];


            Notification::route('mail', [''])
                ->notify(new RecruitmentNotification($data));

        $this->reset();

    }


    public function clear()
    {
        $this->reset();
    }


}
