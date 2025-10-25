@extends('layout.venderLayout')
@section('title') {{__('cp.order-details')}}
@endsection
@section('css')
    <style>
        a:link {
            text-decoration: none;
        }
    </style>

@endsection
@section('content')

	<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
		<!--begin::Subheader-->
		<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
			<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
				<!--begin::Details-->
				<div class="d-flex align-items-center flex-wrap mr-2">
					<!--begin::Title-->
					<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{__('cp.order-details')}}</h5>
					<!--end::Title-->
					<!--begin::Separator-->
					<div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
					<!--end::Separator-->
					<!--begin::Search Form-->

					<!--end::Search Form-->
					<!--begin::Group Actions-->
					<div class="d-flex- align-items-center flex-wrap mr-2 d-none" id="kt_subheader_group_actions">
						<div class="text-dark-50 font-weight-bold">
						<span id="kt_subheader_group_selected_rows">23</span>Selected:</div>
						<div class="d-flex ml-6">
							<div class="dropdown mr-2" id="kt_subheader_group_actions_status_change">
								<button type="button" class="btn btn-light-primary font-weight-bolder btn-sm dropdown-toggle" data-toggle="dropdown">Update Status</button>
								<div class="dropdown-menu p-0 m-0 dropdown-menu-sm">
									<ul class="navi navi-hover pt-3 pb-4">
										<li class="navi-header font-weight-bolder text-uppercase text-primary font-size-lg pb-0">Change status to:</li>
										<li class="navi-item">
											<a href="#" class="navi-link" data-toggle="status-change" data-status="1">
												<span class="navi-text">
													<span class="label label-light-success label-inline font-weight-bold">Approved</span>
												</span>
											</a>
										</li>
										<li class="navi-item">
											<a href="#" class="navi-link" data-toggle="status-change" data-status="2">
												<span class="navi-text">
													<span class="label label-light-danger label-inline font-weight-bold">Rejected</span>
												</span>
											</a>
										</li>
										<li class="navi-item">
											<a href="#" class="navi-link" data-toggle="status-change" data-status="3">
												<span class="navi-text">
													<span class="label label-light-warning label-inline font-weight-bold">Pending</span>
												</span>
											</a>
										</li>
										<li class="navi-item">
											<a href="#" class="navi-link" data-toggle="status-change" data-status="4">
												<span class="navi-text">
													<span class="label label-light-info label-inline font-weight-bold">On Hold</span>
												</span>
											</a>
										</li>
									</ul>
								</div>
							</div>
							<button class="btn btn-light-success font-weight-bolder btn-sm mr-2" id="kt_subheader_group_actions_fetch" data-toggle="modal" data-target="#kt_datatable_records_fetch_modal">Fetch Selected</button>
							<button class="btn btn-light-danger font-weight-bolder btn-sm mr-2" id="kt_subheader_group_actions_delete_all">Delete All</button>
						</div>
					</div>
					<!--end::Group Actions-->
				</div>
				<!--end::Details-->
				<!--begin::Toolbar-->
				<div class="d-flex align-items-center">
					<!--begin::Button-->
					<a href="#" class=""></a>
					<!--end::Button-->
					<!--begin::Button-->
					<a href="{{url(getLocal().'/admin/orders/change_orderSts/1/'.$order->id)}}" class="btn btn-light-primary font-weight-bold ml-2">In Process  </a>
					<a href="{{url(getLocal().'/admin/orders/change_orderSts/2/'.$order->id)}}" class="btn btn-light-dark font-weight-bold ml-2">Deliver </a>
					<a href="{{url(getLocal().'/admin/orders/change_orderSts/3/'.$order->id)}}" class="btn btn-light-success font-weight-bold ml-2"> Complete </a>
					<a href="{{url(getLocal().'/admin/orders/change_orderSts/4/'.$order->id)}}" class="btn btn-light-danger font-weight-bold ml-2"> Cancel </a>
					<!--end::Button-->
					<!--begin::Dropdown-->

					<!--end::Dropdown-->
				</div>
				<!--end::Toolbar-->
			</div>
		</div>
		<!--end::Subheader-->
		<!--begin::Entry-->
		<div class="d-flex flex-column-fluid">
			<div class="container-fluid">
				<div class="card card-custom gutter-b">

				<div class="row">
					<div class="col-md-6">
						<div class="card card-custom gutter-b">
							<div class="card-body">
									<div class="d-flex">
								<div class="flex-shrink-0 mr-7 mt-lg-0 mt-3">
									<div class="symbol symbol-50 symbol-lg-120">
										<img alt="Pic" src="{{@$order->user->image}}" />
									</div>
									<div class="symbol symbol-50 symbol-lg-120 symbol-primary d-none">
										<span class="font-size-h3 symbol-label font-weight-boldest">JM</span>
									</div>
								</div>
								<div class="flex-grow-1">
									<div class="d-flex align-items-center justify-content-between flex-wrap">
										<div class="mr-3">
											<a href="#" class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3">{{@$order->user->name}}</a>
											<div class="d-flex flex-wrap my-2">
												<a href="#" class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
												<span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
														<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
															<rect x="0" y="0" width="24" height="24" />
															<path d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" fill="#000000" />
															<circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5" />
														</g>
													</svg>
												</span>{{@$order->user->email}}</a>
												<a href="#" class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
												<span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
															<rect x="0" y="0" width="24" height="24"/>
															<path d="M7.13888889,4 L7.13888889,19 L16.8611111,19 L16.8611111,4 L7.13888889,4 Z M7.83333333,1 L16.1666667,1 C17.5729473,1 18.25,1.98121694 18.25,3.5 L18.25,20.5 C18.25,22.0187831 17.5729473,23 16.1666667,23 L7.83333333,23 C6.42705272,23 5.75,22.0187831 5.75,20.5 L5.75,3.5 C5.75,1.98121694 6.42705272,1 7.83333333,1 Z" fill="#000000" fill-rule="nonzero"/>
															<polygon fill="#000000" opacity="0.3" points="7 4 7 19 17 19 17 4"/>
															<circle fill="#000000" cx="12" cy="21" r="1"/>
															</g>
													</svg>
												</span>{{@$order->user->mobile}}</a>
											</div>
										</div>
									</div>

									<!--<div class="d-flex align-items-center flex-wrap justify-content-between">-->

									<!--	<div class="d-flex flex-wrap align-items-center py-2">-->
									<!--		<div class="d-flex align-items-center mr-10">-->
									<!--			<div class="mr-6">-->
									<!--				<div class="font-weight-bold mb-2">{{__('cp.order_id')}}</div>-->
									<!--				<span class="btn btn-sm btn-text btn-light-primary text-uppercase font-weight-bold">{{$order->id}}</span>-->
									<!--			</div>-->
												<!--<div class="">-->
												<!--	<div class="font-weight-bold mb-2">{{__('cp.order_date')}}</div>-->
												<!--	<span class="btn btn-sm btn-text btn-light-danger text-uppercase font-weight-bold">{{$order->created_at}}</span>-->
												<!--</div>-->
									<!--		</div>-->

									<!--	</div>-->
									<!--</div>-->
									<!--end: Content-->
								</div>
							</div>
						</div>

					</div>
				</div>

				</div>
					<div class="card-body">
						<!--<div class="separator separator-solid my-7"></div>-->
						<div class="d-flex align-items-center flex-wrap">
							<div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
								<span class="mr-4">
									#
								</span>
								<div class="d-flex flex-column text-dark-75">
									<span class="font-weight-bolder font-size-sm">{{__('cp.order_id')}}</span>
									<span class="font-weight-bolder font-size-h5">
									<span class="text-dark-50 font-weight-bold"></span>{{$order->id}}</span>
								</div>
							</div>
							<div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
								<span class="mr-4">
									<i class="flaticon-calendar-with-a-clock-time-tools" style="font-size: 25px;"></i>
								</span>
								<div class="d-flex flex-column text-dark-75">
									<span class="font-weight-bolder font-size-sm">{{__('cp.order_date')}}</span>
									<span class="font-weight-bolder font-size-h5">
									<span class="text-dark-50 font-weight-bold"></span>{{$order->created_at}}</span>
								</div>
							</div>

							 <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
								<span class="mr-4">
								<i class="fas fa-dollar-sign" style="font-size: 25px;"></i>
								</span>
								<div class="d-flex flex-column text-dark-75">
									<span class="font-weight-bolder font-size-sm">{{__('cp.payment_method')}}</span>
									<span class="font-weight-bolder font-size-h5">
											@if($order->payment_method == 1)
                                            {{__('cp.cache')}}
										@elseif($order->payment_method == 2)
                                            {{__('cp.online')}}
										@endif
										</span>

								</div>
							</div>

						</div>
						<div class="separator separator-solid my-7"></div>
						<div class="d-flex align-items-center flex-wrap">
							<div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
								<span class="mr-4">
									<i class="fas fa-dollar-sign" style="font-size: 25px;"></i>
								</span>
									<div class="d-flex flex-column text-dark-75">
										<span class="font-weight-bolder font-size-sm">{{__('cp.sub_total')}}</span>
									<span class="font-weight-bolder font-size-h5">
										{{$order->sub_total}} <span class="text-dark-50 font-weight-bold">{{__('cp.KD')}} </span></span>
								</div>
							</div>
							<div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
								<span class="mr-4">
									<i class="fas fa-dollar-sign" style="font-size: 25px;"></i>
								</span>
									<div class="d-flex flex-column text-dark-75">
										<span class="font-weight-bolder font-size-sm">{{__('cp.delivery_cost')}}</span>
									<span class="font-weight-bolder font-size-h5">
										{{$order->delivery_cost}} <span class="text-dark-50 font-weight-bold">{{__('cp.KD')}} </span></span>
								</div>
							</div>


							<div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
								<span class="mr-4">
									<i class="flaticon-file-2 icon-2x text-muted font-weight-bold"></i>
								</span>
									<div class="d-flex flex-column text-dark-75">
									<span class="font-weight-bolder font-size-sm">{{__('cp.promo_code')}}</span>
									<span class="font-weight-bolder font-size-h5">
										@if($order->discount_code != 0) {{$order->discount_code}} @else --- @endif

										</span>
								</div>
							</div>
							<div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
								<span class="mr-4">
									<i class="fas fa-dollar-sign" style="font-size: 25px;"></i>
								</span>
									<div class="d-flex flex-column text-dark-75">
										<span class="font-weight-bolder font-size-sm">{{__('cp.discount')}}</span>
									<span class="font-weight-bolder font-size-h5">
										{{$order->discount}} <span class="text-dark-50 font-weight-bold">{{__('cp.KD')}} </span></span>
								</div>
							</div>

							<div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
								<span class="mr-4">
									<i class="fas fa-dollar-sign" style="font-size: 25px;"></i>
								</span>
									<div class="d-flex flex-column text-dark-75">
										<span class="font-weight-bolder font-size-sm">{{__('cp.total')}}</span>
									<span class="font-weight-bolder font-size-h5">
										{{$order->total}} <span class="text-dark-50 font-weight-bold">{{__('cp.KD')}} </span></span>
								</div>
							</div>

						</div>
							<div class="separator separator-solid my-7"></div>

