@extends('layouts.user')

@section('header',__('main.complaints'))
@section('small_header',__('main.list'))

@section('content')
  <div class="col-md-12">

    <div class="box box-info">
   
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>{{__('main.picture')}}</th>
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
                        <td>{{$r->id}}</td>
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
                            <img src="{{$pt_link}}" style="width:120px;height:80px;"/>
                        </td>
                        <td>
                            <a class="" href="{{URL::to('users/orders/detail/'.$r->id_order)}}">DH{{$r->id_order}}</a>
                        </td>
                        <td>{{$r->reason}}</td>
                        <td>{{$r->description}}</td>
                        <td>{{$r->note}}</td>
                        <td>{{$r->amount}}</td>
                        <td>
                            @if($r->status == 1 || $r->status == 0)
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
                                <a class="btn btn-primary" href="{{URL::to('users/complaints/detail/'.$r->id)}}">{{__('main.detail')}}</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-left"> {{$list->links()}}</div>
    </div>
</div>

@endsection
