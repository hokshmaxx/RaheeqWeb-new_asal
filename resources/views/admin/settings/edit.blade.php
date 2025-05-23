@extends('layout.adminLayout')
@section('title') {{ucwords(__('cp.settings'))}}
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
                        <a  href="{{url(getLocal().'/admin/settings')}}" class="btn btn-secondary  mr-2">{{__('cp.cancel')}}</a>
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
                            <form class="form" method="post" action="{{url(app()->getLocale().'/admin/settings/')}}" 
                                id="form" role="form" enctype="multipart/form-data" >
                                {{ csrf_field() }}
                            
                                <div class="card-header">
                                    <h3 class="card-title">{{__('cp.main_info')}}</h3>
                                </div>
                                <div class="card-body">    
                                    <div class="row">
                                        @foreach($locales as $locale)
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{__('cp.title_'.$locale->lang)}}</label>
                                                    <input type="text" class="form-control form-control-solid" 
                                                    name="title_{{$locale->lang}}" value="{{old('title_'.$locale->lang,@$item->translate($locale->lang)->title)}}" required />
                                                </div>
                                            </div>
                                        @endforeach
                                        {{-- @foreach($locales as $locale)
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{__('cp.address_'.$locale->lang)}}</label>
                                                    <input type="text" class="form-control form-control-solid" 
                                                    name="address_{{$locale->lang}}" value="{{old('address_'.$locale->lang,@$item->translate($locale->lang)->address)}}" required />
                                                </div>
                                            </div>
                                        @endforeach --}}
                                        
                                    </div>
                                </div>
                      
                        <div class="tab-content mt-5" >
                                <div class="tab-pane fade show active" id="myTabContent2" role="tabpanel"
                                    aria-labelledby="content-tab-main2">
                                    <div class="card-header">
                                        <h3 class="card-title">{{__('cp.contact_info')}}</h3>
                                        </div>
                                    <div class="card-body">
                                   
                                    <div class="row">
                                        
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{__('cp.info_email')}}</label>
                                                    <input type="text" class="form-control form-control-solid"
                                                        name="info_email" value="{{$item->info_email}}" required/>
                                                </div>
                                            </div>
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{__('cp.mobile')}}</label>
                                                    <input type="text" class="form-control form-control-solid"
                                                        name="mobile" value="{{$item->mobile}}" required/>
                                                </div>
                                            </div>
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{__('cp.facebook')}}</label>
                                                    <input type="text" class="form-control form-control-solid"
                                                        name="facebook" value="{{$item->facebook}}" required/>
                                                </div>
                                            </div>
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{__('cp.play_store_url')}}</label>
                                                    <input type="text" class="form-control form-control-solid"
                                                        name="play_store_url" value="{{$item->play_store_url}}" required/>
                                                </div>
                                            </div>
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{__('cp.app_store_url')}}</label>
                                                    <input type="text" class="form-control form-control-solid"
                                                        name="app_store_url" value="{{$item->app_store_url}}" required/>
                                                </div>
                                            </div>
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{__('cp.twitter')}}</label>
                                                    <input type="text" class="form-control form-control-solid"
                                                        name="twitter" value="{{$item->twitter}}" required/>
                                                </div>
                                            </div>
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{__('cp.instagram')}}</label>
                                                    <input type="text" class="form-control form-control-solid"
                                                        name="instagram" value="{{$item->instagram}}" required/>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{__('cp.paginate')}}</label>
                                                    <input type="text" class="form-control form-control-solid" name="paginate"
                                                           value="{{$item->paginate}}" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{__('cp.home_vedio_link')}}</label>
                                                    <input type="text" class="form-control form-control-solid" name="home_vedio_link"
                                                           value="{{$item->home_vedio_link}}" required/>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        <div class="tab-content mt-5" >
                                <div class="tab-pane fade show active" id="myTabContent2" role="tabpanel"
                                    aria-labelledby="content-tab-main2">
                                  
                                    <div class="card-body">
                                    
                                    <div class="row">
                                        
                                        <div class="col-md-6">
                                        
                                            <div class="fileinputForm">
                                                <label >{{__('cp.logo')}}</label>
                                                <div class="fileinput-new thumbnail"
                                                        onclick="document.getElementById('edit_image22').click()"
                                                        style="cursor:pointer">
                                                    <img src="{{$item->logo}}"  id="editImage22">
                                                </div>
                                                <div class="btn btn-change-img red"
                                                        onclick="document.getElementById('edit_image22').click()">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </div>
                                                <input type="file" class="form-control" name="logo"
                                                    id="edit_image22"
                                                    style="display:none">
                                            </div> 
                                        </div>

                                         <div class="col-md-6">
                                            
                                            <div class="fileinputForm">
                                                <label >{{__('cp.home_vedio_image')}}</label>
                                                <div class="fileinput-new thumbnail"
                                                    onclick="document.getElementById('edit_image11').click()"
                                                    style="cursor:pointer">
                                                    <img src="{{$item->home_vedio_image}}"  id="editImage11">
                                                </div>
                                                <div class="btn btn-change-img red"
                                                    onclick="document.getElementById('edit_image11').click()">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </div>
                                                <input type="file" class="form-control" name="home_vedio_image"
                                                id="edit_image11"
                                                style="display:none">
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                </div>
                            </div>
                        
                        <!--end::Card-->
                        <button type="submit" id="submitForm" style="display:none"></button>
                        </form>
                     
                <!--end::Container-->
            </div>
            <!--end::Entry-->
        </div>
        </div>
        </div>
				
					
@endsection
@section('js')

<script>

    $('#edit_image').on('change', function (e) {

readURL(this, $('#editImage'));

});

    $('#edit_logo').on('change', function (e) {
            readURL(this, $('#editLogo'));
        });
    $('#edit_image1').on('change', function (e) {
            readURL(this, $('#editImage1'));
        });
    $('#edit_image2').on('change', function (e) {
            readURL(this, $('#editImage2'));
        });
    $('#edit_image3').on('change', function (e) {
            readURL(this, $('#editImage3'));
        });
    $('#edit_image4').on('change', function (e) {
            readURL(this, $('#editImage4'));
        });
    $('#edit_image11').on('change', function (e) {
            readURL(this, $('#editImage11'));
        });
    $('#edit_image22').on('change', function (e) {
            readURL(this, $('#editImage22'));
        });

        $(document).on('click', '#submitButton', function(){
           // $('#submitButton').addClass('spinner spinner-white spinner-left');
        $('#submitForm').click();
    });
</script>
@endsection

@section('script')

@endsection