@extends('layout.venderLayout')
@section('title') {{ucwords(__('cp.products'))}}
@endsection
@section('css')
@endsection
@section('content')
<div class="portlet light bordered">
<form class="form-horizontal" method="post" action=""  enctype="multipart/form-data" id="driver_create">

    <div class="box-body">
  



        
        
         <fieldset>
                          
                                    <div class="form-group">

                                        <label class="col-sm-2 control-label" for="order">

                                            {{__('cp.logs')}}
                                            <span class="symbol">*</span>
                                        </label>

                                        <div class="col-md-6">

                                                <textarea class="form-control" rows="20" disabled>{{ $item->edit_logs }} </textarea>

                                           

                                        </div>
                                    </div>
                          
                            </fieldset>
        
        <div class="form-actions">
                                <div class="row">
                                  <div class="col-md-12">
                                        <a href="{{url(getLocal().'/vender/products')}}" class="btn default">{{__('cp.cancel')}}</a>
                                    </div>
                                </div>
                            </div>
    </div>
</form>
</div>
@endsection

@section('js')
@endsection
@section('script')

@endsection
