<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Teams extends Model
{


    public $timestamps = false;

    protected $fillable = ['manager','name'];

    public function User()
    {
        return $this->hasOne(User::class,'id','manager');
    }

}
