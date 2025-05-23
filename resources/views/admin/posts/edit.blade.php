@extends('layout.adminLayout')
@section('title') {{ucwords(__('cp.posts'))}}
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
                        <a  href="{{url(getLocal().'/admin/posts')}}" class="btn btn-secondary  mr-2">{{__('cp.cancel')}}</a>
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
                        <form class="form" method="post" action="{{url(app()->getLocale().'/admin/posts/'.$item->id)}}" 
                            role="form" id="form" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                            {{ method_field('PATCH')}}
                            <div class="card-header">
                                <h3 class="card-title">{{__('cp.main_data')}}</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label>{{__('cp.description')}}</label>
                                            <input type="text" class="form-control form-control-solid" name="description" value="{{$item->description}}" required/>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                          <div class="form-group ">
                                              <label>{{__('cp.brand')}}</label>
                                              <select class="form-control form-control-solid country" name ="brand_id" required>
                                                  <option value="">{{__('cp.select')}}</option>
                                                     @foreach ($brands as $brand)
                                                    <option value="{{$brand->id}}"@if($item->brand_id ==$brand->id) selected @endif>{{$brand->name}}</option>
                                                    @endforeach
                                              </select>
                                          </div>
                                     </div>
                                    <div class="col-md-4">
                                          <div class="form-group ">
                                              <label>{{__('cp.model')}}</label>
                                              <select class="form-control form-control-solid country" name ="model_id" required>
                                                  <option value="">{{__('cp.select')}}</option>
                                                     @foreach ($models as $model)
                                                    <option value="{{$model->id}}"@if($item->model_id ==$model->id) selected @endif>{{$model->name}}</option>
                                                    @endforeach
                                              </select>
                                          </div>
                                     </div>
                            
                               </div>
                                <div class="row">
                                    <div class="col-md-4">
                                          <div class="form-group ">
                                              <label>{{__('cp.bodyType')}}</label>
                                              <select class="form-control form-control-solid country" name ="body_type_id" required>
                                                  <option value="">{{__('cp.select')}}</option>
                                                     @foreach ($bodyTypes as $BodyType)
                                                    <option value="{{$BodyType->id}}"@if($item->body_type_id ==$BodyType->id) selected @endif>{{$BodyType->name}}</option>
                                                    @endforeach
                                              </select>
                                          </div>
                                     </div>
                                    <div class="col-md-4">
                                          <div class="form-group ">
                                              <label>{{__('cp.regionalSpecs')}}</label>
                                              <select class="form-control form-control-solid country" name ="regional_specs_id">
                                                  <option value="">{{__('cp.select')}}</option>
                                                     @foreach ($regionalSpecss as $RegionalSpecs)
                                                    <option value="{{$RegionalSpecs->id}}"@if($item->regional_specs_id ==$RegionalSpecs->id) selected @endif>{{$RegionalSpecs->name}}</option>
                                                    @endforeach
                                              </select>
                                          </div>
                                     </div>
                                    <div class="col-md-4">
                                          <div class="form-group ">
                                              <label>{{__('cp.mileage')}}</label>
                                              <select class="form-control form-control-solid country" name ="mileage_id" required>
                                                  <option value="">{{__('cp.select')}}</option>
                                                     @foreach ($mileages as $Mileage)
                                                    <option value="{{$Mileage->id}}"@if($item->mileage_id ==$Mileage->id) selected @endif>{{$Mileage->start_from.' - '.$Mileage->end_to}}</option>
                                                    @endforeach
                                              </select>
                                          </div>
                                     </div>
                            
                               </div>
                               

                               <div class="row">
                                <div class="col-md-4">
                                      <div class="form-group ">
                                          <label>{{__('cp.body_color')}}</label>
                                          <select class="form-control form-control-solid country" name ="body_color_id" required>
                                              <option value="">{{__('cp.select')}}</option>
                                                 @foreach ($colors as $color)
                                                <option value="{{$color->id}}"@if($item->body_color_id ==$color->id) selected @endif>{{$color->name}}</option>
                                                @endforeach
                                          </select>
                                      </div>
                                 </div>
                                <div class="col-md-4">
                                      <div class="form-group ">
                                          <label>{{__('cp.interior_color')}}</label>
                                          <select class="form-control form-control-solid country" name ="interior_color_id" required>
                                              <option value="">{{__('cp.select')}}</option>
                                                 @foreach ($colors as $color)
                                                <option value="{{$color->id}}"@if($item->interior_color_id ==$color->id) selected @endif>{{$color->name}}</option>
                                                @endforeach
                                          </select>
                                      </div>
                                 </div>
                                <div class="col-md-4">
                                      <div class="form-group ">
                                          <label>{{__('cp.fuelType')}}</label>
                                          <select class="form-control form-control-solid country" name ="fuel_type_id" required>
                                              <option value="">{{__('cp.select')}}</option>
                                                 @foreach ($fuelTypes as $fuelType)
                                                <option value="{{$fuelType->id}}"@if($item->fuel_type_id ==$fuelType->id) selected @endif>{{$fuelType->name}}</option>
                                                @endforeach
                                          </select>
                                      </div>
                                 </div>
                        
                           </div>



                               <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group ">
                                        <label>{{__('cp.doors_count')}}</label>
                                        <input onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" type="text" 
                                        class="form-control form-control-solid" name="doors_count" value="{{$item->doors_count}}"/>
                                    </div>
                               </div>

                               <div class="col-md-4">
                                    <div class="form-group ">
                                        <label>{{__('cp.seats_count')}}</label>
                                        <input onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" type="text" 
                                        class="form-control form-control-solid" name="seats_count" value="{{$item->seats_count}}" required/>
                                    </div>
                               </div>

                               <div class="col-md-4">
                                    <div class="form-group ">
                                        <label>{{__('cp.cylinders_count')}}</label>
                                        <input onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" type="text" 
                                        class="form-control form-control-solid" name="cylinders_count" value="{{$item->cylinders_count}}"/>
                                    </div>
                               </div>
                        
                               </div>
                         
                            
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label>{{__('cp.trim')}}</label>
                                            <select class="form-control form-control-solid " name ="trim_id">
                                                <option value="">{{__('cp.select')}}</option>
                                                <option value="1" @if($item->trim_id ==1) selected @endif>{{__('cp.Basic')}}</option>
                                                <option value="2" @if($item->trim_id ==2) selected @endif>{{__('cp.Mid-option')}}</option>
                                                <option value="3" @if($item->trim_id ==3) selected @endif>{{__('cp.Full options')}}</option>
                                                <option value="4" @if($item->trim_id ==4) selected @endif>{{__('cp.Exclusive')}}</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                            <div class="form-group">
                                                <label>{{__('cp.transmission')}}</label>
                                                <select class="form-control form-control-solid " name ="transmission">
                                                    <option value="">{{__('cp.select')}}</option>
                                                    <option value="1" @if($item->transmission ==1) selected @endif>{{__('cp.Manual')}}</option>
                                                    <option value="2" @if($item->transmission ==2) selected @endif>{{__('cp.Automatic')}}</option>
                                                </select>
                                            </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label>{{__('cp.year')}}</label>
                                            <input onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" type="text" 
                                            class="form-control form-control-solid" name="year" value="{{$item->year}}" required/>
                                        </div>
                                    </div>
                            
                                
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label>{{__('cp.asking_price')}}</label>
                                            <input  type="number" 
                                            class="form-control form-control-solid number-only" name="asking_price" value="{{$item->asking_price}}" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label>{{__('cp.discount')}}</label>
                                            <input  type="number" 
                                            class="form-control form-control-solid number-only" name="discount" value="{{$item->discount}}"/>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{__('cp.is_negotiable_price')}}</label>
                                            <select class="form-control form-control-solid " name ="is_negotiable_price">
                                                <option value="">{{__('cp.select')}}</option>
                                                <option value="1" @if($item->is_negotiable_price ==1) selected @endif>{{__('cp.Yes')}}</option>
                                                <option value="0" @if($item->is_negotiable_price ==2) selected @endif>{{__('cp.No')}}</option>
                                            </select>
                                        </div>
                                </div>
                            
                                </div>


                                <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group ">
                                                <label>{{__('cp.car_city')}}</label>
                                                <select class="form-control form-control-solid " name ="car_city_id" required>
                                                    <option value="">{{__('cp.select')}}</option>
                                                        @foreach ($cities as $city)
                                                        <option value="{{$city->id}}"@if($item->car_city_id ==$city->id) selected @endif>{{$city->name}}</option>
                                                        @endforeach
                                                </select>
                                            </div>
                                        </div>
                                       <div class="col-md-4">
                                          <div class="form-group ">
                                              <label>{{__('cp.plate_city')}}</label>
                                              <select class="form-control form-control-solid country" name ="plate_city_id" required>
                                                  <option value="">{{__('cp.select')}}</option>
                                                     @foreach ($cities as $city)
                                                    <option value="{{$city->id}}"@if($item->plate_city_id ==$city->id) selected @endif>{{$city->name}}</option>
                                                    @endforeach
                                              </select>
                                          </div>
                                        </div>
                               </div>

                            </div>
                            
                         
 
                              <div class="card-body">
                                  
                                   <div class="row">
                                      <div class="col-md-4">
                                            <div class="form-group ">
                                                <label>{{__('cp.showroom_warranty')}}</label>
                                                <select class="form-control form-control-solid" name ="showroom_warranty">
                                                    <option value="">{{__('cp.select')}}</option>
                                                      <option value="1" @if($item->showroom_warranty ==1) selected @endif>{{__('cp.Yes')}}</option>
                                                      <option value="0" @if($item->showroom_warranty ==0) selected @endif>{{__('cp.No')}}</option>

                                                </select>
                                            </div>
                                       </div>

                                        <div class="col-md-4">
                                            <div class="form-group ">
                                                <label>{{__('cp.warranty_duration')}}</label>
                                                <input onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" type="text" class="form-control form-control-solid"
                                                 name="warranty_duration" value="{{$item->warranty_duration}}"/>
                                            </div>
                                       </div>

                                       <div class="col-md-4">
                                            <div class="form-group ">
                                                <label>{{__('cp.is_bank_finance')}}</label>
                                                <select class="form-control form-control-solid country" name ="is_bank_finance">
                                                    <option value="">{{__('cp.select')}}</option>
                                                    <option value="1" @if($item->is_bank_finance ==1) selected @endif>{{__('cp.Yes')}}</option>
                                                    <option value="0" @if($item->is_bank_finance ==0) selected @endif>{{__('cp.No')}}</option>

                                                </select>
                                            </div>
                                        </div>
                                       <div class="col-md-4">
                                            <div class="form-group ">
                                                <label>{{__('cp.is_free_registration')}}</label>
                                                <select class="form-control form-control-solid" name ="is_free_registration">
                                                    <option value="">{{__('cp.select')}}</option>
                                                    <option value="1" @if($item->is_free_registration ==1) selected @endif>{{__('cp.Yes')}}</option>
                                                    <option value="0" @if($item->is_free_registration ==0) selected @endif>{{__('cp.No')}}</option>

                                                </select>
                                            </div>
                                        </div>
                                       <div class="col-md-4">
                                            <div class="form-group ">
                                                <label>{{__('cp.is_free_one_year_insurance')}}</label>
                                                <select class="form-control form-control-solid" name ="is_free_one_year_insurance">
                                                    <option value="">{{__('cp.select')}}</option>
                                                    <option value="1" @if($item->is_free_one_year_insurance ==1) selected @endif>{{__('cp.Yes')}}</option>
                                                    <option value="0" @if($item->is_free_one_year_insurance ==0) selected @endif>{{__('cp.No')}}</option>

                                                </select>
                                            </div>
                                        </div>
                                 </div>

                                </div>  
                                @if(count($item->factors) > 0)
                                    <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card card-custom card-stretch gutter-b">
                                            <div class="card-header border-0 pt-5">
                                                <h3 class="card-title align-items-start flex-column">
                                                    <span class="card-label font-weight-bolder text-dark">{{__('cp.factors')}}</span>
                                                </h3>
                                            </div>
                                            <div class="card-body py-3">
                                                <div class="table-responsive">
                                                    <table class="table table-borderless table-vertical-center">
                                                        <thead>
                                                            <tr>
                                                                <th  >#</th>
                                                                <th  >{{__('cp.name')}}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($item->factors as $one)
                                                            <tr>
                                                                <td>{{@$loop->iteration}} </td>
                                                                <td> {{@$one->qustion->name}} </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        
                                        </div>
                                    </div>
                                    </div>
                                @endif



                                @if(count($item->options) > 0)
                                    <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card card-custom card-stretch gutter-b">
                                            <div class="card-header border-0 pt-5">
                                                <h3 class="card-title align-items-start flex-column">
                                                    <span class="card-label font-weight-bolder text-dark">{{__('cp.options')}}</span>
                                                </h3>
                                            </div>
                                            <div class="card-body py-3">
                                                <div class="table-responsive">
                                                    <table class="table table-borderless table-vertical-center">
                                                        <thead>
                                                            <tr>
                                                                <th  >#</th>
                                                                <th  >{{__('cp.image')}}</th>
                                                                <th  >{{__('cp.name')}}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($item->options as $one)
                                                            @if($one->option)
                                                            <tr>
                                                                <td>{{@$loop->iteration}} </td>
                                                                <td  >
                                                                    <div class="symbol symbol-50 symbol-light">
                                                                        <span class="symbol-label">
                                                                            <img src="{{@$one->option->image}}" class="h-50 align-self-center" alt="" />
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                               
                                                                <td> {{@$one->option->name}} </td>
                                                            </tr>
                                                            @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        
                                        </div>
                                    </div>
                                    </div>
                                @endif



                                <div class="card-body">
                                    <div class="row">
                                       <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                                           @if ($errors->has('image'))
                                               <span class="help-block">
                                                   <strong>{{ $errors->first('image') }}</strong>
                                               </span>
                                           @endif
                                           <div class="imageupload" style="display:flex;flex-wrap:wrap">
                                               @foreach($item->attachments as $one)
                                                   <div class="imageBox text-center" style="width:150px;height:190px;margin:5px">
                                                       <img src="{{$one->name}}" style="width:150px;height:150px">
                                                       <button class="btn btn-danger deleteImage" type="button">{{__("cp.remove")}}</button>
                                                       <input class="attachedValues" type="hidden" name="oldImages[]" value="{{$one->id}}">
                                                   </div>
                                               @endforeach
                                           </div>
                                           <div class="input-group control-group increment" >
                                               <div class="input-group-btn"  onclick="document.getElementById('all_images').click()"> 
                                                 <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>{{__("cp.addMoreImages")}}</button>
                                               </div>
                                               <input type="file" class="form-control hidden" style="display:none"  accept="image/*" id="all_images"  multiple />
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

        $('#all_images').on('change', function (e) {
        readURLMultiple(this, $('.imageupload'));
     });

        $(document).on('click', '#submitButton', function(){
           // $('#submitButton').addClass('spinner spinner-white spinner-left');
        $('#submitForm').click();
    });
</script>
@endsection

@section('script')

@endsection