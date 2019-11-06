@extends('layouts.admin')
@section('header',__('main.request_transport'))
@section('small_header',__('main.list'))
@section('content')
<?php
   $total_quantity = 0;
   $total_price    = 0;
   ?>
<script>
   var id_user = '{{Auth::user()->id}}';
</script>
<script src="{{ asset('js/order.js?x=') }}{{time()}}"></script>

<div style="margin-bottom:10px;margin-left:15px;margin-right:15px">
        <a class="btn <?php if(Request::fullUrl()==url('users/transport/list/1')){echo 'btn-danger';}else{echo 'btn-default';} ?>" href="{{url('users/transport/list/1')}}">Chờ duyệt</a>
        <a class="btn <?php if(Request::fullUrl()==url('users/transport/list/2')){echo 'btn-danger';}else{echo 'btn-default';} ?>" href="{{url('users/transport/list/2')}}">Chờ thanh toán phí ship</a>
        <a class="btn <?php if(Request::fullUrl()==url('users/transport/list/3')){echo 'btn-danger';}else{echo 'btn-default';} ?>" href="{{url('users/transport/list/3')}}">Chờ giao</a>
        <a class="btn <?php if(Request::fullUrl()==url('users/transport/list/4')){echo 'btn-danger';}else{echo 'btn-default';} ?>" href="{{url('users/transport/list/4')}}">Đã huỷ</a>
        <a class="btn <?php if(Request::fullUrl()==url('users/transport/list/5')){echo 'btn-danger';}else{echo 'btn-default';} ?>" href="{{url('users/transport/list/5')}}">Đã giao</a>
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
              <input class="form-control" type="text" name="transport_vn_name" placeholder="Đơn vị giao hàng" required><br>
              <input class="form-control" type="text" name="vn_lading" placeholder="Mã đơn vận" required><br>
              <button type="submit" class="btn btn-success btn-sm" name="btn-update-ship-info" value="1">Cập nhật</button>
            @endif

         </form>

         @if ($r->ship_request==1 || $r->ship_request==3)
         <form action="{{url('admin/transport/cancel/')}}" method="POST" style="margin-top:10px">
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