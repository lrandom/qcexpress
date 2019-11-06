@extends('layouts.admin')
@section('header',__('main.users'))
@section('small_header',__('main.list'))
@section('content')
<div class="box">
    <div class="box-header with-border">
        <a class="btn btn-primary" href="{{action('Admin\UsersControllers@add')}}">{{__('main.add')}}</a>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table class="table table-bordered">
        <tbody><tr>
          <th style="width: 10px">#</th>
          <th>{{__('main.picture')}}</th>
          <th>{{__('main.name')}}</th>
          <th>{{__('main.email')}}</th>
          <th>{{__('main.address')}}</th>
          <th>{{__('main.tel')}}</th>
          <th class="text-right" style="width: 140px;">{{__('main.amount')}}</th>
          <th class="text-right" style="width: 80px;">{{__('main.buy_fee')}} %</th>
          <th class="text-right" style="width: 80px;">{{__('main.per_deposit')}} %</th>
          <th>{{__('main.level')}}</th>
          <th>{{__('main.active')}}</th>
          <th style="width: 200px !important">{{__('main.operation')}}</th>
        </tr>

        @foreach ($list as $r)
        <tr>

          <td>{{$r->id}}</td>
          <td><img src="{{asset($r->avatar)}}" style="width:80px;height:50px;"/></td>
          <td>{{$r->fullname}}</td>
          <td>{{$r->email}}</td>
          <td>{{$r->address}}</td>
          <td>{{$r->phone}}</td>
          <td class="text-right">{{formatVND($r->amount)}}</td>
          <td class="text-right">{{$r->buy_fee}}%</td>
          <td class="text-right">{{$r->per_deposit}}%</td>
          <td>
            @if ($r->per == 1)
              <span class="label label-danger">{{__('main.admin')}}</span>
            @else
              <span class="label label-success">{{__('main.user')}}</span>
            @endif
          </td>
          <td>
            @if ($r->is_active == 0)
            <span class="label label-danger">{{__('main.deactive')}}</span>
            @else
              <span class="label label-success">{{__('main.active')}}</span>
            @endif
          </td>
          <td>
            <div class="btn-group">
                  <a class="btn btn-primary btn-flat" href="#">{{__('main.action')}}</a>
              <button type="button" class="btn btn-primary btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
              </button>
              <ul class="dropdown-menu" role="menu">
                @if ($r->is_active==0)
                  <li><a href="{{URL::to('admin/users/active/'.$r->id)}}">{{__('main.active')}}</a></li>
                @endif
                @if ($r->is_active==1)
                  <li><a href="{{URL::to('admin/users/deactive/'.$r->id)}}">{{__('main.deactive')}}</a></li>
                @endif
                <li> <a  href="{{URL::to('admin/users/edit/'.$r->id)}}">{{__('main.edit')}}</a></li>
                <li> <a  href="{{URL::to('admin/users/delete/'.$r->id)}}">{{__('main.delete')}}</a></li>
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

