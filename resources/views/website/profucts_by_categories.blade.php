@extends('website.layout')
@section('title') {{$category->name}} @endsection
@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.css">
    <style>
        /* ==== General Section Styles ==== */
        .section_home, .section_categoris, .section_arrival, .section_video, .section_contact {
            padding: 60px 0;
        }

        .sec_head {
            text-align: center;
            margin-bottom: 50px;
        }

        .sec_head h2 {
            font-size: 36px;
            font-weight: 800;
            text-transform: uppercase;
            color: #222;
            margin: 0;
        }

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
            color: #333;
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

        /*!* Product Info *!*/
        /*.txt-product {*/
        /*    padding: 15px;*/
        /*    text-align: center;*/
        /*}*/

        .txt-product p {
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin: 0 0 8px;
            /*height: 100px;*/
            /*overflow: hidden;*/
            /*display: -webkit-box;*/
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            white-space: normal;
            word-wrap: break-word;
            overflow: visible;
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
        .btn-site {
            background: var(--main-color);
            color: #fff;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 700;
            border: none;
            transition: 0.3s;
            display: inline-block;
            text-align: center;
        }

        .btn-site:hover {
            background: var(--main-color);
            box-shadow: 0 6px 12px rgba(255,107,129,0.3);
            transform: translateY(-2px);
        }

        /* ==== Sold Out ==== */
        .soldOut {
            margin-top: 10px;
            text-align: center;
            font-weight: 700;
            color: var(--main-color);
        }

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

		<div class="breadcrumb-bar">
            <div class="container">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fa fa-home"></i>@lang('website.HOME')</a></li>
                    <li class="breadcrumb-item">
                        <a href="{{ url('/#categoriesSection') }}">@lang('website.CATAGORIES')</a>
                    </li>
                    <li class="breadcrumb-item active">{{$category->name}}</li>
                </ol>
            </div>
        </div>

        <section class="section_page_site">
		    <div class="container">
                <div class="head-sort">
		            <h5>@lang('website.Sort Type')</h5>
		            <div class="form-group">
                    <!-- {{Request::get('sort')}} -->
		                <select class="form-control" onchange="location = this.value;">
		                    <option>@lang('website.select')</option>
		                    <option @if(Request::get('sort')=='min') {{'selected'}} @endif value="{{route('category',[$category->id,Str::slug($category->name)]).'?sort=min'}}">@lang('website.Min price')</option>
		                    <option @if(Request::get('sort')=='max') {{'selected'}} @endif value="{{route('category',[$category->id,Str::slug($category->name)]).'?sort=max'}}">@lang('website.Max Price')</option>

		                </select>
		            </div>
		        </div>
		        <div class="row" id="infinite">
		           @include('website.more_blad.product_items')

		        </div>
		         {{$products->links('pagination::bootstrap-4')}}
		         <!--<div class="ajax-load text-center" style="display:none">-->
           <!--          <div class="loadingIconsItems" style="text-align:center"><i class="fa fa-spinner fa-spin" style="font-size: 20px;"></i></div>-->
           <!--     </div>-->
		    </div>
		</section>

@endsection

@section('script')

	<script>
	    var csrf_token = '{{csrf_token()}}';
        var page = 1;
        // $(window).scroll(function () {
        //     if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight -350) {
        //         if(page !=0) {
        //             page++;
        //             loadMoreData(page);
        //         }
        //     }
        //     else {
        //     }
        // });
function loadMoreData(page1) {
    var char;
    if(window.location.search == ""){
        char = "?";
    }else{
        char = window.location.href+"&";
    }
    $.ajax(
        {
            url: char +'page=' + page1,
            type: "get",
            beforeSend: function () {
                $('.ajax-load').show();
            }
        })
        .done(function (data) {
            $('.ajax-load').hide();
            $("#infinite").append(data.html);
            if ( data.is_more =="no") {
                $('.ajax-load').hide();
                page = 0;
                return;
            }
        })
        .fail(function (jqXHR, ajaxOptions, thrownError) {
            return false;
        });
}


	</script>
@endsection

