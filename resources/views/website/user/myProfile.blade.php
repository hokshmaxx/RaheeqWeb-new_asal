@extends('website.layout')
@section('title') @lang('website.My Profile') @endsection
@section('css')
@endsection
@section('content')

 	<section class="section_page_site">
            <div class="container">
                <div class="sec-head">
                    <h2>@lang('website.My Profile')</h2>
                </div>
                <div class="content-order">
                    <form class="form-account profile_form">
                        @csrf
                        <div class="form-group">
                            <input  name="name" type="text" class="form-control" value="{{Auth::user()->name}}" placeholder="@lang('website.name')" required />
                        </div>
                        <div class="form-group">
                            <input  name="email" type="text" class="form-control" value="{{Auth::user()->email}}" placeholder="@lang('website.email')" required />
                        </div>
                        <div class="form-group">
                            <input  name="mobile" type="text" class="form-control" value="{{Auth::user()->mobile}}" placeholder="@lang('website.mobile')" required />
                        </div>
                        <div class="form-group">
                            <button class="btn-site h60 send_form"><span>@lang('website.Update')</span></button>
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
            var formData = new FormData($('.profile_form')[0]);
            $('.profile_form').find( 'select, textarea, input' ).each(function(){
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
            url: '{{url(app()->getLocale().'/updateMyProfile')}}', 
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
                    $('.send_form').html('<span>{{__('website.Update')}}</span>')
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
                         $('.send_form').html('<span>{{__('website.Update')}}</span>')
                         $(".send_form").attr("disabled", false);
                } else{
                    swal(response.message)
                    $('.send_form').html('<span>{{__('website.Update')}}</span>')
                    $(".send_form").attr("disabled", false);
                }
            } 
            
        });
    });
	</script>
@endsection

