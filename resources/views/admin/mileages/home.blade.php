@extends('layout.adminLayout')
@section('title') {{ucwords(__('cp.mileages'))}}
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
                        <h3>{{ucwords(__('cp.mileages'))}}</h3>
                    </div>
                </div>
                <!--end::Info-->
                <!--begin::Toolbar-->


                <div>
                    <div class="btn-group mb-2 m-md-3 mt-md-0 ml-2 ">
                        <button type="button" class="btn btn-secondary" href="#activation" role="button"  data-toggle="modal">
                            <i class="icon-xl la la-check"></i>
                            <span>{{__('cp.activation')}}</span>
                        </button>
                        <button type="button" class="btn btn-secondary" href="#cancel_activation" role="button"  data-toggle="modal">
                            <i class="icon-xl la la-ban"></i>
                            <span>{{__('cp.cancel_activation')}}</span>
                        </button>
{{--                        <button type="button" class="btn btn-secondary" href="#deleteAll" role="button" data-toggle="modal">--}}
{{--                            <i class="flaticon-delete"></i>--}}
{{--                            <span>{{__('cp.delete')}}</span>--}}
{{--                        </button>--}}
                    </div>
                    <a href="{{url(getLocal().'/admin/mileages/create')}}" class="btn btn-secondary  mr-2 btn-success" data-target="#basicModal" data-toggle="modal">
                        <i class="icon-xl la la-plus"></i>
                        <span>{{__('cp.add')}}</span>
                    </a>
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
                <div class="gutter-b example example-compact">

                    <div class="contentTabel">
                        <div class="card-header d-flex flex-column flex-sm-row align-items-sm-start justify-content-sm-between">
                            <div>


                            </div>

                        </div>
                        <div class="table-responsive">
                         
                            <table class="table table-bordered table-hover table-checkable"  style="margin-top: 13px !important" id="kt_datatable1">
                               <thead>
                                <tr>
                                    <th class="wd-1p no-sort" style="padding-right: 0px;">
                                        <div class="checkbox-inline">
                                            <label class="checkbox">
                                            <input type="checkbox"  name="checkAll"/>
                                            <span></span></label>
                                        </div>
                                        </th>

                                    <th class="wd-25p"> {{ucwords(__('cp.from'))}}</th>
                                    <th class="wd-25p"> {{ucwords(__('cp.to'))}}</th>
                                    <th class="wd-10p"> {{ucwords(__('cp.status'))}}</th>
                                    <th class="wd-10p"> {{ucwords(__('cp.created'))}}</th>
                                    <th class="wd-15p notExport"> {{ucwords(__('cp.action'))}}</th>
                                </tr>
                               </thead>
                               <tbody>
                               </tbody>
                           </table>
                           
                        </div>
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
    <div class="modal fade create_modal" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('cp.add')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <div class="add-employee-form">
                        <form class="create_form" method="post" action="{{url(app()->getLocale().'/admin/mileages')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('cp.from')}}</label>
                                        <input
                                            type="number" class="form-control form-control-solid number-only" name="start_from"
                                            value="{{ old('from')}}" required/>
                                    </div>
                                 </div>
                          
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('cp.to')}}</label>
                                        <input
                                            type="number" class="form-control form-control-solid number-only" name="end_to"
                                            value="{{ old('to')}}" required/>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{__('cp.cancel')}}</button>
                    <button type="button" class="btn btn-primary font-weight-bold create_send_form">{{__('cp.save')}}</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade edit_modal" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('cp.edit')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <div class="add-employee-form edit_form_data">
                       
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{__('cp.cancel')}}</button>
                    <button type="button" class="btn btn-primary font-weight-bold edit_send_form">{{__('cp.save')}}</button>
                </div>
            </div>
        </div>
    </div>
    
@endsection
@section('js')
<script>
        $('#edit_image').on('change', function (e) {
           readURL(this, $('#editImage'));
        });
        $(document).on('change','#edit_image1',function (e){
           readURL(this, $('#editImage1'));
        });

        $(document).ready(function() {
    // init datatable.
    var dataTable = $('#kt_datatable1').DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        autoWidth: false,
        pageLength: 10,
        dom: '<"dt-top-container"<B><"dt-center-in-div"l><f>r>t<"dt-filter-spacer"><ip>',
        buttons: table_btns,
        
        "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],
        searching: true,
        "oLanguage": {
            "sSearch": "{{__('cp.search')}}"
        },

       ajax: {
        url: "{{Request::fullUrl()}}",
        type: 'GET',
       },
        columns: [
                { data: 'index', name: 'index' , orderable: false},
                { data: 'start_from', name: 'start_from'},
                { data: 'end_to', name: 'end_to'},
                { data: 'status', name: 'status' },
                { data: 'created_at', name: 'created_at' },
                {data: 'action', name: 'action', orderable: false},
             ],
      order: [[0, 'desc']]
   
    });
    
    });
    var preventSubmit = false;
 
