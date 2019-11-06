<style>
    *{
        font-family: Arial, Helvetica, sans-serif;
    }
    .card-header{
        font-size: 30px;
        font-weight: 900;
    }
    .container{
        display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    }
    .label{
        width: 100%;

    }
    .form-control{
        width: 100%;
    height: 30px;
    border: none;
    background: #ebebeb;
    border-radius: 5px;
    }
</style>

<link rel="stylesheet" href="{{asset('public/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('public/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Theme style -->

  <link href="{{asset('public/css/styles.css')}}" rel="stylesheet">
  
  <link rel="stylesheet" href="{{asset('public/adminlte/css/AdminLTE.min.css')}}">

  <link rel="stylesheet" href="{{asset('public/adminlte/css/skins/skin-purple.min.css')}}">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,600i&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{asset('public/bower_components/datetimepicker/build/jquery.datetimepicker.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/css/user.css')}}"/>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('main.login') }}</div>
                <br>
                <br>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="email" class="col-12 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-12 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <br>

                        <div class="form-group row mb-0">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- @endsection --}}
