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
                              style="color: #e02222 !important;">{{__('cp.editAd')}}</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form method="post" action="{{url(app()->getLocale().'/admin/ads/'.$item->id)}}"
                          enctype="multipart/form-data" class="form-horizontal" role="form" id="form">
                        {{ csrf_field() }}
                        {{ method_field('PATCH')}}
                        
                        <div class="form-body">
      
                                <fieldset>
                                <legend>{{__('cp.main_info')}}</legend>
                                
                                    <div class="form-group">
                                        @foreach($locales as $locale)
                                        
                                        <label class="col-sm-2 control-label" for="name_{{$locale->lang}}">
                                            {{__('cp.description_'.$locale->lang)}}
                                            <span class="symbol">*</span>
                                        </label>
                                        <div class="col-md-3">
                                                       <textarea class="form-control" {{($locale->lang == 'ar') ? 'dir=rtl' :'' }} name="details_{{$locale->lang}}" id="order" rows="4" required>{{@$item->translate($locale->lang)->details}}</textarea>
                                        </div>
                                        
                                        @endforeach
                           
                                    </div>
                                
                                    
                                </fieldset>
                            
                            
                              <fieldset>
                                  <legend>{{__('cp.other_info')}}</legend>
                                    <div class="form-group">

                                        <label class="col-sm-2 control-label" for="link">

                                            {{__('cp.link')}}
                                        </label>

                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="link" value="{{ old('link',$item->link) }}" />
                                                  
                                        </div>
                                    </div>
                            </fieldset>
                            


                            <fieldset>
                                <legend>{{__('cp.image')}}</legend>
                                <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                                    <div class="col-md-6 col-md-offset-3">
                                        @if ($errors->has('image'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('image') }}</strong>
                                            </span>
                                        @endif
                                        <div class="fileinput-new thumbnail"
                                             onclick="document.getElementById('edit_image').click()"
                                             style="cursor:pointer">
                                            <img src="@if(!empty($item->image)){{$item->image}} @else  {{ url(admin_assets('/images/ChoosePhoto.png'))}} @endif" id="editImage" >
                                        </div>
                                        
                                        <div class="btn red"
                                             onclick="document.getElementById('edit_image').click()">
                                            <i class="fa fa-pencil"></i>
                                        </div>
                                        <input type="file" class="form-control" name="image"
                                               id="edit_image"
                                               style="display:none">
                                    </div>
                                </div>
                            </fieldset>

                           {{-- <fieldset>
                                <legend>{{__('cp.video')}}</legend>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                       
                                        <input type="file" class="form-control" name="video"
                                               id="video" accept="video/mp4">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                <div class="col-md-6 col-md-offset-3" >
                                    <video width="530" height="240" src="{{$item->video}}" autobuffer autoloop loop controls ></video>

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

