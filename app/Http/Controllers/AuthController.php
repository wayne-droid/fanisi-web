<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function loginUser(Request $request)
    {
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);

        $data = array(
            'email'=> $request->email,
            'password'=>$request->password
        );

        $url = '/generate/token';
        $response = json_decode($this->postWithoutToken($url,$data));

        if($response->status_code == 0)
        {
            $request->session()->put('user',$response->user);
            $request->session()->put('token',$response->token);

            return redirect('/');
        }

        return back()->withErrors(['errors'=>$response->response_desc]);
    }
}
