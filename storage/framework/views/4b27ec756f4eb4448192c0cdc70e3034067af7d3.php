<?php $__env->startSection('header',__('main.users')); ?>
<?php $__env->startSection('small_header',__('main.add')); ?>

<?php $__env->startSection('content'); ?>

<div class="testimonial_section banner">
    
    <div class="testimonial_section_overlay"></div>
        <div class="testimonial_info">
            <div class="carousel slide" data-ride="carousel" id="testimonial_carousel_banner">

                <div class="carousel-inner text-center">

                    <div class="item active">
                        <div class="thumb-img">
                          <h5 style="color:white;text-transform:uppercase;font-size:20px">Quảng Châu Express</h5><br>
                          <h5 style="color:white;text-transform:uppercase;font-size:40px">Đặt hàng Trung Quốc </h5><br>
                          <h6 style="color:white;text-transform:uppercase;font-size:30px">Uy tín - tốc độ - chính xác</h6>
                        </div>
                    </div>
                    <!-- Quote 3 -->
                </div>
            </div>
        </div>
    </div>

    <style>
    .testimonial_section .thumb-img {
    height: 500px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background: #0000007a;
}
.add-on a{
    margin-right: 30px;
    color: #ffffff;
    font-weight: 500;
    border-radius: 100px;
    border: 1px solid rgba(255,255,255,0.7);
    overflow: auto;
    display: inline-block;
    padding: 10px 20px;
    text-align: center;
    text-transform: uppercase;
    font-weight: bold;
}
    </style>

    <div class="section_2 add-on" >
        <div class="container">
            <div class="row">
                <div class="col-sm-5">
                    <div class="page_header_title">
                        <h3 style="color:white"><?php echo e(__('main.support_order')); ?>: <?php echo e($contact->main_phone); ?></h3>
                    </div>
                </div>
                <div class="col-sm-7 text-right" style="padding-top:5px">
                    <a href="<?php echo e(asset($general->link_tool_chrome)); ?>" target="_blank">
                        <img src="<?php echo e(asset('pictures/init/chrome.png')); ?>" alt="">
                        <span><?php echo e(__('main.link_tool_chrome')); ?></span>
                    </a>
                    <a href="<?php echo e(asset($general->link_tool_coccoc)); ?>" target="_blank">
                        <img src="<?php echo e(asset('pictures/init/coccoc.png')); ?>" alt="">
                        <span><?php echo e(__('main.link_tool_coccoc')); ?></span>
                    </a>
                </div>
            </div>
        </div>
    </div>

     
    <br>
    <br>

    <br>
  
    <div class="container cam-ket-box box" style="margin-top:20px">
        <h4 class="text-center heading-main">Dịch vụ vận chuyển uy tín và tốc độ</h4>
        <br><br><br>
        <div class="row">
            <div class="col-md-4 col-xs-12 cam-ket">
                <div class="inner">
                <h5>Cuớc vận chuyển siêu thấp</h5>
                <p>Chỉ 23.000/kg</p>
                <img src="<?php echo e(asset('public/pictures/init/truck.png')); ?>"/>
                </div>
            </div>

            <div class="col-md-4 col-xs-12 cam-ket">
                <div class="inner">
                <h5>Vận chuyển siêu nhanh</h5>
                <p>Chỉ từ 2-4 ngày</p>
                <img src="<?php echo e(asset('public/pictures/init/stopclock.png')); ?>"/>
                </div>
            </div>

            <div class="col-md-4 col-xs-12 cam-ket">
                <div class="inner">
                <h5>Không cần đặt cọc</h5>
                <p>Đối với khách hàng thân thiết</p>
                <img src="<?php echo e(asset('public/pictures/init/money.png')); ?>"/>
                </div>
            </div>
        </div>
    </div>
  
    <div class="container-fluid bg" style="background:url('https://images.unsplash.com/photo-1542435503-956c469947f6?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&w=1000&q=80');background-size:cover">
            <div class="inner"></div>
        </div>

        <br>
    <div class="container cam-ket-box box quy-trinh" style="margin-top:20px">
            <h4 class="text-center heading-main">Quy trình đặt hàng</h4>
            <br><br><br>
            <div class="row">
                <div class="col-md-2 col-xs-12 cam-ket">
                    <div >
                    <div class="circle">
                        <img src="<?php echo e(asset('public/pictures/init/online-shop-5.png')); ?>"/>
                    </div>
                    <h5>Buớc 1</h5>
                    <p>Chọn hàng tại các website trung quốc</p>
                    </div>
                </div>
                <div class="col-md-2 col-xs-12 cam-ket">
                        <div >
                        <div class="circle">
                           <img src="<?php echo e(asset('public/pictures/init/online-shop-2.png')); ?>"/>
                        </div>
                        <h5>Buớc 2</h5>
                        <p>Tạo đơn hàng tại <br>quangchauexpress.com</p>
                        </div>
                    </div>
                    <div class="col-md-2 col-xs-12 cam-ket">
                            <div >
                            <div class="circle">
                                    <img src="<?php echo e(asset('public/pictures/init/online-shop-6.png')); ?>"/>
                            </div>
                            <h5>Buớc 3</h5>
                            <p>Đặt cọc 50% giá trị đơn hàng</p>
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-12 cam-ket">
                                <div >
                                <div class="circle">
                                        <img src="<?php echo e(asset('public/pictures/init/route.png')); ?>"/>
                                </div>
                                <h5>Buớc 4</h5>
                                <p>Vận chuyển từ kho TQ về kho VN</p>
                                </div>
                            </div>
                            <div class="col-md-2 col-xs-12 cam-ket">
                                    <div>
                                    <div class="circle">
                                            <img src="<?php echo e(asset('public/pictures/init/shipping.png')); ?>"/>
                                    </div>
                                    <h5>Buớc 5</h5>
                                    <p>Nhận hàng tại nhà hoặc chuyển thằng đến nguời mua</p>
                                    </div>
                                </div>
                                <div class="col-md-2 col-xs-12 cam-ket">
                                        <div >
                                        <div class="circle">
                                                <img src="<?php echo e(asset('public/pictures/init/shopping-bag.png')); ?>"/>
                                        </div>
                                        <h5>Buớc 6</h5>
                                        <p>Khách nhận hàng và xác nhận</p>
                                        </div>
                                    </div>
            </div>
        </div>
        

   <div class="container-fluid bg">
       <div class="inner"></div>
   </div>


   <style>
   .bg{
       background: url('https://images.unsplash.com/photo-1512436991641-6745cdb1723f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&w=1000&q=80');
       height: 200px;
       background-size: cover;
       position: relative;
       background-repeat:no-repeat;
   }

   .bg .inner{
        position: absolute;
        top:0px;
        left:0px;
        right:0px;
        bottom:0px;
        background: #00000036
   }
   </style>

    <!-- services_section start -->
    <div class="cam-ket-box box">
        <h4 class="text-center heading-main">Thông tin thêm</h4>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-xs-12 col-sm-6">
                    <div class="icon_text">
                        <div class="icon_text_effect">
                            <i class="fa fa-list-alt" aria-hidden="true"></i>
                        </div>
                        <h4 class="text-center"><a href="#"><?php echo e(__('main.document')); ?></a></h4>
                        <p class="text-center">Các quy định của chúng tôi nhằm đảm bảo tính chặt chẽ trong việc đặt hàng và tránh những rủi xảy ra.</p>
                        <br>
                        <h6 style="font-size: 16px; font-weight: bold;" class="text-center"><a href="<?php echo e(asset('huong-dan')); ?>"><?php echo e(__('main.read_more')); ?>&nbsp;&nbsp;&nbsp;<span class="fa fa-caret-right" aria-hidden="true"></span></a></h6>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-xs-12 col-sm-6">
                    <div class="icon_text">
                        <div class="icon_text_effect">
                            <i class="fa fa-wpforms" aria-hidden="true"></i>
                        </div>
                        <h4 class="text-center"><a href="#"><?php echo e(__('main.quotation')); ?></a></h4>
                        <p class="text-center">Bảng giá tham khảo cho khách hàng để có thể tính toán tài chính cụ thể cho dự định đặt hàng của mình.</p>
                        <br>
                        <h6 style="font-size: 16px; font-weight: bold;" class="text-center"><a href="<?php echo e(asset('bai-viet/Báo%20giá?id=5')); ?>"><?php echo e(__('main.read_more')); ?>&nbsp;&nbsp;&nbsp;<span class="fa fa-caret-right" aria-hidden="true"></span></a></h6>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-xs-12 col-sm-6">
                    <div class="icon_text">
                        <div class="icon_text_effect">
                            <i class="fa fa-get-pocket" aria-hidden="true"></i>
                        </div>
                        <h4 class="text-center"><a href="#"><?php echo e(__('main.service')); ?></a></h4>
                        <p class="text-center">Chúng tôi có các dịch vụ về tìm nguồn hàng, đổi ngoại tệ và dịch vụ khác phục vụ việc đặt hàng của bạn.</p>
                        <br>
                        <h6 style="font-size: 16px; font-weight: bold;" class="text-center"><a href="<?php echo e(asset('bai-viet/Dịch%20vụ?id=4')); ?>"><?php echo e(__('main.read_more')); ?>&nbsp;&nbsp;&nbsp;<span class="fa fa-caret-right" aria-hidden="true"></span></a></h6>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-xs-12 col-sm-6">
                    <div class="icon_text">
                        <div class="icon_text_effect">
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </div>
                        <h4 class="text-center"><a href="#"><?php echo e(__('main.policy')); ?></a></h4>
                        <p class="text-center">Các chính sách trong việc đặt hàng cũng như xử lí các khiếu nại trong quá trình đặt hàng xảy ra.</p>
                        <br>
                        <h6 style="font-size: 16px; font-weight: bold;" class="text-center"><a href="<?php echo e(asset('chinh-sach')); ?>"><?php echo e(__('main.read_more')); ?>&nbsp;&nbsp;&nbsp;<span class="fa fa-caret-right" aria-hidden="true"></span></a></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- services_section end -->

    <!-- portfolio_section start -->
    <div class="portfolio_section">
        <div class="container">
            <div class="row">
                <!-- section_heading start -->
                <div class="col-lg-8 col-md-12 col-xs-12 col-sm-12 col-lg-offset-2">
                    <div class="section_heading">
                        <h2><?php echo e(__('main.order_cn_in_page')); ?></h2>
                        <p><?php echo e(__('main.preface_section_order_page')); ?></p>
                    </div>
                </div>
                <!-- section_heading end -->
                <div class="row" style="padding:20px">
                    <div class="col-xs-12 col-sm-6 col-md-4" >
                        <div class="portfolio-thumb">

                            <div class="gc_filter_cont_overlay_wrapper">
                                <figure>
                                    <img src="<?php echo e(asset('pictures/init/taobao.jpg')); ?>" class="zoom image img-responsive" alt="service_img">
                                </figure>
                                <div class="gc_filter_cont_overlay">
                                    <div class="gc_filter_text"><a href="images/home/home-2/portfolio-1.jpg"><i class="fa fa-search-plus"></i></a></div>
                                </div>
                                <div class="tab_image_text">
                                    <div class="project_title">
                                        <h4><a href="https://world.taobao.com/">taobao.com</a></h4>
                                    </div>
                                    <div class="project_category">
                                        <h4><a href="https://world.taobao.com/">Hàng về HN chỉ 5-7 ngày, về SG 8-10 ngày sau khi đặt hàng...</a></h4>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.portfolio-thumb -->
                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-4 " >
                        <div class="portfolio-thumb">
                            <div class="gc_filter_cont_overlay_wrapper">
                                <figure>
                                    <img src="<?php echo e(asset('pictures/init/1688.png')); ?>" class="zoom image img-responsive" alt="service_img">
                                </figure>
                                <div class="gc_filter_cont_overlay">
                                    <div class="gc_filter_text"><a href="images/home/home-2/portfolio-2.jpg"><i class="fa fa-search-plus"></i></a></div>

                                </div>
                                <div class="tab_image_text">
                                    <div class="project_title">
                                        <h4><a href="https://www.1688.com/">1688.com</a></h4>
                                    </div>
                                    <div class="project_category">
                                        <h4><a href="https://www.1688.com/">Giá cả cạnh tranh đảm bảo rẻ nhất trên thị trường order...</a></h4>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.portfolio-thumb -->
                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="portfolio-thumb">
                            <div class="gc_filter_cont_overlay_wrapper">
                                <figure>
                                    <img src="<?php echo e(asset('pictures/init/tmall.png')); ?>" class="zoom image img-responsive" alt="service_img">
                                </figure>
                                <div class="gc_filter_cont_overlay">
                                    <div class="gc_filter_text"><a href="images/home/home-2/portfolio-3.jpg"><i class="fa fa-search-plus"></i></a></div>
                                </div>
                                <div class="tab_image_text">
                                    <div class="project_title">
                                        <h4><a href="https://www.tmall.com/">tmall.com</a></h4>
                                    </div>
                                    <div class="project_category">
                                        <h4><a href="https://www.tmall.com/">Chất lượng và dịch vụ tốt nhất, đảm bảo uy tín cao...</a></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.container -->
                    </div>
                </div>
                <div class="row" style="padding:20px">
                    <div class="col-xs-12 col-sm-6 col-md-4" >
                        <div class="portfolio-thumb">
                            <div class="gc_filter_cont_overlay_wrapper">
                                <figure>
                                    <img src="<?php echo e(asset('pictures/init/hm.jpg')); ?>" class="zoom image img-responsive" alt="service_img">
                                </figure>
                                <div class="gc_filter_cont_overlay">
                                    <div class="gc_filter_text"><a href="images/home/home-2/portfolio-2.jpg"><i class="fa fa-search-plus"></i></a></div>

                                </div>
                                <div class="tab_image_text">
                                    <div class="project_title">
                                        <h4><a href="https://www2.hm.com/en_cn/index.html">H&M</a></h4>
                                    </div>
                                    <div class="project_category">
                                        <h4><a href="https://www2.hm.com/en_cn/index.html">Giá cả cạnh tranh đảm bảo rẻ nhất trên thị trường order...</a></h4>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.portfolio-thumb -->
                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-4 " >
                        <div class="portfolio-thumb">
                            <div class="gc_filter_cont_overlay_wrapper">
                                <figure>
                                    <img src="<?php echo e(asset('pictures/init/zara.png')); ?>" class="zoom image img-responsive" alt="service_img">
                                </figure>
                                <div class="gc_filter_cont_overlay">
                                    <div class="gc_filter_text"><a href="images/home/home-2/portfolio-2.jpg"><i class="fa fa-search-plus"></i></a></div>

                                </div>
                                <div class="tab_image_text">
                                    <div class="project_title">
                                        <h4><a href="https://www.zara.cn/cn/">Zara.cn</a></h4>
                                    </div>
                                    <div class="project_category">
                                        <h4><a href="https://www.zara.cn/cn/">Nhiều sản phẩm đẹp giá cả cạnh tranh và uy tín cao..</a></h4>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.portfolio-thumb -->
                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-4 " >
                        <div class="portfolio-thumb">
                            <div class="gc_filter_cont_overlay_wrapper">
                                <figure>
                                    <img src="<?php echo e(asset('pictures/init/wechat.png')); ?>" class="zoom image img-responsive" alt="service_img">
                                </figure>
                                <div class="gc_filter_cont_overlay">
                                    <div class="gc_filter_text"><a href="images/home/home-2/portfolio-2.jpg"><i class="fa fa-search-plus"></i></a></div>

                                </div>
                                <div class="tab_image_text">
                                    <div class="project_title">
                                        <h4><a href="https://web.wechat.com/">Wechat</a></h4>
                                    </div>
                                    <div class="project_category">
                                        <h4><a href="https://web.wechat.com/">Hỗ trợ và trả lời nhanh chóng, tận tình, chu đáo...</a></h4>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.portfolio-thumb -->
                    </div>

                    <!--/.portfolio-area-->
                </div>
            </div>
        </div>
    </div>
    <!-- portfolio_section end -->



    <!-- testimonial_section start -->
    <div class="testimonial_section what-say">
        <div class="testimonial_section_overlay"></div>
        <div class="container">
            <div class="row">
                
                <div class="col-lg-8 col-md-12 col-xs-12 col-sm-12 col-lg-offset-2">
                    <div class="section_heading">
                        <h2><?php echo e(__('main.what_say')); ?></h2>
                        <p><?php echo e(__('main.preface_what_say')); ?></p>
                    </div>
                </div>

                <div class="testimonial_info">
                    <div class="carousel slide" data-ride="carousel" id="testimonial_carousel">
                        <!-- Bottom Carousel Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#testimonial_carousel" data-slide-to="0" class="active"><img class="img-responsive " src="images/home/home-2/testi_img1.jpg" alt="test">
                            </li>
                            <li data-target="#testimonial_carousel" data-slide-to="1" class=""><img class="img-responsive" src="images/home/home-2/testi_img2.jpg" alt="test">
                            </li>
                            <li data-target="#testimonial_carousel" data-slide-to="2" class=""><img class="img-responsive" src="images/home/home-2/testi_img3.jpg" alt="test">
                            </li>
                            <li data-target="#testimonial_carousel" data-slide-to="3" class=""><img class="img-responsive" src="images/home/home-2/testi_img4.jpg" alt="test">
                            </li>
                            <li data-target="#testimonial_carousel" data-slide-to="4" class=""><img class="img-responsive" src="images/home/home-2/testi_img4.jpg" alt="test">
                            </li>
                        </ol>
                        <!-- Carousel Slides / Quotes -->
                        <div class="carousel-inner text-center">
                            <!-- Quote 1 -->
                            <div class="item active">
                                <div class="row">
                                    <div class="col-sm-10 col-sm-offset-1">
                                        <div class="thumb_avt">
                                            <img src="<?php echo e(asset('pictures/init/avt1.jpg')); ?>" alt="">
                                        </div>
                                        <h4>Nguyễn Đình Nhân</h4>
                                        <p>Đã đặt hàng qua nhiều trang nhưng không đâu nhanh và uy tín như ở đây. Rất hài lòng.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Quote 2 -->
                            <div class="item">
                                <div class="row">
                                    <div class="col-sm-10 col-sm-offset-1">
                                        <div class="thumb_avt">
                                            <img src="<?php echo e(asset('pictures/init/avt2.jpg')); ?>" alt="">
                                        </div>
                                        <h4>Vũ Thị Hương Lan</h4>
                                        <p>Đặt hàng dễ dàng, thời gian hàng về nhanh, đóng gói vận chuyển rất cẩn thận chu đáo.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Quote 3 -->
                            <div class="item">
                                <div class="row">
                                    <div class="col-sm-10 col-sm-offset-1">
                                        <div class="thumb_avt">
                                            <img src="<?php echo e(asset('pictures/init/avt3.jpg')); ?>" alt="">
                                        </div>
                                        <h4>Đào Vân Thắng</h4>
                                        <p>Hỗ trợ rất nhiệt tình, mình có bổ sung đơn mấy lần nhưng hỗ trợ rất chu đáo.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Quote 4 -->
                            <div class="item">
                                <div class="row">
                                    <div class="col-sm-10 col-sm-offset-1">
                                        <div class="thumb_avt">
                                            <img src="<?php echo e(asset('pictures/init/avt4.jpg')); ?>" alt="">
                                        </div>
                                        <h4>Hoàng Kiều Toàn</h4>
                                        <p>Đã đặt hàng số luợng lớn ở đây. Chất luợng dịch vụ tốt, hàng đảm bảo chất luợng.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Quote 4 -->
                            <div class="item">
                                <div class="row">
                                    <div class="col-sm-10 col-sm-offset-1">
                                        <div class="thumb_avt">
                                            <img src="<?php echo e(asset('pictures/init/avt5.jpg')); ?>" alt="">
                                        </div>
                                        <h4>Đặng Trà My</h4>
                                        <p>Mình hay mua quần áo số luợng lẻ thôi nhưng đuợc hỗ trợ nhiệt tình lắm, hàng về nhanh nữa.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- testimonial_section end -->

    <style>
    .box{
        margin-top:100px;
        display: block;
        position: relative;
        margin-bottom:100px;
    }
    .box .heading-main{
        font-size: 24px;
        font-weight: 500;
        text-transform: uppercase;
        color:#f44336;
    }
    .box .heading-main:before {
    content: "";
    width: 200px;
    height: 2px;
    background: #f44336;
    position: absolute;
    top: 40px;
}
     .cam-ket-box .cam-ket{
        text-align: center;
        padding:10px;    
     }
     .cam-ket-box .cam-ket h5{
        font-size: 24px;
     }
     .cam-ket-box .cam-ket p{
         font-style: italic;
         font-size: 18px;
         margin-top:10px;
     }
     .cam-ket-box .cam-ket .inner{
        box-shadow:#ececec 0px 3px 16px 4px;
        width: 100%;
        padding:10px;
        height:180px;    
     }
     .cam-ket-box .cam-ket img{
        height: 80px;
        color: #4CAF50;
     }

     .cam-ket-box .row{
         margin-top:20px;
     }

     .quy-trinh .cam-ket{
         text-align: center
     }
     .quy-trinh .circle{
         border-radius: 50%;
         width:120px;
         height:120px;
         margin:0px auto;
         border:4px solid #f44336;
         display:flex;
         justify-content:center;
         align-items: center
     }

     .quy-trinh .cam-ket h5{
         font-size: 18px;
         margin-top:10px;
     }

     .quy-trinh .cam-ket p{
         font-size: 16px;
         color:black;
     }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Library/WebServer/Documents/qcexpress/resources/views/home.blade.php ENDPATH**/ ?>