@extends('layout.subAdminLayout')
@section('title') {{__('common.edit')}}{{__('common.RequestService')}}
@endsection
@section('css')
 <script type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjOp2BjQx-ruFkTnb4mB_2m3eFtcCyPbU&sensor=false&libraries=places"></script>
    <style type="text/css">
        .input-controls {
            margin-top: 10px;
            border: 1px solid transparent;
            border-radius: 2px 0 0 2px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            height: 32px;
            outline: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        }

        #searchInput {
            background-color: #fff;
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
            margin-left: 12px;
            padding: 0 11px 0 13px;
            text-overflow: ellipsis;
            width: 50%;
        }

        #searchInput:focus {
            border-color: #4d90fe;
        }

    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN SAMPLE FORM PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject font-dark sbold uppercase"
                              style="color: #e02222 !important;">{{__('common.edit')}}{{__('order.order')}}</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form method="post" action="{{url(app()->getLocale().'/admin/serviceRequest/'.$orders->id)}}"
                          enctype="multipart/form-data" class="form-horizontal" role="form">
                        {{ csrf_field() }}
                        <input type="hidden" name="user_id" value="{{$orders->user_id}}">
                         <input type="hidden" id="order_id" name="order_id" value="{{$orders->id}}">
                        <div class="form-body">


                            <fieldset>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="order">
                                    {{__('common.username')}}
                                </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" @if($orders->user) value="{{$orders->user->name}} " @endif id="order"
                                           placeholder=" {{__('common.username')}}" {{ old('name') }} disabled>
                                </div>
                            </div>
                        </fieldset>




                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="order">
                                        {{__('common.email')}}
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="name" @if($orders->user->email) value="{{$orders->user->email}} " @endif id="order"
                                               placeholder=" {{__('common.email')}}" {{ old('email') }} disabled>
                                    </div>
                                </div>
                            </fieldset>



                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="order">
                                        {{__('bunch.total')}}
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="name" @if($orders->price) value="{{$orders->price}} " @endif id="order"
                                               placeholder=" {{__('common.price')}}" {{ old('email') }} disabled>
                                    </div>
                                </div>
                            </fieldset>


                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="order">
                                        {{__('common.paymentMethod')}}
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="name" @if($orders) value="{{$orders->payment_method}} " @endif id="order"
                                               placeholder=" {{__('common.paymentMethod')}}" {{ old('email') }} disabled>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="order">
                                        {{__('common.deliveryType')}}
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="name" @if($orders) value="{{$orders->type_delivery}} " @endif id="order"
                                               placeholder=" {{__('common.deliveryType')}}" {{ old('email') }} disabled>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="order">
                                        {{__('common.deliveryDate')}}
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="name" @if($orders) value="{{$orders->delivery_date}} " @endif id="order"
                                               placeholder=" {{__('common.deliveryDate')}}" {{ old('email') }} disabled>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="order">
                                        {{__('common.deliveries')}}
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="name" @if($orders->deliveryCompany) value="{{$orders->deliveryCompany->name}} " @endif id="order"
                                               placeholder="  {{__('common.deliveries')}}" {{ old('email') }} disabled>
                                    </div>
                                </div>
                            </fieldset>





                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="order">
                                        {{__('bunch.total')}}
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="name" @if($orders->reference_id) value="{{$orders->price}} " @endif id="order"
                                               placeholder=" {{__('common.price')}}" {{ old('email') }} disabled>
                                    </div>
                                </div>
                            </fieldset>


                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="order">
                                        {{__('common.company')}}
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="name" @if($orders->requestService->store) value="{{$orders->requestService->store->name}} " @endif id="order"
                                               placeholder=" {{__('common.company')}}" {{ old('email') }} disabled>
                                    </div>
                                </div>
                            </fieldset>


                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="order">
                                        {{__('common.numberOfPage')}}
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="name" @if($orders->requestService) value="{{$orders->requestService->number_page}} " @endif id="order"
                                               placeholder=" {{__('common.numberOfPage')}}" {{ old('email') }} disabled>
                                    </div>
                                </div>
                            </fieldset>













                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="order">
                                        {{__('common.service')}}
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="name" @if($orders->requestService->service) value="{{$orders->requestService->service->name}} " @endif id="order"
                                               placeholder=" {{__('common.service')}}" {{ old('email') }} disabled>
                                    </div>
                                </div>
                            </fieldset>


                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="category_id">
                                    {{__('common.status')}}
                                    <span class="symbol">*</span>
                                </label>
                                <div class="col-md-6">
                                    <select id="status_id" class="form-control select2" name="status"
                                            required>



                                        <option value="0" @if($orders->status == 0 ) selected @endif>
                                            {{__("common.Pending")}}
                                        </option>
                                        <option value="1" @if($orders->status == 1 ) selected @endif>
                                            {{__("common.Confirm")}}
                                        </option>

                                    </select>
                                </div>
                            </div>


                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="toolsTable">
                                <thead>
                                <tr>
                                    <th> {{ucwords(__('common.numberOfPage'))}}</th>
                                    <th> {{ucwords(__('common.blackwhitePage'))}}</th>
                                    <th> {{ucwords(__('common.coloredPage'))}}</th>
                                    <th> {{ucwords(__('common.colorPageSelected'))}}</th>


                                </tr>
                                </thead>
                                <tbody>

                                    <tr class="odd gradeX" id="tr-{{$orders->id}}">

                                        
                                        <td>@if($orders->requestService) {{$orders->requestService->number_page}}  @endif</td>
                                        <td>@if($orders->requestService) {{$orders->requestService->blackwhite_page}}  @endif</td>
                                        <td>@if($orders->requestService) {{$orders->requestService->colored_page}}  @endif</td>
                                        <td>@if($orders->requestService) {{$orders->requestService->color_page_selected}}  @endif</td>


                                    </tr>

                                </tbody>
                            </table>









                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" id="edit" class="btn green">{{__('common.submit')}}</button>
                                        <a href="{{url(getLocal().'/admin/serviceRequest')}}" class="btn default">{{__('common.cancel')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection
@section('script')
    <script>
        $('#edit_image').on('change', function (e) {
            readURL(this, $('#editImage'));
        });
        
        
        $('#status_id').on('change', function (e) {
          // alert('ereeee'); 
          $status = document.getElementById('status_id').value;
          //alert($status);
          if($status > 1){
              $('#driver').removeClass('hidden');
          }else{
              $('#driver').addClass('hidden');
          }
            
        });
        
    </script>
    
    

<script src="https://www.gstatic.com/firebasejs/5.4.0/firebase.js"></script>
<script>
  $order_id = document.getElementById('order_id').value;
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyDTRqoX7Vg-YMeObrnxxU4VvjRF2AEardw",
    authDomain: "bunch-27fb7.firebaseapp.com",
    databaseURL: "https://bunch-27fb7.firebaseio.com",
    projectId: "bunch-27fb7",
    storageBucket: "bunch-27fb7.appspot.com",
    messagingSenderId: "1057018754789"
  };
  
  firebase.initializeApp(config);


  $send_button = document.getElementById('edit');

  $send_button.addEventListener("click", function(){
  $status = document.getElementById('status_id').value;

  		firebase.database().ref('orders/' + $order_id).update({

  			completed: 'true' ,

  		    });
  		
  		});



</script>
@endsection
