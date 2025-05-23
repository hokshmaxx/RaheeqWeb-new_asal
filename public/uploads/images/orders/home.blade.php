@extends('layout.subAdminLayout')
@section('title') {{ucwords(__('cp.orders'))}}
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
                        <h3>{{ucwords(__('cp.orders'))}}</h3>
                    </div>
                </div>
                <!--end::Info-->
                <!--begin::Toolbar-->


                <div class="btn-group mb-2 m-md-3 mt-md-0 ml-2 ">
       <button  type="button" class="btn btn-info has-icon sbold btn--filter">{{__('cp.filter')}}<i class="fa fa-search"></i></button>
                    <!--<a href="{{url(getLocal().'/Stores_Portal/products/create')}}" style="margin-right: 5px"-->
                    <!--   class="btn btn-success"><i class="fa fa-plus"></i>{{__('cp.add')}}-->
                    <!--</a>-->

                    <!--<button type="button" class="btn btn-default has-icon" href="#activation" role="button"-->
                    <!--        data-toggle="modal">-->
                    <!--    <i class="fas fa-check"></i>-->
                    <!--    <span>{{__('cp.active')}}</span>-->
                    <!--</button>-->
                    <!--<button type="button" class="btn btn-default  has-icon " href="#cancel_activation" role="button"-->
                    <!--        data-toggle="modal">-->
                    <!--    <i class="fas fa-na"></i>-->
                    <!--    <span>{{__('cp.not_active')}}</span>-->
                    <!--</button>-->
                    <!--<button type="button" class="btn btn-default  has-icon " href="#deleteAll" role="button"-->
                    <!--        data-toggle="modal">-->
                    <!--    <i class="fas fa-trash"></i>-->
                    <!--    <span>{{__('cp.delete')}}</span>-->
                    <!--</button>-->
                </div>
	
                <!--end::Toolbar-->
            </div>
        </div>
        <!--end::Subheader-->
      	 <div class="container   box-filter-collapse" >
						 <div class="card" >
                              <form class="form-horizontal" method="get" action="{{url(getLocal().'/Stores_Portal/orders')}}">
                                <div class="row">
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">{{__('cp.order_id')}}</label>
                                           <input type="text" class="form-control" name="order_id"  placeholder="{{__('cp.order_id')}}"
                                          value="{{request('order_id')?request('order_id'):''}}">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">{{__('cp.total')}}</label>
                                            <input type="text" class="form-control" name="total"  placeholder="{{__('cp.total')}}"
                                          value="{{request('total')?request('total'):''}}">
                                        </div>
                                    </div>
                                    
                                       <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">{{__('cp.ReqDate')}}</label>
                                            <input type="date" class="form-control pull-right"
                                                   value="{{request('created_at')?request('created_at'):''}}"
                                                   name="created_at" id="created_at">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">{{__('cp.ReqStatus')}}</label>
                                              <select id="multiple2" class="form-control"
                                                name="status">
                                            <option value="">{{__('cp.all')}}</option>
                                            <option value="-1" {{request('status') == '-1'?'selected':''}}>
                                                {{__('api.new')}}
                                            </option>
                                            <option value="0" {{request('status') == '0'?'selected':''}}>
                                                {{__('api.preparing')}}
                                            </option>
                                            <option value="1" {{request('status') == '1'?'selected':''}}>
                                                {{__('api.on_way')}}
                                            </option>
                                            <option value="2" {{request('status') == '2'?'selected':''}}>
                                                {{__('api.completed')}}
                                            </option>
                                        </select>
                                        </div>
                                    </div>
                                
                                  
                                    <div class="col-md-6">
                                        <button type="submit" class="btn sbold btn-default btnSearch">{{__('cp.search')}}
                                            <i class="fa fa-search"></i>
                                        </button>
            
                                        <a href="{{url(getLocal().'/Stores_Portal/orders')}}" type="submit" class="btn sbold btn-default btnRest">{{__('cp.reset')}}
                                            <i class="fa fa-refresh"></i>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        </div>
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Card-->
                <div class="gutter-b example example-compact">
                    <div class="contentTabel">
                        <div
                            class="card-header d-flex flex-column flex-sm-row align-items-sm-start justify-content-sm-between">
                            <div>


                            </div>
                       
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover tableWithSearch" id="tableWithSearch">
                                <thead>
                                <tr>
                                    <th class="wd-1p no-sort">
                                      #
                                    </th>

                                  	<th >{{__('cp.order_id')}}</th>
									<th >{{__('cp.total')}}</th>
									<th >{{__('cp.ReqStatus')}}</th>
									<th >{{__('cp.ReqDate')}}</th>
									<th >{{__('cp.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse(@$items as $ad)
                                   
                                       
                                        <td> {{ $loop->iteration }}</td>
                                        <td>{{$ad->id}}</td>
                                        <td>{{$ad->total}}</td>
                                        <td>{{$ad->status_name}}</td>
                                        <td>{{$ad->created_at}}</td>
                                       

                                     

                                        <td>
                                            <div class="btn-group btn-action">
                                                <a href="{{url(getLocal().'/Stores_Portal/orders/'.$ad->id.'/edit')}}"
                                                        class="btn btn-sm btn-clean btn-icon" title="{{__('cp.edit')}}">
                                                          <i class="la la-edit"></i>
                                                        </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    {{__('cp.no')}}
                                @endforelse
                                </tbody>
                            </table>
                            {{$items->appends($_GET)->links("pagination::bootstrap-4") }}  
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

@endsection

@section('script')
    <script>
        function delete_adv(id, iss_id, e) {
            //alert(id);
            e.preventDefault();

            var url = '{{url(getLocal()."/admin/ads")}}/' + id;
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
