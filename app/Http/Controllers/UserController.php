<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//this controller is in charge of creating a package with all the user information, required to set up the app (the first time). This package should contain the species/settings/eba's etc 
class UserController extends Controller
{
    
    public function requestStub()
    {
        $valDat = $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);
        $authOk = false;
        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if(auth()->attempt(array($fieldType => $input['username'], 'password' => $input['password']))) 
        {
        	$authOk = true;
           // return redirect()->route('home');
        } 
        else 
        {
            return redirect()->route('welcome')->withErrors(["username"=>"Invalid username or password"]);
            //    ->with('error','Email-Address And Password Are Wrong.');
        }

        if ($authOk)
        {

        }
    }

    private function prepareUserPackage()
    {
    	
    }
}
