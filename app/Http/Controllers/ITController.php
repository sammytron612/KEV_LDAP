<?php

namespace App\Http\Controllers;

use App\Models\Offboarding;
use App\Models\workplace;
use Illuminate\Support\Facades\Http;


class ITController extends Controller
{
    public function index()
    {
        return view('it.index');
    }

    public function siteSettings()
    {
        return view('it.site-settings');
    }

    public function recruitment()
    {

        return view('it.recruitment');
    }

    public function campaignManagement()
    {

        return view('it.campaign-management');
    }


    public function itOffBoarding()
    {

        return view('it.offboarding');
    }

    public function createWP()
    {
        return view('it.createWP');
    }

    public function syncWP()
    {

        $token ="*";
/*
        $url = "https://graph.facebook.com/company/members?limit=1500";

        $response = Http::withToken($token)->get($url);
        $ppl = $response->json();

        Workplace::truncate();

        foreach($ppl['data'] as $user)
        {

            $id = $user['id'];
            $name = $user['name'];

            $data = ['workplace_id' => $id,
                    'name' => $name
        ];

            Workplace::create($data);

        }


        //$workplaces = Workplace::take(500)->get();
        $workplaces = Workplace::skip(499)->get();
        //$workplaces = Workplace::all();

        foreach($workplaces as $wp)
        {

            $id = $wp->workplace_id;
            $url = 'https://www.workplace.com/scim/v1/Users/' . $id;

            $response = Http::withToken($token)->get($url);
            $user = json_decode($response->body());

            if(isset($user->{"urn:scim:schemas:extension:enterprise:1.0"}->department))
                {
                    $wp->department = $user->{"urn:scim:schemas:extension:enterprise:1.0"}->department;
                }
            if(isset($user->addresses[0]->formatted))
                {
                    $wp->site = $user->addresses[0]->formatted;
                }
            if(isset($user->title))
                {
                    $wp->title = $user->title;
                }

            $wp->save();
        }

        */
        return redirect()->back();
    }

}
