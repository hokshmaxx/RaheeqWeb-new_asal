@extends('website.layout')
@section('title') @lang('website.checkout') @endsection
@section('css')
@endsection
@section('content')

        <section class="section_page_site">
		    <div class="container">
                
		        <div class="row">
		             <div class="col-md-7">
                        <div class="sec-head">
                            <h3>@lang('website.Add New Address')</h3>
                        </div>
                        <form class="form-address address_form">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="@lang('website.name')" required />
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
                                <option value="{{$areas->id}}">{{$areas->name}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="street" placeholder="@lang('website.street')" required />
                            </div>
                            
                            {{-- change in address  --}}
                            <div class="form-group">
                                <input type="text" class="form-control" name="block" placeholder="@lang('website.block')" required />
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="house_building" placeholder="@lang('website.house_building')" required />
                            </div>

                            <input type="hidden" value="@if($type== 'checkoutCreateAddress')checkout @endif" name="next_path" />
                            <div class="form-group">
                                <button class="btn-site h60 send_form"><span>@lang('website.Save')</span></button>
                            </div>
                        </form>
		            </div>
		            <!-- <div class="col-md-5">
		                @if($type== 'checkoutCreateAddress')
		                <div class="aside-check wow fadeInUp">
		                    <div class="box-order-summary box-product-fi">
                                <div class="head-box">
                                    <h2>@lang('website.products')</h2>
                                </div>
                                <div class="product-order">
                                     @foreach($carts as $cart)
                                        <div class="item-order">
                                        <figure>
                                            <img src="{{$cart->product->image}}" alt="" />
                                        </figure>
                                        <div class="txt-product">
                                            <div>
                                                <p>{{$cart->product->name}}</p>
                                                <span>@lang('website.QTY') : {{$cart->quantity}}</span>
                                            </div>
                                         @if($cart->product->discount_price > 0 && $cart->product->offer_end_date >= now()->toDateString())
                                           <strong>{{$cart->product->discount_price}}</strong>
                                         @else
                                          <strong>{{$cart->product->price}}</strong>
                                         @endif
                                        </div>
                                    </div>
                                    @endforeach

                                </div>
		                        <div class="data-order">
		                            <div>
		                                <p>@lang('website.Sub Price')</p>
                                        <strong>{{$total_cart}} @lang('website.KWD')</strong>
                                    </div>
                                    <div>
		                                <p>@lang('website.Shipping')</p>
                                        <strong>15.00 @lang('website.KWD')</strong>
                                    </div>
                                    <div>
		                                <p>@lang('website.Discount')</p>
                                        <strong>00.00 @lang('website.KWD')</strong>
                                    </div>
                                    <div class="total-price">
		                                <p>@lang('website.Total Price')</p>
                                        <strong>165.00 @lang('website.KWD')</strong>
                                    </div>
		                        </div>
		                    </div>
		                </div>
		                @endif
		            </div> -->
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
            url: '{{url(app()->getLocale().'/createAddress')}}', 
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

