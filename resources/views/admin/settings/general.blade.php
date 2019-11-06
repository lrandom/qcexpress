@extends('layouts.admin')
@section('header',__('main.settings'))
@section('small_header',__('main.general'))
@section('content')

    <div id="main-wrapper">
        <!-- formOne section start -->
        <div class="formOne ptb-100">
            <div class="container">
                        <br>
                        <form action="general" method="post" enctype="multipart/form-data">
                            @csrf
                            @if(session('notify'))
                                <div class="alert alert-success">
                                    {{session('notify')}}
                                </div>
                            @endif
                            <div class="row">
                                <div class="form-group">
                                    <label>{{__('main.logo')}}</label>
                                    <div style="width: 120px; height: 120px; border: 1px solid #bebebe;">
                                        <img width="120px" height="120px" src="{{asset($general->logo)}}" alt="logo">
                                    </div>
                                    <br>
                                    <input type="file" placeholder="Logo" name="logo">
                                    <br>
                                    @if ($errors->has('logo'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('logo') }}
                                        </div>
                                    @endif
                                </div>
                                <br>
                                <div class="form-group">
                                    <label>{{__('main.site_name')}}</label>
                                    <input type="text" class="form-control"  placeholder="Site Name" name="site_name" value="{{$general->site_name}}">
                                    @if ($errors->has('site_name'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('site_name') }}
                                        </div>
                                    @endif
                                </div>
                                <br>
                                <div class="form-group">
                                    <label>{{__('main.author')}}</label>
                                    <input type="text" class="form-control"  placeholder="Author" name="author" value="{{$general->author}}">
                                    @if ($errors->has('author'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('author') }}
                                        </div>
                                    @endif
                                </div>
                                <br>
                                <div class="form-group">
                                    <label>{{__('main.keyword')}}</label>
                                    <input type="text" class="form-control"  placeholder="Keyword" name="keyword" value="{{$general->keyword}}">
                                    @if ($errors->has('keyword'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('keyword') }}
                                        </div>
                                    @endif
                                </div>
                                <br>
                                <div class="form-group">
                                    <label>{{__('main.about')}}</label>
                                    <textarea class="form-control tyni-edit" rows="7" placeholder="Type here" name="about">{{$general->about}}</textarea>
                                    @if ($errors->has('about'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('about') }}
                                        </div>
                                    @endif
                                </div>
                                <br>
                                <div class="form-group">
                                    <label>{{__('main.description')}}</label>
                                    <textarea class="form-control tyni-edit" rows="7" placeholder="Type here" name="description">{{$general->description}}</textarea>
                                    @if ($errors->has('description'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('description') }}
                                        </div>
                                    @endif
                                </div>
                                <br>
                                <div class="form-group">
                                    <label>{{__('main.currency_unit')}}</label>
                                    <input type="text" class="form-control"  placeholder="Currency Unit" name="currency_unit" value="{{$general->currency_unit}}">
                                    @if ($errors->has('currency_unit'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('currency_unit') }}
                                        </div>
                                    @endif
                                </div>
                                <br>
                                <div class="form-group">
                                    <label>{{__('main.exchange_rate_cn')}}</label>
                                    <input type="text" class="form-control"  placeholder="Exchange Rate CN" name="exchange_rate_cn" value="{{$general->exchange_rate_cn}}">
                                    @if ($errors->has('exchange_rate_cn'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('exchange_rate_cn') }}
                                        </div>
                                    @endif
                                </div>
                                <br>
                                <div class="form-group">
                                    <label>{{__('main.exchange_rate_us')}}</label>
                                    <input type="text" class="form-control"  placeholder="Exchange Rate USD" name="exchange_rate_us" value="{{$general->exchange_rate_us}}">
                                    @if ($errors->has('exchange_rate_us'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('exchange_rate_us') }}
                                        </div>
                                    @endif
                                </div>
                                <br>
                                <div class="form-group">
                                    <label>{{__('main.link_app_android')}}</label>
                                    <input type="text" class="form-control"  placeholder="Link App Android" name="link_app_android" value="{{$general->link_app_android}}">
                                    @if ($errors->has('link_app_android'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('link_app_android') }}
                                        </div>
                                    @endif
                                </div>
                                <br>
                                <div class="form-group">
                                    <label>{{__('main.link_app_ios')}}</label>
                                    <input type="text" class="form-control"  placeholder="Link App IOS" name="link_app_ios" value="{{$general->link_app_ios}}">
                                    @if ($errors->has('link_app_ios'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('link_app_ios') }}
                                        </div>
                                    @endif
                                </div>
                                <br>
                                <div class="form-group">
                                    <label>{{__('main.link_tool_chrome')}}</label>
                                    <input type="text" class="form-control"  placeholder="Link Tool Chrome" name="link_tool_chrome" value="{{$general->link_tool_chrome}}">
                                    @if ($errors->has('link_tool_chrome'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('link_tool_chrome') }}
                                        </div>
                                    @endif
                                </div>
                                <br>
                                <div class="form-group">
                                    <label>{{__('main.link_tool_coccoc')}}</label>
                                    <input type="text" class="form-control"  placeholder="Link Tool CocCoc" name="link_tool_coccoc" value="{{$general->link_tool_coccoc}}">
                                    @if ($errors->has('link_tool_coccoc'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('link_tool_coccoc') }}
                                        </div>
                                    @endif
                                </div>
                                <!-- /.col-md-6 -->
                                <br>
                                <a class="btn btn-danger" href="{{asset('admin/settings/default-general')}}">{{__('main.set_to_default')}}</a>
                                <button type="submit" class="btn btn-primary">{{__('main.save')}}</button>
                                <br>
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