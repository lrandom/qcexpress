<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Order;
use App\Stuff;
use App\User;
use App\CommentsOrders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use App\Statements;
use Uuid;

class CartsController extends Controller
{
    public function __construct()
    {
        //unset($_SESSION['cart']);
    }

    public function cart(Request $request)
    {
        //unset($_SESSION['cart']);
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

    private function deleteItem($shop, $index, $type)
    {
        if (isset($_SESSION['cart'])) {
            $cart = $_SESSION['cart'];
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
    }

    public function delete(Request $request)
    {
        $shop = $request->query('shop');
        $index = $request->query('index');
        $type = $request->query('owner_type');
        $this->deleteItem($shop, $index, $type);
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
        // dd($request->owner_type);

        $data['item_orders'] = [];
        ///$temp_cart = $_SESSION['cart'];

        foreach ($request->owner_type as $key => $owner_type) {
            if ($key == 1) {
                foreach ($owner_type as $lab => $id_owner) {
                    if ($lab != -1) {
                        $temp['item'] = [];
                        $temp['owner_type'] = $key;
                        $temp['id_owner'] = $lab;
                        foreach ($id_owner as $row => $ind_cart) {
                            $temp['owner_name'] = $ind_cart['owner_name'];
                            $temp['rate'] = $ind_cart['rate'];
                            // $temp['od_note'] = $ind_cart['note'];
                            foreach ($ind_cart['ind_item'] as $ind_item) {
                                array_push($temp['item'], $_SESSION['cart']['tmall_market'][$row]['stuffs'][$ind_item]);

                                // $temp_cart = $temp_cart['tmall_market'];
                                // array_splice($temp_cart, $ind_item, 1);
                                // $_SESSION['cart']['tmall_market'] = $temp_cart;
                            }
                        }
                        array_push($data['item_orders'], $temp);
                    } else {
                        $temp['item'] = [];
                        $temp['owner_type'] = $key;
                        $temp['id_owner'] = $lab;
                        foreach ($id_owner as $row => $ind_cart) {
                            $temp['owner_name'] = $ind_cart['owner_name'];
                            $temp['rate'] = $ind_cart['rate'];
                            // $temp['od_note'] = $ind_cart['note'];
                            array_push($temp['item'], $_SESSION['cart']['tmall_shop'][$row]);

                            // $temp_cart = $temp_cart['tmall_shop'];
                            // array_splice($temp_cart, $row, 1);
                            // $_SESSION['cart']['tmall_shop'] = $temp_cart;
                        }
                        array_push($data['item_orders'], $temp);
                    }
                }
            }

            if ($key == 2) {
                foreach ($owner_type as $lab => $id_owner) {
                    $temp['item'] = [];
                    $temp['owner_type'] = $key;
                    $temp['id_owner'] = $lab;
                    foreach ($id_owner as $row => $ind_cart) {
                        $temp['owner_name'] = $ind_cart['owner_name'];
                        $temp['rate'] = $ind_cart['rate'];
                        // $temp['od_note'] = $ind_cart['note'];
                        foreach ($ind_cart['ind_item'] as $ind_item) {
                            array_push($temp['item'], $_SESSION['cart']['1688_market'][$row]['stuffs'][$ind_item]);

                            // $temp_cart = $temp_cart['1688_market'];
                            // array_splice($temp_cart, $ind_item, 1);
                            // $_SESSION['cart']['1688_market'] = $temp_cart;
                        }
                    }
                    array_push($data['item_orders'], $temp);
                }
            }

            if ($key == 3) {
                foreach ($owner_type as $lab => $id_owner) {
                    $temp['item'] = [];
                    $temp['owner_type'] = $key;
                    $temp['id_owner'] = $lab;
                    foreach ($id_owner as $row => $ind_cart) {
                        $temp['owner_name'] = $ind_cart['owner_name'];
                        $temp['rate'] = $ind_cart['rate'];
                        // $temp['od_note'] = $ind_cart['note'];
                        foreach ($ind_cart['ind_item'] as $ind_item) {
                            array_push($temp['item'], $_SESSION['cart']['taobao_market'][$row]['stuffs'][$ind_item]);

                            // $temp_cart = $temp_cart['taobao_market'];
                            // array_splice($temp_cart, $ind_item, 1);
                            // $_SESSION['cart']['taobao_market'] = $temp_cart;
                        }
                    }
                    array_push($data['item_orders'], $temp);
                }
            }
        }

        // dd($data['item_orders']);

        return view('users.make-order', $data);
    }

    public function add_order(Request $request)
    {
        $order_lst = json_decode($request->order_lst, true);
        //dd($order_lst);

        if (isset($_SESSION['cart'])) {
            try {
                $index = -1;

                $cart = $_SESSION['cart'];

                //var_dump($order_lst);
                //dd($cart);
                foreach ($order_lst as $key => $value) {
                    $owner_type = $value['owner_type'];

                    $obj = new Order();
                    $obj->id_user = Auth::user()->id;
                    $obj->sites = $owner_type;
                    $obj->id_owner = $value['id_owner'];
                    $obj->owner_name = $value['owner_name'];
                    $obj->transport_cn = 0;
                    // $obj->note = $value['od_note'];
                    $obj->exchange_rate = $value['rate'];

                    $obj->lading = null;
                    $obj->weight = null;
                    $obj->day_start = date("Y-m-d h:i:s");
                    $obj->day_finish = null;
                    $obj->picture = [];
                    //$obj->is_paid = 0;
                    $obj->fee_service = Auth::user()->buy_fee;
                    $obj->status = 0;
                    $obj->save();

                    $id_order = $obj->id;
                    $temp_deposit = 0;

                    $key = [];
                    foreach ($value['item'] as $lab => $item) {
                        $stuff = new Stuff();
                        $stuff->id_order = $id_order;
                        $stuff->id_stuff = $item['id_stuff'];
                        $stuff->name = $item['name'];
                        $stuff->link = $item['link'];
                        $stuff->quantity = $item['quantity'];
                        $stuff->price = $item['price'];
                        $stuff->note = $item['note'];
                        $stuff->id = Uuid::generate()->string;
                        $stuff->picture = $item['picture'];

                        $temp_deposit = $temp_deposit * 1 + $item['price'] * $value['rate'] * $item['quantity'];

                        if (isset($item['props']) && isset($item['props']) != null) {
                            $stuff->props = json_encode($item['props']);
                        }
                        $stuff->save();
                    }


                    $obj->deposit = ($temp_deposit / 100) * (Auth::user()->per_deposit);
                    $obj->save();

                    $comment = new CommentsOrders();
                    $comment->content = htmlspecialchars('<span class="text-red">Tạo đơn hàng </span>&nbsp;<a>QC' . $id_order  . '</a>');
                    $comment->id_order = $id_order;
                    $comment->id_user = Auth::user()->id;
                    $comment->save();
                }

                if (count($order_lst) > 1) {
                    unset($_SESSION['cart']);
                } else {
                    $key_shop = '';
                    $owner_type = $order_lst[0]['owner_type'];
                    $id_shop = $order_lst[0]['id_owner'];
                    if ($owner_type == 1) {
                        if ($value['id_owner'] == -1) {
                            $key_shop = 'tmall_shop';
                        } else {
                            $key_shop = 'tmall_market';
                        }
                    }

                    if ($owner_type == 2) {
                        $key_shop = '1688_market';
                    }

                    if ($owner_type == 3) {
                        $key_shop = 'taobao_market';
                    }

                    //dd($cart);
                    if ($key_shop == 'tmall_shop') {
                        unset($cart['tmall_shop']);
                    } else {
                        //dd($cart[$key_shop]);
                        for ($i = 0; $i < count($cart[$key_shop]); $i++) {
                            if ($cart[$key_shop][$i]['id_owner'] == $id_shop) {
                                //array_splice($cart[$key_shop][$i], 1);
                                //echo $i;
                                //exit();
                                unset($cart[$key_shop][$i]);
                                $cart[$key_shop] = array_values(
                                    $cart[$key_shop]
                                );
                                break;
                            };
                        }
                    }
                    $_SESSION['cart'] = $cart;
                    //dd($_SESSION['cart']);
                }
                return redirect('/users/success')->with('id', formatorderid($obj->created_at, $id_order));
            } catch (\Throwable $th) {
                echo $th->getMessage();
                exit();
                abort(500, "Không thể đặt hàng");
            }
        } else {
            //thông báo giỏ hàng trống
        }
    }

    public function success()
    {
        return view('users.success');
    }
}