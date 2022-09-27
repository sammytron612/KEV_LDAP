<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobtitle extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['job_title'];

    public function onboarding()
      {
          return $this->belongsTo(Onboardings::class,'job_title','id');
      }
}
