<?php

namespace App\Http\Controllers;

use App\Models\Onboardings;
use App\Models\Batches;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use LdapRecord\Models\ActiveDirectory\Group;
use LdapRecord\Container;
use App\Notifications\OnboardingNotification;
use Illuminate\Support\Facades\Notification;
use LdapRecord\Models\ActiveDirectory\OrganizationalUnit;
use LdapRecord\Models\ActiveDirectory\User;
use App\Models\User as localUser;
use App\Http\Helpers\Workplace as wp;
use LdapRecord\Models\ActiveDirectory\Entry;
use App\Http\Helpers\NotificationEmails;
use App\Models\AssignedTraining;


class CreateAccountsController extends Controller
{

    private function accounts_creation($batch, $mail)
    {
        $site = $batch->site;
        $batch_no = $batch->batch_no;

        ####### doxford #########

        if ($site == "doxford") {

            $call = "powershell.exe -executionpolicy bypass -NoProfile -File C:/Scripts/create_accounts.ps1 -batch $batch_no -mail $mail";
            $result = Shell_Exec($call);

            return;
        }


        //$call = "powershell.exe -executionpolicy bypass -NoProfile -File C:/Scripts/create_accounts_sheffield.ps1 -batch $batch_no -mail $mail";
        //$result = Shell_Exec($call);
        //return;
    }

    private function getOuGroups($batch, $ou)
    {

        if ($batch->site == "sheffield") {
            $domain = "cybertron";
        } else {
            $domain = "overwatch";
        }

        $connection = Container::getConnection($domain);

        container::addConnection($connection);

        $ou = OrganizationalUnit::find($ou);

        $first = Entry::in($ou)->limit(2)->get();
        if ($first)
            if (isset($first[1]['cn'][0])) {
                $ADuser = User::findBy('cn', $first[1]['cn'][0]);
                $groups = $ADuser->groups()->recursive()->get();
            } else {
                $groups = null;
            }
        else {
            $groups = null;
        }

        return ['domain' => $domain, 'groups' => $groups, 'ou' => $ou];
    }

    private function importUser($domain, $sam)
    {
        if (!localUser::where('username', $sam)->where('domain', $domain)->exists()) {
            Artisan::call('*:import', ['provider' => $domain, '--no-interaction', '--filter' => "(samaccountname=$sam)"]);
        }
        return localUser::where('username', $sam)->where('domain', $domain)->first();
    }

    private function assignTraining($localUser)
    {
        $modules = [8, 9, 10];

        foreach ($modules as $module) {

            $new = new AssignedTraining;
            $new->user_id = $localUser->id;
            $new->module_id = $module;
            $new->save();
        }
    }


    public function createAccounts(Request $request)
    {

        $newEntries = array();
        $workplaceAccount = new wp;

        $ou = $request->ou;


        if ($request->has('email')) {
            $mail = 1;
        } else {
            $mail = 0;
        }

        if ($request->has('workplace')) {
            $workplace = 1;
        } else {
            $workplace = 0;
        }

        $batch_no = $request->batch_no;
        $batch = Batches::where('batch_no', $batch_no)->first();
        $batch->accounts_created = 1;
        $batch->save();

        $this->accounts_creation($batch, $mail);
        $response = $this->getOuGroups($batch, $ou);

        $ou = $response['ou'];
        $groups = $response['groups'];
        $domain = $response['domain'];

        $onboards = Onboardings::where('batch_no', $batch_no)
            ->where('completed', 1)
            ->where('internal_transfer', 0)
            ->where('account', 0)
            ->get();

        $location = $batch->site;
        $start_date = $batch->start_date;

        foreach ($onboards as $user) {

            $sam = $user->sam;
            $ADuser = User::findBy('samaccountname', $sam);
            $newEntry = array();

            if ($ADuser) {

                if ($ou) {
                    $ADuser->move($ou);
                }

                if ($groups) {
                    foreach ($groups as $group) {
                        if ($group['cn'][0] == "Domain Users") {
                            continue;
                        }

                        $group->members()->attach($ADuser);
                    }
                }

                $localUser = $this->importUser($domain, $sam);

                if ($localUser) {
                    $user->account = 1;
                    $user->save();

                    $newEntry += [
                        'name' => $localUser->name,
                        'login' => $sam,
                        'AD' => 'SUCCESS',
                        'location' => $location,
                        'start_date' => \Carbon\Carbon::parse($start_date)->format('d/m/Y'),
                        'campaign' => $batch->campaigns->title
                    ];

                    if ($workplace) {

                        $response = $workplaceAccount->create($user, $localUser->id);

                        if ($response) {
                            $newEntry += ['workplace' => 'SUCCESS'];


                            $user->workplace = "Created";
                        } else {
                            $newEntry += ['workplace' => 'fail'];
                            $user->workplace = "Fail";
                        }
                    } else {
                        $newEntry += ['workplace' => 'not provisioned'];
                    }

                    $this->assignTraining($localUser);
                } else {
                    $newEntry += [
                        'name' => $sam,
                        'AD' => 'FAIL',
                        'workplace' => 'not provisioned',
                        'location' => 'na',
                        'start_date' => 'na',
                        'campaign' => 'na'

                    ];

                    $user->workplace = 'Not provisioned';

                    $batch->accounts_created = 0;
                    $batch->save();
                }
            }

            array_push($newEntries, $newEntry);
            $user->save();
        }

        if (NotificationEmails::emailOn()) {
            if ($batch->site == "sheffield") {
                Notification::route('mail', ["*", "*",])
                    ->notify(new OnboardingNotification($newEntries));
            } else {
                Notification::route('mail', ["*"])
                    ->notify(new OnboardingNotification($newEntries));
            }
        }




        return redirect()->route('viewAllIntakes')->withSuccess('Check email for Account creation success');
    }
}