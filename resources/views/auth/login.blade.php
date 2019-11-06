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

@section('title_page',__('main.login'))

@section('content')

    <div class="login_section">
        
        <div class="login_section_overlay">
            <img src="{{asset('pictures/init/login-bg.jpg')}}" alt="">
        </div>

        <!-- login_form_wrapper -->
        <form  method="POST" action="{{ route('login') }}">
                @csrf
            <div class="login_form_wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <!-- login_wrapper -->
                            <div class="login_wrapper">
                                
                                <h1>Đăng nhập</h1>

                                <br>

                                <div class="form-group">
                                    <input placeholder={{__('main.email')}} id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            
                            
                                <div class="form-group">
                                    <input placeholder={{__('main.password')}} id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            
                                <div class="login_remember_box">
                                    <label class="control control--checkbox">{{__('main.remember_me')}}
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <span class="control__indicator"></span>
                                    </label>

                                    @if (Route::has('password.request'))
                                        <a class="forget_password" href="{{ route('password.request') }}">
                                            {{__('main.forgot_password')}} ?
                                        </a>
                                    @endif
                                </div>

                                <div class="login_btn">
                                    <button type="submit" class="btn btn-success login_btn btn-block"> 
                                        {{__('main.login')}} 
                                    </button>
                                    <br>
                                    {{-- <button type="button" class="btn btn-primary btn-block">
                                        <i style="margin-right: 10px" class="fa fa-facebook-square"></i>
                                        Tiếp tục với Facebook
                                    </button> --}}
                                </div>
                                
                                <br><br><br>

                                <div class="login_message">
                                    <p>{{__('main.no_account')}} <a href="{{url('register')}}"> {{__('main.signup')}} </a> </p>

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
