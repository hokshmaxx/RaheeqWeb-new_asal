@extends('layout.adminLayout')
@section('title') {{__('cp.nationalities')}}
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
                              style="color: #e02222 !important;">{{__('cp.edit')}}</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form method="post" action="{{url(app()->getLocale().'/admin/nationalities/'.$item->id)}}"
                          enctype="multipart/form-data" class="form-horizontal" role="form" id="form">
                        {{ csrf_field() }}
                        {{ method_field('PATCH')}}


                        <div class="form-body">
                            
                            <fieldset>
                                <legend>{{__('cp.main_info')}}</legend>
                                
                                
                                <div class="tabbable-custom ">
                                        <ul class="nav nav-tabs ">
                                            @foreach($locales as $locale)
                                            <li {{($locale->lang == 'en') ? "class=active" : '' }}>
                                                <a href="#tab_{{$locale->lang}}" data-toggle="tab">{{__('cp.lable_'.$locale->lang)}}</a>
                                            </li>
                                            @endforeach
                                            
                                        </ul>
                                        <div class="tab-content">
                                            @foreach($locales as $locale)
                                            <div class="tab-pane {{($locale->lang == 'en') ? 'active' : '' }}" id="tab_{{$locale->lang}}">
                                                
                                                <div class="form-group">
                                                    
                                                    <label class="col-sm-2 control-label" for="question_{{$locale->lang}}">
                                                        {{__('cp.name')}}
                                                        <span class="symbol">*</span>
                                                    </label>
                                                    <div class="col-md-6">
                                                      <input  type="text" class="form-control" {{($locale->lang == 'ar') ? 'dir=rtl' :'' }} name="name_{{$locale->lang}}" value="{{$item->translate($locale->lang)->name}}" id="order" required>
                                                    </div>
                                                    
                                                </div>
                                               
                                            </div>
                                            
                                            
                                            @endforeach
                                            
                                        </div>
                                    </div>
                                </fieldset>
                                
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn green">{{__('cp.submit')}}</button>
                                        <a href="{{url(getLocal().'/admin/nationalities')}}" class="btn default">{{__('cp.cancel')}}</a>
                                    </div>
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
