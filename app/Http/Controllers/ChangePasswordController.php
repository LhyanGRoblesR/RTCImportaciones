<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ChangePasswordController extends Controller
{
    public function show() {
        return view('auth.changePassword');
    }

    public function changePassword(RegisterRequest $request){
        
    }
}
