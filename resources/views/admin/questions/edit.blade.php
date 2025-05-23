@extends('layout.adminLayout')
@section('title') {{__('cp.questions')}}
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
                              style="color: #e02222 !important;">{{__('cp.editquestion')}}</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form method="post" action="{{url(app()->getLocale().'/admin/questions/'.$item->id)}}"
                          enctype="multipart/form-data" class="form-horizontal" role="form" id="form_city">
                        {{ csrf_field() }}
                        {{ method_field('PATCH')}}
                        <div class="form-body">
                            
                            <fieldset>
                        
                                                     
                                                <div class="form-group">
                                                      @foreach($locales as $locale)
                                                    <label class="col-sm-2 control-label" for="question_{{$locale->lang}}">
                                                        {{__('cp.question')}}
                                                        <span class="symbol">*</span>
                                                    </label>
                                                    <div class="col-md-3">
                                                       <input type="text" class="form-control" name="question_{{$locale->lang}}"  id="question_{{$locale->lang}}" value="{{ @$item->translate($locale->lang)->question}}" required>
                                                    </div>
                                                       @endforeach
                                                </div>
                                            
                                            
                                             <div class="form-group">
                                                      @foreach($locales as $locale)
                                                    <label class="col-sm-2 control-label" for="answer_{{$locale->lang}}">
                                                        {{__('cp.answer')}}
                                                        <span class="symbol">*</span>
                                                    </label>
                                                    <div class="col-md-3">
                                                       <textarea class="form-control" name="answer_{{$locale->lang}}"  id="answer_{{$locale->lang}}" rows="7" required>{{ @$item->translate($locale->lang)->answer}}</textarea>
                                                    </div>
                                                       @endforeach
                                                </div>
                                             
                                </fieldset>
                            
                            


                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn green">{{__('cp.submit')}}</button>
                                        <a href="{{url(getLocal().'/admin/questions')}}" class="btn default">{{__('cp.cancel')}}</a>
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