$(document).on('click','.create_send_form',function (e) {
            e.preventDefault();
            // data = $('.create_form').serializeArray();
            var formData = new FormData($('.create_form')[0]);
            $('.create_form').find( 'select, textarea, input' ).each(function(){
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
         $('.create_send_form').html('<i class="fa fa-spinner fa-spin" style="font-size: 20px;"></i>')
         $(".create_send_form").attr("disabled", true);
        var ele = $(this);
        var id = $(this).data("id");
        $.ajax({
            url: '{{url(app()->getLocale().'/admin/mileages')}}', 
            type: "post", 
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if(response.code ==300){
                    swal({
                        title: "{{__('website.ok')}}",
                        icon: "success",
                        button: "{{__('website.oky')}}",
                    });
                    $(".create_form").find("input, textarea ,select").val("");
                    $('.create_send_form').html('{{__('cp.save')}}')
                    $(".create_send_form").attr("disabled", false);
                    $('.create_modal').modal('hide');
                    $('#kt_datatable1').DataTable().ajax.reload();
                    $('input[name="_token"]') .val('{{ csrf_token() }}');
                    $('.create_send_form').html('{{__('cp.save')}}')
                    $(".create_send_form").attr("disabled", false);
                    $('#editImage').attr('src', '{{url(admin_assets('images/ChoosePhoto.png'))}}');
                }else if(response.validator !=null){    
                            swal({
                            text: response.validator,
                            button: "{{__('website.oky')}}",
                            dangerMode: true,
                        });
                         $('.create_send_form').html('{{__('cp.save')}}')
                         $(".create_send_form").attr("disabled", false);
                } else{
                    swal(response.message)
                    $('.create_send_form').html('{{__('cp.save')}}')
                    $(".create_send_form").attr("disabled", false);
                }
            } 
            
        });
    });
 
$(document).on('click','.edit_item_btn',function (e) {
       e.preventDefault();
       var id = $(this).data("id");
        $.ajax({
            url: '{{url(app()->getLocale().'/admin/mileages')}}'+'/'+id+'/edit', 
            type: "get", 
            success: function (response) {
            // return response;
                if(response.code ==300){
                //    jQuery.noConflict();
                $('.edit_form_data').html(response.html);
                $('.edit_modal').modal('show');
                }else if(response.validator !=null){    
                            swal({
                            text: response.validator,
                            button: "{{__('website.oky')}}",
                            dangerMode: true,
                        });
                         $(".contact_us").attr("disabled", false);
                } else{
                    swal(response.message)
                }
            } 
            
        });
    });


    $(document).on('click','.edit_send_form',function (e) {
            e.preventDefault();
            // data = $('.edit_form').serializeArray();
            var editFormData = new FormData($('.edit_form')[0]);
            editFormData.append('_method', 'PATCH');
            $(".edit_form").find( 'select, textarea, input' ).each(function(){
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
        $('.edit_send_form').html('<i class="fa fa-spinner fa-spin" style="font-size: 20px;"></i>')
        $(".edit_send_form").attr("disabled", true);
        var ele = $(this);
        var id = $(this).data("id");
        var item_id = $('.item_id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: '{{url(app()->getLocale().'/admin/mileages')}}'+'/'+item_id, 
            type: "post", 
            data: editFormData,
            processData: false,
            contentType: false,
            success: function (response) {
                if(response.code ==300){
                    swal({
                        title: "{{__('website.ok')}}",
                        icon: "success",
                        button: "{{__('website.oky')}}",
                    });
                    $('.edit_send_form').html('{{__('cp.edit')}}')
                    $(".edit_send_form").attr("disabled", false);
                    $('.edit_modal').modal('hide');
                    $('#kt_datatable1').DataTable().ajax.reload();
                    //$('input[name="_token"]') .val('{{ csrf_token() }}');
                 }else if(response.validator !=null){    
                            swal({
                            text: response.validator,
                            button: "{{__('website.oky')}}",
                            dangerMode: true,
                        });
                         $('.edit_send_form').html('{{__('cp.edit')}}')
                         $(".edit_send_form").attr("disabled", false);
                } else{
                    $('.edit_send_form').html('{{__('cp.edit')}}')
                    $(".edit_send_form").attr("disabled", false);
                    swal('error')
                }
            } 
            
        });
    });



    function delete_adv(id, iss_id, e) {
            //alert(id);
            e.preventDefault();

            var url = '{{url(getLocal()."/admin/mileages")}}/' + id;
            var csrf_token = '{{csrf_token()}}';
            $.ajax({
                type: 'delete',
                headers: {'X-CSRF-TOKEN': csrf_token},
                url: url,
                data: {_method: 'delete'},
                success: function (response) {
                    console.log(response);
                    if (response === 'success') {
                        $('#tr-' + id).hide(500);
                        $('#myModal' + id).modal('toggle');

                    } else {
                        swal(response.message);
                    }
                },
                error: function (e) {

                }
            });

        }

</script>
@endsection

@section('script')

@endsection
