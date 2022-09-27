<?php

namespace App\Http\Livewire\It;

use Livewire\Component;
use App\Models\Offboarding;
use App\Models\Onboardings;
use Livewire\WithPagination;

class ItOffBoarding extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $searchTerm;

    public function render()
    {
        if($this->searchTerm)
        {
            $search = '%' . $this->searchTerm . '%';
        }
        else
        {
            $search = '%';
        }

        $offboardings = offboarding::with('usersTrashed')
            ->orderBy('leave_date','desc')
            ->orderBy('completed','desc')->paginate(40000);

        return view('livewire.it.it-off-boarding',['offboardings' => $offboardings]);
    }

    public function delete(offboarding $offboarding)
    {

        $offboarding->delete();
        $message = ['text' =>  'Deleted','type' => 'success'];
        $this->emit('toast', $message);

    }
}
