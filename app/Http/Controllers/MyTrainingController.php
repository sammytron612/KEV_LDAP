<?php

namespace App\Http\Controllers;

use App\Models\Assessments;
use App\Models\Lessons;
use App\Models\AssignedTraining;
use App\Models\TrainingModules;
use Auth;
use App\Http\Helpers\NewPercentage;
use Illuminate\Http\Request;

class MyTrainingController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        $completed = array();


        $modules = AssignedTraining::with(['module' => function ($query)  {
            $query->orderBy('category_id');
        }])->where('user_id', $user->id)->paginate(5);

        $new = New NewPercentage;
        $new->percentage($modules);


        $c = (count($modules));
        for($i = 0; $i < $c; $i++)
        {
            array_push($completed,$modules[$i]->lessons_complete);
        }

        return view('my-training.index', compact(['modules', 'completed']));
    }

    public function viewTraining($id,$index)
    {

        $lesson = Lessons::where('module_id',$id)->orderBy('order','asc')->get();

        $lesson_count = count($lesson);

        if($index > count($lesson))
        {
            return view('error');
        }
        $data['lesson'] = $lesson[$index-1];

        $completed = AssignedTraining::where('module_id',$id)
                                ->where('user_id', Auth::user()->id)->first();

        if(!$completed->lessons_complete)
        {
            $viewed = 0;
        }
        else
        {
            $viewed = count($completed->lessons_complete);
        }


        $data['progress'] = round(($viewed / count($lesson)) * 100);


        $data['completed'] = false;
        $data['module'] = $id;
        $data['index'] = $index;

        $viewed_lesson = ($data['lesson']->id);

        if($completed->lessons_complete)
          {
            foreach($completed->lessons_complete as $lesson)
            {
                if($viewed_lesson == $lesson['lesson'])
                {
                    $data['completed'] = true;
                    $data['index'] = $index + 1;
                    break;
                }
            }
          }

          if($lesson_count == $index && $data['completed'])
          {
              $data['end'] = true;
          }
          else
          {
              $data['end'] = false;
          }

        return view('my-training.show', $data);
    }

    public function finishModule($moduleId)
    {

        $module = TrainingModules::find($moduleId);
        $assessment = Assessments::where('module_id',$moduleId)->exists();
        if(!$assessment)
        {
            $count = session('trainingOut');
            $count --;
            session(['trainingOut' => $count]);

        }


        return view('my-training.finish-module',compact(['module','assessment']));
    }

    public function beginAssessment($module)
    {

        $assigned = AssignedTraining::where('module_id', $module)->where('user_id', Auth::user()->id)->first();

        if($assigned->completed != 100){
            return redirect()->back();
        }

        $module = TrainingModules::with('assessments')->where('id',$module)->first();


        return view('my-training.assessment', compact(['module']));
    }

    public function finishAssessment(Request $request)
    {

       $params = $request->all();

       $correct = 0;
       foreach($params as $params)
       {
           if($params == 1){$correct += 1;}
       }


       $moduleId = $request->module_id;
       $questions = Assessments::where('module_id', $moduleId)->get();

       $module = TrainingModules::find($moduleId);
       $moduleTitle = $module->title;



       $score = round($correct / (count($questions)) * 100);

       if($score >= 60)
       {
            AssignedTraining::where('module_id',$moduleId)->where('user_id',Auth::user()->id)
                            ->update(['assessment' => $score]);

            $count = session('trainingOut');
            $count --;
            session(['trainingOut' => $count]);

            return view('my-training.pass-assessment',compact(['moduleTitle','score']));
       }
       else
       {
            AssignedTraining::where('module_id',$moduleId)->where('user_id',Auth::user()->id)
                            ->update(['lessons_complete' => '', 'completed' => '', 'date_completed' => '']);

            return view('my-training.fail-assessment',compact(['moduleTitle','score']));
       }
    }



}
