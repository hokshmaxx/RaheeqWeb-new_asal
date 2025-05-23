@extends('layout.adminLayout')
@section('title') {{ucwords(__('cp.posts'))}}
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
                  <h3>{{ucwords(__('cp.posts'))}}</h3>
              </div>
          </div>

          <div>
              {{--
                 <div class="btn-group mb-2 m-md-3 mt-md-0 ml-2 ">
                  <button type="button" class="btn btn-secondary event" href="#activation" role="button"
                          data-toggle="modal">
                      <i class="icon-xl la la-check"></i>
                      <span>{{__('cp.active')}}</span>
                  </button>

                  <button type="button" class="btn btn-secondary event" href="#cancel_activation" role="button"
                          data-toggle="modal">
                      <i class="icon-xl la la-ban"></i>
                      <span>{{__('cp.not_active')}}</span>
                  </button>
                
              </div>
               --}}
              {{-- <a data-target="#basicModal" data-toggle="modal" class="btn btn-secondary  mr-2 btn-success">
                  <i class="icon-xl la la-plus"></i>
                  <span>{{__('cp.add')}}</span>
              </a> --}}
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
                          <form class="form-horizontal" method="get" action="{{url(getLocal().'/admin/posts')}}">
                              <div class="row">
                                  <div class="col-md-3">
                                      <div class="form-group">
                                          <label class="control-label">{{__('cp.name')}}</label>
                                          <input type="text" class="form-control form-control-solid" name="name"
                                                 placeholder="{{__('cp.name')}}"
                                                 value="{{request('name')?request('name'):''}}">
                                      </div>
                                  </div>

                                  <div class="col-md-3">
                                    <div class="form-group ">
                                        <label class="control-label">{{__('cp.type')}}</label>
                                            <select id="multiple2" class="form-control form-control-solid"
                                                    name="type">
                                                <option value="">{{__('cp.all')}}</option>
                                                <option value="1" @if(request('type') == 1 ) selected @endif>{{__('cp.user')}}</option>
                                                <option value="2" @if(request('type') == 2 ) selected @endif>{{__('cp.showroom')}}</option>
                                            </select>
                                    </div>
                                </div>

                                  <div class="col-md-3">
                                      <div class="form-group">
                                          <label class="control-label">{{__('cp.year')}}</label>
                                          <input
                                              onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
                                              type="text" class="form-control form-control-solid" name="year"
                                              placeholder="{{__('cp.year')}}"
                                              value="{{request('year')?request('year'):''}}">
                                      </div>
                                  </div>
                                  <div class="col-md-3">
                                      <div class="form-group">
                                          <label class="control-label">{{__('cp.price')}}</label>
                                          <input
                                              onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
                                              type="text" class="form-control form-control-solid" name="price"
                                              placeholder="{{__('cp.price')}}"
                                              value="{{request('price')?request('price'):''}}">
                                      </div>
                                  </div>

                                  <div class="col-md-3">
                                    <div class="form-group ">
                                        <label class="control-label">{{__('cp.brand')}}</label>
                                            <select id="multiple2" class="form-control form-control-solid"
                                                    name="brand_id">
                                                  <option value="">{{__('cp.all')}}</option>
                                                @foreach ($brands as $item)
                                                  <option value="{{$item->id}}" @if(request('type') == $item->id ) selected @endif>{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                </div>
                                  <div class="col-md-3">
                                    <div class="form-group ">
                                        <label class="control-label">{{__('cp.model')}}</label>
                                            <select id="multiple2" class="form-control form-control-solid"
                                                    name="model_id">
                                                  <option value="">{{__('cp.all')}}</option>
                                                @foreach ($models as $item)
                                                  <option value="{{$item->id}}" @if(request('type') == $item->id ) selected @endif>{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                </div>

                                  <div class="col-md-3">
                                      <button type="submit"
                                              class="btn sbold btn-default btnSearch">{{__('cp.search')}}
                                          <i class="fa fa-search"></i>
                                      </button>

                                      <a href="{{url(app()->getLocale().'/admin/posts')}}" type="submit"
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
                            <th class="wd-1p">
                               #
                          </th>

                               <th class="wd-25p"> {{ucwords(__('cp.description'))}}</th>
                              <th class="wd-25p"> {{ucwords(__('cp.user'))}}</th>
                              <th class="wd-25p"> {{ucwords(__('cp.type'))}}</th>
                              <th class="wd-25p"> {{ucwords(__('cp.brand'))}}</th>
                              <th class="wd-25p"> {{ucwords(__('cp.model'))}}</th>
                              <th class="wd-25p"> {{ucwords(__('cp.year'))}}</th>
                              <th class="wd-25p"> {{ucwords(__('cp.price'))}}</th>
                              <th class="wd-25p"> {{ucwords(__('cp.doors_count'))}}</th>
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
        url: "{{url(app()->getLocale().'/admin/posts')}}",
        type: 'GET',
        data : { @foreach (request()->query() as $key => $one) '{{$key}}' : '{{$one}}' , @endforeach}
       },
        columns: [
                { data: 'id', name: 'id'},
                 { data: 'description', name: 'description'},
                { data: 'user.first_name', name: 'user.first_name'},
                { data: 'type', name: 'type'},
                { data: 'brand.name', name: 'brand.name', orderable: false, searchable: false},
                { data: 'model.name', name: 'model.name' , orderable: false, searchable: false},
                { data: 'year', name: 'year' },
                { data: 'asking_price', name: 'asking_price' },
                { data: 'doors_count', name: 'doors_count' },
                { data: 'status', name: 'status' },
                { data: 'created_at', name: 'created_at' },
                {data: 'action', name: 'action', orderable: false},
             ],
      order: [[0, 'desc']]
   
    });
    
    });

 

    function delete_adv(id, iss_id, e) {
            //alert(id);
            e.preventDefault();

            var url = '{{url(getLocal()."/admin/posts")}}/' + id;
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
        
                        function openWindow($url)
        {
            window.open($url, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=200,left=200,width=800,height=700");
        }
</script>
@endsection

@section('script')

@endsection

 