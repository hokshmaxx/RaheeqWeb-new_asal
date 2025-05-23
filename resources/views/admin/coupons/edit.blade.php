@extends('layout.adminLayout')
@section('title') {{ucwords(__('cp.coupons'))}}
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
                        <h3>{{__('cp.coupons')}}</h3>
                    </div>
                </div>
                <!--end::Info-->
                <!--begin::Toolbar-->
                <div class="d-flex align-items-center">
                    <a  href="{{url(getLocal().'/admin/coupons')}}" class="btn btn-secondary  mr-2">{{__('cp.cancel')}}</a>
                    <button id="submitButton" class="btn btn-success ">{{__('cp.save')}}</button>
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
                    <form class="form" method="post" action="{{url(app()->getLocale().'/admin/coupons/'.$item->id)}}" enctype="multipart/form-data" >
                        {{ csrf_field() }}
                        {{ method_field('PATCH')}}
                        <div class="card-header">
                            <h3 class="card-title">{{__('cp.main_data')}}</h3>
                        </div>

                        <div class="row col-sm-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__('cp.code')}}</label>
                                    <input type="text" class="form-control form-control-solid"
                                           name="code" value="{{old('code',$item->code) }}" required/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__('cp.discount_percent')}}</label>
                                    <input type="text" class="form-control form-control-solid" name="percent"
                                           value="{{old('percent',$item->percent) }}" required/>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__('cp.start_date')}}</label>
                                    <input
                                        type="date" class="form-control form-control-solid" name="start_date"
                                        value="{{old('start_date',$item->start_date->toDateString()) }}" required/>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__('cp.end_date')}}</label>
                                    <input
                                        type="date" class="form-control form-control-solid" name="end_date"
                                        value="{{old('end_date',$item->end_date->toDateString()) }}" required/>
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">{{__('cp.type')}}</label>
                                    <select id="coupan_cod" class="form-control" name="type">
                                        <option value="0">{{__('cp.single')}}</option>
                                        <option value="1">{{__('cp.multipleTime')}}</option>
                                        <!-- <option value="3">{{__('cp.not_active')}}</option> -->
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__('cp.numbertime')}}</label>
                                    <input type="number" class="form-control form-control-solid" name="coupantime" min="1" value="{{old('numbertime',$item->coupantime) }}" required/>
                                </div>
                            </div> --}}
                            
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
@section('script')
    <script>
        $('#edit_image').on('change', function (e) {
            readURL(this, $('#editImage'));
        });
        $(document).on('click', '#submitButton', function(){
            // $('#submitButton').addClass('spinner spinner-white spinner-left');
            $('#submitForm').click();
        });
    </script>
@endsection
