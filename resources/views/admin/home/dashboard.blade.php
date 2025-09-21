@extends('layout.adminLayout')
@section('title') {{ucwords(__('cp.home'))}}
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
                        <h3>{{ucwords(__('cp.statistics'))}}</h3>
                    </div>
                </div>
                <!--end::Info-->

            </div>
        </div>
        <!--end::Subheader-->


        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Card-->
                <div class="gutter-b example example-compact">
                    <div class="d-flex flex-column-fluid">
                        <div class="container">
                            <div class="gutter-b example example-compact">
                                <div class="card card-custom gutter-b">
        							<div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-6 col-xl-4 mb-5">
                                                    <div class="card card-custom wave wave-animate-fast">
                                                        <div class="card-body">
            												<span class="svg-icon svg-icon-2x svg-icon-info">
                                        						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                                    height="24px" viewBox="0 0 24 24" version="1.1">
                                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                        <polygon points="0 0 24 0 24 24 0 24"/>
                                                                        <path
                                                                            d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z"
                                                                            fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                                        <path
                                                                            d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"
                                                                            fill="#000000" fill-rule="nonzero"/>
                                                                    </g>
                                                                </svg>
            												</span>
                                                            <span
                                                                class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">{{$count_users}}</span>
                                                            <span
                                                                class="font-weight-bold text-muted font-size-sm">{{__('cp.countUsers')}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-xl-4 mb-5">
                                                    <!--begin::Iconbox-->
                                                    <div class="card card-custom wave wave-animate-fast">
                                                        <div class="card-body">
            												<span class="svg-icon svg-icon-2x svg-icon-dark">
                 										     	<svg xmlns="http://www.w3.org/2000/svg"
                                                                 xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                                 viewBox="0 0 24 24" version="1.1">
                                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                        <rect x="0" y="0" width="24" height="24"/>
                                                                        <rect fill="#2791bb66" opacity="0.3" x="2" y="5" width="20" height="14" rx="2"/>
                                                                        <rect fill="#2791bb66" x="2" y="8" width="20" height="3"/>
                                                                        <rect fill="#2791bb66" opacity="0.3" x="16" y="14" width="4" height="2" rx="1"/>
                                                                    </g>
                                                                </svg>
             												</span>
                                                            <span
                                                                class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">{{round($total_sales, 3)}} {{__('cp.KD')}} </span>
                                                            <span
                                                                class="font-weight-bold text-muted font-size-sm">{{__('cp.total_sales')}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-xl-4 mb-5">
                                                    <div class="card card-custom wave wave-animate-fast">
                                                        <div class="card-body">
            												<span class="svg-icon svg-icon-2x svg-icon-success">
                                                              	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                                     height="24px" viewBox="0 0 24 24" version="1.1">
                                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                        <rect x="0" y="0" width="24" height="24"/>
                                                                        <path
                                                                            d="M5,2 L19,2 C20.1045695,2 21,2.8954305 21,4 L21,6 C21,7.1045695 20.1045695,8 19,8 L5,8 C3.8954305,8 3,7.1045695 3,6 L3,4 C3,2.8954305 3.8954305,2 5,2 Z M11,4 C10.4477153,4 10,4.44771525 10,5 C10,5.55228475 10.4477153,6 11,6 L16,6 C16.5522847,6 17,5.55228475 17,5 C17,4.44771525 16.5522847,4 16,4 L11,4 Z M7,6 C7.55228475,6 8,5.55228475 8,5 C8,4.44771525 7.55228475,4 7,4 C6.44771525,4 6,4.44771525 6,5 C6,5.55228475 6.44771525,6 7,6 Z"
                                                                            fill="#000000" opacity="0.3"/>
                                                                        <path
                                                                            d="M5,9 L19,9 C20.1045695,9 21,9.8954305 21,11 L21,13 C21,14.1045695 20.1045695,15 19,15 L5,15 C3.8954305,15 3,14.1045695 3,13 L3,11 C3,9.8954305 3.8954305,9 5,9 Z M11,11 C10.4477153,11 10,11.4477153 10,12 C10,12.5522847 10.4477153,13 11,13 L16,13 C16.5522847,13 17,12.5522847 17,12 C17,11.4477153 16.5522847,11 16,11 L11,11 Z M7,13 C7.55228475,13 8,12.5522847 8,12 C8,11.4477153 7.55228475,11 7,11 C6.44771525,11 6,11.4477153 6,12 C6,12.5522847 6.44771525,13 7,13 Z"
                                                                            fill="#000000"/>
                                                                        <path
                                                                            d="M5,16 L19,16 C20.1045695,16 21,16.8954305 21,18 L21,20 C21,21.1045695 20.1045695,22 19,22 L5,22 C3.8954305,22 3,21.1045695 3,20 L3,18 C3,16.8954305 3.8954305,16 5,16 Z M11,18 C10.4477153,18 10,18.4477153 10,19 C10,19.5522847 10.4477153,20 11,20 L16,20 C16.5522847,20 17,19.5522847 17,19 C17,18.4477153 16.5522847,18 16,18 L11,18 Z M7,20 C7.55228475,20 8,19.5522847 8,19 C8,18.4477153 7.55228475,18 7,18 C6.44771525,18 6,18.4477153 6,19 C6,19.5522847 6.44771525,20 7,20 Z"
                                                                            fill="#000000"/>
                                                                    </g>
                                                                </svg>
             												</span>
                                                            <span
                                                                class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">{{$count_orders}}</span>
                                                            <span
                                                                class="font-weight-bold text-muted font-size-sm">{{__('cp.countOrder')}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                    </div>
                                 </div>


                            </div>
                        </div>

                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::Entry-->
        </div>

        <div class="card-body card-custom card-stretch gutter-b">
            <div class="row">
    <div class="col-md-6 order-2 order-xxl-1">
        <!--begin::Advance Table Widget 2-->
        <div class="card card-custom card-stretch gutter-b">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label font-weight-bolder text-dark">@lang('cp.last_users')</span>

                </h3>

                  <div class="card-toolbar">
        					<a href="{{url(getLocal().'/admin/users')}}" class="btn btn-info font-weight-bolder font-size-sm mr-3">@lang('cp.all')</a>
					    </div>

            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-3 pb-0">
                <!--begin::Table-->
                <div class="table-responsive">
                    <table class="table table-hover tableWithSearch" id="kt_datatable">
                        <thead>
                        <tr>
                            <th class="wd-5p"> {{ucwords(__('cp.image'))}}</th>
                            <th class="wd-25p"> {{ucwords(__('cp.name'))}}</th>
                            <th class="wd-25p"> {{ucwords(__('cp.mobile'))}}</th>
                            <th class="wd-25p"> {{ucwords(__('cp.email'))}}</th>

                            <th class="wd-10p"> {{ucwords(__('cp.status'))}}</th>
                            <th class="wd-10p"> {{ucwords(__('cp.created'))}}</th>
                            <th class="wd-15p notExport"> {{ucwords(__('cp.action'))}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($last_users as $one)
                            <tr class="odd gradeX" id="tr-{{$one->id}}">


                                <td class="v-align-middle wd-5p"><img src="{{$one->image}}" width="50px" height="50px"></td>

                                <td class="v-align-middle wd-25p">{{$one->name}}</td>
                                <td class="v-align-middle wd-25p">{{$one->mobile}}</td>
                                <td class="v-align-middle wd-25p">{{$one->email}}</td>
                                <td class="v-align-middle wd-10p">
                                     <span id="label-{{$one->id}}"
                                          class="badge badge-pill badge-{{($one->status == "active")
                                             ? "info" : "danger"}}" id="label-{{$one->id}}">
                                              {{__('cp.'.$one->status)}}
                                        </span>
                                </td>

                                <td class="v-align-middle wd-10p">{{$one->created_at->format('Y-m-d')}}</td>

                                <td class="v-align-middle wd-15p optionAddHours notExport">

                                    <a href="{{url(getLocal().'/admin/users/'.$one->id.'/edit')}}"
                                       class="btn btn-sm btn-clean btn-icon" title="{{__('cp.show')}}">
                                        <i class="la la-eye"></i>
                                    </a>


                                    <!--<a href="{{url(getLocal().'/admin/users/'.$one->id.'/createNotification')}}"-->
                                    <!--   class="btn btn-sm btn-clean btn-icon" title="{{__('cp.message')}}">-->
                                    <!--    <i class="la la-comment"></i>-->
                                    <!--</a>-->

                                </td>
                            </tr>
                        @empty

                        @endforelse


                        </tbody>
                    </table>

                </div>
                <!--end::Table-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Advance Table Widget 2-->
    </div>
    <div class="col-md-6 order-2 order-xxl-1">
        <!--begin::Advance Table Widget 2-->
        <div class="card card-custom card-stretch gutter-b">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label font-weight-bolder text-dark">@lang('cp.top_sales_products')</span>

                </h3>

                  <div class="card-toolbar">
        					<a href="{{url(getLocal().'/admin/products')}}" class="btn btn-info font-weight-bolder font-size-sm mr-3">@lang('cp.all')</a>
					    </div>

            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-3 pb-0">
                <!--begin::Table-->
                <div class="table-responsive">
                    <table class="table table-hover tableWithSearch" id="kt_datatable">
                        <thead>
                        <tr>
                            <th class="wd-5p"> {{ucwords(__('cp.image'))}}</th>
                            <th class="wd-25p"> {{ucwords(__('cp.name'))}}</th>
                            <th class="wd-25p"> {{ucwords(__('cp.price'))}}</th>
                            <th class="wd-25p"> {{ucwords(__('cp.saled_count'))}}</th>

                            <th class="wd-10p"> {{ucwords(__('cp.status'))}}</th>
                            <th class="wd-10p"> {{ucwords(__('cp.created'))}}</th>
                            <th class="wd-15p notExport"> {{ucwords(__('cp.action'))}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($top_sales_products as $one)
                            <tr class="odd gradeX" id="tr-{{$one->id}}">


                                <td class="v-align-middle wd-5p"><img src="{{$one->product->image}}" width="50px" height="50px"></td>

                                <td class="v-align-middle wd-25p">{{$one->product->name}}</td>
                                <td class="v-align-middle wd-25p">{{$one->product->price}}</td>
                                <td class="v-align-middle wd-25p">{{$one->count_saled_quantity}}</td>
                                 <td class="v-align-middle wd-10p">
                                     <span id="label-{{$one->id}}"
                                          class="badge badge-pill badge-{{($one->status == "active")
                                             ? "info" : "danger"}}" id="label-{{$one->id}}">
                                              {{__('cp.'.$one->product->status)}}
                                        </span>
                                </td>

                                <td class="v-align-middle wd-10p">{{$one->product->created_at->format('Y-m-d')}}</td>

                                <td class="v-align-middle wd-15p optionAddHours notExport">

                                    <a href="{{url(getLocal().'/admin/products/'.$one->product->id.'/edit')}}"
                                       class="btn btn-sm btn-clean btn-icon" title="{{__('cp.show')}}">
                                        <i class="la la-eye"></i>
                                    </a>


                                    <!--<a href="{{url(getLocal().'/admin/users/'.$one->id.'/createNotification')}}"-->
                                    <!--   class="btn btn-sm btn-clean btn-icon" title="{{__('cp.message')}}">-->
                                    <!--    <i class="la la-comment"></i>-->
                                    <!--</a>-->

                                </td>
                            </tr>
                        @empty

                        @endforelse


                        </tbody>
                    </table>

                </div>
                <!--end::Table-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Advance Table Widget 2-->
    </div>
    <div class="col-md-12 order-2 order-xxl-1">
                <!--begin::Advance Table Widget 2-->
                <div class="card card-custom card-stretch gutter-b">
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark">@lang('cp.last_orders')</span>

                        </h3>

                        <div class="card-toolbar">
        					<a href="{{url(getLocal().'/admin/orders')}}" class="btn btn-info font-weight-bolder font-size-sm mr-3">@lang('cp.all')</a>
					    </div>

                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-3 pb-0">
                        <!--begin::Table-->
                        <div class="table-responsive">
                            <table class="table table-hover tableWithSearch" id="kt_datatable">
                                <thead>
                                <tr>
                                  <th class="wd-25p"> {{ucwords(__('cp.name'))}}</th>
                                  <th class="wd-25p"> {{ucwords(__('cp.email'))}}</th>
                                  <th class="wd-25p"> {{ucwords(__('cp.total'))}}</th>
                                  <th class="wd-10p"> {{ucwords(__('cp.status'))}}</th>
                                  <th class="wd-10p"> {{ucwords(__('cp.created'))}}</th>
                                  <th class="wd-15p notExport"> {{ucwords(__('cp.action'))}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($last_orders as $one)
                                    <tr class="odd gradeX" id="tr-{{$one->id}}">



                                        <td class="v-align-middle wd-25p">{{$one->user->name}}</td>
                                        <td class="v-align-middle wd-25p">{{$one->user->email}}</td>
                                        <td class="v-align-middle wd-25p">{{$one->total}}</td>
                                        <td class="v-align-middle wd-10p">
                                             {{$one->status_name}}
                                        </td>

                                        <td class="v-align-middle wd-10p">{{$one->created_at->format('Y-m-d')}}</td>

                                        <td class="v-align-middle wd-15p optionAddHours notExport">

                                            <a href="{{url(getLocal().'/admin/orders/'.$one->id.'/show')}}"
                                               class="btn btn-sm btn-clean btn-icon" title="{{__('cp.show')}}">
                                                <i class="la la-eye"></i>
                                            </a>


                                        </td>
                                    </tr>
                                @empty

                                @endforelse


                                </tbody>
                            </table>

                        </div>
                        <!--end::Table-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Advance Table Widget 2-->
            </div>
</div>
            <div class="row">
				<div class="col-lg-12">
					<!--begin::Card-->
					<div class="card card-custom gutter-b">
						<!--begin::Header-->
						<div class="card-header h-auto">
							<!--begin::Title-->
							<div class="card-title py-5">
								<h3 class="card-label">{{__('cp.orders_count')}}</h3>
							</div>
							<!--end::Title-->
						</div>
						<!--end::Header-->
						<div class="card-body">
							<!--begin::Chart-->
							<div id="chart_1"></div>
							<!--end::Chart-->
						</div>
					</div>
					<!--end::Card-->
				</div>
				<div class="col-lg-12">
					<!--begin::Card-->
					<div class="card card-custom gutter-b">
						<div class="card-header">
							<div class="card-title">
								<h3 class="card-label">{{__('cp.orders_static_total')}}</h3>
							</div>
						</div>
						<div class="card-body">
							<!--begin::Chart-->
							<div id="chart_2"></div>
							<!--end::Chart-->
						</div>
					</div>
					<!--end::Card-->
				</div>
				<div class="col-lg-12">
					<!--begin::Card-->
					<div class="card card-custom gutter-b">
						<div class="card-header">
							<div class="card-title">
								<h3 class="card-label">{{__('cp.users')}}</h3>
							</div>
						</div>
						<div class="card-body">
							<!--begin::Chart-->
							<div id="chart_3"></div>
							<!--end::Chart-->
						</div>
					</div>
					<!--end::Card-->
				</div>
			</div>
     <!--       <div class="row">-->


     <!--           	<div class="col-lg-6">-->
					<!--	<div class="card card-custom gutter-b">-->
					<!--		<div class="card-body">-->
					<!--		 <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">-->
     <!--                               <canvas id="myChart3"  width="100%" height="50px"></canvas>-->
     <!--                           </div>-->
					<!--		</div>-->
					<!--	</div>-->
					<!--</div>-->


     <!--           <div class="col-md-6">-->

     <!--               	<div class="card card-custom gutter-b">-->
					<!--		<div class="card-body">-->
					<!--		  <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">-->
     <!--                           <canvas id="orders_static_total"  width="100%" height="50px"></canvas>-->
     <!--                        </div>-->
					<!--		</div>-->
					<!--	</div>-->



     <!--           </div>-->
     <!--               <div class="col-md-6">-->

     <!--                   	<div class="card card-custom gutter-b">-->
					<!--		<div class="card-body">-->
					<!--		  <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">-->
     <!--                           <canvas id="myChart2"  width="100%" height="50px"></canvas>-->
     <!--                         </div>-->
					<!--		</div>-->
					<!--	</div>-->


     <!--                    </div>-->
     <!--       </div>-->


        </div>
        @endsection
        @section('js')
            <script>

                function delete_adv(id, iss_id, e) {
                    //alert(id);
                    e.preventDefault();
                    console.log(id);
                    console.log(iss_id);
                    var url = '{{url(getLocal()."/admin/users")}}/' + id;
                    var csrf_token = '{{csrf_token()}}';
                    $.ajax({
                        type: 'delete',
                        headers: {'X-CSRF-TOKEN': csrf_token},
                        url: url,
                        data: {_method: 'delete'},
                        success: function (response) {
                            console.log(response);
                            if (response === 'success') {
                                $('#tr-' + id).hide(500);
                                $('#myModal' + id).modal('toggle');

                            } else {
                                // swal('Error', {icon: "error"});
                            }
                        },
                        error: function (e) {
                            // swal('exception', {icon: "error"});
                        }
                    });

                }
            </script>


            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.js" integrity="sha512-zO8oeHCxetPn1Hd9PdDleg5Tw1bAaP0YmNvPY8CwcRyUk7d7/+nyElmFrB6f7vg4f7Fv4sui1mcep8RIEShczg==" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.min.js" integrity="sha512-SuxO9djzjML6b9w9/I07IWnLnQhgyYVSpHZx0JV97kGBfTIsUYlWflyuW4ypnvhBrslz1yJ3R+S14fdCWmSmSA==" crossorigin="anonymous"></script>

            <script>
                // var ctx = document.getElementById('myChart3');
                // var myChart = new Chart(ctx, {
                //     //type:  horizontalBar  line   bar   radar   doughnut    polar    bubble    scatter
                //     type: 'bar',
                //     data: {
                //         labels: [
                //             @forelse(@$orders_static as $items)
                //                 '{{$items->months}}',
                //             @empty
                //                 'No DATA',
                //             @endforelse
                //         ],
                //         datasets: [
                //             {
                //                 label: '{{__('cp.orders_count')}}',
                //                 data: [
                //                     @forelse(@$orders_static as $items)
                //                         {{$items->usercount}},
                //                     @empty
                //                         0,
                //                     @endforelse
                //                 ],

                //                 backgroundColor: [
                //                     'rgba(200, 159, 64, 0.2)',
                //                     'rgba(153, 102, 255, 0.2)',
                //                     'rgba(75, 192, 192, 0.2)',
                //                     'rgba(255, 206, 86, 0.2)',
                //                     'rgba(54, 162, 235, 0.2)',
                //                     'rgba(255, 99, 132, 0.2)',
                //                     'rgba(255, 159, 64, 0.2)',
                //                     'rgba(153, 102, 255, 0.2)',
                //                     'rgba(75, 192, 192, 0.2)',
                //                     'rgba(255, 206, 86, 0.2)',
                //                     'rgba(54, 162, 235, 0.2)',
                //                     'rgba(255, 99, 132, 0.2)'

                //                 ],
                //                 borderColor: [
                //                     'rgba(255, 159, 64, 1)',
                //                     'rgba(153, 102, 255, 1)',
                //                     'rgba(75, 192, 192, 1)',
                //                     'rgba(255, 206, 86, 1)',
                //                     'rgba(54, 162, 235, 1)',
                //                     'rgba(255, 99, 132, 1)',
                //                     'rgba(255, 159, 64, 1)',
                //                     'rgba(153, 102, 255, 1)',
                //                     'rgba(75, 192, 192, 1)',
                //                     'rgba(255, 206, 86, 1)',
                //                     'rgba(54, 162, 235, 1)',
                //                     'rgba(255, 99, 132, 1)'
                //                 ],
                //                 borderWidth: 2
                //             }
                //         ]
                //     },
                //     options: {
                //         scales: {
                //             yAxes: [{
                //                 ticks: {
                //                     beginAtZero: true
                //                 }
                //             }]
                //         }
                //     }
                // });


                // var ctx = document.getElementById('orders_static_total');
                // var myChart = new Chart(ctx, {
                //     //type:  horizontalBar  line   bar   radar   doughnut    polar    bubble    scatter
                //     type: 'bar',
                //     data: {
                //         labels: [
                //             @forelse(@$orders_static_total as $items)
                //                 '{{$items->months}}',
                //             @empty
                //                 'No DATA',
                //             @endforelse
                //         ],
                //         datasets: [
                //             {
                //                 label: '{{__('cp.orders_total')}}',
                //                 data: [
                //                     @forelse(@$orders_static_total as $items)
                //                         {{$items->full_total_price}},
                //                     @empty
                //                         0,
                //                     @endforelse
                //                 ],

                //                 backgroundColor: [
                //                     'rgba(255, 159, 64, 0.2)',
                //                     'rgba(153, 102, 255, 0.2)',
                //                     'rgba(75, 192, 192, 0.2)',
                //                     'rgba(255, 206, 86, 0.2)',
                //                     'rgba(54, 162, 235, 0.2)',
                //                     'rgba(255, 99, 132, 0.2)',
                //                     'rgba(255, 159, 64, 0.2)',
                //                     'rgba(153, 102, 255, 0.2)',
                //                     'rgba(75, 192, 192, 0.2)',
                //                     'rgba(255, 206, 86, 0.2)',
                //                     'rgba(54, 162, 235, 0.2)',
                //                     'rgba(255, 99, 132, 0.2)'

                //                 ],
                //                 borderColor: [
                //                     'rgba(255, 159, 64, 1)',
                //                     'rgba(153, 102, 255, 1)',
                //                     'rgba(75, 192, 192, 1)',
                //                     'rgba(255, 206, 86, 1)',
                //                     'rgba(54, 162, 235, 1)',
                //                     'rgba(255, 99, 132, 1)',
                //                     'rgba(255, 159, 64, 1)',
                //                     'rgba(153, 102, 255, 1)',
                //                     'rgba(75, 192, 192, 1)',
                //                     'rgba(255, 206, 86, 1)',
                //                     'rgba(54, 162, 235, 1)',
                //                     'rgba(255, 99, 132, 1)'
                //                 ],
                //                 borderWidth: 2
                //             }
                //         ]
                //     },
                //     options: {
                //         scales: {
                //             yAxes: [{
                //                 ticks: {
                //                     beginAtZero: true
                //                 }
                //             }]
                //         }
                //     }
                // });

                // var ctx = document.getElementById('myChart2');
                // var mixedChart = new Chart(ctx, {
                //     type: 'bar',
                //     data: {
                //         datasets: [{
                //             label: '{{__('cp.users')}}',
                //             data: [ @forelse(@$users_static as $items)
                //                 {{$items->usercount}},
                //                 @empty
                //                     0,
                //                 @endforelse],

                //             backgroundColor: [
                //                 'rgba(255, 159, 64, 0.2)',
                //                 'rgba(153, 102, 255, 0.2)',
                //                 'rgba(75, 192, 192, 0.2)',
                //                 'rgba(255, 206, 86, 0.2)',
                //                 'rgba(54, 162, 235, 0.2)',
                //                 'rgba(255, 99, 132, 0.2)',
                //                 'rgba(255, 99, 132, 0.2)',
                //                 'rgba(54, 162, 235, 0.2)',
                //                 'rgba(255, 206, 86, 0.2)',
                //                 'rgba(75, 192, 192, 0.2)',
                //                 'rgba(153, 102, 255, 0.2)',
                //                 'rgba(255, 159, 64, 0.2)'

                //             ],
                //             borderColor: [
                //                 'rgba(255, 159, 64, 1)',
                //                 'rgba(153, 102, 255, 1)',
                //                 'rgba(75, 192, 192, 1)',
                //                 'rgba(255, 206, 86, 1)',
                //                 'rgba(54, 162, 235, 1)',
                //                 'rgba(255, 99, 132, 1)',
                //                 'rgba(255, 99, 132, 1)',
                //                 'rgba(54, 162, 235, 1)',
                //                 'rgba(255, 206, 86, 1)',
                //                 'rgba(75, 192, 192, 1)',
                //                 'rgba(153, 102, 255, 1)',
                //                 'rgba(255, 159, 64, 1)'

                //             ],
                //             borderWidth: 2
                //         }],
                //         labels: [ @forelse(@$users_static as $order)
                //             '{{$order->months}}',
                //             @empty
                //                 'No DATA',
                //             @endforelse]
                //     },
                //     options: {
                //         scales: {
                //             yAxes: [{
                //                 ticks: {
                //                     beginAtZero: true
                //                 }
                //             }]
                //         }
                //     }
                // });
            </script>

            <script>


                "use strict";

// Shared Colors Definition
const primary = '#6993FF';
const success = '#1BC5BD';
const info = '#8950FC';
const warning = '#FFA800';
const danger = '#F64E60';

// Class definition
function generateBubbleData(baseval, count, yrange) {
    var i = 0;
    var series = [];
    while (i < count) {
      var x = Math.floor(Math.random() * (750 - 1 + 1)) + 1;;
      var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;
      var z = Math.floor(Math.random() * (75 - 15 + 1)) + 15;

      series.push([x, y, z]);
      baseval += 86400000;
      i++;
    }
    return series;
  }

function generateData(count, yrange) {
    var i = 0;
    var series = [];
    while (i < count) {
        var x = 'w' + (i + 1).toString();
        var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;

        series.push({
            x: x,
            y: y
        });
        i++;
    }
    return series;
}

var KTApexChartsDemo = function () {
	// Private functions
	var _demo1 = function () {
		const apexChart = "#chart_1";
		var options = {
			series: [{
				name: "@lang('cp.orders_count')",
				data: [@forelse(@$orders_static as $items)
                                        {{$items->usercount}},
                                    @empty
                                        0,
                                    @endforelse]
			}],
			chart: {
				height: 330,
				type: 'area',
				zoom: {
					enabled: true
				}
			},
			dataLabels: {
				enabled: true
			},
			stroke: {
				curve: 'smooth'
			},
			grid: {
				row: {
					colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
					opacity: 0.5
				},
			},
			xaxis: {
				categories: [@forelse(@$orders_static as $items)'{{$items->months}}',  @empty  'No DATA',  @endforelse],

			},
			colors: [primary]
		};

		var chart = new ApexCharts(document.querySelector(apexChart), options);
		chart.render();
	}
	var _demo2 = function () {
		const apexChart = "#chart_2";
		var options = {
			series: [{
				name: "@lang('cp.orders_count')",
				data: [@forelse(@$orders_static_total as $items)
                                        {{$items->full_total_price}},
                                    @empty
                                        0,
                                    @endforelse]
			}],
			chart: {
				height: 330,
				type: 'area',
				zoom: {
					enabled: true
				}
			},
			dataLabels: {
				enabled: true
			},
			stroke: {
				curve: 'smooth'
			},
			grid: {
				row: {
					colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
					opacity: 0.5
				},
			},
			xaxis: {
				categories: [@forelse(@$orders_static_total as $items)
                                '{{$items->months}}',
                            @empty
                                'No DATA',
                            @endforelse],

			},
			colors: ['#f64e60']
		};

		var chart = new ApexCharts(document.querySelector(apexChart), options);
		chart.render();
	}
	var _demo3 = function () {
		const apexChart = "#chart_3";
		var options = {
			series: [{
				name: "@lang('cp.orders_count')",
				data: [@forelse(@$users_static as $items)
                                {{$items->usercount}},
                                @empty
                                    0,
                                @endforelse]
			}],
			chart: {
				height: 330,
				type: 'area',
				zoom: {
					enabled: true
				}
			},
			dataLabels: {
				enabled: true
			},
			stroke: {
				curve: 'smooth'
			},
			grid: {
				row: {
					colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
					opacity: 0.5
				},
			},
			xaxis: {
				categories: [@forelse(@$users_static as $order)
                            '{{$order->months}}',
                            @empty
                                'No DATA',
                            @endforelse],

			},
			colors: ['#1bc5bd']
		};

		var chart = new ApexCharts(document.querySelector(apexChart), options);
		chart.render();
	}

// 	var _demo2 = function () {
// 		const apexChart = "#chart_2";
// 		var options = {
// 			series: [{
// 				name: 'series1',
// 				data: [31, 40, 28, 51, 42, 109, 100]
// 			}, {
// 				name: 'series2',
// 				data: [11, 32, 45, 32, 34, 52, 41]
// 			}],
// 			chart: {
// 				height: 350,
// 				type: 'area'
// 			},
// 			dataLabels: {
// 				enabled: false
// 			},
// 			stroke: {
// 				curve: 'smooth'
// 			},
// 			xaxis: {
// 				type: 'datetime',
// 				categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
// 			},
// 			tooltip: {
// 				x: {
// 					format: 'dd/MM/yy HH:mm'
// 				},
// 			},
// 			colors: [primary, success]
// 		};

// 		var chart = new ApexCharts(document.querySelector(apexChart), options);
// 		chart.render();
// 	}

// 	var _demo3 = function () {
// 		const apexChart = "#chart_3";
// 		var options = {
// 			series: [{
// 				name: 'Net Profit',
// 				data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
// 			}, {
// 				name: 'Revenue',
// 				data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
// 			}, {
// 				name: 'Free Cash Flow',
// 				data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
// 			}],
// 			chart: {
// 				type: 'bar',
// 				height: 350
// 			},
// 			plotOptions: {
// 				bar: {
// 					horizontal: false,
// 					columnWidth: '55%',
// 					endingShape: 'rounded'
// 				},
// 			},
// 			dataLabels: {
// 				enabled: false
// 			},
// 			stroke: {
// 				show: true,
// 				width: 2,
// 				colors: ['transparent']
// 			},
// 			xaxis: {
// 				categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
// 			},
// 			yaxis: {
// 				title: {
// 					text: '$ (thousands)'
// 				}
// 			},
// 			fill: {
// 				opacity: 1
// 			},
// 			tooltip: {
// 				y: {
// 					formatter: function (val) {
// 						return "$ " + val + " thousands"
// 					}
// 				}
// 			},
// 			colors: [primary, success, warning]
// 		};

// 		var chart = new ApexCharts(document.querySelector(apexChart), options);
// 		chart.render();
// 	}

	var _demo4 = function () {
		const apexChart = "#chart_4";
		var options = {
			series: [{
				name: 'Marine Sprite',
				data: [44, 55, 41, 37, 22, 43, 21]
			}, {
				name: 'Striking Calf',
				data: [53, 32, 33, 52, 13, 43, 32]
			}, {
				name: 'Tank Picture',
				data: [12, 17, 11, 9, 15, 11, 20]
			}, {
				name: 'Bucket Slope',
				data: [9, 7, 5, 8, 6, 9, 4]
			}, {
				name: 'Reborn Kid',
				data: [25, 12, 19, 32, 25, 24, 10]
			}],
			chart: {
				type: 'bar',
				height: 350,
				stacked: true,
			},
			plotOptions: {
				bar: {
					horizontal: true,
				},
			},
			stroke: {
				width: 1,
				colors: ['#fff']
			},
			title: {
				text: 'Fiction Books Sales'
			},
			xaxis: {
				categories: [2008, 2009, 2010, 2011, 2012, 2013, 2014],
				labels: {
					formatter: function (val) {
						return val + "K"
					}
				}
			},
			yaxis: {
				title: {
					text: undefined
				},
			},
			tooltip: {
				y: {
					formatter: function (val) {
						return val + "K"
					}
				}
			},
			fill: {
				opacity: 1
			},
			legend: {
				position: 'top',
				horizontalAlign: 'left',
				offsetX: 40
			},
			colors: [primary, success, warning, danger, info]
		};

		var chart = new ApexCharts(document.querySelector(apexChart), options);
		chart.render();
	}

	var _demo5 = function () {
		const apexChart = "#chart_5";
		var options = {
			series: [{
				name: 'Income',
				type: 'column',
				data: [1.4, 2, 2.5, 1.5, 2.5, 2.8, 3.8, 4.6]
			}, {
				name: 'Cashflow',
				type: 'column',
				data: [1.1, 3, 3.1, 4, 4.1, 4.9, 6.5, 8.5]
			}, {
				name: 'Revenue',
				type: 'line',
				data: [20, 29, 37, 36, 44, 45, 50, 58]
			}],
			chart: {
				height: 350,
				type: 'line',
				stacked: false
			},
			dataLabels: {
				enabled: false
			},
			stroke: {
				width: [1, 1, 4]
			},
			title: {
				text: 'XYZ - Stock Analysis (2009 - 2016)',
				align: 'left',
				offsetX: 110
			},
			xaxis: {
				categories: [2009, 2010, 2011, 2012, 2013, 2014, 2015, 2016],
			},
			yaxis: [
				{
					axisTicks: {
						show: true,
					},
					axisBorder: {
						show: true,
						color: primary
					},
					labels: {
						style: {
							colors: primary,
						}
					},
					title: {
						text: "Income (thousand crores)",
						style: {
							color: primary,
						}
					},
					tooltip: {
						enabled: true
					}
				},
				{
					seriesName: 'Income',
					opposite: true,
					axisTicks: {
						show: true,
					},
					axisBorder: {
						show: true,
						color: success
					},
					labels: {
						style: {
							colors: success,
						}
					},
					title: {
						text: "Operating Cashflow (thousand crores)",
						style: {
							color: success,
						}
					},
				},
				{
					seriesName: 'Revenue',
					opposite: true,
					axisTicks: {
						show: true,
					},
					axisBorder: {
						show: true,
						color: warning
					},
					labels: {
						style: {
							colors: warning,
						},
					},
					title: {
						text: "Revenue (thousand crores)",
						style: {
							color: warning,
						}
					}
				},
			],
			tooltip: {
				fixed: {
					enabled: true,
					position: 'topLeft', // topRight, topLeft, bottomRight, bottomLeft
					offsetY: 30,
					offsetX: 60
				},
			},
			legend: {
				horizontalAlign: 'left',
				offsetX: 40
			}
		};

		var chart = new ApexCharts(document.querySelector(apexChart), options);
		chart.render();
	}

	var _demo6 = function () {
		const apexChart = "#chart_6";
		var options = {
			series: [
				{
					data: [
						{
							x: 'Analysis',
							y: [
								new Date('2019-02-27').getTime(),
								new Date('2019-03-04').getTime()
							],
							fillColor: primary
						},
						{
							x: 'Design',
							y: [
								new Date('2019-03-04').getTime(),
								new Date('2019-03-08').getTime()
							],
							fillColor: success
						},
						{
							x: 'Coding',
							y: [
								new Date('2019-03-07').getTime(),
								new Date('2019-03-10').getTime()
							],
							fillColor: info
						},
						{
							x: 'Testing',
							y: [
								new Date('2019-03-08').getTime(),
								new Date('2019-03-12').getTime()
							],
							fillColor: warning
						},
						{
							x: 'Deployment',
							y: [
								new Date('2019-03-12').getTime(),
								new Date('2019-03-17').getTime()
							],
							fillColor: danger
						}
					]
				}
			],
			chart: {
				height: 350,
				type: 'rangeBar'
			},
			plotOptions: {
				bar: {
					horizontal: true,
					distributed: true,
					dataLabels: {
						hideOverflowingLabels: false
					}
				}
			},
			dataLabels: {
				enabled: true,
				formatter: function (val, opts) {
					var label = opts.w.globals.labels[opts.dataPointIndex]
					var a = moment(val[0])
					var b = moment(val[1])
					var diff = b.diff(a, 'days')
					return label + ': ' + diff + (diff > 1 ? ' days' : ' day')
				},
				style: {
					colors: ['#f3f4f5', '#fff']
				}
			},
			xaxis: {
				type: 'datetime'
			},
			yaxis: {
				show: false
			},
			grid: {
				row: {
					colors: ['#f3f4f5', '#fff'],
					opacity: 1
				}
			}
		};

		var chart = new ApexCharts(document.querySelector(apexChart), options);
		chart.render();
	}

	var _demo7 = function () {
		const apexChart = "#chart_7";
		var options = {
			series: [{
				data: [{
					x: new Date(1538778600000),
					y: [6629.81, 6650.5, 6623.04, 6633.33]
				},
				{
					x: new Date(1538780400000),
					y: [6632.01, 6643.59, 6620, 6630.11]
				},
				{
					x: new Date(1538782200000),
					y: [6630.71, 6648.95, 6623.34, 6635.65]
				},
				{
					x: new Date(1538784000000),
					y: [6635.65, 6651, 6629.67, 6638.24]
				},
				{
					x: new Date(1538785800000),
					y: [6638.24, 6640, 6620, 6624.47]
				},
				{
					x: new Date(1538787600000),
					y: [6624.53, 6636.03, 6621.68, 6624.31]
				},
				{
					x: new Date(1538789400000),
					y: [6624.61, 6632.2, 6617, 6626.02]
				},
				{
					x: new Date(1538791200000),
					y: [6627, 6627.62, 6584.22, 6603.02]
				},
				{
					x: new Date(1538793000000),
					y: [6605, 6608.03, 6598.95, 6604.01]
				},
				{
					x: new Date(1538794800000),
					y: [6604.5, 6614.4, 6602.26, 6608.02]
				},
				{
					x: new Date(1538796600000),
					y: [6608.02, 6610.68, 6601.99, 6608.91]
				},
				{
					x: new Date(1538798400000),
					y: [6608.91, 6618.99, 6608.01, 6612]
				},
				{
					x: new Date(1538800200000),
					y: [6612, 6615.13, 6605.09, 6612]
				},
				{
					x: new Date(1538802000000),
					y: [6612, 6624.12, 6608.43, 6622.95]
				},
				{
					x: new Date(1538803800000),
					y: [6623.91, 6623.91, 6615, 6615.67]
				},
				{
					x: new Date(1538805600000),
					y: [6618.69, 6618.74, 6610, 6610.4]
				},
				{
					x: new Date(1538807400000),
					y: [6611, 6622.78, 6610.4, 6614.9]
				},
				{
					x: new Date(1538809200000),
					y: [6614.9, 6626.2, 6613.33, 6623.45]
				},
				{
					x: new Date(1538811000000),
					y: [6623.48, 6627, 6618.38, 6620.35]
				},
				{
					x: new Date(1538812800000),
					y: [6619.43, 6620.35, 6610.05, 6615.53]
				},
				{
					x: new Date(1538814600000),
					y: [6615.53, 6617.93, 6610, 6615.19]
				},
				{
					x: new Date(1538816400000),
					y: [6615.19, 6621.6, 6608.2, 6620]
				},
				{
					x: new Date(1538818200000),
					y: [6619.54, 6625.17, 6614.15, 6620]
				},
				{
					x: new Date(1538820000000),
					y: [6620.33, 6634.15, 6617.24, 6624.61]
				},
				{
					x: new Date(1538821800000),
					y: [6625.95, 6626, 6611.66, 6617.58]
				},
				{
					x: new Date(1538823600000),
					y: [6619, 6625.97, 6595.27, 6598.86]
				},
				{
					x: new Date(1538825400000),
					y: [6598.86, 6598.88, 6570, 6587.16]
				},
				{
					x: new Date(1538827200000),
					y: [6588.86, 6600, 6580, 6593.4]
				},
				{
					x: new Date(1538829000000),
					y: [6593.99, 6598.89, 6585, 6587.81]
				},
				{
					x: new Date(1538830800000),
					y: [6587.81, 6592.73, 6567.14, 6578]
				},
				{
					x: new Date(1538832600000),
					y: [6578.35, 6581.72, 6567.39, 6579]
				},
				{
					x: new Date(1538834400000),
					y: [6579.38, 6580.92, 6566.77, 6575.96]
				},
				{
					x: new Date(1538836200000),
					y: [6575.96, 6589, 6571.77, 6588.92]
				},
				{
					x: new Date(1538838000000),
					y: [6588.92, 6594, 6577.55, 6589.22]
				},
				{
					x: new Date(1538839800000),
					y: [6589.3, 6598.89, 6589.1, 6596.08]
				},
				{
					x: new Date(1538841600000),
					y: [6597.5, 6600, 6588.39, 6596.25]
				},
				{
					x: new Date(1538843400000),
					y: [6598.03, 6600, 6588.73, 6595.97]
				},
				{
					x: new Date(1538845200000),
					y: [6595.97, 6602.01, 6588.17, 6602]
				},
				{
					x: new Date(1538847000000),
					y: [6602, 6607, 6596.51, 6599.95]
				},
				{
					x: new Date(1538848800000),
					y: [6600.63, 6601.21, 6590.39, 6591.02]
				},
				{
					x: new Date(1538850600000),
					y: [6591.02, 6603.08, 6591, 6591]
				},
				{
					x: new Date(1538852400000),
					y: [6591, 6601.32, 6585, 6592]
				},
				{
					x: new Date(1538854200000),
					y: [6593.13, 6596.01, 6590, 6593.34]
				},
				{
					x: new Date(1538856000000),
					y: [6593.34, 6604.76, 6582.63, 6593.86]
				},
				{
					x: new Date(1538857800000),
					y: [6593.86, 6604.28, 6586.57, 6600.01]
				},
				{
					x: new Date(1538859600000),
					y: [6601.81, 6603.21, 6592.78, 6596.25]
				},
				{
					x: new Date(1538861400000),
					y: [6596.25, 6604.2, 6590, 6602.99]
				},
				{
					x: new Date(1538863200000),
					y: [6602.99, 6606, 6584.99, 6587.81]
				},
				{
					x: new Date(1538865000000),
					y: [6587.81, 6595, 6583.27, 6591.96]
				},
				{
					x: new Date(1538866800000),
					y: [6591.97, 6596.07, 6585, 6588.39]
				},
				{
					x: new Date(1538868600000),
					y: [6587.6, 6598.21, 6587.6, 6594.27]
				},
				{
					x: new Date(1538870400000),
					y: [6596.44, 6601, 6590, 6596.55]
				},
				{
					x: new Date(1538872200000),
					y: [6598.91, 6605, 6596.61, 6600.02]
				},
				{
					x: new Date(1538874000000),
					y: [6600.55, 6605, 6589.14, 6593.01]
				},
				{
					x: new Date(1538875800000),
					y: [6593.15, 6605, 6592, 6603.06]
				},
				{
					x: new Date(1538877600000),
					y: [6603.07, 6604.5, 6599.09, 6603.89]
				},
				{
					x: new Date(1538879400000),
					y: [6604.44, 6604.44, 6600, 6603.5]
				},
				{
					x: new Date(1538881200000),
					y: [6603.5, 6603.99, 6597.5, 6603.86]
				},
				{
					x: new Date(1538883000000),
					y: [6603.85, 6605, 6600, 6604.07]
				},
				{
					x: new Date(1538884800000),
					y: [6604.98, 6606, 6604.07, 6606]
				},
				]
			}],
			chart: {
				type: 'candlestick',
				height: 350
			},
			xaxis: {
				type: 'datetime'
			},
			yaxis: {
				tooltip: {
					enabled: true
				}
			},
			colors: [success,danger]
		};

		var chart = new ApexCharts(document.querySelector(apexChart), options);
		chart.render();
	}

	var _demo8 = function () {
		const apexChart = "#chart_8";
		var options = {
			series: [{
				name: 'Bubble1',
				data: generateBubbleData(new Date('11 Feb 2017 GMT').getTime(), 20, {
				  min: 10,
				  max: 60
				})
			  },
			  {
				name: 'Bubble2',
				data: generateBubbleData(new Date('11 Feb 2017 GMT').getTime(), 20, {
				  min: 10,
				  max: 60
				})
			  },
			  {
				name: 'Bubble3',
				data: generateBubbleData(new Date('11 Feb 2017 GMT').getTime(), 20, {
				  min: 10,
				  max: 60
				})
			  },
			  {
				name: 'Bubble4',
				data: generateBubbleData(new Date('11 Feb 2017 GMT').getTime(), 20, {
				  min: 10,
				  max: 60
				})
			  }],
			chart: {
				height: 350,
				type: 'bubble',
			},
			dataLabels: {
				enabled: false
			},
			fill: {
				opacity: 0.8
			},
			xaxis: {
				tickAmount: 12,
				type: 'category',
			},
			yaxis: {
				max: 70
			},
			colors: [primary, success, warning, danger]
		};

		var chart = new ApexCharts(document.querySelector(apexChart), options);
		chart.render();
	}

	var _demo9 = function () {
		const apexChart = "#chart_9";
		var options = {
			series: [{
				name: "SAMPLE A",
				data: [
					[16.4, 5.4], [21.7, 2], [25.4, 3], [19, 2], [10.9, 1], [13.6, 3.2], [10.9, 7.4], [10.9, 0], [10.9, 8.2], [16.4, 0], [16.4, 1.8], [13.6, 0.3], [13.6, 0], [29.9, 0], [27.1, 2.3], [16.4, 0], [13.6, 3.7], [10.9, 5.2], [16.4, 6.5], [10.9, 0], [24.5, 7.1], [10.9, 0], [8.1, 4.7], [19, 0], [21.7, 1.8], [27.1, 0], [24.5, 0], [27.1, 0], [29.9, 1.5], [27.1, 0.8], [22.1, 2]]
			}, {
				name: "SAMPLE B",
				data: [
					[36.4, 13.4], [1.7, 11], [5.4, 8], [9, 17], [1.9, 4], [3.6, 12.2], [1.9, 14.4], [1.9, 9], [1.9, 13.2], [1.4, 7], [6.4, 8.8], [3.6, 4.3], [1.6, 10], [9.9, 2], [7.1, 15], [1.4, 0], [3.6, 13.7], [1.9, 15.2], [6.4, 16.5], [0.9, 10], [4.5, 17.1], [10.9, 10], [0.1, 14.7], [9, 10], [12.7, 11.8], [2.1, 10], [2.5, 10], [27.1, 10], [2.9, 11.5], [7.1, 10.8], [2.1, 12]]
			}, {
				name: "SAMPLE C",
				data: [
					[21.7, 3], [23.6, 3.5], [24.6, 3], [29.9, 3], [21.7, 20], [23, 2], [10.9, 3], [28, 4], [27.1, 0.3], [16.4, 4], [13.6, 0], [19, 5], [22.4, 3], [24.5, 3], [32.6, 3], [27.1, 4], [29.6, 6], [31.6, 8], [21.6, 5], [20.9, 4], [22.4, 0], [32.6, 10.3], [29.7, 20.8], [24.5, 0.8], [21.4, 0], [21.7, 6.9], [28.6, 7.7], [15.4, 0], [18.1, 0], [33.4, 0], [16.4, 0]]
			}],
			chart: {
				height: 350,
				type: 'scatter',
				zoom: {
					enabled: true,
					type: 'xy'
				}
			},
			xaxis: {
				tickAmount: 10,
				labels: {
					formatter: function (val) {
						return parseFloat(val).toFixed(1)
					}
				}
			},
			yaxis: {
				tickAmount: 7
			},
			colors: [primary, success, warning]
		};

		var chart = new ApexCharts(document.querySelector(apexChart), options);
		chart.render();
	}

	var _demo10 = function () {
		const apexChart = "#chart_10";
		var options = {
			series: [{
				name: 'Jan',
				data: generateData(20, {
					min: -30,
					max: 55
				})
			},
			{
				name: 'Feb',
				data: generateData(20, {
					min: -30,
					max: 55
				})
			},
			{
				name: 'Mar',
				data: generateData(20, {
					min: -30,
					max: 55
				})
			},
			{
				name: 'Apr',
				data: generateData(20, {
					min: -30,
					max: 55
				})
			},
			{
				name: 'May',
				data: generateData(20, {
					min: -30,
					max: 55
				})
			},
			{
				name: 'Jun',
				data: generateData(20, {
					min: -30,
					max: 55
				})
			},
			{
				name: 'Jul',
				data: generateData(20, {
					min: -30,
					max: 55
				})
			},
			{
				name: 'Aug',
				data: generateData(20, {
					min: -30,
					max: 55
				})
			},
			{
				name: 'Sep',
				data: generateData(20, {
					min: -30,
					max: 55
				})
			}
			],
			chart: {
				height: 350,
				type: 'heatmap',
			},
			plotOptions: {
				heatmap: {
					shadeIntensity: 0.5,

					colorScale: {
						ranges: [{
							from: -30,
							to: 5,
							name: 'low',
							color: success
						},
						{
							from: 6,
							to: 20,
							name: 'medium',
							color: primary
						},
						{
							from: 21,
							to: 45,
							name: 'high',
							color: warning
						},
						{
							from: 46,
							to: 55,
							name: 'extreme',
							color: danger
						}
						]
					}
				}
			},
			dataLabels: {
				enabled: false
			},
		};

		var chart = new ApexCharts(document.querySelector(apexChart), options);
		chart.render();
	}

	var _demo11 = function () {
		const apexChart = "#chart_11";
		var options = {
			series: [44, 55, 41, 17, 15],
			chart: {
				width: 380,
				type: 'donut',
			},
			responsive: [{
				breakpoint: 480,
				options: {
					chart: {
						width: 200
					},
					legend: {
						position: 'bottom'
					}
				}
			}],
			colors: [primary, success, warning, danger, info]
		};

		var chart = new ApexCharts(document.querySelector(apexChart), options);
		chart.render();
	}

	var _demo12 = function () {
		const apexChart = "#chart_12";
		var options = {
			series: [44, 55, 13, 43, 22],
			chart: {
				width: 380,
				type: 'pie',
			},
			labels: ['Team A', 'Team B', 'Team C', 'Team D', 'Team E'],
			responsive: [{
				breakpoint: 480,
				options: {
					chart: {
						width: 200
					},
					legend: {
						position: 'bottom'
					}
				}
			}],
			colors: [primary, success, warning, danger, info]
		};

		var chart = new ApexCharts(document.querySelector(apexChart), options);
		chart.render();
	}

	var _demo13 = function () {
		const apexChart = "#chart_13";
		var options = {
			series: [44, 55, 67, 83],
			chart: {
				height: 350,
				type: 'radialBar',
			},
			plotOptions: {
				radialBar: {
					dataLabels: {
						name: {
							fontSize: '22px',
						},
						value: {
							fontSize: '16px',
						},
						total: {
							show: true,
							label: 'Total',
							formatter: function (w) {
								// By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
								return 249
							}
						}
					}
				}
			},
			labels: ['Apples', 'Oranges', 'Bananas', 'Berries'],
			colors: [primary, success, warning, danger]
		};

		var chart = new ApexCharts(document.querySelector(apexChart), options);
		chart.render();
	}

	var _demo14 = function () {
		const apexChart = "#chart_14";
		var options = {
			series: [{
				name: 'Series 1',
				data: [80, 50, 30, 40, 100, 20],
			}, {
				name: 'Series 2',
				data: [20, 30, 40, 80, 20, 80],
			}, {
				name: 'Series 3',
				data: [44, 76, 78, 13, 43, 10],
			}],
			chart: {
				height: 350,
				type: 'radar',
				dropShadow: {
					enabled: true,
					blur: 1,
					left: 1,
					top: 1
				}
			},
			stroke: {
				width: 0
			},
			fill: {
				opacity: 0.4
			},
			markers: {
				size: 0
			},
			xaxis: {
				categories: ['2011', '2012', '2013', '2014', '2015', '2016']
			},
			colors: [primary, success, warning]
		};

		var chart = new ApexCharts(document.querySelector(apexChart), options);
		chart.render();
	}

	return {
		// public functions
		init: function () {
			_demo1();
			_demo2();
			_demo3();
			_demo4();
			_demo5();
			_demo6();
			_demo7();
			_demo8();
			_demo9();
			_demo10();
			_demo11();
			_demo12();
			_demo13();
			_demo14();
		}
	};
}();

jQuery(document).ready(function () {
	KTApexChartsDemo.init();
});

                </script>
@endsection

@section('script')

@endsection
