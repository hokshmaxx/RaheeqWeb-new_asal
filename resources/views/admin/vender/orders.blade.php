@extends('layout.adminLayout')
@section('title') {{$item->name}} / {{__('cp.orders')}}
@endsection
@section('css')
@endsection
@section('content')
    <div class="portlet light bordered">
        <div class="portlet-body">
            <div class="table-toolbar">
                <div class="table-toolbar">

                    <div class="row">
                    <div class="col-sm-9">
                        <div class="btn-group">
                            <a href="{{url(getLocal().'/admin/users')}}" class="btn default">{{__('cp.cancel')}} <i class="fa fa-minus"></i></a>

                        </div>
                    </div>

                </div>

            </div>

                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="toolsTable1">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th> {{ucwords(__('cp.order_id'))}}</th>
                        <th> {{ucwords(__('cp.customer_name'))}}</th>
                        <th> {{ucwords(__('cp.customer_mobile'))}}</th>
                        <th> {{ucwords(__('cp.store'))}}</th>
                        <th> {{ucwords(__('cp.price_total'))}}</th>
                        <th> {{ucwords(__('cp.status'))}}</th>

                        <!--<th> {{ucwords(__('cp.payment_type'))}}</th>-->
                        <th> {{ucwords(__('cp.created'))}}</th>

                        <th> {{ucwords(__('cp.action'))}}</th>

                    </tr>
                    </thead>
                    <tbody>
                    @forelse($orders as $item)
                        <tr class="odd gradeX" id="tr-{{$item->id}}">
                            <td>
                                 {{$loop->iteration}}
                            </td>
                            <td> {{$item->id}}</td>
                            <td> {{@$item->customer_name}}</td>
                            <td> {{@$item->mobile}}</td>

                            <td>{{$item->store->name}}</td>
                            <td>{{$item->total_price}}</td>

                            <td>
                                <?php $status = '';
                                      $cls = '';
                                if($item->status == -1) {
                                    $status = 'new';
                                    $cls    = 'label-danger';
                                }
                                elseif($item->status == 0) {
                                    $status = 'preparing';
                                    $cls    = 'label-info';
                                }
                                elseif ($item->status == 1) {
                                    $status = 'onDelivery';
                                    $cls    = 'label-warning';
                                }
                                else {
                                    $status = 'complete';
                                    $cls    = 'label-success';
                                }
                                ?>
                                <span class="label label-sm {{$cls}}" id="label-{{$item->id}}">
                                {{__('cp.'.$status)}}
                            </span>

                            </td>


                           <!--@if($item->payment_type==1) -->
                           <!--<td>{{__('cp.electronic')}} </td>-->
                           <!--@elseif($item->payment_type==2) -->
                           <!--  <td > {{__('cp.points')}} </td>-->
                           <!--  @else-->
                           <!--   <td @if($item->ordered_date > $item->created_at)  style="color:red;" @endif </td> {{__('cp.Cash_on_delivery')}} </td>-->
                           <!-- @endif-->
                            <td class="center">{{$item->created_at}}</td>

                            <td>

                            <div class="btn-group btn-action">

                                <div class="btn-group btn-action" id="actionId-{{$item->id}}">

                                </div>

                                <a href="{{url(getLocal().'/admin/orders/'.$item->id.'/edit')}}"
                                   class="btn btn-xs blue tooltips" data-container="body" data-placement="top"
                                   data-original-title="{{__('cp.edit')}}"><i class="fa fa-edit"></i>
                                </a>


                               {{-- <a href="#" onclick="openWindow('{{url(getLocal().'/admin/orders/printOrder/'.$item->id)}}')" class="btn btn-xs blue tooltips" data-container="body" data-placement="top"
                                   data-original-title="{{__('cp.print')}}"><i class="fa fa-print"></i>
                                </a> --}}


                            </div>
                            </td>
                        </tr>
                    @empty

                    @endforelse
                    </tbody>
                </table>

                 {{-- $items->appends($_GET)->links() --}}
            </div>
        </div>
        @endsection

        @section('js')
        @endsection
        @section('script')

@endsection
