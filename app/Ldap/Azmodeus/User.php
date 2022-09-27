<?php

namespace App\Ldap\Azmodeus;

use LdapRecord\Models\ActiveDirectory\User as BaseUser;

class User extends BaseUser
{
    /**
     * The object classes of the * model.
     *
     * @var array
     */
    protected $connection = 'cybertron';
}

