@extends('layout.adminLayout')
@section('title') {{ucwords(__('cp.subscribes'))}}
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
                        <h3>{{ucwords(__('cp.subscribes'))}}</h3>
                    </div>
                </div>
                <!--end::Info-->
                <!--begin::Toolbar-->


<!--                <div>-->
<!--                    <div class="btn-group mb-2 m-md-3 mt-md-0 ml-2 ">-->
<!--                        <button type="button" class="btn btn-secondary" href="#activation" role="button"  data-toggle="modal">-->
<!--                            <i class="icon-xl la la-check"></i>-->
<!--                            <span>{{__('cp.active')}}</span>-->
<!--                        </button>-->
<!--                        <button type="button" class="btn btn-secondary" href="#cancel_activation" role="button"  data-toggle="modal">-->
<!--                            <i class="icon-xl la la-ban"></i>-->
<!--                            <span>{{__('cp.not_active')}}</span>-->
<!--                        </button>-->
<!--{{--                        <button type="button" class="btn btn-secondary" href="#deleteAll" role="button" data-toggle="modal">--}}-->
<!--{{--                            <i class="flaticon-delete"></i>--}}-->
<!--{{--                            <span>{{__('cp.delete')}}</span>--}}-->
<!--{{--                        </button>--}}-->
<!--                    </div>-->
<!--                    <a href="{{url(getLocal().'/admin/categories/create')}}" class="btn btn-secondary  mr-2 btn-success" data-target="#basicModal" data-toggle="modal">-->
<!--                        <i class="icon-xl la la-plus"></i>-->
<!--                        <span>{{__('cp.add')}}</span>-->
<!--                    </a>-->
<!--                </div>-->
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
                        <button  type="button" class="btn btn-secondar btn--filter mr-2"><i class="icon-xl la la-sliders-h"></i>{{__('cp.filter')}}</button>
                        <div class="container box-filter-collapse" >
                            <div class="card" >
                                <form class="form-horizontal" method="get"
                                action="{{url(getLocal().'/admin/subscribes')}}">
                              <div class="row">
                                   
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label class="control-label">{{__('cp.email')}}</label>
                                          <input type="text" value="{{request('email')?request('email'):''}}"
                                                 class="form-control" name="email" placeholder="{{__('cp.email')}}">
                                      </div>
                                  </div>
                                 

                                  <div class="col-md-4">
                                      <button type="submit"
                                              class="btn sbold btn-default btnSearch">{{__('cp.search')}}
                                          <i class="fa fa-search"></i>
                                      </button>

                                      <a href="{{url(app()->getLocale().'/admin/subscribes')}}" type="submit"
                                         class="btn sbold btn-default btnRest">{{__('cp.reset')}}
                                          <i class="fa fa-refresh"></i>
                                      </a>
                                  </div>
                              </div>
                          </form>
                            </div>
                        </div>
                        <div class="card-header d-flex flex-column flex-sm-row align-items-sm-start justify-content-sm-between">
                            <div>


                            </div>

                        </div>
                        <div class="table-responsive">
                         
                            <table class="table table-bordered table-hover table-checkable"  style="margin-top: 13px !important" id="kt_datatable1">
                               <thead>
                                <tr>
                                    <th class="wd-1p no-sort">
                                      #
                                        </th>
                                    <th class="wd-10p"> {{ucwords(__('cp.email'))}}</th>
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

    
@endsection
@section('js')
<script>
        $(document).ready(function() {
    // init datatable.
    var dataTable = $('#kt_datatable1').DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        autoWidth: false,
        pageLength: 10,
        "aaSorting": [[0,'desc']],
        dom: '<"dt-top-container"<B><"dt-center-in-div"l><f>r>t<"dt-filter-spacer"><ip>',
        buttons: table_btns,
        language: table_language ,
        
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
                { data: 'id', name: 'id' },
                { data: 'email', name: 'email' },
                { data: 'created_at', name: 'created_at' },
                {data: 'action', name: 'action', orderable: false},
             ],
      order: [[0, 'desc']]
   
    });
    
    });
  
    function delete_adv(id, iss_id, e) {
            //alert(id);
            e.preventDefault();

            var url = '{{url(getLocal()."/admin/subscribes")}}/' + id;
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
                         swal('Error', {icon: "error"});
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
