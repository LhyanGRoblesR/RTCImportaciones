<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Categories;
use App\Models\Products;
use App\Models\Quotes;
use App\Models\QuotesCarts;
use App\Models\QuotesProducts;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        if(!Auth::check()){
            return view('auth.login');
        }

        $months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        $month_number = date("n");
        $month = $months[$month_number-1];
        $total_products_active = Products::where('active', 1)->count();
        $total_categories = Categories::count();

        $total_quotes_month = Quotes::whereMonth('timestamp_created', $month_number)->count();

        $top_products = Products::select('t_products.product', DB::raw('count(t_quotes_products.id_products) as total_product_quotes'))
            ->join('t_quotes_products', 't_products.id_products', '=', 't_quotes_products.id_products')
            ->whereMonth('t_quotes_products.timestamp_created', $month_number)
            ->groupBy('t_products.id_products')
            ->orderByRaw('total_product_quotes DESC')
            ->limit(10)
            ->get();


        $products_top_products = $top_products->pluck('product')->toArray();
        $quantities_top_products = $top_products->pluck('total_product_quotes')->toArray();

        $quotes_statuses = Quotes::select('t2.quote_status', DB::raw('count(1) as total_quotes_statuses'))
        ->join('t_quotes_statuses as t2', 't_quotes.id_quotes_statuses', '=', 't2.id_quotes_statuses')
        ->whereMonth('t_quotes.timestamp_created', $month_number)
        ->groupBy('t2.quote_status')
        ->orderByRaw('total_quotes_statuses ASC')
        ->get();

        $quote_status = $quotes_statuses->pluck('quote_status')->toArray();
        $total_quotes_statuses = $quotes_statuses->pluck('total_quotes_statuses')->toArray();

        $quotes_days = Quotes::select(DB::raw('DATE(timestamp_created) as quotes_day'), DB::raw('count(1) as total_quotes_day'))
            ->groupBy(DB::raw('DATE(timestamp_created)'))
            ->orderBy(DB::raw('DATE(timestamp_created)'), 'DESC')
            ->limit(15)
            ->get();

        $quotes_days = $quotes_days->reverse()->values();

        $quotes_day = $quotes_days->pluck('quotes_day')->toArray();
        $total_quotes_day = $quotes_days->pluck('total_quotes_day')->toArray();

        return view('home.index', compact('total_products_active', 'total_categories', 'month', 'total_quotes_month', 'products_top_products', 'quantities_top_products', 'quote_status', 'total_quotes_statuses', 'quotes_day', 'total_quotes_day'));
    }
}
