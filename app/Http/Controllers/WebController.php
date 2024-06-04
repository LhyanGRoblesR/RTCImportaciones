<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Blog;

class WebController extends Controller
{
    public function show() {
        $products = Products::where('active', 1)
        ->limit(6)
        ->orderBy('timestamp_modified', 'DESC')
        ->get();

        $blogs = Blog::limit(3)
        ->orderBy('timestamp_modified', 'DESC')
        ->get();

        return view('web.index', compact('products', 'blogs'));
    }
}
