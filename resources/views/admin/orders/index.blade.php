<?php
    use App\CommentsOrders as CommentsOrders;
    use App\Links as Links;
    $total_quantity = 0;
    $total_price    = 0;
?>
@extends('layouts.admin')
@section('content')
@section('header',__('main.orders'))
@switch($status)
    @case(-1)
        @section('small_header','Tất cả')
        @break

    @case(0)
        @section('small_header','Đang chờ')
        @break

        @case(1)
        @section('small_header','Đã kiểm tra')
        @break

        @case(2)
        @section('small_header','Đang xử lý')
        @break
        
        @case(3)
        @section('small_header','Đã mua')
        @break

        @case(4)
        @section('small_header','Shop đã gửi hàng')
        @break

        @case(5)
        @section('small_header','Đến kho Trung Quốc')
        @break

        @case(6)
        @section('small_header','Về kho Việt Nam')
        @break

        @case(7)
        @section('small_header','Đã kiểm hàng')
        @break

        @case(8)
        @section('small_header','Đã giao hàng')
        @break

        @case(9)
        @section('small_header','Đã nhận hàng')
        @break

        @case(10)
        @section('small_header','Đã hết hàng')
        @break

        @case(11)
        @section('small_header','Đã đặt cọc')
        @break

        @case(12)
        @section('small_header','Chưa đặt cọc')
        @break

        @case(13)
        @section('small_header','Đã tất toán')
        @break

        @case(20)
        @section('small_header','Đã huỷ')
        @break
    @default
        
@endswitch
<style>
    table ul {
        margin: 0px;
        padding: 0px;
    }
    table ul li {
        list-style-type: none;
    }
</style>

<script>
    var id_user = '{{Auth::user()->id}}';
