<?php
namespace App\Http\Traits;

use App\Models\TeamMembers;
use App\Models\NewStarters;

trait RemovePlannerEntry{

private function PlannerRemove($user_id)
    {
        TeamMembers::where('user_id',$user_id)->delete();

        $starters = NewStarters::where('user_id',$user_id)->get();

        foreach($starters as $starts)
        {
            $date = $starts->start_date;
            $team_id = $starts->team_id;
            $starts->delete();
            $count = NewStarters::where('start_date', $date)->where('team_id', $team_id)->count();

            if($count == 1)
            {
                NewStarters::where('start_date', $date)->where('team_id', $team_id)->delete();
            }

        }

        return;
    }
}
