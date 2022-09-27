<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WPSchedule extends Model
{
    use HasFactory;

    protected $fillable = ['workplace_id', 'leave_date'];

    protected $table = 'wp_schedules';

}
