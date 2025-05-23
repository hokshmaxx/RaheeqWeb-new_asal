@extends('admin.users.sideMenu')
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
                                <h3 class="card-title">{{__('cp.editAddress')}}</h3>
                            </div>
                            
                    <form method="post" action="{{url(getLocal().'/admin/users/'.$item->id.'/addresses/'.$address->id.'/update')}}"
                          enctype="multipart/form-data" class="form-horizontal" role="form" id="form">
                        {{ csrf_field() }}
                         {{ method_field('PATCH')}}
                          

                           <div class="row col-sm-12">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('cp.name')}}</label>
                                        <input type="text" class="form-control form-control-solid"
                                               name="name" value="{{$address->address_name}}" required/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('cp.street')}}</label>
                                        <input type="text" class="form-control form-control-solid" name="street"
                                           value="{{$address->street}}"    required/>
                                    </div>
                                </div>
    

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('cp.area')}}</label>
                                        <select class="form-control select2" id="" name="area_id"
                                             required>
                                        @foreach($areas as $area)
                                            <option value="{{$area->id}}" @if($area->id==$address->area_id) selected @endif>{{$area->name}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
     
                         </div>

                               {{-- <div class="card-body">
                                <div class="card-header">
                                <h3 class="card-title">{{__('cp.location')}}</h3>
                                </div>
                                <div class="row">
                                  
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <!--<input type="text" id="searchmap" placeholder="">-->
                                            <div id="map-canvas"></div>
                                            <input type="hidden" class="form-control input-sm" data-id="{{$address->latitude}}" value="{{$address->latitude}}" name="latitude" id="latitude">
              
                                            <input type="hidden" class="form-control input-sm" data-id="{{$address->longitude}}" value="{{$address->longitude}}" name="longitude" id="longitude">
                                         </div>
                                    </div>
                                </div>
                                    
                                </div> --}}
                                
  
                <div class="d-flex align-items-center">
                    <a href="{{url(getLocal().'/admin/users/'.$item->id.'/addresses')}}" class="btn btn-secondary  mr-2">{{__('cp.cancel')}}</a>
                    <button id="submitButton" class="btn btn-success ">{{__('cp.edit')}}</button>
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
    
            <script src="https://maps.googleapis.com/maps/api/js?key={{env('APIGoogleKey')}}&libraries=places"
  type="text/javascript"></script> 
<script>
    var latitude=$('#latitude').data("id");
    var longitude=$('#longitude').data("id");
	var map = new google.maps.Map(document.getElementById('map-canvas'),{
		center:{
			lat: latitude,
        	lng: longitude
		},
		zoom:9
	});
	var marker = new google.maps.Marker({
		position: {
			lat: latitude,
        	lng: longitude
		},
		map: map,
		draggable: true
	});
	var searchBox = new google.maps.places.SearchBox(document.getElementById('searchmap'));
	google.maps.event.addListener(searchBox,'places_changed',function(){
		var places = searchBox.getPlaces();
		var bounds = new google.maps.LatLngBounds();
		var i, place;
		for(i=0; place=places[i];i++){
  			bounds.extend(place.geometry.location);
  			marker.setPosition(place.geometry.location); //set marker position new...
  		}
  		map.fitBounds(bounds);
  		map.setZoom(15);
	});
	google.maps.event.addListener(marker,'position_changed',function(){
		var lat = marker.getPosition().lat();
		var lng = marker.getPosition().lng();
		$('#latitude').val(lat);
		$('#longitude').val(lng);
	});
</script>
@endsection
