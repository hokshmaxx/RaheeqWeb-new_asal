@extends('layout.venderLayout')
@section('title') {{ucwords(__('cp.products'))}}
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
                    <h3>{{ucwords(__('cp.products'))}}</h3>
                </div>
            </div>

            <div>
                <div class="btn-group mb-2 m-md-3 mt-md-0 ml-2 ">


                </div>
                <a  href="{{url(getLocal().'/vender/products/create')}}" class="btn btn-secondary  mr-2 btn-success">
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
                            <form class="form-horizontal" method="get" action="{{url(getLocal().'/vender/products')}}">
                                <div class="row">
                                        <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">{{__('cp.name')}}</label>
                                                    <input type="text" class="form-control" name="name"
                                                            placeholder="{{__('cp.name')}}"
                                                            value="{{request('name')?request('name'):''}}">
                                                </div>
                                        </div>

                                        <div class="col-md-3">
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
                                        {{-- <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">{{__('cp.age')}}</label>
                                                <select id="multiple2" class="form-control"
                                                        name="age">

                                                            <option value="">{{__('cp.all')}}</option>
                                                        @foreach ($ages as $age)
                                                            <option value="{{$age->id}}">{{$age->name}}</option>
                                                        @endforeach
                                                </select>
                                            </div>
                                        </div> --}}

                                        <div class="col-md-3">
                                            <button type="submit"
                                                    class="btn sbold btn-default btnSearch">{{__('cp.search')}}
                                                <i class="fa fa-search"></i>
                                            </button>

                                            <a href="{{url(app()->getLocale().'/vender/products')}}" type="submit"
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

                              <th class="wd-5p notExport"> {{ucwords(__('cp.image'))}}</th>
                              <th class="wd-25p"> {{ucwords(__('cp.name'))}}</th>
                              <th class="wd-25p"> {{ucwords(__('cp.category'))}}</th>
                              <!-- <th class="wd-10p"> {{ucwords(__('cp.age'))}}</th> -->
                              <th class="wd-25p"> SKU</th>
                              <th class="wd-25p"> {{ucwords(__('cp.variant'))}}</th>
                              <th class="wd-25p"> {{ucwords(__('cp.price'))}}</th>
                              <th class="wd-25p"> {{ucwords(__('cp.discount_price'))}}</th>
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
        "order": [['id', "desc" ]],
        "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],
        searching: true,
        "oLanguage": {
            "sSearch": "{{__('cp.search')}}"
        },
        search: {
        "regex": true
    },

       ajax: {
        url: "{{url(app()->getLocale().'/vender/products')}}",
        type: 'GET',
        data : { @foreach (request()->query() as $key => $one) '{{$key}}' : '{{$one}}' , @endforeach}
       },
        columns: [
                { data: 'index', name: 'index',orderable: false},
                { data: 'image', name: 'image'},
                { data: 'name', name: 'translations.name' ,orderable: false},
                { data: 'category.name', name: 'category.id',orderable: false},
                // { data: 'age.name', name: 'age.id',orderable: false},
                // { data: 'sku', name: 'sku'},
                // { data: 'price', name: 'price'},
                // { data: 'discount_price', name: 'discount_price'},
            { data: 'variant_sku', name: 'variant_sku' },
            { data: 'variant_name', name: 'variants_name' },
            { data: 'variant_price', name: 'variant_price' },
            { data: 'variant_discount', name: 'variant_discount' },
            { data: 'variant_quantity', name: 'variant_quantity' },

            { data: 'status', name: 'status' },
                { data: 'created_at', name: 'created_at' },
                {data: 'action', name: 'action', orderable: false},
             ],
      order: [[0, 'desc']]

    });

    });


    function delete_adv(id, iss_id, e) {
            e.preventDefault();

            var url = '{{url(getLocal()."/vender/products")}}/' + id;
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
</script>
@endsection

@section('script')

@endsection

