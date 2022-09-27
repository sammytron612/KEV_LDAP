<?php

namespace App\Http\Controllers;


/*use *Record\Models\ActiveDirectory\User;*/
use App\Models\User;
use *Record\Models\ActiveDirectory\OrganizationalUnit;

use App\Http\Helpers\Offboard;

use Auth;
use Illuminate\Support\Facades\Artisan;
use *Record\Container;
use *Record\Models\ActiveDirectory\Entry;
use Illuminate\Support\Facades\Storage;
use App\Models\workplace as wp;
use Illuminate\Queue\Worker;
//use GuzzleHttp;
use Illuminate\Support\Facades\Http;
use App\Models\AssignedTraining;
use Carbon\Carbon;
use App\Http\Helpers\Workplace as work;
use App\Models\Offboarding;
use App\Models\User as local;
use Illuminate\Http\Request;
use App\Models\NaturalHR;

use App\Services\NotificationService;


class TestController extends Controller
{


    public function test(Request $request)
    {
        app()->call('\App\Http\Helpers\Offboard@leavers');

        die();

        $users = Offboarding::with('users')->where('type','AD')
                    ->whereDate('leave_date','<=', now())
                    ->whereNull('completed')
                    ->get();

                    dd($users);
        $data = ['first_name' => 'Kevin',
                'last_name' => 'Wilson'];



        dd(json_encode($data));
dd('stop');
        $token = '';

      

        $headers = [
            'Accept' => 'application/json',
            
        ];

        $response = Http::withHeaders($headers)->get($url);

        $a = $response->body();

        $arr = json_decode($a,true);
        $arr = $arr['data'][0];

        $hr = new NaturalHR;

        $hr->details = $arr;
        dd($arr);
        $hr->save();


die();

/*
        $users = Local::with('assigned_training')->WhereHas('assigned_training')->where('domain','=','hydra')->get();

        foreach($users as $user){

            $overwatch = Local::where('name',$user->name)->where('domain','overwatch')->whereDoesntHave('assigned_training')->first();


            if($overwatch)
            {
                $overwatchUserId = $overwatch->id;

                foreach($user->assigned_training as $training)
                {
                    $training->user_id = $overwatchUserId;
                    $training->save();
                }

            }


        }
*/
die();
        $ppl = Local::where('domain', 'overwatch')->whereNULL('workplace_id')->get();

        foreach($ppl as $user){

            $wp = wp::where('name',$user->name)->first();
            if($wp)
            {
                $user->workplace_id = $wp->workplace_id;
                $user->save();
            }

        }
        die();

       $a = NaturalHR::find(5);

       dd($a->details);

        $token = '*';

        

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => '*'
        ];

        $response = Http::withHeaders($headers)->get($url);

        $a = $response->body();

        $arr = json_decode($a,true);
        $arr = $arr['data'][0];

        $hr = new NaturalHR;

        $hr->details = $arr;
        $hr->save();


die();


### matches user model name to workplace name and tries to add wp id to user model
        $ppl = Local::where('domain', 'overwatch')->whereNULL('workplace_id')->get();

        foreach($ppl as $user){

            $wp = wp::where('name',$user->name)->first();
            if($wp)
            {
                $user->workplace_id = $wp->workplace_id;
                $user->save();
            }

        }
        die();

        return view('test.test');

        $operator = '';

        $users = User::whereHas('assigned_training', function($query) use ($operator) {
            return $query->where('completed',$operator,100);})->with('workplaces', function($query)
                    {
                        $query->where('site','like','%');
                    })
                ->where('name','like','%')
                ->orderBy('name')->paginate(30);

                dd($users);

        $users = User::whereHas('assigned_training', function($query) use ($operator) {
            return $query->where('completed',100);})->first();

            dd($users);

        dd('stop');

        app('App\Http\Helpers\Offboard')->leavers();

dd('stop');
        app('App\Http\Helpers\Offboard')->ScheduleWP();


        $token = '*';
        $url = "https://graph.facebook.com/" . '100077324652711';

