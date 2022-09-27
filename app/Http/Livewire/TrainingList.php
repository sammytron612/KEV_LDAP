<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Lessons;


class TrainingList extends Component
{

    public $lessons = [];
    public $module_no = 0;

    protected $listeners = ['showlList' => 'showList'];

    public function reorder($orderIds)
    {
        $i = 1;
        foreach($orderIds as $id)
        {
            Lessons::find($id)->update(['order' => $i]);
            $i ++;
        }

    }

    public function showList($module)
    {
        $this->lessons = Lessons::where('module_id',$module)->get();

        //dd($trainingModule->lessons);
        //$this->lessons = $trainingModule->with('lessons');
        //dd($this->lessons);

        //return view('livewire.training-list');
    }

    public function render()
    {
        return view('livewire.training-list');
    }
}
