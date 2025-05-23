@extends('layout.adminLayout')
@section('title') {{ucwords(__('cp.contact'))}}
@endsection
@section('css')



@endsection
@section('content')


    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <!--begin::Subheader-->
            <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
                <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                    <!--begin::Info-->
                    <div class="d-flex align-items-center flex-wrap mr-1">
                        <div class="d-flex align-items-baseline mr-5">
                            <h3>{{__('cp.contact')}}</h3>
                        </div>
                    </div>
                    <!--end::Info-->
                    <!--begin::Toolbar-->
                    <div class="d-flex align-items-center">
                        <a href="{{url(getLocal().'/admin/contact')}}"
                           class="btn btn-secondary  mr-2">{{__('cp.cancel')}}</a>
                     </div>
                    <!--end::Toolbar-->
                </div>
            </div>
            <!--end::Subheader-->
            <div class="container">
                <!--begin::Inbox-->
                <div class="d-flex flex-row">

                    <!--begin::List-->

                    <!--begin::View-->
                    <div class="flex-row-fluid ml-lg-8 d-block" id="kt_inbox_view">
                        <!--begin::Card-->
                        <div class="card card-custom card-stretch">

                            <!--begin::Body-->
                            <div class="card-body p-0">
                                <!--begin::Header-->
                                <div
                                    class="d-flex align-items-center justify-content-between flex-wrap card-spacer-x py-5">
                                    <!--begin::Title-->
                                    <div class="d-flex align-items-center mr-2 py-2">
                                        {{--                                            <div class="font-weight-bold font-size-h3 mr-3">Trip Reminder. Thank you for flying with us!</div>--}}
                                        {{--                                            <span class="label label-light-primary font-weight-bold label-inline mr-2">inbox</span>--}}
                                        {{--                                            <span class="label label-light-danger font-weight-bold label-inline">important</span>--}}
                                    </div>
                                    <!--end::Title-->
                                    <!--begin::Toolbar-->
                                    <div class="d-flex py-2">
{{--														<span class="btn btn-default btn-sm btn-icon mr-2">--}}
{{--															<i class="flaticon2-sort"></i>--}}
{{--														</span>--}}
{{--                                        <span class="btn btn-default btn-sm btn-icon" data-dismiss="modal">--}}
{{--															<i class="flaticon2-fax"></i>--}}
{{--														</span>--}}
                                    </div>
                                    <!--end::Toolbar-->
                                </div>
                                <!--end::Header-->
                                <!--begin::Messages-->
                                <div class="mb-3">
                                    <div class="cursor-pointer shadow-xs toggle-on" data-inbox="message">
                                        <div class="d-flex align-items-center card-spacer-x py-6">
															<span class="symbol symbol-50 mr-4">
																<span class="symbol-label"
                                                                      style="background-image: url('{{asset('images/user.png')}}')"></span>
															</span>
                                            <div class="d-flex flex-column flex-grow-1 flex-wrap mr-2">
                                                <div class="d-flex">
                                                    <a href="#"
                                                       class="font-size-lg font-weight-bolder text-dark-75 text-hover-primary mr-2">{{$item->name}}</a>
                                                    <div class="font-weight-bold text-muted">
                                                        <span
                                                            class="label label-success label-dot mr-2"></span>{{$item->created_at->diffForHumans()}}
                                                    </div>
                                                    <br>

                                                </div>
                                                <div class="d-flex flex-column">
                                                        <span class="font-weight-bold text-muted cursor-pointer">  <b
                                                                class="text-muted min-w-75px py-2">@lang('cp.from') : </b>
                                                                        <a href="mailto:{{$item->email}}"> {{$item->email}}
																		</a></span>

                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div class="font-weight-bold text-muted mr-2">{{$item->created_at->format('M d, Y , g:i A')}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-spacer-x py-3 toggle-off-item">
                                            <p>

                                                {{$item->message}}
                                            </p>

                                        </div>
                                    </div>
                                </div>
                                <!--end::Messages-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::View-->
                </div>
                <!--end::Inbox-->

            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
@endsection
@section('js')

@endsection

@section('script')

@endsection
