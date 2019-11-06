@extends('layouts.admin')
@section('header',__('main.users'))
@section('small_header',__('main.password'))
@section('content')
    <br>
    <div class="box box-primary">
        <!-- form start -->
        <form role="form" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- {{dd($obj)}} --}}
            <div class="box-body">
                <div class="form-group">
                    <label>{{__('main.password')}}*</label>
                    <input type="password" class="form-control" name="old_password" value="">
                    @error('old_password')
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