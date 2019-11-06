<style>
    table ul {
        margin: 0px;
        padding: 0px;
    }

    table ul li {
        list-style-type: none;
    }
</style>
@php
  use App\CommentsOrders as CommentsOrders;
@endphp
@extends('layouts.user')
@section('content')
@section('header',__('main.orders'))
@switch($status)
@case(null)
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
        @section('small_header','Đã thanh toán (cọc)')
        @break

        @case(12)
        @section('small_header','Chưa thanh toán (chưa cọc)')
        @break

        @case(13)
        @section('small_header','Đã tất toán')
        @break

        @case(20)
        @section('small_header','Đã huỷ')
        @break
    @default
@endswitch
@if(session('notify'))
  <div class="alert alert-success">
    {{session('notify')}}
  </div>
@endif

<script>
    var id_user = '{{Auth::user()->id}}';
</script>

<script src="{{ asset('js/order.js?x=') }}{{time()}}"></script>
<div class="box-body table-responsive">    
    @foreach ($list as $r)
    <?php  
      $total_quantity = 0;
      $total_price    = 0;
      $index= 0;
    ?>
    <table class="table table-bordered" style="background:white;margin-top:10px">
        <tbody>
            <tr>

                <th colspan="2">Mã: <a>QC{{$r->id}}</a> <br> Nguời bán: <a>{{$r->owner_name}}</a></th>
                <th class="text-center" style="min-width:80px">Giá 1 SP</th>
                <th class="text-center" style="min-width:80px">Số luợng</th>
                <th class="text-center" style="min-width:80px">Giá x SL</th>
                <th class="text-center">
                 
                        @switch($r->status)
                        @case(0)
                            <span class="status text-yellow">Tiếp nhận đơn</span>
                            @if ($r->is_final==1)
                              - <span class="status text-green">Đã tất toán</span>
                            @else
                            @if ($r->deposit>0)
                              - <span class="status text-green">Đã đặt cọc</span>
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
                            - <span class="status text-green">Đã đặt cọc</span>
                          @else
                            - <span class="status text-green">Chưa đặt cọc</span>
                          @endif 
                          @endif
                        @break


                        @case (3)
                            <span class="status text-yellow">Đã mua</span>
                            @if ($r->is_final==1)
                            - <span class="status text-green">Đã tất toán</span>
                          @else
                          @if ($r->deposit>0)
                            - <span class="status text-green">Đã đặt cọc</span>
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
                            - <span class="status text-green">Đã đặt cọc</span>
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
                            - <span class="status text-green">Đã đặt cọc</span>
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
                            - <span class="status text-green">Đã đặt cọc</span>
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
                        - <span class="status text-green">Đã đặt cọc</span>
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
                        - <span class="status text-green">Đã đặt cọc</span>
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

                </th>
            </tr>

            @foreach ($r->stuffs as $r1)
              <?php 
                $total_quantity += $r1->quantity;
                $total_price += ($r1->quantity * $r1->price);
              ?>
            @endforeach

            @foreach ($r->stuffs as $r1)
            <?php 
              $index++; 
            ?>
            <tr>
                <td class="text-center">{{$index}}</td>
                <td style="width: 40%; vertical-align: center;">
                    <div style="display: flex; align-content: center;">
                      @if ($r->picture!=null)
                        <img class="lazyload" style="float:left;width:85px;margin-right:10px" src="{{$r1->picture}}">
                      @endif
                        <span style="float:left">
                            <div><a href="{{$r1->link}}" target="_blank" style=" width: 250px;
                                white-space: nowrap;
                                overflow: hidden;
                                display:block;
                                text-overflow: ellipsis;">{{$r1->name}}</a></div>
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
                    <div class="">
                        @if($r1->status == 1)
                            <label class="label label-danger" for="">Hết hàng</label>
                        @endif
                    </div>
                </td>

                <td style="font-size:14px">{{formatCNY($r1->price)}}</td>
                <td>
                    {{$r1->quantity}}
                </td>
                <td><strong style="font-size:14px"> {{formatCNY($r1->quantity*$r1->price)}} </strong></td>

                @if($index==1)
                  <td rowspan="{{count($r->stuffs)}}">
                    <table class="table order_value">
                        <tbody>
                            <tr>
                                <td class="col-sm-5">Ngày tạo đơn</td>
                                <td class="col-sm-7 text-red">{{formatvidate($r->created_at)}}</td>
                            </tr>

                            <tr>
                                <td class="col-sm-5">Ngày cập nhật đơn</td>
                                <td class="col-sm-7 text-red">{{formatvidate($r->updated_at)}}</td>
                            </tr>

                            <tr>
                                <td class="col-sm-5">Ghi chú</td>
                                <td class="col-sm-7 text-red">{{$r->note}}</td>
                            </tr>
                            <tr>
                                <td class="col-sm-5">Tổng số lượng</td>
                                <td class="col-sm-7">
                                    <b>{{$total_quantity}}</b>
                                </td>
                            </tr>
        
                            <tr>
                                <td>Tỷ giá</td>
                                <td class="text-red"><strong>{{formatVND($r->exchange_rate)}}</strong></td>
                            </tr>

                            <tr>
                                <td class="">Tổng giá sản phẩm</td>
                                <td class="text-success"><strong>{{formatCNY($total_price)}} - {{formatVND($total_price*$r->exchange_rate)}}</strong></td>
                            </tr>

                            <tr>
                                <td class="">Phí mua hàng</td>
                                <td class="text-success">
                                {{formatCNY($total_price/100*$r->fee_service)}} -
                                {{formatVND( (($total_price/100*$r->fee_service))*$r->exchange_rate)}}
                                </td>
                            </tr>

                            <tr>
                                <td class="">Phí nội địa TQ</td>
                                <td>                                
                                    @if($r->transport_cn!=null)  
                                     {{formatCNY($r->transport_cn)}}
                                       -
                                     {{formatVND($r->transport_cn*$r->exchange_rate)}}
                                    @else
                                      -    
                                     @endif
                                </td>
                            </tr>

                            <tr>
                                <td class="">Phí đóng kiện gỗ</td>
                                <td>
                                @if($r->wood_package!=null)  
                                {{formatCNY($r->wood_package)}}
                                  -
                                {{formatVND($r->wood_package*$r->exchange_rate)}}
                               @else
                                 -    
                                @endif
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="">Mã đơn hàng TQ</td>
                                <td>
                                    @if($r->code_order_cn!=null)  
                                        {{$r->code_order_cn}}
                                    @else
                                        -    
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <td class="">Vận đơn</td>
                                 <td>
                                 @if($r->code_order_cn!=null)  
                                     {{$r->lading}}
                                 @else
                                     -    
                                 @endif
                                </td>
                            </tr>

                            <tr>
                                <?php
                                  $miss_pay = ($total_price + (($total_price/100)*($r->fee)) + ($r->transport_cn) + ($r->wood_package))*($r->exchange_rate) - ($r->deposit);
                                ?>
                                <td><b>Tổng đơn hàng</b></td>
                                <td>
                                    <b>{{formatCNY(($total_price + (($total_price/100)*($r->fee)) + ($r->transport_cn) + ($r->wood_package)))}}</b>
                                    - <b>{{formatVND(($total_price + (($total_price/100)*($r->fee)) + ($r->transport_cn) + ($r->wood_package))*($r->exchange_rate))}}</b>
                                </td>
                            </tr>

                            @if ($r->is_final==0)
                              <tr>
                                <td><b>Đã đặt cọc</b></td>
                                 <td><b class="text-green">{{formatVND($r->deposit)}}</b></td>
                              </tr>

                             <tr>
                               <td><b>Còn thiếu</b></td>
                               <td><b class="text-red">{{formatVND($miss_pay)}}</b></td>
                              </tr>
                            @else
                               <tr>
                                 <td colspan="2"><label class="label label-success" for="">Đã tất toán</label></td>
                               </tr>
                            @endif
                  
                            <tr>
                              <td>
                                @if($r->status == 20 || $r->status == 10)
                                    <br>
                                    <label class="label label-danger" for="">Đã huỷ và hoàn tiền</label>
                                @endif

                                @if($r->status == 9)
                                    <a href='{{asset('users/complaints/add/'.$r->id)}}' class='btn btn-danger'>{{__('main.complaints')}}</a>
                                @endif

                                @if($r->is_final != 1 && $r->status != 20 && $r->status==7)
                                  <form action="{{url('users/orders/payment')}}" method="POST">
                                    @csrf
                                    <input class="id-address-selected" type="hidden" value="{{$r->id}}" name="id" />
                                    <input class="id-address-selected" type="hidden" value="{{$miss_pay}}" name="pay" />
                                    
                                    @if($miss_pay - (Auth::user()->amount) > 0)
                                      <a href="{{URL::to('users/finance/deposit')}}" style="margin-top:10px" class="btn btn-sm btn-danger">Nạp tiền</a>
                                      <button style="margin-top: 10px;" type="button" disabled class='btn btn-sm btn-success'>{{__('main.pay')}}</button>
                                    @else
                                      <button type="submit" class='btn btn-success'>Tất toán</button>
                                    @endif
                                  </form>
                                @endif

                              </td>
                            </tr>
                        </tbody>
                    </table>
                @endif
            </tr>
            @endforeach
            
            <tr>
                <th colspan="5">
                    <div class="wrapper-comments">
                        <h4>Bình luận</h4>
                        <hr>
                        <div class="cm-element">
                            @php
                                $id_order = $r->id;
                                $comments = CommentsOrders::join('users', 'users.id', '=', 'comments_orders.id_user')
                                ->select('*','comments_orders.created_at as created_at')
                                ->where('comments_orders.id_order', '=', $id_order)
                                ->paginate(30);
                            @endphp
                            @if($comments != null)
                                @foreach ($comments as $item)
                                    <div class="">
                                        <p style="margin-bottom: 0;" class=""> {{$item->fullname}} - {{formatvidate($r->created_at)}}</p>
                                        <p style="margin-top: 0; padding-left: 15px; font-weight: 400" class="">
                                            @php
                                              echo htmlspecialchars_decode($item->content)
                                            @endphp</p>
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

                <th colspan="">
                 
                    
                    <br><br><br>

                    <div class="wrapper-picture">
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
                                            <input type="file" name="picture[]" style="margin-top:10px">
                                        </div>
                                    @endfor
                                </div>
                                <button type="submit" class="btn btn-sm btn-success">Upload</button>
                            </form>
                    </div>
                    <br>
                </th>
            </tr>

        </tbody>
    </table>
    @endforeach

    

</div>




@endsection