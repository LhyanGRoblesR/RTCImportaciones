<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quotes;
use Illuminate\Support\Facades\Auth;

class QuotesController extends Controller
{
    public function show(){
        if(!Auth::check()){
            return redirect('/login');
        }

        $search = $_GET['search'] ?? '';

        $data = [];

        if(isset($search) && $search !== ''){

            $data = Quotes::select('t_quotes.*', 't_users_created.name as name_created', 't_users_modified.name as name_modified')
            ->where([['t_users_created.name' ,'like', '%'.$search.'%']])
            ->where([['t_users_modified.name' ,'like', '%'.$search.'%']])
            ->join('t_quotes_statuses', 't_quotes_statuses.id_quotes_statuses', 't_quotes.id_quotes_statuses')
            ->join('t_users as t_users_created', 't_users_created.id_users', 't_quotes.id_users_created')
            ->join('t_users as t_users_modified', 't_users_modified.id_users', 't_quotes.id_users_modified')
            ->get();

        }else{

            $data = Quotes::select('t_quotes.*', 't_users_created.name as name_created', 't_users_modified.name as name_modified')
            ->join('t_quotes_statuses', 't_quotes_statuses.id_quotes_statuses', 't_quotes.id_quotes_statuses')
            ->join('t_users as t_users_created', 't_users_created.id_users', 't_quotes.id_users_created')
            ->join('t_users as t_users_modified', 't_users_modified.id_users', 't_quotes.id_users_modified')
            ->get();

        }


        return view('quotes.index', compact('data', 'search'));
    }
}
