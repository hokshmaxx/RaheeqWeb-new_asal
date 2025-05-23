@extends('layout.adminLayout')
@section('title') {{__('cp.ads')}}
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
                              style="color: #e02222 !important;">{{__('cp.addAd')}}</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form method="post" action="{{url(app()->getLocale().'/admin/ads')}}"
                          enctype="multipart/form-data" class="form-horizontal" role="form" id="form">
                        {{ csrf_field() }}
                        
                
                                
                                
                                <fieldset>
                                <legend>{{__('cp.main_info')}}</legend>
                                
                                    <div class="form-group">
                                        @foreach($locales as $locale)
                                        
                                        <label class="col-sm-2 control-label" for="details_{{$locale->lang}}">
                                            {{__('cp.description_'.$locale->lang)}}
                                            <span class="symbol">*</span>
                                        </label>
                                        <div class="col-md-3">
                                            <textarea class="form-control" {{($locale->lang == 'ar') ? 'dir=rtl' :'' }} name="details_{{$locale->lang}}" id="details_{{$locale->lang}}" rows="4" required>{{ old('details_'.$locale->lang) }}</textarea>
                                        </div>
                                        
                                        @endforeach
                           
                                    </div>
                                
                                    
                                </fieldset>
                                
                                
                                <fieldset>
                                <legend>{{__('cp.other_info')}}</legend>
                                
                                
                                    <div class="form-group">

                                        <label class="col-sm-2 control-label" for="order">

                                            {{__('cp.link')}}
                                        </label>

                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="link" value="{{ old('link') }}" />
                                                  
                                        </div>
                                    </div>
                            </fieldset>
                            

                            <fieldset>
                                <legend>{{__('cp.image')}}</legend>
                                <div class="form-group {{ $errors->has('logo') ? ' has-error' : '' }}">
                                    <div class="col-md-6 col-md-offset-3">
                                        @if ($errors->has('logo'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('logo') }}</strong>
                                            </span>
                                        @endif
                                        <div class="fileinput-new thumbnail"
                                             onclick="document.getElementById('edit_image').click()"
                                             style="cursor:pointer">
                                            <img src=" {{url(admin_assets('/images/ChoosePhoto.png'))}}"  id="editImage" >

                                        </div>
                                        <div class="btn red" onclick="document.getElementById('edit_image').click()">
                                            <i class="fa fa-pencil"></i>
                                        </div>
                                        <input type="file" class="form-control" name="image" required
                                               id="edit_image" 
                                               style="display:none" >
                                    </div>
                                </div>
                            </fieldset>

{{-- 
                            <fieldset>
                                <legend>{{__('cp.video')}}</legend>
                                <div class="form-group {{ $errors->has('video') ? ' has-error' : '' }}">
                                    <div class="col-md-6 col-md-offset-3">
                                        @if ($errors->has('video'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('video') }}</strong>
                                            </span>
                                        @endif
                                  
                                     
                                        <input type="file" class="form-control" name="video"
                                               id="video" accept="video/mp4">
                                    </div>
                                </div>
                            </fieldset> --}}


                            <div class="form-actions">
                                <div class="row">
                                     <div class="col-md-12">
                                        <button type="submit" class="btn green">{{__('cp.submit')}}</button>
                                        <a href="{{url(getLocal().'/admin/ads')}}" class="btn default">{{__('cp.cancel')}}</a>
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



@endsection