            $response = Http::withToken($token)->post($url,[
                    "active" => true,
            ]);
            dd('*');
        app('App\Http\Helpers\Offboard')->ScheduleWP();
        dd('*');
        $token = '*';
        $url = "https://graph.facebook.com/" . '100077324652711';

            $response = Http::withToken($token)->post($url,[
                    "active" => true,
            ]);
            dd('*');

dd('stop');

        app('App\Http\Helpers\Offboard')->ScheduleWP();
        dd('*');


        app('App\Http\Controllers\managementEmailController')->unfinished();
        dd('*');
        $token = '*';
        $url = "https://graph.facebook.com/" . '100069827899522';

            $response = Http::withToken($token)->post($url,[
                    "active" => true,
            ]);
            dd('*');
        $id = 100064517733797;

        $url = '' . $id;

        $token = '*';

        $response = Http::withToken($token)->get($url);

        $a = $response->body();
        dd($a);

        /*
        $token = '*';
        $url = "https://graph.facebook.com/" . '100075274803564';

            $response = Http::withToken($token)->post($url,[
                    "active" => true,
            ]);
            die();
/*
        $assigned_train = AssignedTraining::all();

        foreach($assigned_train as $t)
        {

            $id = $t->user_id;
            $exists = User::where('id',$id)->first();
            if(!$exists)
            {
                AssignedTraining::where('user_id',$id)->delete();
            }

        }
die();
/*
        $ppl = User::where('domain', 'cybertron')->whereNULL('workplace_id')->get();
        foreach($ppl as $user){

            $wp = wp::where('name',$user->name)->first();
            if($wp)
            {
                $user->workplace_id = $wp->workplace_id;
                $user->save();
            }

        }
        die();
        /*

        $token = '*';
        $url = "https://graph.facebook.com/" . '100069827899522';

            $response = Http::withToken($token)->post($url,[
                    "active" => true,
            ]);


        dd('stop');
/*
        $id = "100063607398919";

        //$id = '100074151620071';

        $unixTime = strtotime('2021-11-01');

        $url = 'https://www.workplace.com/scim/v1/Users/' . $id;

        $token = '*';

        $response = Http::withToken($token)->get($url);

        $a = $response->body();

        $array1 = json_decode($a);


        $temp = $array1;

        unset($temp->id);
        unset($temp->{'urn:scim:schemas:extension:facebook:accountstatusdetails:1.0'});
        unset($temp->{'urn:scim:schemas:extension:enterprise:1.0'}->manager);
        unset($temp->{'urn:scim:schemas:extension:facebook:frontline:1.0'});
        unset($temp->groups);

        

        


        $response = Http::withToken($token)->withBody(json_encode($temp), 'application/json')->post($url);
        if($response->successful())
        {
            $a = json_decode($response->body());


            echo "<br>";
            echo $a->id;
        }

die();



dd("stop");
        $id = "100069827899522";
        $unixTime = strtotime('2021-11-01');

        $url = 'https://www.workplace.com/scim/v1/Users/' . $id;

        $token = '*';


        $myObj = (object)[];
        $myObj->type = 'work';
        $myObj->formatted = 'Doxford Park';
        $myObj->primary = true;

        $addresses = array($myObj);

        $response = Http::withToken($token)->get($url);

        $a = $response->body();
dd($a);

        $array1 = json_decode($a);
        //dd($array1);
        $array1->addresses = $addresses;

        //$array2 = json_decode('{"urn:scim:schemas:extension:facebook:starttermdates:1.0" :{ "startDate": ' . $unixTime . '}}');
        //$newObject = (object) array_merge(
            //(array) $array1, (array) $array2);

        $json = json_encode($array1);
        //dd($json);

        $response = Http::withToken($token)->withBody($json, 'application/json')->put($url);


//dd($response);
        dd($response->successful());
/*
        $token = '*';
        $url = "https://graph.facebook.com/" . '100072541740744';

            $response = Http::withToken($token)->post($url,[
                    "active" => true,
            ]);


        dd('stop');
/*
        $id = 100066729106067;
        $url = 'https://www.workplace.com/scim/v1/Users/' . $id;
        $token ="*";
        $response = Http::withToken($token)->get($url);

        $a = json_decode($response->body());
        //dd($a);
        dd($a->{"urn:scim:schemas:extension:enterprise:1.0"}->manager->managerId, $a->{"urn:scim:schemas:extension:enterprise:1.0"}->department,$a->title);

       /* $unixTime = strtotime(carbon::now());

        $obj_merged = (object) array_merge(
            (array) $objectA, (array) $objectB);

        $json = '{"urn:scim:schemas:extension:facebook:starttermdates:1.0" :{ "startDate": ' . $unixTime . '}}';
         dd(json_decode($json));
/*
        $tt = new work;


        $a = $tt->addaddresstoWP(100073572367933, 'boldon');


    dd("stop");



/*
        $token ="*";
        $url = "https://graph.facebook.com/" . 100073449312166;

        $response = Http::withToken($token)->DELETE($url);

        dd("stop");

        $token ="*";
        $url = 'https://www.workplace.com/scim/v1/Users/100073449312166';

        $response = Http::withToken($token)->get($url);
dd($response->body());
        //app()->call('App\Http\Controllers\ReturnsController@reminderEmail');

        dd("stop");
        $token ="*";
        $url ='https://www.workplace.com/scim/Users';
        $response = Http::withToken($token)->get($url);
        $ppl = $response->json();

        dd($ppl);

        $token ="*";
        $url = "https://graph.facebook.com/company/members?limit=1000";
        $response = Http::withToken($token)->get($url);
        $ppl = $response->json();
        dd($ppl);







        //app('App\Http\Controllers\ReturnsController')->reminderEmail();
        //dd('ok');
       /* $token = '*';
        $url = "https://graph.facebook.com/" . '100064230125403';

            $response = Http::withToken($token)->post($url,[
                    "active" => false,
            ]);
            /*
        $sam = "100070379644620";
        $wp = wp::where('name',$sam)->first();



            $url = "https://graph.facebook.com/" . $wp->workplace_id;

            $response = Http::withToken($token)->post($url,[
                    "active" => true,
            ]);
*/
dd('ok');

