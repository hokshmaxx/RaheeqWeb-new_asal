@extends('website.layout')
@section('title') @lang('website.Forgot PASSWORD') @endsection
@section('css')
@endsection
@section('content')
<section class="section_page_site">
    <div class="container">
        <div class="sec-head">
            <h2>@lang('website.Forgot PASSWORD')</h2>
        </div>
        <div class="content-order">
            <form class="form-account password_form">
                @csrf
                <div class="form-group">
                    <input type="text" name="email" class="form-control" placeholder="@lang('website.email')" required="" />
                </div>
                <div class="form-group">
                    <button class="btn-site h60 sendForm"><span>@lang('website.Send')</span></button>
                </div>
            </form>
        </div>
    </div>
</section>


@endsection

@section('script')
 
    <script>
var preventSubmit = false;
 
 $(document).on('click','.sendForm',function (e) {
             e.preventDefault();
             var formData = new FormData($('.password_form')[0]);
             $('.password_form').find( 'select, textarea, input' ).each(function(){
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
          $('.sendForm').html('<i class="fa fa-spinner fa-spin" style="font-size: 20px;"></i>')
          $(".sendForm").attr("disabled", true);
         var ele = $(this);
         var id = $(this).data("id");
         $.ajax({
             url: '{{route('sendResetLinkEmail')}}', 
             type: "post", 
             data: formData,
             processData: false,
             contentType: false,
             success: function (response) {
                 if(response.code ==200){
                     swal({
                         title: "{{__('website.resetPassword')}}",
                         icon: "success",
                         button: "{{__('website.oky')}}",
                     });
                     $(".password_form").find("input, textarea ,select").val("");
                     $('.sendForm').html('<span>{{__('website.Send')}}</span>')
                     $(".sendForm").attr("disabled", false);
                     $('input[name="_token"]') .val('{{ csrf_token() }}');
                     return
                 }else if(response.validator !=null){    
                             swal({
                             text: response.validator,
                             button: "{{__('website.oky')}}",
                             dangerMode: true,
                         });
                          $('.sendForm').html('<span>{{__('website.Send')}}</span>')
                          $(".sendForm").attr("disabled", false);
                 } else{
                     swal(response.message)
                     $('.sendForm').html('<span>{{__('website.Send')}}</span>')
                     $(".sendForm").attr("disabled", false);
                 }
             } 
             
         });
     })
	</script>
@endsection