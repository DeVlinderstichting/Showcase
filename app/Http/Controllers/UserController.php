<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Password;
use Auth;
use DB;
use Hash;
use Str;

//this controller is in charge of creating a package with all the user information, required to set up the app (the first time). This package should contain the species/settings/eba's etc 
class UserController extends Controller
{
    public function showLogin()
    {
        return view ('userLogin');
    }

    public function showRegister()
    {
        $regions = \App\Models\Region::orderBy('name')->select('id','name')->get();
        return view ('userRegister', ['regions' => $regions]);
    }

    public function showForgotPassword()
    {
        return view ('userForgotPassword');
    }

    public function showBadges(User $user)
    {
        return view ('userBadges', ['user' => $user]);
    }

    public function showUserStats(User $user)
    {
        $this->authenticateUser();
        $user = Auth::user();
        $allObs = $user->observations()->get();
        $allObsAllUsers = \App\Models\Observation::whereHas('visit', function($q_v) {
            $q_v->whereHas('users', function($q_u) {
                $q_u->where('share_data', true); }); })->get();
        $allSpIds = $allObs->pluck('species_id')->unique(); 
        $speciesNr = $allSpIds->count();
        $spList = \App\Models\Species::whereIn('id', $allSpIds)->get();
        $spGroups = $spList->pluck('speciesgroup_id')->unique();
        $spGroupCount = $spGroups->count();
        $speciesNr = $allObs->pluck('species_id')->unique()->count();
        $nrOfInsects = $allObs->pluck('number')->sum();

        ##select species count per year for user and for eba 
        ## + all indivs per species for me and for eba (last year)
        $dateOneYearAgo = Carbon::now()->subYear()->toDateTimeString();

        $getAllSpCountsQLine="select count(distinct(species_id)), sum(number), extract (year from startdate) as year, extract (month from startdate) as month from visits  join observations on visits.id = observations.visit_id where visits.startdate > '$dateOneYearAgo' group by year, month";
        $getUserSpCountQLine="select count(distinct(species_id)), sum(number), extract (year from startdate) as year, extract (month from startdate) as month from visits  join observations on visits.id = observations.visit_id where visits.startdate > '$dateOneYearAgo' and visits.user_id = $user->id group by year, month";

        $countPerMonthAllSp = DB::select(DB::raw($getAllSpCountsQLine));
        $countPerMonthUser = DB::select(DB::raw($getUserSpCountQLine));

        $countPerSpeciesUser = DB::select(DB::raw("select distinct(species_id), sum(number) from visits join observations on visits.id = observations.visit_id where visits.user_id = $user->id group by species_id"));
        $countPerSpeciesAll = DB::select(DB::raw("select distinct(species_id), sum(number) from visits join observations on visits.id = observations.visit_id where species_id in (select distinct(species_id) from visits join observations on visits.id = observations.visit_id where visits.user_id = $user->id group by species_id) group by species_id"));

        $userMessages = $user->usersMessages()->get()->pluck('pushmessage_id');
        $messages = \App\Models\PushMessage::whereIn('id', $userMessages)->get();
        $allObs = $user->observations()->get();

        $regionIds = $user->regions()->pluck('region_id');

        $ebaSpeciesCountSqLine = "select count(distinct(species_id)) as spcount, sum(observations.number) as indivcount from observations join visits on visits.id=visit_id where";
        $ebaTotalVisitTimeSqLine = "select sum(enddate-startdate) as totalvisittime, sum(st_length(location)) as totalvisitlength from visits where";
        $ebaVisitCountSql = "select count(id) as visitcount from visits where";
        $ebaLandscape = "select landusetype_id, count(distinct(species_id)) as spcount, sum(observations.number) as indivcount from visits join observations on visits.id=visit_id where";
        $userLandscape = "select landusetype_id, count(distinct(species_id)) as spcount, sum(observations.number) as indivcount from visits join observations on visits.id=visit_id where user_id = $user->id";
        $ebaManagement = "select managementtype_id, count(distinct(species_id)) as spcount, sum(observations.number) as indivcount from visits join observations on visits.id=visit_id where";
        $userManagement = "select managementtype_id, count(distinct(species_id)) as spcount, sum(observations.number) as indivcount from visits join observations on visits.id=visit_id where user_id = $user->id";

        $isFirst = true;
        foreach($regionIds as $reId)
        {
            if (!$isFirst)
            {
                $ebaSpeciesCountSqLine .= " OR";
                $ebaTotalVisitTimeSqLine .= " OR";
                $ebaVisitCountSql .= " OR";
                $ebaLandscape .= " OR";
                $ebaManagement .= " OR";
            }
            $ebaSpeciesCountSqLine .= " ((ST_Intersects ((select location from regions where id = $reId), visits.location)=true))";
            $ebaTotalVisitTimeSqLine .= " ((ST_Intersects ((select location from regions where id = $reId), visits.location)=true))";
            $ebaVisitCountSql .= " ((ST_Intersects ((select location from regions where id = $reId), visits.location)=true))";
            $ebaLandscape .= " ((ST_Intersects ((select location from regions where id = $reId), visits.location)=true))";
            $ebaManagement .= " ((ST_Intersects ((select location from regions where id = $reId), visits.location)=true))";
            $isFirst = false;
        }

        $ebaLandscape .= " and landusetype_id is not null group by landusetype_id";
        $userLandscape .= " and landusetype_id is not null group by landusetype_id";
        $ebaManagement .= " and managementtype_id is not null group by managementtype_id";
        $userManagement .= " and managementtype_id is not null group by managementtype_id";
        $ebaSpeciesCountSqRes = DB::select(DB::raw($ebaSpeciesCountSqLine));
        $ebaVisitTimeSqRes = DB::select(DB::raw($ebaTotalVisitTimeSqLine));
        $ebaVisitCountSqRes = DB::select(DB::raw($ebaVisitCountSql));
        $ebaLandscapeRes = DB::select(DB::raw($ebaLandscape));
        $ebaManagementRes = DB::select(DB::raw($ebaManagement));
        $userManagementRes = DB::select(DB::raw($userManagement));
        $userLandscapeRes = DB::select(DB::raw($userLandscape));


        $ebaSpeciesCount = $ebaSpeciesCountSqRes[0]->spcount;
        $ebaIndivCount = $ebaSpeciesCountSqRes[0]->indivcount;
        $ebaVisitCount = $ebaVisitCountSqRes[0]->visitcount;



        $userTotalVisitLengthRes = DB::select(DB::raw("select sum(enddate-startdate) as totalvisittime, sum(st_length(location)) as totalvisitlength from visits where user_id = $user->id"));
        

        $explodedVisitTimeUser = explode(":", $userTotalVisitLengthRes[0]->totalvisittime);
        $totalUserVisitTime = ($explodedVisitTimeUser[0]*60) + $explodedVisitTimeUser[1];
        $totalUserDistance = $userTotalVisitLengthRes[0]->totalvisitlength;


        $totalIndiv = 0;
        foreach($allObs as $obs)
        {
            $totalIndiv += $obs->number;
        }
        $userVisitCount = $user->visits()->get()->count();

        $totalEbaDistance = $ebaVisitTimeSqRes[0]->totalvisitlength;
        

        $userBadgeCount = \App\Models\UserBadgelevel::where('user_id', $user->id)->get()->count();
        $alluserIds = \App\Models\RegionsUsers::whereIn("region_id", $regionIds)->pluck('user_id');
        $ebaBadgeCount = \App\Models\UserBadgelevel::whereIn('user_id', $alluserIds)->get()->count();

        $explodedTimeEba = explode(":", $ebaVisitTimeSqRes[0]->totalvisittime);
        $totalEbaVisitTime = ($explodedTimeEba[0]*60) + $explodedTimeEba[1];

        return view('userStats', ['obsCount' => $allObs->count(), 'ebaSpeciesCount'=> $ebaSpeciesCount, 'userIndivCount' => $totalIndiv, 'ebaIndivCount' => $ebaIndivCount, 'userVisitCount' => $userVisitCount, 'ebaVisitCount' => $ebaVisitCount, 'spCount' => $speciesNr, 'spGroupCount' => $spGroupCount, 'nrOfInsects' => $nrOfInsects, 'allSpMonthlyData' => $countPerMonthAllSp, 'userSpMonthlyData' => $countPerMonthUser, 'countPerSpeciesUser' => $countPerSpeciesUser, 'ebaTotalVisitTime' => $totalEbaVisitTime, 'userTotalVisitTime' => $totalUserVisitTime, 'totalUserDistance' => $totalUserDistance, 'totalEbaDistance' => $totalEbaDistance, 'countPerSpeciesAll' => $countPerSpeciesAll, 'user' => $user, 'userMessages' => $messages, 'allUserObservations' => $allObs, 'allObservations' => $allObsAllUsers, 'ebaBadgeCount' => $ebaBadgeCount, 'userBadgeCount' => $userBadgeCount, 'ebaLandscape' => $ebaLandscapeRes,'ebaManagement' => $ebaManagementRes, 'userManagement' => $userManagementRes, 'userLandscape' => $userLandscapeRes]);
    }

