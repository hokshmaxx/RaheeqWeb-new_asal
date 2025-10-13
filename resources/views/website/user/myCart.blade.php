@extends('website.layout')
@section('title') @lang('website.shoppingCart') @endsection
@section('css')
    <style>

        .gift-packaging-container {
            position: relative;
            margin-top: 15px;
        }

        .selected-packaging-display {
            display: flex;
            align-items: center;
            margin-top: 10px;
            padding: 10px;
            border: 1px solid #eee;
            border-radius: 5px;
        }

        .packaging-image-circle {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 15px;
            border: 2px solid #ddd;
        }

        .packaging-image-circle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .packaging-details {
            flex: 1;
        }

        .packaging-title {
            margin: 0 0 5px 0;
            font-size: 16px;
        }

        .packaging-price {
            color: #e83e8c;
            font-weight: bold;
        }

    .custom-select-wrapper {
    position: relative;
    }

    .custom-select select {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background: url('data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 6"%3E%3Cpath d="M0 0L5 5L10 0" stroke="%23000" stroke-width="1.5" fill="none"/%3E%3C/svg%3E') no-repeat right 10px center;
    padding-right: 30px;
    }

    .custom-select option {
    display: flex;
    align-items: center;
    }

    .custom-select option img {
    width: 20px;
    margin-right: 10px;
    }
    </style>
@endsection
@section('content')
    <section class="section_page_site">
        <div class="container">
            <div class="sec-head">
                <h3>@lang('website.shoppingCart')</h3>
            </div>
            @if(count($carts) > 0 )
                <div class="row">
                    <div class="col-md-8">
                        @foreach($carts as $cart)
                            <div class="item-check wow fadeInUp productCartItem{{$cart->product->id}}{{$cart->variant->product_varint_type_id}}{{$cart->variant->id}}">
                                <figure>
                                    <img src="{{$cart->product->image}}" alt="" />
                                </figure>
                                <div class="txt-product">
                                    <div>

                                        <p>{{ $cart->product->name }}</p>
                                        @if($cart->variant && $cart->variant->variantType)
                                            <small class="text-muted">
                                                {{ app()->getLocale() == 'ar' ? $cart->variant->variantType->name_ar : $cart->variant->variantType->name_en }}:
                                                {{ app()->getLocale() == 'ar' ? $cart->variant->name : $cart->variant->name_en }}
                                            </small>
                                        @endif

                                        <div class="quantity-item">
                                            @if($cart->variant->quantity > 0)
                                                <div class="quantity">
                                                    <div class="btn button-count dec jsQuantityDecrease" data-id="{{@$cart->product->id}}"  data-variant-type-id="{{@$cart->variant->product_varint_type_id}}"  data-variant-id="{{@$cart->variant->id}}" minimum="1">
                                                        <i class="fa fa-minus" aria-hidden="true"></i>
                                                    </div>
                                                    <input type="text" name="count-quat1" class="count-quat" value="{{$cart->quantity}}" min="1" max="{{$cart->variant->quantity}}">
                                                    <div class="btn button-count inc jsQuantityIncrease" max="{{$cart->variant->quantity}}" data-id="{{@$cart->product->id}}"  data-variant-type-id="{{@$cart->variant->product_varint_type_id}}"  data-variant-id="{{@$cart->variant->id}}">
                                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="soldOut">
                                                    <h1>Sold Out</h1>
                                                </div>
                                            @endif
                                        </div>
                                    </div>



