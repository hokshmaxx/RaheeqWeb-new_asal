@extends('website.layout')
@section('title') @lang('website.Edit Address') @endsection
@section('css')
@endsection
@section('content')

        <section class="section_page_site">
		    <div class="container">
                
		        <div class="row">
		             <div class="col-md-7">
                        <div class="sec-head">
                            <h3>@lang('website.Edit Address')</h3>
                        </div>
                        <form class="form-address address_form">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" value="{{$address->address_name}}" name="name" placeholder="@lang('website.name')" required />
                            </div>
                            <!--<div class="form-group">-->
                            <!--    <input type="email" class="form-control" placeholder="Enter Your Email" />-->
                            <!--</div>-->
                            <!--<div class="form-group">-->
                            <!--    <input type="number" class="form-control" placeholder="Phone Number" />-->
                            <!--</div>-->
                            <div class="form-group">
                                <select class="form-control" name="area_id" title="@lang('website.area')" required />
                                @foreach($areas as $areas)
                                <option value="{{$areas->id}}" @if($address->area_id ==$areas->id) @endif>{{$areas->name}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" value="{{$address->street}}" name="street" placeholder="@lang('website.street')" required />
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" value="{{$address->block}}" name="block" placeholder="@lang('website.block')" required />
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" value="{{$address->house_building}}" name="house_building" placeholder="@lang('website.house_building')" required />
                            </div>
                         <input type="hidden" value="@if($type== 'checkoutEditAddress')checkout @endif" name="next_path" />
                            <div class="form-group">
                                <button class="btn-site h60 send_form"><span>@lang('website.Save')</span></button>
                            </div>
                        </form>
		            </div>
		            <div class="col-md-5">
		                
		            </div>
		        </div>
		    </div>
		</section>

@endsection

@section('script')
 
   		<script>
 var preventSubmit = false;
 
$(document).on('click','.send_form',function (e) {
            e.preventDefault();
            var formData = new FormData($('.address_form')[0]);
            $('.address_form').find( 'select, textarea, input' ).each(function(){
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
            url: '{{url(app()->getLocale().'/updateAddress')}}'+'/{{$address->id}}', 
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
                  location.href=response.url;
                    // $(".address_form").find("input, textarea ,select").val("");
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
	</script>
@endsection

