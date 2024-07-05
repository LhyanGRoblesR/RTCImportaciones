<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function show(){
        if(!Auth::check()){
            return redirect('/login');
        }

        $search = $_GET['search'] ?? '';

        $data = [];

        if(isset($search) && $search !== ''){

            $data = Blog::select('t_blog.*', 't_users_created.name as name_created', 't_users_modified.name as name_modified')
            ->where('t_blog.blog' ,'like', '%'.$search.'%')
            ->orWhere('t_blog.description' ,'like', '%'.$search.'%')
            ->join('t_users as t_users_created', 't_users_created.id_users', 't_blog.id_users_created')
            ->join('t_users as t_users_modified', 't_users_modified.id_users', 't_blog.id_users_modified')
            ->orderBy('t_blog.timestamp_modified', 'DESC')
            ->get();

        }else{

            $data = Blog::select('t_blog.*', 't_users_created.name as name_created', 't_users_modified.name as name_modified')
            ->where('t_blog.blog' ,'like', '%'.$search.'%')
            ->orWhere('t_blog.description' ,'like', '%'.$search.'%')
            ->join('t_users as t_users_created', 't_users_created.id_users', 't_blog.id_users_created')
            ->join('t_users as t_users_modified', 't_users_modified.id_users', 't_blog.id_users_modified')
            ->orderBy('t_blog.timestamp_modified', 'DESC')
            ->get();

        }

        return view('blog.index', compact('data', 'search'));
    }

    public function store(Request $request){
        $blog = $request->blog;
        $description = $request->description;
        $photo = $request->file('photo');
        $id_users = Auth::user()->id_users;
        $photo_url = '';

        if ($photo) {
            $branch = 'https://rtcimportaciones.s3.amazonaws.com/';
            $photo_name = Str::random(13);
            $extension = $photo->getClientOriginalExtension();
            $photo_upload = Storage::disk('s3')->put('blog', $photo);
            $photo_url = $branch.$photo_upload;
        }

        Blog::create([
            'blog' => $blog,
            'description' => $description,
            'photo_url' => $photo_url,
            'id_users_created' => $id_users,
            'id_users_modified' => $id_users,
        ]);

        return redirect('/blog')->with('success', 'Blog agregado con exito.');;

    }

    public function update(Request $request){
        $id_blog = $request->id_blog;
        $blog = $request->blog;
        $description = $request->description;
        $photo = $request->file('photo');
        $id_users = Auth::user()->id_users;
        $photo_url = '';

        $blogExists = Blog::where('id_blog', $id_blog)->first();

        if(isset($blogExists)){

            if ($photo) {
                $branch = 'https://rtcimportaciones.s3.amazonaws.com/';
                $photo_name = Str::random(13);
                $extension = $photo->getClientOriginalExtension();
                $photo_upload = Storage::disk('s3')->put('blog', $photo);
                $photo_url = $branch.$photo_upload;
            }else{
                $photo_url = $blogExists->photo_url;
            }

            Blog::where('id_blog', $id_blog)
            ->update([
                'blog' => $blog,
                'description' => $description,
                'photo_url' => $photo_url,
                'id_users_modified' => $id_users,
            ]);

            return redirect('/blog')->with('success', 'Blog actualizado con exito.');

        }else{
            return redirect('/blog')->withErrors('Blog no encontrado. No se pudo actualizar.');
        }

    }

    public function delete(Request $request){
        $id_blog = $request->id_blog;

        $blogExists = Blog::where('id_blog', $id_blog)->first();

        if(isset($blogExists)){

            Blog::where('id_blog', $id_blog)
                ->delete();

            return redirect('/blog')->with('success', 'Blog eliminado con exito.');

        }else{
            return redirect('/blog')->withErrors('Blog no encontrado. No se pudo actualizar.');
        }

    }
}
