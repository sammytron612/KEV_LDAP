<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Onboardings;
use Carbon\Carbon;


class OnboardingEdit extends Component
{
    protected $listeners = [
        'updateModal' => 'populateModal',
    ];


    public $m_intakeId;
    public $m_first_name;
    public $m_site;
    public $m_last_name;
    public $m_telephone;
    public $m_email;
    public $m_internet_provider;
    public $m_setup_location;
    public $m_equipment_collection;
    public $m_ethernet_cable;
    public $m_notes;
    public $today;
    public $intakeId;

    public function mount()
    {

        $this->today = Carbon::tomorrow()->format('Y-m-d');
    }

    public function render()
    {
        return view('livewire.onboarding-edit');
    }

    public function populateModal($intakeId)
    {
        $intake = Onboardings::where('id',$intakeId)->first();

        $this->m_intakeId = $intakeId;
        $this->m_first_name = $intake->first_name;
        $this->m_last_name = $intake->last_name;
        $this->m_telephone = $intake->telephone;
        $this->m_email = $intake->email;
        $this->m_internet_provider = $intake->internet_provider;
        $this->m_setup_location = $intake->setup_location;
        $this->m_equipment_collection = $intake->equipment_collection;
        $this->m_ethernet_cable = $intake->ethernet_cable;
        $this->m_notes = $intake->notes;
        $this->today = Carbon::tomorrow()->format('Y-m-d');



    }

    public function save()
    {
        $intake = Onboardings::where('id',$this->m_intakeId)->first();

        $intake->first_name = $this->m_first_name;
        $intake->last_name = $this->m_last_name;
        $intake->telephone = $this->m_telephone;
        $intake->email = $this->m_email;
        $intake->internet_provider = $this->m_internet_provider;
        $intake->setup_location = $this->m_setup_location;
        $intake->equipment_collection = $this->m_equipment_collection;
        $intake->ethernet_cable = $this->m_ethernet_cable;
        $intake->notes = $this->m_notes;

        $intake->save();
        $message = ['text' =>  'Updated','type' => 'success'];
        $this->emit('toast', $message);

        $this->emit('updateTable',$intake->batch_no);

    }

}
