<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lessons extends Model
{
    use HasFactory;

    protected $fillable = [
        'title','body','order','module_id','document'
      ];


    public function modules()
      {
          return $this->belongsTo(TrainingModules::class,'id');
      }

}
