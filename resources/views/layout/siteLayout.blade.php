
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="description" content="Skipper Fly">
    <meta name="keywords" content="Skipper Fly">

    <title>
        @yield('title')
    </title>

    <!-- Stylesheets -->
    @yield('css')

    <link href="{{ url('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ url('css/fontawesome-all.css') }}" rel="stylesheet">
    <link href="{{ url('css/animate.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('css/emojionearea.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link  href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
    <link href="{{ url('css/vendors.css') }}" rel="stylesheet" />
    <link href="{{ url('css/style.css') }}" rel="stylesheet">

    @if(app()->getLocale() == 'ar')
        <link href="{{url('css/bootstrap-rtl.min.css')}}" rel="stylesheet">
        <link href="{{url('css/rtl.css')}}" rel="stylesheet">
    @endif

    <!-- Responsive -->
    <link href="{{ url('css/responsive.css') }}" rel="stylesheet">

    <!-- Cairo Font - Must be AFTER all other CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        /* Set Cairo as the base font - MOST IMPORTANT */
        :root {
            --font-family-base: 'Cairo', sans-serif;
        }

        * {
            font-family: 'Cairo', sans-serif !important;
        }

        html,
        body {
            font-family: 'Cairo', sans-serif !important;
        }

        /* All text elements */
        h1, h2, h3, h4, h5, h6,
        p, span, div, a, button,
        input, textarea, select,
        label, li, ul, ol, td, th,
        .btn, .form-control, .modal,
        .dropdown-menu, .navbar {
            font-family: 'Cairo', sans-serif !important;
        }

        /* Select2 dropdown */
        .select2-container,
        .select2-selection,
        .select2-results {
            font-family: 'Cairo', sans-serif !important;
        }

        /* Menu items */
        .main_menu,
        .mmenu,
        .dropdown_profile,
        .notifications_list {
            font-family: 'Cairo', sans-serif !important;
        }
    </style>

    <script src="{{ url('js/jquery-3.3.1.min.js') }}"></script>
    <script src="https://cdn.tiny.cloud/1/h21rul0lri8f1wuiahke5dyfy97df45xbhijowifclarmsmv/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

