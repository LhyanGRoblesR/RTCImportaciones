<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quotes;
use App\Models\QuotesCarts;
use App\Models\QuotesProducts;
use Illuminate\Support\Facades\Auth;
use App\Models\Products;

class QuotesController extends Controller
{
    public function show(){
        if(!Auth::check()){
            return redirect('/login');
        }

        $search = $_GET['search'] ?? '';

        $data = [];

        if(isset($search) && $search !== ''){

            $data = Quotes::select('t_quotes.*', 't_users.name as name', 't_users_created.name as name_created', 't_users_modified.name as name_modified', 't_quotes_statuses.quote_status')
            ->where([['t_users_created.name' ,'like', '%'.$search.'%']])
            ->where([['t_users_modified.name' ,'like', '%'.$search.'%']])
            ->join('t_quotes_statuses', 't_quotes_statuses.id_quotes_statuses', 't_quotes.id_quotes_statuses')
            ->join('t_users as t_users', 't_users.id_users', 't_quotes.id_users')
            ->join('t_users as t_users_created', 't_users_created.id_users', 't_quotes.id_users_created')
            ->join('t_users as t_users_modified', 't_users_modified.id_users', 't_quotes.id_users_modified')
            ->get();

        }else{

            $data = Quotes::select('t_quotes.*', 't_users.name as name', 't_users_created.name as name_created', 't_users_modified.name as name_modified', 't_quotes_statuses.quote_status')
            ->join('t_quotes_statuses', 't_quotes_statuses.id_quotes_statuses', 't_quotes.id_quotes_statuses')
            ->join('t_users as t_users', 't_users.id_users', 't_quotes.id_users')
            ->join('t_users as t_users_created', 't_users_created.id_users', 't_quotes.id_users_created')
            ->join('t_users as t_users_modified', 't_users_modified.id_users', 't_quotes.id_users_modified')
            ->get();

        }

        return view('quotes.index', compact('data', 'search'));
    }


    public function store(Request $request){
        $subtotal = $request->subtotal;
        $igv = $request->igv;
        $total = $request->total;
        $id_users = Auth::user()->id_users;

        $quotesCarts = QuotesCarts::where('id_users',$id_users)->get();

        if(isset($quotesCarts)){

            $quotes = Quotes::create([
                'id_users' => $id_users,
                'brute_price' => $subtotal,
                'igv' => $igv,
                'total_price' => $total,
                'id_users_created' => $id_users,
                'id_users_modified' => $id_users
            ]);

            foreach ($quotesCarts as $cart) {
                $product = Products::where('id_products', $cart->id_products)->first();
                QuotesProducts::create([
                    'id_quotes' => $quotes->id_quotes,
                    'id_products' => $cart->id_products,
                    'quantity' => $cart->quantity,
                    'total_price' => ($product->price * $cart->quantity),
                    'id_users_created' => $id_users,
                    'id_users_modified' => $id_users
                ]);
            }

            QuotesCarts::where('id_users',$id_users)->delete();
        }

        return redirect('/carts')->with('success', 'Cotización generada con exito.');

    }
}
