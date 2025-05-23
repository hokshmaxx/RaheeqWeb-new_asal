@extends('layout.adminLayout')
@section('title') {{ucwords(__('cp.customerComments'))}}
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
                            <h3>{{__('cp.edit')}}</h3>
                        </div>
                    </div>
                    <!--end::Info-->
                    <!--begin::Toolbar-->
                    <div class="d-flex align-items-center">
                        <a  href="{{url(getLocal().'/admin/customerComments')}}" class="btn btn-secondary  mr-2">{{__('cp.cancel')}}</a>
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
                        <form class="form" method="post" action="{{url(app()->getLocale().'/admin/customerComments/'.$item->id)}}" enctype="multipart/form-data" id="form" role="form">
                            {{ csrf_field() }}
                            {{ method_field('PATCH')}}
                            <div class="card-header">
                                <h3 class="card-title">@lang('cp.main_data')</h3>
                            </div>
                         
                                  <div class="card-body">
                                            <div class="row">
                                                @foreach($locales as $locale)
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="name_{{$locale->lang}}">{{__('cp.name_'.$locale->lang)}}</label>
                                                        <input type="text" class="form-control form-control-solid" id="name_{{$locale->lang}}" name="name_{{$locale->lang}}" value="{{ @$item->translate($locale->lang)->name}}" required />
                                                    </div>
                                                </div>   
                                                   @endforeach
                                                @foreach($locales as $locale)
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="customer_job_{{$locale->lang}}">{{__('cp.customer_job_'.$locale->lang)}}</label>
                                                        <input type="text" class="form-control form-control-solid" id="customer_job_{{$locale->lang}}" name="customer_job_{{$locale->lang}}" value="{{ @$item->translate($locale->lang)->customer_job}}" required />
                                                    </div>
                                                </div>  
                                                   @endforeach
                                                @foreach($locales as $locale)
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="comment_{{$locale->lang}}">{{__('cp.comment_'.$locale->lang)}}</label>
                                                        <input type="text" class="form-control form-control-solid" id="comment_{{$locale->lang}}" name="comment_{{$locale->lang}}" value="{{ @$item->translate($locale->lang)->comment}}" required />
                                                    </div>
                                                </div>    
                                                @endforeach
                                            </div>
                                 

                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="fileinputForm">
                                            <label>{{__('cp.image')}}</label>
                                            <div class="fileinput-new thumbnail"
                                                 onclick="document.getElementById('edit_image').click()"
                                                 style="cursor:pointer">
                                                <img src="{{$item->image}}" id="editImage">
                                            </div>
                                            <div class="btn btn-change-img red"
                                                 onclick="document.getElementById('edit_image').click()">
                                                <i class="fas fa-pencil-alt"></i>
                                            </div>
                                            <input type="file" class="form-control" name="image"
                                                   id="edit_image"
                                                   style="display:none">
                                        </div>
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
        $(document).on('click', '#submitButton', function(){
           // $('#submitButton').addClass('spinner spinner-white spinner-left');
        $('#submitForm').click();
    });
</script>
@endsection

@section('script')

@endsection