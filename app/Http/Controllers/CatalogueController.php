<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Products;

class CatalogueController extends Controller
{
    public function show() {

        $products = [];

        $id_categories = $_GET['id_categories'] ?? NULL;

        if($id_categories){

            $products = Products::where([['active', 1],['id_categories', $id_categories]])
            ->orderBy('timestamp_modified', 'DESC')
            ->get();

        }else{

            $products = Products::where([['active', 1]])
            ->orderBy('timestamp_modified', 'DESC')
            ->get();

        }


        $categories = Categories::orderBy('timestamp_modified', 'DESC')
        ->get();

        return view('web.catalogue', compact('products', 'categories'));
    }
}
