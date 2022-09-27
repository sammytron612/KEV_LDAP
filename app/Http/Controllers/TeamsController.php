<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewStarters;
use App\Models\TeamMembers;
use App\Models\Teams;

class TeamsController extends Controller
{
    private function intakeCheck()
    {

        $today = now()->toDateString();

        $intakes = NewStarters::where('start_date','<=',$today)->where('user_id','<>',0)->get();

        foreach($intakes as $intake)
        {
            $data = ['team_id' => $intake->team_id,
                    'user_id' => $intake->user_id,
                    'name' => $intake->name
                    ];

            TeamMembers::create($data);
        }

        NewStarters::where('start_date','<=',$today)->delete();


    }

    public function index()
    {

        $this->intakeCheck();


        $showing = Teams::with(['User' => function ($query){
            $query->orderBy('name','desc');
        }])->pluck('id')->first();



        return view('teams.teams',compact(['showing']));

    }

    public function addTeam(Request $request)
    {
        $this->intakeCheck();

        $data = ['manager' => $request->manager];

        Teams::create($data);

        $teams = Teams::all();

        return redirect()->route('teams', compact(['teams']));
    }
}
