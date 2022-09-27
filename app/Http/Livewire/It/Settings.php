<?php

namespace App\Http\Livewire\It;

use Livewire\Component;
use Session;

class Settings extends Component
{
    public $notifications = false;

    public function mount()
    {

        $this->notifications = session('notifications');

    }

    public function render()
    {
        return view('livewire.it.settings');
    }

    public function updatedNotifications()
    {

      
        if($this->notifications)
        {
            session(['notifications' => true]);
        }
        else
        {
            session(['notifications' => false]);
        }

        $message = ['text' =>  'Updated','type' => 'success'];
        $this->emit('toast', $message);

        return;
    }



}
