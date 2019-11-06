@extends('layouts.admin')
@section('header',__('main.settings'))
@section('small_header',__('main.services'))
@section('content')
    <div id="main-wrapper">
        <!-- formOne section start -->
        <div class="formOne ptb-100">
            <div class="container">
                        <br>
                        <form action="services" method="post" enctype="multipart/form-data">
                            @csrf
                            @if(session('notify'))
                                <div class="alert alert-success">
                                    {{session('notify')}}
                                </div>
                            @endif
                            <div class="row">
                                <div class="form-group">
                                    <label>{{__('main.about')}}</label>
                                    <textarea class="form-control tyni-edit" rows="7"  placeholder="Type here" name="about">{{$services->about}}</textarea>
                                    @if ($errors->has('about'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('about') }}
                                        </div>
                                    @endif
                                </div>
                                <br>
                                <div class="form-group">
                                <label>{{__('main.how_to_buy')}}</label>
                                    <textarea class="form-control tyni-edit" rows="7"  placeholder="Type here" name="how_to_buy">{{$services->how_to_buy}}</textarea>
                                    @if ($errors->has('how_to_buy'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('how_to_buy') }}
                                        </div>
                                    @endif
                                </div>
                                <br>
                                <div class="form-group">
                                    <label>{{__('main.regulations_&_policies')}}</label>
                                    <textarea class="form-control tyni-edit" rows="7" placeholder="Type here" name="policy">{{$services->policy}}</textarea>
                                    @if ($errors->has('policy'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('policy') }}
                                        </div>
                                    @endif
                                </div>
                                <br>
                                <div class="form-group">
                                    <label>{{__('main.tariff')}}</label>
                                    <input class="form-control" name="tariff" value="{{$services->tariff}}">
                                    @if ($errors->has('tariff'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('tariff') }}
                                        </div>
                                    @endif
                                </div>
                                <!-- /.col-md-6 -->
                                <br>
                                <a class="btn btn-danger" href="{{asset('admin/settings/default-services')}}">{{__('main.set_to_default')}}</a>
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