@extends('layouts.user')
@section('content')
@section('header',__('main.finance'))
@section('small_header',__('main.statement'))

@include('shared.filter_user_stm')

     <div class="box box-danger">
   
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th style="width: 10px">STT</th>
                  <th>{{__('main.transaction_code')}}</th>
                  <th>{{__('main.content')}}</th>
                  <th>{{__('main.method')}}</th>
                  <th>{{__('main.amount')}}</th>
                  <th>{{__('main.transaction_time')}}</th>
                  <th>{{__('main.status')}}</th>
                </tr>
                <?php $index=0; ?>
                @foreach ($list as $r)
                <?php $index++; ?>
                <tr>
                        <td>{{$index}}</td>
                        <td>
                            <a href="" target="_blank">GD{{$r->stid}}</a>
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
                     Tiền Trong Tài Khoản QC Express
                  @endif
                          
                        </td>
                        <td>
                            @if ($r->is_sub==1)
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
                    </tr>
                @endforeach
              </tbody></table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
               {{ $list->links() }}
            </div>
          </div>

@endsection