<?php $__env->startSection('header',__('main.users')); ?>
<?php $__env->startSection('small_header',__('main.add')); ?>

<?php $__env->startSection('content'); ?>

<div class="testimonial_section banner">
    
    <div class="testimonial_section_overlay"></div>
        <div class="testimonial_info">
            <div class="carousel slide" data-ride="carousel" id="testimonial_carousel_banner">
                <!-- Bottom Carousel Indicators -->
                
                <div class="carousel-inner text-center">

                    <div class="item active">
                        <div class="thumb-img">
                            <img style="height: 100%; min-width: 100%;" src="<?php echo e(asset('pictures/init/bbb.png')); ?>" alt="">
                        </div>
                    </div>
                    <!-- Quote 3 -->
                   
                    

                </div>
            </div>
        </div>
    </div>

    <div class="section_2 add-on">
        <div class="container">
            <div class="row">
                <div class="col-sm-5">
                    <div class="page_header_title">
                        <h1><?php echo e(__('main.support_order')); ?>: <?php echo e($contact->main_phone); ?></h1>
                    </div>
                </div>
                <div class="col-sm-7 text-right">
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
    
    <?php if($general->link_app_android != '' || $general->link_app_ios != ''): ?>
        <div class="section_1 app_device">
            <div class="container">
                <div class="row">
                    <div style="display: flex; justify-content: center">
                        <h1><?php echo e(__('main.install_app_on_device')); ?></h1>
                    </div>
                    <div style="display: flex; justify-content: center; align-items: center; margin-top: 20px;">
                        <?php if($general->link_app_android != ''): ?>
                            <a href="<?php echo e($general->link_app_android); ?>" class="text-center">
                                <i class="fa fa-android" style="font-size: 6em"></i>&nbsp;&nbsp;&nbsp;<p style="font-size: 1.5em; margin-top: 15px;">Android</p>
                            </a>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <?php endif; ?>
                        <?php if($general->link_app_ios != ''): ?>
                            <a href="<?php echo e($general->link_app_ios); ?>" class="text-center">
                                <i class="fa fa-apple" style="font-size: 6em"></i>&nbsp;&nbsp;&nbsp;<p style="font-size: 1.5em; margin-top: 15px;">IOS</p>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>




    <!-- services_section start -->
    <div class="services_section">
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Library/WebServer/Documents/qcexpress/resources/views/home.blade.php ENDPATH**/ ?>