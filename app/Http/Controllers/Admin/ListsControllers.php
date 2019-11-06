<?php

namespace App\Http\Controllers\Admin;

use App\PostCategories;
use App\Posts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListsControllers extends Controller
{
    //
    public function postLists()
    {
        $post = Posts::orderBy('id', 'DESC')->paginate(15);
        $post_cate = PostCategories::all();
        $data = array('list' => $post, 'post_cate'=>$post_cate);
        return view('layouts.app',$data);
    }

    public function postDetails($id)
    {
        $post = Posts::find($id);
        $posts = Posts::orderBy('id', 'DESC')->paginate(3);
        $post_cate = PostCategories::all();
        $data = array('post' => $post,'posts'=>$posts, 'post_cate'=>$post_cate);
        return view('pages.post_details',$data);
    }
}