</head>
<body>
	<div class="mobile-menu">
	    <div class="menu-mobile">
	        <div class="brand-area">
				<a href="{{ route('HomePage') }}">
	            	<img src="{{url($setting->logo)}}">
	            </a>
	        </div>
	        <div class="mmenu">
		        <ul>
					<li><a href="{{ route('HomePage') }}" data-value="home" title="{{ __('website.Home') }}"> {{ __('website.Home') }} </a></li>
					<li><a href="{{ route('services') }}" data-value="{{ route('services') }}"> {{ __('website.OurServices') }} </a></li>
					<li><a href="#" data-value="faq"> {{ __('website.FAQ') }} </a></li>
					<li><a href="#" data-value="contact"> {{ __('website.Contact') }} </a></li>
				</ul>
				<ul class="clearfix">
					<li><a href="#">Arabic</a></li>
				</ul>
			</div>
			<ul class="social_links clearfix">
				<li>
					<a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
				</li>
				<li>
					<a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
				</li>
				<li>
					<a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
				</li>
			</ul>
		</div>
		<div class="m-overlay"></div>
	</div>
	<!--mobile-menu-->
	<div class="main-wrapper">

		<header id="header">
			<div class="container">
				<div class="logo-site">
					<a href="{{ route('HomePage') }}">
						<img src="{{url('images/logo.png')}}" alt="" class="img-responsive">
					</a>

					<form class="sec_search" action="">
					  <input type="search">
					  <i class="fa fa-search"></i>
					</form>
				</div>

				<ul class="main_menu clearfix">
                    <li class="{{ @Request::segment(2) == NULL? 'active' : '' }}" title="{{ __('website.Home') }}"><a href="{{ route('HomePage') }}"><img  src="{{ url('images/home.svg') }}"></a></li>
                    <li class="{{ @Request::segment(2) == 'trips'? 'active' : '' }}" title="{{ __('website.Trips') }}"><a href="{{ route('trips','main') }}"><img src="{{ url('images/beach.svg') }}"></a></li>
                    <li class="{{ @Request::segment(2) == 'services'? 'active' : '' }}" title="{{ __('website.Services') }}"><a href="{{ route('getMainServices','main') }}"><img src="{{ url('images/service.svg') }}"></a></li>
                    <li class="{{ @Request::segment(2) == 'main-map'? 'active' : '' }}" title="{{ __('website.MainMap') }}"><a href="{{ route('main-map') }}"><img src="{{ url('images/globe.svg') }}"></a></li>
				</ul>

				<div class="head_right clearfix">
					<ul class="list_home clearfix">
						<li class="list_header">


							<a class="dropdown-toggle" href="{{ Auth::user()? "" : "#register" }}"
                            data-toggle="{{ Auth::user()? "dropdown" : "modal" }}">
                                <img class="img_acount" src="{{ Auth::user()? url(Auth::user()->logo)  : url('images/newUser.png') }}">
                            </a>


							<div class="dropdown-menu dropdown_profile dropdown_st1">
								<div class="dropdown_head">
									<div class="user_profile clearfix" style="background: url({{ @Auth::user()->cover }})">
										<a href="" class="avatar_thumb">
											<img src="{{ Auth::user()? url(Auth::user()->logo)  : url('images/newUser.png') }}" alt="profile">
											<h2> {{ @Auth::user()->first_name }} {{ @Auth::user()->last_name }} </h2>
										</a>
									</div>
								</div>
								<ul class="profile_list">

								    @auth
							    	<li>
								    	<a href="{{ route('userProfile', Auth::user()->user_id) }}"><i class="fas fa-user"></i>My Profile</a>
								    </li>
								    @endauth

								    <li>
								    	<a href=""><i class="fas fa-question"></i>Help & Support</a>
								    </li>
								    <li>
								    	<a href=""><i class="fas fa-cog"></i>Settings</a>
								    </li>
								    <li>
								    	<a href="{{ route('userlogout') }}"><i class="fas fa-sign-out-alt"></i>Log Out</a>
								    </li>
							    </ul>
							</div>
						</li>


						<li class="list_header">

							<a class="dropdown-toggle" id="show_notifications" href="{{ Auth::user()? "" : "#register" }}"
							data-toggle="{{ Auth::user()? "dropdown" : "modal" }}">
								<img src="{{ url('images/bell.svg') }}"></a>


							<div class="dropdown-menu dropdown_notifications dropdown_st1">
								<div class="sec_head_drop">
									<h3>Notifications</h3>
									<a class="option_notifications">
										<i class="fas fa-expand-arrows-alt"></i>
									</a>
					    		</div>
								<ul class="notifications_list" id="notifications_list">



							    </ul>
							</div>
						</li>



						<li class="list_header">

							<a class="dropdown-toggle" href="{{ Auth::user()? "" : "#register" }}"
							data-toggle="{{ Auth::user()? "dropdown" : "modal" }}">
								<img src="{{ url('images/message.svg') }}"></a>

							<div class="dropdown-menu dropdown_notifications dropdown_st1">
								<div class="sec_head_drop">
									<h3>Messages</h3>
									<a class="option_notifications">
										<i class="fas fa-expand-arrows-alt"></i>
									</a>
								</div>

								<ul class="notifications_list">
							    	<li class="active_noti">
								    	<a href="">
											<figure>
												<img src="{{ url('images/pro2.jpg') }}" alt="" class="img-responsive" />
											</figure>
											<div class="sec_title">
												<h6>Ala Nasrallah</h6>
												<p>Hello How are you doing?..</p>
											</div>
						    				<time>10m</time>
							    		</a>
								    </li>
								    <li>
								    	<a href="">
											<figure>
												<img src="{{ url('images/pro3.jpg') }}" alt="" class="img-responsive" />
											</figure>
											<div class="sec_title">
												<h6>Mira Shirnova</h6>
												<p>it’s very nice</p>
											</div>
						    				<time>12/0282018</time>
							    		</a>
								    </li>
							    </ul>
							</div>
						</li>




						<li class="list_header">

							<a class="dropdown-toggle" href="{{ Auth::user()? "" : "#register" }}"
							data-toggle="{{ Auth::user()? "dropdown" : "modal" }}">
								<img src="{{ url('images/wallet.svg') }}"></a>

						</li>



						<li class="list_header">

							<a class="dropdown-toggle" href="{{ Auth::user()? "" : "#register" }}"
                            data-toggle="{{ Auth::user()? "dropdown" : "modal" }}">
                                <img src="{{ url('images/plus.svg') }}"></a>

							<div class="dropdown-menu dropdown_request dropdown_st1">
								<ul class="request_list">


								    @auth
								    @if(Auth::user()->type != 'Guide')
							    	<li>
								    	<a href="{{ route('NewProposeService') }}">Propose a Service</a>
								    </li>
								    <li>
								    	<a href="{{ route('NewProposeJourney') }}">Propose a Trip</a>
								    </li>
								    @endif


								    @if(Auth::user()->type == 'Guide')
							    	<li>
								    	<a href="{{ route('addNewService') }}">Add new Service</a>
								    </li>
								    <li>
								    	<a href="{{url(app()->getLocale().'/addNewJourney')}}">Add new Trip</a>
								    </li>
								    @endif
								    @endauth




							    </ul>
							</div>
						</li>


					</ul>
				</div>
				<button type="button" class="hamburger is-closed">
			        <span class="hamb-top"></span>
			        <span class="hamb-middle"></span>
			        <span class="hamb-bottom"></span>
			    </button>
			</div>
		</header>
		<!--header-->



		@yield('content')




