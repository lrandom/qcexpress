<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Order;
use App\Stuff;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\CommentsOrders;
use App\Statements;

class OrdersControllers extends Controller
{
    public function __construct()
    { }

    public function index(Request $request, $id)
    {
        //$id = $request->query('id');
        $query = Order::join('users', 'users.id', '=', 'orders.id_user')
            ->select('orders.*', 'orders.created_at as created_at', 'orders.updated_at as updated_at', 'users.id as id_user', 'users.fullname as fullname', 'orders.id as id')
            ->orderBy('orders.id', 'desc');
        $query->where('id_user', '=', Auth::user()->id);

        if (is_numeric($id)) {
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
        }
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
        $query->where($condition);
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

        $data['list'] = $list;
        $data['status'] = $id;
        return view('users.order', $data);
    }

    public function detail(Request $request, $id)
    {
        //$id = $request->query('id');
        $query = Order::join('users', 'users.id', '=', 'orders.id_user')
            ->select('orders.*', 'orders.created_at as created_at', 'orders.updated_at as updated_at', 'users.id as id_user', 'users.fullname as fullname', 'orders.id as id')
            ->orderBy('orders.id', 'desc');
        $query->where('id_user', '=', Auth::user()->id)->where('orders.id', $id);

        $list = $query->get();
        foreach ($list as $r) {
            $stuffs  = DB::table('stuffs')->where('id_order', '=', $r->id)->get();
            $r->stuffs = $stuffs;
        }
        $data['list'] = $list;
        $data['status'] = 1;
        return view('users.orderdetail', $data);
    }

    public function payment(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->amount = ($user->amount) - ($request->pay);
        $user->save();

        $obj = Order::find($request->id);
        $obj->is_final = 1;
        $obj->save();

        $comment = new CommentsOrders();

        $comment->content = htmlspecialchars('<span class="text-red">Tất toán đơn hàng </span><a>QC'  . $request->id . '</a>&nbsp;<strong><span class="text-green">' . formatVNDString($request->pay) . '</span></strong>');
        $comment->id_order = $request->id;
        $comment->id_user = Auth::user()->id;
        $comment->save();

        $stm = new Statements();
        $stm->content = htmlspecialchars('<span class="text-red">Tất toán đơn hàng </span><a>QC' .  $request->id . '</a>:&nbsp;<strong><span class="text-green"></span></strong>');
        $stm->created_at =  now()->timestamp;
        $stm->type = 2; //đat coc
        $stm->is_sub = 1;
        $stm->amount = $request->pay;
        $stm->method = 3; //tien quy doi
        $stm->id_user =  Auth::user()->id;
        $stm->id_order = $request->id;
        $stm->status = 1;
        $stm->save();
        return back()->with('notify', 'Tất toán thành công');
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
        $obj = Order::find($request->id);
        $obj->status = 20;
        $obj->save();

        $comment = new CommentsOrders();
        $comment->content = htmlspecialchars('<span class="text-red">Huỷ đơn hàng </span><a>QC' .  $request->id . '</a>');
        $comment->id_order = $request->id;
        $comment->id_user = Auth::user()->id;
        $comment->save();

        $comment = new CommentsOrders();
        $comment->content = htmlspecialchars('<span class="text-red">Lý do huỷ: </span><strong><span class="text-green">' . $request->reason . '</span></strong>');
        $comment->id_order = $request->id;
        $comment->id_user = Auth::user()->id;
        $comment->save();

        return back()->with('notify', 'Huỷ đơn <a>' . $request->id . '</a> thành công');
    }
}