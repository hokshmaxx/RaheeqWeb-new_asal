
{{-- <html lang="en">
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
	</head> --}}

@extends('website.layout')
@section('title') 
{{-- @if($type=='login') --}}
@section('css')
@endsection
@section('content')
{{-- @lang('website.register') --}}
<section class="section_page_site">
    <div class="container">
        <div class="sec-head">
            <h3>@lang('website.vender_request_register')</h3> 
        </div>

        <div class="tab-pane fade">
        </div>
            <div class="content-reg">
                    <div class="container">
                        <center><h3>@lang('website.vender_request')</h3></center> 
                        {{-- <div class="row"> --}}
                            {{-- <div class="col-md-8 col-md-offset-2">
                                <div class="panel panel-default"> --}}
                                    {{-- <div class="panel-heading" style="padding-bottom: 10px;"><h2>Registeration Request</h2></div> --}}
                                    <div class="tab-content">
                                        {{-- <div class="tab-pane fade"> --}}
                                            <form class="form-sign register_form" role="form" method="POST" action="{{url(app()->getLocale().'/register_vender') }}">
                                                {{ csrf_field() }}
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="name" placeholder="@lang('name')" required />
                                                </div>
                                                <div class="form-group">
                                                    <input type="email" class="form-control" name="email" placeholder="@lang('website.email')" required />
                                                </div>
                                                <div class="form-group">
                                                    <input  type="text"  class="form-control" name="storename" placeholder="storename" required />
                                                </div>
                                                <div class="form-group">
                                                    <textarea id="comment" type="comment" class="form-control" placeholder="comment " name="comment" rows="4" cols="50"></textarea>
                                                </div>
                                                <div class="form-group btn-auto">
                                                    <button type="submit" class="btn-site register_send_form">
                                                        @lang('website.vender_request')
                                                    </button>
                                                </div>
                                            </form> 
                                        </div>
                                    </div>
                            {{--</div>--}}
                        </div>
            </div>
        </div>
    </div>
    
</section>
    
@endsection
                        
						