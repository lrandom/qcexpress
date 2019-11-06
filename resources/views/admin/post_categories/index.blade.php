@extends('layouts.admin')
@section('header',__('main.posts_categories'))
@section('small_header',__('main.list'))
@section('content')
<div class="box">
    <div class="box-header with-border">
        <a class="btn btn-primary" href="{{action('Admin\PostCategoriesControllers@add')}}">{{__('main.add')}}</a>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table class="table table-bordered">
        <tbody><tr>
          <th style="width: 10px">#</th>
          <th>{{__('main.name')}}</th>
          <th style="width: 200px">{{__('main.status')}}</th>
          <th style="width: 200px">{{__('main.operation')}}</th>
        </tr>

        @foreach ($list as $r)
        <tr>
                <td>{{$r->id}}</td>
                <td>{{$r->name}}</td>
                <td>
                  @if ($r->is_active == 0)
                    <span href="#" class="btn btn-warning btn-flat dropdown-toggle">{{__('main.deactive')}}</span>
                  @endif
                  @if ($r->is_active == 1)
                    <span href="#" class="btn btn-success btn-flat dropdown-toggle">{{__('main.active')}}</span>
                  @endif
                </td>
                <td>
                  <div class="btn-group">
                    <a href="#" class="btn btn-primary btn-flat">{{__('main.action')}}</a>
                    <button type="button" class="btn btn-primary btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                      <span class="caret"></span>
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                      @if ($r->is_active == 0)
                        <li><a href="{{URL::to('admin/post_categories/active/'.$r->id)}}">{{__('main.active')}}</a></li>
                      @endif
                      @if ($r->is_active == 1)
                        <li><a href="{{URL::to('admin/post_categories/deactive/'.$r->id)}}">{{__('main.deactive')}}</a></li>
                      @endif
                      <li> <a  href="{{URL::to('admin/post_categories/edit/'.$r->id)}}">{{__('main.edit')}}</a></li>
                      <li> <a  href="{{URL::to('admin/post_categories/delete/'.$r->id)}}">{{__('main.delete')}}</a></li>
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

