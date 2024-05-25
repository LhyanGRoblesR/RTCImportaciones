<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Mail\RememberPassword;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RememberPasswordController extends Controller
{
    public function show() {
        return view('auth.rememberPassword');
    }

    public function rememberPassword(Request $request){

        $user = User::where('email', $request->email)->first();

        if(isset($user)){
            $token = Str::random(20);
            User::where('id_users', $user->id_users)->update([
                'token' => $token
            ]);
            $baseUrl = $request->getSchemeAndHttpHost();
            $url = $baseUrl."/changePassword?token={$token}";
            Mail::to($user->email)->send(new RememberPassword($url));

            return redirect('/login')->with('success', 'Se te envio un correo para restablecer la contraseña.');
        }else{
            return redirect('/rememberPassword')->withErrors('Correo electrónico no encontrado.');

        }

    }
}
