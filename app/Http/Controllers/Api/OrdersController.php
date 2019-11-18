<?php

namespace App\Http\Controllers\Api;

use App\CommentsOrders;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\User;
use App\Links;
use Illuminate\Support\Facades\Auth;
use Webpatser\Uuid\Uuid;

class OrdersController extends Controller
{
    public function change_fee_inland_transport(Request $request)
    {
        $fee = $request->fee;
        $id = $request->id;
        $obj = Order::find($id);
        $obj->transport_cn = $fee;
        try {
            $obj->save();
            return response()->json(['success' => 1], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => 0, 'msg' => $th->getMessage()], 500);
        }
    }

    public function change_fee_transport_cn_vn(Request $request)
    {
        $fee = $request->fee;
        $id = $request->id;
        $obj = Order::find($id);
        $obj->transport_cn_vn = $fee;
        try {
            $obj->save();
            return response()->json(['success' => 1], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => 0, 'msg' => $th->getMessage()], 500);
        }
    }

    public function change_fee_service(Request $request)
    {
        $fee = $request->fee;
        $id = $request->id;
        $obj = Order::find($id);
        $obj->fee_service = $fee;
        try {
            $obj->save();
            return response()->json(['success' => 1], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => 0, 'msg' => $th->getMessage()], 500);
        }
    }

    public function change_weight(Request $request)
    {
        $fee = $request->fee;
        $id = $request->id;
        $obj = Order::find($id);
        $obj->weight = $fee;
        try {
            $obj->save();
            return response()->json(['success' => 1], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => 0, 'msg' => $th->getMessage()], 500);
        }
    }

    public function add_link(Request $request)
    {
        $temp_id = Uuid::generate()->string;
        $link = $request->link;
        $id_stuff = $request->id;
        $obj = new Links();
        $obj->id = $temp_id;
        $obj->path = $link;
        $obj->id_stuff = $id_stuff;
        try {
            $obj->save();
            return response()->json(['success' => 1, 'id' => $temp_id], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => 0, 'msg' => $th->getMessage()], 500);
        }
    }

    public function del_link(Request $request)
    {
        $id = $request->id;
        $obj = Links::find($id);
        try {
            $obj->delete();
            return response()->json(['success' => 1], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => 0, 'msg' => $th->getMessage()], 500);
        }
    }

    public function change_wood_package(Request $request)
    {
        $fee = $request->fee;
        $id = $request->id;
        $obj = Order::find($id);
        $obj->wood_package = $fee;
        try {
            $obj->save();
            return response()->json(['success' => 1], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => 0, 'msg' => $th->getMessage()], 500);
        }
    }

    public function change_code_order_cn(Request $request)
    {
        $code = $request->code;
        $id = $request->id;
        $obj = Order::find($id);
        $obj->code_order_cn = $code;
        try {
            $obj->save();
            return response()->json(['success' => 1], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => 0, 'msg' => $th->getMessage()], 500);
        }
    }

    public function change_buy_account(Request $request)
    {
        $account = $request->account;
        $id = $request->id;
        $obj = Order::find($id);
        $obj->buy_account = $account;
        try {
            $obj->save();
            return response()->json(['success' => 1], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => 0, 'msg' => $th->getMessage()], 500);
        }
    }

    public function change_note_admin(Request $request)
    {
        $note_admin = $request->note_admin;
        $id = $request->id;
        $obj = Order::find($id);
        $obj->note_admin = $note_admin;
        try {
            $obj->save();
            return response()->json(['success' => 1], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => 0, 'msg' => $th->getMessage()], 500);
        }
    }

    public function send_comment(Request $request)
    {
        $comment = $request->comment;
        $id_order = $request->id_order;
        $id_user = $request->id_user;
        $obj = new CommentsOrders();
        $obj->content = $comment;
        $obj->id_user = $id_user;
        $obj->id_order = $id_order;
        try {
            $obj->save();
            return response()->json(['success' => 1], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => 0, 'msg' => $th->getMessage()], 500);
        }
    }






    public function change_status(Request $request)
    {
        $status = $request->status;
        $id = $request->id;
        $obj = Order::find($id);
        if ($status == 9) {
            $obj->ship_request = 6;
        }
        $obj->status = $status;
        if ($status == 20) {
            $id_user = $obj->id_user;
            $user = User::find($id_user);
            $user->amount = ($user->amount) + ($obj->deposit);
            $user->save();
        }
        try {
            $obj->save();
            return response()->json(['success' => 1], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => 0, 'msg' => $th->getMessage()], 500);
        }
    }

    public function change_exchange_rate(Request $request)
    {
        $id = $request->id;
        $exchange_rate = $request->exchange_rate;
        $obj = Order::find($id);
        $obj->exchange_rate = $exchange_rate;
        try {
            $obj->save();
            return response()->json(['success' => 1], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => 0, 'msg' => $th->getMessage()], 500);
        }
    }

    public function change_lading(Request $request)
    {
        $id = $request->id;
        $lading = $request->lading;
        $obj = Order::find($id);
        $obj->lading = $lading;
        try {
            $obj->save();
            return response()->json(['success' => 1], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => 0, 'msg' => $th->getMessage()], 500);
        }
    }
}