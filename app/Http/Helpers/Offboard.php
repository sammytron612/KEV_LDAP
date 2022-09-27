<?php

namespace App\Http\Helpers;


use LdapRecord\Models\ActiveDirectory\User;
use LdapRecord\Models\ActiveDirectory\OrganizationalUnit;
use Illuminate\Support\Facades\Notification;
use LdapRecord\Container;
use App\Models\AssignedTraining;
use App\Models\Offboarding;
use App\Http\Traits\RemovePlannerEntry;
use App\Models\User as Local;
use App\Models\workplace as LocalWP;
use App\Http\Helpers\Workplace;
use App\Notifications\DisableWorkplaceSuccess;
use App\Notifications\DisableWorkplaceFailure;
use App\Http\Helpers\NotificationEmails;
use App\Notifications\ADsuccessNotification;
use App\Notifications\ADfailNotification;



class Offboard
{

    use RemovePLannerEntry;

    private function removeSubsideries($userId)
    {

        AssignedTraining::where('user_id',$userId)->delete();

        $this->PlannerRemove($userId);

        return;
    }

    private function findADUser($domain, $sam)
    {

        $connection = Container::getConnection($domain);
        container::addConnection($connection);

        $user = User::where('samaccountname','=', $sam)->first();

        return $user;
    }

    private function disableADUser($to_disable, $name, $requestor)
    {
        $data = [
            'name' => $name,
            'requestor' => $requestor,

        ];

        $ou = OrganizationalUnit::findBy('ou', 'Offboarded');

        try {

            $to_disable->move($ou);
            $to_disable->userAccountControl = 2;
            $to_disable->save();

            if(NotificationEmails::emailOn())
            {
                Notification::route('mail', ['k'])
                    ->notify(new ADsuccessNotification($data));
            }
        }
        catch (\Exception $e) {

            if(NotificationEmails::emailOn())
            {
                Notification::route('mail', [''])
                    ->notify(new ADfailNotification($data));
            }
        }

        return;

    }

    public function ScheduleWP()
    {
        $toDisable = Offboarding::whereNULL('completed')
                                ->where('type','WP')
                                ->whereDate('leave_date','<=', now())
                                ->get();


        foreach($toDisable as $disable)
        {
            $wp = new Workplace;
            $response = $wp->disableWP($disable->workplace_id);

            $data = ['name' => $disable->name,
                    'requestor' => $disable->requestor->name,
            ];

            Offboarding::where('workplace_id',$disable->workplace_id)->update(['completed'=> now()]);
            LocalWP::where('workplace_id', $disable->workplace_id)->delete();


            if($response->successful())
            {
                if(NotificationEmails::emailOn())
                {
                    Notification::route('mail', [''])
                        ->notify(new DisableWorkplaceSuccess($data));
                }
            }
            else
            {
                if(NotificationEmails::emailOn())
                {
                    Notification::route('mail', [''])
                        ->notify(new DisableWorkplaceFailure($data));
                }
            }

        }

        return;
    }


    public function leavers()
    {

        $users = Offboarding::with('users')->where('type','AD')
                    ->whereDate('leave_date','<=', now())
                    ->whereNull('completed')
                    ->get();


        foreach($users as $user)
        {

            $this->removeSubsideries($user->user_id);

	        $user->completed = now();

            $user->save();

            $domain = $user->users->domain;
            $sam = $user->users->username;
            $name = $user->users->name;
            $requestor = $user->requestor->name;

            $to_disable = $this->findADUser($domain, $sam);

            if($to_disable)

            {
                $this->disableADUser($to_disable,$name, $requestor);
            }
            else
            {

                $data = [
                    'name' => $name,
                    'requestor' => $requestor
                ];

                if(NotificationEmails::emailOn())
                {
                    Notification::route('mail', [''])
                        ->notify(new ADfailNotification($data));
                }
            }

            Local::find($user->user_id)->delete();


        }


        return true;

    }

    public function immediate($userId)
    {

        $this->removeSubsideries($userId);

        $user = Offboarding::where('type','AD')
                    ->where('user_id',$userId)
                    ->first();

        $user->completed = now();
        $user->save();

        $domain = $user->users->domain;
        $sam = $user->users->username;
        $name = $user->users->name;
        $requestor = $user->requestor->name;

        $to_disable = $this->findADUser($domain, $sam);

        if($to_disable)

            {
                $this->disableADUser($to_disable,$name, $requestor);
            }
            else
            {

                $data = [
                    'name' => $name,
                    'requestor' => $requestor
                ];

                if(NotificationEmails::emailOn())
                {
                    Notification::route('mail', [''])
                        ->notify(new ADfailNotification($data));
                }
            }

        Local::find($userId)->delete();

        return;

    }


}
