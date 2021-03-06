<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\User as User;
use App\Order as Order;
use App\Cities;
use App\ShipAddress;
use App\Provinces;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\CommentsOrders;
use App\Statements;

class TransportsController extends Controller
{
    public function send_request(Request $request)
    {
        $obj = Order::find($request->id);
        $obj->ship_request = 1;
        $obj->receiver = $request->receiver;
        $obj->receiver_phone = $request->receiver_phone;
        $obj->address = $request->address;
        $obj->id_address = $request->id_address;
        $obj->save();
        return back()->with('notify', 'Yêu cầu giao hàng của bạn đã đuợc gửi đi');
    }

    public function received_goods(Request $request, $id)
    {
        $obj = Order::find($id);
        $obj->status = 9;
        $obj->ship_request = 6;
        $obj->save();
        return back()->with('notify', 'Cảm ơn bạn đã xác nhận');
    }

    public function index(Request $request, $status)
    {
        $provinces = Provinces::get();
        $cities = Cities::where('cities.matp', '=', $provinces[0]->matp)->get();
        $list_ship = DB::table('ship_address')->where('id_user', Auth::user()->id)->get();
        $data['list_ship_address'] = $list_ship;
        $data['provinces'] = $provinces;
        $data['cities'] = $cities;

        $query = Order
            ::join('users', 'orders.id_user', '=', 'users.id')
            ->select(
                'orders.*',
                'orders.id as id',
                'users.fullname as fullname'
            )
            ->orderBy('orders.id', 'DESC');

        if ($status != -1) {
            $query->where('orders.ship_request', $status);
            $data['title'] = 'Phiếu giao hàng';
        } else {
            $query->where('orders.status', 7)->where('orders.ship_request', 0);
        }
        $list = $query->paginate(15);
        $data['list'] = $list;
        $data['status'] = $status;

        return view('users.request-transport', $data);
    }

    public function choose_address_api()
    {
        $list_ship = DB::table('ship_address')->where('id_user', Auth::user()->id)->get();
        $data['list_ship_address'] = $list_ship;
        return view('users.choose-address', $data);
    }

    public function pay_shipfee(Request $request)
    {
        $user = User::find(Auth::user()->id);
        if ($user->amount > $request->ship_fee) {
            $user->amount = ($user->amount) - ($request->ship_fee);
            $user->save();

            $obj = Order::find($request->id);
            $obj->ship_request = 3;
            $obj->save();

            $comment = new CommentsOrders();
            $comment->content = htmlspecialchars('<span class="text-red">Thanh toán phí vận chuyển nội địa đơn hàng </span><a>QC' . $request->id . '</a>
            &nbsp;<strong><span class="text-green">' . formatVNDString($request->ship_fee) . '</span></strong>');
            $comment->id_order = $request->id;
            $comment->id_user = Auth::user()->id;
            $comment->save();

            $stm = new Statements();
            $stm->content = htmlspecialchars('<span class="text-red">Thanh toán phí vận chuyển nội địa đơn hàng</span><a>QC' .  $request->id . '</a>');
            $stm->created_at =  now()->timestamp;
            $stm->type = 3; //thanh toan
            $stm->is_sub = 1;
            $stm->amount = $request->ship_fee;
            $stm->method = 3; //tien quy doi
            $stm->id_user =  Auth::user()->id;
            $stm->id_order = $request->id;
            $stm->status = 1;
            $stm->save();

            return back()->with('notify', 'Thanh toán thành công');
        }
        return redirect('users/finance/deposit');
    }


    // =================== address ===============

    public function choose_address(Request $request)
    {
        $provinces = Provinces::get();
        $cities = Cities::where('cities.matp', '=', $provinces[0]->matp)->get();
        $list = DB::table('ship_address')->where('id_user', Auth::user()->id)->get();
        $data['owner_type'] = $request->owner_type;
        $data['id_owner'] = $request->id_owner;
        $data['owner_name'] = $request->owner_name;
        $data['index_cart'] = $request->index_cart;
        $data['total'] = $request->total;
        $data['item_orders'] = null;

        if ($data['owner_type'] == 1) {
            if ($data['id_owner'] != -1) {
                $data['item_orders'] = $_SESSION['cart']['tmall_market'][$request->index_cart];
            } else {
                $data['item_orders'] = $_SESSION['cart']['tmall_shop'];
            }
        }

        if ($data['owner_type'] == 2) {
            $data['item_orders'] = $_SESSION['cart']['1688_market'][$request->index_cart];
            // dd($_SESSION['cart']['1688_market'][$index]);
        }

        if ($data['owner_type'] == 3) {
            $data['item_orders'] = $_SESSION['cart']['taobao_market'][$request->index_cart];
            // dd($_SESSION['cart']['taobao_market'][$index]);
        }

        $data['rate'] = $request->rate;
        $data['note'] = $request->note;
        $data['list_ship_address'] = $list;
        $data['provinces'] = $provinces;
        $data['cities'] = $cities;

        return view('users.choose_address', $data);
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
        ])->first();

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


    public function delete_address(Request $request)
    {
        $obj = ShipAddress::find($request->id);
        if ($obj != null) {
            $obj->delete();
        }
        $check_default = ShipAddress::where([
            ['ship_address.id_user', '=', Auth::user()->id],
            ['ship_address.is_default', '=', 1]
        ])->first();

        if ($check_default == null) {
            $default = ShipAddress::where('ship_address.id_user', '=', Auth::user()->id)->first();
            if ($default != null) {
                $default->is_default = 1;
                $default->save();
            }
        }
        return back();
    }
    // =================== end address ===============


}