<div id="register" class="modal fade modal-st1" role="dialog">
	<div class="modal-dialog">
	  <div class="modal-content">
			<div class="content-reg sign-in" id="sign-in">
				   <div class="sec-head clearfix">
				  <img src="{{ url('images/logo.png') }}" alt="" />
				  <span>Welcome back – log in!</span>
			  </div>
			  <div class="modal-body">


				<form class="form-st1" method="post" action="{{ route('LoginUser') }}" enctype="multipart/form-data">
					{{ csrf_field() }}

					  <div class="form-group">
						  <label class="control-label">Email Address</label>
						  <input type="email" class="form-control" name="email" placeholder="Enter Your Email Address" />
					  </div>
					  <div class="form-group">
						  <label class="control-label">Password</label>
						  <input type="password" class="form-control" name="password" id="password" placeholder="Enter Your Name" />
					  </div>
					  <a class="forgot-password">Forgot your password?</a>
					  <div class="form-group">
						  <button type="submit" class="btn btn-submit inline marg-t20">Log in</button>
					  </div>
					  <p>Don’t have an account? <span class="show-signup">Sign up</span></p>
				  </form>
			  </div>
				<div class="sec-footer">
				  <div class="form-group">
					  <b>or</b>
					  <ul>
						  <li class="log-facebook"><i></i> <span>Continue with Facebook</span></li>
						  <li class="log-google"><i></i> <span> Continue with Google</span></li>
					  </ul>
				  </div>
			  </div>
			</div>


			<div class="content-reg sign-up" id="sign-up">
				<div class="sec-head clearfix">
				  <img src="images/logo.png" alt="" />
				  <span>Join now – it’s free!</span>
			  </div>
			  <div class="modal-body">



				  <form class="form-st1"  method="post" action="{{ route('SignUp') }}" enctype="multipart/form-data">
					  {{ csrf_field() }}

					  <div class="form-group">
						  <label class="control-label">Email Address</label>
						  <input type="email" name="email" class="form-control" placeholder="Enter Email Address" required />
					  </div>
					  <div class="form-group">
						  <label class="control-label">Create password</label>
						  <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password" required />
						  <span class="show_pass" onclick="show()" id="EYE"><i class="fa fa-eye-slash"></i></span>
					  </div>
					  <div class="form-group">
						  <label>Will join us as?</label>
						  <ul class="type-reg">
							  <li class="checked-address">
								  <input data-image="" type="radio" id="Guide" name="type" checked value="tour">
								  <label for="cards">
									<span></span>
									Guide
								  </label>
							  </li>
							  <li class="checked-address">
								  <input data-image="" type="radio" id="Traveler" name="type" value="user">
								  <label for="cards">
									<span></span>
									Traveler
								  </label>
							  </li>
						  </ul>
					  </div>
					  <div class="form-group">
						  <button type="submit" class="btn btn-submit inline marg-t20">Sign Up</button>
					  </div>
				  </form>


				</div>
				<div class="sec-footer">
				  <div class="form-group">
					  <b>or</b>
					  <ul>
						  <li class="log-facebook"><i></i> <span>Continue with Facebook</span></li>
						  <li class="log-google"><i></i> <span> Continue with Google</span></li>
					  </ul>
				  </div>
				  <p>By proceeding, you agree to our <a href="">Terms of Use</a> and confirm you have read our <a href="">Privacy Policy.</a></p>
				  <p>Already have an account? <span class="show-signin">Sign in</span></p>
			  </div>
			</div>
	  </div>
	</div>
  </div>


<div class="loding-site"  style="display: none">
  <span class="circle circle-1"></span>
  <span class="circle circle-2"></span>
  <span class="circle circle-3"></span>
  <span class="circle circle-4"></span>
  <span class="circle circle-5"></span>
  <span class="circle circle-6"></span>
  <span class="circle circle-7"></span>
  <span class="circle circle-8"></span>
</div>



