<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RememberPasswordController extends Controller
{
    public function show() {
        return view('auth.rememberPassword');
    }

    public function rememberPassword(Request $request){
        
    }
}
