<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Complaints as Complaints;
use App\User as User;
use App\Order as Order;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ComplaintsControllers extends Controller
{
    public function index(){
        $list = Complaints::where('complaints.id_user', '=', Auth::user()->id)
        ->orderBy('id', 'DESC')
        ->paginate(15);
        
        $data = array('list' => $list);
        return view('users.complaints', $data);
    }

    public function detail(Request $request){
        $list = Complaints::find($request->id);
        $data = array('list' => $list);
        return view('users.complaints-detail', $data);
    }


    public function add(Request $request){
        if ($request->isMethod('get')) {
            return view('users.complaints-add');
        }
        if ($request->isMethod('post')) {
            $request->validate([
                'reason' => 'required',
                'description' => 'required',
                'amount' => 'numeric:11|unique:users,amount',
            ]);
            $obj = new Complaints();
            $obj->id_user = Auth::user()->id;
            $obj->id_order = $request->id;
            $obj->status = 0;
            $obj->reason =  $request->reason;
            $obj->description = $request->description;
            $obj->note = $request->note;
            $obj->amount = $request->amount;
            $obj->save();

            $arr=[];
            $i = 0;
            foreach ($request->photo as $item) {
                $file = $item;
                $newFileName =  time().$i. '.' . $file->getClientOriginalExtension();
                $file->move(public_path('pictures/complaints'), $newFileName);
                $temp = 'pictures/complaints/' . $newFileName;
                array_push($arr, $temp);
                $i++;
            }
            $obj->photo = $arr;
            $obj->save();

            return redirect('/users/complaints');
        }
    }


    public function edit(Request $request){
        if ($request->isMethod('get')) {
            $obj = Complaints::find($request->id);
            $data = array('obj' => $obj);
            return view('users.complaints-edit', $data);
        }
        if ($request->isMethod('post')) {
            $request->validate([
                'reason' => 'required',
                'description' => 'required',
                'amount' => 'numeric:11|unique:users,amount',
            ]);
            $obj = Complaints::find($request->id);
            $obj->reason =  $request->reason;
            $obj->description = $request->description;
            $obj->note = $request->note;
            $obj->amount = $request->amount;
            $obj->save();

            $arr=$obj->photo;
            $i = 0;
            if($request->photo){
                foreach ($request->photo as $key => $item) {
                    if($item != null){
                        $file = $item;
                        $newFileName =  time().$i. '.' . $file->getClientOriginalExtension();
                        $file->move(public_path('pictures/complaints'), $newFileName);
                        $temp = 'pictures/complaints/' . $newFileName;
                        if(isset($arr[$key]) && $arr[$key] != null){
                            File::delete($arr[$key]);
                            $arr[$key] = $temp;
                        }else{
                            array_push($arr, $temp);
                        }
                        $i++;
                    }
                }
            }
            $obj->photo = $arr;
            $obj->save();
            
            return redirect('/users/complaints/edit/' . $request->id);
        }
    }

    public function delete(Request $request){
        $obj = Complaints::find($request->id);
        if ($obj != null) {
            $obj->delete();
            File::delete($obj->photo1);
            File::delete($obj->photo2);
            File::delete($obj->photo3);
            File::delete($obj->photo4);
            File::delete($obj->photo5);
        }
        return redirect('/users/complaints');
    }

 
}