@extends('layout.adminLayout')
@section('title') {{ucwords(__('cp.Vitamins'))}}
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
                    <!-- <div class="d-flex align-items-center">
                                <a  href="{{url(getLocal().'/admin/Vitamin')}}" class="btn btn-secondary  mr-2">{{__('cp.cancel')}}</a>
                                <button id="submitButton" class="btn btn-success ">{{__('cp.edit')}}</button>
                            </div> -->
                </div>
            </div>
            <!--end::Subheader-->
            <!--begin::Entry-->
            <div class="d-flex flex-column-fluid">
                <!--begin::Container-->
                <div class="container">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b example example-compact">
                        <form class="form" method="post" action="{{url(app()->getLocale().'/admin/Vitamin')}}"
                            role="form" id="form" enctype="multipart/form-data" >
                            @csrf
                            <!-- <div class="card-header">
                                <h3 class="card-title">{{__('cp.main_info')}}</h3>
                            </div> -->

                            
                            <div class="card-body">
                                <div class="row">
                           
                                      <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">{{__('cp.title')}}</label>
                                            <input type="text" class="form-control form-control-solid" name="title" 
                                                value="{{ old('title',$item->title) }}" required />
                                        </div>
                                       </div>
                                       <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">{{__('cp.title')}}</label>
                                            <input type="text" class="form-control form-control-solid" name="ar_title" 
                                                value="{{ old('ar_title',$item->title_ar) }}"   required />
                                        </div>
                                       </div> 
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">{{__('cp.Decription')}}</label>
                                            <input type="text" class="form-control form-control-solid" name="Decription" 
                                                value="{{ old('Decription',$item->description) }}"   required />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">{{__('cp.arDecription')}}</label>
                                            <input type="text" class="form-control form-control-solid" name="ar_Decription" 
                                                value="{{ old('ar_Decription',$item->description_ar) }}" id=  required />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="fileinputForm">
                                            <label >{{__('cp.image')}}</label>
                                            <div class="fileinput-new thumbnail"
                                                onclick="document.getElementById('edit_image').click()"
                                                style="cursor:pointer">
                                                <img src= "@if(!empty($item->image)){{$item->image}} @else  {{ url(admin_assets('/images/ChoosePhoto.png'))}} @endif" id="editImage">
                                               
                                            </div>
                                            <div class="btn btn-change-img red"
                                                onclick="document.getElementById('edit_image').click()">
                                                <i class="fas fa-pencil-alt"></i>
                                            </div>
                                            <input type="file" class="form-control" name="image"
                                               id="edit_image"
                                               style="display:none" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <a href="{{url(getLocal().'/admin/vender')}}" class="btn btn-secondary  mr-2">{{__('cp.cancel')}}</a>
                                    <button id="submitButton" class="btn btn-success ">{{__('cp.save')}}</button>
                                </div>
                            </div>  

                            <!-- <button type="submit" id="submitButton" style="display:none"></button> -->
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