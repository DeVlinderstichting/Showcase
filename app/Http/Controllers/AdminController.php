<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Auth;
use Hash;

class AdminController extends Controller
{
	public function adminWelcome()
	{
		return view('adminLogin');
	}
    public function adminHome()
    {
        if (!($this->checkIsAdmin()))
        {
            return view('adminLogin');
        }
        return view('adminHome');
    }

    public function adminLogin()
    {
    	$valDat = request()->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if(auth()->attempt(array('email' => $valDat['username'], 'password' => $valDat['password']))) 
        {
        	if ($this->checkIsAdmin())
        	{
        		return view('adminHome');
        	}
        }
        return view('adminLogin');
    }
    public function regionCreate()
    {
    	if ($this->checkIsAdmin())
    	{
    		return view('regionCreate');
    	}
        $region = new Region();
        $region->id = -1;
        return view('adminLogin', ['region' => $region]);
    }
    public function regionStore($regionId = null)
    {
    	if (!($this->checkIsAdmin()))
    	{
    		return view('adminLogin');
    	}

    	$valDat = request()->validate([
            'name' => ['required','unique:regions' . ($regionId > 0 ? ',name,' . $regionId : '')],
            'description' => ['required'], 
            'regionData' => ['nullable'] 
        ]);

    	if (($regionId == null) || ($regionId == -1))
    	{
    		$region = new \App\Models\Region();
    	}
    	else 
    	{
    		$region = \App\Models\Region::find($regionId);
    	}
        $geom = json_decode($valDat['regionData']);
        if (strlen($geom) > 5)
        {
            $region->location = $geom;
        }
        $region->name = $valDat['name'];
        $region->description = $valDat['description'];
        $region->save();

        $allSp = \App\Models\Species::all();
        $foundIds = [];
        foreach($allSp as $sp)
        {
            $fieldName= 'spCanCount_' . $sp->id;
            if (request()->has($fieldName))
            {
                $foundIds[] = $sp->id;
                $rsp = \App\Models\RegionsSpecies::where('species_id', $sp->id)->where('region_id', $region->id)->first();
                if ($rsp == null)
                {
                    $rsp = \App\Models\RegionsSpecies::create(['species_id' => $sp->id, 'region_id' => $region->id]);
                }
            }
        }
        $removeMe = \App\Models\RegionsSpecies::whereNotIn('species_id', $foundIds)->where('region_id', $region->id)->get();
        foreach($removeMe as $tbr)
        {
            $tbr->delete();
        }

        return view ('adminHome');
    }
    public function regionIndex()
    {
        if (!($this->checkIsAdmin()))
        {
            return view('adminLogin');
        }
        return view ('regionIndex', ['regions' => \App\Models\Region::all()]);
    }
    public function regionEdit(Region $region)
    {
        if (!($this->checkIsAdmin()))
        {
            return view('adminLogin');
        }
        return view('regionCreate', ['region'=>$region]);
    }

    public function userIndex()
    {
        if (!($this->checkIsAdmin()))
        {
            return view('adminLogin');
        }
        return view('user_index');
    }
    public function userIndexAjax()
    {
        if (!($this->checkIsAdmin()))
        {
            return "An error occured please login again.";
        }

        $rules = [
            'name' => ['nullable', 'alpha_num_spaces', 'max:100'], 
            'email' => ['nullable', 'partial_email', 'max:100']
        ];
        $valDat = request()->validate($rules);
        $user = Auth::user();
        
        $takeNum = 10;
        if (array_key_exists('name', $valDat))
        {
            if (substr($valDat['name'],-1)=="*")
            {
                $valDat['name'] = substr($valDat['name'], 0, -1);
                $takeNum = 100;
            }
            if (substr($valDat['name'],-1)=="*")
            {
                $valDat['name'] = substr($valDat['name'], 0, -1);
                $takeNum = 200;
            }
        }
        $searchResult = \App\Models\User::query()->take($takeNum)->select(['id', 'name', 'email']);
        foreach($valDat as $key => $value)
        {
            if(($value!="") && ($value!=null))
            {
                $searchResult = $searchResult->where($key, 'iLIKE', '%' . $value . '%');
            }
        }
        return $searchResult->get()->toArray();
    }

    public function createUser($userId = -1)
    {
        if (!($this->checkIsAdmin()))
        {
            return view('adminLogin');
        }
        if ($userId == -1)
        {
            $user = new \App\Models\User();
            $user->id = -1;
        }
        else 
        {
            $user = \App\Models\User::find($userId);
        }
        return view('user_create', ['user' => $user]);
    }
    public function storeUser($userId)
    {
        if (!($this->checkIsAdmin()))
        {
            return view('adminLogin');
        }

        $rules = [
            'email' => ['required', 'partial_email','unique:users' . ($userId > 0 ? ',email,' . $userId : ''), 'max:100'],
            'name' => ['required', 'alpha_num_underscore_minus_dot_at', 'unique:users' . ($userId > 0 ? ',name,' . $userId : ''), 'max:100'],
            'prefered_language' => ['required', Rule::in(['nl','en','fr','es','pt','it','de','dk','no','se','fi','ee','lv','lt','pl','cz','sk','hu','au','ch','si','hr','ba','rs','me','al','gr','bg','ro'])],
        ];
        if ($userId == -1)
        {
            $rules['password'] = ['required', 'max:100', 'min:5'];
        }
        $valDat = request()->validate($rules);

        if ($userId == -1)
        {
            $user = \App\Models\User::create(['email' => $valDat['email'], 'password' => $valDat['password'], 'name' => $valDat['name'], 'prefered_language' => $valDat['prefered_language'], 'accesstoken' => '']);
            $user->setRandomAccessToken();
            $user->save();
        }
        else 
        {
            $user = \App\Models\User::find($userId);
            $user->email = $valDat['email'];
            $user->name = $valDat['name'];
            $user->prefered_language = $valDat['prefered_language'];

            if (array_key_exists('password', $valDat))
            {
                if (strlen($valDat['password'] == "*****"))
                {
                    $user->password = Hash::make($valDat['password']);
                }
            }
            $user->save();
        }
        
        $otherFields = ['sci_names', 'show_previous_observed_species', 'show_only_common_species'];
        foreach ($otherFields as $otherField)
        {
            if (request()->has($otherField))
            {
                $user->$otherField = true;
            }
            else 
            {
                $user->$otherField = false;
            }
        }

        $allRegions = \App\Models\Region::all();
        $theRegionIds = [];
        foreach($allRegions as $region)
        {
            if (request()->has("region_".$region->id))
            {
                $theRegionIds[] = $region->id;
                $ur = \App\Models\RegionsUsers::where('user_id', $user->id)->where('region_id', $region->id)->first();
                if ($ur == null)
                {
                    \App\Models\RegionsUsers::create(['user_id' => $user->id, 'region_id' => $region->id]);
                }
            }
        }
        $removeMeRegions = \App\Models\RegionsUsers::whereNotIn('region_id', $theRegionIds)->where('user_id', $user->id)->get();
        foreach($removeMeRegions as $tbr)
        {
            $tbr->delete();
        }

        $user->save();

        return view ('adminHome');
    }


    private function checkIsAdmin()
    {
    	$user = Auth::user();
    	if ($user != null)
		{
			if ($user->isadmin)
			{
				return true;
			}
		}
    	return false;
    }
}
