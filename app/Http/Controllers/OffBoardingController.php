<?php

namespace App\Http\Controllers;



class OffBoardingController extends Controller
{
    public function index()
    {
        return view('offboarding.index');
    }

    public function offBoardingSplash()
    {
        return view('offboarding.splash');
    }
}

