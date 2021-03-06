@extends('layouts.user')
@section('header',__('main.address'))
@section('small_header','')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('public/css/cart.css?x='.time())}}"/>


<style>
    #timeline-wrap{
        display: flex !important;
        margin-left: 0 !important;
        margin-right: 0 !important;
        margin-bottom: 30px !important;
    }
    #timeline{
        position: absolute !important;
        display: none;
    }
    marker:hover, .marker.active {
        background: #dd4b39;
        /* border: 2px solid #dd4b39; */
        color: #fff;
    }
.marker-wrapper{
    left: unset !important;
    flex: 1;
    position: relative !important;
    padding: 10px;
}
.marker {
    /* background: #fff; */
    background: transparent !important;
    color: #dd4b39;
    height: 50px;
    width: 100% !important;
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    border: none !important;
    border-radius: 0 !important;
    position: relative;
    overflow: hidden;
    padding: 0px 60px;
}
.marker i{
    background: #fff;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}
.marker:hover::after, .marker:hover::before, .marker:hover i,
.marker.active::after, .marker.active::before, .marker.active i{
    background: #dd4a39;
}

.marker::after{
    content: '';
    background: #fff;
    width: 100px;
    height: 100px;
    position: absolute;
    right: 20px;
    top: 0px;
    transform: rotate(45deg);
}
.marker::before{
    content: '';
    background: #fff;
    width: 100px;
    height: 100px;
    position: absolute;
    left: 20px;
    bottom: 0px;
    transform: rotate(45deg);
}
.marker-two{
    margin-right: -50px;
    margin-left: -50px;
}


.marker-wrapper:first-child .marker::before{
    left: -10px;
    bottom: -25px;
}
.marker-wrapper:last-child .marker::after{
    right: -10px;
    top: -25px;
}
</style>

<div class="choose-address">

    <div id="timeline-wrap">                
        <!-- This is the individual marker-->
        <div class="marker-wrapper">
            <div class="marker">
                <i class="fa fa-shopping-cart"></i>
            </div>
            <span class="marker-title">{{__('main.cart')}}</span>
        </div>

        <div class="marker-wrapper marker-two">
            <div class="marker active">
                <i class="fa fa-map-pin"></i>
            </div>
            <span class="marker-title">Chọn địa chỉ</span>
        </div>

        <div class="marker-wrapper marker-three">
            <div class="marker">
                <i class="fa fa-list"></i>
            </div>
            <span class="marker-title">{{__('main.singles')}}</span>
        </div>
    </div>





<form role="form" action="{{URL::to('users/cart/add_order')}}" method="post">
  @csrf
  
  <input type="hidden" name="order_lst" value="{{json_encode($item_orders)}}">

  {{-- <input type="hidden" value="{{$index_cart}}" name="index_cart"/> --}}
  {{-- <input type="hidden" value="{{$owner_type}}" name="owner_type"/> --}}
  {{-- <input type="hidden" value="{{$note}}" name="note"/> --}}
  {{-- <input type="hidden" value="{{$id_owner}}" name="id_owner"/> --}}
  {{-- <input type="hidden" value="{{$owner_name}}" name="owner_name"/> --}}
  {{-- <input type="hidden" value="{{$rate}}" name="rate"/> --}}
  {{-- <input type="hidden" value="{{$total}}" name="total"/> --}}

  <div class="row">

    <div class="col-sm-12 col-xs-12">
      <div class="box box-primary">
        <div class="box-body">
            
            {{-- <p>Nguời bán: <strong>{{$owner_name}}</strong></p> --}}

            <div class="box-body">
              <table>
                <thead>
                  <th style="width: 100px;">Ảnh</th>
                  <th style="width: 40%;">Shop</th>
                  <th style="text-align: right;">Số lượng</th>
                  <th style="text-align: right;">Tiền hàng</th>
                </thead>
                <tbody>
                    <?php
                      $total = 0;
                      foreach($item_orders as $od){
                        foreach ($od['item'] as $item){
                          $temp_price = $item['price']*$item['rate']*$item['quantity'];
                          $total = $total + $temp_price;
                        }
                      } 
                    ?>
                    @foreach ($item_orders as $od)
                      @foreach ($od['item'] as $item)
                        <tr>
                          <td><img style="height: 70px; width: 70px;margin-top:10px" src="{{$item['picture']}}" alt=""></td>
                          <td>{{$item['name']}}</td>
                          <td style="text-align: right;">{{$item['quantity']}}</td>
                          <td style="text-align: right;">{{formatVND($item['price']*$item['rate']*$item['quantity'])}}</td>
                        </tr>
                      @endforeach
                    @endforeach

                </tbody>
              </table>
            </div>

            <hr>

            <div class="" style="display: flex;">
              <div class="" style="flex: 1">
                  <br>
                  @php
                      $buy_fee = Auth::user()->buy_fee;
                  @endphp
                  {{-- <input type="hidden" value="{{($total/100)*(Auth::user()->per_deposit)}}" name="deposit"/> --}}
                  <p class="text-right"><b>Tổng: <span class="text-red">{{formatVND($total)}}</span></b></p>
                  <p class="text-right"><b>Phí mua hàng: <span class="text-red">{{formatVND(($total/100)*$buy_fee)}}</span></b></p>
                  <p class="text-right"><b>Đặt cọc({{Auth::user()->per_deposit}}%): <span class="text-red"> {{formatVND(($total/100)*(Auth::user()->per_deposit))}}</span></b></p>
                  <p class="text-right"><b>Tạm tính: <span class="text-red" style="font-size: 20px;">{{formatVND($total + (($total/100)*$buy_fee))}}</span></b></p>
                  <p class="text-right"><b>Số dư hiện tại:  <span class="text-green" style="font-size: 18px;">{{formatVND(Auth::user()->amount)}}</span></b></p>

                  <br>

                  <div class="text-right">
                    <button type="submit" class="btn btn-primary">Lên đơn</button>
                  </div>
              </div>
            </div>

        </div>
      </div>
    </div>

  </div>

</form>


@endsection