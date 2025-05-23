
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>{{__('cp.Login_Into_Panel')}}</title>
		<meta name="description" content="Login page example" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<link href="{{asset('/admin_assets/css/pages/login/login-4.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('/admin_assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('/admin_assets/plugins/custom/prismjs/prismjs.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('/admin_assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('/admin_assets/css/themes/layout/header/base/light.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('/admin_assets/css/themes/layout/header/menu/light.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('/admin_assets/css/themes/layout/brand/dark.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('/admin_assets/css/themes/layout/aside/dark.css')}}" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="{{$setting->logo}}" />
	</head>

    <body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
		<!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Login-->
			<div class="login login-4 login-signin-on d-flex flex-column flex-lg-row flex-row-fluid bg-white" id="kt_login">
				<!--begin::Aside-->
				<div class="login-aside order-2 order-lg-1 d-flex flex-column-fluid flex-lg-row-auto bgi-size-cover bgi-no-repeat p-7 p-lg-10">
					<!--begin: Aside Container-->
					<div class="d-flex flex-row-fluid flex-column justify-content-between">
						<!--begin::Aside body-->
						<div class="d-flex flex-column-fluid flex-column flex-center mt-5 mt-lg-0">
							<a href="#" class="mb-15 text-center">
								<img src="{{$setting->logo}}" class="max-h-75px" alt="" />
							</a>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">Register</div>
                                            <div class="panel-body">
                                                <form class="form-horizontal" role="form" method="POST" action="{{url(app()->getLocale().'/vender/register') }}">
                                                    {{ csrf_field() }}

                                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                                        {{-- <label for="name" class="col-md-4 control-label">Name</label> --}}

                                                        <div class="col-md-8">
                                                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Name" autofocus>

                                                            @if ($errors->has('name'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('name') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                        {{-- <label for="email" class="col-md-4 control-label">E-Mail Address</label> --}}

                                                        <div class="col-md-8">
                                                            <input id="email" type="email" class="form-control" name="email"placeholder="E-Mail Address " value="{{ old('email') }}">

                                                            @if ($errors->has('email'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('email') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    
                                                    {{-- <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}"> --}}
                                                        {{-- <label for="mobile" class="col-md-4 control-label">E-Mail Address</label> --}}
{{-- 
                                                        <div class="col-md-8">
                                                            <input id="mobile" type="mobile" class="form-control" name="mobile"placeholder="Mobile number " value="{{ old('mobile') }}">

                                                            @if ($errors->has('mobile'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('mobile') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div> --}}

                                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                                        {{-- <label for="password" class="col-md-4 control-label">Password</label> --}}

                                                        <div class="col-md-8">
                                                            <input id="password" type="password" class="form-control" placeholder="Password " name="password">

                                                            @if ($errors->has('password'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('password') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                                        {{-- <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label> --}}

                                                        <div class="col-md-8">
                                                            <input id="password-confirm" type="password" class="form-control"placeholder= "Confirm Password" name="confirm_password">

                                                            @if ($errors->has('password_confirmation'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="col-md-8 col-md-offset-4">
                                                            <button type="submit" class="btn btn-primary">
                                                                Register
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form> 

                                                {{-- <form class="form-horizontal" method="post" action="{{url(app()->getLocale().'/admin/register')}}"
                                                    role="form" id="form" enctype="multipart/form-data" >
                                                    @csrf
                                                                        
                                                    <div class="card-body">
                                                        <div class="row">
                                                
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="name">{{__('cp.name')}}</label>
                                                                    <input type="text" class="form-control form-control-solid" name="name" 
                                                                        value="{{ old('name') }}" id="name" required />
                                                                </div>
                                                            </div>
                                                        
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="email">{{__('cp.email')}}</label>
                                                                    <input type="email" class="form-control form-control-solid" name="email" 
                                                                        value="{{ old('email') }}" id="email" required />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="mobile">{{__('cp.mobile')}}</label>
                                                                    <input type="mobile" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="form-control form-control-solid" name="mobile" 
                                                                        value="{{ old('mobile') }}" id="mobile" required />
                                                                </div>
                                                            </div>
                                                        </div>
                                
                                                        <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="password">{{__('cp.password')}}</label>
                                                                <input type="password" class="form-control form-control-solid" name="password" 
                                                                    value="{{ old('password') }}" id="password" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="confirm_password">{{__('cp.confirm_password')}}</label>
                                                                <input type="password" class="form-control form-control-solid" name="confirm_password" 
                                                                    value="{{ old('confirm_password') }}" id="confirm_password" required />
                                                            </div>
                                                        </div>
                                                    </div>                    
                                                    </div>
                        
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="fileinputForm">
                                                                    <label >{{__('cp.image')}}</label>
                                                                    <div class="fileinput-new thumbnail"
                                                                        onclick="document.getElementById('edit_image').click()"
                                                                        style="cursor:pointer">
                                                                        <img src="{{url(admin_assets('images/ChoosePhoto.png'))}}" id="editImage" style="width: 10pc;                                                                    ">
                                                                    </div>
                                                                    <div class="btn btn-change-img red"
                                                                        onclick="document.getElementById('edit_image').click()">
                                                                        <i class="fas fa-pencil-alt"></i>
                                                                    </div>
                                                                    <input type="file" class="form-control" name="image"
                                                                    id="edit_image"
                                                                    style="display:none" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    
                                                    <div class="form-group">
                                                        <div class="col-md-6 col-md-offset-4">
                                                            <button type="submit" class="btn btn-primary">
                                                                Register
                                                            </button>
                                                        </div>
                                                    </div>
                                                    
                                                </form> --}}
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
						</div>
						<!--end::Aside body-->
						
					</div>
					<!--end: Aside Container-->
				</div>
				<!--begin::Aside-->
				<!--begin::Content-->
				<div class="order-1 order-lg-2 flex-column-auto flex-lg-row-fluid d-flex flex-column p-7" style="background-image: url({{url('admin_assets/media/bg/bg-4.jpg')}});">
					<!--begin::Content body-->
					<div class="d-flex flex-column-fluid flex-lg-center">
						<div class="d-flex flex-column justify-content-center">
							<h3 class="display-3 font-weight-bold my-7 text-white">{{__('Welcome to Vender panel')}}</h3>
							{{-- <p class="font-weight-bold font-size-lg text-white opacity-80">The ultimate Bootstrap, Angular 8, React &amp; VueJS admin theme
							<br />framework for next generation web apps.</p> --}}
						</div>
					</div>
					<!--end::Content body-->
				</div>
				<!--end::Content-->
			</div>
			<!--end::Login-->
		</div>
		<!--end::Main-->
		<script>var HOST_URL = "https://keenthemes.com/metronic/tools/preview";</script>
		<!--begin::Global Config(global config for global JS scripts)-->
		<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };</script>
		<!--end::Global Config-->
		<!--begin::Global Theme Bundle(used by all pages)-->
		<script src="{{asset('/admin_assets/plugins/global/plugins.bundle.js')}}"></script>
		<script src="{{asset('/admin_assets/plugins/custom/prismjs/prismjs.bundle.js')}}"></script>
		<!--<script src="{{asset('/admin_assets/js/scripts.bundle.js')}}"></script>-->
		<!--end::Global Theme Bundle-->
		<!--begin::Page Scripts(used by this page)-->
		<script src="{{asset('/admin_assets/js/pages/custom/login/login-general.js')}}"></script>
		<!--end::Page Scripts-->
	</body>
	<!--end::Body-->
</html>