{{--						<div class="d-flex align-items-center flex-wrap">--}}
{{--							<div class="d-flex align-items-center flex-lg-fill mr-5 my-1">--}}
{{--								<span class="mr-4">--}}
{{--									<i class="flaticon-file-2 icon-2x text-muted font-weight-bold"></i>--}}
{{--								</span>--}}
{{--									<div class="d-flex flex-column text-dark-75">--}}
{{--									<span class="font-weight-bolder font-size-sm">{{__('cp.delivery_cost')}}</span>--}}
{{--									<span class="font-weight-bolder font-size-h5">--}}
{{--										{{$order->delivery_cost}}	<span class="text-dark-50 font-weight-bold">{{__('cp.KD')}} </span></span>--}}
{{--								</div>--}}
{{--							</div>--}}
{{--							<div class="d-flex align-items-center flex-lg-fill mr-5 my-1">--}}
{{--								<span class="mr-4">--}}
{{--									<i class="fas fa-dollar-sign" style="font-size: 25px;"></i>--}}
{{--								</span>--}}
{{--									<div class="d-flex flex-column text-dark-75">--}}
{{--										<span class="font-weight-bolder font-size-sm">{{__('cp.sub_total')}}</span>--}}
{{--									<span class="font-weight-bolder font-size-h5">--}}
{{--										{{$order->sub_total}} <span class="text-dark-50 font-weight-bold">{{__('cp.KD')}} </span></span>--}}
{{--								</div>--}}
{{--							</div>--}}

