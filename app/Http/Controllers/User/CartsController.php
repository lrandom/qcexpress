<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Order;
use App\Stuff;
use App\User;
use App\CommentsOrders;
use App\Statements;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Uuid;

class CartsController extends Controller
{
    public function __construct()
    {
        //unset($_SESSION['cart']);
    }

    public function cart(Request $request)
    {
        //dd($_SESSION['cart']);
        $cart = null;
        if (isset($_SESSION['cart'])) {
            $cart = $_SESSION['cart'];
        }
        return view('users.cart', array('cart' => $cart));
    }

    public function update(Request $request)
    {
        if (isset($_SESSION['cart'])) {
            $shop = $request->query('shop');
            $cart = $_SESSION['cart'];
            $type = $request->query('owner_type');
            $quantity = $request->query('quantity');
            $index = $request->query('index');

            switch ($type) {
                case 1:
                    //TMALL 
                    if ($shop == -1) {
                        //TMALL SHOP WORLD
                        if (array_key_exists('tmall_shop', $cart)) {
                            $cart = $cart['tmall_shop'];
                            $cart[$index - 1]['quantity'] = $quantity;
                            $_SESSION['cart']['tmall_shop'] = $cart;
                        }
                    } else {
                        //TMALL SHOP LOCAL
                        if (isset($cart['tmall_market'])) {
                            $cart = $cart['tmall_market'];
                            for ($i = 0; $i < count($cart); $i++) {
                                if ($cart[$i]['id_owner'] == $shop) {
                                    $stuffs = $cart[$i]['stuffs'];
                                    $stuffs[$index - 1]['quantity'] = $quantity;
                                    $cart[$i]['stuffs'] = $stuffs;
                                    $_SESSION['cart']['tmall_market'] = $cart;
                                    break;
                                }
                            }
                        }
                    }
                    break;

                case 2:
                    //1688 
                    if (isset($cart['1688_market'])) {
                        $cart = $cart['1688_market'];
                        for ($i = 0; $i < count($cart); $i++) {
                            if ($cart[$i]['id_owner'] == $shop) {
                                $stuffs = $cart[$i]['stuffs'];
                                $stuffs[$index - 1]['quantity'] = $quantity;
                                $cart[$i]['stuffs'] = $stuffs;
                                $_SESSION['cart']['1688_market'] = $cart;
                                break;
                            }
                        }
                    }
                    break;

                case 3:
                    //taobao
                    if (isset($cart['taobao_market'])) {
                        $cart = $cart['taobao_market'];
                        for ($i = 0; $i < count($cart); $i++) {
                            if ($cart[$i]['id_owner'] == $shop) {
                                $stuffs = $cart[$i]['stuffs'];
                                //dd($stuffs);
                                $stuffs[$index - 1]['quantity'] = $quantity;
                                $cart[$i]['stuffs'] = $stuffs;
                                $_SESSION['cart']['taobao_market'] = $cart;
                                break;
                            }
                        }
                    }
                    break;
            }
        } //end if
        echo json_encode(array('success' => 1));
    }

    public function delete(Request $request)
    {
        if (isset($_SESSION['cart'])) {
            $shop = $request->query('shop');
            $index = $request->query('index');
            $cart = $_SESSION['cart'];
            $type = $request->query('owner_type');
            //dd($cart);
            switch ($type) {
                case 1:
                    //TMALL 
                    if ($shop == -1) {
                        //TMALL SHOP WORLD
                        if (array_key_exists('tmall_shop', $cart)) {
                            $cart = $cart['tmall_shop'];
                            array_splice($cart, $index - 1, 1);
                            $_SESSION['cart']['tmall_shop'] = $cart;
                        }
                    } else {
                        if (isset($cart['tmall_market'])) {
                            $cart = $cart['tmall_market'];
                            for ($i = 0; $i < count($cart); $i++) {
                                if ($cart[$i]['id_owner'] == $shop) {
                                    $stuffs = $cart[$i]['stuffs'];
                                    array_splice($stuffs, $index - 1, 1);
                                    if (count($stuffs) > 0) {
                                        $cart[$i]['stuffs'] = $stuffs;
                                    } else {
                                        array_splice($cart, $i, 1);
                                    }
                                    $_SESSION['cart']['tmall_market'] = $cart;
                                    break;
                                }
                            }
                        }
                    }
                    break;

                case 2:
                    if (isset($cart['1688_market'])) {
                        $cart = $cart['1688_market'];
                        for ($i = 0; $i < count($cart); $i++) {
                            if ($cart[$i]['id_owner'] == $shop) {
                                $stuffs = $cart[$i]['stuffs'];
                                array_splice($stuffs, $index - 1, 1);
                                if (count($stuffs) > 0) {
                                    $cart[$i]['stuffs'] = $stuffs;
                                } else {
                                    array_splice($cart, $i, 1);
                                }
                                $_SESSION['cart']['1688_market'] = $cart;
                                break;
                            }
                        }
                    }

                    break;

                case 3:
                    if (isset($cart['taobao_market'])) {
                        $cart = $cart['taobao_market'];
                        for ($i = 0; $i < count($cart); $i++) {
                            if ($cart[$i]['id_owner'] == $shop) {
                                $stuffs = $cart[$i]['stuffs'];
                                array_splice($stuffs, $index - 1, 1);
                                if (count($stuffs) > 0) {
                                    $cart[$i]['stuffs'] = $stuffs;
                                } else {
                                    array_splice($cart, $i, 1);
                                }
                                $_SESSION['cart']['taobao_market'] = $cart;
                                break;
                            }
                        }
                    }
                    break;
            }
        } //end if
        return redirect(URL::to('users/cart'));
    }

