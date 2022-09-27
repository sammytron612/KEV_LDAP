<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable=['title','ou','groups','site'];

    protected $casts = [
        'lessons_complete' => 'array',
    ];

    public $timestamps = false;

    public function recruitment()
      {
          return $this->belongsTo(Recruitment::class);
      }
      public function onboarding()
      {
          return $this->belongsTo(Onboardings::class,'campaign_id','id');
      }

      public function batch()
      {
          return $this->belongsTo(Batches::class,'id','campaign_id');
      }

      public function return()
      {
          return $this->belongsTo(Returns::class,'id','campaign');
      }
}
