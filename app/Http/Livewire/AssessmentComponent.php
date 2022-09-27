<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Assessments;

class AssessmentComponent extends Component
{

    public $moduleId;
    public $total = 5;

    public $questions = [];
    public $answers = [];
    public $goBack = false;



    public function render()
    {
        return view('livewire.assessment-component');
    }

    public function save()
    {


        for($i = 0; $i < $this->total ; $i++)
        {
            unset($data);
            for($l = 0; $l <= 3; $l ++)
            {
                if($l == 3) {$bool = true;} else {$bool = false;}
                $data[] = [
                'answer' => $this->answers[$i][$l],
                'boolean' => $bool,

            ];

            }

            $answers[] = $data;
        }


        for($i = 0; $i < $this->total; $i ++)
        {
            $question = New Assessments;
            $question->module_id = $this->moduleId;
            $question->question = $this->questions[$i];
            $question->answers = $answers[$i];
            $question->save();
        }

        $this->questions = [];
        $this->answers = [];
        $this->goBack = true;

    }
}
