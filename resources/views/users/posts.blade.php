@extends('layouts.app')

@section('content')
    <div class="banner-blog">
        <img src="{{asset('pictures/init/blog.jpg')}}" alt="">
    </div>
    <div class="blogone ptb-100 blog-page">
        <div class="container">
            <div class="">
                <br>
                <h2 style="text-align: center; text-transform: uppercase; font-weight: bold; font-size: 20px;">{{$post_cate[0]->name}}</h2>
                <br>
                <p style="text-align: center">Đây là các bài viết mà chúng tôi muốn bạn đọc kĩ để hiểu hơn về các đặt hàng <br> nhằm đưa ra quyết định đúng và tránh những rủi ro.</p>
                <br>
                <br>
                <br>
            </div>
            <div class="row">
                @foreach($list as $l)
                <div class="col-md-4">
                    <article class="blog-post-wrapper clearfix">
                        <div class="post-thumbnail">
                            <img src="{{asset($l->thumb)}}" class="img-responsive " alt="Image">
                        </div>
                        <!-- /.post-thumbnail -->

                        <div class="blog-content">
                            <header class="entry-header">
                                <h4 class="entry-title"><a href="chi-tiet/{{$l->id}}">{{$l->title}}</a></h4>
                                <div class="entry-meta">
                                    <ul>
                                        <li>
                                            <span class="posted-in">{{__('main.keyword')}}: <a href="#">{{$l->keyword}}</a></span></li>
                                            <br>
                                        <li>
                                            <br>
                                            <span class="posted-in">{{__('main.description')}}: <a href="#">{{$l->description}}</a></span>
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
            {{$list->links()}}
        </div>
    </div>
@endsection