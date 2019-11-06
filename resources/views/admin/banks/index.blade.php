@extends('layouts.admin')
@section('header',__('main.banks'))
@section('small_header',__('main.list'))
@section('content')
<div class="box">
    <div class="box-header with-border">
        <a class="btn btn-primary" href="{{action('Admin\BanksControllers@add')}}">{{__('main.add')}}</a>
    </div>

    <div class="box-body">
        <table class="table table-bordered">
        <tbody><tr>
          <th style="width: 10px">#</th>
          <th>{{__('main.logo')}}</th>
          <th>{{__('main.name')}}</th>
          <th>{{__('main.fullname')}}</th>
          <th>{{__('main.status')}}</th>
          <th style="width: 200px">{{__('main.operation')}}</th>
        </tr>

        @foreach ($list as $r)
            <tr>
                <td>{{$r->id}}</td>
                <td><img src="{{asset($r->logo)}}" style="width:120px;height:80px;"/></td>
                <td>{{$r->name}}</td>
                <td>{{$r->fullname}}</td>
                <td>
                    @if($r->is_active == 1)
                        <span class="btn btn-success btn-flat">{{__('main.active')}}</span>
                    @endif
                    @if($r->is_active == 0)
                        <span class="btn btn-danger btn-flat">{{__('main.deactive')}}</span>
                    @endif
                </td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn <?php if($r->is_active==0){echo 'btn-warning';}else{echo 'btn-success';}?>  btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            {{__('main.action')}}
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            @if($r->is_active == 0)
                                <li><a href="{{URL::to('admin/banks/active/'.$r->id)}}">{{__('main.active')}}</a></li>
                            @endif
                            @if($r->is_active == 1)
                                <li><a href="{{URL::to('admin/banks/deactive/'.$r->id)}}">{{__('main.deactive')}}</a></li>
                            @endif
                            <li><a href="{{URL::to('admin/banks/edit/'.$r->id)}}">{{__('main.edit')}}</a></li>
                            <li><a href="{{URL::to('admin/banks/delete/'.$r->id)}}">{{__('main.delete')}}</a></li>
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

