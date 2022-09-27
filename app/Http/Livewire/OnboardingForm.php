<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Campaign;
use App\Models\Division;
use Carbon\Carbon;
use App\Models\Onboardings;
use App\Models\Batches;
use App\Models\BatchNumber;
use App\Notifications\EmailNotification;
use Illuminate\Support\Facades\Notification;
use Auth;
use App\Models\Jobtitle;
use App\Http\Helpers\NotificationEmails;
use LdapRecord\Models\ActiveDirectory\User;
use LdapRecord\Container;


class OnboardingForm extends Component
{

    public $divisions;
    public $total;
    public $campaigns;
    public $today;
    public $batch_no;
    public $first_name;
    public $last_name;
    public $email;
    public $telephone;
    public $campaign_id;
    public $division_id;
    public $job_titles;
    public $job_title;
    public $site;
    public $start_date;
    public $internet_provider;
    public $setup_location;
    public $ethernet_cable;
    public $equipment_collection;
    public $internal_transfer = 0;
    public $notes;



    protected $rules = [
        'job_title' => 'required',
        'first_name' => 'required',
        'last_name' => 'required',
        'internal_transfer' => 'required',
        'telephone' => 'required_if:internal_transfer,==,"0"',
        'email' => 'required_if:internal_transfer,==,"0"',
        'campaign_id' => 'required',
        'site' => 'required',
        'start_date' => 'required',
        'division_id' => 'required',
        'job_title' => 'required'

    ];


    public function mount()
    {
        $this->today = Carbon::tomorrow()->format('Y-m-d');
        $this->job_titles = Jobtitle::orderBy('job_title')->get();

        if($this->batch_no > 0)
        {
            $batch = Batches::where('batch_no', $this->batch_no)->first();
            $this->campaigns = Campaign::where('id', $batch->campaign_id)->get();
            $this->campaign_id = $batch->campaign_id;
            $this->divisions = Division::where('id', $batch->division_id)->get();
            $this->division_id = $batch->division_id;
            $this->site = $batch->site;
            $this->start_date = $batch->start_date;
            $job_id = Onboardings::where('batch_no', $this->batch_no)->first();
            $this->job_title = $job_id->job_title;


        } else
        {
            $this->campaigns = Campaign::orderBy('title')->get();
            $this->divisions = Division::orderBy('title')->get();
        }

        return view('livewire.onboarding-form');
    }

    public function render()
    {
        return view('livewire.onboarding-form');
    }



    private function prepareSam($first_name, $last_name)
    {

        $sam_last_name = str_replace(array('\'', '`'), '', $last_name);

        $temp = explode(' ',$first_name);

        $sam_first_name = $temp[0];

        $str = str_replace(' ','',$sam_first_name) . '.' . str_replace(' ','',$sam_last_name);
        $sam = substr($str,0,20);



        $domain = Container::getConnection($domain);
        container::addConnection($domain);
        $user = User::findBy('samaccountname', $sam);


        if($user) ## samAccount exists ###
        {

            $length = strlen($sam);
            if($length < 20)
            {

                $sam = $sam . rand(1,9);

            }
            else
            {
                $sam = substr_replace($sam ,rand(1,9),-1,1);
            }
        }

        return $sam;
    }



    public function save()
    {

        $this->validate();

        if($this->batch_no == -1)
        {

            $batch_number = BatchNumber::find(1);
            $this->batch_no = $batch_number->batch_no;

            $data = ['batch_no' => $this->batch_no,
                    'user_id' => Auth::user()->id,
                    'campaign_id' => $this->campaign_id,
                    'start_date' => $this->start_date,
                    'site' => $this->site,
                    'total' => $this->total,
                    'completed' => 0,
                    'division_id' => $this->division_id

            ];

            $result = Batches::create($data);

            if($result)
            {
                $batch_number->batch_no ++;
                $batch_number->save();

                $data += ['user_name' => Auth::user()->name];
                $data += ['word' => 'started'];

            }
            else
            {
                $message = ['text' =>  'There was a problem!','type' => 'error'];
                $this->emit('toast', $message);
                return;
            }

            if(NotificationEmails::emailOn())
            {
                if($this->site == "sheffield")
                {

                Notification::route('mail', [''])
                    ->notify(new EmailNotification($data));

                }
                else
                {

                Notification::route('mail', [''])
                    ->notify(new EmailNotification($data));
                }
            }

        }

        $first_name =  trim($this->first_name, ' ');
        $last_name =  trim($this->last_name, ' ');

        $email =  str_replace(' ', '', $this->email);

        $sam = $this->prepareSam($first_name, $last_name);



        if($this->internal_transfer)
        {
            $this->telephone = 'na';
            $email = 'na';
        }

        $data = [
                'first_name' => $first_name,
                'last_name' =>  $last_name,
                'telephone' => $this->telephone,
                'campaign_id' => $this->campaign_id,
                'division' => $this->division_id,
                'site' => $this->site,
                'email' => $email,
                'start_date' => $this->start_date,
                'job_title' => $this->job_title,
                'internet_provider' => $this->internet_provider,
                'setup_location' => $this->setup_location,
                'equipment_collection' => $this->equipment_collection,
                'ethernet_cable' => $this->ethernet_cable,
                'batch_no' => $this->batch_no,
                'assigned_to' => Auth::user()->id,
                'sam' => $sam,
                'internal_transfer' => $this->internal_transfer,
                'notes' => $this->notes

    ];

    $result = Onboardings::create($data);

    if($result)
        {
            $message = ['text' =>  'Updated','type' => 'success'];
            $this->emit('toast', $message);
        } else
        {
            $message = ['text' =>  'There was a problem!','type' => 'error'];
            $this->emit('toast', $message);
        }


    $this->reset('first_name');
    $this->reset('last_name');
    $this->reset('telephone');
    $this->reset('email');
    $this->reset('internet_provider');
    $this->reset('setup_location');
    $this->reset('ethernet_cable');
    $this->reset('internal_transfer');
    $this->reset('notes');

    $this->emit('updateTable',$this->batch_no);

    }
}
