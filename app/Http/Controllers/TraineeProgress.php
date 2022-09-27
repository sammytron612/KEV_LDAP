<?php

namespace App\Http\Controllers;


use App\Models\AssignedTraining;
use App\Models\User;
use App\Http\Helpers\NewPercentage;

class TraineeProgress extends Controller
{
    public function index()
    {
        $not_completed = AssignedTraining::where('completed','')->count();
        $completed = AssignedTraining::where('completed','100')->count();


        return view('trainee-progress.index', compact(['not_completed','completed']));
    }

    public function compliance($user)
    {
        $user = User::where('id',$user)->with('assigned_training')->first();

        $new = New NewPercentage;
        $new->percentage($user->assigned_training);

        $assigned = count($user->assigned_training);
        $completed = count($user->assigned_training->where('completed','=','100'));

        if($completed == 0)
        {
            $pct_completed = 0;
        } else
        {
            $pct_completed = ($completed / $assigned) * 100;

        }
        $pct_not = 100 - $pct_completed;


        return view('trainee-progress.compliance', compact(['user','pct_not','pct_completed','assigned','completed']));
    }
}
