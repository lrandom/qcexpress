
@php
$title = __('main.all_bill');
$check_btn = 1;
if(strpos(url()->full(),'admin/transport/bill_transport')!=false){
    if(strpos(url()->full(),'admin/transport/bill_transport/8')!=false){
        $title = 'Đã giao hàng';
        $check_btn = 2;
    }
    if(strpos(url()->current(),'admin/transport/bill_transport/9')!=false){
        $title = 'Đã nhận hàng';
        $check_btn = 3;
    }
}
@endphp

@extends('layouts.admin')
@section('header',__('main.bill_transport'))
@section('small_header', $title)
@section('content')

<?php
        use App\CommentsOrders as CommentsOrders;
        $total_quantity = 0;
        $total_price    = 0;
        $index= 0;
        ?>

<script>
        var id_user = '{{Auth::user()->id}}';
    </script>
    
    <script src="{{ asset('js/order.js?x=') }}{{time()}}"></script>
    
    <div class="box-body table-responsive">    

            <a class="btn btn-primary <?php if($check_btn == 1){ echo 'btn-success'; } ?>" href="{{asset('admin/transport/bill_transport')}}">Đang chờ giao hàng</a>
            <a class="btn btn-primary <?php if($check_btn == 2){ echo 'btn-success'; } ?>" href="{{asset('admin/transport/bill_transport/8')}}">Đã giao hàng</a>
            <a class="btn btn-primary <?php if($check_btn == 3){ echo 'btn-success'; } ?>" href="{{asset('admin/transport/bill_transport/9')}}">Đã nhận hàng</a>


        @foreach ($list as $r)
        <?php  $index= 0; ?>
        <table class="table table-bordered" style="background:white;margin-top:10px">
            <tbody>
                <tr>
                    <th>Thông tin phiếu</th>
                    <th>Thông tin nhận hàng</th>
                </tr>
                <tr>
                    <td class="text-center">Mã: <a>{{formatorderid($r->created_at,$r->id)}}</a> - Nguời bán: <a>{{$r->owner_name}}</a></td>
                    <td rowspan="2">
                            <div class="">
                                <p style="margin: 0" class="name"><b>Họ tên: {{$r->fullname}}</b></p>
                                <p style="margin: 0" class="address"><b>Địa chỉ: {{$r->address}}</b></p>
                                <p style="margin: 0" class="phone"><b>Sđt: {{$r->phone}}</b></p>
                            </div>

                            <br><br>

                            <div class="btn-group group-btn-status">
                                    <a class="btn btn-success btn-flat status-txt" href="javascript:void(0);">
                                    
                                        @if($r->ship_request == 3 && $r->status != 8 && $r->status != 9)
                                            Đang chờ giao hàng
                                        @endif
                                        @if($r->ship_request == 3 && $r->status == 8)
                                            Đã giao hàng
                                        @endif
                                        @if($r->ship_request == 3 && $r->status == 9)
                                            Đã nhận hàng
                                        @endif
                                        
                                    </a>
                                    <button type="button" class="btn btn-success btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="javascript:void" class="btn-update-status"  data-status="8" data-id="{{$r->id}}">Đã giao hàng</a></li>
                                        <li><a href="javascript:void" class="btn-update-status"  data-status="9" data-id="{{$r->id}}">Đã nhận hàng</a></li>
                                    </ul>
                                </div>
                    </td>
                </tr>

                @foreach ($r->stuffs as $r1)
                    <?php 
                    $index++; 
                    $total_quantity += $r1->quantity;
                    $total_price += ($r1->quantity * $r1->price);
                    ?>
                @endforeach

                <tr>
                    <td>
                        <table class="table order_value">
                            <tbody>
                                    <td style="width: 60%; padding-right: 40px;" class="">
                                        <br>
                                        <b>Tổng: {{formatVND(($total_price + (($total_price/100)*(Auth::user()->buy_fee)) + ($r->transport_cn) + ($r->wood_package))*($r->exchange_rate))}}</b>
                                        <br>
                                        <span>(Tỷ giá <span class="exchange-rate">{{formatVND($r->exchange_rate)}}</span>)</span>
                                        <br><br><br><br>
                                        <div class="">
                                            <div class="col-sm-12 no-padding">
                                                    <label class="col-sm-4">Vận đơn:</label>
                                                    <input class="input-transport-vn-code" value="{{$r->transport_vn}}" type="text" name="transport_vn_code">

                                                    <br><br>

                                                    <label class="col-sm-4">Đơn vị vận chuyển:</label>
                                                    <input class="input-transport-vn-name" value="{{$r->transport_vn_name}}" type="text" name="transport_vn_name">

                                                    <br><br>
                                                    
                                                    <div class="col-sm-4"></div>
                                                    <button class="btn btn-xs btn-success btn-update-transport-vn" data-id="{{$r->id}}">Cập nhật</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        @endforeach
    </div>
        
    <div class="">
            {{$list->links()}}
        </div>


@endsection

