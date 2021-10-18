<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

//this controller is in charge of creating a package with all the user information, required to set up the app (the first time). This package should contain the species/settings/eba's etc 
class UserController extends Controller
{
    
    public function requestUserPackage()
    {
        $valDat = request()->validate([
            'username' => 'required',
            'password' => 'nullable',
            'accesstoken' => 'nullable'
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
                return Auth::user()->buildUserPackage();
            }
        }
        return "authentication failed";      
    }
}
