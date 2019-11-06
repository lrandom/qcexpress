<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Posts as Posts;
use App\PostCategories as PostCategories;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PostsControllers extends Controller
{
    public function index(Request $request){
        $post_cate = DB::table('post_categories')
        ->where('post_categories.id', '=', $request->id)
        ->get();

        $list = DB::table('posts')
        ->where('posts.id_categories', '=', $request->id)
        ->paginate(15);

        $data = array('list' => $list, 'post_cate'=>$post_cate);
        return view('users.posts',$data);
    }

    public function detail(Request $request){
        $post = Posts::find($request->id);
        $post_cate = PostCategories::all();
        $data = array('post' => $post, 'post_cate'=>$post_cate);
        return view('users.post-detail',$data);
    }

 
}