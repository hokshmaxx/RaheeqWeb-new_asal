@extends('website.layout')
@section('title') @lang('website.MY ORDERS') @endsection
@section('css')
@endsection
@section('content')

 	<section class="section_page_site">
            <div class="container">
                <div class="sec-head">
                    <h2>@lang('website.MY ORDERS')</h2>
                </div>
                <div class="content-order">
                    <ul class="list-order">
                        <li class="btn-order active" data-filter="all"><span>@lang('website.All')</span></li>
                        <li class="btn-order" data-filter="status0"><span>@lang('website.New')</span></li>
                        <li class="btn-order" data-filter="status1"><span>@lang('website.In Progress')</span></li>
                        <li class="btn-order" data-filter="status2"><span>@lang('website.On Delivery')</span></li>
                        <li class="btn-order" data-filter="status3"><span>@lang('website.Completed')</span></li>
                    </ul>
                    <div class="all_order">
                        @foreach($items as $item)
                           <div class="cont-order status{{$item->status}}">
                            <div class="orderId">
                                <h2>@lang('website.Order Id')  :  <span>{{$item->id}}</span></h2>
                            </div>
                            <ul class="dateOrder">
                                <li> {{$item->total}} @lang('website.KWD')</li>
                                <li><i class="fa fa-calendar"></i>{{$item->created_at}}</li>
                            </ul>
                            <span class="typeOrder @if($item->status==0) typeNew @elseif($item->status==1) typeInProgress @elseif($item->status==2) typeOnDelivery @else typeCompleted @endif">{{$item->status_name}}</span>
                            <a class="showOrde" href="{{route('orderDetails',$item->id)}}"><i class="fa fa-arrow-right"></i></a>
                        </div>
                        @endforeach
                     
                    </div>
                </div>
            </div>
		</section>
@endsection

@section('script')
 <script>
             $(document).ready(function() {
            $('.btn-order').click(function() {
                const value = $(this).attr('data-filter');
                if(value == 'all'){
                    $('.cont-order').show('3000');
                }
                else {
                    $('.cont-order').not('.'+value).hide('1000');
                    $('.cont-order').filter('.'+value).show('1000');
                }
            })
            
            $('.btn-order').click(function() {
                $(this).addClass('active').siblings().removeClass('active');
            })
            
        })
 </script>
		<script>
 var preventSubmit = false;
 
$(document).on('click','.send_form',function (e) {
            e.preventDefault();
            var formData = new FormData($('.profile_form')[0]);
            $('.profile_form').find( 'select, textarea, input' ).each(function(){
                  if($(this).prop('required') && !$(this).val() && !$(this).is(":hidden")){
                      $(this).css("border", "#ff0000 solid 1px").next('span.errorSpan').remove(); //
                           $(this).css("border", "#bd1616 solid 1px").after('<span style="color:#bd1616" class="errorSpan">{{__("website.requiredField")}}</span>');
                      preventSubmit = true;
                      e.preventDefault();
                  }
              });
              if(preventSubmit){
                  preventSubmit = false;
                  return false;
                  
              }
      // $('.contact_us').html('<i class="fa fa-spinner fa-spin" style="font-size: 20px;"></i>'+' '+'{{__('website.send')}}');
         $('.send_form').html('<i class="fa fa-spinner fa-spin" style="font-size: 20px;"></i>')
         $(".send_form").attr("disabled", true);
        var ele = $(this);
        var id = $(this).data("id");
        $.ajax({
            url: '{{url(app()->getLocale().'/updateMyProfile')}}', 
            type: "post", 
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if(response.code ==200){
                    swal({
                        title: "{{__('website.ok')}}",
                        icon: "success",
                        button: "{{__('website.oky')}}",
                    });
                    $('.send_form').html('<span>{{__('website.Update')}}</span>')
                    $(".send_form").attr("disabled", false);
                    $('input[name="_token"]') .val('{{ csrf_token() }}');
                    // location.href='{{route('home')}}';
                    return
                }else if(response.validator !=null){    
                            swal({
                            text: response.validator,
                            button: "{{__('website.oky')}}",
                            dangerMode: true,
                        });
                         $('.send_form').html('<span>{{__('website.Update')}}</span>')
                         $(".send_form").attr("disabled", false);
                } else{
                    swal(response.message)
                    $('.send_form').html('<span>{{__('website.Update')}}</span>')
                    $(".send_form").attr("disabled", false);
                }
            } 
            
        });
    });
	</script>
@endsection

