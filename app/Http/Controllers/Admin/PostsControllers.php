<?php

namespace App\Http\Controllers\Admin;

use App\PostCategories;
use App\Posts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostsControllers extends Controller
{
    //
    public function index()
    {
        $list = Posts::orderBy('posts.id', 'DESC')
            ->select('*', 'posts.id as id')
            ->join('post_categories', 'posts.id_categories', '=', 'post_categories.id')
            ->paginate(15);

        $post_categories = PostCategories::get();
        $data = array('list' => $list, 'post_categories' => $post_categories);
        return view('admin.posts.index', $data);
    }

    public function add(Request $request)
    {
        if ($request->isMethod('get')) {
            $post_categories = PostCategories::all();
            return view('admin.posts.add', ['post_categories' => $post_categories]);
        }

        if ($request->isMethod('post')) {
            $request->validate([
                'id_categories' => 'required',
                'title' => 'required',
                'contents' => 'required',
                'description' => 'required',
                'keyword' => 'required',
            ]);
            $obj = new Posts();
            $obj->id_categories = $request->id_categories;
            $obj->title = $request->title;
            $obj->contents = htmlspecialchars($request->contents);
            $obj->description = $request->description;
            $obj->keyword = $request->keyword;
            $obj->is_active = 1;
            $obj->save();
            if ($request->hasFile('thumb')) {
                $file = $request->thumb;
                $newFileName =  time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('pictures/posts'), $newFileName);
                $obj->thumb = 'pictures/posts/' . $newFileName;
                $obj->save();
            }
        }
        return redirect('/admin/posts/add')->with('notify', 'Add Successfully');
    }


    public function edit(Request $request, $id)
    {
        if ($request->isMethod('get')) {
            $post_categories = PostCategories::all();
            $obj = Posts::find($id);
            return view('admin.posts.edit', ['obj' => $obj, 'post_categories' => $post_categories]);
        }

        if ($request->isMethod('post')) {
            $request->validate([
                'id_categories' => 'required',
                'title' => 'required',
                'contents' => 'required',
                'description' => 'required',
                'keyword' => 'required',
            ]);
            $obj = Posts::find($request->id);
            $obj->id_categories =  $request->id_categories;
            $obj->title =  $request->title;
            $obj->contents =  htmlspecialchars($request->contents);
            $obj->description =  $request->description;
            $obj->keyword =  $request->keyword;
            $obj->save();
            if ($request->hasFile('thumb')) {
                $file = $request->thumb;
                $newFileName =  time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('pictures/posts'), $newFileName);
                $obj->thumb = 'pictures/posts/' . $newFileName;
                $obj->save();
            }
        }

        return redirect('/admin/posts/edit/' . $request->id)->with('notify', 'Edit Successfully');
    }

    public function delete($id)
    {
        $obj = Posts::find($id);
        $obj->delete();
        return redirect('/admin/posts');
    }

    public function active($id)
    {
        $obj = Posts::find($id);
        if ($obj != null) {
            $obj->is_active = 1;
            $obj->save();
        }
        return redirect('/admin/posts');
    }

    public function deactive($id)
    {
        $obj = Posts::find($id);
        if ($obj != null) {
            $obj->is_active = 0;
            $obj->save();
        }
        return redirect('/admin/posts');
    }
}