{{--@extends('website.layout')--}}
{{--@section('title') @lang('website.checkout') @endsection--}}
{{--@section('css')--}}
{{--@endsection--}}
{{--@section('content')--}}


{{--        <section class="section_page_site">--}}
{{--		    <div class="container">--}}

{{--		        <div class="row">--}}
{{--		            <div class="col-md-7">--}}
{{--                        <div class="sec-head ds-head">--}}
{{--                            <h3>@lang('website.Shipping  Address')</h3>--}}
{{--                             @auth--}}
{{--                            <a href="{{route('checkoutCreateAddress')}}" class="btn-site"><span><i class="ti-plus"></i>@lang('website.Add New Address')</span></a>--}}
{{--                            @endauth--}}
{{--                        </div>--}}
{{--                        @auth--}}
{{--                        @if(count($addresses) > 0)--}}
{{--                       @foreach($addresses as $item)--}}
{{--                            <div class="item-list-address addresss{{$item->id}}">--}}
{{--                                <div class="txt-address">--}}
{{--                                    <!--<h4>Delivery Address <strong>(Default)</strong></h4>-->--}}
{{--                                    <h4>{{$item->address_name}} </h4>--}}
{{--                                    <p>@lang('website.area')  :  {{$item->area->name}}</p>--}}
{{--                                    <p>@lang('website.street')  :  {{$item->street}}</p>--}}
{{--                                </div>--}}
{{--                                <ul class="opt-add">--}}
{{--                                <li><a href="{{route('checkoutEditAddress',$item->id)}}" class="edit-address"><i class="ti-pencil-alt"></i></a></li>--}}
{{--                                <li><div class="check-address">--}}
{{--                                    <input class="inp-cbx" id="cbx{{$item->id}}" name="address_id" value="{{$item->id}}" type="radio">--}}
{{--                                    <label class="cbx" for="cbx{{$item->id}}">--}}
{{--                                        <span><svg width="12px" height="9px" viewBox="0 0 12 9"><polyline points="1 5 4 8 11 1"></polyline></svg>--}}
{{--                                        </span>--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                </li>--}}
{{--                            </div>--}}
{{--                            @endforeach--}}
{{--                        @else--}}
{{--                         <div class="box-notAddress wow fadeInUp">--}}
{{--                            <div>--}}
{{--                                <figure>--}}
{{--                                    <img src="{{url('website/images/notAddress.svg')}}" alt="" />--}}
{{--                                </figure>--}}
{{--                                <h3>@lang('You currently have no saved addresses.')</h3>--}}
{{--                            </div>--}}
{{--                            <a href="{{route('checkoutCreateAddress')}}" class="btn-site"><span><i class="ti-plus"></i>@lang('website.Add New Address')</span></a>--}}
{{--                        </div>--}}
{{--                        @endif--}}

{{--                        @endauth--}}

{{--                        @guest--}}
{{--                         <form class="form-address guestForm">--}}

{{--                            <div class="form-group">--}}
{{--                                <input type="text" class="form-control" name="name" placeholder="@lang('website.name')" required />--}}
{{--                            </div>--}}
{{--                            <div class="form-group">--}}
{{--                                <input type="email" name="email" class="form-control" placeholder="@lang('website.email')" required />--}}
{{--                            </div>--}}

{{--                            <div class="form-group">--}}
{{--                                <input type="text" name="mobile" class="form-control" placeholder="@lang('website.mobile')" required />--}}
{{--                            </div>--}}

{{--                            <div class="form-group">--}}
{{--                                <input type="text" name="address_name" class="form-control" placeholder="@lang('website.address_name')" required />--}}
{{--                            </div>--}}

{{--                            <div class="form-group">--}}
{{--                                <select class="form-control" name="area_id" title="@lang('website.area')" id="area_id" required />--}}
{{--                                <option value="">@lang('website.Select Area')</option>--}}
{{--                                @foreach($areas as $areas)--}}
{{--                                <option value="{{$areas->id}}">{{$areas->name}}</option>--}}
{{--                                @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                            <div class="form-group">--}}
{{--                                <input type="text" class="form-control" name="street" placeholder="@lang('website.street')" required />--}}
{{--                            </div>--}}
{{--                            @auth--}}
{{--                                <div class="form-group">--}}
{{--                                    <input type="password" name="password" class="form-control" placeholder="@lang('website.password')" required />--}}
{{--                                </div>--}}
{{--                            @endauth--}}


{{--                        </form>--}}
{{--                        @endguest--}}
{{--                        @csrf--}}
{{--                        <div class="sec-head ds-head">--}}
{{--                            <h5>@lang('website.delivery') </h5>--}}
{{--                        </div>--}}
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


