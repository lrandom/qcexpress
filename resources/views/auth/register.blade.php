<link href="{{asset('public/css/login_and_register.css')}}" rel="stylesheet">
<!-- Common Style CSS -->
<link href="{{asset('public/css/styles.css')}}" rel="stylesheet">

<style>
    .login_section_overlay {
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }
    .login_section_overlay img{
        height: 100%;
        min-width: 100%;
    }
</style>


@extends('layouts.app')

@section('title_page',__('main.register'))

@section('content')

    <div class="login_section">
            <div class="login_section_overlay">
                <img src="{{asset('pictures/init/signup-bg.jpg')}}" alt="">
            </div>
            <!-- login_form_wrapper -->
            <form  method="POST" action="{{ route('register') }}">
                    @csrf
            <div class="login_form_wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <!-- login_wrapper -->

                            <div class="login_wrapper">

                                <div>
                                    <h1 style="float: left">Đăng kí</h1>
                                    <a style="float: right" href="{{asset('login')}}">{{ __('main.login') }}</a>
                                </div>
                                
                                <br><br><br><br>

                                <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('main.email') }}</label>
                                        <div class="col-md-8">
                                            <input placeholder="{{__('main.email')}}" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
            
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
            
                                <div class="form-group row">
                                        <label for="fullname" class="col-md-4 col-form-label text-md-right">{{ __('main.fullname') }}</label>
                                        <div class="col-md-8">
                                            <input placeholder="{{__('main.fullname')}}" id="fullname" type="text" class="form-control @error('fullname') is-invalid @enderror" name="fullname" value="{{ old('fullname') }}" required autocomplete="fullname" autofocus>
            
                                            @error('fullname')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                </div>
        
                                <div class="form-group row">
                                        <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('main.phone') }}</label>
                                        <div class="col-md-8">
                                            <input placeholder="{{__('main.phone')}}" id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" 
                                            required autocomplete="phone" autofocus>
            
                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
        
                                <div class="form-group row">
                                        <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('main.address') }}</label>
                                        <div class="col-md-8">
                                            <input placeholder="{{__('main.address')}}" id="address" type="address" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" 
                                            required autocomplete="address" autofocus>
                                            @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                </div>
        
                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('main.password') }}</label>
                                    <div class="col-md-8">
                                        <input placeholder="{{__('main.password')}}" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('main.repassword') }}</label>
                                    <div class="col-md-8">
                                        <input placeholder="{{__('main.repassword')}}" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>
                                
                                <br>

                                <div class="form-group row mb-0">
                                    <div class="col-sm-12 text-right">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('main.register') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- /.login_wrapper-->
                        </div>
                    </div>
                </div>
            </div>
        </form>
            <!-- /.login_form_wrapper-->
        </div>
@endsection
