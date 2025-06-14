@extends('admin.vender.sideMenu')
@section('companyContent')
	<div class="flex-row-fluid ml-lg-8">
            <div class="card card-custom gutter-b example example-compact">

                        <div class="card-header">
                            <h3 class="card-title">{{__('cp.edit')}}</h3>
                        </div>

                    <form method="post" action="{{url(app()->getLocale().'/admin/vender/'.$item->id)}}"
                          enctype="multipart/form-data" class="form-horizontal" role="form" id="form">
                        {{ csrf_field() }}
                           {{ method_field('PATCH')}}

                       <div class="row col-sm-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__('cp.name_en')}}</label>
                                    <input type="text" class="form-control form-control-solid"
                                            name="name_en" value="{{$item->name_en}}" required/>
                                </div>
                            </div>
                           <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__('cp.name_ar')}}</label>
                                    <input type="text" class="form-control form-control-solid"
                                            name="name_ar" value="{{$item->name_ar}}" required/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__('cp.email')}}</label>
                                    <input type="text" class="form-control form-control-solid" name="email"
                                        value="{{$item->email}}"    required/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__('cp.mobile')}}</label>
                                    <input type="text" class="form-control form-control-solid" name="mobile" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
                                        value="{{$item->mobile}}"   required/>
                                </div>
                             </div>
                            </div>
                            <div class="form-group">
                                <label>{{__('cp.image')}}</label>
                             <div class="col-md-6 col-md-offset-6">
                                 <div class="fileinput-new thumbnail"
                                       onclick="document.getElementById('edit_image').click()"
                                      style="cursor:pointer">
                                     <img src="{{url($item->image)}}" id="editImage">
                                 </div>
                                 <div class="btn red"
                                      onclick="document.getElementById('edit_image').click()">
                                     <i class="fa fa-pencil"></i>
                                 </div>
                                 <input type="file" class="form-control" name="image"
                                        id="edit_image"
                                        style="display:none">
                             </div>
                          </div>

                               <!--begin::Toolbar-->
                            <div class="d-flex align-items-center">
                                <a href="{{url(getLocal().'/admin/vender')}}" class="btn btn-secondary  mr-2">{{__('cp.cancel')}}</a>
                                <button id="submitButton" class="btn btn-success ">{{__('cp.save')}}</button>
                            </div>
                       <!--end::Toolbar-->
                        <button type="submit" id="submitForm" style="display:none"></button>
                    </form>

            </div>
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
