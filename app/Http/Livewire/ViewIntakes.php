<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Onboardings;
use Livewire\WithPagination;

class ViewIntakes extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $searchTerm = '';
    public $newUser;

    public function render()
    {

        return view('livewire.view-intakes', ['intakes' => Onboardings::OrderBy('batch_no','desc')->orderBy('created_at','desc')
                                    ->where('batch_no','like', '%' . $this->searchTerm . '%')
                                    ->orWhere('first_name','like', '%' . $this->searchTerm . '%')
                                    ->orWhere('last_name','like', '%' . $this->searchTerm . '%')
                                    ->orWhere('campaign','like', '%' . $this->searchTerm . '%')
                                    ->paginate(10)]);
    }

    public function showModal($id)
    {

        $this->newUser = Onboardings::where('id',$id)->first();

    }

    public function complete($id)
    {
        Onboardings::find($id)->update(['completed' => 1]);
    }

}
