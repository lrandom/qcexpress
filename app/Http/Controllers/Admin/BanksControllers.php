<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Banks as Banks;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class BanksControllers extends Controller
{
    public function index(){
        $list = Banks::orderBy('id', 'DESC')->paginate(15);
        $data = array('list' => $list);
        return view('admin.banks.index', $data);
    }


    public function add(Request $request){
        if ($request->isMethod('get')) {
            return view('admin.banks.add');
        }
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required',
                'fullname' => 'required'
            ]);
            $obj = new Banks();
            $obj->name =  $request->name;
            $obj->fullname =  $request->fullname;
            $obj->save();
            if ($request->hasFile('logo')) {
                $file = $request->logo;
                $newFileName =  time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('pictures/banks'), $newFileName);
                $obj->logo = 'pictures/banks/' . $newFileName;
                $obj->save();
            }
            return redirect('/admin/banks/add')->with('status', 'Add a new banks success!');;
        }
    }


    public function edit(Request $request){
        if ($request->isMethod('get')) {
            $obj = Banks::find($request->id);
            $data = array('obj' => $obj);
            return view('admin.banks.edit', $data);
        }
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required',
                'fullname' => 'required'
            ]);
            $obj = Banks::find($request->id);
            $obj->name =  $request->name;
            $obj->fullname =  $request->fullname;
            $obj->save();
            if ($request->hasFile('logo')) {
                $file = $request->logo;
                $newFileName =  time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('pictures/banks'), $newFileName);
                $obj->logo = 'pictures/banks/' . $newFileName;
                $obj->save();
            }
            return redirect('/admin/banks/edit/' . $request->id)->with('status', 'Edit banks success!');
        }
    }

    public function active($id){
        $obj = Banks::find($id);
        if ($obj != null) {
            $obj->is_active = 1;
            $obj->save();
        }
        return redirect('/admin/banks');
    }

    public function deactive($id){
        $obj = Banks::find($id);
        if ($obj != null) {
            $obj->is_active = 0;
            $obj->save();
        }
        return redirect('/admin/banks');
    }

    public function delete($id){
        $obj = Banks::find($id);
        if ($obj != null) {
            $obj->delete();
            File::delete($obj->logo);
        }
        return redirect('/admin/banks');
    }

}