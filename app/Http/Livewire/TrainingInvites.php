<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\TrainingModules;
use App\Models\User;
use App\Models\AssignedTraining;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TrainingInvite;
use App\Models\TrainingCategory;
use App\Http\Helpers\NotificationEmails;
use App\Services\NotificationService;


class TrainingInvites extends Component
{
    public $users = [];
    public $searchTerm;
    public $categories;
    public $selectedUsers = [];
    public $checkedModules = [];
    public $checkedCategories = [];
    public $isVisible = false;


    protected $rules = [
                            'checkedModules' => 'required',
                            'selectedUsers' => 'required'
                        ];


    public function render()
    {
        if ($this->searchTerm != '')
        {
            $searchTerm = '%' . $this->searchTerm . '%';
            $this->isVisible = true;

        }
        else
        {
            $searchTerm = '+';
            $this->isVisible = false;
        }


        $this->users = User::select('id','name','username','domain')->where('name', 'like', $searchTerm)
                    ->orderBy('name')
                    ->get();


        if(count($this->users))
            {$this->isVisible = true;}
        else
            {$this->isVisible = false;}

        $this->categories = TrainingCategory::with('modules')->get();


        return view('livewire.training-invites');
    }

    public function addUser(User $user)
    {

        $exists = false;
        foreach($this->selectedUsers as $invite)
        {
            if($invite['id'] == $user->id)
            {
                $exists = true;
                break;
            }
        }
        if(!$exists)
        {
            $this->selectedUsers[] = $user;
        }

        $this->users = Null;
        $this->searchTerm = '';
        $this->isVisible = false;

        return;

    }

    public function finish(NotificationService $NotificationService)
    {
            $this->validate();

            foreach($this->selectedUsers as $user)
            {

                $id = $user['id'];

                $userModel = User::find($id);

                AssignedTraining::where('user_id',$id)->whereIn('module_id',$this->checkedModules)->delete();

                foreach($this->checkedModules as $moduleId)
                {

                    $new = new AssignedTraining;
                    $new->user_id = $id;
                    $new->module_id = $moduleId;
                    $new->save();

                }

                if(NotificationEmails::emailOn())
                {
                    $firstName = explode(' ',$userModel->name);

                    $message = ['title' => 'A message from Jarvis!',
                                'message' => 'Hi, ' . $firstName[0] . '. You have been allocated new training. Click to be directed to Jarvis.',
                                'target_url' => 'my-training',

                ];

                    $NotificationService->SendNotification($userModel, $message);


                    if($user['email'])
                    {
                        Notification::route('mail', [$user['email']])
                            ->notify(new TrainingInvite($user));

                    }
                }
            }

        $this->selectedUsers = [];
        $this->checkedModules = [];
        $this->searchTerm = '';

        session()->flash('success', 'Training is now available to the selected users.');

        return;
    }

    public function bulkInvite()
    {

        if($this->checkedModules == [])
        {
            session()->flash('message', 'At least One module must be assigned');
            return;
        }

        $users = User::doesnthave('assigned_training')->where('domain','overwatch')->get();


        foreach($this->checkedModules as $moduleId)
            {
                foreach($users as $user)
                {

                    $new = new AssignedTraining;
                    $new->user_id = $user->id;
                    $new->module_id = $moduleId;
                    $new->save();

                }

            }


            $this->selectedUsers = [];
            $this->checkedModules = [];

            session()->flash('success', 'The selected training is now available to all.');

            return;
    }


}
