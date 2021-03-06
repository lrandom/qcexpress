@extends('layouts.admin')
@if (!isset($title))
   @section('header',__('main.request_transport'))
   @section('small_header',__('main.list'))
@else
   @section('header',$title)
   @section('small_header','')
@endif
@section('content')
<?php
   $total_quantity = 0;
   $total_price    = 0;
   ?>
<script>
   var id_user = '{{Auth::user()->id}}';
</script>
<script src="{{ asset('js/order.js?x=') }}{{time()}}"></script>
<?php 
$review_count = DB::table('orders')->where('ship_request',1)->count();
$wait_to_pay_count = DB::table('orders')->where('ship_request',1)->where('ship_fee','>',0)->count();
$wait_to_ship = DB::table('orders')->where('ship_request',2)->count();
$sent= DB::table('orders')->where('ship_request',3)->count();
$canceled = DB::table('orders')->where('ship_request',4)->count();
$received = DB::table('orders')->where('ship_request',5)->count();
?>
<div style="margin-bottom:10px;margin-left:15px;margin-right:15px">
        <a class="btn <?php if(Request::fullUrl()==url('admin/transport/list/1')){echo 'btn-success';}else{echo 'btn-default';} ?>" href="{{url('admin/transport/list/1')}}">Chờ duyệt&nbsp;({{$review_count}})</a>
        <a class="btn <?php if(Request::fullUrl()==url('admin/transport/list/2')){echo 'btn-success';}else{echo 'btn-default';} ?>" href="{{url('admin/transport/list/2')}}">Chờ thanh toán phí ship&nbsp;({{$wait_to_pay_count}})</a>
        <a class="btn <?php if(Request::fullUrl()==url('admin/transport/list/3')){echo 'btn-success';}else{echo 'btn-default';} ?>" href="{{url('admin/transport/list/3')}}">Chờ giao&nbsp;({{$wait_to_ship}})</a>
        <a class="btn <?php if(Request::fullUrl()==url('admin/transport/list/4')){echo 'btn-success';}else{echo 'btn-default';} ?>" href="{{url('admin/transport/list/4')}}">Đã huỷ&nbsp;({{$canceled}})</a>
        <a class="btn <?php if(Request::fullUrl()==url('admin/transport/list/5')){echo 'btn-success';}else{echo 'btn-default';} ?>" href="{{url('admin/transport/list/5')}}">Đã giao&nbsp;({{$sent}})</a>
        <a class="btn <?php if(Request::fullUrl()==url('admin/transport/list/6')){echo 'btn-success';}else{echo 'btn-default';} ?>" href="{{url('admin/transport/list/6')}}">Đã nhận&nbsp;({{$received}})</a>
      </div>
@if (count($list)>0)
@foreach ($list as $r)
<div class="col-xs-12 col-md-4">
   <div class="box box-info">
        <div class="box-header with-border">
         <span><b>Mã đơn: <a href="{{url('admin/orders/detail/'.$r->id)}}" target="_blank">QC{{$r->id}}</a></b></span>
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
         <p>
                Nguời nhận: <b>{{$r->receiver}}</b><br>
                Địa chỉ: <b>{{$r->address}}</b><br>
                Số ĐT: <b>{{$r->receiver_phone}}</b><br>
                Phí giao hàng: <b class="text-green">{{formatVND($r->ship_fee)}}</b><br>
                @if ($r->ship_request==4)
                <br>
                Lý do huỷ: <b>{{$r->cancel_ship_vn_reason}}</b>
                @endif
         </p>
         <form action="agree_ship" method="POST">
            @csrf
            <input type="hidden" value="{{$r->id}}" name="id" class="form-control" required>

            @if ($r->ship_request==1)
            <p>Chấp thuận giao hàng</p>
            <input class="form-control" type="number" name="ship_fee" placeholder="Phí ship" required><br>
            <button type="submit" class="btn btn-success btn-sm" name="btn-agree-ship" value="1">Chấp thuận giao hàng</button>
            @endif

            @if ($r->ship_request==3)
            <label>Đơn vị giao hàng</label>
              <input class="form-control" type="text" name="transport_vn_name" placeholder="Đơn vị giao hàng" required value="{{$r->transport_vn_name}}"><br>
            <label>Vận đơn (nếu có)</label>
              <input class="form-control" type="text" name="vn_lading" placeholder="Mã đơn vận" required value="{{$r->vn_lading}}"><br>
              <button type="submit" class="btn btn-success btn-sm" name="btn-update-ship-info" value="1" >Cập nhật</button>
              <button type="submit" class="btn btn-danger btn-sm" name="btn-sent" value="1" onclick="return confirm('Bạn chắc chắn muốn chuyển trạng thái là đã giao')">Đã giao</button>
            @endif
         </form>

         @if ($r->ship_request==1 || $r->ship_request==3)
         <form action="{{url('admin/transport/cancel')}}" method="POST" style="margin-top:10px">
                @csrf
                <input type="hidden" value="{{$r->id}}" name="id" class="form-control" required>
                <p>Huỷ giao với lý do:</p>
                <input class="form-control" type="text" name="reason" required>
                <br>
                <button type="submit" class="btn btn-danger btn-sm btn-cancel-transport">Huỷ giao</button>
         </form>
         @endif
      </div>
      <!-- /.box-body -->
   </div>
</div>
@endforeach
{{ $list->links() }}
@endif
@endsection