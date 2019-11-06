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

class DashboardControllers extends Controller
{
    public function index(){

        $new_complaints = Complaints::join('users', 'users.id', '=', 'complaints.id_user')
        ->where('complaints.status', '=', '0')
        ->get();
        $new_orders = DB::table('orders')
        ->where('orders.status', '=', '0')
        ->get();
        $users = User::get();

        $data = array('new_complaints' => $new_complaints, 'new_orders' => $new_orders, 'users' => $users);
        return view('admin.dashboard.index', $data);
    }

}