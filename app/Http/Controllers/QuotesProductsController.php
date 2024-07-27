<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuotesProducts;
use Illuminate\Support\Facades\Auth;
use App\Models\Products;

class QuotesProductsController extends Controller
{
    public function show(Request $request){
        if(!Auth::check()){
            return redirect('/login');
        }

        $id_quotes = $request->id_quotes;

        $data = [];

        if(isset($id_quotes)){

            $data = QuotesProducts::select('t_quotes_products.id_quotes_products', 't_quotes_products.id_quotes', 't_quotes_products.id_products', 't_quotes_products.quantity', 't_quotes_products.total_price', 't_products.product')
            ->join('t_products', 't_quotes_products.id_products', '=', 't_products.id_products')
            ->where('t_quotes_products.id_quotes', $id_quotes)
            ->groupBy('t_quotes_products.id_quotes_products', 't_quotes_products.id_quotes', 't_quotes_products.id_products', 't_quotes_products.quantity', 't_quotes_products.total_price', 't_products.product')
            ->get();

            return json_encode([
                'success' => true,
                'status' => 200,
                'data' => $data
            ]);

        }else{

            return json_encode([
                'success' => false,
                'status' => 404,
                'message' => 'Sin un id de cotizacion no se puede bsucar los productos'
            ]);

        }
    }
}