{{--								<div class="d-flex align-items-center flex-lg-fill mr-5 my-1">--}}
{{--								<span class="mr-4">--}}
{{--									<i class="fas fa-dollar-sign" style="font-size: 25px;"></i>--}}
{{--								</span>--}}
{{--									<div class="d-flex flex-column text-dark-75">--}}
{{--										<span class="font-weight-bolder font-size-sm">{{__('cp.total')}}</span>--}}
{{--									<span class="font-weight-bolder font-size-h5">--}}
{{--										{{$order->total}} <span class="text-dark-50 font-weight-bold">{{__('cp.KD')}} </span></span>--}}
{{--								</div>--}}
{{--							</div>--}}
{{--							<!--<div class="d-flex align-items-center flex-lg-fill mr-5 my-1">-->--}}
{{--							<!--	<span class="mr-4">-->--}}
{{--							<!--		<i class="flaticon2-percentage" style="font-size: 25px;"></i>-->--}}
{{--							<!--	</span>-->--}}
{{--							<!--		<div class="d-flex flex-column text-dark-75">-->--}}
{{--							<!--		<span class="font-weight-bolder font-size-sm">{{__('cp.tax')}}</span>-->--}}
{{--							<!--		<span class="font-weight-bolder font-size-h5">-->--}}
{{--							<!--		{{$order->tax_percent}} <span class="text-dark-50 font-weight-bold"> % </span></span>-->--}}
{{--							<!--	</div>-->--}}
{{--							<!--</div>-->--}}
{{--							<!--<div class="d-flex align-items-center flex-lg-fill mr-5 my-1">-->--}}
{{--							<!--	<span class="mr-4">-->--}}
{{--							<!--		<i class="fas fa-dollar-sign" style="font-size: 25px;"></i>-->--}}
{{--							<!--	</span>-->--}}
{{--							<!--		<div class="d-flex flex-column text-dark-75">-->--}}
{{--							<!--		<span class="font-weight-bolder font-size-sm">{{__('cp.tax')}} {{__('cp.amount')}}</span>-->--}}
{{--							<!--		<span class="font-weight-bolder font-size-h5">-->--}}
{{--							<!--		{{$order->tax_amount}} <span class="text-dark-50 font-weight-bold"> {{__('cp.KD')}} </span></span>-->--}}
{{--							<!--	</div>-->--}}
{{--							<!--</div>-->--}}
{{--						</div>--}}

							<div class="separator separator-solid my-7"></div>
								<div class="d-flex align-items-center flex-wrap">

								<div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
									<span class="mr-4">
										<i class="flaticon-file-2 icon-2x text-muted font-weight-bold"></i>
									</span>
										<div class="d-flex flex-column text-dark-75">
										<span class="font-weight-bolder font-size-sm">{{__('cp.address')}}</span>
										<span class="font-weight-bolder font-size-h5">
											{{$order->address_name}}
											</span>
									</div>
								</div>
								<div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
									<span class="mr-4">
										<i class="flaticon-file-2 icon-2x text-muted font-weight-bold"></i>
									</span>
										<div class="d-flex flex-column text-dark-75">
										<span class="font-weight-bolder font-size-sm">{{__('cp.street')}}</span>
										<span class="font-weight-bolder font-size-h5">
											{{$order->street}}
											</span>
									</div>
								</div>
								<div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
									<span class="mr-4">
										<i class="flaticon-file-2 icon-2x text-muted font-weight-bold"></i>
									</span>
										<div class="d-flex flex-column text-dark-75">
										<span class="font-weight-bolder font-size-sm">{{__('cp.area')}}</span>
										<span class="font-weight-bolder font-size-h5">
											{{@$order->area->name}}
											</span>
									</div>
								</div>

                                    <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
    <span class="mr-4">
        <i class="flaticon2-phone icon-2x text-muted font-weight-bold"></i>
    </span>
                                        <div class="d-flex flex-column text-dark-75">
                                            <span class="font-weight-bolder font-size-sm">{{ __('cp.phone') }}</span>
                                            <span class="font-weight-bolder font-size-h5">
            {{ @$order->address->mobile }}
        </span>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
    <span class="mr-4">
        <i class="flaticon2-map icon-2x text-muted font-weight-bold"></i>
    </span>
                                        <div class="d-flex flex-column text-dark-75">
                                            <span class="font-weight-bolder font-size-sm">{{ __('cp.locationonmap') }}</span>
                                            <span class="font-weight-bolder font-size-h5">
            @if(!empty( @$order->address->latitude) && !empty( @$order->address->longitude))
                                                    <a href="https://www.google.com/maps?q={{  @$order->address->latitude }},{{  @$order->address->longitude }}" target="_blank">
                    {{  @$order->address->latitude }}, {{  @$order->address->longitude }}
                </a>
                                                @else
                                                    {{ __('cp.no_location_available') }}
                                                @endif
        </span>
                                        </div>
                                    </div>


                                </div>
                        </span>
                        <div class="d-flex flex-column text-dark-75">
                            <span class="font-weight-bolder font-size-sm">{{__('cp.delivery_note')}}</span>
                            <span class="font-weight-bolder font-size-h5">
												      {{@$order->delivery_note->delivery_note}}
												     </span>
						<!--begin: Items-->
					</div>
				</div>




				 @if(count($products) > 0)
					<div class="row">
					<div class="col-lg-12">
						<div class="card card-custom card-stretch gutter-b">
							<div class="card-header border-0 pt-5">
								<h3 class="card-title align-items-start flex-column">
									<span class="card-label font-weight-bolder text-dark">{{__('cp.products')}}</span>
								</h3>
							</div>
							<div class="card-body py-3">
								<div class="table-responsive">
									<table class="table table-borderless table-vertical-center">
										<thead>
											<tr>
												<th  >{{__('cp.image')}}</th>
												<th  >{{__('cp.name')}}</th>
												<th >{{__('cp.price')}}</th>
												<th >{{__('cp.offer_price')}}</th>
												<th >{{__('cp.quantity')}}</th>
												<th >{{__('cp.total')}}</th>
											</tr>
										</thead>
										<tbody>
												@foreach($products as $one)
											<tr>
												<td  >
													<div class="symbol symbol-50 symbol-light">
														<span class="symbol-label">
															<img src="{{@$one->product->image}}" class="h-50 align-self-center" alt="" />
														</span>
													</div>
												</td>
												<td> {{@$one->product->name}}--({{$one->variant->name}}) </td>
												<td> {{@$one->price}}</td>
												<td> {{@$one->offer_price}}</td>
												<td> {{@$one->quantity}}</td>
												@if(@$one->offer_price==0)
												<td > {{@$one->quantity * @$one->price}} 	</td>
												@else
												<td > {{@$one->quantity * @$one->offer_price}} 	</td>
												@endif
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>

						</div>
						<!--end::Advance Table Widget 3-->
					</div>
					<!--<div class="col-lg-4">-->
						<!--begin::Charts Widget 3-->
					<!--	<div class="card card-custom card-stretch gutter-b">-->

					<!--	</div>-->
						<!--end::Charts Widget 3-->
					<!--</div>-->
				</div>
				@endif


				<!--end::Row-->

			</div>

			<!--end::Container-->
		</div>
		<!--end::Entry-->
	</div>
					<!--end::Content-->


					@endsection
@section('js')
@endsection
@section('script')
    <script>
    $(document).ready(function () {

    $("#invoice_discount").on("input", function(evt) {
   var self = $(this);
   self.val(self.val().replace(/[^0-9\.]/g, ''));
   if ((evt.which != 46 || self.val().indexOf('.') != -1) && (evt.which < 48 || evt.which > 57))
   {
     evt.preventDefault();
   }
 });
    });


                      function openWindow($url)
        {
            window.open($url, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=200,left=200,width=800,height=700");
        }

    </script>
@endsection
