@extends('layouts.admin')
@section('header',__('main.users'))
@section('small_header',__('main.profile'))
@section('content')
    <br>
    <div class="box box-primary">
        <!-- form start -->
        <form role="form" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- {{dd($obj)}} --}}
            <div class="box-body">
                
                <img src="{{asset($obj->avatar)}}" style="width:120px;height:80px;"/>
                
                <div class="form-group">
                    <label>{{__('main.avatar')}}</label>
                    <input type="file" name="picture">
                </div>

                <div class="form-group">
                    <label>{{__('main.fullname')}}*</label>
                    <input type="text" class="form-control" name="fullname" value="{{$obj->fullname}}">
                    @error('fullname')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>{{__('main.email')}}*</label>
                    <input type="text" class="form-control" name="email" value="{{$obj->email}}">
                    @error('email')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>{{__('main.phone')}}*</label>
                    <input type="text" class="form-control" name="phone" value="{{$obj->phone}}">
                    @error('phone')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>{{__('main.address')}}*</label>
                    <input type="text" class="form-control" name="address" value="{{$obj->address}}">
                    @error('address')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>

            </div>
            
            @if (session('status'))
                <div class=“alert alert-success”>
                    {{ session('status') }}
                </div>
            @endif
            
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">{{__('main.update')}}</button>
            </div>
        </form>

    </div>
@endsection