<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class workplace extends Model
{
    use SoftDeletes;

    protected $fillable = ['workplace_id', 'name','department','title','site','deleted_at'];

    public $timestamps = false;

    public function users()
    {
        return $this->belongsTo(workplace::class,'workplace_id','workplace_id');
    }
}

