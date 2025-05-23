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
                              style="color: #e02222 !important;">{{__('cp.add')}}</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form method="post" action="{{url(app()->getLocale().'/admin/landingPage')}}"
                          enctype="multipart/form-data" class="form-horizontal" role="form" id="form">
                        {{ csrf_field() }}

                        <div class="form-body">
                             

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
                                                  >{{ old('expectations_'.$locale->lang) }}</textarea>

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
                                                  >{{ old('ranking_'.$locale->lang) }}</textarea>

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
                                                  >{{ old('champions_'.$locale->lang) }}</textarea>

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
                                                  >{{ old('statistics_'.$locale->lang) }}</textarea>

                                        </div>
                                    </div>
                                @endforeach
                            </fieldset>
          

                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn green">{{__('cp.add')}}</button>
                                        <a href="{{url(getLocal().'/admin/landingPage')}}" class="btn default">{{__('cp.cancel')}}</a>
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

    <script>

        $('#edit_image').on('change', function (e) {

            readURL(this, $('#editImage'));

        });



    </script>





    <script>
        //   $('#type').on('change', function() {
        //     var gover = this.value ;
        //     sessionStorage.setItem("type",  this.value)
        //     if(gover == 1){
        //         $('#gover_option').removeClass('hidden');
        //         $('#options').prop('required',true);
        //     }else{
        //         $('#gover_option').addClass('hidden');
        //       $('#options').prop('required',false);
        //     }
        // });






   


    </script>

@endsection

