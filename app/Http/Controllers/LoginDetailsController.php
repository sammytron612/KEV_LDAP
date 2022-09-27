<?php

namespace App\Http\Controllers;


use App\Models\batches;
use App\Models\Onboardings;

class LoginDetailsController extends Controller
{
    public function index()
    {


        $groups = batches::with(['campaigns','division'])
                                ->orderBy('start_date','desc')
                                ->paginate(15);

        foreach($groups as $group)
        {
            $count[] = Onboardings::where('batch_no', $group->batch_no)->count();
        }




        return view('logins',['groups' => $groups, 'totals' => $count]);


    }

    public function showLogins($group)
    {
        $users = Onboardings::where('batch_no',$group)->where('internal_transfer',0)->where('completed',1)->get();

        return view('login-details',['users' => $users]);
    }
}
