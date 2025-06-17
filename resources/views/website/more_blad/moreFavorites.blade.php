   @if(count($items) > 0 )
{{--    @foreach($items as $item)--}}
{{--        <div class="col-md-3 product{{@$item->product->id}}">--}}
{{--            <div class="item-product wow fadeInUp">--}}
{{--                <figure>--}}
{{--                   <a href="{{route('prouctDetails',[$item->product->id,Str::slug($item->product->name)])}}"> <img src="{{@$item->product->image}}" alt="" /> </a>--}}
{{--                      <a class="btn_remove removeFromFavoriteItem" data-id="{{@$item->product->id}}"><i class="fa fa-times"></i></a>--}}


{{--                    @if(@$item->product->discount_price > 0 && @$item->product->offer_end_date >= now()->toDateString())--}}
{{--                      <span class="offer-product">{{@$item->product->discount_percent}}%</span>--}}
{{--                    @endif--}}
{{--                </figure>--}}
{{--                <div class="txt-product">--}}
{{--                   <a href="{{route('prouctDetails',[$item->product->id,Str::slug($item->product->name)])}}"> <p>{{@$item->product->name}}</p></a>--}}
{{--                    <div>--}}
{{--                         @if(@$item->product->discount_price > 0 && @$item->product->offer_end_date >= now()->toDateString())--}}
{{--                             <del>{{@$item->product->price}} @lang('website.KWD')</del>--}}
{{--                           <strong>{{$item->product->discount_price}} @lang('website.KWD')</strong>--}}
{{--                        @else--}}
{{--                        <strong>{{$item->product->price}} @lang('website.KWD')</strong>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                     <a class="btn-site @if(@$item->product->is_cart==0) addToCart @else removeFromCart @endif" data-id="{{@$item->product->id}}" ><span>@if(@$item->product->is_cart==0) @lang('website.addToCart') @else @lang('website.remove_from_cart') @endif</span></a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    @endforeach--}}


<div class="row">
    @foreach($items as $item)
        @php
            $product = $item->product;
            $isDiscounted = $product->discount_price > 0 && $product->offer_end_date >= now()->toDateString();
            $dis_percent = $isDiscounted ? round(($product->price - $product->discount_price)/$product->price * 100) : 0;
        @endphp
        <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-4 product{{ $product->id }}">
            <div class="item-product procard wow fadeInUp">
                <figure>
                    <a href="{{ route('prouctDetails', [$product->id, Str::slug($product->name)]) }}">
                        <img src="{{ $product->image }}" alt="{{ $product->name }}" loading="lazy" />
                    </a>
                    <a class="btn_remove removeFromFavoriteItem" data-id="{{ $product->id }}">
                        <i class="fa fa-times"></i>
                    </a>
                    @if($isDiscounted)
                        <span class="offer-product">{{ $dis_percent }}% OFF</span>
                    @endif
                </figure>
                <div class="txt-product">
                    <a href="{{ route('prouctDetails', [$product->id, Str::slug($product->name)]) }}">
                        <p>{{ $product->name }}</p>
                    </a>
                    <div>
                        @if($isDiscounted)
                            <del>{{number_format( $product->price,3) }} @lang('website.KWD')</del>
                            <strong>{{ number_format($product->discount_price,3) }} @lang('website.KWD')</strong>
                        @else
                            <strong>{{number_format( $product->price,3) }} @lang('website.KWD')</strong>
                        @endif
                    </div>
                    <div>
                        @if($product->quantity > 1)
                            @if($product->is_cart == 0)
                                <a class="btn-site addToCart" data-id="{{ $product->id }}">
                                    <span>@lang('website.addToCart')</span>
                                </a>
                            @else
                                <a class="btn-site removeFromCart" data-id="{{ $product->id }}">
                                    <span>@lang('website.removefromCart')</span>
                                </a>
                            @endif
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
