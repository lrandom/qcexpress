@extends('layouts.user')

@if (!isset($title))
   @section('header',__('main.request_transport'))
   @section('small_header',__('main.list'))
@else
   @section('header',$title)
   @section('small_header','')
@endif

@section('content')

@if(session('notify'))
  <div class="alert alert-success">
    {{session('notify')}}
  </div>
@endif

<?php
   $total_quantity = 0;
   $total_price    = 0;
   ?>
<script>
   var id_user = '{{Auth::user()->id}}';
</script>
<script src="{{ asset('js/order.js?x=') }}{{time()}}"></script>

<div class="row">
 <?php 
   $review_count = DB::table('orders')->where('ship_request',1)->count();
   $wait_to_pay_count = DB::table('orders')->where('ship_request',1)->where('ship_fee','>',0)->count();
   $wait_to_ship = DB::table('orders')->where('ship_request',2)->count();
   $sent= DB::table('orders')->where('ship_request',3)->count();
   $canceled = DB::table('orders')->where('ship_request',4)->count();
   $received = DB::table('orders')->where('ship_request',5)->count();
 ?>
  @if ($status!=-1)
  <div style="margin-bottom:10px;margin-left:15px;margin-right:15px">
    <a class="btn <?php if(Request::fullUrl()==url('users/transport/list/1')){echo 'btn-danger';}else{echo 'btn-default';} ?>" href="{{url('users/transport/list/1')}}">
      Chờ duyệt&nbsp;({{$review_count}})</a>
    <a class="btn <?php if(Request::fullUrl()==url('users/transport/list/2')){echo 'btn-danger';}else{echo 'btn-default';} ?>" href="{{url('users/transport/list/2')}}">
      Chờ thanh toán phí ship&nbsp;({{$wait_to_pay_count}})</a>
    <a class="btn <?php if(Request::fullUrl()==url('users/transport/list/3')){echo 'btn-danger';}else{echo 'btn-default';} ?>" href="{{url('users/transport/list/3')}}">
      Chờ giao&nbsp;({{$wait_to_ship}})</a>
    <a class="btn <?php if(Request::fullUrl()==url('users/transport/list/4')){echo 'btn-danger';}else{echo 'btn-default';} ?>" href="{{url('users/transport/list/4')}}">
      Đã huỷ&nbsp;({{$canceled}})</a>
    <a class="btn <?php if(Request::fullUrl()==url('users/transport/list/5')){echo 'btn-danger';}else{echo 'btn-default';} ?>" href="{{url('users/transport/list/5')}}">
      Đã giao&nbsp;({{$sent}})</a>
    <a class="btn <?php if(Request::fullUrl()==url('users/transport/list/6')){echo 'btn-danger';}else{echo 'btn-default';} ?>" href="{{url('users/transport/list/6')}}">
      Đã nhận&nbsp;({{$received}})</a>
  </div>
  @endif
@if (count($list)>0)
@foreach ($list as $r)
<div class="col-xs-12 col-md-4">
   <div class="box box-info">
      <div class="box-header with-border">
         <span><b>Mã đơn: <a href="{{url('users/orders/detail/'.$r->id)}}" target="_blank">QC{{$r->id}}</a></b></span>
         <span style="float:right">
           
             @switch($r->ship_request)
                 @case(1)
                 <label class="label label-danger">Chờ duyệt</label>
                     @break

                 @case(2)
                 <label class="label label-warning">Chờ thanh toán phí ship</label>
                    @break

                  @case(3)
                  <label class="label label-warning">Chờ giao</label>
                     @break

                  @case(4)
                  <label class="label label-danger">Đã huỷ</label>
                     @break;

                  @case(5)
                  <label class="label label-success">Đã giao</label>
                     @break

                  @case(6)
                  <label class="label label-success">Đã nhận</label>
                     @break
                 @default
                     
             @endswitch
          
         </span>
      </div>
      <div class="box-body table-responsive box-info">
         @if ($r->ship_request==0 && $r->is_final==1)
         <p>
              <form action="{{url('users/transport/send_request')}}" class="send_request_form" method="POST" onsubmit="return send_request()">
                  @csrf
                  <input type="hidden" value="{{$r->id}}" name="id">
                  <input type="text" name="receiver" placeholder="nguời nhận" class="form-control" required/>
                  <textarea name="address" placeholder="Địa chỉ" class="form-control" style="margin-top:10px" required></textarea>
                  <input type="text" name="receiver_phone" placeholder="SDT" class="form-control"  style="margin-top:10px" required/>
                  <button type="submit" class='btn btn-sm btn-success' style="margin-top:10px">Yêu cầu giao</button>
              </form>
         </p>
         @endif

         @if ($r->ship_request==0 && $r->is_final==0)
           <a href="{{url('users/orders/detail/'.$r->id)}}">Tất toán đơn hàng</a>
         @endif

         @if ($r->ship_request==2 && $r->ship_fee>0)
         <p>
              <form action="{{url('users/transport/pay_shipfee')}}" method="POST">
                  @csrf
                  <input type="hidden" value="{{$r->id}}" name="id">
                  <input type="hidden" value="{{$r->ship_fee}}" name="ship_fee">
                  <button type="submit" class='btn btn-sm btn-success'>Thanh toán tiền ship</button>
              </form>
         </p>
         @endif

         @if ($r->ship_request==5)
         <p>
             <a class="btn btn-danger" href="{{url('users/transport/received_goods/'.$r->id)}}" 
               onclick="return confirm('Bạn chắc chắn đã nhận hàng ?')">Đã nhận</a>
         </p>
         @endif

         @if ($r->ship_request!=0)
         <p>
            Nguời nhận: <b>{{$r->receiver}}</b><br>
            Địa chỉ: <b>{{$r->address}}</b><br>
            Số ĐT: <b>{{$r->receiver_phone}}</b><br>
            Đơn vị giao:  <b>{{$r->transport_vn_name}}</b>
            <br>
            Mã đơn vận: <b>{{$r->vn_lading}}</b><br>
            Phí ship: <b>{{formatVND($r->ship_fee)}}</b>

            @if ($r->ship_request==4)
                <br>
                Lý do huỷ: <b>{{$r->cancel_ship_vn_reason}}</b>
            @endif
         </p>
         @endif

      </div>
   </div>
</div>
@endforeach
{{ $list->links() }}
@endif
</div>
@endsection