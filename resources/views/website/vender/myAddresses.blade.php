@extends('website.layout')
@section('title') @lang('website.checkout') @endsection
@section('css')
@endsection
@section('content')

        <section class="section_page_site">
		    <div class="container">
                
		        <div class="row">
		            <div class="col-md-8">
                        <div class="sec-head ds-head">
                            <h3>@lang('website.My Address')</h3>
                            <a href="{{route('createAddress')}}" class="btn-add"><i class="ti-plus"></i>@lang('website.Add New Address')</a>
                        </div>
 
                        <div class="content-address wow fadeInUp">
                            @foreach($items as $item)
                            <div class="item-list-address addresss{{$item->id}}">
                                <div class="txt-address">
                                    <!--<h4>Delivery Address <strong>(Default)</strong></h4>-->
                                    <h4>{{$item->address_name}} </h4>
                                    <p>@lang('website.area')  :  {{$item->area->name}}</p>
                                    <p>@lang('website.street')  :  {{$item->street}}</p>
                                </div>
                                <ul class="opt-add">
                                    <li><a href="{{route('editAddress',$item->id)}}" class="edit-address"><i class="ti-pencil-alt"></i></a></li>
                                    <li><a class="deletAdress" data-id="{{$item->id}}"><i class="ti-close"></i></a></li>
                                </ul>
                                
                                <div class="check-address">
                                    
                                </div>
                            </div>
                            @endforeach
                          
                          
                        </div>
              
		            </div>
		             
		        </div>
		    </div>
		</section>

@endsection

@section('script')
 
    <script>
  $(document).on('click','.deletAdress',function (e) {
        // $(".remove-from-cart").click(function (e) {
            e.preventDefault();
 
            var ele = $(this);
            var id = $(this).data("id");
           
                $.ajax({
                    url:  '{{url(app()->getLocale().'/deletAdress')}}'+'/'+id, 
                    headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                         },
                    method: "get",
                    data: {

                    },
                    success: function (response) {
                        $('.addresss'+id).hide(1500).remove();
    
                    }
                });
            
        });
	</script>
@endsection

