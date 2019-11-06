<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\ShipAddress;
use App\Provinces;
use App\Cities;

class UsersController extends Controller{

    public function get_cities(Request $request){
        $cities = Cities::where('cities.matp', '=', $request->id)->get();
        return $cities;
    }

    public function get_address(Request $request){
        $obj_address = ShipAddress::where('ship_address.id', '=', $request->id)->first();
        $obj_provinces = Provinces::get();
        $obj_cities = Cities::where('cities.matp', '=', $obj_address->province_id)->get();
        return ['obj_address' => $obj_address, 'obj_provinces' => $obj_provinces, 'obj_cities' => $obj_cities];
    }

}