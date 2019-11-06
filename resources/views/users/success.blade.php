@extends('layouts.user')
@section('header',__('main.order'))
@section('small_header','')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('css/cart.css?x='.time())}}"/>



<div class="choose-address">

    <div style="display: flex; align-items: center; justify-content: center; min-height: 70vh;">
        <div class="text-center">
            <img style="height: 150px; width: 150px;" src="{{asset('pictures/init/successful.png')}}" alt="">
            <br><br>
            <h1 style="font-size: 30px">Đặt hàng thành công</h1>
            <br><br><br>
            <a class="btn btn-success" href="{{asset('users/cart')}}">quay về giỏ hàng</a>
        </div>
    </div>

</div>


@endsection