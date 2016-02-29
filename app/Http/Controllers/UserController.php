<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class UserController extends Controller
{
    

    public function getLogin(){

        return view('auth.login');
    }

    public function postLogin(Request $request){
        $username = $request['username'];
        $password = $request['password'];

        if (Auth::attempt(['username' => $username, 'password' => $password]) || 
            Auth::attempt(['email' => $username, 'password' => $password])
            ) {
            return redirect()->intended('dashboard');
        }else{
            
            return view('auth.login');            
        }
    

    }



    public function getRegister(){

            return view('auth.register');
    }

    public function postRegister(Request $request){
      
       $validator = Validator::make($request->all(), [
           'nombre' => 'required|max:255',
            'apellidos' => 'required|max:255',
            'edad' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'username' => 'required|max:255',
            'password' => 'required|confirmed|min:6',
        ]);
      
        // process the login
        if ($validator->fails()) {
            return Redirect::to('register')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
     User::create([
            'nombre' => $request['nombre'],
            'apellidos' => $request['apellidos'],
            'edad' => $request['edad'],
            'email' => $request['email'],
            'username' => $request['username'],
            'password' => bcrypt($request['password']),
        ]);       
            return redirect("/");
        }

            
    }


}
