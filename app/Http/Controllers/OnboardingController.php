<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Onboardings;
use App\Models\BatchNumber;
use App\Notifications\EmailNotification;
use Illuminate\Support\Facades\Notification;
use Auth;
use App\Models\Batches;
use Carbon\Carbon;
use App\Models\Campaign;
use App\Models\Division;
use LdapRecord\Container;
use App\Http\Helpers\NotificationEmails;



class OnboardingController extends Controller
{

    public function index()
    {
        return view('onboarding.index');
    }

    public function viewAllIntakes()
    {


        $batches = Batches::OrderBy('created_at','desc')->paginate(10);

        $completed = null;

        foreach($batches as $batch)
        {
            $completed[] = Onboardings::where('batch_no',$batch->batch_no)->where('completed',1)->count();

        }

        $count = null;
        foreach($batches as $batch)
        {
            $count[] = Onboardings::where('batch_no',$batch->batch_no)->count();
        }

        return view('onboarding.view-intakes',compact(['batches','count','completed']));

    }

    public function show($batch_no = -1)
    {

        $today = Carbon::tomorrow()->format('Y-m-d');
        $current_batch = Batches::where('batch_no', $batch_no)->first();
        $additions = Onboardings::where('batch_no',$batch_no)->get();

        if($batch_no == -1)
        {
            $campaigns = Campaign::orderBy('title')->get();
            $divisions = Division::orderBy('title')->get();
        }
        else
        {
            $campaigns = Campaign::where('id',$current_batch->campaign_id)->get();
            $divisions = Division::where('id', $current_batch->division_id)->get();
        }


        return view('onboarding.form', compact(['additions','batch_no','today','campaigns','current_batch','divisions']));
    }



    public function view($batch_no)
    {


        $count = Onboardings::where('batch_no', $batch_no)->where('completed',0)->count();
        $starters = Onboardings::where('batch_no',$batch_no)->paginate(45);
        $batch = Batches::where('batch_no', $batch_no)->first();
        $transfers = Onboardings::where('batch_no', $batch_no)->where('internal_transfer',1)->count();

        if($batch->site == "sheffield")
        {
            $domain = "cybertron";
        }
        else{
            $domain = "overwatch";
        }


        $connection = Container::getConnection($domain);
        container::addConnection($connection);

        $ous = \LdapRecord\Models\ActiveDirectory\OrganizationalUnit::get();


        foreach($ous as $ou)
        {
            if(isset($ou['iscriticalsystemobject'])){
                continue;
            }
            if (str_contains($ou, 'Exchange')){
                continue;
            }

            $domainOus[] = $ou['distinguishedname'][0];
        }

        return view('onboarding.view_starters', compact(['starters','batch_no','count','domainOus', 'domain','transfers']));
    }

    public function finishUp($batch_no)
    {

        $data = [
            'batch_no' => $batch_no,
        ];

        $batch = Batches::where('batch_no',$batch_no)->first();
        $batch->completed = 1;
        $batch->save();


        $data += ['user_name' => Auth::user()->name];
        $data += ['word' => 'completed'];


        if(NotificationEmails::emailOn())
            {
            if($batch->site == "sheffield")
            {
                Notification::route('mail', ['*','*'])
                ->notify(new EmailNotification($data));
            } else
            {
                Notification::route('mail', ['*'])
                ->notify(new EmailNotification($data));
            }
        }

            $batches = Batches::OrderBy('created_at','desc')->paginate(10);

            $count = null;
            foreach($batches as $batch)
            {
                $count[] = Onboardings::where('batch_no',$batch->batch_no)->count();
            }

            $result = "success";

            return view('onboarding.view_all', compact('batches','count','result'));

    }

    public function complete(Request $request)
    {

        $user = Onboardings::find($request->id);
        $user->completed = 1;
        $user->save();

        return response()->json(['message' => 'success'], 201);

    }

    public function completeIntake(Request $request)
    {
        $id = $request->batch_no;

        Onboardings::where('batch_no', $id)->update(['completed' => 1]);
        return redirect()->back()->withSuccess('Success!!');

    }

    public function viewAll()
    {

        $batches = Batches::orderBy('start_date','desc')->paginate(10);

        $count = null;
        foreach($batches as $batch)
        {
            $count[] = Onboardings::where('batch_no',$batch->batch_no)->count();
        }

        return view('onboarding.view_all', compact('batches','count'));
    }

    public function deleteBatch($batch_no)
    {
            Onboardings::where('batch_no',$batch_no)->delete();
            Batches::where('batch_no', $batch_no)->delete();

            return redirect()->back()->with('success','Success!');

    }
}
