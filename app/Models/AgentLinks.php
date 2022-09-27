<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class AgentLinks extends Model
{
    protected $fillable = ['campaign_id', 'title','description','url','image','icon'];
    public $timestamps = false;
}