{{--                        <div class="form-group mb-3 p-1">--}}
{{--                            <textarea class="form-control rounded py-3" name="delivery_note" placeholder="@lang('website.delivery_note')" required></textarea>--}}
{{--                        </div>--}}


{{--                          <!-- @auth--}}
{{--                          <div class="box-timDat">--}}
{{--                               <p>@lang('website.Select available delivery date / time :')</p>--}}
{{--		                        <form class="form-timDat time_date">--}}
{{--		                            <div class="form-group">--}}
{{--		                                <label>@lang('website.date')</label>--}}
{{--		                                <input type="date" name="availabile_date" required  class="form-control" placeholder="Promo Code" />--}}
{{--		                            </div>--}}
{{--		                            <div class="form-group">--}}
{{--		                                 <label>@lang('website.time')</label>--}}
{{--		                                <input type="time" name="availabile_time" required class="form-control" placeholder="Promo Code" />--}}
{{--		                            </div>--}}
{{-- 		                        </form>--}}

{{--		                    </div>--}}
{{--                            @endauth -->--}}
{{--                             <!-- <div class="box-discount">--}}
{{--		                        <form class="form-discount">--}}
{{--		                            <div class="form-group">--}}
{{--		                                <input type="text" id="code_name" class="form-control" placeholder="@lang('website.Promo Code')" />--}}
{{--		                            </div>--}}
{{--		                            <button class="btn-site" id="check_code"><span>@lang('website.Add')</span></button>--}}
{{--		                        </form>--}}
{{--		                        <div class="alert-val">--}}
{{--		                            <p valid style="display:none" class="validCode">@lang('website.Valid Code')</p>--}}
{{--		                            <p style="display:none" class="invalidCode">@lang('website.Invalid Code')</p>--}}
{{--		                        </div>--}}
{{--		                    </div>  -->--}}

{{--		                    <div class="form-group">--}}
{{--                                <button class="btn-site h60 send_form"><span>@lang('website.Checkout')</span></button>--}}
{{--                            </div>--}}

{{--		            </div>--}}
{{--		            <div class="col-md-5">--}}
{{--		                <div class="aside-check wow fadeInUp">--}}
{{--		                    <div class="box-order-summary box-product-fi">--}}
{{--                                <div class="head-box">--}}
{{--                                    <h2>@lang('website.products')</h2>--}}
{{--                                </div>--}}
{{--                                <div class="product-order">--}}
{{--                                    @foreach($carts as $cart)--}}
{{--                                        <div class="item-order">--}}
{{--                                            <figure>--}}
{{--                                                <img src="{{ $cart->product->image }}" alt="" />--}}
{{--                                            </figure>--}}
{{--                                            <div class="txt-product">--}}
{{--                                                <div>--}}
{{--                                                    <p>{{ $cart->product->name }}--({{ $cart->variant->variantType->name_en}})</p>--}}

{{--                                                    <span>@lang('website.QTY') : {{ $cart->quantity }}</span>--}}
{{--                                                </div>--}}

{{--                                                @if($cart->variant->discount_price > 0)--}}
{{--                                                    <strong>{{ $cart->variant->discount_price }} @lang('website.KWD')</strong>--}}
{{--                                                @else--}}
{{--                                                    <strong>{{ $cart->variant->price }} @lang('website.KWD')</strong>--}}
{{--                                                @endif--}}

{{--                                                --}}{{-- Gift Packaging --}}
{{--                                                @if($cart->giftPackaging)--}}
{{--                                                    <div class="gift-packaging mt-2">--}}
{{--                                                        <small class="text-muted d-block">--}}
{{--                                                            🎁 {{ $cart->giftPackaging->name }} (+{{ $cart->giftPackaging->price }} @lang('website.KWD') )--}}
{{--                                                        </small>--}}
{{--                                                    </div>--}}
{{--                                                @endif--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    @endforeach--}}


{{--                                </div>--}}
{{--		                        <div class="data-order">--}}
{{--		                            <div>--}}
{{--		                                <p>@lang('website.Sub Price')</p>--}}
{{--                                        <strong class="sub_total">{{$total_cart}} @lang('website.KWD')</strong>--}}
{{--                                    </div>--}}
{{--                                    <div>--}}
{{--		                                <p>@lang('website.Shipping')</p>--}}
{{--                                        <strong class="delivery_charge">00.000 @lang('website.KWD')</strong>--}}
{{--                                    </div>--}}
{{--                                    <div>--}}
{{--		                                <p>@lang('website.Discount')</p>--}}
{{--                                        <strong class="discount_amount">{{number_format($cart->discount,3)}} @lang('website.KWD')</strong>--}}
{{--                                    </div>--}}
{{--                                    <div class="total-price">--}}
{{--		                                <p>@lang('website.Total Price')</p>--}}
{{--                                        <strong class="total_price">{{number_format($total_cart-$cart->discount,3)}} @lang('website.KWD')</strong>--}}
{{--                                    </div>--}}
{{--		                        </div>--}}
{{--		                    </div>--}}
{{--		                </div>--}}
{{--		            </div>--}}
{{--		        </div>--}}
{{--		    </div>--}}
{{--		</section>--}}

