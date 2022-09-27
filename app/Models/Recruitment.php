<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Recruitment extends Model
{

    protected $fillable = [
        'campaign',
        'intake_date',
        'heads',
        'webcams',
        'headsets',
        'date_pc_required',
        'work_location',
        'training_location',
        'completed',
        'trainer',
        'notes',
        'site',
        'campaign_id'
      ];

      protected $casts = [
        'notes' => 'array',
    ];

    public function campaigns()
    {
        return $this->hasOne(Campaign::class,'id','campaign_id');
    }

}
