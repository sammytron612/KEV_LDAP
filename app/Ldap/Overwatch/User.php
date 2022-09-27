<?php

namespace App\Ldap\Overwatch;

use LdapRecord\Models\Model;
use LdapRecord\Models\ActiveDirectory\User as BaseUser;


class User extends BaseUser
{
    /**
     * The object classes of the * model.
     *
     * @var array
     */
    protected $connection = 'overwatch';


}
