@extends('website.layout')
@section('title') @lang('website.CHANGE PASSWORD')@endsection
@section('css')
@endsection
@section('content')

 	<section class="section_page_site">
            <div class="container">
                <div class="sec-head">
                    <h2>@lang('website.CHANGE PASSWORD')</h2>
                </div>
                <div class="content-order">
                    <form class="form-account password_form">
                        @csrf
                        <div class="form-group">
                            <input  name="old_password" type="password" class="form-control" placeholder="@lang('website.Old Password')" required />
                        </div>
                        <div class="form-group">
                            <input  name="password" type="password" class="form-control" placeholder="@lang('website.New Password')" required />
                        </div>
                        <div class="form-group">
                            <input  name="confirm_password" type="password" class="form-control" placeholder="@lang('website.Confirm Password')" required />
                        </div>
                        <div class="form-group">
                            <button class="btn-site h60 send_form"><span>@lang('website.Save')</span></button>
                        </div>
                    </form>
                </div>
            </div>
		</section>

@endsection

@section('script')
 
		<script>
 var preventSubmit = false;
 
$(document).on('click','.send_form',function (e) {
            e.preventDefault();
            var formData = new FormData($('.password_form')[0]);
            $('.password_form').find( 'select, textarea, input' ).each(function(){
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
         $('.send_form').html('<i class="fa fa-spinner fa-spin" style="font-size: 20px;"></i>')
         $(".send_form").attr("disabled", true);
        var ele = $(this);
        var id = $(this).data("id");
        $.ajax({
            url: '{{url(app()->getLocale().'/updatePassword')}}', 
            type: "post", 
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if(response.code ==200){
                    swal({
                        title: "{{__('website.ok')}}",
                        icon: "success",
                        button: "{{__('website.oky')}}",
                    });
                    $(".password_form").find("input, textarea ,select").val("");
                    $('.send_form').html('<span>{{__('website.Save')}}</span>')
                    $(".send_form").attr("disabled", false);
                    $('input[name="_token"]') .val('{{ csrf_token() }}');
                    // location.href='{{route('home')}}';
                    return
                }else if(response.validator !=null){    
                            swal({
                            text: response.validator,
                            button: "{{__('website.oky')}}",
                            dangerMode: true,
                        });
                         $('.send_form').html('<span>{{__('website.Save')}}</span>')
                         $(".send_form").attr("disabled", false);
                } else{
                    swal(response.message)
                    $('.send_form').html('<span>{{__('website.Save')}}</span>')
                    $(".send_form").attr("disabled", false);
                }
            } 
            
        });
    });
	</script>
@endsection

