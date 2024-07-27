<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuotesCarts;
use Illuminate\Support\Facades\Auth;

class QuotesCartsController extends Controller
{
    public function show(){
        if(!Auth::check()){
            return redirect('/login');
        }

        $id_users = Auth::user()->id_users;

        $products = QuotesCarts::select('t_quotes_carts.*', 't_products.*', 't_categories.category')
        ->where([['t_quotes_carts.id_users', $id_users]])
        ->join('t_products', 't_products.id_products', 't_quotes_carts.id_products')
        ->join('t_categories', 't_categories.id_categories', 't_products.id_categories')
        ->get();


        return view('web.cart', compact('products'));
    }

    public function store(Request $request){
        $id_products = $request->id_products;
        $id_users = Auth::user()->id_users;

        $quotesCartsExists = QuotesCarts::where([['id_products', $id_products],['id_users',$id_users]])
                                        ->first();

        if(isset($quotesCartsExists)){
            QuotesCarts::where('id_quotes_carts', $quotesCartsExists->id_quotes_carts)
            ->update([
                'quantity' => $quotesCartsExists->quantity + 1
            ]);
        }else{

            QuotesCarts::create([
                'id_products' => $id_products,
                'id_users' => $id_users
            ]);

        }

        return json_encode([
            'success' => true,
            'status' => 200,
            'message' => 'OK'
        ]);

    }

    public function update(Request $request){
        $id_quotes_carts = $request->id_quotes_carts;
        $quantity = $request->quantity;

        $quotesCartsExists = QuotesCarts::where('id_quotes_carts', $quotesCartsExists->id_quotes_carts)->first();

        if(isset($quotesCartsExists)){
            QuotesCarts::where('id_quotes_carts', $quotesCartsExists->id_quotes_carts)
            ->update([
                'quantity' => $quantity
            ]);

            return redirect('/carts')->with('success', 'Producto actualizado con exito.');
        }else{
            return redirect('/carts')->withErrors('Producto no encontrado. No se pudo actualizar.');
        }
    }

    public function delete(Request $request){
        $id_quotes_carts = $request->id_quotes_carts;

        $quotesCartsExists = QuotesCarts::where('id_quotes_carts', $id_quotes_carts)->first();

        if(isset($quotesCartsExists)){
            QuotesCarts::where('id_quotes_carts', $id_quotes_carts)
            ->delete();

            return redirect('/carts')->with('success', 'Producto eliminado del carrito.');
        }else{
            return redirect('/carts')->withErrors('No se encontro el producto para eliminar.');
        }

    }
}
