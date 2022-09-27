<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\Returns;
use App\Http\Helpers\NotificationEmails;
use App\Notifications\ReminderReturnNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;
use App\Notifications\UserReturnEmail;


class ReturnsController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::all();
        return view('returns.index', ['campaigns' => $campaigns]);
    }

    public function returnsRequest(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'campaign' => 'required',
            'date_time' => 'required'
        ]);

        $data = ['name' => $request->name,
                'email' => $request->email,
                'campaign' => $request->campaign,
                'date_time' => $request->date_time,
                'notes' => $request->notes

    ];

    Returns::create($data);

    ##### send email to IT and leaver ######

    if(NotificationEmails::emailOn())
        {
        Notification::route('mail', [$request->email, '*','*'])
        ->notify(new UserReturnEmail($data));
        }


    return view('returns.thankyou')->with('success', 'Thankyou');

    }

    public function show()
    {
        return view('returns.show');
    }

    public function reminderEmail()
    {

        $returns = DB::select( DB::raw("select * from returns where date_returned is NULL AND CONVERT(DATETIME,date_time,103) < GETDATE()") );
        //dd($returns);
        foreach($returns as $return)
        {
            $data = ['name' => $return->name,
                    'failed_date' => $return->date_time,
                    'url' => 'http://returns.ecoutsourcing.co.uk/'];

            Notification::route('mail', [$return->email])
                    ->notify(new ReminderReturnNotification($data));

        }
    }
}
