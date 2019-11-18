<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Statements;
use App\CommentsOrders;
use App\Exports\OrdersExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\User;

class OrdersControllers extends Controller
{
    public function all(Request $request)
    {
        $query = Order::join('users', 'users.id', '=', 'orders.id_user')
            ->select(
                'orders.*',
                'orders.created_at as created_at',
                'orders.updated_at as updated_at',
                'users.id as id_user',
                'users.fullname as fullname',
                'orders.id as id',
                'users.email as email'
            )
            ->orderBy('orders.id', 'desc');
        $condition = [];

        if ($request->id_order != null) {
            $id_order = $request->id_order;
            if (is_numeric($id_order)) {
                array_push($condition, ['orders.id',  'like', '%' . $id_order . '%']);
            } else {
                $id_order = str_replace('Q', '', $id_order);
                $id_order = str_replace('D', '', $id_order);
                $id_order = str_replace('H', '', $id_order);
                if (!is_numeric($id_order)) {
                    explode('-', $id_order);
                    $id_order = $id_order[3];
                }
                array_push($condition, ['orders.id',  'like', '%' . $id_order . '%']);
            }
        }

        if ($request->lading != null) {
            array_push($condition, ['orders.lading', 'like', '%' . $request->lading . '%']);
        }

        if ($request->id_client != null) {
            $id_client = str_replace('QKT', '', $request->id_client);
            array_push($condition, ['users.id', 'like', '%' . $id_client . '%']);
        }

        if ($request->lading_status != null) {
            $lading_status = $request->lading_status;
            if ($lading_status == 1) {
                array_push($condition, ['orders.lading', '!=', null]);
            }

            if ($lading_status == 2) {
                array_push($condition, ['orders.lading', '=', null]);
            }
        }

        if (is_numeric($request->sites)) {
            array_push($condition, ['orders.sites', '=', $request->sites]);
        }

        if ($request->created_at != null) {
            array_push($condition, ['orders.created_at', '>=', formateudate($request->created_at)]);
        }

        if ($request->updated_at != null) {
            array_push($condition, ['orders.updated_at', '<=', formateudate($request->updated_at)]);
        }

        if ($request->type == 'wait') {
            array_push($condition, ['status', '=', 1]);
        }

        if ($request->type == 'buyed') {
            array_push($condition, ['status', '=', 3]);
        }

        $query->where($condition);


        $stuff_lists = [];
        $list = $query->paginate(15);
        foreach ($list as $r) {
            $stuffs  = DB::table('stuffs')->where('id_order', '=', $r->id)->get();
            $r->stuffs = $stuffs;
            if (isset($request->export_excel) && is_numeric($request->export_excel)) {
                $stuffs_export  = DB::table('stuffs')->select('name', 'link', 'quantity', 'price', 'note', 'props', 'id_order')->where('id_order', '=', $r->id)->get();
                foreach ($stuffs_export as $stuff) {
                    $props = json_decode($stuff->props);
                    $tmp = '';
                    foreach ($props as $r) {
                        $tmp .= '(' . $r->name . '-' . $r->val . ')';
                    }
                    $stuff->props = $tmp;
                    $stuff->props = $stuff->props;
                    $stuff_lists[] = $stuff;
                }
            }
        }

        if (isset($request->export_excel) && is_numeric($request->export_excel)) {
            $excel = new OrdersExport($stuff_lists);
            return Excel::download($excel, 'dshang' . date('d-m-y H:i:s') . '.xlsx');
        }
        return view('admin.orders.index', array('list' => $list, 'status' => -1));
    }

    public function index(Request $request, $id)
    {
        $query = Order::join('users', 'users.id', '=', 'orders.id_user')
            ->select(
                'orders.*',
                'orders.created_at as created_at',
                'orders.updated_at as updated_at',
                'users.id as id_user',
                'users.fullname as fullname',
                'orders.id as id',
                'users.email as email'
            )
            ->orderBy('orders.id', 'desc');

        $condition = [];


        if ($request->id_order != null) {
            $id_order = $request->id_order;
            if (is_numeric($id_order)) {
                array_push($condition, ['orders.id',  'like', '%' . $id_order . '%']);
            } else {
                $id_order = str_replace('Q', '', $id_order);
                $id_order = str_replace('D', '', $id_order);
                $id_order = str_replace('H', '', $id_order);
                if (!is_numeric($id_order)) {
                    explode('-', $id_order);
                    $id_order = $id_order[3];
                }
                array_push($condition, ['orders.id',  'like', '%' . $id_order . '%']);
            }
        }


        if ($request->lading != null) {
            array_push($condition, ['orders.lading', 'like', '%' . $request->lading . '%']);
        }

        if ($request->id_client != null) {
            $id_client = str_replace('QKT', '', $request->id_client);
            array_push($condition, ['users.id', 'like', '%' . $id_client . '%']);
        }

        if ($request->lading_status != null) {
            $lading_status = $request->lading_status;
            if ($lading_status == 1) {
                array_push($condition, ['orders.lading', '!=', null]);
            }

            if ($lading_status == 2) {
                array_push($condition, ['orders.lading', '=', null]);
            }
        }

        if (is_numeric($request->sites)) {
            array_push($condition, ['orders.sites', '=', $request->sites]);
        }

        if ($request->created_at != null) {
            array_push($condition, ['orders.created_at', '>=', formateudate($request->created_at)]);
        }

        if ($request->updated_at != null) {
            array_push($condition, ['orders.updated_at', '<=', formateudate($request->updated_at)]);
        }

        if ($request->type == 'wait') {
            array_push($condition, ['status', '=', 1]);
        }

        if ($request->type == 'buyed') {
            array_push($condition, ['status', '=', 3]);
        }

        // if (count($condition) != 0) {
        $query->where($condition);
        // } else {
        if ($id != 11 && $id != 12 && $id != 13 && $id != -1) {
            $query->where('orders.status', $id);
        }
        switch ($id) {
            case 11:
                //paid
                $query->where('deposit', '>', 0)->where('is_final', 0)->where('status', '!=', 20);
                break;

            case 12:
                //unpaind
                $query->where('deposit', '<=', 0)->where('is_final', 0)->where('status', '!=', 20);
                break;

            case 13:
                //final settlement
                $query->where('is_final', 1)->where('status', '!=', 20);
                break;
        }
        // }

        $list = $query->paginate(15);
        foreach ($list as $r) {
            $stuffs  = DB::table('stuffs')->where('id_order', '=', $r->id)->get();
            $r->stuffs = $stuffs;
            if (isset($request->export_excel) && is_numeric($request->export_excel)) {
                $stuffs_export  = DB::table('stuffs')->select('name', 'link', 'quantity', 'price', 'note', 'props', 'id_order')->where('id_order', '=', $r->id)->get();
                foreach ($stuffs_export as $stuff) {
                    $props = json_decode($stuff->props);
                    $tmp = '';
                    foreach ($props as $r) {
                        $tmp .= '(' . $r->name . '-' . $r->val . ')';
                    }
                    $stuff->props = $tmp;
                    $stuff->props = $stuff->props;
                    $stuff_lists[] = $stuff;
                }
            }
        }
        if (isset($request->export_excel) && is_numeric($request->export_excel)) {
            $excel = new OrdersExport($stuff_lists);
            return Excel::download($excel, 'dshang' . date('d-m-y H:i:s') . '.xlsx');
        }
        // dd($list);
        return view('admin.orders.index', array('list' => $list, 'status' => $id));
    }







