<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User as User;
use App\Order as Order;
use App\Cities;
use App\ShipAddress;
use App\Provinces;

use App\Http\Controllers\Controller;
use App\Statements;
use App\CommentsOrders;


class TransportsControllers extends Controller
{


    public function index(Request $request, $status)
    {
        $provinces = Provinces::get();
        $cities = Cities::where('cities.matp', '=', $provinces[0]->matp)->get();
        //$list_ship = DB::table('ship_address')->where('id_user', Auth::user()->id)->get();
        //$data['list_ship_address'] = $list_ship;
        //$data['provinces'] = $provinces;
        //$data['cities'] = $cities;

        $query = Order
            ::join('users', 'orders.id_user', '=', 'users.id')
            ->select(
                'orders.*',
                'orders.id as id',
                'users.fullname as fullname'
            )
            ->orderBy('orders.id', 'DESC');

        //if ($status != -1) {
        $query->where('orders.ship_request', $status);
        $data['title'] = 'Phiếu giao hàng';
        // } else {
        //     $query->where('orders.status', 7)->where('orders.ship_request', 0);
        // }
        $list = $query->paginate(15);
        $data['list'] = $list;
        $data['status'] = $status;

        return view('admin.transport.request-transport', $data);
    }

    // public function request_transport()
    // {
    //     $list = Order::join('users', 'orders.id_user', '=', 'users.id')
    //         ->select('orders.*', 'orders.id as id', 'users.fullname as fullname')
    //         ->where([
    //             ['orders.ship_request', '!=', 0]
    //         ])
    //         ->orderBy('id', 'DESC')
    //         ->paginate(15);

    //     $data['list'] = $list;
    //     return view('admin.transport.request-transport', $data);
    // }


    public function agree_ship(Request $request)
    {
        $obj = Order::find($request->id);

        if ($request->input('btn-agree-ship') != null) {
            $obj->ship_request = 2; //đồng ý ship
            $obj->ship_fee = $request->ship_fee;
        }

        if ($request->input('btn-update-ship-info') != null) {
            $obj->transport_vn_name = $request->transport_vn_name;
            $obj->vn_lading = $request->vn_lading;
        }

        if ($request->input('btn-sent') != null) {
            $obj->status = 8;
            $obj->ship_request = 5;
        }

        $obj->save();
        return back();
    }


    public function received(Request $request)
    {
        $obj = Order::find($request->id);
        $obj->status = 9;
        $obj->save();
        return back();
    }

    public function cancel_transport(Request $request)
    {
        $obj = Order::find($request->id);
        $obj->ship_request = 4; // huy giao hang
        $obj->cancel_ship_vn_reason = $request->reason;

        if ($obj->ship_fee > 0 && $obj->ship_request != 5) {
            $stm = new Statements();
            $stm->content = htmlspecialchars('<span class="text-red">Hoàn phí ship đơn hàng</span><a>&nbsp;QC' . $request->id . '</a>');
            $stm->created_at =  now()->timestamp;
            $stm->type = 4; //hoan tien
            $stm->is_sub = 0;
            $stm->amount = $obj->ship_fee;
            $stm->method = 3; //tien quy doi
            $stm->id_user =  $obj->id_user;
            $stm->id_order = $request->id;
            $stm->status = 1;
            $stm->save();

            $user = User::find($obj->id_user);
            $user->amount = ($user->amount) * 1 + $obj->ship_fee * 1;
            $user->save();
        }

        $comment = new CommentsOrders();
        $comment->content = htmlspecialchars('<span class="text-red">Huỷ ship đơn hàng </span><a>&nbsp;QC' .  $request->id . '</a>');
        $comment->id_order = $request->id;
        $comment->id_user = $obj->id_user;
        $comment->save();

        $comment = new CommentsOrders();
        $comment->content = htmlspecialchars('<span class="text-red">Lý do huỷ: </span><strong><span class="text-green">' . $request->reason . '</span></strong>');
        $comment->id_order = $request->id;
        $comment->id_user = $obj->id_user;
        $comment->save();

        $obj->ship_fee = 0;
        $obj->save();
        return back();
    }

    // public function bill_transport(Request $request)
    // {
    //     $list_ship = DB::table('ship_address')->where('id_user', Auth::user()->id)->get();

    //     $data['list_ship_address'] = $list_ship;

    //     $query = Order::join('ship_address', 'ship_address.id', '=', 'orders.id_address')
    //         ->join('users', 'ship_address.id_user', '=', 'users.id')
    //         ->select('orders.*', 'orders.id as id', 'users.fullname as fullname', 'ship_address.id as id_address', 'ship_address.phone as phone', 'ship_address.address as address')
    //         ->orderBy('id', 'DESC');

    //     $list = null;

    //     if ($request->id != null) {
    //         $list = $query->where([
    //             ['orders.is_final', '=', 1],
    //             ['orders.ship_request', '=', 3],
    //             ['orders.status', '=', $request->id],
    //         ])->paginate(15);
    //     } else {
    //         $list = $query->where([
    //             ['orders.id_user', '=', Auth::user()->id],
    //             ['orders.is_final', '=', 1],
    //             ['orders.ship_request', '=', 3],
    //             ['orders.status', '!=', 8],
    //             ['orders.status', '!=', 9]
    //         ])->paginate(15);
    //     }

    //     foreach ($list as $r) {
    //         $stuffs  = DB::table('stuffs')->where('id_order', '=', $r->id)->get();
    //         $r->stuffs = $stuffs;
    //     }

    //     $data['list'] = $list;
    //     return view('admin.transport.bill-transport', $data);
    // }
}