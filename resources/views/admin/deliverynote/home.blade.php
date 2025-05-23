@extends('layout.adminLayout')
@section('title') {{ucwords(__('cp.Delivery'))}}
@endsection
@section('css')

  
@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
  <!--begin::Subheader-->
  <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
          <!--begin::Info-->
          <div class="d-flex align-items-center flex-wrap mr-1">
              <div class="d-flex align-items-baseline mr-5">
                  <h3>{{ucwords(__('cp.deliverynote'))}}</h3>
              </div>
          </div>

          <div>                    
                <a href="{{url(getLocal().'/admin/deliverynote/create')}}" class="btn btn-secondary  mr-2 btn-success">
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
                  <div class="table-responsive">
                    <table class="table table-bordered table-hover table-checkable"  style="margin-top: 13px !important" id="kt_datatable1">
                      {{-- <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important"> --}}
                      <thead>
                          <tr>                        
                              <th class="wd-1p">ID</th>
                              <th class="wd-25p"> {{ucwords(__('cp.Delivery_note'))}}</th>
                              <th class="wd-15p notExport"> {{ucwords(__('cp.action'))}}</th>
                          </tr>
                          </thead>
                          <tbody>
                  
                        </tbody>
                      </table>
                          {{-- $items->appends($_GET)->links("pagination::bootstrap-4") --}}
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
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{__('cp.cancel')}}</button>
                  <button type="button" class="btn btn-primary font-weight-bold create_send_form">{{__('cp.add')}}</button>
              </div>
          </div>
      </div>
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
            dom: '<"dt-top-container"<B><"dt-center-in-div"l><f>r>t<"dt-filter-spacer"><ip>',
            buttons: table_btns,
            language: table_language ,
            "aaSorting": [[1,'desc'],[2,'desc']],
            
            "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],
            searching: true,
            "oLanguage": {
                "sSearch": "{{__('cp.search')}}"
            },
            search: {
            "regex": true
        },
    
           ajax: {
            url: "{{url(app()->getLocale().'/admin/deliverynote')}}",
            type: 'GET',
            data : { @foreach (request()->query() as $key => $one) '{{$key}}' : '{{$one}}' , @endforeach}
           },
           columns: [
                { data: 'id', name: 'id'},
                { data: 'Delivery_note', name: 'Delivery_note'},
                {data: 'action', name: 'action', orderable: false},
             ],
          order: [[0, 'desc']]
       
        });
        
        });
        function delete_adv(id, iss_id, e) {
                //alert(id);
                e.preventDefault();
    
    
                var url = '{{url(getLocal()."/admin/deliverynote")}}/' + id;
               
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
                            $('#kt_datatable1').DataTable().ajax.reload();
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
    
     