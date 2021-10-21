<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AdminController extends Controller
{
	public function showAdminWelcome()
	{
		return view('adminLogin');
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
        return view('adminLogin');
    }
    public function regionStore($regionId = null)
    {
    	if (!($this->checkIsAdmin())
    	{
    		return view('adminLogin');
    	}

    	$valDat = request()->validate([
            'name' => 'required',
            'description' => 'required'
        ]);


    	if ($regionId == null)
    	{
    		$region = new \App\Models\Region();
    	}
    	else 
    	{
    		$region = \App\Models\Region::find($regionId);
    	}

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
