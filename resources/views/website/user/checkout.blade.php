@extends('website.layout')
@section('title') @lang('website.checkout') @endsection
@section('css')
@endsection
@section('content')


        <section class="section_page_site">
		    <div class="container">

		        <div class="row">
		            <div class="col-md-7">
                        <div class="sec-head ds-head">
                            <h3>@lang('website.Shipping  Address')</h3>
                             @auth
                            <a href="{{route('checkoutCreateAddress')}}" class="btn-site"><span><i class="ti-plus"></i>@lang('website.Add New Address')</span></a>
                            @endauth
                        </div>
                        @auth
                        @if(count($addresses) > 0)
                       @foreach($addresses as $item)
                            <div class="item-list-address addresss{{$item->id}}">
                                <div class="txt-address">
                                    <!--<h4>Delivery Address <strong>(Default)</strong></h4>-->
                                    <h4>{{$item->address_name}} </h4>
                                    <p>@lang('website.area')  :  {{$item->area->name}}</p>
                                    <p>@lang('website.street')  :  {{$item->street}}</p>
                                </div>
                                <ul class="opt-add">
                                <li><a href="{{route('checkoutEditAddress',$item->id)}}" class="edit-address"><i class="ti-pencil-alt"></i></a></li>
                                <li><div class="check-address">
                                    <input class="inp-cbx" id="cbx{{$item->id}}" name="address_id" value="{{$item->id}}" type="radio">
                                    <label class="cbx" for="cbx{{$item->id}}">
                                        <span><svg width="12px" height="9px" viewBox="0 0 12 9"><polyline points="1 5 4 8 11 1"></polyline></svg>
                                        </span>
                                    </label>
                                </div>
                                </li>
                            </div>
                            @endforeach
                        @else
                         <div class="box-notAddress wow fadeInUp">
                            <div>
                                <figure>
                                    <img src="{{url('website/images/notAddress.svg')}}" alt="" />
                                </figure>
                                <h3>@lang('You currently have no saved addresses.')</h3>
                            </div>
                            <a href="{{route('checkoutCreateAddress')}}" class="btn-site"><span><i class="ti-plus"></i>@lang('website.Add New Address')</span></a>
                        </div>
                        @endif

                        @endauth

                        @guest
                         <form class="form-address guestForm">

                            <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="@lang('website.name')" required />
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="@lang('website.email')" required />
                            </div>

                            <div class="form-group">
                                <input type="text" name="mobile" class="form-control" placeholder="@lang('website.mobile')" required />
                            </div>

                            <div class="form-group">
                                <input type="text" name="address_name" class="form-control" placeholder="@lang('website.address_name')" required />
                            </div>

                            <div class="form-group">
                                <select class="form-control" name="area_id" title="@lang('website.area')" id="area_id" required />
                                <option value="">@lang('website.Select Area')</option>
                                @foreach($areas as $areas)
                                <option value="{{$areas->id}}">{{$areas->name}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="street" placeholder="@lang('website.street')" required />
                            </div>
                            @auth
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control" placeholder="@lang('website.password')" required />
                                </div>
                            @endauth


                        </form>
                        @endguest
                        @csrf
                        <div class="sec-head ds-head">
                            <h5>@lang('website.delivery') </h5>
                        </div>
{{--                        @foreach ($delivery_note as $item)--}}
{{--                        <div class="item-list-address addresss{{ $item->id }}">--}}
{{--                            <div class="txt-address">--}}
{{--                                <!--<h4>Delivery Address <strong>(Default)</strong></h4>-->--}}
{{--                                <h4>{{ $item->Delivery_note }} </h4>--}}

{{--                            </div>--}}
{{--                            <ul class="opt-add">--}}
{{--                                <li>--}}
{{--                                    <div class="check-address">--}}
{{--                                        <input class="inp-cbx" id="cbx{{ $item->id }}" name="delivery_note_id"--}}
{{--                                            value="{{ $item->id }}" type="radio">--}}
{{--                                        <label class="cbx" for="cbx{{ $item->id }}">--}}
{{--                                            <span><svg width="12px" height="9px" viewBox="0 0 12 9">--}}
{{--                                                    <polyline points="1 5 4 8 11 1"></polyline>--}}
{{--                                                </svg>--}}
{{--                                            </span>--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
{{--                                </li>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}


                        <div class="form-group mb-3 p-1">
                            <textarea class="form-control rounded py-3" name="delivery_note" placeholder="@lang('website.delivery_note')" required></textarea>
                        </div>


                          <!-- @auth
                          <div class="box-timDat">
                               <p>@lang('website.Select available delivery date / time :')</p>
		                        <form class="form-timDat time_date">
		                            <div class="form-group">
		                                <label>@lang('website.date')</label>
		                                <input type="date" name="availabile_date" required  class="form-control" placeholder="Promo Code" />
		                            </div>
		                            <div class="form-group">
		                                 <label>@lang('website.time')</label>
		                                <input type="time" name="availabile_time" required class="form-control" placeholder="Promo Code" />
		                            </div>
 		                        </form>

		                    </div>
                            @endauth -->
                             <!-- <div class="box-discount">
		                        <form class="form-discount">
		                            <div class="form-group">
		                                <input type="text" id="code_name" class="form-control" placeholder="@lang('website.Promo Code')" />
		                            </div>
		                            <button class="btn-site" id="check_code"><span>@lang('website.Add')</span></button>
		                        </form>
		                        <div class="alert-val">
		                            <p valid style="display:none" class="validCode">@lang('website.Valid Code')</p>
		                            <p style="display:none" class="invalidCode">@lang('website.Invalid Code')</p>
		                        </div>
		                    </div>  -->

		                    <div class="form-group">
                                <button class="btn-site h60 send_form"><span>@lang('website.Checkout')</span></button>
                            </div>

		            </div>
		            <div class="col-md-5">
		                <div class="aside-check wow fadeInUp">
		                    <div class="box-order-summary box-product-fi">
                                <div class="head-box">
                                    <h2>@lang('website.products')</h2>
                                </div>
                                <div class="product-order">
                                    @foreach($carts as $cart)
                                        <div class="item-order">
                                            <figure>
                                                <img src="{{ $cart->product->image }}" alt="" />
                                            </figure>
                                            <div class="txt-product">
                                                <div>
                                                    <p>{{ $cart->product->name }}</p>

                                                    <span>@lang('website.QTY') : {{ $cart->quantity }}</span>
                                                </div>

                                                @if($cart->product->discount_price > 0 && $cart->product->offer_end_date >= now()->toDateString())
                                                    <strong>{{ $cart->product->discount_price }} @lang('website.KWD')</strong>
                                                @else
                                                    <strong>{{ $cart->product->price }} @lang('website.KWD')</strong>
                                                @endif

                                                {{-- Gift Packaging --}}
                                                @if($cart->giftPackaging)
                                                    <div class="gift-packaging mt-2">
                                                        <small class="text-muted d-block">
                                                            🎁 {{ $cart->giftPackaging->name }} (+{{ $cart->giftPackaging->price }} @lang('website.KWD') )
                                                        </small>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach


                                </div>
		                        <div class="data-order">
		                            <div>
		                                <p>@lang('website.Sub Price')</p>
                                        <strong class="sub_total">{{$total_cart}} @lang('website.KWD')</strong>
                                    </div>
                                    <div>
		                                <p>@lang('website.Shipping')</p>
                                        <strong class="delivery_charge">00.00 @lang('website.KWD')</strong>
                                    </div>
                                    <div>
		                                <p>@lang('website.Discount')</p>
                                        <strong class="discount_amount">{{$cart->discount}} @lang('website.KWD')</strong>
                                    </div>
                                    <div class="total-price">
		                                <p>@lang('website.Total Price')</p>
                                        <strong class="total_price">{{$total_cart-$cart->discount}} @lang('website.KWD')</strong>
                                    </div>
		                        </div>
		                    </div>
		                </div>
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
            var formData = new FormData($('.guestForm')[0]);
             formData.append('code_name', $('#code_name').val());
             formData.append('address_id', $('input[name="address_id"]:checked').val());
             formData.append('availabile_date', $('input[name="availabile_date"]').val());
             formData.append('availabile_time', $('input[name="availabile_time"]').val());
             formData.append('_token', $('input[name="_token"]').val());
             formData.append('delivery_note', $('textarea[name="delivery_note"]').val());
            $('.guestForm , .time_date').find( 'select, textarea, input' ).each(function(){
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
            url: '{{url(app()->getLocale().'/storeCheckOut')}}',
            type: "post",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {

                if(response.code == 200){
                    // Redirect::away($url)
                    // location.href= response.order.paymentURL;
                     swal({
                        title: "{{__('website.ok')}}",
                        icon: "success",
                         button: "{{__('website.oky')}}",

                     });

                     location.href='{{route('myOrders')}}';
                    // // $(".address_form").find("input, textarea ,select").val("");
                    // $('.send_form').html('<span>{{__('website.Checkout')}}</span>')
                    // $(".send_form").attr("disabled", false);
                    // $('input[name="_token"]') .val('{{ csrf_token() }}');
                    // location.href='{{route('home')}}';
                    return
                }else if(response.validator !=null){
                            swal({
                            text: response.validator,
                            button: "{{__('website.oky')}}",
                            dangerMode: true,
                        });
                         $('.send_form').html('<span>{{__('website.Checkout')}}</span>')
                         $(".send_form").attr("disabled", false);
                } else{
                    swal(response.message)
                    $('.send_form').html('<span>{{__('website.Checkout')}}</span>')
                    $(".send_form").attr("disabled", false);
                }
            }

        });
    });


        $(document).on('click','.removeProductFromCartPage',function (e) {
        // $(".remove-from-cart").click(function (e) {
            e.preventDefault();

            var ele = $(this);
            var id = $(this).data("id");
            // var product_id = $(this).data("product_id");
                 $(this).find('span').html('{{__('website.addToCart')}}');
                $(this).removeClass('removeFromCart').addClass("addToCart");
                $.ajax({
                    url:  '{{url(app()->getLocale().'/removeProductFromCartPage')}}'+'/'+id,
                    headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                         },
                    method: "get",
                    data: {
                        code_name:$('#code_name').val(),

                    },
                    success: function (response) {
                        $('.sub_total').html(response.total_cart+' '+ '@lang('website.KWD')');
                        // $('.discount_amount').html(response.discount+' '+ '@lang('website.KWD')');
                        $('.total_price').html(response.total+' '+ '@lang('website.KWD')');
                        $('.productCartItem'+id).hide(700).remove();
                        // ele.parent().parent().hide(700).remove();


                    }
                });

        });

        // $(document).on('click','.jsQuantityIncrease',function (e) {
        //       e.preventDefault();
        //       var ele = $(this);
        // 	   var id = $(this).data("id");

        // 	    var quantity = $(this).parent().find('input[name="count-quat1"]').val();
        //      $('.productCartItem'+id).find('input[name="count-quat1"]').val(quantity);
        //     $.ajax({
        // 		headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     },
        //         url: '{{url(app()->getLocale().'/changeQuantity')}}'+'/'+id,
        //         method: "get",
        //         data: {
        //               type:1,
        //                 code_name:$('#code_name').val(),
        //           },
        //         success: function (response) {
        //                 $('.sub_total').html(response.total_cart+' '+ '@lang('KWD')');
        //                 $('.discount_amount').html(response.discount+' '+ '@lang('KWD')');
        //                 $('.total_price').html(response.total+' '+ '@lang('KWD')');
        //             }
        //      });
        //  });

        // $(document).on('click','.jsQuantityDecrease',function (e) {
        //       e.preventDefault();
        //       var ele = $(this);
        // 	   var id = $(this).data("id");

        // 	   var quantity = $(this).parent().find('input[name="count-quat1"]').val();
        //         var newQuantity = parseInt(quantity) - 1;
        //         if (quantity == 0 ) {
        //             $.ajax({
        //                 url:  '{{url(app()->getLocale().'/removeProductFromCartPage')}}'+'/'+id,
        //                 headers: {
        //                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //                      },
        //                 method: "get",
        //                 data: {
        //                     code_name:$('#code_name').val(),

        //                 },
        //                 success: function (response) {
        //                     $('.sub_total').html(response.total_cart+' '+ '@lang('KWD')');
        //                     $('.discount_amount').html(response.discount+' '+ '@lang('KWD')');
        //                     $('.total_price').html(response.total+' '+ '@lang('KWD')');
        //                     $('.productCartItem'+id).hide(700).remove();
        //                 }
        //             });
        //       }else{
        //           $('.product'+id).find('input[name="count-quat1"]').val(quantity);
        //             $.ajax({
        //         		headers: {
        //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //                 },
        //                 url: '{{url(app()->getLocale().'/changeQuantity')}}'+'/'+id,
        //                 method: "get",
        //                 data: {
        //                      type:2,
        //                      code_name:$('#code_name').val(),
        //                   },
        //                 success: function (response) {
        //                     $('.sub_total').html(response.total_cart+' '+ '@lang('KWD')');
        //                     $('.discount_amount').html(response.discount+' '+ '@lang('KWD')');
        //                     $('.total_price').html(response.total+' '+ '@lang('KWD')');
        //                 }
        //              });
        //       }
        //      });

    $(document).on('click','#check_code',function (e) {
        e.preventDefault();
        var ele = $(this);
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '{{url(app()->getLocale().'/checkPromo')}}',
        method: "get",
        data: {
           code:$('#code_name').val(),
            area_id:$('#area_id').val(),
            address_id:$('input[name="address_id"]:checked').val(),
          },
        success: function (response) {

           if(response.code ==200){
                    $('.validCode').show();
                    $('.invalidCode').hide();
                    $('.sub_total').html(response.total_cart+' '+ '@lang('website.KWD')');
                    $('.discount_amount').html(response.discount+' '+ '@lang('website.KWD')');
                    $('.total_price').html(response.total+' '+ '@lang('website.KWD')');
                   $('.delivery_charge').html(response.delivery_charge+' '+ '@lang('website.KWD')');
					return ;

            }else if(response.code==500){
                  $('.validCode').hide();
                  $('.invalidCode').show();
                   $('.sub_total').html(response.total_cart+' '+ '@lang('website.KWD')');
                   $('.discount_amount').html(response.discount+' '+ '@lang('website.KWD')');
                   $('.total_price').html(response.total+' '+ '@lang('website.KWD')');
            }
            else if(response.code==400){
                 $('.validCode').hide();
                 $('.invalidCode').hide();

                  $('.sub_total').html(response.total_cart+' '+ '@lang('website.KWD')');
                    $('.discount_amount').html(response.discount+' '+ '@lang('website.KWD')');
                    $('.total_price').html(response.total+' '+ '@lang('website.KWD')');


				swal({
					text: response.validator,
					dangerMode: true,
					button: "{{__('website.oky')}}",
					});
            } else{

            }
        }

    });
 });


    $(document).on('change','#area_id',function (e) {
       e.preventDefault();
     var ele = $(this);
     $.ajax({
		headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '{{url(app()->getLocale().'/calculateDileveryCostByAriaId')}}',
        method: "get",
        data: {
           code:$('#code_name').val(),
           area_id:$('#area_id').val(),
          },
        success: function (response) {

           if(response.code ==200){
                    $('.sub_total').html(response.total_cart+' '+ '@lang('website.KWD')');
                    $('.discount_amount').html(response.discount+' '+ '@lang('website.KWD')');
                    $('.total_price').html(response.total+' '+ '@lang('website.KWD')');
                    $('.delivery_charge').html(response.delivery_charge+' '+ '@lang('website.KWD')');
					return ;

            }else if(response.code==500){
                   $('.sub_total').html(response.total_cart+' '+ '@lang('website.KWD')');
                   $('.discount_amount').html(response.discount+' '+ '@lang('website.KWD')');
                   $('.total_price').html(response.total+' '+ '@lang('website.KWD')');
            }
            else if(response.code==400){
                  $('.sub_total').html(response.total_cart+' '+ '@lang('website.KWD')');
                    $('.discount_amount').html(response.discount+' '+ '@lang('website.KWD')');
                    $('.total_price').html(response.total+' '+ '@lang('website.KWD')');


				swal({
					text: response.validator,
					dangerMode: true,
					button: "{{__('website.oky')}}",
					});
            } else{

            }
        }

     });
    });


    $(document).on('change','input[name="address_id"]',function (e) {
        e.preventDefault();
        var ele = $(this);
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '{{url(app()->getLocale().'/calculateDileveryCostByAddressId')}}',
        method: "get",
        data: {
           code:$('#code_name').val(),
           address_id:$('input[name="address_id"]:checked').val(),
          },
        success: function (response) {

           if(response.code ==200){
                    $('.sub_total').html(response.total_cart+' '+ '@lang('website.KWD')');
                    $('.discount_amount').html(response.discount+' '+ '@lang('website.KWD')');
                    $('.total_price').html(response.total+' '+ '@lang('website.KWD')');
                    $('.delivery_charge').html(response.delivery_charge+' '+ '@lang('website.KWD')');
					return ;

            }else if(response.code==500){
                   $('.sub_total').html(response.total_cart+' '+ '@lang('website.KWD')');
                   $('.discount_amount').html(response.discount+' '+ '@lang('website.KWD')');
                   $('.total_price').html(response.total+' '+ '@lang('website.KWD')');
            }
            else if(response.code==400){
                  $('.sub_total').html(response.total_cart+' '+ '@lang('website.KWD')');
                    $('.discount_amount').html(response.discount+' '+ '@lang('website.KWD')');
                    $('.total_price').html(response.total+' '+ '@lang('website.KWD')');


				swal({
					text: response.validator,
					dangerMode: true,
					button: "{{__('website.oky')}}",
					});
            } else{

            }
        }

     });
 });



	</script>
@endsection

