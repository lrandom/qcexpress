@extends('layouts.admin')
@section('header',__('main.users'))
@section('small_header',__('main.edit'))
@section('content')

@if(session('notify'))
  <div class="alert alert-success">
    {{session('notify')}}
  </div>
@endif

<div class="box box-primary">
        <!-- form start -->
        <form role="form" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="box-body">

            <div class="form-group">
              <label>{{__('main.avatar')}}</label>
              <div>
                <img style="width: 120px; height: 80px;" src="{{asset($obj->avatar)}}" alt="">
              </div>
              <br>
              <input type="file" name="avatar">
            </div>

            <br>

            <div class="form-group">
              <label>{{__('main.level')}}</label>
              <select class="form-control" name="per" id="per">
                <option <?php if($obj->per == 0){ echo 'selected'; } ?> value="0">{{__('main.user')}}</option>
                <option <?php if($obj->per == 1){ echo 'selected'; } ?>  value="1">{{__('main.admin')}}</option>
              </select>
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
              <label>{{__('main.amount')}}*</label>
              <input type="number" class="form-control" name="amount" value="{{$obj->amount}}">
              @error('amount')
                <div class="error">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label>{{__('main.buy_fee')}} (%)</label>
              <input type="number" class="form-control" name="buy_fee" value="{{$obj->buy_fee}}">
              @error('buy_fee')
                <div class="error">{{ $message }}</div>
              @enderror
            </div>


            <div class="form-group">
              <label>{{__('main.per_deposit')}} (%)</label>
              <input type="number" class="form-control" name="per_deposit" value="{{$obj->per_deposit}}">
              @error('per_deposit')
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

            <div class="form-group">
              <label>{{__('main.password')}}*</label>
              <input type="password" class="form-control" name="password" value="">
              @error('password')
                <div class="error">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label>{{__('main.repassword')}}*</label>
              <input type="password" class="form-control" name="password_confirmation" value="">
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">{{__('main.save_change')}}</button>
          </div>
        </form>
      </div>
@endsection