@extends('website.layout')
@section('title') {{$search}} @endsection
@section('css')
@endsection
@section('content')

		<div class="breadcrumb-bar"> 
            <div class="container">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fa fa-home"></i>@lang('website.HOME')</a></li>
                   <li class="breadcrumb-item active">{{$search}}</li>
                </ol>
            </div>
        </div>
        
        <section class="section_page_site">
		    <div class="container">
                <div class="head-sort">
		            <h5>@lang('website.Sort Type')</h5>
		            <div class="form-group">
		                <select class="form-control" onchange="location = this.value;">
		                    <option>@lang('website.select')</option>
		                    <option @if(Request::get('sort')=='min') {{'selected'}} @endif value="{{route('search').'?search='.$search.'&sort=min'}}">@lang('website.Min price')</option>
		                    <option @if(Request::get('sort')=='max') {{'selected'}} @endif value="{{route('search').'?search='.$search.'&sort=max'}}">@lang('website.Max Price')</option>
		                    
		                </select>
		            </div>
		        </div>
		        <div class="row" id="infinite">
		           @include('website.more_blad.product_items')

		        </div>
		         {{$products->links('pagination::bootstrap-4')}}
		         <!--<div class="ajax-load text-center" style="display:none">-->
           <!--          <div class="loadingIconsItems" style="text-align:center"><i class="fa fa-spinner fa-spin" style="font-size: 20px;"></i></div>-->
           <!--     </div>-->
		    </div>
		</section>

@endsection

@section('script')
 
	<script>
	                      var csrf_token = '{{csrf_token()}}';
        var page = 1;
        // $(window).scroll(function () {
        //     if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight -350) {
        //         if(page !=0) {
        //             page++;
        //             loadMoreData(page);
        //         }
        //     }
        //     else {
        //     }
        // });
function loadMoreData(page1) {
    var char;
    if(window.location.search == ""){
        char = "?";
    }else{
        char = window.location.href+"&";
    }
    $.ajax(
        {
            url: char +'page=' + page1,
            type: "get",
            beforeSend: function () {
                $('.ajax-load').show();
            }
        })
        .done(function (data) {
            $('.ajax-load').hide();
            $("#infinite").append(data.html);
            if ( data.is_more =="no") {
                $('.ajax-load').hide(); 
                page = 0;
                return;
            }
        })
        .fail(function (jqXHR, ajaxOptions, thrownError) {
            return false;
        });
}
	</script>
@endsection

