@extends('layout.subAdminLayout')

@section('title') {{ucwords(__('cp.orders'))}}
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
                <!--begin::Info-->
                <div class="d-flex align-items-center flex-wrap mr-1">
                    <div class="d-flex align-items-baseline mr-5">
                        <h3>{{__('cp.orders')}}</h3>
                    </div>
                </div>
                <!--end::Info-->
                <!--begin::Toolbar-->
                <div class="d-flex align-items-center">
                    <a href="{{url(getLocal().'/Stores_Portal/orders/')}}" class="btn btn-secondary  mr-2">{{__('cp.cancel')}}</a>
                    <button id="submitButton" class="btn btn-success ">{{__('cp.edit')}}</button>
                </div>
                <!--end::Toolbar-->
            </div>
        </div>
        <!--end::Subheader-->
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Card-->
                <div class="card card-custom gutter-b example example-compact">
                    <form method="post" action="{{url(getLocal().'/Stores_Portal/orders/'.$order->id)}}"
                          enctype="multipart/form-data" class="form-horizontal" role="form" id="form">
                        {{ csrf_field() }}
                        {{ method_field('PATCH')}}

                            <div class="card-header">
                                <h3 class="card-title">{{__('cp.order-details')}} / {{$order->id}}</h3>
                                <br>
                            </div>
                          
                     
                       <div class="row col-sm-12">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{__('cp.customer')}}</label>
                                                <input type="text" class="form-control form-control-solid"
                                                      value="{{$order->user->name}}" disabled/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{__('cp.total')}}</label>
                                                <input type="text" class="form-control form-control-solid" 
                                                   value="{{$order->total}}"  disabled/>
                                            </div>
                                        </div>

                  
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{__('cp.vat')}}</label>
                                                <input type="text" class="form-control form-control-solid" name="vat_amount"
                                                   value="{{$order->vat_amount}}" disabled  required/>
                                            </div>
                                        </div>
                                       
                                      
                  
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{__('cp.app_total')}}</label>
                                                <input type="text" class="form-control form-control-solid" name="app_total"
                                                   value="{{$order->app_total}}" disabled  required/>
                                            </div>
                                        </div>
                                       
                                      
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{__('cp.company_total')}}</label>
                                                <input type="text" class="form-control form-control-solid" name="company_total"
                                                   value="{{$order->company_total}}" disabled  required/>
                                            </div>
                                        </div>
                                       
                                      
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{__('cp.delivery_cost')}}</label>
                                                <input type="text" class="form-control form-control-solid" name="delivery_cost"
                                                   value="{{$order->delivery_cost}}" disabled  required/>
                                            </div>
                                        </div>
                                       
                                      
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{__('cp.discount')}}</label>
                                                <input type="text" class="form-control form-control-solid" name="discount"
                                                   value="{{$order->discount}}" disabled  required/>
                                            </div>
                                        </div>
                                       
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{__('cp.discount_code')}}</label>
                                                <input type="text" class="form-control form-control-solid" name="discount_code"
                                                   value="{{$order->discount_code}}" disabled  required/>
                                            </div>
                                        </div>
                                       
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{__('cp.status')}}</label>
                                                <input type="text" class="form-control form-control-solid" name="status"
                                                   value="{{$order->status_name}}" disabled  required/>
                                            </div>
                                        </div>
                                  
                           
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{__('cp.customeraddress')}}</label>
                                                <input type="text" class="form-control form-control-solid" name="status"
                                                   value="{{$order->address->address_name}}" disabled  required/>
                                            </div>
                                        </div>
                                                      
                                                  
													
                           	<!--begin::Advance Table: Widget 7-->
                           	 <div class="col-md-12">
										<div class="card card-custom gutter-b">
											<!--begin::Header-->
											<div class="card-header border-0 pt-5">
												<h3 class="card-title align-items-start flex-column">
													<span class="card-label font-weight-bolder text-dark">{{__('cp.products')}}</span>
												
												</h3>
										
											</div>
											<!--end::Header-->
											<!--begin::Body-->
											<div class="card-body py-3">
												<!--begin::Table-->
												<div class="table-responsive">
													<table class="table table-borderless table-vertical-center">
														<thead>
															<tr>
																<th class="p-0" style="width: 50px"> </th>
																<th class="p-0" style="min-width: 200px">{{__('cp.name')}}</th>
																<th class="p-0" style="min-width: 120px">{{__('cp.color')}}</th>
																<th class="p-0" style="min-width: 120px">{{__('cp.size')}}</th>
																<th class="p-0" style="min-width: 120px">{{__('cp.quantity')}}</th>
																<th class="p-0" style="min-width: 120px">{{__('cp.total')}}</th>
															</tr>
														</thead>
														<tbody>
														     @foreach($products as $one)
															<tr>
															   
																<td class="p-0 py-4">
																	<div class="symbol symbol-50 symbol-light">
																		<span class="symbol-label">
																			<img src="{{@$one->product->image}}" class="h-50 align-self-center" alt="" />
																		</span>
																	</div>
																</td>
																<td class="pl-0">
																	<a href="#"
																	class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg"></a>
																	<div>
																		<span class="font-weight-bolder">{{@$one->product->name}}</span>
																	
																	</div>
																</td>
																<td class="text-right">
																	<span class="text-dark-75 font-weight-bolder d-block font-size-lg">
																	  		 {{@$one->color->name}}  </span>
																
																</td>

															
																<td class="text-right">
																	<span class="text-dark-75 font-weight-bolder d-block font-size-lg">
																	 	 {{@$one->size->name}}   </span>
																
																</td>

															
																<td class="text-right">
																	<span class="text-dark-75 font-weight-bolder d-block font-size-lg">
																	 {{@$one->quantity}}   </span>
																
																</td>
                            		
																<td class="text-right">
																	<span class="text-dark-75 font-weight-bolder d-block font-size-lg">
																	 {{@$one->quantity * @$one->price}}   </span>
																
																</td>
                            		
															</tr>
															@endforeach
														</tbody>
													</table>
													  {{$products->appends($_GET)->links("pagination::bootstrap-4") }} 
												</div>
												<!--end::Table-->
											</div>
											<!--end::Body-->
										</div>
										</div>
										<!--end::Advance Table Widget 7-->
                                      

                                         <div class="col-md-10">
                                                   <div class="form-group">
                                                          <label >{{__('cp.changeStatus')}}</label>
                                                      <select id="status" class="form-control select2" name="status">
                                                      <option value="">{{__('cp.select')}}</option>
                                                      <option value="-1">{{__('api.new')}}</option> 
                                                      <option value="0">{{__('api.preparing')}}</option> 
                                                      <option value="1">{{__('api.on_way')}}</option> 
                                                      <option value="2">{{__('api.completed')}}</option> 
                                                      </select>
                                                   </div>
                                      </div>
                                    
                                    </div>

                      
                             
               
                        <button type="submit" id="submitForm" style="display:none"></button>
                    </form>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>


@endsection
@section('js')
    <script>
        $('#edit_image').on('change', function (e) {
            readURL(this, $('#editImage'));
        });
        $(document).on('click', '#submitButton', function () {
            // $('#submitButton').addClass('spinner spinner-white spinner-left');
            $('#submitForm').click();
        });
    </script>
@endsection

@section('script')

@endsection

