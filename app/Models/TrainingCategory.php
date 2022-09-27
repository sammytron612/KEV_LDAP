<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class TrainingCategory extends Model
{


    protected $fillable = ['title','desc','image'];

    public $timestamps = false;

    public function modules()
    {
        return $this->hasMany(TrainingModules::class, 'category_id','id');
    }
}
