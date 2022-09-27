<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignedTraining extends Model
{
    use HasFactory;

    protected $casts = [
        'lessons_complete' => 'array',
    ];

    protected $fillable = [
        'user_id','module_id','completed','lessons_complete','date_completed','assessment'
      ];

    public function user()
      {
          return $this->belongsTo(user::class,'id');
      }

    public function module()
    {
        return $this->belongsTo(TrainingModules::class, 'module_id');
    }

    public function assessments()
    {
        return $this->hasMany(Assessments::class, 'module_id','module_id');
    }
}
