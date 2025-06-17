   @if(count($products) > 0 )
{{--    @foreach($products as $product)--}}
{{--        <div class="col-md-3">--}}
{{--            <div class="item-product wow fadeInUp">--}}
{{--                <figure>--}}
{{--                  <a href="{{route('prouctDetails',[$product->id,Str::slug($product->name)])}}">  <img src="{{$product->image}}" alt="" /> </a>--}}
{{--                    @if($product->is_favorite==1)--}}
{{--                       <a class="btn_favorite item_fav removeFromFavorite" data-id="{{$product->id}}"><i class="fa fa-heart"></i></a>--}}
{{--                    @elseif($product->is_favorite==0)--}}
{{--                       <a class="btn_favorite addToFavorite" data-id="{{$product->id}}"><i class="fa fa-heart"></i></a>--}}
{{--                    @endif--}}
{{--            --}}
{{--                    --}}
{{--                    @if($product->discount_price > 0 && $product->offer_end_date >= now()->toDateString())--}}
{{--                      <span class="offer-product">{{$product->discount_percent}}%</span>--}}

{{--                        <?php--}}
{{--                            $dis_percent = ($product->price - $product->discount_price)/$product->price * 100;--}}
{{--                            $dis_percent = round($dis_percent);--}}
{{--                        ?> --}}
{{--                        <span class="offer-product">{{$dis_percent}} % </span>--}}
{{--                    @endif--}}
{{--                </figure>--}}
{{--                <div class="txt-product">--}}
{{--                <a href="{{route('prouctDetails',[$product->id,Str::slug($product->name)])}}">    <p>{{$product->name}}</p> </a>--}}
{{--                    <div>--}}
{{--                         @if($product->discount_price > 0 && $product->offer_end_date >= now()->toDateString())--}}
{{--                        <del>{{$product->price }} @lang('website.KWD')</del>--}}
{{--                        <strong>{{$product->discount_price}} @lang('website.KWD')</strong>--}}
{{--                        @else--}}
{{--                        <strong>{{$product->price}} @lang('website.KWD')</strong>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                    <ul>--}}
{{--                        <li><a href="{{route('prouctDetails',[$product->id,Str::slug($product->name)])}}" class="btn-site"><span>@lang('website.Details')</span></a></li>--}}
{{--                        @if($product->quantity==0)--}}
{{--                        <li><a href="" class="btn-site @if($product->is_cart==0) addToCart @else removeFromCart @endif" data-id="{{$product->id}}" style="pointer-events:none; opacity:0.5"><span>@if($product->is_cart==0) @lang('website.addToCart') @else @lang('website.remove_from_cart') @endif</span></a></li>--}}
{{--                        @else--}}
{{--                        <li><a href="" class="btn-site @if($product->is_cart==0) addToCart @else removeFromCart @endif" data-id="{{$product->id}}"><span>@if($product->is_cart==0) @lang('website.addToCart') @else @lang('website.remove_from_cart') @endif</span></a></li>--}}
{{--                        @endif--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    @endforeach--}}


