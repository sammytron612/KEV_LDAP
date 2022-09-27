<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Onboardings extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name', 'last_name', 'telephone', 'email','campaign','start_date','internet_provider','job_title',
        'setup_location','ethernet_cable','equipment_collection','notes','batch_no','completed','assigned_to','campaign_id','site','division','account','internal_transfer','sam','workplace'
    ];

    public function batch()
      {
          return $this->belongsTo(Batches::class ,'batch_no', 'batch_no');
      }

      public function campaigns()
      {
          return $this->hasOne(Campaign::class,'id','campaign_id');
      }

      public function divisions()
      {
          return $this->belongsTo(Division::class,'division');
      }
      public function job()
      {
          return $this->belongsTo(Jobtitle::class,'job_title');
      }


}
