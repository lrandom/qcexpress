@extends('layouts.user')

@section('header',__('main.complaints'))
@section('small_header',__('main.detail'))

@section('content')
  <div class="col-md-12">

    <div class="box box-info">

        <div class="box-body">
            <div class="col-sm-7">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td style="width: 10px">{{__('main.status')}}</td>
                            <td>
                                @if($list->status == 1 || $list->status == 0)
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
                            <td>{{__('main.amount')}}</td>
                            <td>{{$list->amount}}</td>
                        </tr>
                        <tr>
                            <td>{{__('main.order_code')}}</td>
                            <td><a href="{{URL::to('users/orders/detail/'.$list->id_order)}}">{{__('main.od')}}{{$list->id_order}}</a></td>
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
                @if($list->status == 0 || $list->status == 1)
                    <a class="btn btn-success" href="{{URL::to('users/complaints/edit/'.$list->id)}}">{{__('main.edit')}}</a>
                    <a class="btn btn-danger" href="{{URL::to('users/complaints/delete/'.$list->id)}}">{{__('main.cancel_the_complaint')}}</a>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
