<!DOCTYPE html>
<html lang="{{app()->getLocale()}}" @if(app()->getLocale() == 'ar') dir="rtl" @else dir="ltr" @endif>
<head>

    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<title>@yield('title')</title>
	<!-- Stylesheets -->
	<link href="{{asset('website/css/bootstrap.css')}}" rel="stylesheet">
	<link href="{{asset('website/css/fontawesome-all.css')}}" rel="stylesheet">
	<link href="{{asset('website/css/themify-icons.css')}}" rel="stylesheet">
	<link href="{{asset('website/css/owl.carousel.min.css')}}" rel="stylesheet">
	<link href="{{asset('website/css/owl.theme.default.min.css')}}" rel="stylesheet">
	<link href="{{asset('website/css/animate.css')}}" rel="stylesheet" />
		<link href="{{asset('website/css/slick.css')}}" rel="stylesheet" />
	<link href="{{asset('website/css/style.css')}}" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@if(app()->getLocale() == 'ar')
    	<link href="{{asset('website/css/rtl.css')}}" rel="stylesheet">
	@endif
	<!-- Responsive -->
	<link rel="icon" href="{{url('website/images/Raheeq_logo.png')}}">
	<link href="{{asset('website/css/responsive.css')}}" rel="stylesheet">
	<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->
	<script src="{{asset('website/js/jquery-3.2.1.min.js')}}"></script>
	     @yield('css')

	 @yield('socialMeta')

    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>

    <div class="mobile-menu">
	    <div class="menu-mobile">
	        <div class="brand-area">
	            <a href="{{route('home')}}">
	            	<img src="{{url('website/images/Raheeq_logo.png')}}">
	            </a>
	        </div>
	        <div class="mmenu">
		        <ul>
			        <li class="active"><a href="{{route('home')}}">@lang('website.HOME')</a></li>
                     <li class="m_user dropdown">
							<a href="#" class="dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">@lang('website.CATAGORIES')</a>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
								<ul class="profile_list">


							  @foreach(App\Models\Category::where('status','active')->get() as $temm)
                                     <li>
								    	<a href="{{route('category',[$temm->id,Str::slug($temm->name)])}}">{{$temm->name}}</a>
								    </li>
                              @endforeach


							    </ul>
							</div>
						</li>
                    <li><a href="{{route('NewArrival')}}">@lang('website.NEW')</a></li>
                    <li><a href="{{route('offers')}}">@lang('website.OFFERS')</a></li>
                    <li><a href="{{route('contact')}}">@lang('website.CONTACT US')</a></li>
                    <li><a href="{{route('pages','about-us')}}">@lang('website.ABOUT US')</a></li>
				</ul>
				<div class="lang-site">
                   @if(app()->getLocale() == 'en')
                        <?php
                        $lang = LaravelLocalization::getSupportedLocales()['ar']
                        ?>
                        <a href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}" class="">
                           {{ $lang['native'] }}
                        </a>
                    @else
                        <?php
                        $lang = LaravelLocalization::getSupportedLocales()['en']
                        ?>
                        <a href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}" class="">
                           {{ $lang['native'] }}
                        </a>
                    @endif
                </div>
			</div>
		</div>
		<div class="m-overlay"></div>
	</div>
	<!--mobile-menu-->

	<div class="main-wrapper">

        <header id="header">
            <div class="tp-header">
                <div class="container">
                    <div class="lang-site">
                       @if(app()->getLocale() == 'en')
                            <?php
                            $lang = LaravelLocalization::getSupportedLocales()['ar']
                            ?>
                            <a href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}" class="">
                               {{ $lang['native'] }}
                            </a>
                        @else
                            <?php
                            $lang = LaravelLocalization::getSupportedLocales()['en']
                            ?>
                            <a href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}" class="">
                               {{ $lang['native'] }}
                            </a>
                        @endif
                    </div>
                    <div class="logo-site">
                        <a href="{{route('home')}}">
                            <img src="{{url('website/images/Raheeq_logo.png')}}" alt="Logo" />
                        </a>
                    </div>
                    <ul class="site_op clearfix">
						<li class="search_site_xs">
							<a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#searchModal"><img src="{{url('website/images/search.svg')}}" alt=""></a>
						</li>
						<li class="m_cart">
							<a href="{{route('myCart')}}">


								<img  src="{{url('website/images/cart.svg')}}" alt="">
                                    <span id="cart_count"></span>
							</a>
						</li>
						<li class="m_user dropdown">
							<a href="#" class="dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><img src="{{url('website/images/user.svg')}}" alt=""></a>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
								<ul class="profile_list">
								    @auth
								    <li>
								    	<a href="{{route('myProfile')}}"><i class="ti-user"></i>@lang('website.My Profile')</a>
								    </li>
								    <li>
								    	<a href="{{route('myAddresses')}}"><i class="ti-location-pin"></i>@lang('website.My Address')</a>
								    </li>
								    <li>
								    	<a href="{{route('myOrders')}}"><i class="ti-package"></i>@lang('website.My Order')</a>
								    </li>
								    <li>
								    	<a href="{{route('myFavorites')}}"><i class="ti-heart"></i>@lang('website.My Favorites')</a>
								    </li>
								    <li>
								    	<a href="{{route('changePassword')}}"><i class="ti-lock"></i>@lang('website.Change Password')</a>
								    </li>
								    <li>
								    	<a href="{{route('logout')}}"><i class="ti-import"></i>@lang('website.Log Out')</a>
								    </li>
								    @endauth
								    @guest
								    <li>
								    	<a href="{{route('login')}}"><i class="ti-id-badge"></i>@lang('website.login')</a>
								    </li>
								    <li>
								    	<a href="{{route('register')}}"><i class="ti-id-badge"></i>@lang('website.register')</a>
								    </li>
								    @endguest
							    </ul>
							</div>
						</li>
					</ul>
                   <button type="button" class="hamburger is-closed">
                        <span class="hamb-top"></span>
                        <span class="hamb-middle"></span>
                        <span class="hamb-bottom"></span>
                    </button>
                </div>
            </div>
            <div class="bt-header">
			    <div class="container">
                    <ul class="main_menu clearfix">
                        <li class="active"><a href="{{route('home')}}">@lang('website.HOME')</a></li>
                        <li class="m_user dropdown">
							<a href="#" class="dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">@lang('website.CATAGORIES')</a>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
								<ul class="profile_list">
							  @foreach(App\Models\Category::where('status','active')->get()  as $temm)
                                     <li>
								    	<a href="{{route('category',[$temm->id,Str::slug($temm->name)])}}">{{$temm->name}}</a>
								    </li>
                              @endforeach


							    </ul>
							</div>
						</li>
                        <li><a href="{{route('NewArrival')}}">@lang('website.NEW')</a></li>
                        <li><a href="{{route('offers')}}">@lang('website.OFFERS')</a></li>
                        <li><a href="{{route('contact')}}">@lang('website.CONTACT US')</a></li>
                        <li><a href="{{route('pages','about-us')}}">@lang('website.ABOUT US')</a></li>
                    </ul>
                </div>
			</div>
		</header>
		<!--header-->

          @yield('content')
        <!--section_contact-->

		<footer id="footer">
            <div class="tp-footer">
                <div class="container">
                    <div class="content-form-newsletter">
                        <h3>@lang('website.Join Our Newsletter')</h3>
                        <form class="from-newsletter" id="subscribe_form">
                            <div class="form-group">
                                <input type="email" id="subscribe_emaill" required class="form-control" placeholder="example@example.com" />
                                <button class="btn-Subscribe btn-site send_subscribe"><span>@lang('website.Subscribe')</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="bt-footer">
				<div class="container">
					<div class="row">
						<div class="col-md-3 col-sm-6 col-xs-6">
							<div class="f-box">
								<h2>@lang('website.ABOUT US')</h2>
								<ul class="mmenu">
									<li><a href="{{route('pages','about-us')}}">@lang('website.ABOUT US')</a></li>
									<li><a href="{{route('contact')}}">@lang('website.Contact Us')</a></li>
									<li><a href="{{route('pages','privacy-policy')}}">@lang('website.Privacy Policy')</a></li>
									<li><a href="{{route('pages','terms-of-use')}}">@lang('website.Term Of Use')</a></li>
									<!--<li><a href="faq.html">FAQ</a></li>-->
								</ul>
							</div>
						</div>
						<div class="col-md-3 col-sm-6 col-xs-6">
							<div class="f-box">
								<h2>@lang('website.CUSTOMER CARE')</h2>
								<ul class="mmenu">
									<li><a href="{{route('contact')}}">@lang('website.Contact Us')</a></li>
									<!--<li><a href="centre.html">Info Centre</a></li>-->
									<li><a href="{{route('pages','shipping-returns')}}">@lang('website.Shipping & Returns')</a></li>
								</ul>
							</div>
						</div>
						<div class="col-md-3 col-sm-6 col-xs-6">
							<div class="f-box">
								<h2>@lang('website.YOU WILL LOVE US FOR')</h2>
								<ul class="mmenu">
									<li><a href="{{route('pages','quality-products')}}">@lang('website.Quality Products')</a></li>
									<li><a href="{{route('pages','free-sample-with-every-Order')}}">@lang('website.Free Sample with Every Order')</a></li>
									<li><a href="{{route('pages','fast-shipping-handling')}}">@lang('website.Fast Shipping & Handling')</a></li>
									<li><a href="{{route('pages','reliable-customer-Service')}}">@lang('website.Reliable Customer Service')</a></li>
								</ul>
							</div>
						</div>

						<div class="col-md-3 col-sm-6 col-xs-6">
							<div class="f-box">
								<ul class="list-social">
								    <!-- <li><a href="{{$setting->facebook}}"><i class="fab fa-facebook-f"></i></a></li>
								    <li><a href="{{$setting->twitter}}"><i class="fab fa-twitter"></i></a></li> -->
								    <li><a href="{{$setting->instagram}}"><i class="fab fa-instagram"></i></a></li>
								    <li><a href="{{$setting->twitter}}"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z"/></svg></a></li>
								</ul>

								<!-- <ul class="pay-list clearfix">
                                    <li>
                                        <a href="#"><img src="{{url('website/images/paypal.svg')}}" alt=""></a>
                                    </li>
                                    <li>
                                        <a href="#"><img src="{{url('website/images/maestro.svg')}}" alt=""></a>
                                    </li>
                                    <li>
                                        <a href="#"><img src="{{url('website/images/visa.svg')}}" alt=""></a>
                                    </li>
                                </ul> -->
                                <ul class="list-download">
                                    <li><a href="{{$setting->app_store_url}}" class=""><i class="fab fa-apple"></i></a></li>
                                    <li><a href="{{$setting->play_store_url}}" class=""><i class="fab fa-android"></i></a></li>
                                </ul>
							</div>
						</div>
					</div>
				</div>
			</div>

		</footer>
		<!--footer-->

		<!-- Modal -->
        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="container">
                        <div class="row">
                            <form class="search-box" method="get" action="{{route('search')}}">
                                <input type="text"  class="form-control" name="search" value="" onblur="if(this.value == '') { this.value ='@lang('website.Search here in Products')'; }" onfocus="if(this.value =='@lang('website.Search here in Products')') { this.value = ''; }">
                                <img src="{{url('website/images/search.svg')}}" alt="">
                            </form>
                        </div>
                    </div>
            </div>
          </div>
        </div>

	</div>
	<!--main-wrapper-->

	<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.j"></script>-->
 <!--   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>-->
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
	<script src="{{asset('website/js/owl.carousel.min.js')}}"></script>
	<script src="{{asset('website/js/wow.js')}}"></script>
	<script src="{{asset('website/js/slick.js')}}"></script>
	<script src="{{asset('website/js/script.js')}}"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    @yield('script')
    <script>
            $(document).on('click','input,select,textarea,.select2',function(){
        //   jQuery.noConflict();
            $(this).attr('style',"").next('span.errorSpan').remove();//
        });

           $(document).on('click','.addToFavorite',function (e) {
              e.preventDefault();
                    @if(!auth()->check())
                       return;
                    @endif
               var ele = $(this);
               var id = $(this).data("id");

              $.ajax({
                    url: '{{url(app()->getLocale().'/addToFavorite')}}'+'/'+id,
            		headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                    method: "get",
                    data: {
                    },
                    success: function (response) {
                        if(response.code==200){
                             // ele.removeClass('addToFavorite').addClass('removeFromFavorite').addClass('item_fav').fadeTo(100, 0.3, function() { $(this).fadeTo(500, 1.0); });

                            location.reload();
                        }


                    }

              });
          });

        $(document).on('click','.removeFromFavorite',function (e) {
              e.preventDefault();
                    @if(!auth()->check())
                       return;
                    @endif
              var ele = $(this);
               var id = $(this).data("id");
              $.ajax({
                    url: '{{url(app()->getLocale().'/removeFromFavorite')}}'+'/'+id,
            		headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                    method: "get",
                    data: {
                    },
                    success: function (response) {
                       // ele.removeClass('removeFromFavorite').removeClass('item_fav').addClass('addToFavorite');
                        location.reload();

                    }

              });
          });



      $(document).on('click','.addToCart',function (e) {
       e.preventDefault();
       var ele = $(this);
	   var id = $(this).data("id");
          var variantId = ele.data("variant-id");

          console.log("Product-id",id);
        $.ajax({
    		headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '{{url(app()->getLocale().'/addProductTocart')}}'+'/'+id,
            method: "get",
            data: {
                 quantity :$(".quantity_input").val(),
                variant_id: variantId

            },
            success: function (response) {

            $("#cart_count").html(response.count);
            location.reload();
            }
         });
     });


      $(document).on('click','.removeFromCart',function (e) {
        // $(".remove-from-cart").click(function (e) {
            e.preventDefault();
            console.log("Product-id",id);

            var ele = $(this);
            var id = $(this).data("id");
          var variantId = ele.data("variant-id");

          // var product_id = $(this).data("product_id");
                 $(this).find('span').html('{{__('website.addToCart')}}');
                // $(this).removeClass('removeFromCart').addClass("addToCart");
                $.ajax({
                    url:  '{{url(app()->getLocale().'/removeProductFromCart')}}'+'/'+id,
                    headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                         },
                    method: "get",
                    data: {
                        variant_id: variantId,

                    },
                    success: function (response) {
                        $("#cart_count").html(response.count);
                        location.reload();

                        // $(".quantity_div").hide();
                        // $(".quantity_div").find('input').val(1);
                        // $('.productCartItem'+id).hide(700).remove();
                        // ele.parent().parent().hide(700).remove();


                    }
                });

        });


                 $(document).on('click','.jsQuantityIncrease',function (e) {
               e.preventDefault();
               var ele = $(this);
        	   var id = $(this).data("id");
                     var variantId = ele.data("variant-id");
                     var variantTypeId = ele.data("variant-type-id");

                     console.log("variantId",variantId);


                     var quantity = $(this).parent().find('input[name="count-quat1"]').val();
             $('.productCartItem'+id+variantTypeId+variantId).find('input[name="count-quat1"]').val(quantity);
            $.ajax({
        		headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
                url: '{{url(app()->getLocale().'/changeQuantity')}}'+'/'+id,
                method: "get",
                data: {
                       type:1,
                        code_name:$('#code_name').val(),
                    variant_id:variantId,
                  },
                success: function (response) {
                        $('.sub_total').html(response.total_cart+' '+ '@lang('KWD')');
                        $('.discount_amount').html(response.discount+' '+ '@lang('KWD')');
                        $('.total_price').html(response.total+' '+ '@lang('KWD')');
                    }
             });
         });

        $(document).on('click','.jsQuantityDecrease',function (e) {
              e.preventDefault();
              var ele = $(this);
        	   var id = $(this).data("id");
            var variantId = ele.data("variant-id");
            var variantTypeId = ele.data("variant-type-id");


            var quantity = $(this).parent().find('input[name="count-quat1"]').val();
                var newQuantity = parseInt(quantity) - 1;
                if (quantity == 0 ) {


                    $.ajax({
                        url:  '{{url(app()->getLocale().'/removeProductFromCartPage')}}'+'/'+id,
                        headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                             },
                        method: "get",
                        data: {
                            code_name:$('#code_name').val(),
                            variant_id:variantId,

                        },
                        success: function (response) {
                            $('.sub_total').html(response.total_cart+' '+ '@lang('KWD')');
                            $('.discount_amount').html(response.discount+' '+ '@lang('KWD')');
                            $('.total_price').html(response.total+' '+ '@lang('KWD')');
                            $('.productCartItem'+id+variantTypeId+variantId).hide(700).remove();
                        }
                    });
                    location.reload();
               }else{
                   $('.product'+id).find('input[name="count-quat1"]').val(quantity);
                    $.ajax({
                		headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{url(app()->getLocale().'/changeQuantity')}}'+'/'+id,
                        method: "get",
                        data: {
                             type:2,
                             code_name:$('#code_name').val(),
                            variant_id:variantId,
                          },
                        success: function (response) {
                            $('.sub_total').html(response.total_cart+' '+ '@lang('KWD')');
                            $('.discount_amount').html(response.discount+' '+ '@lang('KWD')');
                            $('.total_price').html(response.total+' '+ '@lang('KWD')');
                        }
                     });
               }
             });

        $(document).on('click','.send_subscribe',function (e) {
            e.preventDefault();

            $(this).closest("#subscribe_form").find( 'select, textarea, input' ).each(function(){
                  if($(this).prop('required') && !$(this).val() && !$(this).is(":hidden")){
                      $(this).css("border", "#ff0000 solid 1px").next('span.errorSpan').remove(); //

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
        var id = $(this).data("id");
        var type = '{{Route::currentRouteName()}}';

        $.ajax({
            url: '{{url(app()->getLocale().'/subscribeNow')}}',
            type: "post",
            data: {
                _token: '{{ csrf_token() }}',
                type: type,
                email: $('#subscribe_emaill').val(),

            },
            success: function (response) {
            // return response;
                if(response.code ==300){
                //  $("#completO, #completeT").hide(2000);
                //    jQuery.noConflict();
                    swal({
                        title: "{{__('website.ok')}}",
                        icon: "success",
                        button: "{{__('website.oky')}}",
                    });
                    $('#subscribe_emaill').val('');
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

    </script>
	<script>
		new WOW().init();
	</script>


</body>
</html>
