<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{
    public function show(){
        if(!Auth::check()){
            return redirect('/login');
        }

        $category = $_GET['category'] ?? '';

        $data = [];

        if(isset($category) && $category !== ''){

            $data = Categories::select('t_categories.*', 't_users_created.name as name_created', 't_users_modified.name as name_modified')
            ->where([['category' ,'like', '%'.$category.'%']])
            ->join('t_users as t_users_created', 't_users_created.id_users', 't_categories.id_users_created')
            ->join('t_users as t_users_modified', 't_users_modified.id_users', 't_categories.id_users_modified')
            ->get();

        }else{

            $data = Categories::select('t_categories.*', 't_users_created.name as name_created', 't_users_modified.name as name_modified')
            ->join('t_users as t_users_created', 't_users_created.id_users', 't_categories.id_users_created')
            ->join('t_users as t_users_modified', 't_users_modified.id_users', 't_categories.id_users_modified')
            ->get();

        }


        return view('categories.index', compact('data', 'category'));
    }

    public function store(Request $request){
        $category = $request->category;
        $id_users = Auth::user()->id_users;

        Categories::create([
            'category' => $category,
            'id_users_created' => $id_users,
            'id_users_modified' => $id_users,
        ]);

        return redirect('/categories')->with('success', 'Categoria agregada con exito.');;

    }

    public function update(Request $request){
        $id_categories = $request->id_categories;
        $category = $request->category;
        $id_users = Auth::user()->id_users;

        $category = Categories::where('id_categories', $id_categories)->first();

        if(isset($category)){
            Categories::where('id_categories', $id_categories)
            ->update([
                'category' => $category,
                'id_users_modified' => $id_users,
            ]);

            return redirect('/categories')->with('success', 'Categoria actualizada con exito.');
        }else{
            return redirect('/categories')->withErrors('Categoria no encontrada. No se pudo actualizar.');
        }
    }

    public function delete(Request $request){
        $id_categories = $request->id_categories;

        $category = Categories::where('id_categories', $id_categories)->first();

        if(isset($category)){

            $product = Products::where('id_categories', $id_categories)->first();

            if(!isset($product)){
                Categories::where('id_categories', $id_categories)
                ->delete();

                return redirect('/categories')->with('success', 'Categoria eliminada con exito.');
            }else{
                return redirect('/categories')->withErrors('La categoria posee uno o mas productos amarrados.');
            }

        }else{
            return redirect('/categories')->withErrors('Categoria no encontrada. No se pudo actualizar.');
        }

    }

}
