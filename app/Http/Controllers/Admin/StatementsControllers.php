<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Statements as Statements;
use App\User as User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Exports\StatementsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;

class StatementsControllers extends Controller
{
    public function index(Request $request)
    {
        $query = Statements::join('users', 'users.id', '=', 'statements.id_user')
            ->leftJoin('banks', 'banks.id', '=', 'statements.id_bank')
            ->select(
                'statements.*',
                'statements.created_at as created_at',
                'statements.updated_at as updated_at',
                'users.id as id_user',
                'users.fullname as fullname',
                'statements.id as id',
                'banks.name as name'
            )
            ->orderBy('created_at', 'desc');


        if ($request->id_stm != null) {
            $query->where('statements.id', 'like', '%' . str_replace('GD', '', $request->id_stm) . '%');
        }

        if ($request->id_client != null) {
            $query->where('statements.id_user', 'like', '%' . str_replace('QKT', '', $request->id_client) . '%');
        }

        if ($request->id_order != null) {
            $id_order = $request->id_order;
            if (is_numeric($id_order)) {
                $query->where('statements.id_order', 'like', '%' . $id_order . '%');
            } else {
                $id_order = str_replace('Q', '', $id_order);
                $id_order = str_replace('D', '', $id_order);
                $id_order = str_replace('H', '', $id_order);
                if (!is_numeric($id_order)) {
                    explode('-', $id_order);
                    $id_order = $id_order[3];
                }
                $query->where('statements.id_order', 'like', '%' . $id_order . '%');
            }
        }

        if ($request->created_at != null) {
            $query->where('statements.created_at', '>=', formateudate($request->created_at));
        }

        if ($request->updated_at != null) {
            $query->where('statements.updated_at', '<=', formateudate($request->updated_at));
        }

        if ($request->status != null && $request->status != -1) {
            $query->where('statements.status', '=', $request->status);
        }

        if ($request->type != null && $request->type != -1) {
            $query->where('statements.type', '=', $request->type);
        }

        $list = $query->paginate(15);


        if (isset($request->export_excel) && is_numeric($request->export_excel)) {
            $tmp = [];
            foreach ($list as $r) {

                if ($r->is_sub == 1) {
                    $amount = '+' . formatVNDString($r->amount);
                } else {
                    $amount = '-' . formatVNDString($r->amount);
                }

                if ($r->method == 1) {
                    $method = 'Tiền mặt';
                }

                if ($r->method == 2) {
                    $method = $r->name;
                }

                if ($r->method == 3) {
                    $method = 'Tiền trong tk QKT';
                }

                if ($r->type == 0) {
                    $type = "Nạp tiền";
                }


                if ($r->type == 1) {
                    $type = "Tất toán";
                }


                if ($r->type == 2) {
                    $type = "Đặt cọc";
                }


                if ($r->type == 3) {
                    $type = "Thanh toán";
                }

                if ($r->type == 4) {
                    $type = "Huỷ và hoàn tiền";
                }

                if ($r->status == 0) {
                    $status = 'Đang chờ';
                }

                if ($r->status == 1) {
                    $status = 'Hoàn thành';
                }

                $row = array(
                    'GD' . $r->id,
                    'QKT' . $r->id_user,
                    strip_tags(htmlspecialchars_decode($r->content)),
                    $method,
                    $amount,
                    formatvidate($r->time),
                    $type,
                    $status
                );
                array_push($tmp, $row);
            }

            $excel = new StatementsExport($tmp);
            return Excel::download($excel, 'gd' . date('d-m-y H:i:s') . '.xlsx');
        }

        $data = array('list' => $list);
        return view('admin.statements.index', $data);
    }

    public function pending($id)
    {
        $obj = Statements::find($id);
        if ($obj != null && $obj->status != 0) {
            $user = User::find($obj->id_user);
            $user->amount = (($user->amount) - ($obj->amount));
            $user->save();

            $obj->status = 0;
            $obj->save();
        }
        return redirect('/admin/statements');
    }

    public function compelte($id)
    {
        $obj = Statements::find($id);
        if ($obj != null && $obj->status != 1) {
            $user = User::find($obj->id_user);
            $user->amount = (($obj->amount) + ($user->amount));
            $user->save();

            $obj->status = 1;
            $obj->save();
        }
        return redirect('/admin/statements');
    }
}