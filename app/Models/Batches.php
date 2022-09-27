<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batches extends Model
{
    use HasFactory;

    protected $fillable = [
        'batch_no',
        'total',
        'user_id',
        'completed',
        'campaign_id',
        'division_id',
        'site',
        'start_date'
      ];

    public function user()
        {
            return $this->belongsTo(User::class);
        }

    public function onboardings()
        {
            return $this->hasMany(Onboardings::class, 'batch_no', 'batch_no');
        }

    public function campaigns()
        {
            return $this->hasOne(Campaign::class,'id','campaign_id');
        }

    public function division()
        {
            return $this->hasOne(division::class,'id','division_id');
        }
}
