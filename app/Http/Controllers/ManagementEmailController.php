<?php

namespace App\Http\Controllers;

use App\Models\Batches;
use App\Models\Onboardings;
use App\Notifications\RecruitmentReport;
use Illuminate\Support\Facades\Notification;

class ManagementEmailController extends Controller
{


    public function unfinished()
    {

        $groups = Batches::where(function($query){
            $query->where('completed',0)
            ->orWhere('completed', 1)
            ->whereDate('updated_at', now());
        })->get();


        $index = 0;

        foreach($groups as $group)
        {
            $today = Onboardings::where('batch_no', $group->batch_no)->whereDate('created_at', now())->count();
            $total = Onboardings::where('batch_no', $group->batch_no)->count();


            $data[$index] = ['today' => $today];
            $data[$index] += ['total' => $total];
            $data[$index] += ['headTotal' => $group->total];
            $data[$index] += ['startDate' => $group->start_date];
            $data[$index] += ['site' => $group->site];
            $data[$index] += ['campaign' => $group->campaigns->title];
            $data[$index] += ['recruiter' => $group->user->name];
            $data[$index] += ['pct' => round(($total / $group->total) * 100)];
            $data[$index] += ['completed' => $group->completed];

            $index ++;

        }

        if(isset($data))
        {
        Notification::route('mail', ['*'])
            ->notify(new RecruitmentReport($data));
        }

    }


}
