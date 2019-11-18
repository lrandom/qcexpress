@extends('layouts.admin')
@section('header',__('main.transaction'))
@section('small_header',__('main.list'))

@section('content')
    <style>
      .sub{
          color:red
      }

      .add{
          color:green;
      }
    </style>
@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif
@include('shared.filter_stm')

    <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th style="width: 10px">STT</th>
                        <th style="width: 150px;">{{__('main.transaction_code')}}</th>
                        <th>{{__('main.picture')}}</th>
                        <th>Khách hàng</th>
                        <th style="width: 250px;">{{__('main.content')}}</th>
                        <th>{{__('main.method')}}</th>
                        <th>{{__('main.amount')}}</th>
                        <th>{{__('main.transaction_time')}}</th>
                        <th>{{__('main.status')}}</th>
                        <th>{{__('main.action')}}</th>
                    </tr>
                    <?php $index=0; ?>
                    @foreach ($list as $r)
                        <?php $index++; ?>
                        <tr>
                            <td>{{$index}}</td>
                            <td>
                                <a href="" target="_blank">GD{{$r->id}}</a>
                            </td>
                            <td>
                                <img class="photo-zoom" data-toggle="modal" data-target="#addAddressModal" style="height: 80px; width: 120px; cursor: pointer;" data-code="GD{{$r->id}}" src="{{asset($r->photo)}}" alt="">
                            </td>
                            <td>
                                <a href="{{url('/admin/users/edit/'.$r->id_user)}}" target="_blank">{{$r->id_user}}</a>
                            </td>
                            <td>
                                @php
                                    echo htmlspecialchars_decode($r->content)
                                @endphp 
                            </td>
                            <td>
                                    @if ($r->method==1)
                                    {{__('main.cash')}}
                                @endif
                                @if ($r->method==2)
                                {{$r->name}}
                            @endif
                            @if ($r->method==3)
                           Tiền Trong Tài Khoản QCExpress
                        @endif
                        </td>
                        <td>
                            @if ($r->is_sub==0)
                                <span class="sub">- {{formatVND($r->amount)}}</span>
                            @else
                                <span class="add">+ {{formatVND($r->amount)}}</span>
                            @endif
      
                            @if ($r->type==0)
                                <span class="label label-success">Nạp tiền</span>
                            @endif
        
                            @if ($r->type==1)
                                <span class="label label-success">Tất toán</span>
                            @endif
        
                            @if ($r->type==2)
                                <span class="label label-success">Đặt cọc</span>
                            @endif
        
                            @if ($r->type==3)
                                <span class="label label-success">Thanh toán</span>
                            @endif
      
      
                        @if ($r->type==4)
                            <span class="label label-success">Hoàn tiền</span>
                        @endif
                            </td>
                            <td>{{formatvidate($r->time)}}</td>
                            <td>
                                @switch($r->status)
                                    @case(0)
                                    <span class="label bg-yellow">{{__('main.pending')}}</span>
                                        @break
                                    @case(1)
                                    <span class="label bg-green">{{__('main.complete')}}</span>
                                        @break
                                    @default
                                @endswitch
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        {{__('main.action')}}
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a class="btn-confirm" href="{{URL::to('admin/statements/pending/'.$r->id)}}">{{__('main.pending')}}</a></li>
                                        <li><a class="btn-confirm" href="{{URL::to('admin/statements/compelte/'.$r->id)}}">{{__('main.compelte')}}</a></li>
                                        <li><a class="btn-confirm" href="{{URL::to('admin/statements/delete/'.$r->id)}}">Xoá</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            {{ $list->links() }}
        </div>
    </div>








    <div class="modal fade" id="addAddressModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title code-statement"></h4>
                  </div>
                  <div class="modal-body view-image-modal">
                    
          
                  </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->







    <script type="text/javascript">
        function show_confirm(obj){
            var r=confirm("Bạn chắc chắn muốn thực hiện tác vụ?");
            if (r==true)  
            window.location = obj.attr('href');
        }    
        $('.btn-confirm').click(function(event) {
            event.preventDefault();
            show_confirm($(this));

        });


        $('.photo-zoom').click(function(){
                    var code = $(this).data('code');
                    var link = $(this).attr('src');

                    $('.code-statement').html('chi tiết hoá đơn '+code);
                    $('.view-image-modal').html('<img style="width: 100%" src="'+link+'" alt="">')
                });
    </script>

@endsection

