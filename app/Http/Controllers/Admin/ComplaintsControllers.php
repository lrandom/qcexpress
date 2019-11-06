<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Complaints as Complaints;
use App\User as User;
use App\Order as Order;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class ComplaintsControllers extends Controller
{
    public function index(){
        $list = Complaints::join('users', 'users.id', '=', 'complaints.id_user')
        ->select('complaints.*', 'complaints.created_at as created_at', 'complaints.updated_at as updated_at', 'users.id as id_user', 'users.fullname as fullname', 'complaints.id as id')
        ->paginate(15);
        $data = array('list' => $list);
        return view('admin.complaints.index', $data);
    }

    public function detail($id){
        $list = Complaints::join('users', 'users.id', '=', 'complaints.id_user')
        ->join('orders', 'orders.id', '=', 'complaints.id_order')
        ->select('complaints.*', 'complaints.created_at as created_at', 'complaints.updated_at as updated_at', 'users.id as id_user', 'users.fullname as fullname', 'orders.id as id_order')
        ->first($id);
        $data = array('list' => $list);
        return view('admin.complaints.detail', $data);
    }

    public function delete($id){
        $obj = Complaints::find($id);
        if ($obj != null) {
            $obj->delete();
            File::delete($obj->avatar);
        }
        return redirect('/admin/complaints');
    }
    
    public function not_seen($id){
        $obj = Complaints::find($id);
        if ($obj != null) {
            $obj->status = 0;
            $obj->save();
        }
        return redirect('/admin/complaints');
    }

    public function pending($id){
        $obj = Complaints::find($id);
        if ($obj != null) {
            $obj->status = 1;
            $obj->save();
        }
        return redirect('/admin/complaints');
    }

    public function success($id){
        $obj = Complaints::find($id);
        if ($obj != null) {
            $obj->status = 2;
            $obj->save();
        }

        return redirect('/admin/complaints');
    }

    public function faild($id){
        $obj = Complaints::find($id);
        if ($obj != null) {
            $obj->status = 3;
            $obj->save();
        }
        return redirect('/admin/complaints');
    }
}