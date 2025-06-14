@extends('layout.adminLayout')
@section('title') {{ucwords(__('cp.banners'))}}
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
                            <h3>{{__('cp.add')}}</h3>
                        </div>
                    </div>
                    <!--end::Info-->
                    <!--begin::Toolbar-->
                    <div class="d-flex align-items-center">
                        <a  href="{{url(getLocal().'/admin/banners')}}" class="btn btn-secondary  mr-2">{{__('cp.cancel')}}</a>
                        <button id="submitButton" class="btn btn-success ">{{__('cp.add')}}</button>
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
                        <form class="form" method="post" action="{{url(app()->getLocale().'/admin/banners')}}"
                            role="form" id="form" enctype="multipart/form-data" >
                            @csrf
                            <div class="card-header">
                                <h3 class="card-title">{{__('cp.main_data')}}</h3>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    @foreach($locales as $locale)
                                       <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{__('cp.description_'.$locale->lang)}}</label>
                                                <input type="text" class="form-control form-control-solid" name="description_{{$locale->lang}}" value="{{ old('description_'.$locale->lang) }}" required />
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>



                            <div class="card-body">
                                   <div class="row">
                                      <div class="col-md-6" id="internal">
                                            <div class="form-group ">
                                                <label>{{__('cp.category')}}</label>
                                                <select class="form-control form-control-solid" name ="category_id" required>
                                                    <option value="">{{__('cp.select')}}</option>
                                                      @foreach ($categories as $category)
                                                      <option value="{{$category->id}}">{{$category->name}}</option>
                                                      @endforeach

                                                </select>
                                            </div>
                                       </div>
                                      <div class="col-md-6" id="external">
                                            <div class="form-group ">
                                                <label>{{__('cp.link')}}</label>
                                                  <input type="link" class="form-control form-control-solid" name="link" value="{{ old('link') }}"   >
                                            </div>
                                       </div>

                                 </div>
                                </div>


                            <div class="card-body">
                                <div class="card-header">
                                <h3 class="card-title">{{__('cp.image')}}</h3>
                                </div>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="fileinputForm">
                                            <label >{{__('cp.image')}}</label>
                                            <div class="fileinput-new thumbnail"
                                                onclick="document.getElementById('edit_image').click()"
                                                style="cursor:pointer">
                                                <img src="{{url(admin_assets('images/ChoosePhoto.png'))}}" id="editImage">
                                            </div>
                                            <div class="btn btn-change-img red"
                                                onclick="document.getElementById('edit_image').click()">
                                                <i class="fas fa-pencil-alt"></i>
                                            </div>
                                            <input type="file" class="form-control" name="image" required
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
        $(document).on('click', '#submitButton', function(){
           // $('#submitButton').addClass('spinner spinner-white spinner-left');
        $('#submitForm').click();
    });

    $('#edit_image').on('change', function (e) {

readURL(this, $('#editImage'));

});


$(document).on('change','.baner_type',function (e) {
    var ele = $(this);
  var option=  $( ".baner_type option:selected" ).val();
    if(option==0){
       $("#external").hide(200);
       $("#internal").show(200);
    }
});

    $(document).on('change','.baner_type',function (e) {
    var ele = $(this);
    var option=  $( ".baner_type option:selected" ).val();
    if(option==1){
       $("#internal").hide(200);
       $("#external").show(200);
    }
});

</script>
@endsection

@section('script')

@endsection
