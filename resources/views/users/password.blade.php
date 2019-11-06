@extends('layouts.user')

@section('header',__('main.account'))
@section('small_header',__('main.update_password'))

@section('content')
  <div class="col-md-12">

    <div class="box box-info">
      
        <form role="form" method="POST" enctype="multipart/form-data" class="form-horizontal">
            @csrf

            <div class="box-body">

                <div class="form-group">
                    <label for="old_password" class="col-sm-2 control-label">{{__('main.old_password')}}</label>
                    <div class="col-sm-10">
                    <input type="password" class="form-control" value="" name="old_password" id="old_password" placeholder="{{__('main.old_password')}}">
                    @error('fullname')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="col-sm-2 control-label">{{__('main.password')}}</label>
                    <div class="col-sm-10">
                    <input type="password" class="form-control" value="" name="password" id="password" placeholder="{{__('main.password')}}">
                    @error('password')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="col-sm-2 control-label">{{__('main.password_confirmation')}}</label>
                    <div class="col-sm-10">
                    <input type="password" class="form-control" value="" name="password_confirmation" id="password_confirmation" placeholder="{{__('main.password_confirmation')}}">
                    @error('password_confirmation')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    </div>
                </div>

                <br>

                <div class="form-group">
                    <label class="col-sm-2"></label>
                    <div class="col-sm-10">
                        @if (session('status'))
                            <div class=“alert alert-success”>
                                {{ session('status') }}
                            </div>
                            <br/>
                        @endif
                        <button type="submit" class="btn btn-primary">{{__('main.update')}}</button>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>

@endsection
