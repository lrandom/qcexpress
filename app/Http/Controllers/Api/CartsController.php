<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartsController extends Controller
{
    public function save(Request $request)
    {

        if (json_decode($request->getContent()) == null) {
            $quantity = $request->quantity;
            $name = $request->name;
            $note = $request->note;
            $rate = $request->rate; //exchange rate
            $price_in_yen = $request->price_in_yen;
            $link = $request->link;
            $id_owner = $request->id_owner;
            $id_stuff = $request->id_stuff;
            $picture = $request->picture;
            $owner_name = $request->owner_name;
            $props = $request->props;

            if (strpos($link, 'https://world.tmall') !== false) {
                $list = array();
                $index = -1;
                if (isset($_SESSION['cart']['tmall_shop'])) {
                    $list = $_SESSION['cart']['tmall_shop'];
                }
                $data['quantity'] = (int) $quantity;
                $data['name'] = $name;
                $data['note'] = $note;
                $data['rate'] = $rate;
                $data['price'] = $price_in_yen;
                $data['link'] = $link;
                $data['id_stuff'] = $id_stuff;
                $data['picture'] = $picture;
                $data['props'] = $props;
                for ($i = 0; $i < count($list); $i++) {
                    if ($list[$i]['id_stuff'] == $id_stuff && $list[$i]['props'] == $props) {
                        $index = $i;
                        break;
                    }
                }
                if ($index != -1) {
                    $list[$index]['quantity'] = $list[$index]['quantity'] + $quantity;
                } else {
                    array_push($list, $data);
                }
                $_SESSION['cart']['tmall_shop'] = $list;
            }

            if (strpos($link, 'https://detail.tmall') !== false) {
                $shops = array();
                $index = -1;
                if (isset($_SESSION['cart']["tmall_market"])) {
                    $shops = $_SESSION['cart']["tmall_market"];
                }


                $data['quantity'] = (int) $quantity;
                $data['name'] = $name;
                $data['note'] = $note;
                $data['rate'] = $rate;
                $data['price'] = $price_in_yen;
                $data['link'] = $link;
                $data['id_stuff'] = $id_stuff;
                $data['picture'] = $picture;
                $data['props'] = $props;

                for ($i = 0; $i < count($shops); $i++) {
                    if ($shops[$i]['id_owner'] == $id_owner) {
                        $index = $i;
                        break;
                    }
                }

                if ($index != -1) {
                    //ton tai shop trong mang
                    $list = $shops[$index]['stuffs'];
                    $index_stuff = -1;
                    for ($i = 0; $i < count($list); $i++) {
                        if ($list[$i]['id_stuff'] == $id_stuff && $list[$i]['props'] == $props) {
                            $index_stuff = $i;
                            break;
                        }
                    }

                    if ($index_stuff != -1) {
                        $list[$index_stuff]['quantity'] = $list[$index_stuff]['quantity'] + $quantity;
                    } else {
                        array_push($list, $data);
                    }

                    $shops[$index]['stuffs'] = $list;
                } else {
                    //khong ton tai shop trong mang
                    $tmp = array();
                    $tmp[] = $data;
                    array_push(
                        $shops,
                        array(
                            'id_owner' => $id_owner,
                            'stuffs' => $tmp,
                            'owner_name' => $owner_name
                        )
                    );
                }

                $_SESSION['cart']["tmall_market"] = $shops;
            }

            if (strpos($link, 'https://item.taobao') !== false) {
                $shops = array();
                $index = -1;
                if (isset($_SESSION['cart']["taobao_market"])) {
                    $shops = $_SESSION['cart']["taobao_market"];
                }


                $data['quantity'] = (int) $quantity;
                $data['name'] = $name;
                $data['note'] = $note;
                $data['rate'] = $rate;
                $data['price'] = $price_in_yen;
                $data['link'] = $link;
                $data['id_stuff'] = $id_stuff;
                $data['picture'] = $picture;
                $data['props'] = $props;

                for ($i = 0; $i < count($shops); $i++) {
                    if ($shops[$i]['id_owner'] == $id_owner) {
                        $index = $i;
                        break;
                    }
                }

                if ($index != -1) {
                    //ton tai shop trong mang
                    $list = $shops[$index]['stuffs'];
                    $index_stuff = -1;
                    for ($i = 0; $i < count($list); $i++) {
                        if ($list[$i]['id_stuff'] == $id_stuff && $list[$i]['props'] == $props) {
                            $index_stuff = $i;
                            break;
                        }
                    }

                    if ($index_stuff != -1) {
                        //ton tai sp trong mang
                        //so sanh props
                        $list[$index_stuff]['quantity'] = $list[$index_stuff]['quantity'] + $quantity;
                    } else {
                        //ko ton tai sp trong mang
                        array_push($list, $data);
                    }

                    $shops[$index]['stuffs'] = $list;
                } else {
                    //khong ton tai shop trong mang
                    $tmp = array();
                    $tmp[] = $data;
                    array_push(
                        $shops,
                        array(
                            'id_owner' => $id_owner,
                            'stuffs' => $tmp,
                            'owner_name' => $owner_name
                        )
                    );
                }

                $_SESSION['cart']["taobao_market"] = $shops;
            }
        } else {
            $items = json_decode($request->getContent());
            foreach ($items as $item) {
                $quantity = $item->quantity;
                $name = $item->name;
                $note = $item->note;
                $rate = $item->rate; //exchange rate
                $price_in_yen = $item->price_in_yen;
                $link = $item->link;
                $id_owner = $item->id_owner;
                $id_stuff = $item->id_stuff;
                $picture = $item->picture;
                $owner_name = $item->owner_name;
                $props = json_decode(json_encode($item->props), true);
                $propsFix = [];
                foreach ($props as $r) {
                    array_push($propsFix, array('name' => $r['name'], 'val' => $r['value']));
                }
                if (strpos($link, 'https://detail.1688') !== false) {
                    $shops = array();
                    $index = -1;
                    if (isset($_SESSION['cart']["1688_market"])) {
                        $shops = $_SESSION['cart']["1688_market"];
                    }

                    $data['quantity'] = (int) $quantity;
                    $data['name'] = $name;
                    $data['note'] = $note;
                    $data['rate'] = $rate;
                    $data['price'] = $price_in_yen;
                    $data['link'] = $link;
                    $data['id_stuff'] = $id_stuff;
                    $data['picture'] = $picture;
                    $data['props'] = $propsFix;

                    for ($i = 0; $i < count($shops); $i++) {
                        if ($shops[$i]['id_owner'] == $id_owner) {
                            $index = $i;
                            break;
                        }
                    }

                    if ($index != -1) {
                        //ton tai shop trong mang
                        $list = $shops[$index]['stuffs'];
                        $index_stuff = -1;
                        for ($i = 0; $i < count($list); $i++) {
                            if ($list[$i]['id_stuff'] == $id_stuff && $list[$i]['props'] == $props) {
                                $index_stuff = $i;
                                break;
                            }
                        }

                        if ($index_stuff != -1) {
                            $list[$index_stuff]['quantity'] = $list[$index_stuff]['quantity'] + $quantity;
                        } else {
                            array_push($list, $data);
                        }

                        $shops[$index]['stuffs'] = $list;
                    } else {
                        //khong ton tai shop trong mang
                        $tmp = array();
                        $tmp[] = $data;
                        array_push(
                            $shops,
                            array(
                                'id_owner' => $id_owner,
                                'stuffs' => $tmp,
                                'owner_name' => $owner_name
                            )
                        );
                    }

                    $_SESSION['cart']["1688_market"] = $shops;
                }
            }
        }

        return response()->json(array('success' => 1), 200);
    }



    public function remove(Request $request)
    { }

    public function change_quantity(Request $request)
    { }


    public function change_note(Request $request)
    { }
}