@extends('website.layout')
@section('title') @lang('website.orderDetails') @endsection
@section('css')
@endsection
@section('content')
	<section class="section_page_site">
            <div class="container">
                <div class="sec-head">
                    <h2>@lang('website.orderDetails')</h2>
                </div>
                <div class="cont-order New">
                    <div class="orderId">
                        <h2>@lang('website.Order Id')  :  <span>{{$item->id}}</span></h2>
                    </div>
                    <ul class="dateOrder">
                        <li> {{$item->total}} @lang('website.KWD')</li>
                        <li><i class="fa fa-calendar"></i> {{$item->created_at->format('d/m/Y')}}</li>
                    </ul>
                    <span class="typeOrder typeNew">{{$item->status_name}}</span>
                </div>
                <div class="body-order">
                    <div class="prod-order">
                        @foreach($item->products as $product )
                            <div class="item-pr">
                            <figure><img src="{{@$product->product->image}}" alt="" /></figure>
                            <div class="txt-item-order">
                                <h4>{{@$product->product->name}}</h4>
                                <p>@if($product->offer_price >0) {{$product->offer_price}} @else {{$product->price}} @endif @lang('website.KWD')</p>
                            </div>
                        </div>
                        @endforeach

                    </div>
                    <div class="pric-order">
                        <div class="data-order">
                            <div>
                                <p>@lang('website.Sub Price')</p>
                                <strong>{{$item->sub_total}} @lang('KWD')</strong>
                            </div>
                            <div>
                                <p>@lang('website.Shipping')</p>
                                <strong>{{$item->delivery_cost}} @lang('KWD')</strong>
                            </div>
                            <div>
                                <p>@lang('website.Discount')</p>
                                <strong>{{$item->discount}} @lang('KWD')</strong>
                            </div>
                            <div class="total-price">
                                <p>@lang('website.Total Price')</p>
                                <strong>{{$item->total}} @lang('KWD')</strong>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="order-details">
                    <div class="sec-left">
                        <div class="head-item">
                            <h3>@lang('website.Delivery Address') </h3>
                        </div>
                        <div>
                            <p>@lang('website.address_name')  :  {{$item->address_name}} </p>
                            <p>@lang('website.area')  :  {{@$item->area->name}}</p>
                            <p>@lang('website.street')  :  {{$item->street}}</p>

                        </div>
                    </div>
{{--                    <div class="sec-right">--}}
{{--                        <ul>--}}
{{--                            <li><i class="fa fa-calendar"></i>@lang('website.Date of receipt')  :  <span>{{$item->availabile_date}}</span></li>--}}
{{--                            <li><i class="fa fa-clock"></i>@lang('website.Time of receipt')  :  <span>{{$item->availabile_time}}</span></li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
                </div>
            </div>
		</section>
@endsection

@section('script')

@endsection

