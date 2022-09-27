<?php

namespace App\Http\Livewire\Offboarding;

use Livewire\Component;
use App\Models\Offboarding;



class ButtonOffboarding extends Component
{
    public $offboardId;

    public function render()
    {
        return view('livewire.offboarding.button-offboarding');
    }

    public function delete($offboardId)
    {


        $row = Offboarding::where('id', $offboardId)->first();
        $rowId = $row->id;

        $deleted = Offboarding::where('id', $offboardId)->delete();

        if($deleted)
        {
            $message = ['text' =>  'Entry removed','type' => 'success'];
            $this->emit('toast', $message);
            $this->dispatchBrowserEvent('deleteRow', ['rowId' => $rowId]);
        }
        else
        {
            $message = ['text' =>  'There was a problem','type' => 'error'];
            $this->emit('toast', $message);
        }


    }
/*
    public function approve($userId)
    {
        $entry = Offboarding::where('user_id',$userId)->first();
        $rowId = $entry->id;
        $entry->actioned = 1;
        $entry->save();

        $message = ['text' =>  'Updated','type' => 'success'];
        $this->emit('toast', $message);
        $this->dispatchBrowserEvent('updateRow', ['rowId' => $rowId]);

    } */
}
