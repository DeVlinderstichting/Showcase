<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class stubController extends Controller
{
    public function requestStub()
    {
        $valDat = $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);
        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if(auth()->attempt(array($fieldType => $input['username'], 'password' => $input['password']))) 
        {

            return redirect()->route('home');
        } 
        else 
        {
            return redirect()->route('welcome')->withErrors(["username"=>"Invalid username or password"]);
            //    ->with('error','Email-Address And Password Are Wrong.');
        }
    }

}
