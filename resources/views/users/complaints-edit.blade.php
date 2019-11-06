@extends('layouts.user')

@section('header',__('main.complaints'))
@section('small_header',__('main.edit'))


@section('content')

<div class="col-md-12">

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Horizontal Form</h3>
        </div>

        <div class="box-body">
            
            <form role="form" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label>{{__('main.reason')}}*</label>
                        <textarea class="form-control" rows="4" name="reason">{{$obj->reason}}</textarea>
                        @error('reason')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>{{__('main.amount')}}*</label>
                        <input type="number" class="form-control" name="amount" value="{{$obj->amount}}" placeholder="amount">
                        @error('amount')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label>{{__('main.description')}}*</label>
                        <textarea class="form-control" rows="8" name="description">{{$obj->description}}</textarea>
                        @error('description')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>{{__('main.note')}}*</label>
                        <textarea class="form-control" rows="4" name="note">{{$obj->note}}</textarea>
                        @error('note')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <br/>

                    <div class="row">
                        @for ($i=0; $i < 5; $i++)
                            <div class="form-group col-sm-3">
                                <label>{{__('main.avatar')}} {{$i+1}}</label>
                                <div style="height: 80px; width: 120px; border: 1px solid #ebebeb;">
                                    @if (isset($obj->photo[$i]))
                                        <img src="{{asset($obj->photo[$i])}}" style="width:120px;height:80px;"/>
                                    @endif
                                    <br/>
                                </div>
                                <input type="file" name="photo[]">
                            </div>
                        @endfor
                    </div>

                    <br/>
    
                    @if (session('status'))
                        <div class=“alert alert-success”>
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">{{__('main.save_change')}}</button>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection
