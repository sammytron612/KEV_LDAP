<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class TrainingModules extends Model
{

    protected $fillable = [
        'title',
        'desc',
        'image',
        'category_id'
      ];

    public function lessons()
      {
          return $this->hasMany(Lessons::class, 'module_id');
      }

    public function assigned()
    {
        return $this->hasMany(AssignedTraining::class);
    }

    public function assessments()
    {
        return $this->hasMany(Assessments::class,'module_id');
    }

    public function category()
    {
        return $this->belongsTo(TrainingCategory::class, 'id','category_id');
    }

}
