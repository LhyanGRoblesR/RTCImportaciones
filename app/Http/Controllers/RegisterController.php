<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Mail\VerifiedEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function show() {
        if(Auth::check()){
            return redirect('/home');
        }
        return view('auth.register');
    }

    public function register(RegisterRequest $request){
        $user = User::create($request->validated());
        $baseUrl = $request->getSchemeAndHttpHost();
        $token = $user->token;
        $url = $baseUrl."/verifiedEmail?token={$token}";
        Mail::to($user->email)->send(new VerifiedEmail($url));

        return redirect('/login')->with('success', 'Registro completado con exito. Se te enviara un correo de verificación para continuar.');
    }

    public function verifiedEmail(){
        $token = $_GET['token'];
        $user = User::where('token', $token)->first();
        if(isset($user)){
            User::where('token', $token)->update([
                'email_verified' => 1,
                'token' => NULL
            ]);
            return redirect('/login')->with('success', 'Se verifico tu correo con exito.');
        }else {
            return redirect('/login')->withErrors('El token es incorrecto.');
        }
    }
}
