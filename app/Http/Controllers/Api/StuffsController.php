<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Stuff;
use App\Order;
use App\User;

class StuffsController extends Controller
{

    public function change_quantity(Request $request)
    {
        $id = $request->id;
        $quantity = $request->quantity;
        $obj = Stuff::find($id);
        $obj->quantity = $quantity;
        try {
            $obj->save();
            return response()->json(['success' => 1], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => 0, 'msg' => $th->getMessage()], 500);
        }
    }

    public function change_status(Request $request)
    {
        $id = $request->id;
        $obj = Stuff::find($id);
        $obj->status = 1;

        $id_order = $request->id_order;
        $order = Order::find($id_order);

        if ($order->status != 20 && $order->status != 10) {
            $id_user = $order->id_user;
            $user = User::find($id_user);
            $user->amount = ($user->amount) + ($order->deposit);
            $user->save();
        }

        $order->status = 10;
        try {
            $order->save();
            $obj->save();
            return response()->json(['success' => 1], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => 0, 'msg' => $th->getMessage()], 500);
        }
    }

    public function change_price(Request $request)
    {
        $id = $request->id;
        $price = $request->price;
        $obj = Stuff::find($id);
        $obj->price = $price;
        try {
            $obj->save();
            return response()->json(['success' => 1], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => 0, 'msg' => $th->getMessage()], 500);
        }
    }


    public function change_link(Request $request)
    {
        $obj = Stuff::find($request->id);
        $obj->link = $request->link;
        $obj->name = $request->link;
        $obj->save();
        return response()->json(['success' => 1], 200);
    }

    public function note(Request $request)
    {
        $id = $request->id;
        $note = $request->note;
        $obj = Stuff::find($id);
        $obj->note = $note;
        try {
            $obj->save();
            return response()->json(['success' => 1], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => 0, 'msg' => $th->getMessage()], 500);
        }
    }
}