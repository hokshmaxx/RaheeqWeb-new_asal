<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- SEO Meta description -->
    <meta name="description" content="AppCo app landing page template or product landing page template helps you easily create websites for your app or product,  landing page template form promotion and many more.">
    <meta name="author" content="ThemeTags">

    <!-- OG Meta Tags to improve the way the post looks when you share the page on LinkedIn, Facebook, Google+ -->
    <meta property="og:site_name" content=""> <!-- website name -->
    <meta property="og:site" content=""> <!-- website link -->
    <meta property="og:title" content=""> <!-- title shown in the actual shared post -->
    <meta property="og:description" content=""> <!-- description shown in the actual shared post -->
    <meta property="og:image" content=""> <!-- image link, make sure it's jpg -->
    <meta property="og:url" content=""> <!-- where do you want your post to link to -->
    <meta property="og:type" content="article">

    <!--title-->
    <title>{{$settings->title}}</title>

    <!--favicon icon-->
    <link rel="icon" href="img/favicon.png" type="image/png" sizes="16x16">

    <!--google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700%7COpen+Sans&amp;display=swap" rel="stylesheet">

    <!--Bootstrap css-->
    <link rel="stylesheet" href="{{asset('website/css/bootstrap.min.css')}}">
    <!--Magnific popup css-->
    <link rel="stylesheet" href="{{asset('website/css/magnific-popup.css')}}">
    <!--Themify icon css-->
    <link rel="stylesheet" href="{{asset('website/css/themify-icons.css')}}">
    <!--animated css-->
    <link rel="stylesheet" href="{{asset('website/css/animate.min.css')}}">

    <!--Owl carousel css-->
    <link rel="stylesheet" href="{{asset('website/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('website/css/owl.theme.default.min.css')}}">
    <!--custom css-->
    <link rel="stylesheet" href="{{asset('website/css/style.css')}}">
    <!--responsive css-->
    <link rel="stylesheet" href="{{asset('website/css/responsive.css')}}">

</head>
<body cz-shortcut-listen="true">

<!--header section start-->
<!--header section end-->

<!--body content wrap start-->
<div class="main">


    <!--overflow block start-->
    <div class="overflow-hidden">
        <!--about us section start-->
        <section id="about" class="about-us ptb-100 background-shape-img">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-md-12">
                        <div class="about-content-left section-heading">
                            <h2>{{$page->title}} </h2>

                            <div class="single-feature mb-12 mt-12">
                                <div class="icon-box-wrap d-flex align-items-center mb-2">

                                    <p >{!! $page->description !!}</p>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!--about us section end-->
    </div>




</div>

<!--body content wrap end-->


