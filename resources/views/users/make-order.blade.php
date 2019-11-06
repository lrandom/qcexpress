@extends('layouts.user')
@section('header',__('main.address'))
@section('small_header','')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('css/cart.css?x='.time())}}"/>
<div class="choose-address">

<div id="timeline-wrap">
    <div id="timeline"></div>
    <!-- This is the individual marker-->
    <div class="marker-wrapper">
        <div class="marker active">
            <i class="fa fa-shopping-cart"></i>
        </div>
      <span class="marker-title">{{__('main.cart')}}</span>
    </div>

    <div class="marker-wrapper marker-two">
            <div class="marker active">
                <i class="fa fa-map-pin"></i>
            </div>
          <span class="marker-title">{{__('main.make_order')}}</span>
    </div>

    <div class="marker-wrapper marker-three">
            <div class="marker">
                <i class="fa fa-shopping-cart"></i>
            </div>
          <span class="marker-title">{{__('main.singles')}}</span>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-xs-12">
        <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{URL::to('users/cart/add_order')}}" method="post">
                @csrf
                <input type="hidden" value="{{$index_cart}}" name="index_cart"/>
                <input type="hidden" value="{{$owner_type}}" name="owner_type"/>
                <input type="hidden" value="{{$note}}" name="note"/>
                <input type="hidden" value="{{$id_owner}}" name="id_owner"/>
                <input type="hidden" value="{{$owner_name}}" name="owner_name"/>
                <input type="hidden" value="{{$rate}}" name="rate"/>
                <input type="hidden" value="{{$total}}" name="total"/>
                <div class="box-body">
               <p>
                Nguời bán: <strong>{{$owner_name}}</strong>
                </p>

                <div class="box-body">
                  <table>
                    <thead>
                      <th style="width: 100px;">Ảnh</th>
                      <th style="width: 40%;">Shop</th>
                      <th style="text-align: right;">Số lượng</th>
                      <th style="text-align: right;">Tiền hàng</th>
                    </thead>
                    <tbody>
               
                        @foreach ($item_orders as $item)
                          <tr >
                            <td><img style="height: 70px; width: 70px;margin-top:10px" src="{{$item['picture']}}" alt=""></td>
                            <td>{{$item['name']}}</td>
                            <td style="text-align: right;">{{$item['quantity']}}</td>
                            <td style="text-align: right;">{{formatVND($item['price']*$item['rate']*$item['quantity'])}}</td>
                          </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>

                <hr>
                  <input type="hidden" value="{{($total/100)*(Auth::user()->per_deposit)}}" name="deposit"/>
                  <p class="text-right"><b>Tổng: <span class="text-red">{{formatVND($total)}}</span></b></p>
                  <p class="text-right"><b>Đặt cọc({{Auth::user()->per_deposit}}%): <span class="text-red"> {{formatVND(($total/100)*(Auth::user()->per_deposit))}}</span></b></p>
                  <p class="text-right"><b>Số dư hiện tại:  <span class="text-red">{{formatVND(Auth::user()->amount)}}</span></b></p>
                </div>
                <!-- /.box-body -->
                
                <div class="box-footer text-right">
                  <button type="submit" class="btn btn-primary">Đặt hàng</button>
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>






@endsection