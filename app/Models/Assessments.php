<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessments extends Model
{
    use HasFactory;

    protected $fillable = ['module_id','question','answers'];

    protected $casts = [
        'answers' => 'array',
    ];


    public function training_module()
    {
        return $this->belongsTo(TrainingModules::class);
    }

    public function assigned_training()
    {
        return $this->belongsTo(AssignedTraining::class,'module_id','module_id');
    }
}
