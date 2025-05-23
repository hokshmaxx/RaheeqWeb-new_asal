@extends('website.layout')
@section('title') 
@if($type=='login')
@lang('website.login_text') @else @lang('website.register_text') @endif @endsection
@section('css')
@endsection
@section('content')

  <section class="section_page_site">
		    <div class="container">
                <div class="sec-head">
                    @if($type=='login')
                      <h3>@lang('website.login_text')</h3>
                    @else  
                     <h3>@lang('website.register_text')</h3>
                    @endif
                     
                </div>

		        <div class="content-reg">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{($type=='login') ? "active":""}}" id="login-tab" data-bs-toggle="tab" data-bs-target="#login" type="button" role="tab" aria-controls="login" aria-selected="true">@lang('website.login')</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{($type=='register') ? "active":""}}" id="register-tab" data-bs-toggle="tab" data-bs-target="#register" type="button" role="tab" aria-controls="register" aria-selected="false">@lang('website.register')</button>
                        </li>
                    </ul>
                    
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade {{($type=='login') ? "show active":""}}" id="login" role="tabpanel" aria-labelledby="login-tab">
                            <form class="form-sign login_form">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control" name="email" placeholder="@lang('website.email')" required />
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" placeholder="@lang('website.password')" value="" required />
                                </div>
                                <div class="ds-flex">
                                    <div>
                                        <input class="inp-cbx" id="cbx" name="chexk" name="remember" type="checkbox" style="display: none;">
                                        <label class="cbx" for="cbx">
                                            <span><svg width="12px" height="9px" viewBox="0 0 12 9"><polyline points="1 5 4 8 11 1"></polyline></svg>
                                            </span>
                                            <div class="sec-title">
                                                <p>@lang('website.Remember me ?')</p>
                                            </div>
                                        </label>
                                    </div>
                                    <a href="{{route('forgotPasswordForm')}}" class="forgot-password">@lang('website.Forgot Password ?')</a>
                                </div>
                                <div class="form-group">
                                    <button class="btn-site login_send_form"><span>@lang('website.Sign In')</span></button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade {{($type=='register') ? "show active":""}}" id="register" role="tabpanel" aria-labelledby="register-tab">
                            <form class="form-sign register_form">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" placeholder="@lang('website.Full Name')" required />
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" placeholder="@lang('website.email')" required />
                                </div>
                                <div class="form-group">
                                    <input  type="text"  class="form-control" name="mobile" placeholder="@lang('website.mobile')" required />
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" placeholder="@lang('website.password')" required />
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="confirm_password" placeholder="@lang('website.Confirm Password')" required />
                                </div>
                                <div class="form-group btn-auto">
                                    <button class="btn-site register_send_form"><span>@lang('website.register')</span></button>
                                </div>
                            </form>
                        </div>
                        <div>
                            <a href="{{url(app()->getLocale().'/register_vender') }}">
                                 <h6 style=" color: #000;"> click here to Register as Vendor </h6>
                            </a>
                        </div>
                    </div>
                </div>
		    </div>
		</section>

@endsection

@section('script')

<script>    
var preventSubmit = false;
 
$(document).on('click','.login_send_form',function (e) {
            e.preventDefault();
            var formData = new FormData($('.login_form')[0]);
            $('.login_form').find( 'select, textarea, input' ).each(function(){
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
      // $('.contact_us').html('<i class="fa fa-spinner fa-spin" style="font-size: 20px;"></i>'+' '+'{{__('website.send')}}');
         $('.login_send_form').html('<i class="fa fa-spinner fa-spin" style="font-size: 20px;"></i>')
         $(".login_send_form").attr("disabled", true);
        var ele = $(this);
        var id = $(this).data("id");
        $.ajax({
            url: '{{url(app()->getLocale().'/login')}}', 
            type: "post", 
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if(response.code ==200){
                    // swal({
                    //     title: "{{__('website.ok')}}",
                    //     icon: "success",
                    //     button: "{{__('website.oky')}}",
                    // });
                    $(".login_form").find("input, textarea ,select").val("");
                    $('.login_send_form').html('<span>{{__('website.Sign In')}}</span>')
                    $(".login_send_form").attr("disabled", false);
                    $('input[name="_token"]') .val('{{ csrf_token() }}');
                    location.href='{{route('home')}}';
                    return
                }else if(response.validator !=null){    
                            swal({
                            text: response.validator,
                            button: "{{__('website.oky')}}",
                            dangerMode: true,
                        });
                         $('.login_send_form').html('<span>{{__('website.Sign In')}}</span>')
                         $(".login_send_form").attr("disabled", false);
                } else{
                    swal(response.message)
                    $('.login_send_form').html('<span>{{__('website.Sign In')}}</span>')
                    $(".login_send_form").attr("disabled", false);
                }
            } 
            
        });
    });
    
  var preventRegisterSubmit = false;  
    $(document).on('click','.register_send_form',function (e) {
            e.preventDefault();
            var formData = new FormData($('.register_form')[0]);
            $('.register_form').find( 'select, textarea, input' ).each(function(){
                  if($(this).prop('required') && !$(this).val() && !$(this).is(":hidden")){
                      $(this).css("border", "#ff0000 solid 1px").next('span.errorSpan').remove(); //
                           $(this).css("border", "#bd1616 solid 1px").after('<span style="color:#bd1616" class="errorSpan">{{__("website.requiredField")}}</span>');
                      preventRegisterSubmit = true;
                      e.preventDefault();
                  }
              });
              if(preventRegisterSubmit){
                  preventRegisterSubmit = false;
                  return false;
                  
              }
      // $('.contact_us').html('<i class="fa fa-spinner fa-spin" style="font-size: 20px;"></i>'+' '+'{{__('website.send')}}');
         $('.register_send_form').html('<i class="fa fa-spinner fa-spin" style="font-size: 20px;"></i>')
         $(".register_send_form").attr("disabled", true);
        var ele = $(this);
        var id = $(this).data("id");
        $.ajax({
            url: '{{url(app()->getLocale().'/register')}}', 
            type: "post", 
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if(response.code ==200){
                    // swal({
                    //     title: "{{__('website.ok')}}",
                    //     icon: "success",
                    //     button: "{{__('website.oky')}}",
                    // });
                    $(".register_form").find("input, textarea ,select").val("");
                    $('.register_send_form').html('<span>{{__('website.register')}}</span>')
                    $(".register_send_form").attr("disabled", false);
                    $('input[name="_token"]') .val('{{ csrf_token() }}');
                    location.href='{{route('home')}}';
                    return
                }else if(response.validator !=null){    
                            swal({
                            text: response.validator,
                            button: "{{__('website.oky')}}",
                            dangerMode: true,
                        });
                         $('.register_send_form').html('<span>{{__('website.register')}}</span>')
                         $(".register_send_form").attr("disabled", false);
                } else{
                    swal(response.message)
                    $('.register_send_form').html('<span>{{__('website.register')}}</span>')
                    $(".register_send_form").attr("disabled", false);
                }
            } 
            
        });
    });
    </script>
 
	
@endsection