{{--@endsection--}}

{{--@section('script')--}}

{{--    <script>--}}
{{--     var preventSubmit = false;--}}

{{--            $(document).on('click','.send_form',function (e) {--}}

{{--            e.preventDefault();--}}
{{--            var formData = new FormData($('.guestForm')[0]);--}}
{{--             formData.append('code_name', $('#code_name').val());--}}
{{--             formData.append('address_id', $('input[name="address_id"]:checked').val());--}}
{{--             formData.append('availabile_date', $('input[name="availabile_date"]').val());--}}
{{--             formData.append('availabile_time', $('input[name="availabile_time"]').val());--}}
{{--             formData.append('_token', $('input[name="_token"]').val());--}}
{{--             formData.append('delivery_note', $('textarea[name="delivery_note"]').val());--}}
{{--            $('.guestForm , .time_date').find( 'select, textarea, input' ).each(function(){--}}
{{--                  if($(this).prop('required') && !$(this).val() && !$(this).is(":hidden")){--}}
{{--                      $(this).css("border", "#ff0000 solid 1px").next('span.errorSpan').remove();--}}
{{--                           $(this).css("border", "#bd1616 solid 1px").after('<span style="color:#bd1616" class="errorSpan">{{__("website.requiredField")}}</span>');--}}
{{--                      preventSubmit = true;--}}
{{--                      e.preventDefault();--}}
{{--                  }--}}
{{--              });--}}
{{--              if(preventSubmit){--}}
{{--                  preventSubmit = false;--}}
{{--                  return false;--}}

{{--              }--}}
{{--            // $('.contact_us').html('<i class="fa fa-spinner fa-spin" style="font-size: 20px;"></i>'+' '+'{{__('website.send')}}');--}}
{{--         $('.send_form').html('<i class="fa fa-spinner fa-spin" style="font-size: 20px;"></i>')--}}
{{--         $(".send_form").attr("disabled", true);--}}
{{--        var ele = $(this);--}}
{{--        var id = $(this).data("id");--}}
{{--        $.ajax({--}}
{{--            url: '{{url(app()->getLocale().'/storeCheckOut')}}',--}}
{{--            type: "post",--}}
{{--            data: formData,--}}
{{--            processData: false,--}}
{{--            contentType: false,--}}
{{--            success: function (response) {--}}

{{--                if(response.code == 200){--}}
{{--                    // Redirect::away($url)--}}
{{--                    // location.href= response.order.paymentURL;--}}
{{--                    --}}{{-- swal({--}}
{{--                    --}}{{--    title: "{{__('website.ok')}}",--}}
{{--                    --}}{{--    icon: "success",--}}
{{--                    --}}{{--     button: "{{__('website.oky')}}",--}}

{{--                    --}}{{-- });--}}

{{--                     location.href='{{route('myOrders')}}';--}}
{{--                    // // $(".address_form").find("input, textarea ,select").val("");--}}
{{--                    // $('.send_form').html('<span>{{__('website.Checkout')}}</span>')--}}
{{--                    // $(".send_form").attr("disabled", false);--}}
{{--                    // $('input[name="_token"]') .val('{{ csrf_token() }}');--}}
{{--                    // location.href='{{route('home')}}';--}}
{{--                    return--}}
{{--                }else if(response.validator !=null){--}}
{{--                            swal({--}}
{{--                            text: response.validator,--}}
{{--                            button: "{{__('website.oky')}}",--}}
{{--                            dangerMode: true,--}}
{{--                        });--}}

{{--                         $('.send_form').html('<span>{{__('website.Checkout')}}</span>')--}}
{{--                         $(".send_form").attr("disabled", false);--}}
{{--                } else{--}}
{{--                    swal(response.message)--}}
{{--                    $('.send_form').html('<span>{{__('website.Checkout')}}</span>')--}}
{{--                    $(".send_form").attr("disabled", false);--}}
{{--                }--}}
{{--            }--}}

{{--        });--}}
{{--    });--}}


{{--        $(document).on('click','.removeProductFromCartPage',function (e) {--}}
{{--        // $(".remove-from-cart").click(function (e) {--}}
{{--            e.preventDefault();--}}

{{--            var ele = $(this);--}}
{{--            var id = $(this).data("id");--}}
{{--            // var product_id = $(this).data("product_id");--}}
{{--                 $(this).find('span').html('{{__('website.addToCart')}}');--}}
{{--                $(this).removeClass('removeFromCart').addClass("addToCart");--}}
{{--                $.ajax({--}}
{{--                    url:  '{{url(app()->getLocale().'/removeProductFromCartPage')}}'+'/'+id,--}}
{{--                    headers: {--}}
{{--                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--                         },--}}
{{--                    method: "get",--}}
{{--                    data: {--}}
{{--                        code_name:$('#code_name').val(),--}}

{{--                    },--}}
{{--                    success: function (response) {--}}
{{--                        $('.sub_total').html(response.total_cart+' '+ '@lang('website.KWD')');--}}
{{--                        // $('.discount_amount').html(response.discount+' '+ '@lang('website.KWD')');--}}
{{--                        $('.total_price').html(response.total+' '+ '@lang('website.KWD')');--}}
{{--                        $('.productCartItem'+id).hide(700).remove();--}}
{{--                        // ele.parent().parent().hide(700).remove();--}}


{{--                    }--}}
{{--                });--}}

{{--        });--}}

{{--        // $(document).on('click','.jsQuantityIncrease',function (e) {--}}
{{--        //       e.preventDefault();--}}
{{--        //       var ele = $(this);--}}
{{--        // 	   var id = $(this).data("id");--}}

{{--        // 	    var quantity = $(this).parent().find('input[name="count-quat1"]').val();--}}
{{--        //      $('.productCartItem'+id).find('input[name="count-quat1"]').val(quantity);--}}
{{--        //     $.ajax({--}}
{{--        // 		headers: {--}}
{{--        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--        //     },--}}
{{--        //         url: '{{url(app()->getLocale().'/changeQuantity')}}'+'/'+id,--}}
{{--        //         method: "get",--}}
{{--        //         data: {--}}
{{--        //               type:1,--}}
{{--        //                 code_name:$('#code_name').val(),--}}
{{--        //           },--}}
{{--        //         success: function (response) {--}}
{{--        //                 $('.sub_total').html(response.total_cart+' '+ '@lang('KWD')');--}}
{{--        //                 $('.discount_amount').html(response.discount+' '+ '@lang('KWD')');--}}
{{--        //                 $('.total_price').html(response.total+' '+ '@lang('KWD')');--}}
{{--        //             }--}}
{{--        //      });--}}
{{--        //  });--}}

{{--        // $(document).on('click','.jsQuantityDecrease',function (e) {--}}
{{--        //       e.preventDefault();--}}
{{--        //       var ele = $(this);--}}
{{--        // 	   var id = $(this).data("id");--}}

{{--        // 	   var quantity = $(this).parent().find('input[name="count-quat1"]').val();--}}
{{--        //         var newQuantity = parseInt(quantity) - 1;--}}
{{--        //         if (quantity == 0 ) {--}}
{{--        //             $.ajax({--}}
{{--        //                 url:  '{{url(app()->getLocale().'/removeProductFromCartPage')}}'+'/'+id,--}}
{{--        //                 headers: {--}}
{{--        //                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--        //                      },--}}
{{--        //                 method: "get",--}}
{{--        //                 data: {--}}
{{--        //                     code_name:$('#code_name').val(),--}}

{{--        //                 },--}}
{{--        //                 success: function (response) {--}}
{{--        //                     $('.sub_total').html(response.total_cart+' '+ '@lang('KWD')');--}}
{{--        //                     $('.discount_amount').html(response.discount+' '+ '@lang('KWD')');--}}
{{--        //                     $('.total_price').html(response.total+' '+ '@lang('KWD')');--}}
{{--        //                     $('.productCartItem'+id).hide(700).remove();--}}
{{--        //                 }--}}
{{--        //             });--}}
{{--        //       }else{--}}
{{--        //           $('.product'+id).find('input[name="count-quat1"]').val(quantity);--}}
{{--        //             $.ajax({--}}
{{--        //         		headers: {--}}
{{--        //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--        //                 },--}}
{{--        //                 url: '{{url(app()->getLocale().'/changeQuantity')}}'+'/'+id,--}}
{{--        //                 method: "get",--}}
{{--        //                 data: {--}}
{{--        //                      type:2,--}}
{{--        //                      code_name:$('#code_name').val(),--}}
{{--        //                   },--}}
{{--        //                 success: function (response) {--}}
{{--        //                     $('.sub_total').html(response.total_cart+' '+ '@lang('KWD')');--}}
{{--        //                     $('.discount_amount').html(response.discount+' '+ '@lang('KWD')');--}}
{{--        //                     $('.total_price').html(response.total+' '+ '@lang('KWD')');--}}
{{--        //                 }--}}
{{--        //              });--}}
{{--        //       }--}}
{{--        //      });--}}

{{--    $(document).on('click','#check_code',function (e) {--}}
{{--        e.preventDefault();--}}
{{--        var ele = $(this);--}}
{{--        $.ajax({--}}
{{--            headers: {--}}
{{--            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--        },--}}
{{--        url: '{{url(app()->getLocale().'/checkPromo')}}',--}}
{{--        method: "get",--}}
{{--        data: {--}}
{{--           code:$('#code_name').val(),--}}
{{--            area_id:$('#area_id').val(),--}}
{{--            address_id:$('input[name="address_id"]:checked').val(),--}}
{{--          },--}}
{{--        success: function (response) {--}}

{{--           if(response.code ==200){--}}
{{--                    $('.validCode').show();--}}
{{--                    $('.invalidCode').hide();--}}
{{--                    $('.sub_total').html(response.total_cart+' '+ '@lang('website.KWD')');--}}
{{--                    $('.discount_amount').html(response.discount+' '+ '@lang('website.KWD')');--}}
{{--                    $('.total_price').html(response.total+' '+ '@lang('website.KWD')');--}}
{{--                   $('.delivery_charge').html(response.delivery_charge+' '+ '@lang('website.KWD')');--}}
{{--					return ;--}}

{{--            }else if(response.code==500){--}}
{{--                  $('.validCode').hide();--}}
{{--                  $('.invalidCode').show();--}}
{{--                   $('.sub_total').html(response.total_cart+' '+ '@lang('website.KWD')');--}}
{{--                   $('.discount_amount').html(response.discount+' '+ '@lang('website.KWD')');--}}
{{--                   $('.total_price').html(response.total+' '+ '@lang('website.KWD')');--}}
{{--            }--}}
{{--            else if(response.code==400){--}}
{{--                 $('.validCode').hide();--}}
{{--                 $('.invalidCode').hide();--}}

{{--                  $('.sub_total').html(response.total_cart+' '+ '@lang('website.KWD')');--}}
{{--                    $('.discount_amount').html(response.discount+' '+ '@lang('website.KWD')');--}}
{{--                    $('.total_price').html(response.total+' '+ '@lang('website.KWD')');--}}


{{--				swal({--}}
{{--					text: response.validator,--}}
{{--					dangerMode: true,--}}
{{--					button: "{{__('website.oky')}}",--}}
{{--					});--}}
{{--            } else{--}}

{{--            }--}}
{{--        }--}}

{{--    });--}}
{{-- });--}}


{{--    $(document).on('change','#area_id',function (e) {--}}
{{--       e.preventDefault();--}}
{{--     var ele = $(this);--}}
{{--     $.ajax({--}}
{{--		headers: {--}}
{{--            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--        },--}}
{{--        url: '{{url(app()->getLocale().'/calculateDileveryCostByAriaId')}}',--}}
{{--        method: "get",--}}
{{--        data: {--}}
{{--           code:$('#code_name').val(),--}}
{{--           area_id:$('#area_id').val(),--}}
{{--          },--}}
{{--        success: function (response) {--}}

{{--           if(response.code ==200){--}}
{{--                    $('.sub_total').html(response.total_cart+' '+ '@lang('website.KWD')');--}}
{{--                    $('.discount_amount').html(response.discount+' '+ '@lang('website.KWD')');--}}
{{--                    $('.total_price').html(response.total+' '+ '@lang('website.KWD')');--}}
{{--                    $('.delivery_charge').html(response.delivery_charge+' '+ '@lang('website.KWD')');--}}
{{--					return ;--}}

{{--            }else if(response.code==500){--}}
{{--                   $('.sub_total').html(response.total_cart+' '+ '@lang('website.KWD')');--}}
{{--                   $('.discount_amount').html(response.discount+' '+ '@lang('website.KWD')');--}}
{{--                   $('.total_price').html(response.total+' '+ '@lang('website.KWD')');--}}
{{--            }--}}
{{--            else if(response.code==400){--}}
{{--                  $('.sub_total').html(response.total_cart+' '+ '@lang('website.KWD')');--}}
{{--                    $('.discount_amount').html(response.discount+' '+ '@lang('website.KWD')');--}}
{{--                    $('.total_price').html(response.total+' '+ '@lang('website.KWD')');--}}


{{--				swal({--}}
{{--					text: response.validator,--}}
{{--					dangerMode: true,--}}
{{--					button: "{{__('website.oky')}}",--}}
{{--					});--}}
{{--            } else{--}}

{{--            }--}}
{{--        }--}}

{{--     });--}}
{{--    });--}}


{{--    $(document).on('change','input[name="address_id"]',function (e) {--}}
{{--        e.preventDefault();--}}
{{--        var ele = $(this);--}}
{{--        $.ajax({--}}
{{--            headers: {--}}
{{--            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--        },--}}
{{--        url: '{{url(app()->getLocale().'/calculateDileveryCostByAddressId')}}',--}}
{{--        method: "get",--}}
{{--        data: {--}}
{{--           code:$('#code_name').val(),--}}
{{--           address_id:$('input[name="address_id"]:checked').val(),--}}
{{--          },--}}
{{--        success: function (response) {--}}

{{--           if(response.code ==200){--}}
{{--                    $('.sub_total').html(response.total_cart+' '+ '@lang('website.KWD')');--}}
{{--                    $('.discount_amount').html(response.discount+' '+ '@lang('website.KWD')');--}}
{{--                    $('.total_price').html(response.total+' '+ '@lang('website.KWD')');--}}
{{--                    $('.delivery_charge').html(response.delivery_charge+' '+ '@lang('website.KWD')');--}}
{{--					return ;--}}

{{--            }else if(response.code==500){--}}
{{--                   $('.sub_total').html(response.total_cart+' '+ '@lang('website.KWD')');--}}
{{--                   $('.discount_amount').html(response.discount+' '+ '@lang('website.KWD')');--}}
{{--                   $('.total_price').html(response.total+' '+ '@lang('website.KWD')');--}}
{{--            }--}}
{{--            else if(response.code==400){--}}
{{--                  $('.sub_total').html(response.total_cart+' '+ '@lang('website.KWD')');--}}
{{--                    $('.discount_amount').html(response.discount+' '+ '@lang('website.KWD')');--}}
{{--                    $('.total_price').html(response.total+' '+ '@lang('website.KWD')');--}}


{{--				swal({--}}
{{--					text: response.validator,--}}
{{--					dangerMode: true,--}}
{{--					button: "{{__('website.oky')}}",--}}
{{--					});--}}
{{--            } else{--}}

{{--            }--}}
{{--        }--}}

{{--     });--}}
{{-- });--}}



{{--	</script>--}}
{{--@endsection--}}


@extends('website.layout')
@section('title') @lang('website.checkout') @endsection
@section('css')
    <style>
        .payment-methods {
            margin: 20px 0;
        }

        .payment-option {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }

        .payment-option:hover {
            border-color: #007bff;
            box-shadow: 0 2px 5px rgba(0,123,255,0.1);
        }

        .payment-option.active {
            border-color: #007bff;
            background-color: #f8f9fa;
        }

        .payment-option input[type="radio"] {
            margin-right: 15px;
            transform: scale(1.2);
        }

        .payment-icon {
            width: 40px;
            height: 40px;
            margin-right: 15px;
            vertical-align: middle;
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
        }

        .payment-icon.cash {
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="%23198754"><path d="M7 15h2c0 1.08 1.37 2 3 2s3-.92 3-2c0-1.1-1.04-1.5-3.24-2.03C9.64 12.44 7 11.78 7 9c0-1.79 1.47-3.31 3.5-3.82V3h3v2.18C15.53 5.69 17 7.21 17 9h-2c0-1.08-1.37-2-3-2s-3 .92-3 2c0 1.1 1.04 1.5 3.24 2.03C14.36 11.56 17 12.22 17 15c0 1.79-1.47 3.31-3.5 3.82V21h-3v-2.18C8.47 18.31 7 16.79 7 15z"/></svg>');
        }

        .payment-icon.card {
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="%230d6efd"><path d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z"/></svg>');
        }

        .payment-info {
            flex: 1;
        }

        .payment-title {
            font-weight: bold;
            margin-bottom: 5px;
            font-size: 16px;
            color: #333;
        }

        .payment-description {
            color: #6c757d;
            font-size: 14px;
            line-height: 1.4;
        }

        .sec-head.ds-head {
            margin-bottom: 20px;
        }

        .sec-head.ds-head h3 {
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
            margin-bottom: 0;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.25);
        }
    </style>
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
                                    </ul>
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
                                @foreach($areas as $area_item)
                                    <option value="{{$area_item->id}}">{{$area_item->name}}</option>
                                    @endforeach
                                    </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="street" placeholder="@lang('website.street')" required />
                            </div>
                            @guest
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control" placeholder="@lang('website.password')" required />
                                </div>
                            @endguest
                        </form>
                    @endguest
                    @csrf

                    <!-- Payment Methods Section -->
                    <div class="sec-head ds-head">
                        <h3>@lang('website.payment_method')</h3>
                    </div>

                    <div class="payment-methods">
                        <div class="payment-option active" data-payment="1">
                            <input type="radio" id="cash_payment" name="payment_method" value="1" checked>
                            <div class="payment-icon cash"></div>
                            <div class="payment-info">
                                <label for="cash_payment" class="payment-title">@lang('website.cash_on_delivery')</label>
                                <div class="payment-description">@lang('website.pay_when_order_delivered')</div>
                            </div>
                        </div>

                        <div class="payment-option" data-payment="2">
                            <input type="radio" id="online_payment" name="payment_method" value="2">
                            <div class="payment-icon card"></div>
                            <div class="payment-info">
                                <label for="online_payment" class="payment-title">@lang('website.online_payment')</label>
                                <div class="payment-description">@lang('website.pay_with_card_or_tap')</div>
                            </div>
                        </div>
                    </div>

                    <div class="sec-head ds-head">
                        <h5>@lang('website.delivery') </h5>
                    </div>

                    <div class="form-group mb-3 p-1">
                        <textarea class="form-control rounded py-3" name="delivery_note" placeholder="@lang('website.delivery_note')"></textarea>
                    </div>

                    <!-- Promo Code Section -->
                    <div class="box-discount">
                        <form class="form-discount">
                            <div class="form-group">
                                <input type="text" id="code_name" class="form-control" placeholder="@lang('website.Promo Code')" />
                            </div>
                            <button type="button" class="btn-site" id="check_code"><span>@lang('website.Add')</span></button>
                        </form>
                        <div class="alert-val">
                            <p valid style="display:none" class="validCode text-success">@lang('website.Valid Code')</p>
                            <p style="display:none" class="invalidCode text-danger">@lang('website.Invalid Code')</p>
                        </div>
                    </div>

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
                                    <div class="item-order productCartItem{{$cart->id}}">
                                        <figure>
                                            <img src="{{ $cart->product->image }}" alt="{{ $cart->product->name }}" />
                                        </figure>
                                        <div class="txt-product">
                                            <div>
                                                <p>{{ $cart->product->name }}@if($cart->variant)--({{ $cart->variant->variantType->name_en}})@endif</p>
                                                <span>@lang('website.QTY') : {{ $cart->quantity }}</span>
                                            </div>

                                            @if($cart->variant && $cart->variant->discount_price > 0)
                                                <strong>{{ number_format($cart->variant->discount_price, 3) }} @lang('website.KWD')</strong>
                                            @elseif($cart->variant)
                                                <strong>{{ number_format($cart->variant->price, 3) }} @lang('website.KWD')</strong>
                                            @else
                                                <strong>{{ number_format($cart->product->price, 3) }} @lang('website.KWD')</strong>
                                            @endif

                                            {{-- Gift Packaging --}}
                                            @if($cart->giftPackaging)
                                                <div class="gift-packaging mt-2">
                                                    <small class="text-muted d-block">
                                                        🎁 {{ $cart->giftPackaging->name }} (+{{ number_format($cart->giftPackaging->price, 3) }} @lang('website.KWD') )
                                                    </small>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="remove-item">
                                            <button type="button" class="btn btn-sm btn-outline-danger removeProductFromCartPage" data-id="{{ $cart->id }}">
                                                <i class="ti-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="data-order">
                                <div>
                                    <p>@lang('website.Sub Price')</p>
                                    <strong class="sub_total">{{number_format($total_cart, 3)}} @lang('website.KWD')</strong>
                                </div>
                                <div>
                                    <p>@lang('website.Shipping')</p>
                                    <strong class="delivery_charge">0.000 @lang('website.KWD')</strong>
                                </div>
                                <div>
                                    <p>@lang('website.Discount')</p>
                                    <strong class="discount_amount">0.000 @lang('website.KWD')</strong>
                                </div>
                                <div class="total-price">
                                    <p>@lang('website.Total Price')</p>
                                    <strong class="total_price">{{number_format($total_cart, 3)}} @lang('website.KWD')</strong>
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

        // Payment method selection
        $(document).on('click', '.payment-option', function() {
            $('.payment-option').removeClass('active');
            $(this).addClass('active');
            $(this).find('input[type="radio"]').prop('checked', true);
        });

        $(document).on('click', '.send_form', function (e) {
            e.preventDefault();

            var formData = new FormData();

            // Add form data
            if ($('.guestForm').length) {
                $('.guestForm').find('input, select, textarea').each(function() {
                    if ($(this).attr('name')) {
                        formData.append($(this).attr('name'), $(this).val());
                    }
                });
            }

            // Add other data
            formData.append('code_name', $('#code_name').val());
            formData.append('address_id', $('input[name="address_id"]:checked').val());
            formData.append('payment_method', $('input[name="payment_method"]:checked').val());
            formData.append('_token', $('input[name="_token"]').val());
            formData.append('delivery_note', $('textarea[name="delivery_note"]').val());

            // Validation for guest users
            if ($('.guestForm').length) {
                $('.guestForm').find('select, textarea, input').each(function(){
                    if($(this).prop('required') && !$(this).val() && !$(this).is(":hidden")){
                        $(this).css("border", "#ff0000 solid 1px").next('span.errorSpan').remove();
                        $(this).css("border", "#bd1616 solid 1px").after('<span style="color:#bd1616" class="errorSpan">{{__("website.requiredField")}}</span>');
                        preventSubmit = true;
                        e.preventDefault();
                    }
                });
            }

            // Validation for authenticated users
            @auth
            if (!$('input[name="address_id"]:checked').val()) {
                swal({
                    text: "@lang('website.please_select_address')",
                    button: "{{__('website.oky')}}",
                    dangerMode: true,
                });
                return false;
            }
            @endauth

            // Check if payment method is selected
            if (!$('input[name="payment_method"]:checked').val()) {
                swal({
                    text: "@lang('website.please_select_payment_method')",
                    button: "{{__('website.oky')}}",
                    dangerMode: true,
                });
                return false;
            }

            if(preventSubmit){
                preventSubmit = false;
                return false;
            }

            $('.send_form').html('<i class="fa fa-spinner fa-spin" style="font-size: 20px;"></i>')
            $(".send_form").attr("disabled", true);

            var paymentMethod = $('input[name="payment_method"]:checked').val();

            $.ajax({
                url: '{{url(app()->getLocale().'/storeCheckOut')}}',
                type: "post",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if(response.code == 200){
                        if(paymentMethod == '2' && response.payment_url) {
                            // Show loading message for online payment
                            swal({
                                title: "@lang('website.redirecting_to_payment')",
                                text: "@lang('website.payment_processing')",
                                icon: "info",
                                buttons: false,
                                closeOnClickOutside: false,
                                closeOnEsc: false
                            });

                            // Small delay then redirect to Tap payment
                            setTimeout(function() {
                                window.location.href = response.payment_url;
                            }, 2000);
                        } else {
                            // Cash payment - show success and redirect to orders
                            swal({
                                title: "@lang('website.order_placed_successfully')",
                                text: "@lang('website.order_placed_cash_message')",
                                icon: "success",
                                button: "{{__('website.oky')}}",
                            }).then(() => {
                                location.href='{{route('myOrders')}}';
                            });
                        }
                        return;
                    } else if(response.validator != null){
                        swal({
                            text: response.validator,
                            button: "{{__('website.oky')}}",
                            dangerMode: true,
                        });
                        $('.send_form').html('<span>{{__('website.Checkout')}}</span>')
                        $(".send_form").attr("disabled", false);
                    } else {
                        swal({
                            text: response.message,
                            button: "{{__('website.oky')}}",
                            dangerMode: true,
                        });
                        $('.send_form').html('<span>{{__('website.Checkout')}}</span>')
                        $(".send_form").attr("disabled", false);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', {xhr, status, error});
                    swal({
                        text: "@lang('website.something_went_wrong')",
                        button: "{{__('website.oky')}}",
                        dangerMode: true,
                    });
                    $('.send_form').html('<span>{{__('website.Checkout')}}</span>')
                    $(".send_form").attr("disabled", false);
                }
            });
        });

        // Remove product from cart
        $(document).on('click','.removeProductFromCartPage',function (e) {
            e.preventDefault();
            var ele = $(this);
            var id = $(this).data("id");

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
                    $('.total_price').html(response.total+' '+ '@lang('website.KWD')');
                    $('.productCartItem'+id).fadeOut(700, function() {
                        $(this).remove();
                    });

                    // Check if cart is empty
                    if ($('.productCartItem').length === 0) {
                        location.reload();
                    }
                }
            });
        });

        // Check promo code
        $(document).on('click','#check_code',function (e) {
            e.preventDefault();
            var ele = $(this);

            if (!$('#code_name').val()) {
                return;
            }

            ele.html('<i class="fa fa-spinner fa-spin"></i>');
            ele.attr('disabled', true);

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
                    }

                    ele.html('<span>@lang('website.Add')</span>');
                    ele.attr('disabled', false);
                },
                error: function() {
                    ele.html('<span>@lang('website.Add')</span>');
                    ele.attr('disabled', false);
                }
            });
        });

        // Calculate delivery cost by area
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
                    }
                }
            });
        });

        // Calculate delivery cost by address
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
                    }
                }
            });
        });

        // Clear validation errors on input
        $(document).on('input', '.form-control', function() {
            $(this).css("border", "");
            $(this).next('.errorSpan').remove();
        });

        // Initialize tooltips if you're using Bootstrap
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });
    </script>
@endsection
