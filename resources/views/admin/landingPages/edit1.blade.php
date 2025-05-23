@extends('layout.adminLayout')
@section('title') {{__('cp.landingPage')}}
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
                    <form method="post" action="{{url(app()->getLocale().'/admin/landingPage/'.$item->id)}}"
                          enctype="multipart/form-data" class="form-horizontal" role="form" id="form">
                        {{ csrf_field() }}
                        {{ method_field('PATCH')}}
                        <div class="form-body">


                    
                            <fieldset >
                                @foreach($locales as $locale)
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="order">
                                            {{__('cp.download_app_text_'.$locale->lang)}}
                                            <span class="symbol">*</span>
                                        </label>
                                        <div class="col-md-6">
                                             <textarea class="form-control" name="download_app_text_{{$locale->lang}}" id="order" required
                                                  >{{ old('download_app_text_'.$locale->lang, $item->translate($locale->lang)->download_app_text) }}</textarea>

                                        </div>
                                    </div>
                                @endforeach
                            </fieldset>
                            <legend>{{__('cp.about_app')}}</legend>
                            <fieldset >
                                @foreach($locales as $locale)
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="order">
                                            {{__('cp.about_app_'.$locale->lang)}}
                                            <span class="symbol">*</span>
                                        </label>
                                        <div class="col-md-6">
                                             <textarea class="form-control" name="about_app_{{$locale->lang}}" id="order" required
                                                  >{{ old('about_app_'.$locale->lang, $item->translate($locale->lang)->about_app) }}</textarea>

                                        </div>
                                    </div>
                                @endforeach
                                
                                @foreach($locales as $locale)
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="order">
                                            {{__('cp.why_best_text_'.$locale->lang)}}
                                            <span class="symbol">*</span>
                                        </label>
                                        <div class="col-md-6">
                                             <textarea class="form-control" name="why_best_text_{{$locale->lang}}" id="order" required
                                                  >{{ old('why_best_text_'.$locale->lang, $item->translate($locale->lang)->why_best_text) }}</textarea>

                                        </div>
                                    </div>
                                @endforeach
                                @foreach($locales as $locale)
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="order">
                                            {{__('cp.why_best1_'.$locale->lang)}}
                                            <span class="symbol">*</span>
                                        </label>
                                        <div class="col-md-6">
                                             <textarea class="form-control" name="why_best1_{{$locale->lang}}" id="order" required
                                                  >{{ old('why_best1_'.$locale->lang, $item->translate($locale->lang)->why_best1) }}</textarea>

                                        </div>
                                    </div>
                                @endforeach
                                @foreach($locales as $locale)
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="order">
                                            {{__('cp.why_best2_'.$locale->lang)}}
                                            <span class="symbol">*</span>
                                        </label>
                                        <div class="col-md-6">
                                             <textarea class="form-control" name="why_best2_{{$locale->lang}}" id="order" required
                                                  >{{ old('why_best2_'.$locale->lang, $item->translate($locale->lang)->why_best2) }}</textarea>

                                        </div>
                                    </div>
                                @endforeach
                                @foreach($locales as $locale)
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="order">
                                            {{__('cp.why_best3_'.$locale->lang)}}
                                            <span class="symbol">*</span>
                                        </label>
                                        <div class="col-md-6">
                                             <textarea class="form-control" name="why_best3_{{$locale->lang}}" id="order" required
                                                  >{{ old('why_best3_'.$locale->lang, $item->translate($locale->lang)->why_best3) }}</textarea>

                                        </div>
                                    </div>
                                @endforeach
                            </fieldset>
                            
                         <legend>{{__('cp.expectations')}}</legend>
                            <fieldset >
                                @foreach($locales as $locale)
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="order">
                                            {{__('cp.expectations_'.$locale->lang)}}
                                            <span class="symbol">*</span>
                                        </label>
                                        <div class="col-md-6">
                                             <textarea class="form-control" name="expectations_{{$locale->lang}}" id="order" required
                                                  >{{ old('expectations_'.$locale->lang, $item->translate($locale->lang)->expectations) }}</textarea>

                                        </div>
                                    </div>
                                @endforeach
                            </fieldset>
                            <legend>{{__('cp.ranking')}}</legend>
                            
                            <fieldset >
                                @foreach($locales as $locale)
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="order">
                                            {{__('cp.ranking_'.$locale->lang)}}
                                            <span class="symbol">*</span>
                                        </label>
                                        <div class="col-md-6">
                                             <textarea class="form-control" name="ranking_{{$locale->lang}}" id="order" required
                                                  >{{ old('ranking_'.$locale->lang, $item->translate($locale->lang)->ranking) }}</textarea>

                                        </div>
                                    </div>
                                @endforeach
                            </fieldset>
                            <legend>{{__('cp.champions')}}</legend>
                            <fieldset >
                                @foreach($locales as $locale)
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="order">
                                            {{__('cp.champions_'.$locale->lang)}}
                                            <span class="symbol">*</span>
                                        </label>
                                        <div class="col-md-6">
                                             <textarea class="form-control" name="champions_{{$locale->lang}}" id="order" required
                                                  >{{ old('champions_'.$locale->lang, $item->translate($locale->lang)->champions) }}</textarea>

                                        </div>
                                    </div>
                                @endforeach
                            </fieldset>
                            <legend>{{__('cp.statistics')}}</legend>
                            
                            <fieldset >
                                @foreach($locales as $locale)
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="order">
                                            {{__('cp.statistics_'.$locale->lang)}}
                                            <span class="symbol">*</span>
                                        </label>
                                        <div class="col-md-6">
                                             <textarea class="form-control" name="statistics_{{$locale->lang}}" id="order" required
                                                  >{{ old('statistics_'.$locale->lang, $item->translate($locale->lang)->statistics) }}</textarea>

                                        </div>
                                    </div>
                                @endforeach
                            </fieldset>
                            <br>
                            <fieldset >
                                @foreach($locales as $locale)
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="order">
                                            {{__('cp.user_say_text_'.$locale->lang)}}
                                            <span class="symbol">*</span>
                                        </label>
                                        <div class="col-md-6">
                                             <textarea class="form-control" name="user_say_text_{{$locale->lang}}" id="order" required
                                                  >{{ old('user_say_text_'.$locale->lang, $item->translate($locale->lang)->user_say_text) }}</textarea>

                                        </div>
                                    </div>
                                @endforeach
                            </fieldset>
                            <fieldset >
                                @foreach($locales as $locale)
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="order">
                                            {{__('cp.screenshots_text_'.$locale->lang)}}
                                            <span class="symbol">*</span>
                                        </label>
                                        <div class="col-md-6">
                                             <textarea class="form-control" name="screenshots_text_{{$locale->lang}}" id="order" required
                                                  >{{ old('screenshots_text_'.$locale->lang, $item->translate($locale->lang)->screenshots_text) }}</textarea>

                                        </div>
                                    </div>
                                @endforeach
                            </fieldset>
          

                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn green">{{__('cp.edit')}}</button>
                                        <a href="{{url(getLocal().'/admin/home')}}" class="btn default">{{__('cp.cancel')}}</a>
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

@section('script')
@endsection

