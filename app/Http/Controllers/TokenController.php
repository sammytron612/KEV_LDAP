<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\DeviceTokens;

class TokenController extends Controller
{
    public function saveToken(Request $request)
    {

        $fetch_id = $request->get('fetch_id');

        $data = ['user_id' => Auth::user()->id,
                'token' => $fetch_id
    ];

        $exists = DeviceTokens::where('user_id', Auth::user()->id)->where('token',$fetch_id)->first();

        if(!$exists)
        {
            DeviceTokens::create($data);
        }

        return response()->json(['success' => 'success'], 200);
    }
}
