<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\TestController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth:hydra,overwatch,cybertron');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth:hydra,overwatch,cybertron');

Route::get('/my-apps', [App\Http\Controllers\AppsController::class, 'index'])->name('my-apps')->middleware('auth:hydra,overwatch,cybertron');



###################### TRAINING MAINTENANCE ROUTES ############

route::get('/categories', [App\Http\Controllers\EditTrainingController::class, 'categories'])->name('categories')->middleware('auth:hydra,overwatch,cybertron,azmodeus','can:trainingMaintenance');
route::post('/create-category', [App\Http\Controllers\EditTrainingController::class, 'CreateCategory'])->name('createCategory')->middleware('auth:hydra,overwatch,cybertron,azmodeus','can:trainingMaintenance');

route::get('/create-training/{id?}', [App\Http\Controllers\EditTrainingController::class, 'moduleShow'])->name('createTraining')->middleware('auth:hydra,overwatch,cybertron','can:trainingMaintenance');

route::post('/create-module', [App\Http\Controllers\EditTrainingController::class, 'storeModule'])->name('storeModule')->middleware('auth:hydra,overwatch,cybertron','can:trainingMaintenance');

route::get('/training-splash', [App\Http\Controllers\EditTrainingController::class, 'splash'])->name('trainingsplash')->middleware('auth:hydra,overwatch,cybertron','can:trainingMaintenance');
route::get('/training-invite', [App\Http\Controllers\EditTrainingController::class, 'trainingInvite'])->name('trainingInvite')->middleware('auth:hydra,overwatch,cybertron','can:trainingMaintenance');
route::get('/new-module/{id}', [App\Http\Controllers\EditTrainingController::class, 'newModule'])->name('newModule')->middleware('auth:hydra,overwatch,cybertron','can:trainingMaintenance');

route::get('/create-lesson/{id}', [App\Http\Controllers\EditTrainingController::class, 'createLesson'])->name('createLesson')->middleware('auth:hydra,overwatch,cybertron','can:trainingMaintenance');

route::post('/store-module', [App\Http\Controllers\EditTrainingController::class, 'storeModule'])->name('storeModule')->middleware('auth:hydra,overwatch,cybertron','can:trainingMaintenance');
route::post('/store-lesson', [App\Http\Controllers\EditTrainingController::class, 'storeLesson'])->name('storeLesson')->middleware('auth:hydra,overwatch,cybertron','can:trainingMaintenance');

route::get('/create-assessment/{id}', [App\Http\Controllers\AssessmentController::class, 'createAssessment'])->name('createAssessment')->middleware('auth:hydra,overwatch,cybertron','can:trainingMaintenance');
route::post('/store-assessment', [App\Http\Controllers\AssessmentController::class, 'storeAssessment'])->name('storeAssessment')->middleware('auth:hydra,overwatch,cybertron','can:trainingMaintenance');

##################### Trainee progress #############################


route::get('trainee-progress', [App\Http\Controllers\TraineeProgress::class, 'index'])->name('traineeProgress')->middleware('auth:hydra,overwatch,cybertron','can:trainingMaintenance');
route::get('trainee-compliance/{id}', [App\Http\Controllers\TraineeProgress::class, 'compliance'])->name('traineeCompliance')->middleware('auth:hydra,overwatch','can:trainingMaintenance');



#################### Images ####################################

route::post('/image-upload', [App\Http\Controllers\ImagesController::class, 'store'])->name('imagesUpload')->middleware('auth:hydra,overwatch,cybertron','can:trainingMaintenance');


################### MY TRAINING ################################

route::get('/my-training', [App\Http\Controllers\MyTrainingController::class, 'index'])->name('myTraining')->middleware('auth:hydra,overwatch,cybertron');
route::get('/view-training/{id}/{index}', [App\Http\Controllers\MyTrainingController::class, 'viewTraining'])->name('viewTraining')->middleware('auth:hydra,overwatch,cybertron');
route::get('/finish-module/{id}', [App\Http\Controllers\MyTrainingController::class, 'finishModule'])->name('finishModule')->middleware('auth:hydra,overwatch,cybertron');

