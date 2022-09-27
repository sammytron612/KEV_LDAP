<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NaturalHR extends Model
{
    use HasFactory;

    protected $table = 'natural_hr';

    protected $fillable = [
        'details'
      ];
    protected $casts = [
        'details' => 'array',
    ];

}
