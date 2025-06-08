@extends('website.layout')
@section('title'){{$setting->title}} @endsection
@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.css">
    <style>
        /* ==== General Section Styles ==== */
        .section_home, .section_categoris, .section_arrival, .section_video, .section_contact {
            padding: 60px 0;
        }

        /*.sec_head {*/
        /*    text-align: center;*/
        /*    margin-bottom: 50px;*/
        /*}*/

        /*.sec_head h2 {*/
        /*    font-size: 36px;*/
        /*    font-weight: 800;*/
        /*    text-transform: uppercase;*/
        /*    color: #222;*/
        /*    margin: 0;*/
        /*}*/

        /* ==== Home Slider ==== */
        #home_slider {
            padding: 0 20px;
        }

        #home_slider .item {
            margin: 0 8px;
        }

        #home_slider .item img {
            width: 100%;
            height: auto;
            border-radius: 16px;
            object-fit: cover;
        }

        @media (max-width: 768px) {
            #home_slider .item img {
                max-height: 280px;
            }
        }

        @media (min-width: 769px) {
            #home_slider .item img {
                max-height: 500px;
            }
        }

        /* ==== Category and Vendor Cards - Optimized ==== */
        .section_categoris {
            background-color: #f4f6f8;
        }

        /* Carousel container fixes */
        #categoris_slider .owl-stage,
        #venders_slider .owl-stage {
            display: flex;
            align-items: stretch;
        }

        #categoris_slider .item,
        #venders_slider .item {
            display: flex;
            height: 100%;
            padding: 5px;
        }

        .item_categoris, .item_venders {
            text-align: center;
            padding: 0;
            transition: all 0.4s ease;
            background: #ffffff;
            border-radius: 16px;
            margin: 0;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        .item_categoris:hover, .item_venders:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        .item_categoris a, .item_venders a {
            display: flex;
            flex-direction: column;
            height: 100%;
            text-decoration: none;
            color: inherit;
        }

        .item_categoris figure, .item_venders figure {
            position: relative;
            width: 100%;
            margin: 0;
            padding-top: 100%; /* 1:1 Aspect Ratio */
            overflow: hidden;
            flex-shrink: 0;
        }

        .item_categoris img, .item_venders img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            transition: transform 0.4s ease;
        }

        .item_categoris:hover img, .item_venders:hover img {
            transform: scale(1.05);
        }

        .item_categoris p, .item_venders p {
            margin: 15px 8px;
            font-size: 15px;
            font-weight: 600;
            color: var(--text-color);
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
            padding: 0 8px;
            flex-grow: 1;
        }

        /* ==== Product Card ==== */
        .item-product {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            transition: 0.4s;
            margin-bottom: 30px;
        }

        .item-product:hover {
            transform: translateY(-6px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        .item-product figure {
            position: relative;
            /*padding-top: 100%;*/
            overflow: hidden;
        }

        .item-product figure img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s;
        }

        .item-product:hover figure img {
            transform: scale(1.05);
        }

        /* Favorite Button */
        .btn_favorite {
            position: absolute;
            top: 12px;
            right: 12px;
            background: rgba(255,255,255,0.9);
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--main-color);
            font-size: 18px;
            z-index: 2;
        }

        /* Offer Tag */
        .offer-product {
            position: absolute;
            top: 12px;
            left: 12px;
            background: var(--main-color);
            color: #fff;
            font-size: 13px;
            padding: 4px 10px;
            border-radius: 6px;
            font-weight: bold;
            z-index: 2;
        }

        /* Product Info */
        .txt-product {
            padding: 15px;
            text-align: center;
        }

        .txt-product p {
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin: 0 0 8px;
            height: 38px;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .txt-product strong {
            display: block;
            font-size: 18px;
            color: var(--main-color);
            font-weight: bold;
            margin-top: 5px;
        }

        .txt-product del {
            font-size: 14px;
            color: #999;
            margin-right: 5px;
        }

        /* ==== Quantity ==== */
        .quantity-item {
            margin-top: 12px;
        }

        .quantity {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .button-count {
            width: 36px;
            height: 36px;
            background: #f1f1f1;
            border: none;
            font-size: 18px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .count-quat {
            width: 42px;
            height: 36px;
            border: 1px solid #ddd;
            margin: 0 8px;
            text-align: center;
            font-size: 16px;
        }

        /* ==== Button Site ==== */
        /*.btn-site {*/
        /*    background: var(--main-color);*/
        /*    color: #fff;*/
        /*    padding: 12px 24px;*/

        /*    border-radius: 8px;*/
        /*    font-size: 16px;*/
        /*    font-weight: 700;*/
        /*    border: none;*/
        /*    transition: 0.3s;*/
        /*    */
        /*    !*display: inline-block;*!*/
        /*    !*text-align: center;*!*/
        /*}*/

        .btn-site:hover {
            background: var(--main-color);
            box-shadow: 0 6px 12px rgba(255,107,129,0.3);
            transform: translateY(-2px);
        }

        /* ==== Sold Out ==== */
        /*.soldOut {*/
        /*    margin-top: 10px;*/
        /*    text-align: center;*/
        /*    font-weight: 700;*/
        /*    color: var(--main-color);*/
        /*}*/

        /* ==== Owl Carousel Customization ==== */
        .owl-carousel .owl-nav {
            display: none !important;
        }

        .owl-carousel .owl-dots {
            margin-top: 20px;
            text-align: center;
        }

        .owl-carousel .owl-dot {
            width: 10px;
            height: 10px;
            background: #ddd;
            margin: 0 5px;
            border-radius: 50%;
            display: inline-block;
            transition: 0.3s;
        }

        /*.owl-carousel .owl-dot.active {*/
        /*    width: 24px;*/
        /*    border-radius: 6px;*/
        /*    background: #ff6b81;*/
        /*}*/

        /* ==== Responsive Tweaks ==== */
        @media (max-width: 767px) {
            .item_categoris p, .item_venders p {
                font-size: 13px;
                margin: 10px 5px;
                white-space: normal;
                -webkit-line-clamp: 2;
                display: -webkit-box;
                -webkit-box-orient: vertical;
                height: 36px;
            }

            #categoris_slider .item,
            #venders_slider .item {
                padding: 3px;
            }

            .item_categoris, .item_venders {
                margin: 0;
            }
        }

        @media (min-width: 768px) and (max-width: 991px) {
            .item_categoris p, .item_venders p {
                font-size: 14px;
            }
        }

        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .wow {
            animation-duration: 1s;
            animation-fill-mode: both;
        }

        .fadeInUp {
            animation-name: fadeInUp;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translate3d(0, 20px, 0);
            }
            to {
                opacity: 1;
                transform: translate3d(0, 0, 0);
            }
        }
    </style>
@endsection

@section('content')
    <section class="section_home">
        <div class="owl-carousel" id="home_slider">
            @foreach($banners as $banner)
                <div class="item">
                    <a href="{{$banner->link}}">
                        <img src="{{$banner->image}}" alt="Banner" loading="lazy" />
                    </a>
                </div>
            @endforeach
        </div>
    </section>

    <section class="section_categoris" >
        <div class="container" id="categoriesSection">
            <div class="sec_head wow fadeInUp">
                <h2>@lang('website.CATAGORIES')</h2>
            </div>
            <div class="owl-carousel" id="categoris_slider">
                @foreach($categories as $category)
                    <div class="item">
                        <div class="item_categoris">
                            <a href="{{route('category',[$category->id,Str::slug($category->name)])}}">
                                <figure>
                                    <img src="{{$category->image}}" alt="{{$category->name}}" loading="lazy" />
                                </figure>
                                <p>{{$category->name}}</p>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section_categoris">
        <div class="container" id="vendersSection">
            <div class="sec_head wow fadeInUp">
                <h2 >@lang('website.vender')</h2>
            </div>
            <div class="owl-carousel" id="venders_slider">
                @foreach($venders as $vender)
                    <div class="item">
                        <div class="item_venders" >
                            <a href="{{route('vender_category',[$vender->id])}}">
                                <figure>
                                    <img src="{{$vender->image}}" alt="{{$vender->name}}" loading="lazy" />
                                </figure>
                                <p>{{$vender->name}}</p>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section_arrival">
        <div class="container">
            <div class="sec_head wow fadeInUp">
                <h2>@lang('website.New Arrival')</h2>
            </div>
            <div class="row">
                @foreach($products as $product)
                    @php
                        $variant = $product->variants->first(); // You can customize this to get the default one
                    @endphp
                    <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-4">
                        <div class="item-product procard wow fadeInUp">
                            <figure>
                                <a href="{{ route('prouctDetails', [$product->id, Str::slug($product->name)]) }}">
                                    <img src="{{ $product->image }}" alt="{{ $product->name }}" loading="lazy" />
                                </a>

                                @if($product->is_favorite == 1)
                                    <a class="btn_favorite item_fav removeFromFavorite" data-id="{{ $product->id }}">
                                        <i class="fas fa-heart"></i>
                                    </a>
                                @else
                                    <a class="btn_favorite addToFavorite" data-id="{{ $product->id }}">
                                        <i class="far fa-heart"></i>
                                    </a>
                                @endif

                                @if($variant && $variant->discount_price > 0 )
                                    @php
                                        $dis_percent = ($variant->price - $variant->discount_price) / $variant->price * 100;
                                        $dis_percent = round($dis_percent);
                                    @endphp
                                @if($dis_percent>0)
                                    <span class="offer-product">{{ $dis_percent }}% OFF</span>
                                    @endif

                                @endif
                            </figure>

                            <div class="txt-product">
                                <a href="{{ route('prouctDetails', [$product->id, Str::slug($product->name)]) }}">
                                    <p>{{ $product->name }}</p>
                                </a>

                                <div>
                                    @if($variant && $variant->discount_price > 0 &&$variant->discount_price< $variant->price)
                                        <del>{{ $variant->price }} @lang('website.KWD')</del>
                                        <strong>{{ $variant->discount_price }} @lang('website.KWD')</strong>
                                    @elseif($variant)
                                        <strong>{{ $variant->price }} @lang('website.KWD')</strong>
                                    @else
                                        <strong>{{ $product->price }} @lang('website.KWD')</strong>
                                    @endif
                                </div>

                                <div>
                                    @if($variant && $variant->quantity > 0)
{{--                                        @if($product->is_cart == 0)--}}
                                            <a class="btn-site addToCart" data-id="{{ $product->id }} "  data-variant-id="{{ $product->variants->first()->id??0 }}">
                                                <span>@lang('website.addToCart')</span>
                                            </a>
{{--                                        @else--}}
{{--                                            <a class="btn-site removeFromCart" data-id="{{ $product->id }}">--}}
{{--                                                <span>@lang('website.removefromCart')</span>--}}
{{--                                            </a>--}}
{{--                                        @endif--}}

{{--                                        //--}}
                                    @else
                                        <div class="soldOut">
                                            <strong>@lang('website.Sold Out')</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-4">
                <a href="{{route('NewArrival')}}" class="btn-site">
                    <span>@lang('website.View all')</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Rest of your sections (video, contact) remain the same -->
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.js"></script>
    <script>
        $(document).ready(function(){
            // Home slider
            $("#home_slider").owlCarousel({
                items: 1,
                loop: true,
                autoplay: true,
                autoplayTimeout: 5000,
                autoplayHoverPause: true,
                dots: false,
                nav: false,
                lazyLoad: true
            });

            // Categories slider - Touch enabled
            $("#categoris_slider").owlCarousel({
                loop: true,
                margin: 15,
                nav: false,
                dots: true,
                autoplay: false,
                touchDrag: true,
                mouseDrag: true,
                pullDrag: true,
                freeDrag: true,
                responsive: {
                    0: {
                        items: 3
                    },
                    480: {
                        items: 4
                    },
                    768: {
                        items: 5
                    },
                    992: {
                        items: 6
                    },
                    1200: {
                        items: 8
                    }
                }
            });

            // Vendors slider - Touch enabled
            $("#venders_slider").owlCarousel({
                loop: true,
                margin: 15,
                nav: false,
                dots: true,
                autoplay: false,
                touchDrag: true,
                mouseDrag: true,
                pullDrag: true,
                freeDrag: true,
                responsive: {
                    0: {
                        items: 3
                    },
                    480: {
                        items: 4
                    },
                    768: {
                        items: 5
                    },
                    992: {
                        items: 6
                    },
                    1200: {
                        items: 8
                    }
                }
            });

            // Your existing contact form script
            $(document).on('click','input,select,textarea,.select2',function(){
                $(this).attr('style',"").next('span.errorSpan').remove();
            });

            var preventSubmit = false;

            $(document).on('click','.contact_us',function (e) {
                e.preventDefault();

                $(this).closest("#contactForm").find('select, textarea, input').each(function(){
                    if($(this).prop('required') && !$(this).val() && !$(this).is(":hidden")){
                        $(this).css("border", "#ff0000 solid 1px").next('span.errorSpan').remove();
                        $(this).css("border", "#bd1616 solid 1px").after('<span style="color:#bd1616" class="errorSpan">{{__("website.requiredField")}}</span>');
                        preventSubmit = true;
                        e.preventDefault();
                    }
                });

                if(preventSubmit){
                    preventSubmit = false;
                    return false;
                }

                var ele = $(this);

                $.ajax({
                    url: '{{url(app()->getLocale().'/contact_us')}}',
                    type: "post",
                    data: {
                        _token: '{{ csrf_token() }}',
                        name: $('#full_name').val(),
                        email: $('#emaill').val(),
                        mobile: $('#mobilee').val(),
                        message: $('#Messagee').val(),
                    },
                    success: function (response) {
                        if(response.code ==300){
                            swal({
                                title: "{{__('website.ok')}}",
                                icon: "success",
                                button: "{{__('website.oky')}}",
                            });
                            $('#full_name').val('');
                            $('#emaill').val('');
                            $('#Messagee').val('');
                            $('#mobilee').val('');
                        }else if(response.validator !=null){
                            swal({
                                text: response.validator,
                                button: "{{__('website.oky')}}",
                                dangerMode: true,
                            });
                        } else{
                            swal(response.message)
                        }
                    }
                });
            });

            new WOW().init();
        });
    </script>
@endsection
