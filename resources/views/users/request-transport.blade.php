@extends('layouts.user')
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

<div class="row">

  @if ($status!=-1)
  <div style="margin-bottom:10px;margin-left:15px;margin-right:15px">
    <a class="btn <?php if(Request::fullUrl()==url('users/transport/list/1')){echo 'btn-danger';}else{echo 'btn-default';} ?>" href="{{url('users/transport/list/1')}}">Chờ duyệt</a>
    <a class="btn <?php if(Request::fullUrl()==url('users/transport/list/2')){echo 'btn-danger';}else{echo 'btn-default';} ?>" href="{{url('users/transport/list/2')}}">Chờ thanh toán phí ship</a>
    <a class="btn <?php if(Request::fullUrl()==url('users/transport/list/3')){echo 'btn-danger';}else{echo 'btn-default';} ?>" href="{{url('users/transport/list/3')}}">Chờ giao</a>
    <a class="btn <?php if(Request::fullUrl()==url('users/transport/list/4')){echo 'btn-danger';}else{echo 'btn-default';} ?>" href="{{url('users/transport/list/4')}}">Đã huỷ</a>
    <a class="btn <?php if(Request::fullUrl()==url('users/transport/list/5')){echo 'btn-danger';}else{echo 'btn-default';} ?>" href="{{url('users/transport/list/5')}}">Đã giao</a>
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
         @if ($r->ship_request!=0)
         <p>
            Nguời nhận: <b>{{$r->receiver}}</b><br>
            Địa chỉ: <b>{{$r->address}}</b><br>
            Số ĐT: <b>{{$r->receiver_phone}}</b><br>
            Đơn vị giao:  <b>{{$r->transport_vn_name}}</b>
            <br>
            Mã đơn vận: <b>{{$r->vn_lading}}</b><br>
            Phí ship: <b>{{$r->ship_fee}}</b>
         </p>
         @endif

      </div>
   </div>
</div>
@endforeach
{{ $list->links() }}
@endif
</div>

{{-- <div class="modal fade" id="addAddressModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
   
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Chọn địa chỉ nhận hàng</h4>
          </div>
          <div class="modal-body">

          </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">OK</button>
          </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal --> --}}


<script>
  // function choose_address(){
  //   $.ajax({
  //     type: "get",
  //     url: "{{url('users/transport/choose_address_api')}}",
  //     dataType: "html",
  //     success: function (response) {
  //       $('#addAddressModal .modal-body').html(response);
  //       $('#addAddressModal').modal('show');
  //     }
  //   });
  // }

  // $('.choose-address').click(function(){
  //   choose_address();
  // })

  // function send_request(){
  //    if($('.send_request_form input[name="id_address"]').val()==''){
  //     $.ajax({
  //     type: "get",
  //     url: "{{url('users/transport/choose_address_api')}}",
  //     dataType: "html",
  //     success: function (response) {
  //       $('#addAddressModal .modal-body').html(response);
  //       $('#addAddressModal').modal('show');
  //     }
  //   });
  //     return false;
  //    }
  //  };


</script>
@endsection