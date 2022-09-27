<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\AssignedTraining;
use App\Models\Lessons;
use Auth;

class CompleteLesson extends Component
{

    public $moduleId;
    public $lessonId;

    public function render()
    {
        return view('livewire.complete-lesson');
    }

    public function completeLesson()
    {

        $user_id = Auth::user()->id;
        $completedLesson = ['lesson' => $this->lessonId,
                            'completed_date' => now()
    ];


//////check for current lesson already completed ##############


        $assigned = AssignedTraining::where('user_id', $user_id)
                                       ->where('module_id',$this->moduleId)->first();

      // dd($assigned->lessons_complete,$this->lessonId);

       if($assigned->lessons_complete)
       {

            foreach($assigned->lessons_complete as $complete)
            {

                if($complete['lesson'] == $this->lessonId){

                    $this->dispatchBrowserEvent('lessonCompleted', ['moduleId' => $this->moduleId]);
                    return redirect()->back();
                }
            }


       }


        $array = $assigned->lessons_complete;
        $array[] = $completedLesson;
        $assigned->lessons_complete = $array;
        $assigned->save();

        $no_completed = count($assigned->lessons_complete);
        $total_lessons = Lessons::where('module_id',$this->moduleId)->count();
        $pct = ($no_completed / $total_lessons) * 100;
        $assigned->completed = round($pct);

        if($total_lessons == $no_completed)
        {
            $assigned->date_completed = now();
            $assigned->save();
            $this->dispatchBrowserEvent('moduleCompleted', ['moduleComplete' => true]);
        }
        else
        {

            $assigned->save();
            $this->dispatchBrowserEvent('lessonCompleted', ['moduleId' => $this->moduleId]);
        }


    }
}
