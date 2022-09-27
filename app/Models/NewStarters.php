<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewStarters extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['team_id','user_id','name','start_date'];

    public function User()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