</script>
<script src="{{ asset('public/js/order.js?x=') }}{{time()}}"></script>
<div class="box-body table-responsive">
    @include('shared.filter')
    @if ($status == 11)
        <div class="btn-group">
            <a class="btn <?php if(Request::input('type')=='wait'){echo 'btn-success';}else{echo 'btn-default';} ?>" href="{{url('/admin/orders/11?type=wait')}}">Chờ mua</a>
            <a class="btn <?php if(Request::input('type')=='buyed'){echo 'btn-success';}else{echo 'btn-default';} ?>" href="{{url('/admin/orders/11?type=buyed')}}">Đã mua</a>
            <a class="btn <?php if(Request::input('type')==null){echo 'btn-success';}else{echo 'btn-default';} ?>" href="{{url('/admin/orders/11')}}">Tất cả</a>
        </div>
    @endif
    
    @foreach ($list as $r)
        <?php 
        $total_quantity = 0;
        $total_price    = 0;
        $index= 0;
        ?>
        <table class="table table-bordered" style="background:white;margin-top:10px">
            <tbody>
                <tr>
                    <th colspan="2">Mã - <a>QC{{$r->id}}</a> <br> Nguời bán - <a>{{$r->owner_name}}</a>
                        <br> Khách đặt hàng - <a target="_blank" href="{{url('/admin/users/edit/'.$r->id_user)}}">
                        {{$r->fullname}} - {{$r->id}}</a> <br>
                    </th>
                    <th class="text-center">Giá 1 sp</th>
                    <th class="text-center">Số luợng</th>
                    <th class="text-center" style="width:150px">Giá x Số luợng</th>
                    <th><div style="text-transform:uppercase" class="text-center">
                        @switch($r->status)
                            @case(0)
                                <span class="status text-yellow">Tiếp nhận đơn</span>
                                @if ($r->is_final==1)
                                  - <span class="status text-green">Đã tất toán</span>
                                @else
                                @if ($r->deposit>0)
                                  - <span class="status text-green">Đã đặt cọc </span>
                                @else
                                  - <span class="status text-green">Chưa đặt cọc</span>
                                @endif 
                                @endif
                            @break

                            @case(1)
                                <span class="status text-yellow">Đã kiểm tra</span>
                                @if ($r->is_final==1)
                                - <span class="status text-green">Đã tất toán</span>
                              @else
                              @if ($r->deposit>0)
                                - <span class="status text-green">Đã đặt cọc </span>
                              @else
                                - <span class="status text-green">Chưa đặt cọc</span>
                              @endif 
                              @endif
                            @break

                            @case(2)
                                <span class="status text-yellow">Đang xử lý</span>
                                @if ($r->is_final==1)
                                - <span class="status text-green">Đã tất toán</span>
                              @else
                              @if ($r->deposit>0)
                                - <span class="status text-green">Đã đặt cọc </span>
                              @else
                                - <span class="status text-green">Chưa đặt cọc</span>
                              @endif 
                              @endif
                            @break;

                            @case (3)
                                <span class="status text-yellow">Đã mua</span>
                                @if ($r->is_final==1)
                                - <span class="status text-green">Đã tất toán</span>
                              @else
                              @if ($r->deposit>0)
                                - <span class="status text-green">Đã đặt cọc </span>
                              @else
                                - <span class="status text-green">Chưa đặt cọc</span>
                              @endif 
                              @endif
                            @break;

                            @case (4)
                            <span class="status text-yellow">Shop đã gửi hàng</span>
                            @if ($r->is_final==1)
                            - <span class="status text-green">Đã tất toán</span>
                          @else
                          @if ($r->deposit>0)
                            - <span class="status text-green">Đã đặt cọc </span>
                          @else
                            - <span class="status text-green">Chưa đặt cọc</span>
                          @endif 
                          @endif
                        @break;

                            @case (4)
                                <span class="status text-yellow">Đang vận chuyển đến kho Trung Quốc</span>
                                @if ($r->is_final==1)
                                - <span class="status text-green">Đã tất toán</span>
                              @else
                              @if ($r->deposit>0)
                                - <span class="status text-green">Đã đặt cọc </span>
                              @else
                                - <span class="status text-green">Chưa đặt cọc</span>
                              @endif 
                              @endif
                            @break;

                            @case (5)
                                <span class="status text-yellow">Đến kho Trung Quốc</span>
                                @if ($r->is_final==1)
                                - <span class="status text-green">Đã tất toán</span>
                              @else
                              @if ($r->deposit>0)
                                - <span class="status text-green">Đã đặt cọc </span>
                              @else
                                - <span class="status text-green">Chưa đặt cọc</span>
                              @endif 
                              @endif
                            @break;

                            @case (6)
                                <span class="status text-green">Về kho Việt Nam</span>
                                @if ($r->is_final==1)
                                - <span class="status text-green">Đã tất toán</span>
                              @else
                              @if ($r->deposit>0)
                                - <span class="status text-green">Đã đặt cọc </span>
                              @else
                                - <span class="status text-green">Chưa đặt cọc</span>
                              @endif 
                              @endif
                            @break;

                            @case (7)
                            <span class="status text-green">Đã kiểm hàng</span>
                            @if ($r->is_final==1)
                            - <span class="status text-green">Đã tất toán</span>
                          @else
                          @if ($r->deposit>0)
                            - <span class="status text-green">Đã đặt cọc </span>
                          @else
                            - <span class="status text-green">Chưa đặt cọc</span>
                          @endif 
                          @endif
                            @break;

                            @case (8)
                            <span class="status text-green">Đã giao hàng</span>
                            @if ($r->is_final==1)
                            - <span class="status text-green">Đã tất toán</span>
                          @else
                          @if ($r->deposit>0)
                            - <span class="status text-green">Đã đặt cọc </span>
                          @else
                            - <span class="status text-green">Chưa đặt cọc</span>
                          @endif 
                          @endif
                            @break;

                            @case (9)
                            <span class="status text-green">Đã nhận hàng</span>
                            @break;

                            @case (10)
                            <span class="status text-red">Đã hết hàng</span>
                            @break;

                          
                            @case (20)
                            <span class="status text-red">Đã huỷ</span>
                            @break;

                            @default
                        @endswitch
                        </div>
                    </th>
                </tr>
                
                @foreach ($r->stuffs as $r1)
                    <?php $total_quantity += $r1->quantity; $total_price += ($r1->quantity * $r1->price); ?>
                @endforeach

                @foreach ($r->stuffs as $r1)
                    <?php $index++; ?>
                    <tr>
                        <td class="text-center">{{$index}}</td>
                        <td style="width: 30%; vertical-align: center;">
                            <div class="" style="display: flex; align-items: center;">
                                @if ($r1->picture!=null)
                                 <img class="lazyload" style="float:left;width:85px;margin-right:10px" src="{{$r1->picture}}">
                                @endif
                                <span style="float:left">
                                    <div>
                                        <style>
                                            .link-elm{
                                                display: flex;
                                            }
                                            .path{
                                                width: 250px;
                                                white-space: nowrap;
                                                overflow: hidden;
                                                display:block;
                                                text-overflow: ellipsis;
                                            }
                                        </style>

                                        <div class="wrap-links">
                                            <div class="link-elm">
                                                <a href="{{$r1->link}}" target="_blank" class="path">{{$r1->name}}</a>&nbsp;
                                                <hr>
                                            </div>

                                            <?php $links = Links::where('id_stuff', '=', $r1->id)->get();
                                            if($links != null){
                                                foreach ($links as $link_stuff){ ?>
                                                    <div class="link-elm">
                                                        <a href="{{$link_stuff->path}}" target="_blank" class="path">{{$link_stuff->path}}</a>&nbsp;
                                                        <a class="btn-del-link text-red" data-id="{{$link_stuff->id}}">Xoá</a>
                                                        <hr>
                                                    </div>
                                                <?php }
                                            }?>
                                        </div>

                                        <input class="input-add-link" name="input-add-link"/>
                                        <a class="btn btn-success btn-xs btn-add-link" data-id="{{$r1->id}}">thêm</a>
                                    </div>
                                    <div>
                                        <?php
                                            if($r1->props!=null){
                                            $props = json_decode($r1->props);
                                            foreach ($props as $prop) {
                                                echo $prop->name.'-'.$prop->val.'<br>';
                                            }
                                            }
                                        ?>
                                    </div>
                                </span>
                            </div>
                        </td>

                        <td style="font-size:14px;" class="price-stuff-input">
                            <div class="text-center">
                                <input type="number" value="{{$r1->price}}" class="text-center input-price" style="width:50px"/>
                            </div>
                            <div class="text-center" style="margin-top: 10px;font-size:14px">
                            <a href="javascript:void(0);" class="btn btn-success btn-xs btn-change-price" data-id="{{$r1->id}}">Cập nhật</a>
                            </div>
                        </td>

                        <td class="quantity-stuff-input">
                            <div class="text-center">
                                <input type="text" value="{{$r1->quantity}}" class="text-center input-quantity" style="width:50px"/>
                            </div>
                            <div class="text-center"  style="margin-top: 10px;">
                                <a href="javascript:void(0);" class="btn btn-success btn-xs btn-change-quantity" data-id="{{$r1->id}}">Cập nhật</a>
                            </div>
                            {{-- <div class="text-center" style="margin-top: 10px;font-size:14px">
                                <label class="btn btn-danger btn-xs">Hết hàng</label>
                            </div> --}}
                        </td>

                        <td>
                            <div style="font-size:14px"> {{formatCNY($r1->quantity*$r1->price)}} </div>
                            <div style="font-size:14px"> {{formatVND($r1->quantity*$r1->price*$r->exchange_rate)}} </div>
                        </td>

                        @if($index==1)
                            <td rowspan="{{count($r->stuffs)}}">
                                <table class="table order_value">
                                    <tbody>
                                        
                                        <tr>
                                            <td class="col-sm-5 text-right">Ngày tạo đơn</td>
                                            <td class="col-sm-7">
                                                <a>@php
                                                      echo formatvidate($r->created_at);
                                                 @endphp</a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="col-sm-5 text-right">Ngày cập nhật đơn</td>
                                            <td class="col-sm-7"><a>@php
                                                    echo formatvidate($r->updated_at);
                                                 @endphp</a></td>
                                        </tr>
                                        <tr>
                                            <td class="col-sm-5 text-right">Ghi chú từ khách hàng</td>
                                            <td class="col-sm-7"><a class="text-red">{{$r->note}}</a></td>
                                        </tr>
                                        <tr>
                                            <td class="col-sm-5 text-right">Tổng số lượng</td>
                                            <td class="col-sm-7">{{$total_quantity}}</td>
                                        </tr>

                                        <tr>
                                            <td class="text-right">Tổng tiền sản phẩm</td>
                                            <td>{{formatCNY($total_price)}} - {{formatVND($total_price*$r->exchange_rate)}}</td>
                                        </tr>

                                        <tr>
                                            <td class="text-right">Phần trăm phí dịch vụ(%)</td>
                                            <td>
                                             <input type="number" value="{{$r->fee_service}}" class="text-center input-fee-service"/>
                                             <a href="javascript:void(0);" class="btn btn-success btn-xs btn-change-fee-service" data-id="{{$r->id}}">Cập nhật</a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="text-right">Phí nội địa TQ (¥)</td>
                                            <td>
                                                <input type="number" value="{{$r->transport_cn}}" class="text-center input-fee-inland-transport"/>
                                                <a href="javascript:void(0);" class="btn btn-success btn-xs btn-change-fee-inland-transport" data-id="{{$r->id}}">Cập nhật</a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="text-right">Vận chuyển về VN (¥)</td>
                                            <td>
                                                <input type="number" value="{{$r->transport_cn_vn}}" class="text-center input-fee-transport-cn-vn"/>
                                                <a href="javascript:void(0);" class="btn btn-success btn-xs btn-change-fee-transport-cn-vn" data-id="{{$r->id}}">Cập nhật</a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="text-right">Phí đóng kiện gỗ (¥)</td>
                                            <td>
                                                <input type="number" value="{{$r->wood_package}}" class="text-center input-fee-wood-package"/>
                                                <a href="javascript:void(0);" class="btn btn-success btn-xs btn-change-wood-package" data-id="{{$r->id}}">Cập nhật</a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="text-right">Cân nặng (kg)</td>
                                            <td>
                                             <input type="number" value="{{$r->weight}}" class="text-center input-weight"/>
                                             <a href="javascript:void(0);" class="btn btn-success btn-xs btn-change-weight" data-id="{{$r->id}}">Cập nhật</a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="text-right">Mã đơn hàng TQ</td>
                                            <td>
                                                <input type="text" value="{{$r->code_order_cn}}" class="text-center input-code-order-cn"/>
                                                <a href="javascript:void(0);" class="btn btn-success btn-xs btn-change-code-order-cn" data-id="{{$r->id}}">Cập nhật</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-right">Tài khoản mua hàng</td>
                                            <td>
                                                <input type="text" value="{{$r->buy_account}}" class="text-center input-buy-account"/>
                                                <a href="javascript:void(0);" class="btn btn-success btn-xs btn-change-buy-account" data-id="{{$r->id}}">Cập nhật</a>
                                            </td>
                                        </tr>
                                        <tr>
                                                <td class="text-right">Phí dịch vụ ({{$r->fee_service}}%)</td>
                                                <td>
                                                 
                                                    @php
                                                      $fee_service = ($total_price*$r->fee_service)/100
                                                    @endphp
                                                    {{formatCNY($fee_service)}}<br>
                                                    {{formatVND($fee_service*$r->exchange_rate)}}<br>
                                                </td>
                                            </tr>
                                        <tr>

                                            <td class="text-right">Tổng tiền đơn hàng</td>
                                            <td>
                                             
                                                @php
                                                  $total_price = ($total_price + (($total_price/100)*($r->buy_fee)) + ($r->transport_cn) + ($r->wood_package)+ $fee_service);
                                                @endphp
                                                {{formatCNY($total_price)}}<br>
                                                {{formatVND($total_price*$r->exchange_rate)}}
                                            </td>
                                        </tr>



                                        @if ($r->is_final==0)
                                        <tr>
                                            <td class="text-right">Đã cọc</td>
                                            <td><strong style="color:green">{{formatVND($r->deposit)}}</strong></td>
                                        </tr>

                                        <tr>
                                            <td class="text-right">Còn thiếu</td>
                                            <td><strong style="color:red">{{formatVND($total_price*$r->exchange_rate - $r->deposit)}}</strong></td>
                                        </tr>
    
                                        @endif
                                        <tr>
                                            <td class="text-right"></td>
                                            <td>
            
                                                <br>
                                                <span> 
                                                    (Tỷ giá <span class="exchange-rate">{{formatVND($r->exchange_rate)}}</span>)
                                                    <span class="form-update-exchange-rate" style="display:none">
                                                        <input type="text" value="{{$r->exchange_rate}}" 
                                                        class="text-center input-exchange-rate"
                                                            style="width:50px"/>
                                                        <a href="javascript:void(0);" class="btn-cancel">{{__('main.cancel')}}</a>
                                                        | <a href="javascript:void(0);" class="btn-update"  data-id="{{$r->id}}">{{__('main.update')}}</a>
                                                    </span>
                                                    <a href="javascript:void(0);" class="btn-update-exchange-rate">{{__('main.update_exchange_rate')}}</a>
                                                </span>

                                                <br>
                                                <br>

                                                @if ($r->status!=9)
                                                    <div class="btn-group group-btn-status">
                                                        <a class="btn btn-success btn-flat status-txt" href="javascript:void(0);">
                                                            @if($r->status == 0)
                                                               Đang chờ
                                                            @endif
                                                            {{-- @if($r->status == 2)
                                                                Đang xử lý
                                                            @endif --}}
                                                            @if($r->status == 1)
                                                                Đã kiểm tra
                                                            @endif
                                                            @if($r->status == 3)
                                                                Đã mua hàng                                                                
                                                            @endif
                                                            @if($r->status == 4)
                                                                Shop đã gửi hàng
                                                            @endif
                                                            @if($r->status == 5)
                                                                Về kho TQ
                                                            @endif
                                                            @if($r->status == 6)
                                                                Đã về VN
                                                            @endif
                                                            @if($r->status == 7)
                                                                Kiểm hàng    
                                                            @endif
                                                            @if($r->status == 8)
                                                                Đã giao
                                                            @endif
                                                            @if($r->status == 9)
                                                                Đã nhận
                                                            @endif
                                                            @if($r->status == 10)
                                                                Hết hàng
                                                            @endif
                                                            @if($r->status == 20)
                                                                Đã huỷ
                                                            @endif
                                                        </a>
                                                        @if($r->status != 10 && $r->status != 20)
                                                            <button type="button" class="btn btn-success btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                                <span class="caret"></span>
                                                                <span class="sr-only">Toggle Dropdown</span>
                                                            </button>
                                                            <ul class="dropdown-menu" role="menu">
                                                                <li><a href="javascript:void" class="btn-update-status"  data-status="0" data-id="{{$r->id}}">Đang chờ</a></li>
                                                                <li><a href="javascript:void" class="btn-update-status"  data-status="1" data-id="{{$r->id}}">Đã kiểm tra</a></li>
                                                                <li><a href="javascript:void" class="btn-update-status"  data-status="2" data-id="{{$r->id}}">Đang xử lý</a></li>
                                                                <li><a href="javascript:void" class="btn-update-status"  data-status="3" data-id="{{$r->id}}">Đã mua hàng</a></li>
                                                                <li><a href="javascript:void" class="btn-update-status"  data-status="4" data-id="{{$r->id}}">Shop đã gửi hàng</a></li>
                                                                <li><a href="javascript:void" class="btn-update-status"  data-status="5" data-id="{{$r->id}}">Về kho TQ</a></li>
                                                                <li><a href="javascript:void" class="btn-update-status"  data-status="6" data-id="{{$r->id}}">Đã về VN</a></li>
                                                                <li><a href="javascript:void" class="btn-update-status"  data-status="7" data-id="{{$r->id}}">Kiểm hàng</a></li>
                                                                <li><a href="javascript:void" class="btn-update-status"  data-status="8" data-id="{{$r->id}}">Đã giao</a></li>
                                                                <li><a href="javascript:void" class="btn-update-status"  data-status="9" data-id="{{$r->id}}">Đã nhận</a></li>
                                                                <li><a href="javascript:void" class="btn-cancel-order" data-toggle="modal" data-target="#cancelOrder"  data-status="20" data-id="{{$r->id}}">Huỷ đơn</a></li>
                                                            </ul>
                                                        @endif

                                                        @if($r->status == 20)
                                                          <a class="btn btn-danger" href="{{url('admin/orders/delete/'.$r->id)}}"> Xoá</a>
                                                        @endif
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        @endif
                    </tr>
                @endforeach
                <tr>
                    <th colspan="5">
                        <div class="">
                            <label>Ghi chú admin</label>
                            <textarea class="form-control input-note-admin" style="font-weight: 400;" name="note_admin" id="" cols="30" rows="3">{{$r->note_admin}}</textarea>
                            <a style="margin-top: 10px;" href="javascript:void(0);" class="btn btn-success btn-xs btn-change-note-admin" data-id="{{$r->id}}">Cập nhật</a>
                        </div>
                        <br>
                        <div class="wrapper-comments">
                            <label>Bình luận</label>
                            <hr>
                            <div class="cm-element">
                                @php
                                    $id_order = $r->id;
                                    $comments = CommentsOrders::select('*','comments_orders.id as id','comments_orders.created_at as created_at')
                                    ->join('users', 'users.id', '=', 'comments_orders.id_user')
                                    ->where('comments_orders.id_order', '=', $id_order)
                                    ->orderBy('comments_orders.id','desc')
                                    ->take(20)
                                    ->get()->reverse()
                                @endphp
                              
                                @if($comments != null)
                                    @foreach ($comments as $item)
                                        <div class="">
                                            <p style="margin-bottom: 0;" class="">{{$item->fullname}}</p>
                                            <p style="margin-top: 0; padding-left: 15px; font-weight: 400" class="">@php
                                                echo htmlspecialchars_decode($item->content)
                                            @endphp
                                            <br><a><i style="font-size:12px">
                                                @php
                                                      echo formatvidate($item->created_at);
                                                @endphp
                                            </i></a></p>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <br>
                            <div class="cm-form">
                                <textarea class="form-control input-comment" name="" id="" cols="30" rows="1"></textarea>
                                <a style="margin-top: 10px;" href="javascript:void(0);" class="btn btn-success btn-xs btn-comment" data-user="{{Auth::user()->fullname}}" data-id="{{$r->id}}">Bình luận</a>
                                <br><br>
                            </div>
                        </div>
                    </th>

                    <th colspan="" class="">
                        <div class="">
                            {{-- <a>Giao dịch trên đơn</a>
                            <ul>
                                <li>Thanh toán:</li>
                                <li>Tất toán</li>
                            </ul> --}}
                            <div class="col-sm-12 no-padding">
                                <label>Vận đơn</label>
                                <br>
                                <input type="text" class="input-china-transfer-bill" style="width:150px;font-weight:normal" value="{{$r->lading}}">
                                <a href="javascript:void(0);" data-id="{{$r->id}}" class="btn btn-xs btn-success btn-china-transfer-bill">Cập nhật</a>
                            </div>
                        </div>

                        <br><br><br><br><br>

                        <div class="">
                            <form role="form" action="upload_img" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{$r->id}}">
                                <div class="row">
                                    @for ($i=0; $i < 2; $i++)
                                        <div class="form-group col-sm-6 col-xs-12">
                                            <label>{{__('main.avatar')}} {{$i+1}}</label>
                                            <div style="height: 80px; width: 120px; border: 1px solid #ebebeb;">
                                                @if (isset($r->picture[$i]))
                                                    <img src="{{asset($r->picture[$i])}}" style="width:120px;height:80px;"/>
                                                @endif
                                                <br/>
                                            </div>
                                            <input type="file" name="picture[]">
                                        </div>
                                    @endfor
                                </div>
                                <button type="submit" class="btn btn-sm btn-success">Upload</button>
                            </form>
                        </div>
                    </th>
                </tr>
            </tbody>
        </table>
    @endforeach

    <div class="">
        {{$list->links()}}
    </div>
</div>


<div class="modal fade" id="cancelOrder" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Lý do huỷ đơn ?</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="{{url('admin/orders/cancel_order')}}" method="POST" class="form-horizontal">
                  @csrf
                   <input type="hidden" value="" name="id"/>
                   <textarea name="reason" required class="form-control" style="height:200px;resize:none" placeholder="Vui lòng cho chúng tôi biết lý do huỷ đơn của bạn ?"></textarea>
                   <br>
                   <input type="checkbox" name="refund"> Đồng ý hoàn tiền
                   <br><br>
                   <button class="btn btn-danger" style="margin-top:10px;width:100%">Gửi</button>
                </form>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
    
      <script>
         $('.btn-cancel-order').click(function(){
            $('#cancelOrder form input[name="id"]').val($(this).attr('data-id'));
         })
      </script>
@endsection