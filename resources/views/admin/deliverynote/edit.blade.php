@extends('admin.deliverynote.sideMenu')
@section('companyContent')
	<div class="flex-row-fluid ml-lg-8">
            <div class="card card-custom gutter-b example example-compact">
                
                         <div class="card-header">
                                <h3 class="card-title">{{__('cp.edit')}}</h3>
                            </div>
                            
                    <form method="post" action="{{url(app()->getLocale().'/admin/deliverynote/'.$item->id)}}"
                          enctype="multipart/form-data" class="form-horizontal" role="form" id="form">
                        {{ csrf_field() }}
                        {{ method_field('PATCH')}}

 
                       <div class="row col-sm-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__('cp.name')}}</label>
                                    <input type="text" class="form-control form-control-solid"
                                            name="Delivery_note" value="{{$item->Delivery_note}}" required/>
                                </div>
                            </div>
                               <!--begin::Toolbar-->
                <div class="d-flex align-items-center">
                    <a href="{{url(getLocal().'/admin/deliverynote')}}" class="btn btn-secondary  mr-2">{{__('cp.cancel')}}</a>
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
      
        $(document).on('click', '#submitButton', function(){
            // $('#submitButton').addClass('spinner spinner-white spinner-left');
            $('#submitForm').click();
        });
    </script>
@endsection
