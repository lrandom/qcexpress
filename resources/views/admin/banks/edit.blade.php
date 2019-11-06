@extends('layouts.admin')
@section('header',__('main.banks'))
@section('small_header',__('main.edit'))
@section('content')
    <div class="box box-primary">
        <!-- form start -->
        <form role="form" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="box-body">
                <div class="form-group">
                    <label>{{__('main.logo')}}</label>
                    <div>
                        <img src="{{asset($obj->logo)}}" style="width:120px;height:80px;"/>
                    </div>
                    <br>
                    <input type="file" name="logo">
                </div>

                <div class="form-group">
                    <label>{{__('main.name')}}*</label>
                    <input type="text" class="form-control" name="name" value="{{$obj->name}}">
                    @error('name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>{{__('main.fullname')}}*</label>
                    <input type="text" class="form-control" name="fullname" value="{{$obj->fullname}}">
                    @error('fullname')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

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
@endsection