    public function userLogin(Request $request)
    {
        $input = request()->all();
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);
      //  $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $fieldType = 'email';
        if(Auth::attempt(array($fieldType => $input['username'], 'password' => $input['password'])))
        {
            $user = Auth::user();
            $user->last_login_date = Carbon::now()->toDateTimeString();
            $user->save();
            return ($this->showHome());
        } 
        else 
        {
            return redirect()->route('showLogin')->withErrors(["username"=>"Ongeldige gebruikersnaam of wachtwoord"]);
            //    ->with('error','Email-Address And Password Are Wrong.');
        }
    }
    public function userLoginWithToken(Request $request)
    {
        $valDat = request()->validate([
            'username' => 'required',
            'token' => 'required',
            'redirect' => 'nullable'
        ]);
        $theUser = \App\Models\User::where('email', $valDat['username'])->where('accesstoken', $valDat['token'])->first();
        if ($theUser != null)
        {
            Auth::loginUsingId($theUser->id);
        }
        if (array_key_exists('redirect', $valDat))
        {
            return redirect($valDat['redirect']);
        }
        return redirect('/home');
    }
    public function showHome()
    {
        $this->authenticateUser();
        $user = Auth::user();
        $allObs = $user->observations()->get();
        $allObsAllUsers = \App\Models\Observation::whereHas('visit', function($q_v) {
            $q_v->whereHas('users', function($q_u) {
                $q_u->where('share_data', true); }); })->get();
        $allSpIds = $allObs->pluck('species_id')->unique(); 
        $speciesNr = $allSpIds->count();
        $spList = \App\Models\Species::whereIn('id', $allSpIds)->get();
        $spGroups = $spList->pluck('speciesgroup_id')->unique();
        $spGroupCount = $spGroups->count();
        $speciesNr = $allObs->pluck('species_id')->unique()->count();
        $nrOfInsects = $allObs->pluck('number')->sum();

        ##select species count per year for user and for eba 
        ## + all indivs per species for me and for eba (last year)
        $dateOneYearAgo = Carbon::now()->subYear()->toDateTimeString();

     /*   select count(distinct(species_id)), 
extract (year from startdate) as year, 
extract (month from startdate) as month from visits 
join observations on visits.id = observations.visit_id 
where visits.startdate > '2021-01-01' 
group by year, month */

        $getAllSpCountsQLine="select count(distinct(species_id)), sum(number), extract (year from startdate) as year, extract (month from startdate) as month from visits  join observations on visits.id = observations.visit_id where visits.startdate > '$dateOneYearAgo' group by year, month";
        $getUserSpCountQLine="select count(distinct(species_id)), sum(number), extract (year from startdate) as year, extract (month from startdate) as month from visits  join observations on visits.id = observations.visit_id where visits.startdate > '$dateOneYearAgo' and visits.user_id = $user->id group by year, month";

       // $getAllSpCountsQLine= "select species_id, sum(number), extract (year from startdate) as year from visits  join observations on visits.id = observations.visit_id where visits.startdate > $dateOneYearAgo group by species_id, year";
       // $getUserSpCountQLine = "select species_id, sum(number), extract (year from startdate) as year from visits join observations on visits.id = observations.visit_id where visits.startdate > $dateOneYearAgo and visits.user_id = $user->id group by species_id, year";
        $countPerMonthAllSp = DB::select(DB::raw($getAllSpCountsQLine));
        $countPerMonthUser = DB::select(DB::raw($getUserSpCountQLine));

        $countPerSpeciesUser = DB::select(DB::raw("select distinct(species_id), sum(number) from visits join observations on visits.id = observations.visit_id where visits.user_id = $user->id group by species_id"));
        $countPerSpeciesAll = DB::select(DB::raw("select distinct(species_id), sum(number) from visits join observations on visits.id = observations.visit_id where species_id in (select distinct(species_id) from visits join observations on visits.id = observations.visit_id where visits.user_id = $user->id group by species_id) group by species_id"));

        $userMessages = $user->usersMessages()->get()->pluck('pushmessage_id');
        $messages = \App\Models\PushMessage::whereIn('id', $userMessages)->get();
        $allObs = $user->observations()->get();

        $regionIds = $user->regions()->pluck('region_id');

       // $ebaVisitCount = DB::select(DB::raw("select count(visit_id) from visits where //\App\Models\Visit::whereIn('region_id', $regionIds)->get()->count();

        $ebaSpeciesCountSqLine = "select count(distinct(species_id)) as spcount, sum(observations.number) as indivcount from observations join visits on visits.id=visit_id where";
        $ebaTotalVisitTimeSqLine = "select sum(enddate-startdate) as totalvisittime, sum(st_length(location)) as totalvisitlength from visits where";
        $ebaVisitCountSql = "select count(id) as visitcount from visits where";
        $isFirst = true;
        foreach($regionIds as $reId)
        {
            if (!$isFirst)
            {
                $ebaSpeciesCountSqLine .= " OR";
                $ebaTotalVisitTimeSqLine .= " OR";
                $ebaVisitCountSql .= " OR";
            }
            $ebaSpeciesCountSqLine .= " ((ST_Intersects ((select location from regions where id = $reId), visits.location)=true))";
            $ebaTotalVisitTimeSqLine .= " ((ST_Intersects ((select location from regions where id = $reId), visits.location)=true))";
            $ebaVisitCountSql .= " ((ST_Intersects ((select location from regions where id = $reId), visits.location)=true))";
            $isFirst = false;
        }
        $ebaSpeciesCountSqRes =  DB::select(DB::raw($ebaSpeciesCountSqLine));
        $ebaVisitTimeSqRes =  DB::select(DB::raw($ebaTotalVisitTimeSqLine));
        $ebaVisitCountSqRes =  DB::select(DB::raw($ebaVisitCountSql));
        $ebaSpeciesCount = $ebaSpeciesCountSqRes[0]->spcount;
        $ebaIndivCount = $ebaSpeciesCountSqRes[0]->indivcount;
        $ebaVisitCount = $ebaVisitCountSqRes[0]->visitcount;

        $userTotalVisitLengthRes = DB::select(DB::raw("select sum(enddate-startdate) as totalvisittime, sum(st_length(location)) as totalvisitlength from visits where user_id = $user->id"));
        

        $explodedVisitTimeUser = explode(":", $userTotalVisitLengthRes[0]->totalvisittime);
        $totalUserVisitTime = ($explodedVisitTimeUser[0]*60) + $explodedVisitTimeUser[1];
        $totalUserDistance = $userTotalVisitLengthRes[0]->totalvisitlength;


        $totalIndiv = 0;
        foreach($allObs as $obs)
        {
            $totalIndiv += $obs->number;
        }
        $userVisitCount = $user->visits()->get()->count();

        $totalEbaDistance = $ebaVisitTimeSqRes[0]->totalvisitlength;
        

        $userBadgeCount = \App\Models\UserBadgelevel::where('user_id', $user->id)->get()->count();
        $alluserIds = \App\Models\RegionsUsers::whereIn("region_id", $regionIds)->pluck('user_id');
        $ebaBadgeCount = \App\Models\UserBadgelevel::whereIn('user_id', $alluserIds)->get()->count();

        $explodedTimeEba = explode(":", $ebaVisitTimeSqRes[0]->totalvisittime);
        $totalEbaVisitTime = ($explodedTimeEba[0]*60) + $explodedTimeEba[1];

        return view('userHome', ['obsCount' => $allObs->count(), 'ebaSpeciesCount'=> $ebaSpeciesCount, 'userIndivCount' => $totalIndiv, 'ebaIndivCount' => $ebaIndivCount, 'userVisitCount' => $userVisitCount, 'ebaVisitCount' => $ebaVisitCount, 'spCount' => $speciesNr, 'spGroupCount' => $spGroupCount, 'nrOfInsects' => $nrOfInsects, 'allSpMonthlyData' => $countPerMonthAllSp, 'userSpMonthlyData' => $countPerMonthUser, 'countPerSpeciesUser' => $countPerSpeciesUser, 'ebaTotalVisitTime' => $totalEbaVisitTime, 'userTotalVisitTime' => $totalUserVisitTime, 'totalUserDistance' => $totalUserDistance, 'totalEbaDistance' => $totalEbaDistance, 'countPerSpeciesAll' => $countPerSpeciesAll, 'user' => $user, 'userMessages' => $messages, 'allUserObservations' => $allObs, 'allObservations' => $allObsAllUsers, 'ebaBadgeCount' => $ebaBadgeCount, 'userBadgeCount' => $userBadgeCount]);
    }
    public function showSettings()
    {
        $this->authenticateUser();
        $user = Auth::user();
        return view('userSettings', ['user' => $user]);
    }

    public function changePassword()
    {
        $this->authenticateUser();
        $user = Auth::user();
        return view('userPassword', ['user' => $user]);
    }

    public function savePassword()
    {
        $this->authenticateUser();
        $user = Auth::user();
        $valDat = request()->validate([
            'oldPassword' => 'required',
            'newPassword' => ['required', 'alpha_num_underscore_minus_dot_at_space', 'min:5', 'max:100'],
            'newPasswordCheck' => 'required'
        ]);

        // check old password
        if(!Hash::check($valDat['oldPassword'], $user->password))
        {
            return redirect()->route('changePassword')->withErrors(["oldPassword" => "Old password is incorrect"]);
        }

        // validate new password
        if($valDat['newPassword'] != $valDat['newPasswordCheck'])
        {
            return redirect()->route('changePassword')->withErrors(["newPasswordCheck" => "New passwords do not match"]);
        }

        $user->password = Hash::make($valDat['newPassword']);
        $user->save();
        return back()->with('status', 'Your new password has been saved!');
        //return view('userSettings', ['user' => $user])->with('status', 'Your new password has been saved!');
    }

    public function emailPassword(Request $request)
    {
        $request->validate([
            'email' => ['required', 'valid_email', 'exists:users,email', 'max:100']
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withInput($request->only('email'))
                        ->withErrors(['email' => __($status)]);
    }

    public function resetPassword(Request $request, $token)
    {
        return view('resetPassword', ['request' => $request]);
    }

    public function resetPasswordSave(Request $request)
    {
        $valDat = $request->validate([
            'token' => 'required',
            'email' => ['required', 'valid_email', 'exists:users,email'],
            'password' => ['required', 'alpha_num_underscore_minus_dot_at_space', 'min:5', 'max:100'],
            'password_confirmation' => 'required'
        ]);

        if($valDat['password'] != $valDat['password_confirmation']) // validate new password
        {
            return redirect()->route('password.reset', ['token'=>$valDat['token'],'email'=>$valDat['email']])->withErrors(["password" => "New passwords do not match"]);
        }

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        return $status == Password::PASSWORD_RESET
                    ? redirect()->route('showLogin')->with('status', __($status))
                    : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);

    }

    public function setUserSettingsAjax()
    {
        $this->authenticateUser();
        $valDat = request()->validate([
            'settingsname' => Rule::in(['sciName', 'prevSeen', 'showCommon', 'shareData', 'preferedLanguage']),
            'settingsvalue' => ['required', 'integer', 'between:0,1'],
            'language' => ['required', 'string',
                'in:en,fr,es,pt,it,de,dk,nl,no,se,fi,ee,lv,lt,pl,cz,sk,hu,au,ch,si,hr,ba,rs,me,al,gr,bg,ro']
        ]);
        $user = Auth::user();
        if ($valDat['settingsname'] == 'sciName')
        {
            $user->sci_names = $valDat['settingsvalue'];
        }
        if ($valDat['settingsname'] == 'prevSeen')
        {
            $user->show_previous_observed_species = $valDat['settingsvalue'];
        }
        if ($valDat['settingsname'] == 'showCommon')
        {
            $user->show_only_common_species = $valDat['settingsvalue'];
        }
        if ($valDat['settingsname'] == 'preferedLanguage')
        {
            $user->prefered_language = $valDat['language'];
        }
        if ($valDat['settingsname'] == 'shareData')
        {
            $user->share_data = $valDat['settingsvalue'];
        }
        $user->save();
    }
    public function setUserRecordingLevelAjax()
    {
        $this->authenticateUser();
        $valDat = request()->validate([
            'speciesgroup_id' => ['required', 'exists:speciesgroups,id'],
            'recordinglevel_id' => ['required', 'exists:recordinglevels,id']
        ]);
        $user = Auth::user();
        $found = false;
        $recLevel = $user->speciesgroupsRecordingLevels()->where('speciesgroup_id', $valDat['speciesgroup_id'])->first();
        if ($recLevel == null)
        {
            \App\Models\SpeciesgroupsUsers::create(['user_id' => $user->id, 'speciesgroup_id' => $valDat['speciesgroup_id'], 'recordinglevel_id' => $valDat['recordinglevel_id']]);
        }
        else 
        {
            $recLevel->recordinglevel_id = $valDat['recordinglevel_id'];
            $recLevel->save();
        }
    }

    public function showPushMessages()
    {
        $this->authenticateUser();
        $user = Auth::user();
        $mes = $user->usersMessages()->get();
        return view('userMessages',['messages' => $mes]);
    }

    public function requestUserPackage()
    {
        $valDat = request()->validate([
            'username' => 'required',
            'password' => 'nullable',
            'accesstoken' => 'nullable',
            'datapackage' => 'nullable'
        ]);

        if ((array_key_exists('password', $valDat)) || (array_key_exists('accesstoken', $valDat)))
        {
            $authOk = false;
            //check password FIRST!! (the app can also send an empty accesstoken, with a password)
            if (array_key_exists('password', $valDat)) //do regular login 
            {
                if(auth()->attempt(array('email' => $valDat['username'], 'password' => $valDat['password']))) 
                {
                    $authOk = true;
                }
            }
            else //login using accesstoken 
            {
                if (strlen($valDat['accesstoken']) < 30) //check this because the first time a username+password and an empty accesstoken has to be accepted
                {
                    $authOk = false; //invalid accesstoken, we are done
                }
                else 
                {   
                    $theUser = \App\Models\User::where('email', $valDat['username'])->where('accesstoken', $valDat['accesstoken'])->first();
                    if ($theUser != null)
                    {
                        $authOk = true;
                        Auth::login($theUser);
                    }
                }
            }

            if ($authOk)
            {
                if (array_key_exists('datapackage', $valDat))
                {
                    $user = Auth::user();
                //    return gettype($valDat['datapackage']);
                 //   return 15;
                 
                  
            //      return $dat.usersettings;
               //   return $dataPackage['usersettings.userSettings.preferedLanguage;
                    $res = $this->processUserDataPackage($user, $valDat['datapackage']);
                    $user->updateBadges();
                 //   return $res;
                }
                return Auth::user()->buildUserPackage();
            }
        }
        return "authentication failed";      
    }

    public function serveDataDownload()
    {
        $this->authenticateUser();

        $headers = array('date', 'recordingtype', 'species name', 'species genus', 'species taxon', 'number', 'location');
        $data = []; //array of arrays containing items in same order as header

        $user = Auth::user();
        $visitIds = \App\Models\Visit::where('user_id', $user->id)->pluck('visits.id');
        $obs = \App\Models\Observation::whereIn('visit_id', $visitIds)->get();

        foreach($obs as $ob)
        {
            $entryLine = [];
            $obVisit = $ob->visit()->first();
            array_push($entryLine, $obVisit->startdate);
            array_push($entryLine, $obVisit->countingmethod()->first()->description);
            $sp = $ob->species()->first();
            array_push($entryLine, $sp->getName($user));
            array_push($entryLine, $sp->genus);
            array_push($entryLine, $sp->taxon);
            array_push($entryLine, $ob->number);

            $res = DB::select("select ST_AsText(location) as geom from observations where id = " . $ob->id);
            $geom = $res[0]->geom;
            array_push($entryLine, $geom);
            array_push($data, $entryLine);
        }


        $sep = ";";
        $file = fopen('php://output', 'w');
        if ($file) 
        {
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename="InsectsCountDataExport.csv"');
            header('Pragma: no-cache');
            header('Expires: 0');
            fputcsv($file, $headers, $sep);
            foreach($data as $theRow)
            {
                fputcsv($file, array_values($theRow), $sep);
            }
        }
        fclose($file);
        return;
    }

    public function registerUser()
    {
        $valDat = request()->validate([
            'email' => ['required', 'valid_email', 'unique:users,email', 'max:100'],
            'name' => ['required', 'alpha_num_underscore_minus_dot_at_space', 'unique:users,name', 'max:100'],
            'password' => ['required', 'alpha_num_underscore_minus_dot_at_space', 'min:5', 'max:100'],
            'regions' => ['required', 'array'],
            'regions.*' => ['numeric', 'exists:regions,id']
        ]);

        $newUser = \App\Models\User::create([
            'name' => $valDat['name'],
            'email'=> $valDat['email'],
            'password'=> Hash::make($valDat['password']),
            'prefered_language'=> 'en',
            'accesstoken'=> '']);

        $newUser->setRandomAccessToken();
        if (request()->has('share_data'))
        {
            $newUser->share_data = true;
        }
        $newUser->save();

        // Add selected regions to regions_users
        foreach ($valDat['regions'] as $region_id)
        {
            \App\Models\RegionsUsers::create([
                'user_id' => $newUser->id,
                'region_id' => intval($region_id)
            ]);
        }

        // set recording level for butterflies to all
        $sg_id = \App\Models\Speciesgroup::where('name', 'butterflies')->first()->id;
        $rl_id = \App\Models\RecordingLevel::where('name', 'species')->first()->id;

        \App\Models\SpeciesgroupsUsers::create([
            'user_id' => $newUser->id,
            'speciesgroup_id' => $sg_id,
            'recordinglevel_id' => $rl_id
        ]);

        return view ('userLogin');
    }

    private function processUserDataPackage(User $user, $dataPackage)
    {
        \App\Models\IncomingDataBackup::create(['user_id' => $user->id, 'datapackage' => $dataPackage]);
        $dat = json_decode($dataPackage, true);
        $uSet = $dat['usersettings']['userSettings'];

        //first store user settings in case something changed 
        $user->prefered_language = $uSet['preferedLanguage'];
        $user->sci_names = $uSet['sci_names'];
        $user->show_only_common_species = $uSet['showOnlyCommonSpecies'];
        $user->show_previous_observed_species = $uSet['showPreviouslyObservedSpecies'];
        $user->settings_synched_at = date("Y-m-d H:i:s");
        $user->save();

        //store users speciesgroups 
        $spGroups = $uSet['speciesGroupsUsers'];
        foreach($spGroups as $spGroup)
        {
            $spgu = \App\Models\SpeciesgroupsUsers::where('user_id', $user->id)->where('speciesgroup_id', $spGroup['speciesgroup_id'])->first();
            if ($spgu == null)
            {
                $spgu = new \App\Models\SpeciesgroupsUsers();
                $spgu->user_id = $user->id; 
                $spgu->speciesgroup_id = $spGroup['speciesgroup_id'];
                $spgu->recordinglevel_id = $spGroup['recordinglevel_id'];
            }
            else 
            {
                $spgu->recordinglevel_id = $spGroup['recordinglevel_id'];
            }
            $spgu->save();
        }

        //store visit data 
        foreach ($dat['visitdata'] as $visitDat)
        {
            $vDat = $visitDat['data'];
            $visitCarbonDate = Carbon::parse($vDat['startdate']);
            $visitSearchDate = $visitCarbonDate->format('Y-m-d H:i:s');
         //   $visit = \App\Models\Visit::where('startdate',$vDat['startdate'])->where('user_id', $vDat['user_id'])->first();
            $visit = \App\Models\Visit::where('startdate', '=', $visitSearchDate)->where('user_id', $vDat['user_id'])->first();

            if ($visit == null)
            {
                $visit = new \App\Models\Visit();
            }

            $visit->countingmethod_id = $vDat['countingmethod_id'];
            if ($this->needsToBeStored('startdate', $vDat))
            {
                $visit->startdate = $visitSearchDate;
            }
            if ($this->needsToBeStored('enddate', $vDat)) {$visit->enddate = $vDat['enddate'];}
            $visit->sendtoserverdate = date("Y-m-d H:i:s");
            if ($this->needsToBeStored('status', $vDat)) {$visit->status = $vDat['status'];}
            if ($this->needsToBeStored('user_id', $vDat)) {$visit->user_id = $vDat['user_id'];}
            if ($this->needsToBeStored('recorders', $vDat)) {$visit->recorders = $vDat['recorders'];}
            if ($this->needsToBeStored('notes', $vDat)) {$visit->notes = $vDat['notes'];}
            if ($this->needsToBeStored('wind', $vDat)) {$visit->wind = $vDat['wind'];}
            if ($this->needsToBeStored('temperature', $vDat)) {$visit->temperature = $vDat['temperature'];}
            if ($this->needsToBeStored('cloud', $vDat)) {$visit->cloud = $vDat['cloud'];}
            if ($this->needsToBeStored('transect_id', $vDat)) {$visit->transect_id = $vDat['transect_id'];}
            if ($this->needsToBeStored('landtype', $vDat)) {$visit->landusetype_id = $vDat['landtype'];}
            if ($this->needsToBeStored('management', $vDat)) {$visit->managementtype_id = $vDat['management'];}
            if (array_key_exists('region_id', $vDat))
            {
                if ($this->needsToBeStored('region_id', $vDat)) {$visit->region_id = $vDat['region_id'];}
            }
            if ($this->needsToBeStored('flower_id', $vDat)) {$visit->flower_id = $vDat['flower_id'];}

            $visit->method_id = $this->getRecordingMethod($vDat['method'])->id;

            $visit->save();

            $visitLoc = [];
            if ($this->needsToBeStored('location', $vDat))
            {
                if (strlen($vDat['location']) > 10)
                {

                    $trackLine = '{"type":"MultiLineString","coordinates":[[';

                    $locPrepLine = str_replace('"', '', $vDat['location']);
                    $locPrepLine = str_replace('/', '', $locPrepLine);
                    $locPrepLine = str_replace('[', '', $locPrepLine);
                    $locPrepLine = str_replace(']', '', $locPrepLine);

                    $locItems = explode(",", $locPrepLine);
                    $i = 0;
                    while($i < count($locItems))
                    {
                        if ($i != 0)
                        {
                            $trackLine .= ",";
                        }
                        $trackLine .= "[" . $locItems[$i+2] . "," . $locItems[$i+1] . "]";
                        if (count($visitLoc) == 0)
                        {
                            $visitLoc = [$locItems[$i+2], $locItems[$i+1]];
                        }
                        $i+=3;
                    }
                    $trackLine .= "]]}";
                    
                    
                    $theSqlCommand = "UPDATE visits set location = ST_GeomFromGeoJSON('$trackLine') where id = $visit->id";
                    // \App\Models\IncomingDataBackup::create(['user_id' => $user->id, 'datapackage' => json_encode($locItems)]);
                    DB::statement($theSqlCommand);

                    //     $visit->location = $vDat['location'];
                    //{"type":"MultiLineString","coordinates":[[[4.689148782214867,51.79723317223025],[4.689197266129314,51.797421111800307],[4.689149999246926,51.79752350760841]]]}}

                    $allReg = \App\Models\Region::all();
                    foreach($allReg as $reg)
                    {
                        $sqRes = DB::select("SELECT ST_Intersects( (select location from regions where id = " . $reg->id . "), (select location from visits where id = " . $visit->id . ") ) as intersect");
                        if ($sqRes[0]->intersect != null)
                        {
                            $visit->region_id = $reg->id;
                            $visit->save();
                        }
                    }

                }
            }


            $observations = $vDat['observations'];

            foreach($observations as $obsDat)
            {
                $obsCarbonDate = Carbon::parse($obsDat['observationtime']);
                $obsSearchDate = $obsCarbonDate->format('Y-m-d H:i:s');
                if ($obsDat['observationtime'] != '')
                {
                    $obs = \App\Models\Observation::where('visit_id', $visit->id)->where('species_id', $obsDat['species_id'])->where('observationtime', '=',$obsSearchDate)->first();
                }
                else 
                {
                    $obs = \App\Models\Observation::where('visit_id', $visit->id)->where('species_id', $obsDat['species_id'])->first();
                }

                if ($obs == null)
                {
                    $obs = new \App\Models\Observation();
                }

                $obs->species_id = $obsDat['species_id'];
                $obs->number = $obsDat['number'];
                $obs->visit_id = $visit->id;
                $obs->observationtime = $obsSearchDate;
                if ($this->needsToBeStored('transect_section_id', $obsDat)) {$visit->transect_section_id = $obsDat['transect_section_id'];}
                $obs->save();

                //{"type":"Point","coordinates":[6.196802769569339,52.87128883782826]}}
                //\DB::raw("ST_GeomFromGeoJSON('$geom')"
              //  $obs->location = "POINT(" . $obsDat['location'] . ")";

                $skip = false;
                if (array_key_exists('location', $obsDat))
                {
                    $locItems = explode(",", $obsDat['location']);
                }
                else 
                {
                    if (count($visitLoc) != 0)
                    {
                        $locItems = [0, $visitLoc[1], $visitLoc[0]];
                    }
                    else 
                    {
                        $skip = true;
                    }
                }
                if (!$skip)
                {
                    $insertLine = '{"type":"Point","coordinates":[' . $locItems[2] . "," . $locItems[1] . "]}";
                    DB::statement("UPDATE observations set location = ST_GeomFromGeoJSON('$insertLine') where id = $obs->id");
                }
            }

         //   ST_GeomFromGeoJSON('{"type":"Point","coordinates":[-48.23456,20.12345]}')







        }
    }

    private function getRecordingMethod($methodLine)
    {
        /*
            "method": 
            {
                "butterflies": {
                    "speciesgroup_id": 1,
                    "speciesgroup_name": "butterflies",
                    "recordinglevel_id": 1,
                    "recordinglevel_name": "species"
                }
            }
        */
        $methodSpeciesGroups = [];
        foreach($methodLine as $item)
        {
            $msg = new \App\Models\MethodSpeciesgroupRecordinglevel(); 
            $stringSpGroupId = $item['speciesgroup_id'];
            $stringSpGroupId1 = str_replace("15mpost_checkSpeciesGroup_", "", $stringSpGroupId);
            $stringSpGroupId2 = str_replace("fit_checkSpeciesGroup_", "", $stringSpGroupId1);
            $stringSpGroupId3 = str_replace("transect_checkSpeciesGroup_", "", $stringSpGroupId2);
         //   $spGId = \App\Models\SpeciesGroup::where('id', )->first();

            $msg->speciesgroup_id = $stringSpGroupId3;
            $rLevel = \App\Models\RecordingLevel::where('name', 'none')->first();
            if (array_key_exists('recordinglevel_id', $item))
            {
                $rLevel = \App\Models\RecordingLevel::where('id', $item['recordinglevel_id'])->first();
            }
            elseif (array_key_exists('recordinglevel_name', $item))
            {
                $rLevel = \App\Models\RecordingLevel::where('name', $item['recordinglevel_name'])->first();
            }
            $msg->recordinglevel_id = $rLevel->id;
            $methodSpeciesGroups[] = $msg;
        }

        return \App\Models\Method::getMethod($methodSpeciesGroups);
    }
    private function needsToBeStored($variable, $array)
    {
        if (array_key_exists($variable, $array))
        {
            if ($array[$variable] != null)
            {
                if (!empty($array[$variable]))
                {
                    if ($array[$variable] != "")
                    {
                        if (($array[$variable] != -1) && ($array[$variable] != "-1"))
                        {
                            return true;
                        }
                    }
                }
            }
        }
        return false;
    }

    private function authenticateUser()
    {
        $user = Auth::user();

        if ($user == null)
        {
            return redirect()->route('showLogin');
        }
        return true;
    }
}
