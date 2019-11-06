<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User as User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UsersControllers extends Controller
{
    public function index()
    {
        $list = User::orderBy('id', 'DESC')->paginate(15);
        $data = array('list' => $list);
        return view('admin.users.index', $data);
    }

    public function add(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('admin.users.add');
        }

        if ($request->isMethod('post')) {
            $request->validate([
                'fullname' => 'required',
                'email' => 'email:rfc,dns|unique:users,email',
                'password' => 'between:5,50|confirmed',
                'phone' => 'numeric:15|unique:users,phone',
                'amount' => 'numeric:10',
                'buy_fee' => 'numeric:2',
                'address' => 'required'
            ]);
            $obj = new User();
            $obj->fullname =  $request->fullname;
            $obj->email = $request->email;
            $obj->password = Hash::make($request->password);
            $obj->phone = $request->phone;
            $obj->address = $request->address;
            $obj->per = $request->per;
            $obj->amount = $request->amount;
            $obj->buy_fee = $request->buy_fee;
            $obj->per_deposit = $request->per_deposit;
            $obj->email_verified_at = now()->timestamp;
            $obj->save();
            if ($request->hasFile('avatar')) {
                $file = $request->avatar;
                $newFileName =  time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('pictures/users'), $newFileName);
                $obj->avatar = 'pictures/users/' . $newFileName;
                $obj->save();
            }
            return redirect('/admin/users/add')->with('notify', 'Add Successfully');
        }
    }


    public function edit(Request $request)
    {
        if ($request->isMethod('get')) {
            $obj = User::find($request->id);
            $data = array('obj' => $obj);
            return view('admin.users.edit', $data);
        }

        if ($request->isMethod('post')) {
            if ($request->password != '' || $request->password_confirmation != '') {
                $request->validate([
                    'password' => 'between:5,50|confirmed',
                ]);
                $obj = User::find($request->id);
                $obj->password = Hash::make($request->password);
                $obj->save();
            } else {
                $request->validate([
                    'fullname' => 'required',
                    'email' => 'email:rfc,dns|required',
                    'phone' => 'numeric:10|required',
                    'amount' => 'numeric:10',
                    'buy_fee' => 'numeric:2',
                    'address' => 'required'
                ]);

                $check_phone = DB::table('users')
                    ->where([
                        ['users.phone', '=', $request->phone],
                        ['users.id', '!=', $request->id],
                    ])
                    ->first();
                if ($check_phone != null) {
                    $request->validate([
                        'phone' => 'required|numeric:10|unique:users,phone'
                    ]);
                }

                $check_email = DB::table('users')
                    ->where([
                        ['users.email', '=', $request->email],
                        ['users.id', '!=', $request->id],
                    ])
                    ->first();
                if ($check_email != null) {
                    $request->validate([
                        'email' => 'required|email:rfc,dns|unique:users,email'
                    ]);
                }

                $obj = User::find($request->id);
                $obj->email = $request->email;
                $obj->fullname =  $request->fullname;
                $obj->phone = $request->phone;
                $obj->address = $request->address;
                $obj->per = $request->per;
                $obj->amount = $request->amount;
                $obj->buy_fee = $request->buy_fee;
                $obj->per_deposit = $request->per_deposit;
                $obj->save();
            }
            if ($request->hasFile('avatar')) {
                $file = $request->avatar;
                $newFileName =  time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('pictures/users'), $newFileName);
                $obj->avatar = 'pictures/users/' . $newFileName;
                $obj->save();
            }
            return redirect('/admin/users/edit/' . $request->id)->with('notify', 'Edit Successfully');
        }
    }

    public function delete($id)
    {
        $obj = User::find($id);
        if ($obj != null) {
            $obj->delete();
            File::delete($obj->avatar);
        }
        return redirect('/admin/users');
    }

    public function active($id)
    {
        $obj = User::find($id);
        if ($obj != null) {
            $obj->is_active = 1;
            $obj->save();
        }
        return redirect('/admin/users');
    }

    public function deactive($id)
    {
        $obj = User::find($id);
        if ($obj != null) {
            $obj->is_active = 0;
            $obj->save();
        }
        return redirect('/admin/users');
    }

    public function profile(Request $request)
    {
        if (Auth::user()) {
            // dd(Auth::user());
            $obj = User::find(Auth::user()->id);
            if ($request->isMethod('get')) {
                $data = ['obj' => $obj];
                return view('admin.users.profile', $data);
            }
            if ($request->isMethod('post')) {
                $request->validate([
                    'fullname' => 'required',
                    'email' => 'email:rfc,dns',
                    'phone' => 'numeric:13|required',
                    'address' => 'required'
                ]);
                $obj->fullname = $request->fullname;
                $obj->email = $request->email;
                $obj->phone = $request->phone;
                $obj->address = $request->address;
                $obj->save();
                if ($request->hasFile('picture')) {
                    $file = $request->picture;
                    $newFileName =  time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('pictures/users'), $newFileName);
                    $obj->avatar = 'pictures/users/' . $newFileName;
                    $obj->save();
                }
                return redirect('/admin/users/profile')->with('status', 'Update profile success!');
            }
        } else {
            return redirect('/admin/users');
        }
    }


    public function password(Request $request)
    {
        if (Auth::user()) {
            if ($request->isMethod('get')) {
                return view('admin.users.password');
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
                    return redirect('/admin/users/change-password')->with('status', 'Change password success!');
                } else {
                    return redirect('/admin/users/change-password')->with('status', 'Wrong old password!');
                }
            }
        } else {
            return redirect('/admin/users');
        }
    }

    public function login(Request $request)
    {
        if (!Auth::guest() && Auth::user()->per == 0) {
            return redirect('/');
        }

        if (!Auth::guest() && Auth::user()->per == 1) {
            return redirect('admin/dashboard');
        }

        if (Auth::guest()) {
            if ($request->isMethod('get')) {
                return view('auth.login-admin');
            }
        }
    }

    public function register(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('auth.resgister');
        }
        if ($request->isMethod('post')) {
            $request->validate([
                'email' => 'email:rfc,dns',
                'password' => 'between:5,50|confirmed'
            ]);
            $user = User::where('users.email', '=', $request->email)->first();
            if ($user != null) {
                if (Hash::check($request->password, $user->password) == 1) {
                    return redirect('/admin/dashboard');
                } else {
                    return redirect('/admin/login')->with('status', 'Wrong email or password!');
                }
            } else {
                return redirect('/admin/login')->with('status', 'Wrong email or password!');
            }
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/admin/login');
    }
}