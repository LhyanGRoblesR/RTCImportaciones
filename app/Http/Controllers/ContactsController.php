<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contacts;
use Illuminate\Support\Facades\Auth;

class ContactsController extends Controller
{
    public function show(){
        if(!Auth::check()){
            return redirect('/login');
        }

        $search = $_GET['search'] ?? '';

        $data = [];

        if(isset($search) && $search !== ''){

            $data = Contacts::select('t_contacts.*', 't_users.name', 't_users.email', 't_users.phone')
            ->where('t_users.name' ,'like', '%'.$search.'%')
            ->orWhere('t_users.email' ,'like', '%'.$search.'%')
            ->orWhere('t_users.phone' ,'like', '%'.$search.'%')
            ->join('t_users', 't_users.id_users', 't_contacts.id_users')
            ->orderBy('t_contacts.timestamp_created', 'DESC')
            ->get();

        }else{

            $data = Contacts::select('t_contacts.*', 't_users.name', 't_users.email', 't_users.phone')
            ->join('t_users', 't_users.id_users', 't_contacts.id_users')
            ->orderBy('t_contacts.timestamp_created', 'DESC')
            ->get();

        }


        return view('contacts.index', compact('data', 'search'));
    }

    public function store(Request $request){
        $messages = $request->messages;
        $id_users = Auth::user()->id_users;

        Contacts::create([
            'messages' => $messages,
            'id_users' => $id_users
        ]);

        return redirect('/#contacto')->with('success', 'Mensaje enviado con exito.');;

    }
}
