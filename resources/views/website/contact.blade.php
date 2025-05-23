@extends('website.layout')
@section('title') @lang('website.Contact us') @endsection
@section('css')
@endsection
@section('content')

 	<section class="section_page_site">
            <div class="container">
                <div class="sec-head">
                    <h2>@lang('website.Contact us')</h2>
                </div>
                <div class="content-order">
                      <form class="form-account" id="contactForm">
                          @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" id="full_name" placeholder="{{__('website.name')}}" required />
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" id="emaill" placeholder="{{__('website.email')}}" required />
                            </div>
                            <div class="form-group">
                                <textarea rows="4" class="form-control" id="Messagee" placeholder="{{__('website.message')}}" required></textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn-site contact_us"><span>@lang('website.send')</span></button>
                            </div>
                        </form>
                </div>
            </div>
		</section>

@endsection

@section('script')
 
	<script>

        $(document).on('click','input,select,textarea,.select2',function(){
        //   jQuery.noConflict();
            $(this).attr('style',"").next('span.errorSpan').remove();//
        });
        var preventSubmit = false;
        
	
	$(document).on('click','.contact_us',function (e) {
        // $(".remove-from-cart").click(function (e) {
            e.preventDefault();

            $(this).closest("#contactForm").find( 'select, textarea, input' ).each(function(){
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
        var product_id = $(this).data("product_id");

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
            // return response;
                if(response.code ==300){
                //  $("#completO, #completeT").hide(2000);
                //    jQuery.noConflict();
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
	</script>
@endsection

