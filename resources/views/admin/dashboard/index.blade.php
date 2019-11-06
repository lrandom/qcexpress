@extends('layouts.admin')
@section('header',__('main.dashboard'))
@section('small_header','')
@section('content')


    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-gavel"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">{{__('main.new_complaints')}}</span>
                <span class="info-box-number">{{count($new_complaints)}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fa fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">{{__('main.new_orders')}}</span>
                <span class="info-box-number">{{count($new_orders)}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">{{__('main.users')}}</span>
                <span class="info-box-number">{{count($users)}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->









        <div class="box-body" style="background: #fff">

            <h4><strong>{{__('main.complaints')}}</strong></h4>
            <br>

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
          
                  @foreach ($new_complaints as $r)
                      <tr>
                          <td><a class="" href="{{URL::to('admin/complaints/detail/'.$r->id)}}">{{$r->id}}</a></td>
                          <td><img src="{{asset($r->photo[0])}}" style="width:120px;height:80px;"/></td>
                          <td>{{$r->fullname}}</td>
                          <td>
                              <a class="" href="{{URL::to('admin/order/'.$r->id_order)}}">OD{{$r->id_order}}</a>
                          </td>
                          <td>{{$r->reason}}</td>
                          <td>{{$r->description}}</td>
                          <td>{{$r->note}}</td>
                          <td>{{$r->amount}}</td>
                          <td>
                              @if($r->status == 0)
                                  <span class="btn btn-primary btn-flat">{{__('main.not_seen')}}</span>
                              @endif
                              @if($r->status == 1)
                                  <span class="btn btn-warning btn-flat">{{__('main.pending')}}</span>
                              @endif
                              @if($r->status == 2)
                                  <span class="btn btn-success btn-flat">{{__('main.success')}}</span>
                              @endif
                              @if($r->status == 3)
                                  <span class="btn btn-danger btn-flat">{{__('main.faild')}}</span>
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
            <br>
            </div>




    </div><!--/. container-fluid -->

@endsection