    public function detail(Request $request, $id)
    {
        $query = Order::join('users', 'users.id', '=', 'orders.id_user')
            ->join('depots', 'depots.id', '=', 'orders.id_depot')
            ->join('ship_address', 'ship_address.id', '=', 'orders.id_address')
            ->select(
                'orders.*',
                'orders.created_at as created_at',
                'orders.updated_at as updated_at',
                'users.id as id_user',
                'users.fullname as fullname',
                'orders.id as id',
                'users.email as email',
                'depots.name as depot_name',
                'ship_address.address as address',
                'ship_address.phone as phone'
            )
            ->orderBy('orders.id', 'desc');

        $data['obj'] = $query->first($id);
        $stuffs = DB::table('stuffs')->where('id_order', '=', $id)->get();
        $data['obj']->stuffs = $stuffs;

        return view('admin.detail.index', $data);
    }






    public function upload_img(Request $request)
    {
        $obj = Order::find($request->id);
        $arr = $obj->picture;
        $i = 0;
        if ($request->picture) {
            foreach ($request->picture as $key => $item) {
                if ($item != null) {
                    $file = $item;
                    $newFileName =  time() . $i . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('pictures/orders'), $newFileName);
                    $temp = 'pictures/orders/' . $newFileName;
                    if (isset($arr[$key]) && $arr[$key] != null) {
                        File::delete($arr[$key]);
                        $arr[$key] = $temp;
                    } else {
                        array_push($arr, $temp);
                    }
                    $i++;
                }
            }
        }
        $obj->picture = $arr;
        $obj->save();

        $comment = new CommentsOrders();
        $comment->content = htmlspecialchars('<span class="text-red">Up ảnh lên đơn</span>');
        $comment->id_order = $request->id;
        $comment->id_user = Auth::user()->id;
        $comment->save();

        return back()->with('notify', 'Upload ảnh thành công');
    }

    public function cancel_order(Request $request)
    {
        $request->validate([
            'reason' => 'required'
        ]);

        $obj = Order::find($request->id);
        $obj->status = 20;
        $obj->save();

        $comment = new CommentsOrders();
        $comment->content = htmlspecialchars('<span class="text-red">Huỷ đơn hàng </span><a>QC' . $request->id . '</a>');
        $comment->id_order = $request->id;
        $comment->id_user = Auth::user()->id;
        $comment->save();

        $comment = new CommentsOrders();
        $comment->content = htmlspecialchars('<span class="text-red">Lý do huỷ: </span><strong><span class="text-green">' . $request->reason . '</span></strong>');
        $comment->id_order = $request->id;
        $comment->id_user = Auth::user()->id;
        $comment->save();

        if ($request->refund != null) {
            if ($obj->deposit > 0) {
                try {
                    $stm = new Statements();
                    $stm->content = htmlspecialchars('<span class="text-red">Huỷ đơn và hoàn tiền</span><a>QC' . $request->id . '</a>');
                    $stm->created_at =  now()->timestamp;
                    $stm->type = 4; //hoan tien
                    $stm->is_sub = 0;
                    $stm->amount = $obj->deposit;
                    $stm->method = 3; //tien quy doi
                    $stm->id_user =  $obj->id_user;
                    $stm->id_order = $request->id;
                    $stm->status = 1;

                    $stm->save();
                    $user = User::find($obj->id_user);
                    $user->amount = ($user->amount) * 1 + $obj->deposit * 1;
                    $user->save();
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }
        }
        return back()->with('notify', 'Huỷ đơn ' . formatorderid($obj->created_at, $request->id) . ' thành công');
    }

    public function delete($id)
    {
        $order = Order::find($id);
        $created_at = $order->created_at;
        if ($order->status == 20 && $order->deposit <= 0) {
            $order->delete();
            DB::table('comments_orders')->where('id_order', $id)->delete();
            DB::table('stuffs')->where('id_order', $id)->delete();
        }
        return back()->with('notify', 'Xoá đơn ' . formatorderid($order->created_at, $id) . ' thành công');
    }
}