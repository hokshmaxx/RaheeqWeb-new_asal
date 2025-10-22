@extends('layout.adminLayout')
@section('title') {{ucwords(__('cp.users'))}}
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
                  <h3>{{ucwords(__('cp.users'))}}</h3>
              </div>
          </div>

          <div>
              <div class="btn-group mb-2 m-md-3 mt-md-0 ml-2 ">


                <button type="button" class="btn btn-secondary event" href="#activation" role="button"
                data-toggle="modal">
            <i class="icon-xl la la-check"></i>
            <span>{{__('cp.activation')}}</span>
        </button>

        <button type="button" class="btn btn-secondary event" href="#cancel_activation" role="button"
                data-toggle="modal">
            <i class="icon-xl la la-ban"></i>
            <span>{{__('cp.cancel_activation')}}</span>
        </button>
                  {{-- <button type="button" class="btn btn-secondary" href="#deleteAll" role="button"
                          data-toggle="modal">
                      <i class="flaticon-delete"></i>
                      <span>{{__('cp.delete')}}</span>
                  </button> --}}
              </div>

               <a href="{{url(getLocal().'/admin/exportUsers')}}" class="btn btn-secondary  mr-2 btn-success">
                        <i class="icon-xl la la-file-excel"></i>
                        <span>{{__('cp.export')}}</span>
                    </a>

                    <a href="{{url(getLocal().'/admin/users/create')}}" class="btn btn-secondary  mr-2 btn-success">
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
                  <button type="button" class="btn btn-secondar btn--filter mr-2"><i
                          class="icon-xl la la-sliders-h"></i>{{__('cp.filter')}}</button>
                  <div class="container box-filter-collapse">
                      <div class="card">
                          <form class="form-horizontal" method="get" action="{{url(getLocal().'/admin/users')}}">
                              <div class="row">
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label class="control-label">{{__('cp.first_name')}}</label>
                                          <input type="text" class="form-control" name="first_name"
                                                 placeholder="{{__('cp.first_name')}}"
                                                 value="{{request('first_name')?request('first_name'):''}}">
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label class="control-label">{{__('cp.last_name')}}</label>
                                          <input type="text" class="form-control" name="last_name"
                                                 placeholder="{{__('cp.last_name')}}"
                                                 value="{{request('last_name')?request('last_name'):''}}">
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
                                      <div class="form-group">
                                          <label class="control-label">{{__('cp.status')}}</label>
                                          <select id="multiple2" class="form-control"
                                                  name="status">
                                              <option value="">{{__('cp.all')}}</option>
                                              <option
                                                  value="active" {{request('status') == 'active'?'selected':''}}>
                                                  {{__('cp.active')}}
                                              </option>
                                              <option
                                                  value="not_active" {{request('status') == 'not_active'?'selected':''}}>
                                                  {{__('cp.not_active')}}
                                              </option>
                                          </select>
                                      </div>
                                  </div>

                                  <div class="col-md-4">
                                      <button type="submit"
                                              class="btn sbold btn-default btnSearch">{{__('cp.search')}}
                                          <i class="fa fa-search"></i>
                                      </button>

                                      <a href="{{url(app()->getLocale().'/admin/users')}}" type="submit"
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
                                      <span></span></label>
                              </div>
                          </th>

                              <th class="wd-1p">ID</th>
                              <th class="wd-5p"> {{ucwords(__('cp.image'))}}</th>
                              <th class="wd-25p"> {{ucwords(__('cp.name'))}}</th>
                              <th class="wd-25p"> {{ucwords(__('cp.email'))}}</th>
                              <th class="wd-25p"> {{ucwords(__('cp.mobile'))}}</th>
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
              <div class="modal-body">

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
                                          <select class="form-control form-control-solid" name ="gender" required>
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
              </div>
          </div>
      </div>
    </div>


    @endsection
        @section('js')
            <script>
                $(document).ready(function() {
                    // Init datatable
                    var dataTable = $('#kt_datatable1').DataTable({
                        destroy: true,
                        processing: true,
                        serverSide: true,
                        autoWidth: false,
                        pageLength: 10,
                        dom: '<"dt-top-container"<B><"dt-center-in-div"l><f>r>t<"dt-filter-spacer"><ip>',
                        buttons: table_btns,
                        language: table_language,
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
                            url: "{{url(app()->getLocale().'/admin/users')}}",
                            type: 'GET',
                            data: { @foreach (request()->query() as $key => $one) '{{$key}}' : '{{$one}}' , @endforeach}
                        },
                        columns: [
                            { data: 'index', name: 'index', orderable: false},
                            { data: 'id', name: 'id'},
                            { data: 'image', name: 'image'},
                            { data: 'name', name: 'name'},
                            { data: 'email', name: 'email'},
                            { data: 'mobile', name: 'mobile'},
                            { data: 'status', name: 'status'},
                            { data: 'created_at', name: 'created_at'},
                            { data: 'action', name: 'action', orderable: false},
                        ],
                        order: [[0, 'desc']]
                    });

                    // Delete handler with SweetAlert2 - SAFARI COMPATIBLE
                    $('#kt_datatable1').on('click', '.delete', function(e) {
                        e.preventDefault();
                        e.stopPropagation();

                        // CRITICAL: Clean up any lingering modal backdrops (Safari fix)
                        $('.modal-backdrop').remove();
                        $('body').removeClass('modal-open');
                        $('body').css('overflow', '');

                        var id = $(this).data('id');
                        var url = '{{url(getLocal()."/admin/users")}}/' + id;
                        var csrf_token = '{{csrf_token()}}';

                        // Show SweetAlert2 confirmation
                        {{--Swal.fire({--}}
                        {{--    title: '{{__("cp.are_you_sure")}}',--}}
                        {{--    text: '{{__("cp.you_wont_be_able_to_revert_this")}}',--}}
                        {{--    icon: 'warning',--}}
                        {{--    showCancelButton: true,--}}
                        {{--    confirmButtonColor: '#d33',--}}
                        {{--    cancelButtonColor: '#3085d6',--}}
                        {{--    --}}{{--confirmButtonText: '{{__("cp.yes_delete_it")}}',--}}
                        {{--    --}}{{--cancelButtonText: '{{__("cp.cancel")}}',--}}
                        {{--    customClass: {--}}
                        {{--        container: 'swal-safari-fix'--}}
                        {{--    }--}}
                        {{--}).then((result) => {--}}
                        {{--    if (result.isConfirmed) {--}}
                        {{--        // Show loading state--}}
                        {{--        Swal.fire({--}}
                        {{--            title: '{{__("cp.deleting")}}',--}}
                        {{--            text: '{{__("cp.please_wait")}}',--}}
                        {{--            allowOutsideClick: false,--}}
                        {{--            allowEscapeKey: false,--}}
                        {{--            didOpen: () => {--}}
                        {{--                Swal.showLoading();--}}
                        {{--            }--}}
                        {{--        });--}}

                        {{--        // Perform delete--}}
                        {{--        $.ajax({--}}
                        {{--            type: 'DELETE',--}}
                        {{--            headers: {'X-CSRF-TOKEN': csrf_token},--}}
                        {{--            url: url,--}}
                        {{--            data: {_method: 'delete'},--}}
                        {{--            success: function (response) {--}}
                        {{--                if (response === 'success' || response.status === 'success') {--}}
                        {{--                    // Success message--}}
                        {{--                    Swal.fire({--}}
                        {{--                        icon: 'success',--}}
                        {{--                        title: '{{__("cp.deleted")}}',--}}
                        {{--                        text: '{{__("cp.record_deleted_successfully")}}',--}}
                        {{--                        timer: 2000,--}}
                        {{--                        showConfirmButton: false--}}
                        {{--                    });--}}

                        {{--                    // Hide row and reload table--}}
                        {{--                    $('#tr-' + id).fadeOut(500, function() {--}}
                        {{--                        $('#kt_datatable1').DataTable().ajax.reload(null, false);--}}
                        {{--                    });--}}
                        {{--                } else {--}}
                        {{--                    // Error from server--}}
                        {{--                    Swal.fire({--}}
                        {{--                        icon: 'error',--}}
                        {{--                        title: '{{__("cp.error")}}',--}}
                        {{--                        text: response.message || '{{__("cp.something_went_wrong")}}'--}}
                        {{--                    });--}}
                        {{--                }--}}
                        {{--            },--}}
                        {{--            error: function (xhr, status, error) {--}}
                        {{--                // AJAX error--}}
                        {{--                Swal.fire({--}}
                        {{--                    icon: 'error',--}}
                        {{--                    title: '{{__("cp.error")}}',--}}
                        {{--                    text: '{{__("cp.something_went_wrong")}}',--}}
                        {{--                    footer: 'Error: ' + error--}}
                        {{--                });--}}
                        {{--                console.error('Delete error:', error);--}}
                        {{--            }--}}
                        {{--        });--}}
                        {{--    }--}}
                        {{--});--}}
                    });
                });

                // ALTERNATIVE: delete_adv function with SweetAlert2
                function delete_adv(id, iss_id, e) {
                    if (e) {
                        e.preventDefault();
                        e.stopPropagation();
                    }

                    // Clean up modal backdrops
                    $('.modal-backdrop').remove();
                    $('body').removeClass('modal-open');
                    $('body').css('overflow', '');

                    var url = '{{url(getLocal()."/admin/users")}}/' + id;
                    var csrf_token = '{{csrf_token()}}';

                    // Show SweetAlert2 confirmation
                    Swal.fire({
                        title: '{{__("cp.are_you_sure")}}',
                        text: '{{__("cp.you_wont_be_able_to_revert_this")}}',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: '{{__("cp.yes_delete_it")}}',
                        cancelButtonText: '{{__("cp.cancel")}}'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: '{{__("cp.deleting")}}',
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });

                            $.ajax({
                                type: 'DELETE',
                                headers: {'X-CSRF-TOKEN': csrf_token},
                                url: url,
                                data: {_method: 'delete'},
                                success: function (response) {
                                    if (response === 'success' || response.status === 'success') {
                                        Swal.fire({
                                            icon: 'success',
                                            title: '{{__("cp.deleted")}}',
                                            text: '{{__("cp.record_deleted_successfully")}}',
                                            timer: 2000,
                                            showConfirmButton: false
                                        });
                                        $('#tr-' + id).fadeOut(500);
                                        $('#kt_datatable1').DataTable().ajax.reload(null, false);
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: '{{__("cp.error")}}',
                                            text: response.message || '{{__("cp.something_went_wrong")}}'
                                        });
                                    }
                                },
                                error: function (xhr, status, error) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: '{{__("cp.error")}}',
                                        text: '{{__("cp.something_went_wrong")}}'
                                    });
                                }
                            });
                        }
                    });
                }
            </script>
        @endsection

    @section('script')

    @endsection

