@extends('layout.adminLayout')
@section('title')  {{__('cp.promotion')}}
@endsection
@section('css')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN SAMPLE FORM PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject font-dark sbold uppercase"
                              style="color: #e02222 !important;">{{__('cp.edit')}} {{__('cp.promotion')}}</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form method="post" action="{{url(app()->getLocale().'/admin/promotions/'.$item->id)}}"
                          enctype="multipart/form-data" class="form-horizontal" role="form" id="form_company">
                        {{ csrf_field() }}
                        {{ method_field('PATCH')}}

                        <fieldset>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="order">
                                    {{__('cp.name')}}
                                    <span class="symbol">*</span>
                                </label>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" name="name"
                                           placeholder="{{__('cp.name')}}"  value="{{$item->name}}" required>
                                </div>
                                
                                <label class="col-sm-2 control-label" for="description">
                                    {{__('cp.description')}}
                                </label>
                                <div class="col-md-3">
                                    <textarea  class="form-control" name="description" placeholder="{{__('cp.description')}}">
                                        {{$item->description}}</textarea>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="start">
                                    {{__('cp.start')}}
                                    <span class="symbol">*</span>
                                </label>
                                <div class="col-md-3">
                                    <input type="date" class="form-control" name="start" placeholder="{{__('cp.start')}}"
                                            value="{{$item->start}}" required>
                                </div>
                                
                                   <label class="col-sm-2 control-label" for="end">
                                    {{__('cp.end')}}
                                    <span class="symbol">*</span>
                                </label>
                                <div class="col-md-3">
                                    <input type="date" class="form-control" name="end" placeholder="{{__('cp.end')}}"
                                           value="{{$item->end}}" required>
                                </div>
                            </div>
                        </fieldset>

              
               

                        <fieldset>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="order">
                                    {{__('cp.discount')}} %
                                </label>
                                <div class="col-md-3">
                                    <input   type="text" onkeyup=" if (/\D/g.test(this.value)) this.value = this.value.replace(/[^0-9.]/g,'')"
                                             class="form-control" name="discount" value="{{$item->discount}}" id="order"
                                             placeholder=" {{__('cp.discount')}}" {{ old('discount') }} required>
                                </div>
                            </div>
                        </fieldset>


                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn green">{{__('cp.submit')}}</button>
                                    <a href="{{url(getLocal().'/admin/promotions')}}" class="btn default">{{__('cp.cancel')}}</a>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
@endsection
@section('script')


@endsection