route::get('/begin-assessment/{id}', [App\Http\Controllers\MyTrainingController::class, 'beginAssessment'])->name('beginAssessment')->middleware('auth:hydra,overwatch,cybertron');
route::post('/finish-assesment', [App\Http\Controllers\MyTrainingController::class, 'finishAssessment'])->name('finishAssessment')->middleware('auth:hydra,overwatch,cybertron');


########################## ONBOARDING ############################

route::get('/hr/onboarding', [App\Http\Controllers\OnboardingController::class, 'index'])->name('onBoarding')->middleware('auth:hydra,overwatch,cybertron','can:onBoarding');

route::get('/hr/new-starter/{batch_no?}', [App\Http\Controllers\OnboardingController::class, 'show'])->name('newStarter')->middleware('auth:hydra,overwatch,cybertron','can:onBoarding');

route::get('view_new_starter/{batch_no?}', [App\Http\Controllers\OnboardingController::class, 'view'])->name('view_new_starter')->middleware('auth:hydra,overwatch,cybertron','can:onBoarding');

route::post('hr/create_new_starter', [App\Http\Controllers\OnboardingController::class, 'create'])->name('create_new_starter')->middleware('auth:hydra,overwatch,cybertron','can:onBoarding');

route::get('hr/finish_up/{batch_no}', [App\Http\Controllers\OnboardingController::class, 'finishUp'])->name('finishUp')->middleware('auth:hydra,overwatch,cybertron','can:onBoarding');
route::post('/complete', [App\Http\Controllers\OnboardingController::class, 'complete'])->name('complete')->middleware('auth:hydra,overwatch,cybertron','can:onBoarding');
route::get('/view_all', [App\Http\Controllers\OnboardingController::class, 'viewAll'])->name('viewAll')->middleware('auth:hydra,overwatch,cybertron','can:onBoarding');
Route::get('/delete-batch/{batch_no}', [App\Http\Controllers\OnboardingController::class, 'deleteBatch'])->name('deleteBatch')->middleware('auth:hydra,overwatch,cybertron','can:onBoarding');

route::get('/view_all_intakes', [App\Http\Controllers\OnboardingController::class, 'viewAllIntakes'])->name('viewAllIntakes')->middleware('auth:hydra,overwatch,cybertron','can:onBoarding');

route::post('/complete-intake', [App\Http\Controllers\OnboardingController::class, 'completeIntake'])->name('completeIntake')->middleware('auth:hydra,overwatch,cybertron','can:onBoarding');


################################## Call Recording #################

route::get('/call-recording', [App\Http\Controllers\CallrecordingController::class, 'index'])->name('callRecording')->middleware('auth:hydra,overwatch,cybertron');



######################## AGENT ZONE ##########################

route::get('/agent-zone', function(){
    return View("agent-zone.agent-zone");})->name('agentZone')->middleware('auth:hydra,overwatch,cybertron');



########################TEST ###############################

route::get('/test',[TestController::class, 'test'])->middleware('can:it');

########################## Human resources ###########################

route::get('/human-resources', [App\Http\Controllers\HRController::class, 'index'])->name('humanResources')->middleware('auth:hydra,overwatch,cybertron','can:hr');


################ RECRUITMENT ##########

route::get('/recruitment', [App\Http\Controllers\RecruitmentController::class, 'index'])->name('recruitment')->middleware('auth:hydra,overwatch,cybertron','can:recruitment');
route::post('/recruitment/store', [App\Http\Controllers\RecruitmentController::class, 'store'])->name('recruitment.store')->middleware('auth:hydra,overwatch,cybertron','can:recruitment');

################ IT ###############################

