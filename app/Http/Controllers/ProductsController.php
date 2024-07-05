<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

    public function store(Request $request){
        $product = $request->product;
        $description = $request->description;
        $photo = $request->file('photo');
        $price = $request->price;
        $id_categories = $request->id_categories;
        $id_users = Auth::user()->id_users;
        $photo_url = '';

        $productExists = Products::where('product', $product)->first();
        if(empty($productExists)){

            if ($photo) {
                $branch = 'https://rtcimportaciones.s3.amazonaws.com/';
                $photo_name = Str::random(13);
                $extension = $photo->getClientOriginalExtension();
                $photo_upload = Storage::disk('s3')->put('products', $photo);
                $photo_url = $branch.$photo_upload;
            }

            Products::create([
                'product' => $product,
                'description' => $description,
                'photo_url' => $photo_url,
                'price' => $price,
                'id_categories' => $id_categories,
                'active' => 1,
                'id_users_created' => $id_users,
                'id_users_modified' => $id_users,
            ]);

            return redirect('/products')->with('success', 'Producto agregado con exito.');

        }else{
            return redirect('/products')->withErrors('El producto ya existe.');
        }

    }

    public function update(Request $request){
        $id_products = $request->id_products;
        $product = $request->product;
        $description = $request->description;
        $photo = $request->file('photo');
        $price = $request->price;
        $active = $request->active;
        $id_categories = $request->id_categories;
        $id_users = Auth::user()->id_users;
        $photo_url = '';

        $productExists = Products::where('id_products', $id_products)->first();

        if(isset($productExists)){

            $productNameExists = Products::where([['product', $product],['id_products', '<>',$id_products]])->first();
            if(empty($productNameExists)){

                if ($photo) {
                    $branch = 'https://rtcimportaciones.s3.amazonaws.com/';
                    $photo_name = Str::random(13);
                    $extension = $photo->getClientOriginalExtension();
                    $photo_upload = Storage::disk('s3')->put('products', $photo);
                    $photo_url = $branch.$photo_upload;
                }else{
                    $photo_url = $productExists->photo_url;
                }

                Products::where('id_products', $id_products)
                ->update([
                    'product' => $product,
                    'description' => $description,
                    'photo_url' => $photo_url,
                    'price' => $price,
                    'id_categories' => $id_categories,
                    'active' => $active,
                    'id_users_modified' => $id_users,
                ]);

                return redirect('/products')->with('success', 'Producto actualizado con exito.');
            }else{
                return redirect('/products')->withErrors('El producto ya existe.');
            }
        }else{
            return redirect('/products')->withErrors('Producto no encontrado. No se pudo actualizar.');
        }

    }

    public function delete(Request $request){
        $id_products = $request->id_products;

        $productExists = Products::where('id_products', $id_products)->first();

        if(isset($productExists)){

            Products::where('id_products', $id_products)
                ->delete();

            return redirect('/products')->with('success', 'Producto eliminado con exito.');

        }else{
            return redirect('/products')->withErrors('Producto no encontrado. No se pudo actualizar.');
        }

    }

}
