@extends('admin.vender.sideMenu')
@section('companyContent')

@section('css')
<style>
	#map-canvas{
		width: 600px;
		height: 350px;
      
	}

</style>
@endsection

	<div class="flex-row-fluid ml-lg-8">
     
            <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">{{__('cp.Change_Password')}}</h3>
            </div>
                    <form method="post" action="{{url(app()->getLocale().'/admin/users/'.$item->id.'/edit_password')}}"
                          enctype="multipart/form-data" class="form-horizontal" role="form" id="form">
                        {{ csrf_field() }}
                           
 

                           <div class="row col-sm-12">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('cp.password')}}</label>
                                        <input type="password" class="form-control form-control-solid"
                                               name="password" value="{{old('password')}}" required/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('cp.confirm_password')}}</label>
                                        <input type="password" class="form-control form-control-solid" name="confirm_password"
                                           value="{{old('password')}}"    required/>
                                    </div>
                                </div>
                                
     
                         </div>
  
                <div class="d-flex align-items-center">
                    <a href="{{url(getLocal().'/admin/users')}}" class="btn btn-secondary  mr-2">{{__('cp.cancel')}}</a>
                    <button id="submitButton" class="btn btn-success ">{{__('cp.edit')}}</button>
                </div>
                <!--end::Toolbar-->
                        <button type="submit" id="submitForm" style="display:none"></button>
                    </form>
                
      </div>
      </div>
@endsection
@section('js')
@endsection
