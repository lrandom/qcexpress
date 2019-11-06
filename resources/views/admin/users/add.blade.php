@extends('layouts.admin')
@section('header',__('main.users'))
@section('small_header',__('main.add'))
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
              <input type="file" name="avatar">
            </div>

            <br>

            <div class="form-group">
              <label>{{__('main.level')}}</label>
              <select class="form-control" name="per" id="per">
                <option value="0">{{__('main.user')}}</option>
                <option value="1">{{__('main.admin')}}</option>
              </select>
            </div>

            <div class="form-group">
              <label>{{__('main.fullname')}}*</label>
              <input type="text" class="form-control" name="fullname" value="{{old('fullname')}}">
              @error('fullname')
                <div class="error">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label>{{__('main.email')}}*</label>
              <input type="text" class="form-control" name="email" value="{{old('email')}}">
              @error('email')
                <div class="error">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label>{{__('main.phone')}}*</label>
              <input type="text" class="form-control" name="phone" value="{{old('phone')}}">
              @error('phone')
                <div class="error">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label>{{__('main.amount')}}*</label>
              <input type="number" class="form-control" name="amount" value="0">
              @error('amount')
                <div class="error">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label>{{__('main.buy_fee')}} (%)</label>
              <input type="number" class="form-control" name="buy_fee" value="50">
              @error('buy_fee')
                <div class="error">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label>{{__('main.per_deposit')}} (%)</label>
              <input type="number" class="form-control" name="per_deposit" value="50">
              @error('per_deposit')
                <div class="error">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label>{{__('main.address')}}*</label>
              <input type="text" class="form-control" name="address" value="{{old('address')}}">
              @error('address')
                  <div class="error">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label>{{__('main.password')}}*</label>
              <input type="password" class="form-control" name="password" value="{{old('password')}}">
              @error('password')
                <div class="error">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label>{{__('main.repassword')}}*</label>
              <input type="password" class="form-control" name="password_confirmation" value="{{old('password_confirmation')}}">
            </div>

          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">{{__('main.add')}}</button>
          </div>
        </form>
      </div>
@endsection