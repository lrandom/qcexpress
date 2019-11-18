@extends('layouts.app')

@section('article')
<div class="post-detail">
    <div class="page_header">
            <br><br><br>
            <br><br><br>
            <br>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-xs-12 col-sm-6">
                    <h1>Bài viết</h1>
                </div>
                <div class="col-lg-4 col-md-4 col-xs-12 col-sm-6">
                    <div class="sub_title_section text-right">
                        <ul class="sub_title text-right">
                            <li><a href="#"> Trang chủ </a> <i class="fa fa-angle-right" aria-hidden="true"></i> </li>
                            <li>Bài viết <i class="fa fa-angle-right" aria-hidden="true"> </i> </li>
                            <li>Chi tiết bài viết</li>
                        </ul>
                    </div>
                </div>
            </div>
            <hr>
        </div>
    </div>

    <!-- blog_section start -->
    <br>
    <br>

        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                    <article class="blog-post-wrapper clearfix">
                        <div class="post-thumbnail">
                            <img src="{{asset($post->thumb)}}" class="img-responsive " alt="Image">
                        </div>
                        <!-- /.post-thumbnail -->

                        <div class="blog-content">
                            <header class="entry-header">
                                <br>
                                <br>
                                
                                <h4 class="entry-title" style="font-weight: bold; font-size: 24px;">{{$post->title}}</h4>
                                <br>
                                <div class="entry-meta">
                                    <ul>
                                        <li><span class="author">Danh mục: <a href="#">
                                                    @foreach($post_cate as $p)
                                                        @if($p->id == $post->id_categories)
                                                            {{$p->name}}
                                                        @endif
                                                    @endforeach
                                                </a></span>
                                        </li>
                                        <li><span class="posted-in">Keyword <a href="#">{{$post->keyword}}</a></span>
                                        </li>
                                        <br>
                                        <li><span class="posted-date" style="font-weight: bold">{{$post->description}}</span>
                                        </li>
                                    </ul>
                                </div>
                                <!-- /.entry-meta -->
                            </header>
                            <!-- /.entry-header -->
                            <br><br>
                            <div class="entry-content">
                                <p> <?php echo htmlspecialchars_decode($post->contents)?></p>
                            </div>
                            <!-- /.entry-content -->

                        </div>
                        <!-- /.blog-content -->
                    </article>
                </div>
            </div>
    </div>
</div>
@endsection