{{--                                    @if($cart->product->discount_price > 0 && $cart->product->offer_end_date >= now()->toDateString())--}}
{{--                                        <strong>{{$cart->product->discount_price}} @lang('website.KWD')</strong>--}}
{{--                                    @else--}}
{{--                                        <strong>{{$cart->product->price}} @lang('website.KWD')</strong>--}}
{{--                                    @endif--}}
                     @if($cart->variant->discount_price > 0 )
                                        <strong>{{number_format($cart->variant->discount_price,3)}} @lang('website.KWD')</strong>
                                    @else
                                        <strong>{{number_format($cart->variant->price,3)}} @lang('website.KWD')</strong>
                                    @endif


                                    <!-- Gift Packaging Options -->
                                    @if($cart->product->giftPackagings->count() > 0)
                                        <div class="gift-packaging-container">
                                            <label>@lang('website.Gift_Packaging')</label>
                                            <select name="gift_packaging[{{$cart->product->id}}]"
                                                    class="form-control gift-packaging-select"
                                                    data-product-id="{{$cart->product->id}}">
                                                <option value="0">@lang('website.Select_a_packaging_option')</option>
                                                @foreach($cart->product->giftPackagings as $option)
                                                    <option value="{{$option->id}}"
                                                            data-image="{{url($option->image)}}"
                                                            @if(app()->getLocale()=='en')
                                                                data-title="{{$option->title_en}}"

                                                            @else
                                                                data-title="{{$option->title_ar}}"

                                                            @endif
                                                            data-price="{{$option->price}}">
                                                         {{$option->price}} @lang('website.KWD')
                                                    </option>
                                                @endforeach
                                            </select>

                                            <div class="selected-packaging-display" style="display: none;">
                                                <div class="packaging-image-circle">
                                                    <img src="" alt="Packaging" class="img-circle">
                                                </div>
                                                <div class="packaging-details">
                                                    <h4 class="packaging-title"></h4>
                                                    <span class="packaging-price"></span>
                                                </div>
                                            </div>


                                        <!-- Placeholder for displaying selected packaging image -->
{{--                                            <div class="selected-packaging-image" id="selected-packaging-image-{{$cart->product->id}}"></div>--}}
                                        </div>
                                    @endif                                </div>
                                <a class="remove-item removeProductFromCartPage" data-id="{{$cart->product->id}}" data-variant-type-id="{{@$cart->variant->product_varint_type_id}}"  data-variant-id="{{@$cart->variant->id}}">
                                    <i class="ti-close"></i>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-md-4">
                        <div class="aside-check wow fadeInUp">
                            <div class="box-order-summary">
                                <div class="hd-box">
                                    <h2>@lang('website.Order Summary')</h2>
                                </div>
                                <div class="data-order">
                                    <div>
                                        <p>@lang('website.Sub Price')</p>
                                        <strong class="sub_total">{{$total}} @lang('website.KWD')</strong>
                                    </div>
                                    <div>
                                        <p>@lang('website.Discount')</p>
                                        <strong class="discount_amount">00.000 @lang('website.KWD')</strong>
                                    </div>
                                    <div class="total-price">
                                        <p>@lang('website.Total Price')</p>

                                        <strong class="total_price">{{$total}} @lang('website.KWD')</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="box-discount">
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
                            </div>
                            <div class="box-check">
                                @if($cart->variant->quantity > 0)
                                    @if(auth()->check())
                                        <a href="{{route('checkout')}}" class="btn-site"><span>@lang('website.Checkout')</span></a>
                                    @else
                                        <a data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn-site"><span>@lang('website.Checkout')</span></a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row" style="text-align: center;">
                    <div class="not-prod">
                        <figure><img src="{{url('website/images/not-prod.svg')}}" style="max-width: 50%;" /></figure>
                        <p>@lang('website.You didn\'t add any products to the Cart')</p>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @lang('website.Do You Want To Proceed To Checkout As ?')
                </div>
                <div class="modal-footer">
{{--                    <a href="{{route('checkout')}}" class="btn-site"><span>@lang('website.Guest')</span></a>--}}
                    <a href="{{route('login')}}" class="btn-site"><span>@lang('website.login')</span></a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script>

    $(document).on('click','.removeProductFromCartPage',function (e) {
        // $(".remove-from-cart").click(function (e) {
            e.preventDefault();
            var ele = $(this);
            var id = $(this).data("id");
        var variantId = ele.data("variant-id");
        var variantTypeId = ele.data("variant-type-id");


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
                    variant_id:variantId,

                },
                success: function (response) {
                    $('.sub_total').html(response.total_cart+' '+ '@lang('website.KWD')');
                    $('.discount_amount').html(response.discount+' '+ '@lang('website.KWD')');
                    $('.total_price').html(response.total+' '+ '@lang('website.KWD')');
                    $('.productCartItem'+id+variantTypeId+variantId).hide(700).remove();
                    // ele.parent().parent().hide(700).remove();


                }
            });
    });

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
          },

        success: function (response) {
            if(response.code ==200){
                    $('.validCode').show();
                    $('.invalidCode').hide();
                    $('.sub_total').html(response.total_cart+' '+ '@lang('website.KWD')');
                    $('.discount_amount').html(response.discount+' '+ '@lang('website.KWD')');
                    $('.total_price').html(response.total+' '+ '@lang('website.KWD')');
					return ;

            } else if(response.code==500){
                    $('.validCode').hide();
                    $('.invalidCode').show();
                    $('.sub_total').html(response.total_cart+' '+ '@lang('website.KWD')');
                    $('.discount_amount').html(response.discount+' '+ '@lang('website.KWD')');
                    $('.total_price').html(response.total+' '+ '@lang('website.KWD')');
            } else if(response.code==400){
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
                console.log("IN ELSE ");
            }
        }

     });
 });

    // const viewBtn = document.querySelector(".view-modal"),
    // popup = document.querySelector(".popup"),
    // close = popup.querySelector(".close"),
    // field = popup.querySelector(".field"),
    // input = field.querySelector("input"),
    // copy = field.querySelector("button");

    // viewBtn.onclick = ()=>{
    //     console.log("HellO ");return false;
    //   popup.classList.toggle("show");
    // }
    // close.onclick = ()=>{
    //   viewBtn.click();
    // }

    // copy.onclick = ()=>{
    //   input.select(); //select input value
    //   if(document.execCommand("copy")){ //if the selected text is copied
    //     field.classList.add("active");
    //     copy.innerText = "Copied";
    //     setTimeout(()=>{
    //       window.getSelection().removeAllRanges(); //remove selection from page
    //       field.classList.remove("active");
    //       copy.innerText = "Copy";
    //     }, 900000);
    //   }
    // }

    document.querySelectorAll('select[name^="gift_packaging"]').forEach(select => {
        select.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const imgSrc = selectedOption.getAttribute('data-image');
            // You can handle the selected option's image here (e.g., display the image or update UI)
        });
    });

    $(document).on('change', '.gift-packaging-select', function(e) {
        e.preventDefault();

        var productId = $(this).data('product-id');  // Get the product ID
        var selectedOption = $(this).find('option:selected'); // Get the selected option
        var packagingId = selectedOption.val();  // Get the selected packaging ID
        var packagingPrice = parseFloat(selectedOption.data('price') || 0);
        var codeName = $('#code_name').val();
// Get packaging price, defaulting to 0 if none
//         if (!packagingId) {
//             return;
//         }

        // Send an AJAX request to update the total with the selected gift packaging option
        $.ajax({
            url: '{{ url(app()->getLocale() . "/updateGiftPackaging") }}',  // URL to your server-side endpoint
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                product_id: productId,
                packaging_id: packagingId,
                // code_name: codeName,

                // _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                // On success, update the totals based on the response from the server
                console.log(response);
                if (response.status === 'done') {
                    $('.sub_total').html(response.total_cart + ' ' + '@lang('website.KWD')');
                    $('.discount_amount').html(response.discount + ' ' + '@lang('website.KWD')');
                    $('.total_price').html(response.total + ' ' + '@lang('website.KWD')');
                } else {
                    alert('@lang('website.Error occurred while updating the cart')');
                }
            },
            error: function(xhr, status, error) {
                alert('@lang('website.Error occurred while updating the cart')');
                console.error(xhr.responseText);
            }
        });
    });
	</script>

    <script>
        $(document).ready(function() {
            $('.gift-packaging-select').change(function() {
                var selectedOption = $(this).find('option:selected');
                var displayContainer = $(this).siblings('.selected-packaging-display');

                if (selectedOption.val() == '0') {
                    displayContainer.hide();
                } else {
                    // Update the display
                    displayContainer.find('.img-circle').attr('src', selectedOption.data('image'));
                    displayContainer.find('.packaging-title').text(selectedOption.data('title'));
                    displayContainer.find('.packaging-price').text(selectedOption.data('price') + ' @lang("website.KWD")');
                    displayContainer.show();
                }
            });

            // Trigger change event on page load if an option is already selected
            $('.gift-packaging-select').each(function() {
                if ($(this).val() != '0') {
                    $(this).trigger('change');
                }
            });
        });
    </script>
@endsection

