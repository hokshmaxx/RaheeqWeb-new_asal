@extends('website.layout')
@section('title') @lang('website.Shopping  Cart') @endsection
@section('css')
@endsection
@section('content')

         <section class="section_page_site">
		    <div class="container">
                <div class="sec-head">
                    <h3>@lang('website.shoppingCart')</h3>
                </div>
                @if(count($carts) >0 )
		        <div class="row">
		            <div class="col-md-8">
		                @foreach($carts as $cart)
		                   <div class="item-check wow fadeInUp productCartItem{{$cart->product->id}}">
		                    <figure>
		                        <img src="{{$cart->product->image}}" alt="" />
                            </figure>
		                    <div class="txt-product">
                                <div>
                                    <p>{{$cart->product->name}}</p>
                                    <div class="quantity-item">
                                    @if($cart->product->quantity>0)

                                        <?php
                                        if(app()->getLocale()){
                                        ?>
                                         <div class="quantity">
                                            <div class="btn button-count dec jsQuantityDecrease " data-id="{{@$cart->product->id}}" minimum="1">
                                                <i class="fa fa-minus" aria-hidden="true"></i>
                                            </div>
                                            <input type="text" name="count-quat1" class="count-quat" value="{{$cart->quantity}}">
                                            <div class="btn button-count inc jsQuantityIncrease" max="{{$cart->product->quantity}}" data-id="{{@$cart->product->id}}">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </div>

                                        </div>
                                        <?php
                                        }else{
                                            ?>
                                            <div class="quantity">
                                               <div class="btn button-count inc jsQuantityIncrease" max="{{$cart->product->quantity}}" data-id="{{@$cart->product->id}}">
                                                   <i class="fa fa-plus" aria-hidden="true"></i>
                                               </div>
                                               <input type="text" name="count-quat1" class="count-quat" value="{{$cart->quantity}}">
                                               <div class="btn button-count dec jsQuantityDecrease " data-id="{{@$cart->product->id}}" minimum="1">
                                                   <i class="fa fa-minus" aria-hidden="true"></i>
                                               </div>
                                           </div>
                                           <?php
                                        }
                                        ?>
                                    @else
                                        <div class="soldOut">
                                            <h1>Sold Out</h1>
                                        </div>
                                    @endif
                                    </div>
                                </div>
                                 @if($cart->product->discount_price > 0 && $cart->product->offer_end_date >= now()->toDateString())
                                   <strong>{{$cart->product->discount_price}} @lang('website.KWD')</strong>
                                 @else
                                  <strong>{{$cart->product->price}} @lang('website.KWD')</strong>
                                 @endif
		                    </div>
		                    <a class="remove-item removeProductFromCartPage" data-id="{{$cart->product->id}}"><i class="ti-close"></i></a>
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
                                        <strong class="discount_amount">00.00 @lang('website.KWD')</strong>
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
                                @if($cart->product->quantity > 0)
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
{{--        <a href="{{route('checkout')}}" class="btn-site"><span>@lang('website.Guest')</span></a>--}}
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
                    $('.discount_amount').html(response.discount+' '+ '@lang('website.KWD')');
                    $('.total_price').html(response.total+' '+ '@lang('website.KWD')');
                    $('.productCartItem'+id).hide(700).remove();
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
	</script>
@endsection

