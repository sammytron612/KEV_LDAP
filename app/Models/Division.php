<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['title'];

    public function batch()
    {
        return $this->hasOne(Batches::class,'division_id','id');
    }

    public function onboarding()
    {
        return $this->hasOne(onboarding::class,'id');
    }
}
