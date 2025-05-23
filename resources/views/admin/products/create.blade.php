@extends('layout.adminLayout')
@section('title') {{ucwords(__('cp.products'))}}
@endsection
@section('css')

    <style>
        a:link {
            text-decoration: none;
        }
    </style>

@endsection
@section('content')


        <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
            <!--begin::Subheader-->
            <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
                <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                    <!--begin::Info-->
                    <div class="d-flex align-items-center flex-wrap mr-1">
                        <div class="d-flex align-items-baseline mr-5">
                            <h3>{{__('cp.add')}}</h3>
                        </div>
                    </div>
                    <!--end::Info-->
                    <!--begin::Toolbar-->
                    <div class="d-flex align-items-center">
                        <a  href="{{url(getLocal().'/admin/products')}}" class="btn btn-secondary  mr-2">{{__('cp.cancel')}}</a>
                        <button id="submitButton" class="btn btn-success ">{{__('cp.add')}}</button>
                    </div>
                    <!--end::Toolbar-->
                </div>
            </div>
            <!--end::Subheader-->
            <!--begin::Entry-->
            <div class="d-flex flex-column-fluid">
                <!--begin::Container-->
                <div class="container">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b example example-compact">
                        <form class="form" method="post" action="{{url(app()->getLocale().'/admin/products')}}"
                            id="form" role="form" enctype="multipart/form-data" >
                            @csrf
                            <div class="card-header">
                                <h3 class="card-title">{{__('cp.main_info')}}</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach($locales as $locale)
                                       <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{__('cp.name_'.$locale->lang)}}</label>
                                                <input type="text" class="form-control form-control-solid" name="name_{{$locale->lang}}" value="{{ old('name_'.$locale->lang) }}" required />
                                            </div>
                                        </div>
                                    @endforeach
                                        @foreach($locales as $locale)
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ __('cp.description_'.$locale->lang) }}</label>
                                                    <textarea id="description_{{ $locale->lang }}" class="form-control form-control-solid"
                                                              name="description_{{ $locale->lang }}"
                                                              {{ $locale->lang == 'ar' ? 'dir=rtl' : '' }}
                                                              rows="3" required>{{ old('description_'.$locale->lang) }}</textarea>
                                                </div>
                                            </div>
                                        @endforeach
                                </div>
                            </div>


                             <div class="card-body">
                                   <div class="row">
                                      <div class="col-md-6">
                                            <div class="form-group ">
                                                <label>SKU</label>
                                                <input   type="text"
                                                class="form-control form-control-solid" name="sku" value="{{ old('sku')}}" required/>
                                            </div>
                                       </div>

                                      <div class="col-md-6">
                                        <div class="form-group ">
                                            <label>{{__('cp.quantity')}}</label>
                                            <input onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" type="text"
                                             class="form-control form-control-solid" name="quantity" value="{{ old('quantity')}}" required/>
                                        </div>
                                       </div>
                                 </div>
                                   <div class="row">
                                      {{-- <div class="col-md-6">
                                            <div class="form-group ">
                                                <label>{{__('cp.age')}}</label>
                                                <select class="form-control form-control-solid select2"  name="age_id" required>
                                                    <option value="">{{__('cp.select')}}</option>
                                                      @foreach ($ages as $age)
                                                      <option value="{{$age->id}}">{{$age->name}}</option>
                                                      @endforeach

                                                </select>
                                            </div>
                                       </div> --}}

                                      <div class="col-md-6">
                                            <div class="form-group ">
                                                <label>{{__('cp.category')}}</label>
                                                <select class="form-control form-control-solid select2" name ="category_id" required>
                                                    <option value="">{{__('cp.select')}}</option>
                                                    @foreach ($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                       </div>
                                 </div>

                                 <div class="row">
                                    <div class="col-md-6">
                                          <div class="form-group ">
                                              <label>{{__('cp.price')}}</label>
                                              <input  type="text"
                                               class="form-control form-control-solid number-only" name="price" value="{{ old('price')}}" required/>
                                          </div>
                                     </div>
                                    <div class="col-md-3">
                                          <div class="form-group ">
                                              <label>{{__('cp.discount_price')}}</label>
                                              <input   type="text"
                                               class="form-control form-control-solid number-only" id="discount_price" name="discount_price" value="{{ old('discount_price')}}"/>
                                          </div>
                                     </div>
                                    <div class="col-md-3">
                                          <div class="form-group ">
                                              <label>{{__('cp.offer_end_date')}}</label>
                                              <input  type="date"
                                               class="form-control form-control-solid" name="offer_end_date" value="{{ old('offer_end_date')}}"/>
                                          </div>
                                     </div>

                               </div>

                                 {{-- <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label>{{__('cp.gender')}}</label>
                                            <select class="form-control form-control-solid" name ="gender" required>
                                                <option value="">{{__('cp.select')}}</option>
                                                  <option value="0">{{__('cp.Male')}}</option>
                                                  <option value="1">{{__('cp.Female')}}</option>
                                                  <option value="2">{{__('cp.Both')}}</option>
                                            </select>
                                        </div>
                                   </div>
                                 </div>

                                </div>   --}}


                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="fileinputForm">
                                            <label >{{__('cp.image')}}</label>
                                            <div class="fileinput-new thumbnail"
                                                onclick="document.getElementById('edit_image').click()"
                                                style="cursor:pointer">
                                                <img src="{{url(admin_assets('images/ChoosePhoto.png'))}}" id="editImage">
                                            </div>
                                            <div class="btn btn-change-img red"
                                                onclick="document.getElementById('edit_image').click()">
                                                <i class="fas fa-pencil-alt"></i>
                                            </div>
                                            <input type="file" class="form-control" name="image"
                                               id="edit_image"
                                               style="display:none" required>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="card-body">
                                 <div class="row">
                                    <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                                        @if ($errors->has('image'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('image') }}</strong>
                                            </span>
                                        @endif
                                        <label>{{__('cp.images')}} </label>
                                        <div class="imageupload" style="display:flex;flex-wrap:wrap">
                                        </div>
                                        <div class="input-group control-group increment" >
                                            <div class="input-group-btn"  onclick="document.getElementById('all_images').click()">
                                            </div>
                                            <!--<input type="file" type="hidden" class="form-control "  accept="image/*" id="all_images"  multiple />-->
                                        </div>

                                        <div class="input-group control-group increment" >
                                        <div class="input-group-btn"  onclick="document.getElementById('all_images').click()">
                                          <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>{{__("cp.addMoreImages")}}</button>
                                        </div>
                                        <input type="file" class="custom-file-input form-control form-control-solid hidden"  accept="image/*" id="all_images"  multiple />
                                    </div>

                                    </div>

                                </div>
                            </div>
                            <!-- Your Blade template -->

                                <h3>Select Vitamins</h3>
                                @foreach($vitamins as $vitamin)
                                    <div>
                                        <label>
                                            <input type="checkbox" name="vitamins[]" value="{{ $vitamin->id }}"> {{ $vitamin->title}}
                                        </label>
                                    </div>
                                @endforeach
                            <button type="submit" id="submitForm" style="display:none"></button>
                        </form>
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::Entry-->
        </div>


@endsection
@section('js')
<script>
        $(document).on('click', '#submitButton', function(){
           // $('#submitButton').addClass('spinner spinner-white spinner-left');
        $('#submitForm').click();
    });

    $('#all_images').on('change', function (e) {
        readURLMultiple(this, $('.imageupload'));
     });

    $('#edit_image').on('change', function (e) {

readURL(this, $('#editImage'));

});

</script>
<script>
    $(document).ready(function(){
        let fieldCount = 1;

        $('#add-field-btn').click(function(){
            fieldCount++;
            let newField = $(' <div class="row"> <div class="form-group col-md-6">' +
                                ' <label>Title</label><input type="text" name="field_title[]" class="form-control" placeholder="title ' + fieldCount + '">' +
                            '</div><div class="form-group  col-md-6">' +
                                '<label>Title Arabic</label><input type="text" name="field_title_ar[]" class="form-control" placeholder="title Arabic' + fieldCount + '">' +
                                '</div> </div> <div class="row"> <div class="form-group  col-md-6"> ' +

                                '<label>Description</label><input type="text" name="field_description[]" class="form-control" placeholder="description ' + fieldCount + '">' +
                                '</div><div class="form-group  col-md-6">' +
                                '<label>Description Arabic</label><input type="text" name="field_description_ar[]" class="form-control" placeholder="description Arabic' + fieldCount + '">' +
                                '</div> </div> <div class="form-group "> ' +
                                '<input type="file" name="field_image[]" class="form-control" placeholder="title ' + fieldCount + '">' +
                                '<button type="button" class="btn btn-danger remove-field-btn">Remove</button>' +
                                '</div>');
            $('#fields-container').append(newField);
        });
        $('#fields-container').on('click', '.remove-field-btn', function(){
            $(this).closest('.form-group').remove(); // Remove the closest .form-group containing the clicked button
        });

    });
</script>

<script>
    @foreach($locales as $locale)
    tinymce.init({
        selector: '#description_{{ $locale->lang }}',
        plugins: 'lists link image table code',
        toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright | bullist numlist | code',
        height: 300,
        directionality: '{{ $locale->lang == 'ar' ? 'rtl' : 'ltr' }}',
        language: '{{ $locale->lang == 'ar' ? 'ar' : 'en' }}',
        branding: false
    });
    @endforeach
</script>
<script>
    if (!Promise.allSettled) {
        Promise.allSettled = function (promises) {
            return Promise.all(promises.map(p =>
                p
                    .then(value => ({ status: 'fulfilled', value }))
                    .catch(reason => ({ status: 'rejected', reason }))
            ));
        };
    }
</script>
@endsection
@section('validation')
    offer_end_date:{
        required:"#discount_price:filled"
    }
@endsection

@section('script')

@endsection
