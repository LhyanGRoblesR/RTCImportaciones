<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ChangePasswordController extends Controller
{
    public function show() {

        $token = $_GET['token'];

        return view('auth.changePassword', compact('token'));
    }

    public function changePassword(Request $request){
        $token = $request->token;
        $newPassword = $request->password;
        $newPasswordConfirmation = $request->password_confirmation;
        if($newPassword === $newPasswordConfirmation){
            $user = User::where('token', $token)->first();
            if(isset($user)){
                User::where('id_users', $user->id_users)->update([
                    'email_verified' => 1,
                    'token' => NULL,
                    'password' => bcrypt($newPassword)
                ]);
                return redirect('/login')->with('success', 'Se verifico tu correo con exito.');
            }else {
                return redirect('/changePassword?token='.$token)->withErrors('El token es incorrecto.');
            }
        }else{
            return redirect('/changePassword?token='.$token)->withErrors('Las contraseñas no coinciden.');
        }
    }
}
