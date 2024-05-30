<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    public function show(){
        if(!Auth::check()){
            return redirect('/login');
        }

        $search = $_GET['search'] ?? '';

        $data = [];

        if(isset($search) && $search !== ''){

            $data = Products::select('t_products.*', 't_categories.category', 't_users_created.name as name_created', 't_users_modified.name as name_modified')
            ->where('t_products.product' ,'like', '%'.$search.'%')
            ->orWhere('t_products.description' ,'like', '%'.$search.'%')
            ->orWhere('t_categories.category' ,'like', '%'.$search.'%')
            ->join('t_categories', 't_categories.id_categories', 't_products.id_categories')
            ->join('t_users as t_users_created', 't_users_created.id_users', 't_products.id_users_created')
            ->join('t_users as t_users_modified', 't_users_modified.id_users', 't_products.id_users_modified')
            ->get();

        }else{

            $data = Products::select('t_products.*', 't_categories.category', 't_users_created.name as name_created', 't_users_modified.name as name_modified')
            ->join('t_categories', 't_categories.id_categories', 't_products.id_categories')
            ->join('t_users as t_users_created', 't_users_created.id_users', 't_products.id_users_created')
            ->join('t_users as t_users_modified', 't_users_modified.id_users', 't_products.id_users_modified')
            ->get();

        }

        $categories = Categories::all();


        return view('products.index', compact('data', 'search', 'categories'));
    }
}
