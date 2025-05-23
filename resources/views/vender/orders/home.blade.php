@extends('layout.venderLayout')
@section('title') {{ucwords(__('cp.orders'))}}
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
                  <h3>{{ucwords(__('cp.orders'))}}</h3>
              </div>
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
                  <button type="button" class="btn btn-secondar btn--filter mr-2"><i
                        class="icon-xl la la-sliders-h"></i>{{__('cp.filter')}}</button>
                  <div class="container box-filter-collapse">
                      <div class="card">
                          <form class="form-horizontal" method="get" action="{{url(getLocal().'/vender/orders')}}">
                              <div class="row">
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label class="control-label">{{__('cp.name')}}</label>
                                          <input type="text" class="form-control" name="userName"
                                                 placeholder="{{__('cp.name')}}"
                                                 value="{{request('name')?request('name'):''}}">
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label class="control-label">{{__('cp.email')}}</label>
                                          <input type="email" class="form-control" name="email"
                                                 placeholder="{{__('cp.email')}}"
                                                 value="{{request('email')?request('email'):''}}">
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label class="control-label">{{__('cp.mobile')}}</label>
                                          <input
                                              onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
                                              type="text" class="form-control" name="mobile"
                                              placeholder="{{__('cp.mobile')}}"
                                              value="{{request('mobile')?request('mobile'):''}}">
                                      </div>
                                  </div>

                                  <div class="col-md-4">
                                    <div class="form-group ">
                                        <label class="control-label">{{__('cp.area')}}</label>
                                            <select id="multiple2" class="form-control"
                                                    name="area_id">
                                        
                                                <option value="">{{__('cp.all')}}</option>
                                                @foreach($areas as $area)
                                                   <option value="{{$area->id}}" {{request('area_id') == $area->id?'selected':''}}>{{$area->name}}</option>
                                               @endforeach
                                            </select>
                                    </div>
                                </div>

                                  <div class="col-md-4">
                                      <button type="submit"
                                              class="btn sbold btn-default btnSearch">{{__('cp.search')}}
                                          <i class="fa fa-search"></i>
                                      </button>

                                      <a href="{{url(app()->getLocale().'/vender/orders')}}" type="submit"
                                         class="btn sbold btn-default btnRest">{{__('cp.reset')}}
                                          <i class="fa fa-refresh"></i>
                                      </a>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>
                  <div
                      class="card-header d-flex flex-column flex-sm-row align-items-sm-start justify-content-sm-between">
                      <div>


                      </div>

                  </div>
                  <div class="table-responsive">
                    <table class="table table-bordered table-hover table-checkable"  style="margin-top: 13px !important" id="kt_datatable1">
                      {{-- <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important"> --}}
                        <thead>
                          <tr>
                                <th class="wd-1p no-sort">
                                    <div class="checkbox-inline">
                                        <label class="checkbox">
                                            <input type="checkbox" name="checkAll"/>
                                            <span></span>
                                        </label>
                                    </div>
                                </th> 
                                <th class="wd-1p">
                                #
                                </th>
                                <th class="wd-25p"> {{ucwords(__('cp.name'))}}</th>
                                <th class="wd-25p"> {{ucwords(__('cp.email'))}}</th>
                                <th class="wd-25p"> {{ucwords(__('cp.total'))}}</th>
                                <th class="wd-10p"> {{ucwords(__('cp.status'))}}</th>
                                <th class="wd-10p"> {{ucwords(__('cp.created'))}}</th>
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
          {{-- <div class="modal-body">
              
              <div class="add-employee-form">
                  <form class="create_form" action="index.html">
                      @csrf
                     
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>{{__('cp.name')}}</label>
                                  <input type="text" class="form-control form-control-solid" name="name" 
                                      value="{{ old('name') }}" required />
                              </div>
                          </div>

                            <div class="col-md-6">
                                  <div class="form-group ">
                                      <label>{{__('cp.gender')}}</label>
                                      <select class="form-control form-control-solid" name ="gender">
                                          <option value="">{{__('cp.select')}}</option>
                                             <option value="1">{{__('cp.male')}}</option>
                                             <option value="2">{{__('cp.female')}}</option>
                     
                                      </select>
                                  </div>
                             </div>
                      
                      </div>
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>{{__('cp.email')}}</label>
                                  <input type="email" class="form-control form-control-solid" name="email" 
                                      value="{{ old('email') }}" required />
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>{{__('cp.mobile')}}</label>
                                  <input type="mobile" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="form-control form-control-solid" name="mobile" 
                                      value="{{ old('mobile') }}" required />
                              </div>
                          </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('cp.password')}}</label>
                                <input type="password" class="form-control form-control-solid" name="password" 
                                    value="{{ old('password') }}" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('cp.confirm_password')}}</label>
                                <input type="password" class="form-control form-control-solid" name="confirm_password" 
                                    value="{{ old('confirm_password') }}" required />
                            </div>
                        </div>
                    </div>

                  </form>
              </div>
          </div> 
          <div class="modal-footer">
              <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{__('cp.cancel')}}</button>
              <button type="button" class="btn btn-primary font-weight-bold create_send_form">{{__('cp.add')}}</button>
          </div>--}}
      </div>
  </div>
</div>


@endsection
@section('js')
<script>
    $(document).ready(function() {
        
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
            search: {
            "regex": true
        },
            ajax: {
                url: "{{url(app()->getLocale().'/vender/orders')}}",
                type: 'GET',
                data : {@foreach (request()->all() as $key => $one) '{{$key}}' : '{{$one}}' , @endforeach }
            },
        
            columns: [

                    { data: 'index', name: 'index', orderable: false},
                    
                    { data: 'id', name: 'id'},
                    { data: 'name', name: 'name'},
                    { data: 'email', name: 'email'},
                    // { data: 'age.name', name: 'age.name' , orderable: false, searchable: false},
                    { data: 'total', name: 'total' },
                    { data: 'status', name: 'status' },
                    { data: 'created_at', name: 'created_at'},
                    { data: 'action', name: 'action', orderable: false},
                ],
        order: [[0, 'desc']]
        });
    
    });

    function delete_adv(id, iss_id, e) {
        //alert(id);
        e.preventDefault();

        var url = '{{url(getLocal()."/vender/orders")}}/' + id;
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
                        swal('Error', {icon: "error"});
                }
            },
            error: function (e) {
            }
        });
    }

    function openWindow($url)
    {
        window.open($url, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=200,left=200,width=800,height=700");
    }
</script>
@endsection

@section('script')

@endsection

 