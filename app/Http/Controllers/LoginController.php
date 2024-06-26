<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show(){
        if(Auth::check()){
            return redirect('/home');
        }
        return view('auth.login');
    }

    public function login(LoginRequest $request){
        $credentials = $request->validated();

        if(!Auth::validate($credentials)){
            return redirect()->to('/login')->withErrors('El correo y/o contraseña son incorrectos.');
        }

        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        if($user->email_verified == 1){
            Auth::login($user);

            if($user->id_users_roles == 1){
                return redirect('/');
            }else{
                return redirect('/home');
            }


        }else{
            return redirect()->to('/login')->withErrors('El correo no se encuentra verificado.');
        }

    }


}
