<?php

namespace App\Http\Controllers\Admin;

use App\PostCategories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostCategoriesControllers extends Controller
{
    //
    public function index()
    {
        $list = PostCategories::orderBy('id', 'DESC')->paginate(15);
        $data = array('list' => $list);
        return view('admin.post_categories.index', $data);
    }

    public function add(Request $request)
    {
        if ($request->isMethod('get')) {
            $post_categories = PostCategories::all();
            return view('admin.post_categories.add',['post_categories'=>$post_categories]);
        }

        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required',
            ]);
            $obj = new PostCategories();
            $obj->name =  $request->name;
            $obj->is_active =  1;
            $obj->save();
        }
        return redirect('/admin/post_categories/add')->with('notify','Add Successfully');
    }


    public function edit(Request $request,$id)
    {
        if ($request->isMethod('get')) {
            $obj = PostCategories::find($id);
            return view('admin.post_categories.edit',['obj'=>$obj]);
        }

        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required',
            ]);
            $obj = PostCategories::find($request->id);
            $obj->name = $request->name;
            $obj->save();
        }

        return redirect('/admin/post_categories/edit/' . $request->id)->with('notify','Edit Successfully');
    }

    public function delete($id)
    {
        $obj = PostCategories::find($id);
        $obj->delete();

        return redirect('/admin/post_categories');
    }

    public function active($id)
    {
        $obj = PostCategories::find($id);
        if ($obj != null) {
            $obj->is_active = 1;
            $obj->save();
        }
        return redirect('/admin/post_categories');
    }

    public function deactive($id)
    {
        $obj = PostCategories::find($id);
        if ($obj != null) {
            $obj->is_active = 0;
            $obj->save();
        }
        return redirect('/admin/post_categories');
    }
}