<!--footer section start-->
<footer class="footer-section">

    <!--footer top start-->
    <div class="footer-top pt-150 background-img-2" style="background: url('{{$item->footer_background}}')no-repeat center top / cover">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-12 col-lg-4 mb-4 mb-md-4 mb-sm-4 mb-lg-0">
                    <div class="footer-nav-wrap text-white">
                        <img src="{{$settings->logo}}" alt="footer logo" width="120" class="img-fluid mb-3">
                        <!--<p>Holisticly empower premium architectures without value-added ideas. Seamlessly evolve-->
                        <!--    cross-platform experiences.</p>-->

                        <!--<div class="social-list-wrap">-->
                        <!--    <ul class="social-list list-inline list-unstyled">-->
                        <!--        <li class="list-inline-item"><a href="#" target="_blank" title="Facebook"><span class="ti-facebook"></span></a></li>-->
                        <!--        <li class="list-inline-item"><a href="#" target="_blank" title="Twitter"><span class="ti-twitter"></span></a></li>-->
                        <!--        <li class="list-inline-item"><a href="#" target="_blank" title="Instagram"><span class="ti-instagram"></span></a></li>-->
                        <!--        <li class="list-inline-item"><a href="#" target="_blank" title="printerst"><span class="ti-pinterest"></span></a></li>-->
                        <!--    </ul>-->
                        <!--</div>-->
                    </div>
                </div>
                <div class="col-md-12 col-lg-8">
                    <div class="row">
                        <div class="col-sm-6 col-md-4 col-lg-4 mb-4 mb-sm-4 mb-md-0 mb-lg-0">
                            <div class="footer-nav-wrap text-white">
                                <h5 class="mb-3 text-white">{{__('cp.soctial_media')}}</h5>
                                <ul class="list-unstyled">
                                    <li class="mb-2"><a href="{{$settings->facebook}}"><span class="ti-facebook"></span>  {{__('cp.facebook')}}</a></li>
                                    <li class="mb-2"><a href="{{$settings->twitter}}"><span class="ti-twitter"></span>  {{__('cp.twitter')}}</a></li>
                                    <li class="mb-2"><a href="{{$settings->instagram}}"><span class="ti-instagram"></span>  {{__('cp.instagram')}}</a></li>
                                    <li class="mb-2"><a href="{{$settings->linked_in}}"><span class="ti-linkedin"></span>  {{__('cp.linked_in')}}</a></li>

                                </ul>
                            </div>
                        </div>
                        <!--<div class="col-sm-6 col-md-4 col-lg-4 mb-4 mb-sm-4 mb-md-0 mb-lg-0">-->
                        <!--    <div class="footer-nav-wrap text-white">-->
                        <!--        <h5 class="mb-3 text-white">Company</h5>-->
                        <!--        <ul class="list-unstyled support-list">-->
                        <!--            <li class="mb-2">-->
                        <!--                <a href="#">About Us</a>-->
                        <!--            </li>-->
                        <!--            <li class="mb-2">-->
                        <!--                <a href="#">Careers</a>-->
                        <!--            </li>-->
                        <!--            <li class="mb-2">-->
                        <!--                <a href="#">Customers</a>-->
                        <!--            </li>-->
                        <!--            <li class="mb-2">-->
                        <!--                <a href="#">Community</a>-->
                        <!--            </li>-->
                        <!--            <li class="mb-2">-->
                        <!--                <a href="#">Our Team</a>-->
                        <!--            </li>-->
                        <!--        </ul>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <div class="col-sm-6 col-md-4 col-lg-4">
                            <div class="footer-nav-wrap text-white">
                                <h5 class="mb-3 text-white">{{__('cp.address')}}</h5>
                                <ul class="list-unstyled support-list">
                                    <li class="mb-2 d-flex align-items-center"><span class="ti-location-pin mr-2"></span>
                                      {{$settings->address}}
                                    </li>
                                    <li class="mb-2 d-flex align-items-center"><span class="ti-mobile mr-2"></span> <a href="tel:+61283766284"> {{$settings->mobile}}</a></li>
                                    <li class="mb-2 d-flex align-items-center"><span class="ti-email mr-2"></span><a> {{$settings->info_email}}</a></li>
                                    <!--<li class="mb-2 d-flex align-items-center"><span class="ti-world mr-2"></span><a href="#"> www.yourdomain.com</a></li>-->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--footer bottom copyright start-->
        <div class="footer-bottom border-gray-light mt-5 py-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-7">
                        <div class="copyright-wrap small-text">
                            <p class="mb-0 text-white">© ThemeTags Design Agency, All rights reserved</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-5">
                        <div class="terms-policy-wrap text-lg-right text-md-right text-left">
                            <ul class="list-inline">
                                 <li class="list-inline-item"><a class="small-text" href="{{url(app()->getLocale().'/page/2')}}">{{__('cp.terms')}}</a></li>
                                <li class="list-inline-item"><a class="small-text" href="{{url(app()->getLocale().'/page/3')}}">{{__('cp.privacy')}}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--footer bottom copyright end-->
    </div>
    <!--footer top end-->
</footer>
<!--footer section end-->

<!--jQuery-->
<script src="{{asset('website/js/jquery-3.5.0.min.js')}}"></script>
<!--Popper js-->
<script src="{{asset('website/js/popper.min.js')}}"></script>
<!--Bootstrap js-->
<script src="{{asset('website/js/bootstrap.min.js')}}"></script>
<!--Magnific popup js-->
<script src="{{asset('website/js/jquery.magnific-popup.min.js')}}"></script>
<!--jquery easing js-->
<script src="{{asset('website/js/jquery.easing.min.js')}}"></script>

<!--wow js-->
<script src="{{asset('website/js/wow.min.js')}}"></script>
<!--owl carousel js-->
<script src="{{asset('website/js/owl.carousel.min.js')}}"></script>
<!--countdown js-->
<script src="{{asset('website/js/jquery.countdown.min.js')}}"></script>
<!--validator js-->
<script src="{{asset('website/js/validator.min.js')}}"></script>
<!--custom js-->
<script src="{{asset('website/js/scripts.js')}}"></script>

</body></html>
