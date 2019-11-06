
@php
    $title = __('main.all_bill');
    $check_btn = 1;
    if(strpos(url()->full(),'users/transport/bill_transport')!=false){
        if(strpos(url()->full(),'users/transport/bill_transport/8')!=false){
            $title = 'Đã giao hàng';
            $check_btn = 2;
        }
        if(strpos(url()->current(),'users/transport/bill_transport/9')!=false){
            $title = 'Đã nhận hàng';
            $check_btn = 3;
        }
    }
@endphp

@section('header',__('main.bill_transport'))
@section('small_header', $title)

<style>
        table ul {
            margin: 0px;
            padding: 0px;
        }
    
        table ul li {
            list-style-type: none;
        }
    </style>
    
    @extends('layouts.user')
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
    
    <script src="{{ asset('public/js/order.js?x=') }}{{time()}}"></script>
    


    <div class="box-body table-responsive">    
        <a class="btn btn-primary <?php if($check_btn == 1){ echo 'btn-success'; } ?>" href="{{asset('users/transport/bill_transport')}}">Đang chờ giao hàng</a>
        <a class="btn btn-primary <?php if($check_btn == 2){ echo 'btn-success'; } ?>" href="{{asset('users/transport/bill_transport/8')}}">Đã giao hàng</a>
        <a class="btn btn-primary <?php if($check_btn == 3){ echo 'btn-success'; } ?>" href="{{asset('users/transport/bill_transport/9')}}">Đã nhận hàng</a>


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

                            <div>
                                @if($r->ship_request == 3 && $r->status != 8 && $r->status != 9)
                                    <label class="label label-warning">Đang chờ giao hàng</label>
                                @endif
                                @if($r->ship_request == 3 && $r->status == 8)
                                    <label class="label label-success">Đã giao hàng</label>
                                @endif
                                @if($r->ship_request == 3 && $r->status == 9)
                                    <label class="label label-primary">Đã nhận hàng</label>
                                @endif
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
                                <tr>
                                    <td class="col-sm-5">Ghi chú</td>
                                    <td class="col-sm-7">{{$r->note}}</td>
                                </tr>
                                <tr>
                                    <td class="col-sm-5">Tổng số lượng</td>
                                    <td class="col-sm-7">
                                        {{$total_quantity}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="">Tổng giá sản phẩm</td>
                                    <td>{{formatCNY($total_price)}}</td>
                                </tr>
                                <tr>
                                    <td class="">Tổng tiền công</td>
                                    <td>{{formatCNY(($total_price/100)*(Auth::user()->buy_fee))}}</td>
                                </tr>
                                <tr>
                                    <td class="">Phí nội địa TQ</td>
                                    <td>
                                        {{formatCNY($r->transport_cn)}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="">Phí đóng kiện gỗ</td>
                                    <td>{{formatCNY($r->wood_package)}}</td>
                                </tr>
                                <tr>
                                    <td class="">Mã đơn hàng TQ</td>
                                    <td>{{$r->code_order_cn}}</td>
                                </tr>
                                <tr>
                                    <td class="">Tổng tiền đơn hàng</td>
                                    <td>
                                        {{formatCNY($total_price + (($total_price/100)*(Auth::user()->buy_fee)) + ($r->transport_cn) + ($r->wood_package))}}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 60%; padding-right: 40px;" class="">
                                        <br><br>
                                        <div class="">
                                            <a>Giao dịch trên đơn</a>
                                            <ul>
                                                <li>Thanh toán</li>
                                                <li>Tất toán</li>
                                            </ul>
                                            <div class="col-sm-12 no-padding">
                                                    <label>Vận đơn: {{$r->lading}}</label>
                                            </div>
                                        </div>
                                        
                                        <br>
                                    </td>
                                    <td>
                                        <br><br>
                                        <b>Tổng: {{formatVND(($total_price + (($total_price/100)*(Auth::user()->buy_fee)) + ($r->transport_cn) + ($r->wood_package))*($r->exchange_rate))}}</b>
                                        <br>
                                        <span>(Tỷ giá <span class="exchange-rate">{{formatVND($r->exchange_rate)}}</span>)</span>
                                        <br><br>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        @endforeach

        <div class="">
            {{$list->links()}}
        </div>
    </div>
@endsection