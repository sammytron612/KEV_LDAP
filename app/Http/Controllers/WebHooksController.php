<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Webhooks;


class WebHooksController extends Controller
{
    public function naturalHR(Request $request)
    {

        $auth = $request->header('authorization');

        if($auth != '')
        {
            abort(403);
        }


        $event = json_decode($request->getContent(), true);

        $data = ['hr_id' => $event['id'],
                'event' => $event['event'],
                'employee_id' => $event['employeeId']
            ];

        Webhooks::create($data);

        return response('success',200);

        dd($request->ip());

    }
}
