<?php
namespace App\Services;

use App\Models\User;


class NotificationService
{
    public function SendNotification(User $user,$message)
    {


        $end_point = 'https://api.webpushr.com/v1/notification/send/sid';
        $http_header = array(
            "Content-Type: Application/Json",
            "webpushrKey: bfee6b6e540ec0a37b1ae12840a7fa9f",
            "webpushrAuthToken: 45577"
        );

        foreach($user->device_tokens as $token)
        {
            $req_data = array(
                'title' 			=> $message['title'], //required
                'message' 		=> $message['message'], //required
                'target_url'	=> url($message['target_url']), //required
                'icon'      => url("images/eco1.png"),
                'sid'		=> $token->token //required
            );
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HTTPHEADER, $http_header);
            curl_setopt($ch, CURLOPT_URL, $end_point );
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($req_data) );
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
        }

        return;

    }


}
