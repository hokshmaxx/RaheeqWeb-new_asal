@extends('layout.subAdminLayout')
@section('title') {{__('order.order')}}
@endsection
@section('css')
@endsection

@section('content')

    <div class="portlet light bordered">
        <div class="portlet-body">
            <div class="table-toolbar">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="btn-group">
                            <button class="btn sbold red event" id="delete">{{__('common.delete')}}
                                <i class="fa fa-times"></i>
                            </button>
                            <button class="btn sbold blue btn--filter">{{__('common.filter')}}
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>

                </div>
                <div class="box-filter-collapse">
                    <form class="form-horizontal" method="get" action="{{url(getLocal().'/subadmin/orders')}}">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-md-3 control-label">{{__('common.from_date')}}</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
                                            <input type="date" class="form-control pull-right"
                                                   value="{{request('from_date')?request('from_date'):''}}"
                                                   name="from_date" id="from_date">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-md-3 control-label">{{__('common.to_date')}}</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
                                            <input type="date" class="form-control pull-right"
                                                   value="{{request('to_date')?request('to_date'):''}}"
                                                   name="to_date" id="to_date">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-md-3 control-label">{{__('common.status')}}</label>
                                    <div class="col-md-9">
                                        <select class="form-control select2" name="status">
                                            <option {{(isset($_GET['status'])&& $_GET['status'] =='no')?'selected':''}} value="no">{{__('common.all')}}</option>
                                            <option {{(isset($_GET['status'])&& $_GET['status'] ==='1')?'selected':''}} value="1">{{__('common.active')}}</option>
                                            <option {{(isset($_GET['status'])&& $_GET['status'] ==='0')?'selected':''}} value="0"> {{__('common.not_active')}}</option>
                                        </select>
                                    </div>


                                </div>

                            </div>



                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-md-3 control-label">{{__('common.category')}}</label>
                                    <div class="col-md-9">

                                        <select class="form-control select2" name="categories">
                                            <option value="no">{{__('common.all')}}</option>
                                            @foreach($categories as $categoriesItem)
                                                <option @if(isset($_GET['categories']) && $_GET['categories']==$categoriesItem->id) selected  @endif value="{{$categoriesItem->id}}">{{$categoriesItem->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-md-3 control-label">{{__('common.deliveries')}}</label>
                                    <div class="col-md-9">

                                        <select class="form-control select2" name="deliveries">
                                            <option value="no">{{__('common.all')}}</option>
                                            @foreach($deliveryCompany as $deliveryCompanyItem)
                                                <option @if(isset($_GET['deliveries']) && $_GET['deliveries']==$deliveryCompanyItem->id) selected  @endif value="{{$deliveryCompanyItem->id}}">{{$deliveryCompanyItem->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                </div>

                            </div>

                        </div>
                        <div class="row">


                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn sbold blue">{{__('common.search')}}
                                            <i class="fa fa-search"></i>
                                        </button>
                                        <a href="{{url(app()->getLocale().'/subadmin/orders')}}" type="submit"
                                           class="btn sbold btn-default ">{{__('common.reset')}}
                                            <i class="fa fa-refresh"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            <input type="hidden" id="url" value="{{url("/en/subadmin/orders_changeStatus")}}">
            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="toolsTable">
                <thead>
                <tr>
                    <th>

                    </th>
                    <th> {{ucwords(__('common.order_id'))}}</th>
                    <th> {{ucwords(__('common.name'))}}</th>
                    <th> {{ucwords(__('common.company'))}}</th>
                    <th> {{ucwords(__('common.price'))}}</th>
                    <th> {{ucwords(__('bunch.delivery_time'))}}</th>
                    <th> {{ucwords(__('common.status'))}}</th>
                    <th> {{ucwords(__('common.created'))}}</th>
                    <th> {{ucwords(__('common.action'))}}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($items as $item)
                    @if($item->company)
                        <tr class="odd gradeX" id="tr-{{$item->id}}">
                            <td>
                                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                    <input type="checkbox" class="checkboxes chkBox" value="{{$item->id}}" name="chkBox"/>
                                    <span></span>
                                </label>
                            </td>
                            <td>
                                @if($item->id) {{$item->id}} @endif

                            </td>
                            <td>
                                @if($item->username) {{$item->username->name}} @endif

                            </td>
                            <td>
                                @if($item->company) {{$item->company->name}} @endif

                            </td>

                            <td>{{$item->price}}</td>
                            <td>{{$item->delivery_date}}</td>
                            <td>
                                @if($item->status == 0 )
                                    {{__("common.Pending")}}


                                @else
                                    {{__("common.Confirm")}}
                                @endif



                            </td>


                            <td class="center">{{$item->created_at}}</td>
                            <td>
                                <div class="btn-group btn-action">
                                    <a href="{{url(getLocal().'/subadmin/orders/'.$item->id.'/edit')}}"
                                       class="btn btn-xs blue tooltips" data-container="body" data-placement="top"
                                       data-original-title="{{__('common.edit')}}"><i class="fa fa-edit"></i></a>
                                    <a href="#myModal{{$item->id}}" role="button"  data-toggle="modal" class="btn btn-xs red tooltips">
                                        &nbsp;&nbsp;<i class="fa fa-times" aria-hidden="true"></i>
                                    </a>

                                    <div id="myModal{{$item->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h4 class="modal-title">{{__('common.delete')}}</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>{{__('common.confirm')}} </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn default" data-dismiss="modal" aria-hidden="true">{{__('common.cancel')}}</button>
                                                    <a href="#" onclick="delete_adv('{{$item->id}}','{{$item->id}}',event)"><button class="btn btn-danger">{{__('common.delete')}}</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endif
                @empty
                    {{__('common.no')}}
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('js')
@endsection
@section('script')
    <script>

        
         function delete_adv(id,iss_id, e) {
            //alert(id);
            e.preventDefault();
            console.log(id);
            console.log(iss_id);
            var url = '{{url(getLocal()."/subadmin/orders")}}/' + id;
            var csrf_token = '{{csrf_token()}}';
            $.ajax({
                type: 'delete',
                headers: {'X-CSRF-TOKEN': csrf_token},
                url: url,
                data: {_method:'delete'},
                success: function (response) {
                    console.log(response);
                    if (response === 'success') {
                        $('#tr-' + id).hide(500);
                        $('#myModal' + id).modal('toggle');
                        //swal("القضية حذفت!", {icon: "success"});
                    } else {
                        // swal('Error', {icon: "error"});
                    }
                },
                error: function (e) {
                    // swal('exception', {icon: "error"});
                }
            });

        }


    </script>
@endsection