route::get('/it', [App\Http\Controllers\ITController::class, 'index'])->name('it')->middleware('auth:hydra,overwatch,cybertron','can:it');
route::get('/it/recruitment', [App\Http\Controllers\ITController::class, 'recruitment'])->name('viewRecruitment')->middleware('auth:hydra,overwatch,cybertron','can:it');
route::get('it/campaign-mfinishanagement',[App\Http\Controllers\ITController::class, 'campaignManagement'])->name('campaignManagement')->middleware('auth:hydra,overwatch,cybertron','can:it');

route::post('/it/create-accounts', [App\Http\Controllers\CreateAccountsController::class, 'createAccounts'])->name('createAccounts')->middleware('auth:hydra,overwatch,cybertron','can:it');
route::get('it/offboarding', [App\Http\Controllers\ITController::class, 'itOffBoarding'])->name('itOffBoarding')->middleware('auth:hydra,overwatch,cybertron','can:it');
route::get('it/sync-wp', [App\Http\Controllers\ITController::class, 'syncWP'])->name('syncWP')->middleware('auth:hydra,overwatch,cybertron','can:it');
route::get('it/site-settings', [App\Http\Controllers\ITController::class, 'siteSettings'])->name('siteSettings')->middleware('auth:hydra,overwatch,cybertron','can:it');
route::get('it/create-wp', [App\Http\Controllers\ITController::class, 'createWP'])->name('createWP')->middleware('auth:hydra,overwatch,cybertron','can:it');

route::get('it/management-wp/disable', function(){
    return View("it.workplace.disable-workplace");})->name('disableWP')->middleware('auth:hydra,overwatch,cybertron','can:it','can:offBoarding');
route::get('it/management-wp', function(){
    return View("it.workplace-management");})->name('managementWP')->middleware('auth:hydra,overwatch,cybertron','can:it');


######################## OFFBOARDING ###########################

route::get('offboarding', [App\Http\Controllers\OffBoardingController::class, 'index'])->name('offBoarding')->middleware('auth:hydra,overwatch,cybertron','can:offBoarding');
route::get('offboarding/splash', [App\Http\Controllers\OffBoardingController::class, 'offBoardingSplash'])->name('offBoardingSplash')->middleware('auth:hydra,overwatch,cybertron','can:offBoarding');

####################### MY PROFILE #######################

route::get('my-profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('myProfile')->middleware('auth:hydra,overwatch,cybertron');


################################# ECO RETURNS ###############################################

route::get('returns', [App\Http\Controllers\ReturnsController::class, 'index'])->name('Returns');
route::get('returns-show', [App\Http\Controllers\ReturnsController::class, 'show'])->name('returnsShow')->middleware('auth:hydra,overwatch,cybertron','can:it');
route::post('returns-request',[App\Http\Controllers\ReturnsController::class, 'returnsRequest'])->name('returnsRequest');

###### TEAMS ################################################################################

Route::get('/teams', [App\Http\Controllers\TeamsController::class, 'index'])->name('teams')->middleware('auth:hydra,overwatch,cybertron','can:team-planner');

Route::post('teams/add-team', [App\Http\Controllers\TeamsController::class, 'addTeam'])->name('addTeam')->middleware('auth:hydra,overwatch,cybertron','can:team-planner');

####### LOGINS ######

route::get('logins', [App\Http\Controllers\LoginDetailsController::class, 'index'])->name('logins')->middleware('auth:hydra,overwatch,cybertron','can:credentials');
route::get('show-logins/{group}', [App\Http\Controllers\LoginDetailsController::class, 'showLogins'])->name('showLogins')->middleware('auth:hydra,overwatch,cybertron', 'can:credentials');


###### WEB PUSH #####

route::post('save-token',[App\Http\Controllers\TokenController::class, 'saveToken'])->name('saveToken')->middleware('auth:hydra,overwatch,cybertron');



########################TEST ###############################

route::get('/test',[TestController::class, 'test'])->middleware('can:it');

route::post('/natural-hr',[App\Http\Controllers\WebHooksController::class, 'naturalHR'])->name('naturalHr');
