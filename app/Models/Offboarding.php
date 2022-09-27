<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offboarding extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'workplace_id',
        'leave_date',
        'submitted_by',
        'type',
        'domain',
        'name',
	    'completed',
        'it',
        'actioned'

    ];

    public function users()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function requestor()
    {
        return $this->belongsTo(User::class,'submitted_by','id');
    }

    public function usersTrashed()
    {
        return $this->belongsTo(User::class,'user_id','id')->withTrashed();
    }


}
