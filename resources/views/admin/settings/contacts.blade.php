@extends('layouts.admin')
@section('header',__('main.settings'))
@section('small_header',__('main.contacts'))
@section('content')

    <div id="main-wrapper">
        <!-- formOne section start -->
        <div class="formOne ptb-100">
            <div class="container">
                        <br>
                        <form action="contacts" method="post" id="form1" >
                            @csrf
                            @if(session('notify'))
                                <div class="alert alert-success">
                                    {{session('notify')}}
                                </div>
                            @endif
                            <div class="row">
                                <div class="form-group">
                                    <label>{{__('main.facebook')}}</label>
                                    <input type="text" class="form-control"  placeholder="Facebook" name="facebook" value="{{$contacts->facebook}}">
                                    @if ($errors->has('facebook'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('facebook') }}
                                        </div>
                                    @endif
                                </div>
                                <br>
                                <div class="form-group">
                                    <label>{{__('main.instagram')}}</label>
                                    <input type="text" class="form-control"  placeholder="Instagram" name="instagram" value="{{$contacts->instagram}}">
                                    @if ($errors->has('instagram'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('instagram') }}
                                        </div>
                                    @endif
                                </div>
                                <br>
                                <div class="form-group">
                                    <label>{{__('main.address')}}</label>
                                    <input type="text" class="form-control"  placeholder="Address" name="address" value="{{$contacts->address}}">
                                    @if ($errors->has('address'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('address') }}
                                        </div>
                                    @endif
                                </div>
                                <br>
                                <div class="form-group">
                                    <label>{{__('main.hotline')}}</label>
                                    <input type="number" class="form-control"  placeholder="Hotline" name="hotline" value="{{$contacts->hotline}}">
                                    @if ($errors->has('hotline'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('hotline') }}
                                        </div>
                                    @endif
                                </div>
                                <br>
                                <div class="form-group">
                                    <label>{{__('main.main_email')}}</label>
                                    <input type="text" class="form-control"  placeholder="Main Email" name="main_email" value="{{$contacts->main_email}}">
                                    @if ($errors->has('main_email'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('main_email') }}
                                        </div>
                                    @endif
                                </div>


                                <br>


                                <div class="form-group">
                                    <label>{{__('main.sub_email')}}</label>
                                    @for ($i=0; $i < 10; $i++)
                                    <div class="row">

                                        <div class="col-md-4">
                                            <input type="text" class="form-control"  placeholder="Email Name {{$i+1}}" name="email[{{ $i }}][name]" value="{{ $contacts->email[$i]['name'] ?? '' }}"><br>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control"  placeholder="Email {{$i+1}}" name="email[{{ $i }}][value]" value="{{ $contacts->email[$i]['value'] ?? '' }}"><br>

                                        </div>
                                    </div>
                                    @endfor
                                    @if ($errors->has('email'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('email') }}
                                        </div>
                                    @endif
                                </div>
                                
                                
                                
                                <br>


                                <div class="form-group">
                                    <label>{{__('main.main_phone')}}</label>
                                    <input type="number" class="form-control"  placeholder="Main Phone" name="main_phone" value="{{$contacts->main_phone}}">
                                    @if ($errors->has('main_phone'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('main_phone') }}
                                        </div>
                                    @endif
                                </div>
                                <br>
                                <div class="form-group">
                                    <label>{{__('main.sub_phone')}}</label>
                                    @for ($j=0; $j < 10; $j++)
                                        <div class="row">
                                            <div class="col-md-4">
                                                <input type="text" class="form-control"  placeholder="Phone Name {{$j+1}}" name="phone[{{ $j }}][name]" value="{{ $contacts->phone[$j]['name'] ?? '' }}"><br>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="number" class="form-control"  placeholder="Number {{$j+1}}" name="phone[{{ $j }}][value]" value="{{ $contacts->phone[$j]['value'] ?? '' }}"><br>
                                            </div>
                                        </div>
                                    @endfor
                                    @if ($errors->has('phone'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('phone') }}
                                        </div>
                                    @endif
                                </div>

                                <a class="btn btn-danger" href="{{asset('admin/settings/default-contacts')}}">{{__('main.set_to_default')}}</a>
                                <button type="submit" class="btn btn-primary">{{__('main.save')}}</button>

                                <br>
                                <br>
                                
                            </div>
                            <!-- /.row-->
                        </form>

            </div>
            <!-- /.container -->
        </div>
        <!-- formOne section end -->

    </div>

@endsection