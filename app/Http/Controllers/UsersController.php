<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function show(){
        if(!Auth::check()){
            return redirect('/login');
        }

        $search = $_GET['search'] ?? '';

        $data = [];

        if(isset($name) && $search !== ''){

            $data = User::select('t_users.*', 't_users_roles.user_rol', 't_document_types.document_type')
            ->where('name' ,'like', '%'.$search.'%')
            ->orWhere('document' ,'like', '%'.$search.'%')
            ->orWhere('ruc' ,'like', '%'.$search.'%')
            ->orWhere('email' ,'like', '%'.$search.'%')
            ->orWhere('phone' ,'like', '%'.$search.'%')
            ->join('t_users_roles', 't_users_roles.id_users_roles', 't_users.id_users_roles')
            ->join('t_document_types', 't_document_types.id_document_types', 't_users.id_document_types')
            ->get();

        }else{

            $data = User::select('t_users.*', 't_users_roles.user_rol', 't_document_types.document_type')
            ->join('t_users_roles', 't_users_roles.id_users_roles', 't_users.id_users_roles')
            ->join('t_document_types', 't_document_types.id_document_types', 't_users.id_document_types')
            ->get();

        }


        return view('users.index', compact('data', 'search'));
    }

    public function updateIdUsersRoles(Request $request){
        $id_users = $request->id_users;
        $id_users_roles = $request->id_users_roles;
        $id_users_modified = Auth::user()->id_users;

        $user = User::where('id_users', $id_users)->first();

        if(isset($user)){

            User::where('id_users', $id_users)
            ->update([
                'id_users_roles' => $id_users_roles
            ]);

            return redirect('/users')->with('success', 'Usuario actualizado con exito.');
        }else{
            return redirect('/users')->withErrors('Usuario no encontrado. No se pudo actualizar.');
        }
    }


}
