<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Returns extends Model
{
    protected $fillable = ['name','email','campaign','site','date_time','notes',];

    public function campaigns()
        {
            return $this->hasOne(Campaign::class,'id','campaign');
        }
}
