@extends('layouts.app')

@section('content')
<div class="container">
    <br>
    <br><br><br><br>
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="font-size: 14px;">Xác nhận địa chỉ email của bạn</div>

                <div class="card-body" style="font-size: 14px;">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    Trước khi tiếp tục, vui lòng kiểm tra email của bạn để biết liên kết xác minh. Nếu bạn không nhận được email, 
                    <a href="{{ route('verification.resend') }}">nhấn vào đây để yêu cầu gửi xác nhận mới</a>.
                </div>
            </div>
        </div>
    </div>

    <br>
    <br><br><br><br>
    <br>
    <br><br><br><br>
    
</div>
@endsection
