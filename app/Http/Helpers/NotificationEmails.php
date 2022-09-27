<?php

namespace App\Http\Helpers;


class NotificationEmails
{
    public function __construct() {
        self::emailOn();
      }

    public static function emailOn()
    {

        if(session()->has('notifications'))
            {
            if(session('notifications'))
                {
                    return false;
                }
                else
                {
                    return true;
                }
            }
        else
        {
            return true;
        }
    }
}
