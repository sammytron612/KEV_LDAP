<?php

namespace App\Http\Helpers;
use App\Models\Campaign;
use App\Models\Division;
use App\Models\Jobtitle;
use Illuminate\Support\Facades\Http;
use App\Models\User as localUser;
use App\Models\workplace as wp;
use Illuminate\Support\Facades\Storage;


class Workplace
{

    private $token = '';

    public function addWPtoUserModel($user)
    {
        $wp = wp::where('name',$user->name)->first();

        if($wp)
            {

                $user->workplace_id = $wp->workplace_id;
                $token = $this->token;
                $url="https://graph.facebook.com/" . $wp->workplace_id . "/picture?access_token=". $token;
                $contents = file_get_contents($url);
                $fileName = str_replace(' ', '', $user->name) . rand() . ".jpg";
                Storage::put("public/profiles/" . $fileName, $contents);
                $user->profile_image = $fileName;
                $user->save();

            }

        return;
    }


    public function create($user, $userId = NUll)
    {

        $jobtitle = Jobtitle::where('id', $user->job_title)->first();
        $campaign = Campaign::where('id', $user->campaign_id)->first();
        $division = Division::where('id', $user->division)->first();

        $name = $user->first_name . " " . $user->last_name;
        $email = $user->email;
        $site = ucwords($user->site);
        $start_date = strtotime($user->start_date);
        $title = $jobtitle->job_title;
        //$telephone = $user->telephone;
        $campaign = $campaign->title;
        $division = $division->title;

        if($campaign == "Other")
        {
            $campaign = $division;
        }




        $url = 'https://www.workplace.com/scim/v1/Users/' . $wp_id;

        $token = '';

        $response = Http::withToken($token)->get($url);

        $a = $response->body();

        $user = json_decode($a);

        unset($user->id);
        unset($user->{'urn:scim:schemas:extension:facebook:accountstatusdetails:1.0'});
        unset($user->{'urn:scim:schemas:extension:enterprise:1.0'}->manager);
        unset($user->{'urn:scim:schemas:extension:facebook:frontline:1.0'});
        unset($user->groups);

        $user->userName = $email;
        $user->name->formatted = $name;
        $user->emails[0]->value = $email;
        $user->addresses[0]->formatted = $site;
        $user->title = $title;

        $user->{'urn:scim:schemas:extension:facebook:starttermdates:1.0'}->startDate = $start_date;
        $user->{'urn:scim:schemas:extension:enterprise:1.0'}->organization = 'ECO';
        $user->{'urn:scim:schemas:extension:enterprise:1.0'}->division = $division;
        $user->{'urn:scim:schemas:extension:enterprise:1.0'}->department = $campaign;
        $user->invited = true;



        $response = Http::withToken($token)->withBody(json_encode($user), 'application/json')->post($url);

        if($response->successful())
        {
            $result = json_decode($response->body());

            if($userId)
            {   $localUser = localUser::where('id',$userId)->first();
                $localUser->workplace_id = $result->id;
                $localUser->save();
            }

            $wp = ['workplace_id' => $result->id,
                    'name' => $name,
                    'department' => $campaign,
                    'title' => $title,
                    'site' => $site
        ];

            wp::create($wp);

            return true;
        }
        else
        {

            return false;
        }


    }


     public function disableWP($workplace_id)
     {
        $url = "https://graph.facebook.com/" . $workplace_id;

        $response = Http::withToken($this->token)->post($url,[
                "active" => false,
        ]);

        return $response;
     }


}
