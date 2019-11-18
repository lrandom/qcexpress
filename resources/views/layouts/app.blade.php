<!DOCTYPE html>
<html lang="en" class=" js csstransforms csstransforms3d csstransitions">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>
            {{-- @yield('title_page',__('main.orders')) --}}
            Quảng Châu Express
        </title>

        <!-- Place favicon.ico in the root directory -->
        <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/favicon.png')}}">
    
        <!-- font-awesome -->
        <link href="{{asset('public/bower_components/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
        <link href="{{asset('public/assets/css/fonts.css')}}" rel="stylesheet">
        <!-- Bootstrap -->
        <link href="{{asset('public/bower_components/bootstrap/dist/css/bootstrap.min.css')}} " rel="stylesheet">
        <!-- Animation Css -->
        {{-- <link href="{{asset('public/assets/css/animate.css')}}" rel="stylesheet"> --}}
        <!-- Revolution slider Css -->
        {{-- <link rel="stylesheet" type="text/css" href="{{asset('public/assets/js/plugin/rs_slider/layers.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('public/assets/js/plugin/rs_slider/navigation.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('public/assets/js/plugin/rs_slider/settings.css')}}"> --}}
        <!-- Owl Carousel -->
        {{-- <link href="{{asset('public/assets/css/owl.theme.default.css')}}" rel="stylesheet">
        <link href="{{asset('public/assets/css/owl.carousel.css')}}" rel="stylesheet"> --}}
        <!-- Magnific Popup Css -->
        {{-- <link href="{{asset('public/assets/css/magnific-popup.css')}}" rel="stylesheet"> --}}
        <!-- Style Css -->
        <link href="{{asset('public/css/app.css')}}" rel="stylesheet">
        <link href="{{asset('public/assets/css/homepage_style_2.css')}}" rel="stylesheet">
        <link href="{{asset('public/assets/css/blog.css')}}" rel="stylesheet">
        {{--<link href="{{asset('public/assets/css/blog_single_3.css')}}" rel="stylesheet">--}}
        {{--<link href="{{asset('public/assets/css/elements.css')}}" rel="stylesheet">--}}
        {{-- <link href="{{asset('public/assets/css/page_header.css')}}" rel="stylesheet"> --}}
    </head>
    
    <body>

        @php
            use App\GeneralSettings;
            use App\ContactSettings;
            use App\PostCategories;
            use App\Posts;

            $recent_post = Posts::limit(5)->orderBy('id', 'DESC')->inRandomOrder()->get();
            $new_post = Posts::limit(2)->orderBy('id', 'DESC')->get();

            $general = GeneralSettings::first();
            $contact = ContactSettings::first();
            $cat = PostCategories::orderBy('id', 'DESC')->get();
        @endphp
    
        <a href="javascript:" id="return-to-top" style="display: none;"><i class="fa fa-angle-up"></i></a>
    
        <!-- Preloader -->
        <div id="preloader" style="display: none;">
            <div id="status" style="display: none;">
                <div class="status-mes"></div>
            </div>
        </div>
    
        <!-- header start -->
        <div class="header">
            <div class="top-bar">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                            <div class="contact_info_wrapper">
                                <ul>
                                    <li>{{__('main.exchange_rate')}} 1 NDT = {{formatVND($general->exchange_rate_cn)}}</li>
                                    <li>{{__('main.exchange_rate')}}1 USD = {{formatVND($general->exchange_rate_us)}}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                            <!-- signin_and_social_icon_wrapper -->
                            <div class="signin_and_social_icon_wrapper">
                                <ul>
                                    <li class="social_icon_wrapper hidden-xs">
                                        <ul>
                                            <li><a href="{{$contact->facebook}}"><i class="fa fa-facebook-square"></i></a></li>
                                            <li><a href="{{$contact->instagram}}"><i class="fa fa-instagram"></i></a></li>
                                        </ul>
                                    </li>
                                    <!-- Cart Option -->

                                    @guest
                                        <li>
                                            <i class="fa fa-sign-in"></i>
                                            <a href="{{asset('login')}}" class="dropdown-toggle">
                                                {{__('main.login')}}
                                            </a>
                                            /
                                            <a href="{{asset('register')}}" class="dropdown-toggle">
                                                {{__('main.register')}}
                                            </a>
                                        </li>
                                    @endauth

                                    @auth
                                        <li class="dropdown signin_wrapper">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class="fa fa-sign-in"></i> Xin chào {{Auth::user()->email}}
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li class="signin_dropdown">
                                                    <a href="{{URL::to('users/account')}}">Tài khoản</a>
                                                    <a href="{{asset('users/orders/-1')}}">Đến phần quản lý đơn hàng</a>
                                                    <a href="{{asset('users/password')}}">{{__('main.password')}}</a>
                                                    <a href="{{asset('users/logout')}}">Thoát</a>
                                                </li>
                                            </ul>
                                        </li>
                                    @endauth
                                    <!-- /.Cart Option -->
                                </ul>
                            </div>
                            <!-- /.signin_and_social_icon_wrapper end -->
                        </div>
                    </div>
                </div>
                <!-- /.container -->
            </div>
            <div class="main_menu_wrapper hidden-xs hidden-sm">
                <nav class="navbar mega-menu navbar-default">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="container">
                        <div class="navbar-header hidden-xs hidden-sm">
                            <a class="navbar-brand" href="{{asset('/')}}">
                                <img width="250px" height="80px" src="{{asset($general->logo)}}" alt="">
                            </a>
                        </div>
                        <!-- Collect the nav links, forms, and other content for toggling -->

                        <?php 
                            $cl_url = url()->full();
                        ?>

                        <div class="collapse navbar-collapse">
                            <ul class="nav navbar-nav navbar-right">
                                <li class="<?php if($cl_url == asset('home') || $cl_url == asset('/')){ echo 'active'; }?>">
                                    <a href="{{asset('home')}}">{{__('main.home')}}</a>
                                </li>
                                <li class="<?php if($cl_url == asset('gioi-thieu')){ echo 'active'; }?>">
                                    <a href="{{asset('gioi-thieu')}}">{{__('main.about')}}</a>
                                </li>
                                <li class="<?php if($cl_url == asset('huong-dan')){ echo 'active'; }?>">
                                    <a href="{{asset('huong-dan')}}">{{__('main.document_order')}}</a>
                                </li>
                                @foreach ($cat as $item)
                                    <li class="<?php if(\Request::segment(2) == $item->name){ echo 'active'; }?>">
                                        <a href="{{asset('bai-viet/'.$item->name.'?id='.$item->id)}}">{{$item->name}}</a>
                                    </li>    
                                @endforeach
                                <li class="<?php if($cl_url == asset('chinh-sach')){ echo 'active'; }?>">
                                    <a href="{{asset('chinh-sach')}}">{{__('main.policy')}}</a>
                                </li>
                                <!-- /.Cart Option -->
                            </ul>
    
                        </div>
                        <!-- /.navbar-collapse -->
                    </div>
                    <div class="bottom-menu">
                        <div class="container sdt-support">
                            <div class="elm-phone">
                                <i class="fa fa-phone"></i> Hỗ trợ đặt hàng: {{$contact->main_phone}}
                            </div>

                            @if ($contact->phone != null)
                                @foreach ($contact->phone as $item)
                                    @if($item['name'] != null)
                                        <div class="elm-phone text-center">
                                            <i class="fa fa-phone"></i> {{$item['name']}}: {{$item['value']}}
                                        </div>
                                    @endif
                                @endforeach
                            @endif

                            <div class="elm-phone text-right">
                                <i class="fa fa-phone"></i> Hot line: {{$contact->hotline}}
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <!-- .site-nav -->
            <div class="mobail_menu_main visible-xs visible-sm">
                <div class="navbar-header">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                                <a class="navbar-brand" href="index.html">
                                    <img src="{{asset($general->logo)}}" alt="">
                                </a>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                                <button type="button" class="navbar-toggle collapsed" aria-expanded="false">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="sidebar">
                    <a class="sidebar_logo" href="index.html"><img src="images/logo.png" alt=""></a>
                    <div id="toggle_close">×</div>
                    <br><br>
                    <div id="cssmenu">
                        <ul>
                            <li class="has-sub active">
                                <a href="{{asset('/')}}">{{__('main.home')}}</a>
                            </li>
                            <li class="has-sub">
                                <a href="{{asset('gioi-thieu')}}">{{__('main.about')}}</a>
                            </li>
                            <li class="has-sub">
                                <a href="{{asset('huong-dan')}}">{{__('main.document_order')}}</a>
                            </li>
                            @foreach ($cat as $item)
                                <li class="has-sub">
                                    <a href="{{asset('bai-viet/'.$item->name.'?id='.$item->id)}}">{{$item->name}}</a>
                                </li>    
                            @endforeach
                            <li class="has-sub">
                                <a href="{{asset('chinh-sach')}}">{{__('main.policy')}}</a>
                            </li>
                            <li class="has-sub">
                                <a href="#"><i class="fa fa-phone"></i> Hỗ trợ đặt hàng: {{$contact->main_phone}}</a>
                            </li>
                            @if ($contact->phone != null)
                                @foreach ($contact->phone as $item)
                                    @if($item['name'] != null)
                                        <li class="has-sub"><a href="#"><i class="fa fa-phone"></i> {{$item['name']}}: {{$item['value']}}</a></li>
                                    @endif
                                @endforeach
                            @endif
                            <li class="has-sub">
                                <a href="#"><i class="fa fa-phone"></i> Hot line: {{$contact->hotline}}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- header end -->


        @section('article')

        @show()
        <hr>


        {{--article--}}
        {{-- <div class="blogone ptb-100">
            <div class="container">
                <div class="row">
                    @foreach($posts as $l)
                        <div class="col-md-4">
                            <article class="blog-post-wrapper clearfix">
                                <div class="post-thumbnail">
                                    <img src="assets/images/blog/blog-1/blog-1.jpg" class="img-responsive " alt="Image">

                                </div>
                                <!-- /.post-thumbnail -->

                                <div class="blog-content">
                                    <header class="entry-header">
                                        <h4 class="entry-title"><a href="{{asset('posts/post-details/')}}/{{$l->id}}">{{$l->title}}</a></h4>
                                        <div class="entry-meta">
                                            <ul>
                                                <li><span class="author">Posts Categories <a href="#">
                                                    @foreach($post_cate as $p)
                                                                @if($p->id == $l->id_categories)
                                                                    {{$p->name}}
                                                                @endif
                                                            @endforeach
                                                </a></span>
                                                </li>
                                                <li><span class="posted-in">Description: <a href="#">{{$l->description}}</a></span>
                                                </li>
                                                <li><span class="posted-in">Keyword <a href="#">{{$l->keyword}}</a></span>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- /.entry-meta -->
                                    </header>
                                    <!-- /.entry-header -->

                                    <div class="entry-content">
                                        <p>{!! substr(strip_tags(htmlspecialchars_decode($l->contents)), 0, 150) !!}</p>
                                    </div>
                                    <!-- /.entry-content -->
                                </div>
                                <!-- /.blog-content -->

                            </article>
                        </div>
                    @endforeach
                </div>
                <!-- /.row -->
                {{$posts->links()}}
            </div>
        </div> --}}
        {{--end article--}}


        @section('content')

        @show
        




         <!-- footer start -->
    <div class="footer">
            <div class="footer_wrapper_second">
                <div class="container">
                    <div class="row">
                        
                        <div class="col-md-4 col-xs-12">
                            <div class="wrapper_second_about">
                                <h4>{{__('main.about_us')}}</h4>
                                <div class="abotus_content">
                                    <p>{!! $general->about !!}</p>
                                </div>
                                {{-- <div class="aboutus_link">
                                    <a href="{{asset('bai-viet/')}}">{{__('main.read_more')}}<i class="fa fa-caret-right" aria-hidden="true"></i></a>
                                </div> --}}
                                <ul class="aboutus_social_icons">
                                    <li><a href="{{$contact->facebook}}"><i class="fa fa-facebook"></i></a></li>
                                    <li> <a href="{{$contact->instagram}}"><i class="fa fa-instagram" aria-hidden="true"></i> </a> </li>
                                </ul>
                            </div>
                        </div>

                      
                        <div class="col-md-4 col-xs-12">
                            <div class="wrapper_second_useful">
                                <h4>{{__('main.useful_link')}}</h4>
                                <ul>
                                    @foreach ($recent_post as $item)
                                        <li><a href="{{asset('bai-viet/chi-tiet/'.$item->id)}}"><i class="fa fa-caret-right" aria-hidden="true"></i>{{$item->title}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        {{-- <div class="col-lg-3 col-md-6 col-xs-12 col-sm-6">
                            <div class="wrapper_second_blog">
                                <h4>{{__('main.from_the_blog')}}</h4>
                                
                                @foreach ($new_post as $item)
                                    <div class="blog_wrapper1">
                                        <div class="blog_image">
                                            <img src="{{asset($item->thumb)}}" class="img-responsive" alt="blog-img1_img">
                                        </div>
                                        <div class="blog_text">
                                            <h5><a href="{{asset('bai-viet/chi-tiet/'.$item->id)}}">{{$item->title}}</a></h5>
                                            <div class="blog_date"><i class="fa fa-calendar-o" aria-hidden="true"></i>{{$item->created_at}}</div>
                                        </div>
                                    </div>
                                @endforeach
    
                            </div>
                        </div> --}}

                        <div class="col-md-4 col-xs-12">
                            <div class="wrapper_second_contact">
                                <h4>{{__('main.contact_us')}}</h4>
                                <ul>
                                    <li><i class="fa fa-map-marker"></i>
                                        <p>{{$contact->address}}</p>
                                    </li>
                                    <li><i class="fa fa-phone"></i>
                                        <a href="tel:{{$contact->main_phone}}">{{$contact->main_phone}}</a>
                                    </li>
                                    <li><i class="fa fa-envelope"></i><a href="mailto:{{$contact->main_email}}">{{$contact->main_email}}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer end -->
    
        <!-- copyright_wrapper start -->
        <div class="copyright_wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                        <div class="copyright_content">
                            <p>© Copyright 2018-19 by <a href=""> Quang Chau Express </a> - all right reserved</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    
        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
    
        <!-- Bootstrap js -->
        <script src="{{asset('public/bower_components/jquery/dist/jquery.min.js')}}"></script>
        <script src="{{asset('public/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
        <!-- Revolution Slider js -->
        {{-- <script src="{{asset('public/assets/js/jquery.min.js')}}"></script>
        <script src="{{asset('public/assets/js/bootstrap.min.js')}}"></script> --}}
        {{-- <script src="{{asset('public/assets/js/plugin/rs_slider/jquery.themepunch.revolution.min.js')}}"></script>
        <script src="{{asset('public/assets/js/plugin/rs_slider/jquery.themepunch.tools.min.js')}}"></script>
        <script src="{{asset('public/assets/js/plugin/rs_slider/revolution.addon.snow.min.js')}}"></script>
        <script src="{{asset('public/assets/js/plugin/rs_slider/revolution.extension.actions.min.js')}}"></script>
        <script src="{{asset('public/assets/js/plugin/rs_slider/revolution.extension.carousel.min.js')}}"></script>
        <script src="{{asset('public/assets/js/plugin/rs_slider/revolution.extension.kenburn.min.js')}}"></script>
        <script src="{{asset('public/assets/js/plugin/rs_slider/revolution.extension.layeranimation.min.js')}}"></script>
        <script src="{{asset('public/assets/js/plugin/rs_slider/revolution.extension.migration.min.js')}}"></script>
        <script src="{{asset('public/assets/js/plugin/rs_slider/revolution.extension.navigation.min.js')}}"></script>
        <script src="{{asset('public/assets/js/plugin/rs_slider/revolution.extension.parallax.min.js')}}"></script>
        <script src="{{asset('public/assets/js/plugin/rs_slider/revolution.extension.slideanims.min.js')}}"></script>
        <script src="{{asset('public/assets/js/plugin/rs_slider/revolution.extension.video.min.js')}}"></script> --}}

        <!-- Portfolio Filter js -->
        {{-- <script src="{{asset('public/assets/js/jquery.shuffle.min.js')}}"></script>
        <script src="{{asset('public/assets/js/jquery.inview.min.js')}}"></script>
        <!-- Counter Pie Chart js -->
        <script src="{{asset('public/assets/js/jquery.easypiechart.min.js')}}"></script>
        <!-- Magnific Popup js -->
        <script src="{{asset('public/assets/js/jquery.magnific-popup.js')}}"></script>
        <!-- Owl Carousel js -->
        <script src="{{asset('public/assets/js/owl.carousel.js')}}"></script>
        <!-- wow js -->
        <script src="{{asset('public/assets/js/wow.js')}}"></script>
        <!-- portfolio filter js -->
        <script src="{{asset('public/assets/js/portfolio.js')}}"></script>
        <!-- homepage js -->
        <script src="{{asset('public/assets/js/homepage.js')}}"></script>
        <!-- Custom js -->
        <script src="{{asset('public/assets/js/custom.js')}}"></script> --}}
        {{--TinyMCE--}}
        {{-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <script>tinymce.init({selector:'textarea'});</script> --}}
    </body></html>