<script>
$(document).ready(function(){


    /////////////////////// View Cities ////////////////////
    $(document).on('change','.country',function(e){
        var country_id = $(this).val();
        var url = "{{ url(app()->getLocale().'/getCities/') }}";
        if(country_id){
            $.ajax({
                type: "GET",
                url: url+'/'+country_id,
                success: function (response) {
                    if(response)
                    {
                        $(".city").empty();
                        $(".city").append('<option value="">{{__('website.choose_city')}}</option>');
                        $.each(response, function(index, value){
                        $(".city").append('<option value="'+value.id+'">'+ value.name +'</option>');
                        $(".city").append('</optgroup>');
                    });
                }
              }
            });
        }
        else{
            $(".city").empty();
        }
    });



    $(document).on('click','#show_notifications',function (e) {
              e.preventDefault();
              var ele = $(this);
              var id = $(this).val();
              $.ajax({
                    url: '{{url(app()->getLocale().'/getMyNotifications')}}',
            		headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                    type: "get",
                    data: {
                        category_id:$('#category_id').val(),
                        city_id:$('#city_id').val(),
                         _token: '{{ csrf_token() }}',

                    },
                    success: function (response) {

                      $("#notifications_list").html(response.html);
                    }
              });
          });





});
</script>


	</div>
	<!--main-wrapper-->

	@yield('js')

	<script src="{{ url('js/bootstrap.min.js') }}"></script>
	<script src="{{ url('js/wow.js') }}"></script>
	<script src="{{ url('js/jquery-ui.min.js') }}"></script>
	<script src="{{ url('js/jquery.steps.js') }}"></script>

	<script src="{{ url('js/emojionearea.min.js') }}"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>
	<script src="{{ url('js/range-slider.js') }}"></script>
	<script src="{{ url('js/jquery.malihu.PageScroll2id.min.js') }}"></script>

	<script src="{{ url('js/script.js') }}"></script>



<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>







    <script>
        function show() {
		var a=document.getElementById("password");
		if (a.type=="password")  {
			a.type="text";
			$('#EYE').html('<i class="fa fa-eye-slash"></i>')
		}
		else {
			a.type="password";
			$('#EYE').html('<i class="fa fa-eye"></i>')
		}
	}
    </script>




    	<script>



	/**============wizard============**/

	$("#wizard").steps({
        headerTag: "h4",
        bodyTag: "section",
        transitionEffect: "fade",
        enableAllSteps: true,
        transitionEffectSpeed: 500,
        onStepChanging: function (event, currentIndex, newIndex) {
            if ( newIndex === 1 ) {
                $('.steps ul').addClass('step-2');
            } else {
                $('.steps ul').removeClass('step-2');
            }
            if ( newIndex === 2 ) {
                $('.steps ul').addClass('step-3');
            } else {
                $('.steps ul').removeClass('step-3');
            }

            if ( newIndex === 3 ) {
                $('.steps ul').addClass('step-4');
                $('.actions ul').addClass('step-last');
            } else {
                $('.steps ul').removeClass('step-4');
                $('.actions ul').removeClass('step-last');
            }
            return true;
        },
        labels: {
            finish: "Place Holder",
            next: "Next",
            previous: "Previous"
        }
    });
    // Custom Steps Jquery Steps
    $('.wizard > .steps li a').click(function(){
    	$(this).parent().addClass('checked');
		$(this).parent().prevAll().addClass('checked');
		$(this).parent().nextAll().removeClass('checked');
    });
    // Custom Button Jquery Steps
    $('.forward').click(function(){
    	$("#wizard").steps('next');
    });
    $('.backward').click(function(){
        $("#wizard").steps('previous');
    });
    // Checkbox
    $('.checkbox-circle label').click(function(){
        $('.checkbox-circle label').removeClass('active');
        $(this).addClass('active');
    });


    /**============select2============**/


		$(".select").select2({
			placeholder: {
			id: '1', // the value of the option
			text: 'You can add more than one nationality '
		  }
		});
		$(".select-country").select2();
		$(".select-city").select2({
			placeholder: {
			id: '1', // the value of the option
			text: 'Choose Cities'
		  }
		});



		$(".select-interest").select2({
			placeholder: {
			id: '1', // the value of the option
			text: 'Select Interests'
		  }
		});


		/**============UPLOAD MULTIPLE IMAGES============**/

		function readURLMultiple(input, placeToInsertImagePreview) {

        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    $(placeToInsertImagePreview).append('<div class="imagePost"><img src="'+event.target.result+'"><span class="deleteImage fal fa-close"></span></div>');
                    $('.galleryInputs').append('<input class="imagesValue" type="hidden" name="images[]" value="'+event.target.result+'">');
                }

                reader.readAsDataURL(input.files[i]);
            }
        }

    };

    $('#gallery-photo-add').on('change', function() {
        readURLMultiple(this, '.images_services');
    });

	</script>












</body>
</html>