    public function empty(Request $request)
    {
        if (isset($_SESSION['cart'])) {
            unset($_SESSION['cart']);
        }
        return redirect(URL::to('users/cart'));
    }

    public function make_order(Request $request)
    {
        $data['owner_type'] = $request->owner_type;
        $data['id_owner'] = $request->id_owner;
        $data['owner_name'] = $request->owner_name;
        $data['index_cart'] = $request->index_cart;
        $data['total'] = $request->total;
        $data['item_orders'] = null;

        if ($data['owner_type'] == 1) {
            if ($data['id_owner'] != -1) {
                $data['item_orders'] = $_SESSION['cart']['tmall_market'][$request->index_cart]['stuffs'];
            } else {
                $data['item_orders'] = $_SESSION['cart']['tmall_shop'];
            }
        }

        if ($data['owner_type'] == 2) {
            $data['item_orders'] = $_SESSION['cart']['1688_market'][$request->index_cart]['stuffs'];
        }

        if ($data['owner_type'] == 3) {
            $data['item_orders'] = $_SESSION['cart']['taobao_market'][$request->index_cart]['stuffs'];
        }

        $data['rate'] = $request->rate;
        $data['note'] = $request->note;

        return view('users.make-order', $data);
    }


    public function add_order(Request $request)
    {
        if (isset($_SESSION['cart'])) {
            $obj = new Order();
            $obj->id_user = Auth::user()->id;
            $obj->deposit = $request->deposit;
            $obj->sites = $request->owner_type;
            $obj->id_owner = $request->id_owner;
            $obj->owner_name = $request->owner_name;
            $obj->transport_cn = 0;
            $obj->note = $request->note;
            $obj->exchange_rate = $request->rate;
            $obj->lading = null;
            $obj->weight = null;
            $obj->day_start = date("Y-m-d h:i:s");
            $obj->day_finish = null;
            $obj->picture = [];
            $obj->status = 0;
            $obj->fee_service = Auth::user()->buy_fee;
            $obj->save();

            $id_order = $obj->id;
            $owner_type = $request->owner_type;
            $stuffs = null;

            if ($owner_type == 1) {
                if ($request->id_owner != -1) {
                    $stuffs = $_SESSION['cart']['tmall_market'][$request->index_cart]['stuffs'];
                } else {
                    $stuffs = $_SESSION['cart']['tmall_shop'];
                }
            }

            if ($owner_type == 2) {
                $stuffs = $_SESSION['cart']['1688_market'][$request->index_cart]['stuffs'];
            }
            if ($owner_type == 3) {
                $stuffs = $_SESSION['cart']['taobao_market'][$request->index_cart]['stuffs'];
            }

            //dd($stuffs);

            for ($i = 0; $i < count($stuffs); $i++) {
                $stuff = new Stuff();
                $stuff->id_order = $id_order;
                $stuff->id_stuff = $stuffs[$i]['id_stuff'];
                $stuff->name = $stuffs[$i]['name'];
                $stuff->link = $stuffs[$i]['link'];
                $stuff->quantity = $stuffs[$i]['quantity'];
                $stuff->price = $stuffs[$i]['price'];
                $stuff->note = $stuffs[$i]['note'];
                $stuff->id = Uuid::generate()->string;
                $stuff->picture = $stuffs[$i]['picture'];
                if ($stuffs[$i]['props'] != null) {
                    $stuff->props = json_encode($stuffs[$i]['props']);
                }
                $stuff->save();
            }

            $comment = new CommentsOrders();
            $comment->content = htmlspecialchars('<span class="text-red">Tạo đơn hàng </span><a>QC' . $id_order . '</a>');
            $comment->id_order = $id_order;
            $comment->id_user = Auth::user()->id;
            $comment->save();

            if ($request->deposit > 0) {
                //tru tien cua user sau khi dat hang
                $user = User::find(Auth::user()->id);
                $user->amount = $user->amount - $request->deposit;
                $user->save();

                $comment = new CommentsOrders();
                $comment->content = htmlspecialchars('<span class="text-red">Đặt cọc đơn hàng </span><a>QC' . $id_order . '</a>:&nbsp;<strong><span class="text-green">' . formatVNDString($request->deposit) . '</span></strong>');
                $comment->id_order = $id_order;
                $comment->id_user = Auth::user()->id;
                $comment->save();


                $stm = new Statements();
                $stm->content = htmlspecialchars('<span class="text-red">Đặt cọc đơn hàng </span><a>QC' . $id_order . '</a>');
                $stm->created_at =  now()->timestamp;
                $stm->type = 2; //đat coc
                $stm->is_sub = 1;
                $stm->amount = $request->deposit;
                $stm->method = 3; //tien quy doi
                $stm->id_user =  Auth::user()->id;
                $stm->id_order = $id_order;
                $stm->status = 1;
                $stm->save();
            }
            return redirect('/users/success');
        } else {
            //thông báo giỏ hàng trống
        }
    }

    public function success()
    {
        return view('users.success');
    }
}