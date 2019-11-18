<?php

namespace App\Http\Controllers\User;

use App\Banks;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Statements;
use App\Exports\StatementsExport;
use Maatwebsite\Excel\Facades\Excel;
use Auth;

class StatementsControllers extends Controller
{
    public function deposit(Request $request)
    {
        if ($request->isMethod('get')) {
            $banks = DB::table('banks')->where('is_active', 1)->get();
            return view('users.deposit', ['banks' => $banks]);
        }

        if ($request->isMethod('post')) {
            $validate = [
                'amount' => 'required',
                'transfer_method' => 'required',
                'transaction_time' => 'required',
                'content' => 'required'
            ];
            if ($request->transfer_method == 2) {
                $validate['bank'] = 'required';
            }

            $request->validate($validate);

            $obj = new Statements();
            $obj->content = $request->content;
            $obj->entry_number = $request->entry;
            $obj->time = date("Y-m-d H:i:s", strtotime($request->transaction_time));
            $obj->type = 0;
            $obj->is_sub = 0;
            $obj->amount = $request->amount;
            $obj->id_bank  = $request->bank;
            $obj->method = $request->transfer_method;
            $obj->id_user =  Auth::user()->id;
            $obj->save();

            if ($request->hasFile('photo')) {
                $file = $request->photo;
                $newFileName =  time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('pictures/statements'), $newFileName);
                $obj->photo = 'pictures/statements/' . $newFileName;
                $obj->save();
            }

            return redirect('users/finance/deposit')->with('status', 'Khoản nạp của bạn đã đuợc thêm vào, vui lòng chờ chúng tôi kiểm tra!!!');
        }
    }

    public function index(Request $request)
    {
        $query = DB::table('statements')
            ->select('*', 'statements.id as stid')
            ->leftJoin('banks', 'banks.id', '=', 'statements.id_bank')
            ->orderBy('statements.id', 'desc')
            ->where('id_user', Auth::user()->id);


        if ($request->id_stm != null) {
            $query->where('statements.id', 'like', '%' . str_replace('GD', '', $request->id_stm) . '%');
        }

        if ($request->id_client != null) {
            $query->where('statements.id_user', 'like', '%' .  $request->id_client . '%');
        }

        if ($request->id_order != null) {
            $id_order = $request->id_order;
            if (is_numeric($id_order)) {
                $query->where('statements.id_order', 'like', '%' . $id_order . '%');
            } else {
                $id_order = str_replace('Q', '', $id_order);
                $id_order = str_replace('C', '', $id_order);
                if (!is_numeric($id_order)) {
                    explode('-', $id_order);
                    if (isset($id_order[2])) {
                        $id_order = $id_order[2];
                    }
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

        $list =  $query->paginate(15);
        if (isset($request->export_excel) && is_numeric($request->export_excel)) {
            $tmp = [];
            foreach ($list as $r) {

                if ($r->is_sub == 1) {
                    $amount = '-' . formatVNDString($r->amount);
                } else {
                    $amount = '+' . formatVNDString($r->amount);
                }

                if ($r->method == 1) {
                    $method = 'Tiền mặt';
                }

                if ($r->method == 2) {
                    $method = $r->name;
                }

                if ($r->method == 3) {
                    $method = 'Tiền trong tk QC Express';
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
                    'GD' . $r->stid,
                    $r->id_user,
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


        return view('users.statements', ['list' => $list]);
    }
}