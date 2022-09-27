<?php

namespace App\Http\Controllers;


class AssessmentController extends Controller
{

    public function createAssessment($moduleId)
    {

        return view('training-maint.create-assessment',compact(['moduleId']));
    }



}
