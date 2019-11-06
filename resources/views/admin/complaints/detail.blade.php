@extends('layouts.admin')
@section('header',__('main.complaints'))
@section('small_header',__('main.detail'))
@section('content')
<div class="box">

    <div class="box-body">
        <div class="col-sm-7">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>{{__('main.status')}}</td>
                        <td>
                            @if($list->status == 0)
                                <span class="btn btn-primary btn-flat">{{__('main.not_seen')}}</span>
                            @endif
                            @if($list->status == 1)
                                <span class="btn btn-warning btn-flat">{{__('main.pending')}}</span>
                            @endif
                            @if($list->status == 2)
                                <span class="btn btn-success btn-flat">{{__('main.success')}}</span>
                            @endif
                            @if($list->status == 3)
                                <span class="btn btn-danger btn-flat">{{__('main.faild')}}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>{{__('main.conplaint_code')}}</td>
                        <td>{{__('main.kn')}}{{$list->id}}</td>
                    </tr>
                    <tr>
                        <td>{{__('main.name')}}</td>
                        <td>{{$list->fullname}}</td>
                    </tr>
                    <tr>
                        <td>{{__('main.amount')}}</td>
                        <td>{{$list->amount}}</td>
                    </tr>
                    <tr>
                        <td>{{__('main.order_code')}}</td>
                        <td><a href="{{URL::to('admin/order/'.$list->id_order)}}">{{__('main.od')}}{{$list->id_order}}</a></td>
                    </tr>
                    <tr>
                        <td>{{__('main.created')}}</td>
                        <td>{{$list->created_at}}</td>
                    </tr>
                    <tr>
                        <td>{{__('main.updated')}}</td>
                        <td>{{$list->updated_at}}</td>
                    </tr>
                    <tr>
                        <td>{{__('main.photo')}}</td>
                        <td>
                            @foreach ($list->photo as $item)
                            <img src="{{asset($item)}}" style="width:120px;height:80px;" alt="">
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-sm-5">
            <div>
                <h4><strong>{{__('main.reason')}}</strong></h4>
                {{$list->reason}}
            </div>
            <br>
            <div>
                <h4><strong>{{__('main.description')}}</strong></h4>
                {{$list->description}}
            </div>
            <br>
            <div>
                <h4><strong>{{__('main.note')}}</strong></h4>
                {{$list->note}}
            </div>
        </div>

        <div class="col-sm-12">
            <a class="btn btn-primary" href="{{URL::to('admin/complaints/not_seen/'.$list->id)}}">{{__('main.not_seen')}}</a>
            <a class="btn btn-warning" href="{{URL::to('admin/complaints/pending/'.$list->id)}}">{{__('main.pending')}}</a>
            <a class="btn btn-success" href="{{URL::to('admin/complaints/success/'.$list->id)}}">{{__('main.success')}}</a>
            <a class="btn btn-danger" href="{{URL::to('admin/complaints/faild/'.$list->id)}}">{{__('main.faild')}}</a>
            <a class="btn btn-danger" href="{{URL::to('admin/complaints/delete/'.$list->id)}}">{{__('main.delete')}}</a>
        </div>
    </div>
    <!-- /.box-body -->
  </div>
@endsection

