<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quotes;
use App\Models\QuotesCarts;
use App\Models\QuotesProducts;
use Illuminate\Support\Facades\Auth;
use App\Models\Products;
use App\Models\User;

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

    public function update(Request $request){
        $id_quotes = $request->id_quotes;
        $id_quotes_statuses = $request->id_quotes_statuses;
        $id_users = Auth::user()->id_users;

        $quotes = Quotes::where('id_quotes',$id_quotes)->first();

        if(isset($quotes)){

            $quotes = Quotes::where('id_quotes',$id_quotes)
            ->update([
                'id_quotes_statuses' => $id_quotes_statuses,
                'custom_price' => $request->custom_price,
                'id_users_modified' => $id_users
            ]);

            return redirect('/quotes')->with('success', 'Cotización actualizada con exito.');
        }else {
            return redirect('/quotes')->withErrors('Cotización no encontrada. No se pudo actualizar.');

        }
    }

    public function downloadPdf(Request $request){
        $id_quotes = $request->id_quotes;

        $quotes = Quotes::where('id_quotes', $id_quotes)->first();

        $quotes_products = QuotesProducts::select('t_quotes_products.id_quotes_products', 't_quotes_products.id_quotes', 't_quotes_products.id_products', 't_quotes_products.quantity', 't_quotes_products.total_price', 't_products.product')
            ->join('t_products', 't_quotes_products.id_products', '=', 't_products.id_products')
            ->where('t_quotes_products.id_quotes', $id_quotes)
            ->groupBy('t_quotes_products.id_quotes_products', 't_quotes_products.id_quotes', 't_quotes_products.id_products', 't_quotes_products.quantity', 't_quotes_products.total_price', 't_products.product')
            ->get();

        $user = User::where('id_users', $quotes->id_users)->first();

        $data = [
            'quotes' => $quotes,
            'quotes_products' => $quotes_products,
            'user' => $user
        ];

        $pdf = \PDF::loadView('templates.quotesPDF', $data);

        $name = 'cotizacion_'.$id_quotes.'.pdf';

        return $pdf->download($name);
    }

    public function showMe(){
        if(!Auth::check()){
            return redirect('/login');
        }

        $id_users = Auth::user()->id_users;

        $data = Quotes::select('t_quotes.*', 't_users.name as name', 't_users_created.name as name_created', 't_users_modified.name as name_modified', 't_quotes_statuses.quote_status')
        ->where([['t_quotes.id_users' , $id_users]])
        ->join('t_quotes_statuses', 't_quotes_statuses.id_quotes_statuses', 't_quotes.id_quotes_statuses')
        ->join('t_users as t_users', 't_users.id_users', 't_quotes.id_users')
        ->join('t_users as t_users_created', 't_users_created.id_users', 't_quotes.id_users_created')
        ->join('t_users as t_users_modified', 't_users_modified.id_users', 't_quotes.id_users_modified')
        ->orderBy('t_quotes.timestamp_created', 'DESC')
        ->get();


        return view('web.quotes', compact('data'));
    }

}