{{--<div class="row">--}}
{{--    @foreach($products as $product)--}}
{{--        <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-4">--}}
{{--            <div class="item-product procard wow fadeInUp">--}}
{{--                <figure>--}}
{{--                    <a href="{{route('prouctDetails',[$product->id,Str::slug($product->name)])}}">--}}
{{--                        <img src="{{$product->image}}" alt="{{$product->name}}" loading="lazy" />--}}
{{--                    </a>--}}
{{--                    @if($product->is_favorite == 1)--}}
{{--                        <a class="btn_favorite item_fav removeFromFavorite" data-id="{{ $product->id }}">--}}
{{--                            <i class="fas fa-heart"></i> --}}{{-- Solid heart (filled) --}}
{{--                        </a>--}}
{{--                    @else--}}
{{--                        <a class="btn_favorite addToFavorite" data-id="{{ $product->id }}">--}}
{{--                            <i class="far fa-heart"></i> --}}{{-- Regular heart (empty) --}}
{{--                        </a>--}}
{{--                    @endif--}}
{{--                    @if($product->discount_price > 0 && $product->offer_end_date >= now()->toDateString())--}}
{{--                            <?php--}}
{{--                            $dis_percent = ($product->price - $product->discount_price)/$product->price * 100;--}}
{{--                            $dis_percent = round($dis_percent);--}}
{{--                            ?>--}}
{{--                        <span class="offer-product">{{$dis_percent}}% OFF</span>--}}
{{--                    @endif--}}
{{--                </figure>--}}
{{--                <div class="txt-product">--}}
{{--                    <a href="{{route('prouctDetails',[$product->id,Str::slug($product->name)])}}">--}}
{{--                        <p>{{$product->name}}</p>--}}
{{--                    </a>--}}
{{--                    <div>--}}
{{--                        @if($product->discount_price > 0 && $product->offer_end_date >= now()->toDateString())--}}
{{--                            <del>{{$product->price}} @lang('website.KWD')</del>--}}
{{--                            <strong>{{$product->discount_price}} @lang('website.KWD')</strong>--}}
{{--                        @else--}}
{{--                            <strong>{{$product->price}} @lang('website.KWD')</strong>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        @if($product->quantity > 1)--}}
{{--                            @if($product->is_cart==0)--}}
{{--                                <a class="btn-site addToCart" data-id="{{$product->id}}">--}}
{{--                                    <span>@lang('website.addToCart')</span>--}}
{{--                                </a>--}}
{{--                            @else--}}

{{--                                <a class="btn-site removeFromCart" data-id="{{$product->id}}">--}}
{{--                                    <span>@lang('website.removefromCart')</span>--}}
{{--                                </a>--}}

{{--                                <div class="quantity-item">--}}
{{--                                    <div class="quantity">--}}
{{--                                        <div class="btn button-count dec jsQuantityDecrease" data-id="{{$product->id}}" minimum="1">--}}
{{--                                            <i class="fa fa-minus" aria-hidden="true"></i>--}}
{{--                                        </div>--}}
{{--                                        <input type="text" name="count-quat1" class="count-quat" value="1" min="0" max="{{$product->quantity}}">--}}
{{--                                        <div class="btn button-count inc jsQuantityIncrease" max="{{$product->quantity}}" data-id="{{$product->id}}">--}}
{{--                                            <i class="fa fa-plus" aria-hidden="true"></i>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @endif--}}
{{--                        @else--}}
{{--                            <div class="soldOut">--}}
{{--                                <strong>@lang('website.Sold Out')</strong>--}}
{{--                            </div>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    @endforeach--}}
{{--</div>--}}

<div class="row">
    @foreach($products as $product)
        @php
            $variant = $product->variants->first(); // get first or default variant
        @endphp
        <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-4">
            <div class="item-product procard wow fadeInUp">
                <figure>
                    <a href="{{ route('prouctDetails', [$product->id, Str::slug($product->name)]) }}">
                        <img src="{{ $product->image }}" alt="{{ $product->name }}" loading="lazy" />
                    </a>

                    @if($product->is_favorite == 1)
                        <a class="btn_favorite item_fav removeFromFavorite" data-id="{{ $product->id }}">
                            <i class="fas fa-heart"></i>
                        </a>
                    @else
                        <a class="btn_favorite addToFavorite" data-id="{{ $product->id }}">
                            <i class="far fa-heart"></i>
                        </a>
                    @endif


                    @if($variant && $variant->discount_price > 0 )
                        @php
                            $dis_percent = ($variant->price - $variant->discount_price) / $variant->price * 100;
                            $dis_percent = round($dis_percent);
                        @endphp
                        @if($dis_percent>0)
                            <span class="offer-product">{{ $dis_percent }}% OFF</span>
                        @endif

                    @endif
                </figure>

                <div class="txt-product">
                    <a href="{{ route('prouctDetails', [$product->id, Str::slug($product->name)]) }}">
                        <p class="my-2 text-center font-semibold text-base leading-tight break-words whitespace-normal">

                            {{ $product->name }}</p>
                    </a>

                    <div>
                        @if($variant && $variant->discount_price > 0 &&$variant->discount_price< $variant->price )
                            <del>{{ number_format($variant->price,3) }} @lang('website.KWD')</del>
                            <strong>{{ number_format($variant->discount_price,3) }} @lang('website.KWD')</strong>
                        @elseif($variant)
                            <strong>{{ number_format($variant->price,3) }} @lang('website.KWD')</strong>
                        @else
                            <strong>{{ number_format($product->price,3) }} @lang('website.KWD')</strong>
                        @endif
                    </div>

                    <div>
                        @if($variant && $variant->quantity > 0)
{{--                            @if($product->is_cart == 0)--}}
                                <a class="btn-site addToCart" data-id="{{ $product->id }}"  data-variant-id="{{ $product->variants->first()->id??0 }}">
                                    <span>@lang('website.addToCart')</span>
                                </a>
{{--                            @else--}}
{{--                                <a class="btn-site removeFromCart" data-id="{{ $product->id }}">--}}
{{--                                    <span>@lang('website.removefromCart')</span>--}}
{{--                                </a>--}}
{{--                            @endif--}}
                        @else
                            <div class="soldOut">
                                <strong>@lang('website.Sold Out')</strong>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>


   @endif



