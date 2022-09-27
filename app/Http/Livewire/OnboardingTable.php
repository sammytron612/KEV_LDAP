<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Onboardings;
use App\Models\Batches;
use Livewire\WithPagination;

class OnboardingTable extends Component
{
    public $batch_no;
    public $pct;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'updateTable' => 'refreshTable',
    ];

    public function render()
    {


        $additions = Onboardings::where('batch_no',$this->batch_no)->get();

        if(count($additions))
        {
            $batch = Batches::where('batch_no', $this->batch_no)->first();
            $total = $batch->total;
            $this->pct = round((count($additions) / $total) * 100);

        }
        return view('livewire.onboarding-table', ['additions' => $additions]);
    }

    public function refreshTable($batch_no)
    {

        $this->batch_no = $batch_no;
        $additions = Onboardings::where('batch_no',$batch_no)->get();
        $batch = Batches::where('batch_no', $batch_no)->first();
        $total = $batch->total;
        $this->pct = round((count($additions) / $total) * 100);


        if(!count($additions))
        {
            $this->dispatchBrowserEvent('remove-finish');
        }
    }
}