      /*  $connection = Container::getConnection('overwatch');

        container::addConnection($connection);

        $ou = OrganizationalUnit::findBy('ou','ESB-CS');

        $first = Entry::in($ou)->limit(2)->get();

        if(isset($first[1]['cn'][0]))
        {
            $ADuser = User::findBy('cn', $first[1]['cn'][0]);
            $groups = $ADuser->groups()->recursive()->get();

        }

        dd($groups[2]['cn'][0]);

   /*
        $a = new Offboard;
        $a->leavers();
       die();
/*
        die();
        $name = "Mohammed Ali";
        $wp = wp::where('name',$name)->first();

        $token ="*";
        $url = "https://graph.facebook.com/" . 100073239682570;

        $response = Http::withToken($token)->DELETE($url);

     /*
	//print shell_exec( 'whoami' );

        $name = "King Kong";
        $wp = wp::where('name',$name)->first();

        $token ="*";
        $url = "https://graph.facebook.com/" . $wp->workplace_id;

        $response = Http::withToken($token)->DELETE($url);
        die();
/*
dd($response->json());
        $token ="*";
        $url = "https://graph.facebook.com/company/members?limit=1000";
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
        die();
        $id = $ppl['data'][0]['id'];
        $name = $ppl['data'][0]['name'];
        $url = "https://graph.facebook.com/" . $id . "/picture";
        $response = Http::withToken($token)->get($url)->body();
$url="https://graph.facebook.com/kevin.wilson@ecoutsourcing.co.uk/picture?access_token=*";
$contents = file_get_contents($url);

Storage::put("public/profiles/me66.jpg", $contents);

dd($response);
        $a = new Offboard;
        $a->leavers();

        $overwatch = Container::getConnection('overwatch');


        container::addConnection($overwatch);
        //$ou = OrganizationalUnit::findBy('ou',"ESB-SALES");

        //$user = User::find('samaccountname', 'kevin.wilson')->in($ou)->first();
        //dd($user);
        $user = User::findBy('samaccountname','TEMPLATE.ESB-SALES');
        dd($user->groups()->recursive()->get());

        //$user = User::find('UserPrincipalName', 'kevin.wilson.overwatch.ecoutsourcing.co.uk');
        //dd($user)
        $user = User::find('cn=John Doe,ou=Users,dc=local,dc=com');

        // Get nested groups the user is apart of:
        $groups = $user->groups()->recursive()->get();
        $user = User::findBy('samaccountname', 'kevin.wilson');


        $ou = OrganizationalUnit::findBy('ou',"Offboarded");


        $user->move($ou);
        dd($user);

        $groups = $user->groups()->get();
        foreach($groups as $group)
        {
            echo($group->name[0]);
            echo "<br>";
        }
        //dd($user);

        Artisan::call('*:import', ['provider' => 'overwatch', '--no-interaction','--filter' => '(samaccountname=kevin.wilson)']);
        //Artisan::call('*:import', ['provider' => 'overwatch', '--no-interaction','--filter' => '(objectclass=user)']);
        //Artisan::call('*:import', ['provider' => 'hydra', '--no-interaction','--filter' => '(objectclass=user)']);
       // die();


        //dd($user);
        $ou = OrganizationalUnit::find('ou=Offboarded,DC=overwatch,DC=ecoutsourcing,DC=co,DC=uk');
        dd($ou);
        dd($user->*);

        $user = User::where('samaccountname', '=', 'test.user')->first();

        $offboard = new Offboard;
        $result = $offboard->leavers();
        die();

        ##### This works #####
/*
        $user = User::where('samaccountname', '=', 'test.user')->first();
        $ou = OrganizationalUnit::find('ou=Disabled Accounts,DC=hydra,DC=ec-ltd,DC=co,DC=uk');
        $user->move($ou);
        $user->userAccountControl = 2;
        $user->save();
        die();


/*
        $connection = new Connection([
            'hosts' => ['192.168.51.9'],
            'port' => 389,
            'base_dn' => "DC=hydra, DC=ec-ltd, DC=co ,DC=uk",
            'username' => "CN=*,OU=IT,DC=hydra,DC=ec-ltd,DC=co,DC=uk",
            'password' => '*',
        ]);

        $query = $connection->query();

       $user = $query->findBy('samaccountname', 'test.user');
       dd($user);
       $user['useraccountcontrol'][0] = 2;
       $user->save();

//$user->userAccountControl = 2;

//$user = User::where('samaccountname', '=', 'test.user')->first();
//$user->userAccountControl = 2;
//$user->save();

//dd($user);

        //$token = "*";

       # $url = "https://graph.facebook.com/100065094236318";
       #$url = "https://graph.facebook.com/company/accounts";

        //$response = Http::withToken($token)->get($url);
        //dd($response->json());
       /* $response = Http::withToken($token)->post($url,[
                'cost_center' => 'CC3',
                //'role' => 'Network Administrator',
            ]);
        dd($response->json());
*/
/*


        $client = new GuzzleHttp\Client(['base_uri' => 'https://graph.facebook.com/']);

        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept'        => 'application/json',
        ];


        //return view('test.test');

        $connection = new Connection([
            'hosts' => ['192.168.51.9'],
            'port' => 389,
            'base_dn' => "DC=hydra, DC=ec-ltd, DC=co ,DC=uk",
            'username' => "CN=*,OU=IT,DC=hydra,DC=ec-ltd,DC=co,DC=uk",
            'password' => '*',
        ]);

        $user = Auth::user();
        $query = $connection->query();
        $record = $query->findBy('samaccountname', $user->username);
        $*_groups = $record['memberof'];
        $memberOf = array();

        foreach ($*_groups as $*_group)
        {

            if(str_contains($*_group,'CN'))
            {
                $groupArray = explode(',',$*_group);
                $group = substr($groupArray[0], 3);
                array_push($memberOf, $group);
            }

        }
        dd($memberOf);
        */
    }

}
