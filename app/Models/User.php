<?php

namespace App\Models;
/*
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Auth\Authenticatable;
use LdapRecord\Laravel\Auth\AuthenticatesWith*;
use *Record\Laravel\Auth\HasUser;
use Illuminate\Database\Eloquent\SoftDeletes;
*/

use LdapRecord\Laravel\Auth\HasLdapUser;
use LdapRecord\Laravel\Auth\LdapAuthenticatable;
use LdapRecord\Laravel\Auth\AuthenticatesWithLdap;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements LdapAuthenticatable
{
    use Notifiable, AuthenticatesWithLdap, HasLdapUser, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'domain',
        'upn',
        'workplace_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function assigned_training()
    {
        return $this->hasMany(AssignedTraining::class, 'user_id');
    }

    public function batches()
    {
        return $this->hasMany(Batches::class, 'user_id');
    }

    public function offboarding_user()
    {
        return $this->hasOne(Offboarding::class, 'user_id', 'id');
    }

    public function offboarding_requestor()
    {
        return $this->hasMany(Offboarding::class, 'id', 'submitted_by');
    }

    public function workplaces()
    {
        return $this->hasOne(workplace::class, 'workplace_id', 'workplace_id');
    }

    public function team_member()
    {
        return $this->hasOne(TeamMembers::class, 'id', 'user_id');
    }

    public function new_starter()
    {
        return $this->hasOne(Teams::class, 'id', 'user_id');
    }

    public function manager()
    {
        return $this->hasOne(Teams::class, 'manager', 'id');
    }

    public function device_tokens()
    {
        return $this->hasMany(DeviceTokens::class, 'user_id');
    }
}