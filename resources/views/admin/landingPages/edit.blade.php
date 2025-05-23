@extends('layout.adminLayout')
@section('title') {{ucwords(__('cp.landingPage'))}}
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
                        <a  href="{{url(getLocal().'/admin/landingPage')}}" class="btn btn-secondary  mr-2">{{__('cp.cancel')}}</a>
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
                            <form class="form" method="post" action="{{url(app()->getLocale().'/admin/landingPage/1')}}"
                                id="form" role="form" enctype="multipart/form-data" >
                                {{ csrf_field() }}
                                {{ method_field('PATCH')}}

                                <div class="card-header">
                                    <h3 class="card-title">{{__('cp.main_data')}}</h3>
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
                                    </div>
                                </div>

                                <div class="card-header">
                                    <h3 class="card-title">{{__('cp.home')}}</h3>
                                </div>
                                  <div class="card-body">
                                    <div class="row">
                                        @foreach($locales as $locale)
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{__('cp.home_title_'.$locale->lang)}}</label>
                                                    <input type="text" class="form-control form-control-solid"
                                                    name="home_title_{{$locale->lang}}" value="{{old('home_title_'.$locale->lang,@$item->translate($locale->lang)->home_title)}}" required />
                                                </div>
                                            </div>
                                        @endforeach
                                        @foreach($locales as $locale)
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{__('cp.home_details_'.$locale->lang)}}</label>
                                                    <input type="text" class="form-control form-control-solid"
                                                    name="home_details_{{$locale->lang}}" value="{{old('home_details_'.$locale->lang,@$item->translate($locale->lang)->home_details)}}" required />
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                 </div>

                                <div class="card-header">
                                    <h3 class="card-title">{{__('cp.about_us')}}</h3>
                                </div>
                                  <div class="card-body">
                                    <div class="row">
                                        @foreach($locales as $locale)
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{__('cp.about_us_title1_'.$locale->lang)}}</label>
                                                    <input type="text" class="form-control form-control-solid"
                                                    name="about_us_title1_{{$locale->lang}}" value="{{old('about_us_title1_'.$locale->lang,@$item->translate($locale->lang)->about_us_title1)}}" required />
                                                </div>
                                            </div>
                                        @endforeach
                                        @foreach($locales as $locale)
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{__('cp.about_us_title2_'.$locale->lang)}}</label>
                                                    <input type="text" class="form-control form-control-solid"
                                                    name="about_us_title2_{{$locale->lang}}" value="{{old('about_us_title2_'.$locale->lang,@$item->translate($locale->lang)->about_us_title2)}}" required />
                                                </div>
                                            </div>
                                        @endforeach

                                        @foreach($locales as $locale)
                                        <div class="col-md-6">
                                             <div class="form-group">
                                                 <label>{{__('cp.about_us_details_'.$locale->lang)}}</label>
                                                 <textarea id="about_us_details_{{$locale->lang}}" class="form-control form-control-solid"
                                                     {{($locale->lang == 'ar') ? 'dir=rtl' :'' }} name="about_us_details_{{$locale->lang}}"
                                                     id="order" rows="3" required>{{old('about_us_details_'.$locale->lang,@$item->translate($locale->lang)->about_us_details)}}</textarea>
                                             </div>
                                         </div>
                                     @endforeach

                                    </div>
                                </div>






                             <div class="tab-content mt-5" >
                                <div class="tab-pane fade show active" id="myTabContent2" role="tabpanel"
                                    aria-labelledby="content-tab-main2">
                                    <div class="card-header">
                                        <h3 class="card-title">{{__('cp.services')}}</h3>
                                        </div>
                                    <div class="card-body">
                                        <div class="row">

                                            @foreach($locales as $locale)
                                            <div class="col-md-6">
                                                 <div class="form-group">
                                                     <label>{{__('cp.service_title_'.$locale->lang)}}</label>
                                                     <input type="text" class="form-control form-control-solid"
                                                      name="service_title_{{$locale->lang}}" value="{{old('service_title_'.$locale->lang,@$item->translate($locale->lang)->service_title)}}" required />
                                                 </div>
                                             </div>
                                         @endforeach
                                         @foreach($locales as $locale)
                                            <div class="col-md-6">
                                                 <div class="form-group">
                                                     <label>{{__('cp.service_details_'.$locale->lang)}}</label>
                                                     <textarea id="service_details_{{$locale->lang}}" class="form-control form-control-solid"
                                                         {{($locale->lang == 'ar') ? 'dir=rtl' :'' }} name="service_details_{{$locale->lang}}"
                                                         id="order" rows="3" required>{{old('service_details_'.$locale->lang,@$item->translate($locale->lang)->service_details)}}</textarea>
                                                 </div>
                                             </div>
                                         @endforeach


                                            @foreach($locales as $locale)
                                               <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{__('cp.service1_text_'.$locale->lang)}}</label>
                                                        <input type="text" class="form-control form-control-solid"
                                                         name="service1_text_{{$locale->lang}}" value="{{old('service1_text_'.$locale->lang,@$item->translate($locale->lang)->service1_text)}}" required />
                                                    </div>
                                                </div>
                                            @endforeach
                                            @foreach($locales as $locale)
                                               <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{__('cp.service1_details_'.$locale->lang)}}</label>
                                                        <textarea id="service1_details_{{$locale->lang}}" class="form-control form-control-solid"
                                                            {{($locale->lang == 'ar') ? 'dir=rtl' :'' }} name="service1_details_{{$locale->lang}}"
                                                            id="order" rows="3" required>{{old('service1_details_'.$locale->lang,@$item->translate($locale->lang)->service1_details)}}</textarea>
                                                    </div>
                                                </div>
                                            @endforeach
                                            @foreach($locales as $locale)
                                               <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{__('cp.service2_text_'.$locale->lang)}}</label>
                                                        <input type="text" class="form-control form-control-solid"
                                                         name="service2_text_{{$locale->lang}}" value="{{old('service2_text_'.$locale->lang,@$item->translate($locale->lang)->service2_text)}}" required />
                                                    </div>
                                                </div>
                                            @endforeach
                                            @foreach($locales as $locale)
                                               <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{__('cp.service2_details_'.$locale->lang)}}</label>
                                                        <textarea id="service2_details_{{$locale->lang}}" class="form-control form-control-solid"
                                                            {{($locale->lang == 'ar') ? 'dir=rtl' :'' }} name="service2_details_{{$locale->lang}}"
                                                            id="order" rows="3" required>{{old('service2_details_'.$locale->lang,@$item->translate($locale->lang)->service2_details)}}</textarea>
                                                    </div>
                                                </div>
                                            @endforeach

                                            @foreach($locales as $locale)
                                               <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{__('cp.service3_text_'.$locale->lang)}}</label>
                                                        <input type="text" class="form-control form-control-solid"
                                                         name="service3_text_{{$locale->lang}}" value="{{old('service3_text_'.$locale->lang,@$item->translate($locale->lang)->service3_text)}}" required />
                                                    </div>
                                                </div>
                                            @endforeach
                                            @foreach($locales as $locale)
                                               <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{__('cp.service3_details_'.$locale->lang)}}</label>
                                                        <textarea id="service3_details_{{$locale->lang}}" class="form-control form-control-solid"
                                                            {{($locale->lang == 'ar') ? 'dir=rtl' :'' }} name="service3_details_{{$locale->lang}}"
                                                            id="order" rows="3" required>{{old('service3_details_'.$locale->lang,@$item->translate($locale->lang)->service3_details)}}</textarea>
                                                    </div>
                                                </div>
                                            @endforeach

                                            <div class="col-md-4">

                                                <div class="fileinputForm">
                                                    <label >{{__('cp.service1_image')}}</label>
                                                    <div class="fileinput-new thumbnail"
                                                            onclick="document.getElementById('edit_image1').click()"
                                                            style="cursor:pointer">
                                                        <img src="{{$item->service1_image}}"  id="editImage1">
                                                    </div>
                                                    <div class="btn btn-change-img red"
                                                            onclick="document.getElementById('edit_image1').click()">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </div>
                                                    <input type="file" class="form-control" name="service1_image"
                                                        id="edit_image1"
                                                        style="display:none">
                                                </div>
                                            </div>
                                            <div class="col-md-4">

                                                <div class="fileinputForm">
                                                    <label >{{__('cp.service2_image')}}</label>
                                                    <div class="fileinput-new thumbnail"
                                                            onclick="document.getElementById('edit_image2').click()"
                                                            style="cursor:pointer">
                                                        <img src="{{$item->service2_image}}"  id="editImage2">
                                                    </div>
                                                    <div class="btn btn-change-img red"
                                                            onclick="document.getElementById('edit_image2').click()">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </div>
                                                    <input type="file" class="form-control" name="service2_image"
                                                        id="edit_image2"
                                                        style="display:none">
                                                </div>
                                            </div>
                                            <div class="col-md-4">

                                                <div class="fileinputForm">
                                                    <label >{{__('cp.service3_image')}}</label>
                                                    <div class="fileinput-new thumbnail"
                                                            onclick="document.getElementById('edit_image3').click()"
                                                            style="cursor:pointer">
                                                        <img src="{{$item->service3_image}}"  id="editImage3">
                                                    </div>
                                                    <div class="btn btn-change-img red"
                                                            onclick="document.getElementById('edit_image23').click()">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </div>
                                                    <input type="file" class="form-control" name="service3_image"
                                                        id="edit_image3"
                                                        style="display:none">
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                </div>
                            </div>


                            <div class="tab-content mt-5" >
                                <div class="tab-pane fade show active" id="myTabContent2" role="tabpanel"
                                    aria-labelledby="content-tab-main2">
                                    <div class="card-header">
                                        <h3 class="card-title">{{__('cp.features')}}</h3>
                                        </div>
                                    <div class="card-body">
                                        <div class="row">
                                            @foreach($locales as $locale)
                                               <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{__('cp.feature_title_'.$locale->lang)}}</label>
                                                        <input type="text" class="form-control form-control-solid"
                                                         name="feature_title_{{$locale->lang}}" value="{{old('feature_title_'.$locale->lang,@$item->translate($locale->lang)->feature_title)}}" required />
                                                    </div>
                                                </div>
                                            @endforeach
                                            @foreach($locales as $locale)
                                               <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{__('cp.feature_details_'.$locale->lang)}}</label>
                                                        <textarea id="feature_details_{{$locale->lang}}" class="form-control form-control-solid"
                                                            {{($locale->lang == 'ar') ? 'dir=rtl' :'' }} name="feature_details_{{$locale->lang}}"
                                                            id="order" rows="3" required>{{old('feature_details_'.$locale->lang,@$item->translate($locale->lang)->feature_details)}}</textarea>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                </div>
                                </div>
                            </div>

                             <div class="tab-content mt-5" >
                                <div class="tab-pane fade show active" id="myTabContent2" role="tabpanel"
                                    aria-labelledby="content-tab-main2">
                                    <div class="card-header">
                                        <h3 class="card-title">{{__('cp.screenshots')}}</h3>
                                        </div>
                                    <div class="card-body">
                                        <div class="row">
                                            @foreach($locales as $locale)
                                               <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{__('cp.screenshots_title_'.$locale->lang)}}</label>
                                                        <input type="text" class="form-control form-control-solid"
                                                         name="screenshots_title_{{$locale->lang}}" value="{{old('screenshots_title_'.$locale->lang,@$item->translate($locale->lang)->screenshots_title)}}" required />
                                                    </div>
                                                </div>
                                            @endforeach
                                            @foreach($locales as $locale)
                                               <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{__('cp.screenshots_details_'.$locale->lang)}}</label>
                                                        <textarea id="screenshots_details_{{$locale->lang}}" class="form-control form-control-solid"
                                                            {{($locale->lang == 'ar') ? 'dir=rtl' :'' }} name="screenshots_details_{{$locale->lang}}"
                                                            id="order" rows="3" required>{{old('screenshots_details_'.$locale->lang,@$item->translate($locale->lang)->screenshots_details)}}</textarea>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                </div>
                                </div>
                            </div>



                             <div class="tab-content mt-5" >
                                <div class="tab-pane fade show active" id="myTabContent2" role="tabpanel"
                                    aria-labelledby="content-tab-main2">
                                    <div class="card-header">
                                        <h3 class="card-title">{{__('cp.customerComments')}}</h3>
                                        </div>
                                    <div class="card-body">
                                        <div class="row">
                                            @foreach($locales as $locale)
                                               <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{__('cp.customer_comments_title_'.$locale->lang)}}</label>
                                                        <input type="text" class="form-control form-control-solid"
                                                         name="customer_comments_title_{{$locale->lang}}" value="{{old('customer_comments_title_'.$locale->lang,@$item->translate($locale->lang)->customer_comments_title)}}" required />
                                                    </div>
                                                </div>
                                            @endforeach
                                            @foreach($locales as $locale)
                                               <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{__('cp.customer_comments_details_'.$locale->lang)}}</label>
                                                        <textarea id="customer_comments_details_{{$locale->lang}}" class="form-control form-control-solid"
                                                            {{($locale->lang == 'ar') ? 'dir=rtl' :'' }} name="customer_comments_details_{{$locale->lang}}"
                                                            id="order" rows="3" required>{{old('customer_comments_details_'.$locale->lang,@$item->translate($locale->lang)->customer_comments_details)}}</textarea>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                </div>
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
                                            @foreach($locales as $locale)
                                               <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{__('cp.contact_us_title_'.$locale->lang)}}</label>
                                                        <input type="text" class="form-control form-control-solid"
                                                         name="contact_us_title_{{$locale->lang}}" value="{{old('contact_us_title_'.$locale->lang,@$item->translate($locale->lang)->contact_us_title)}}" required />
                                                    </div>
                                                </div>
                                            @endforeach
                                            @foreach($locales as $locale)
                                               <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{__('cp.contact_us_details_'.$locale->lang)}}</label>
                                                        <textarea id="contact_us_details_{{$locale->lang}}" class="form-control form-control-solid"
                                                            {{($locale->lang == 'ar') ? 'dir=rtl' :'' }} name="contact_us_details_{{$locale->lang}}"
                                                            id="order" rows="3" required>{{old('contact_us_details_'.$locale->lang,@$item->translate($locale->lang)->contact_us_details)}}</textarea>
                                                    </div>
                                                </div>
                                            @endforeach
                                            @foreach($locales as $locale)
                                               <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{__('cp.address_'.$locale->lang)}}</label>
                                                        <input type="text" class="form-control form-control-solid"
                                                        name="address_{{$locale->lang}}" value="{{old('address_'.$locale->lang,@$item->translate($locale->lang)->address)}}" required />
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    <div class="row">

                                        <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{__('cp.email')}}</label>
                                                    <input type="email" class="form-control form-control-solid"
                                                        name="email" value="{{$item->email}}" required/>
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
                                                    <label>{{__('cp.facebook')}}</label>
                                                    <input type="text" class="form-control form-control-solid"
                                                        name="facebook" value="{{$item->facebook}}" required/>
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
                                    </div>
                                </div>
                                </div>
                            </div>

                        <div class="tab-content mt-5" >
                                <div class="tab-pane fade show active" id="myTabContent2" role="tabpanel"
                                    aria-labelledby="content-tab-main2">
                                    <div class="card-header">
                                        <h3 class="card-title">{{__('cp.images')}}</h3>
                                        </div>
                                    <div class="card-body">

                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="fileinputForm">
                                                <label >{{__('cp.logo')}}</label>
                                                <div class="fileinput-new thumbnail"
                                                        onclick="document.getElementById('edit_logo').click()"
                                                        style="cursor:pointer">
                                                    <img src="{{$item->logo}}"  id="editLogo">
                                                </div>
                                                <div class="btn btn-change-img red"
                                                        onclick="document.getElementById('edit_logo').click()">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </div>
                                                <input type="file" class="form-control" name="logo"
                                                    id="edit_logo"
                                                    style="display:none">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="fileinputForm">
                                                <label >{{__('cp.feature_image')}}</label>
                                                <div class="fileinput-new thumbnail"
                                                        onclick="document.getElementById('edit_image22').click()"
                                                        style="cursor:pointer">
                                                    <img src="{{$item->feature_image}}"  id="editImage22">
                                                </div>
                                                <div class="btn btn-change-img red"
                                                        onclick="document.getElementById('edit_image22').click()">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </div>
                                                <input type="file" class="form-control" name="feature_image"
                                                    id="edit_image22"
                                                    style="display:none">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="fileinputForm">
                                                <label >{{__('cp.home_image')}}</label>
                                                <div class="fileinput-new thumbnail"
                                                        onclick="document.getElementById('edit_image5').click()"
                                                        style="cursor:pointer">
                                                    <img src="{{$item->home_image}}"  id="editImage5">
                                                </div>
                                                <div class="btn btn-change-img red"
                                                        onclick="document.getElementById('edit_image5').click()">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </div>
                                                <input type="file" class="form-control" name="home_image"
                                                    id="edit_image5"
                                                    style="display:none">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="fileinputForm">
                                                <label >{{__('cp.about_us_image')}}</label>
                                                <div class="fileinput-new thumbnail"
                                                        onclick="document.getElementById('edit_image6').click()"
                                                        style="cursor:pointer">
                                                    <img src="{{$item->about_us_image}}"  id="editImage6">
                                                </div>
                                                <div class="btn btn-change-img red"
                                                        onclick="document.getElementById('edit_image6').click()">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </div>
                                                <input type="file" class="form-control" name="about_us_image"
                                                    id="edit_image6"
                                                    style="display:none">
                                            </div>
                                        </div>

                                        {{-- <div class="col-md-6">

                                            <div class="fileinputForm">
                                                <label >{{__('cp.image')}}</label>
                                                <div class="fileinput-new thumbnail"
                                                    onclick="document.getElementById('edit_image11').click()"
                                                    style="cursor:pointer">
                                                    <img src="{{$item->image}}"  id="editImage11">
                                                </div>
                                                <div class="btn btn-change-img red"
                                                    onclick="document.getElementById('edit_image11').click()">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </div>
                                                <input type="file" class="form-control" name="image"
                                                id="edit_image11"
                                                style="display:none">
                                            </div>
                                        </div> --}}
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
    $('#edit_image5').on('change', function (e) {
            readURL(this, $('#editImage5'));
        });
    $('#edit_image6').on('change', function (e) {
            readURL(this, $('#editImage6'));
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
