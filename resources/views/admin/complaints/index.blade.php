@extends('layouts.admin')
@section('header',__('main.complaints'))
@section('small_header',__('main.list'))
@section('content')
<div class="box">

    <div class="box-body">
      <table class="table table-bordered">
        <tbody><tr>
          <th style="width: 10px">#</th>
          <th>{{__('main.picture')}}</th>
          <th>{{__('main.user')}}</th>
          <th>{{__('main.order')}}</th>
          <th>{{__('main.reason')}}</th>
          <th>{{__('main.description')}}</th>
          <th>{{__('main.note')}}</th>
          <th>{{__('main.amount')}}</th>
          <th>{{__('main.status')}}</th>
          <th style="width: 200px">{{__('main.operation')}}</th>
        </tr>

        @foreach ($list as $r)
            <tr>
                <td><a class="" href="{{URL::to('admin/complaints/detail/'.$r->id)}}">{{$r->id}}</a></td>
                <td>
                    <?php
                        $pt_link = null;
                        foreach ($r->photo as $key) {
                            if($key != null && $pt_link == null){
                                $pt_link = asset($key);
                                break;
                            }
                        }
                    ?>
                    <img src="{{asset($pt_link)}}" style="width:120px;height:80px;"/>
                </td>
                <td>{{$r->fullname}}</td>
                <td>
                    <a class="" href="{{URL::to('admin/orders/detail/'.$r->id_order)}}" target="_blank">QC{{$r->id_order}}</a>
                </td>
                <td>{{$r->reason}}</td>
                <td>{{$r->description}}</td>
                <td>{{$r->note}}</td>
                <td>{{$r->amount}}</td>
                <td>
                    @if($r->status == 0)
                        <span class="label label-primary">{{__('main.not_seen')}}</span>
                    @endif
                    @if($r->status == 1)
                        <span class="label label-warning label-flat">{{__('main.pending')}}</span>
                    @endif
                    @if($r->status == 2)
                        <span class="lábel label-success label-flat">{{__('main.success')}}</span>
                    @endif
                    @if($r->status == 3)
                        <span class="label label-danger label-flat">{{__('main.faild')}}</span>
                    @endif
                </td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            {{__('main.action')}}
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a  href="{{URL::to('admin/complaints/not_seen/'.$r->id)}}">{{__('main.not_seen')}}</a></li>
                            <li><a  href="{{URL::to('admin/complaints/pending/'.$r->id)}}">{{__('main.pending')}}</a></li>
                            <li><a  href="{{URL::to('admin/complaints/success/'.$r->id)}}">{{__('main.success')}}</a></li>
                            <li><a  href="{{URL::to('admin/complaints/faild/'.$r->id)}}">{{__('main.faild')}}</a></li>
                            <li><a  href="{{URL::to('admin/complaints/detail/'.$r->id)}}">{{__('main.detail')}}</a></li>
                            {{-- <li><a  href="{{URL::to('admin/complaints/delete/'.$r->id)}}">{{__('main.delete')}}</a></li> --}}
                        </ul>
                    </div>
                </td>
            </tr>
        @endforeach
      </tbody>
    </table>
    </div>
    <!-- /.box-body -->
    
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
      <div class="p-3 pagi-block">
          <div class="text-left"> {{$list->links()}}</div>
      </div>
  </div>    
  </div>
@endsection

