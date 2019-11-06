<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\User as User;
use App\Provinces as Provinces;
use App\Cities as Cities;
use App\ShipAddress as ShipAddress;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class UsersControllers extends Controller
{
    public function account(Request $request)
    {
        if (Auth::user()) {
            if ($request->isMethod('get')) {
                $obj = User::find(Auth::user()->id);
                $provinces = Provinces::get();
                $cities = Cities::where('cities.matp', '=', $provinces[0]->matp)->get();
                $address = ShipAddress::where('ship_address.id_user', '=', Auth::user()->id)
                    ->join('cities', 'cities.maqh', '=', 'ship_address.city_id')
                    ->join('provinces', 'provinces.matp', '=', 'ship_address.province_id')
                    ->select('ship_address.*', 'ship_address.address as address', 'ship_address.phone as phone', 'ship_address.id as id', 'provinces.name as provinces_name', 'cities.name as cities_name')
                    ->get();
                $data = ['obj' => $obj, 'cities' => $cities, 'provinces' => $provinces, 'address' => $address];
                return view('users.account', $data);
            }
            if ($request->isMethod('post')) {
                $request->validate([
                    'fullname' => 'required',
                    'phone' => 'numeric:13|required',
                    'address' => 'required'
                ]);
                $obj = User::find(Auth::user()->id);
                $obj->fullname = $request->fullname;
                $obj->phone = $request->phone;
                $obj->address = $request->address;
                $obj->save();
                if ($request->hasFile('avatar')) {
                    $file = $request->avatar;
                    $newFileName =  time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('pictures/users'), $newFileName);
                    $obj->avatar = 'pictures/users/' . $newFileName;
                    $obj->save();
                }
                return redirect('/users/account')->with('status', 'Cập nhật thành công !!!');
            }
        } else {
            return redirect('/');
        }
    }


    public function add_address(Request $request)
    {
        $request->validate([
            'address' => 'required',
            'phone' => 'numeric:13|required',
        ]);

        $default = ShipAddress::where([
            ['ship_address.id_user', '=', Auth::user()->id],
            ['ship_address.is_default', '=', 1]
        ])
            ->first();

        $obj = new ShipAddress();

        if ($default == null) {
            $obj->is_default = 1;
        }

        $obj->id_user = Auth::user()->id;
        $obj->province_id = $request->province_id;
        $obj->city_id = $request->city_id;
        $obj->address = $request->address;
        $obj->phone = $request->phone;
        $obj->save();

        return back();
    }

    public function edit_address(Request $request)
    {
        $request->validate([
            'address' => 'required',
            'phone' => 'numeric:13|required',
        ]);

        $obj = ShipAddress::find($request->id_address);
        $obj->province_id = $request->province_id;
        $obj->city_id = $request->city_id;
        $obj->address = $request->address;
        $obj->phone = $request->phone;
        $obj->save();

        return back();
    }


    public function default_address(Request $request)
    {
        $undefault = ShipAddress::where([
            ['ship_address.id_user', '=', Auth::user()->id],
            ['ship_address.is_default', '=', 1]
        ])
            ->first();
        if ($undefault != null) {
            $undefault->is_default = 0;
            $undefault->save();
        }
        $obj = ShipAddress::find($request->id);
        $obj->is_default = 1;
        $obj->save();

        return back();
    }


    public function delete_address(Request $request)
    {
        $obj = ShipAddress::find($request->id);
        if ($obj != null) {
            $obj->delete();
        }
        $check_default = ShipAddress::where([
            ['ship_address.id_user', '=', Auth::user()->id],
            ['ship_address.is_default', '=', 1]
        ])
            ->first();

        if ($check_default == null) {
            $default = ShipAddress::where('ship_address.id_user', '=', Auth::user()->id)
                ->first();
            if ($default != null) {
                $default->is_default = 1;
                $default->save();
            }
        }
        return back();
    }




    public function password(Request $request)
    {
        if (Auth::user()) {
            if ($request->isMethod('get')) {
                return view('users.password');
            }
            if ($request->isMethod('post')) {
                $request->validate([
                    'old_password' => 'required',
                    'password' => 'between:5,50|confirmed'
                ]);
                $obj = User::find(Auth::user()->id);
                if (Hash::check($request->old_password, $obj->password) == 1) {
                    $obj->password = Hash::make($request->password);
                    $obj->save();
                    return redirect('/users/password')->with('status', 'Change password success!');
                } else {
                    return redirect('/users/password')->with('status', 'Wrong old password!');
                }
            }
        } else {
            return redirect('/');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}