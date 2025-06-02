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
                            <h3>{{__('cp.edit')}}</h3>
                        </div>
                    </div>
                    <!--end::Info-->
                    <!--begin::Toolbar-->
                    <div class="d-flex align-items-center">
                        <a  href="{{url(getLocal().'/admin/products')}}" class="btn btn-secondary  mr-2">{{__('cp.cancel')}}</a>
                        <button id="submitButton" class="btn btn-success ">{{__('cp.edit')}}</button>
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
                        <form class="form" method="post" action="{{url(app()->getLocale().'/admin/products/'.$item->id)}}"
                            id="form" role="form" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                            {{ method_field('PATCH')}}

                            <div class="card-header">
                                <h3 class="card-title">{{__('cp.edit')}}</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach($locales as $locale)
                                       <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{__('cp.name_'.$locale->lang)}}</label>
                                                <input type="text" class="form-control form-control-solid"
                                                name="name_{{$locale->lang}}" value="{{old('name_'.$locale->lang,@$item->translate($locale->lang)->name)}}" required />
                                            </div>
                                        </div>
                                    @endforeach
                                        @foreach($locales as $locale)
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ __('cp.description_'.$locale->lang) }}</label>
                                                    <textarea
                                                        id="description_{{ $locale->lang }}"
                                                        class="form-control form-control-solid rich-text"
                                                        name="description_{{ $locale->lang }}"
                                                        rows="6"
                                                        required
                {{ ($locale->lang == 'ar') ? 'dir=rtl' : '' }}>
                {{ old('description_'.$locale->lang, @$item->translate($locale->lang)->description) }}
            </textarea>
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
                                              class="form-control form-control-solid" name="sku" value="{{$item->sku}}" required/>
                                          </div>
                                     </div>

                                    <div class="col-md-6">
                                      <div class="form-group ">
                                          <label>{{__('cp.quantity')}}</label>
                                          <input onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" type="text"
                                           class="form-control form-control-solid" name="quantity" value="{{$item->quantity}}" required/>
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
                                                    <option value="{{$age->id}}" @if($age->id == $item->age_id) selected @endif>{{$age->name}}</option>
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
                                              <option value="{{$category->id}}" @if($category->id == $item->category_id) selected @endif>{{$category->name}}</option>
                                              @endforeach
                                          </select>
                                      </div>
                                 </div>
                           </div>

                                 <div class="row">
                                    <div class="col-md-6">
                                          <div class="form-group ">
                                              <label>{{__('cp.price')}}</label>
                                              <input  type="number"
                                               class="form-control form-control-solid number-only" name="price" value="{{old('price',$item->price)}}" required/>
                                          </div>
                                     </div>
                                    <div class="col-md-3">
                                          <div class="form-group ">
                                              <label>{{__('cp.discount_price')}}</label>
                                              <input   type="number"
                                               class="form-control form-control-solid number-only" id="discount_price" name="discount_price" value="{{old('discount_price',$item->discount_price)}}"/>
                                          </div>
                                     </div>
                                    <div class="col-md-3">
                                          <div class="form-group ">
                                              <label>{{__('cp.offer_end_date')}}</label>
                                              <input  type="date"
                                               class="form-control form-control-solid" name="offer_end_date" value="{{old('offer_end_date',$item->offer_end_date)}}"/>
                                          </div>
                                     </div>

                               </div>


                               {{-- <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label>{{__('cp.gender')}}</label>
                                            <select class="form-control form-control-solid" name ="gender" required>
                                                <option value="">{{__('cp.select')}}</option>
                                                <option value="0" @if($item->gender==0) selected @endif>{{__('cp.Male')}}</option>
                                                <option value="1" @if($item->gender==1) selected @endif>{{__('cp.Female')}}</option>
                                                <option value="2" @if($item->gender==2) selected @endif>{{__('cp.Both')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div> --}}

                                </div>


                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="fileinputForm">
                                            <label >{{__('cp.image')}}</label>
                                            <div class="fileinput-new thumbnail"
                                                onclick="document.getElementById('edit_image').click()"
                                                style="cursor:pointer">
                                                <img src="{{$item->image}}" id="editImage">
                                            </div>
                                            <div class="btn btn-change-img red"
                                                onclick="document.getElementById('edit_image').click()">
                                                <i class="fas fa-pencil-alt"></i>
                                            </div>
                                            <input type="file" class="form-control" name="image"
                                               id="edit_image"
                                               style="display:none">
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
                                        <div class="imageupload" style="display:flex;flex-wrap:wrap">
                                            @foreach($item->images as $one)



                                                <div class="imageBox text-center" style="width:150px;height:190px;margin:5px">
                                                    <img src="{{$one->image}}" style="width:150px;height:150px">
                                                    <button class="btn btn-danger deleteImage" type="button">{{__("cp.remove")}}</button>
                                                    <input class="attachedValues" type="hidden" name="oldImages[]" value="{{$one->id}}">
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="input-group control-group increment" >
                                            <div class="input-group-btn"  onclick="document.getElementById('all_images').click()">
                                              <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>{{__("cp.addMoreImages")}}</button>
                                            </div>
                                            <input type="file" class="form-control hidden" style="display:none"  accept="image/*" id="all_images"  multiple />
                                        </div>




                                    </div>

                                </div>
                            </div>


                            <div class="card-body">

                            @if(empty($item->vitamin))


                                <div id="fields-container"  >
                                    <!-- Initially, you may have some fields here -->
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label>Title</label>
                                                <input type="text" name="field_title[]" class="form-control" placeholder="title 1">

                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Title Arabic</label>
                                                <input type="text" name="field_title_ar[]" class="form-control" placeholder="title Arabic">

                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group  col-md-6">
                                                <label> Description </label>
                                                <input type="text" name="field_description[]" class="form-control" placeholder="description 1">

                                            </div>
                                            <div class="form-group  col-md-6">
                                                <label> description Arabic</label>
                                                <input type="text" name="field_description_ar[]" class="form-control" placeholder="description Arabic">

                                            </div>
                                        </div>

                                        <div  class="row">
                                            <input type="file" name="field_image[]" class="form-control"  placeholder="image     1">
                                        </div>

                                    </div>
                                </div>
                            @endif

                                <h3>Select Vitamins</h3>
                                @foreach($vitamins as $vitamin)
                                    <div>
                                        <label>
                                            <input type="checkbox" name="vitamin[]" value="{{ $vitamin->id }}"
                                                @if(in_array($vitamin->id, $selectedVitamins)) checked @endif> {{ $vitamin->title }}
                                        </label>
                                    </div>
                                @endforeach



                            </div>

                            <div class="card-body">
                                <h3>خيارات التغليف كهدية</h3>

                                <div class="form-group">
                                    <label>
                                        <input type="checkbox" name="gift_packaging_enabled" value="1" {{ $item->allow_gift_packaging ? 'checked' : '' }}>
                                        تفعيل خيار التغليف كهدية لهذا المنتج
                                    </label>
                                </div>


                                    <div id="giftPackagingOptions" style="{{ $item->allow_gift_packaging ? '' : 'display:none;' }}">
                                        <div id="giftPackagingContainer">
                                            <!-- الخيارات الجديدة -->
                                            <div class="form-group gift-option d-flex align-items-center gap-3 mb-3">
                                                <input type="file" name="gift_packaging_images[]" class="form-control" accept="image/*" required>
                                                <input type="number" name="gift_packaging_prices[]" class="form-control" placeholder="السعر" step="0.01" min="0" required>
                                                <input type="text" name="gift_packaging_titles_ar[]" class="form-control" placeholder="العنوان بالعربية" required>
                                                <input type="text" name="gift_packaging_titles_en[]" class="form-control" placeholder="Title in English" required>

                                                <button type="button" class="btn btn-danger btn-sm remove-option">حذف</button>
                                            </div>
                                        </div>

                                        <button type="button" class="btn btn-success btn-sm" id="addGiftOption">إضافة خيار آخر</button>

                                        @if($item->giftPackagings && $item->giftPackagings->count())
                                            <hr>
                                            <h5 class="mt-3">الخيارات السابقة</h5>
                                            <div class="row" id="existingGiftPackagings">
                                                @foreach($item->giftPackagings as $index => $gift)
                                                    <div class="col-md-3 text-center old-gift" data-id="{{ $gift->id }}">
                                                        <img src="{{ asset( $gift->image) }}" style="width:100%; height:120px; object-fit:cover;" class="mb-2">
                                                        <input type="hidden" name="oldGiftPackagings[{{ $gift->id }}][id]" value="{{ $gift->id }}">
                                                        <input type="number" name="oldGiftPackagings[{{ $gift->id }}][price]" class="form-control mb-1" value="{{ $gift->price }}" step="0.01" min="0">
                                                        <button type="button" class="btn btn-danger btn-sm remove-old-option" data-id="{{ $gift->id }}">حذف</button>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>


                            </div>

                            <div class="card-body">
                                <h3>خيارات المنتج حسب الأنواع</h3>

                                @foreach ($variantTypes as $variantType)
                                    <div class="border p-3 mb-4">
                                        <h5>{{ $variantType->name_ar }} / {{ $variantType->name_en }}</h5>

                                        <div class="variant-container" data-type-id="{{ $variantType->id }}">
                                            {{-- Existing Variants --}}
                                            @if (isset($groupedVariants[$variantType->id]))
                                                @foreach ($groupedVariants[$variantType->id] as $variant)
                                                    <div class="variant-item d-flex align-items-center gap-3 mb-2">
                                                        <input type="hidden" name="variants[][id]" value="{{ $variant->id }}" required>
                                                        <input type="hidden" name="variants[][variantTypeId]" value="{{ $variantType->id }}" required>
                                                        <input type="text" name="variants[][name]" class="form-control" placeholder="الاسم" value="{{ $variant->name }}" >
                                                        <input type="text" name="variants[][sku]" class="form-control" placeholder="SKU" value="{{ $variant->sku }}" >
                                                        <input type="number" step="0.01" name="variants[][price]" class="form-control" placeholder="السعر" value="{{ $variant->price }}" >
                                                        <input type="number" step="0.01" name="variants[][discount_price]" class="form-control" placeholder="سعر الخصم" value="{{ $variant->discount_price }}" >
                                                        <input type="number" name="variants[][quantity]" class="form-control" placeholder="الكمية" value="{{ $variant->quantity }}" >
                                                        <button type="button" class="btn btn-danger remove-variant" data-id="{{$variant->id}}">X</button>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>

                                        <button type="button" class="btn btn-success add-variant" data-type-id="{{ $variantType->id }}">+ إضافة خيار</button>
                                    </div>
                                @endforeach
                            </div>

                            <script>
        //                         document.querySelectorAll('.add-variant').forEach(button => {
        //                             button.addEventListener('click', function () {
        //                                 const typeId = this.dataset.typeId;
        //                                 const container = document.querySelector(`.variant-container[data-type-id="${typeId}"]`);
        //
        //                                 const row = document.createElement('div');
        //                                 row.classList.add('variant-item', 'd-flex', 'align-items-center', 'gap-3', 'mb-2');
        //                                 row.innerHTML = `
        //     <input type="hidden" name="variants[${typeId}][id][]" value="">
        //     <input type="text" name="variants[${typeId}][name][]" class="form-control" placeholder="الاسم">
        //     <input type="text" name="variants[${typeId}][sku][]" class="form-control" placeholder="SKU">
        //     <input type="number" step="0.01" name="variants[${typeId}][price][]" class="form-control" placeholder="السعر">
        //     <input type="number" step="0.01" name="variants[${typeId}][discount_price][]" class="form-control" placeholder="سعر الخصم">
        //     <input type="number" name="variants[${typeId}][quantity][]" class="form-control" placeholder="الكمية">
        //     <button type="button" class="btn btn-danger remove-variant"  >X</button>
        // `;
        //                                 container.appendChild(row);
        //                             });
        //                         });
        //
        //                         document.addEventListener('click', function (e) {
        //                             if (e.target.classList.contains('remove-variant')) {
        //                                 e.target.closest('.variant-item').remove();
        //                             }
        //                         });
                            </script>





                            <button type="submit" id="submitForm" style="display:none"></button>
                        </form>

                    </div>

                    <div class="card-body bg-white">
                        <h3>{{ __('cp.reviews') }}</h3>

                        @foreach($item->reviews as $review)
                            <div class="border p-3 mb-3">
                                <p><strong>{{ $review->user->name ?? 'Guest' }}</strong></p>
                                <p>{{ $review->review }}</p>
                                <p>
                                    <strong>{{ __('cp.rating') }}:</strong> {{ $review->rating }}/5
                                </p>
                                <div>
                                    <a href="{{ route('admin.reviews.edit', $review->id) }}" class="btn btn-sm btn-warning">{{ __('cp.edit') }}</a>
                                    <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" class="d-inline" onsubmit="return confirm('{{ __('cp.are_you_sure') }}')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">{{ __('cp.delete') }}</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach

                        @if($item->reviews->isEmpty())
                            <p>{{ __('cp.no_reviews_yet') }}</p>
                        @endif
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

        $('#edit_add-field-btn').click(function(){
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
    $(document).ready(function(){
        $('input[name="gift_packaging_enabled"]').on('change', function(){
            if($(this).is(':checked')) {
                $('#giftPackagingOptions').slideDown();
            } else {
                $('#giftPackagingOptions').slideUp();
            }
        });
    });
</script>

<script>
    // إضافة خيار جديد
    document.getElementById('addGiftOption').addEventListener('click', function () {
        const container = document.getElementById('giftPackagingContainer');
        const newOption = document.createElement('div');
        newOption.className = 'form-group gift-option d-flex align-items-center gap-3 mb-3';
        newOption.innerHTML = `
            <input type="file" name="gift_packaging_images[]" class="form-control" accept="image/*" required>
            <input type="number" name="gift_packaging_prices[]" class="form-control" placeholder="السعر" step="0.01" min="0" required>
 <input type="text" name="gift_packaging_titles_ar[]" class="form-control" placeholder="العنوان بالعربية" required>
            <input type="text" name="gift_packaging_titles_en[]" class="form-control" placeholder="Title in English" required>

            <button type="button" class="btn btn-danger btn-sm remove-option">حذف</button>
        `;
        container.appendChild(newOption);
    });

    // حذف خيار جديد
    document.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('remove-option')) {
            e.target.closest('.gift-option').remove();
        }
    });

    // حذف خيار قديم
    // document.addEventListener('click', function (e) {
    //     if (e.target && e.target.classList.contains('remove-old-option')) {
    //         const parent = e.target.closest('.old-gift');
    //         const giftId = parent.dataset.id;
    //         const input = document.createElement('input');
    //         input.type = 'hidden';
    //         input.name = 'deletedGiftPackagings[]';
    //         input.value = giftId;
    //         parent.remove(); // Remove visually
    //         document.querySelector('form').appendChild(input); // Add hidden input to mark as deleted
    //     }
    // });

    $(document).on('click', '.remove-old-option', function () {
        const giftId = $(this).data('id');

        if (confirm('هل أنت متأكد من حذف هذا الخيار؟')) {
            var requestUrl = '{{ url("admin/delete-gift-packaging") }}';

            console.log('Request URL:', requestUrl);

            $.ajax({
                url: requestUrl,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    gift_id: giftId,
                },
                success: function (response) {
                    console.log('Response:', response);
                    if (response.success) {
                        $('.old-gift[data-id="' + giftId + '"]').remove();
                        alert('تم الحذف بنجاح');
                    } else {
                        alert('حدث خطأ أثناء الحذف');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error Status:', status);
                    console.error('Error Message:', error);
                    console.error('Response:', xhr.responseText);
                    alert('حدث خطأ أثناء الاتصال بالخادم');
                }
            });
        }
    });


    $(document).on('click', '.remove-variant', function (e) {
        const varint_id = $(this).data('id');

        console.log(varint_id);
        if (confirm('هل أنت متأكد من حذف هذا الخيار؟')) {
            var requestUrl = '{{ url("admin/remove-varint") }}';

            console.log('Request URL:', requestUrl);

            $.ajax({
                url: requestUrl,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    varint_id: varint_id,
                },
                success: function (response) {
                    console.log('Response:', response);
                    if (response.success) {
                        e.target.closest('.variant-item').remove();

                        // $('.old-gift[data-id="' + giftId + '"]').remove();
                        alert('تم الحذف بنجاح');
                    } else {
                        alert('حدث خطأ أثناء الحذف');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error Status:', status);
                    console.error('Error Message:', error);
                    console.error('Response:', xhr.responseText);
                    alert('حدث خطأ أثناء الاتصال بالخادم');
                }
            });
        }
    });


    document.addEventListener('DOMContentLoaded', function() {
        const giftPackagingCheckbox = document.querySelector('input[name="gift_packaging_enabled"]');
        const giftPackagingFields = document.querySelectorAll('input[name^="gift_packaging_images"], input[name^="gift_packaging_prices"], input[name^="gift_packaging_titles_ar"], input[name^="gift_packaging_titles_en"]');

        // Function to toggle required fields
        function toggleGiftPackagingFields() {
            if (giftPackagingCheckbox.checked) {
                giftPackagingFields.forEach(field => {
                    field.setAttribute('required', 'required');
                });
            } else {
                giftPackagingFields.forEach(field => {
                    field.removeAttribute('required');
                });
            }
        }

        // Listen for changes to the checkbox
        giftPackagingCheckbox.addEventListener('change', toggleGiftPackagingFields);

        // Call on page load to initialize
        toggleGiftPackagingFields();
    });


    document.querySelectorAll('.add-variant').forEach(button => {
        button.addEventListener('click', function () {
            const typeId = this.dataset.typeId;
            const container = document.querySelector(`.variant-container[data-type-id="${typeId}"]`);

            const row = document.createElement('div');
            row.classList.add('variant-item', 'd-flex', 'align-items-center', 'gap-3', 'mb-2');
            row.innerHTML = `
            <input type="hidden" name="variants[${typeId}][id][]" value="">
            <input type="text" name="variants[${typeId}][name][]" class="form-control" placeholder="الاسم">
            <input type="text" name="variants[${typeId}][sku][]" class="form-control" placeholder="SKU">
            <input type="number" step="0.01" name="variants[${typeId}][price][]" class="form-control" placeholder="السعر">
            <input type="number" step="0.01" name="variants[${typeId}][discount_price][]" class="form-control" placeholder="سعر الخصم">
            <input type="number" name="variants[${typeId}][quantity][]" class="form-control" placeholder="الكمية">
            <button type="button" class="btn btn-danger remove-variant"  >X</button>
        `;
            container.appendChild(row);
        });
    });

    // document.querySelectorAll('.add-variant').forEach(button => {
    //     button.addEventListener('click', function () {
    //         const typeId = this.dataset.typeId;
    //         const container = this.previousElementSibling;
    //
    //         const row = document.createElement('div');
    //         row.classList.add('variant-item', 'd-flex', 'align-items-center', 'gap-3', 'mb-2');
    //
    //         row.innerHTML = `
    //         <input type="hidden" name="variants[][variantTypeId]" value="${typeId}">
    //         <input type="text" name="variants[][name]" class="form-control" placeholder="الاسم">
    //         <input type="text" name="variants[][sku]" class="form-control" placeholder="SKU">
    //         <input type="number" step="0.01" name="variants[][price]" class="form-control" placeholder="السعر">
    //         <input type="number" step="0.01" name="variants[][discount_price]" class="form-control" placeholder="سعر الخصم">
    //         <input type="number" name="variants[][quantity]" class="form-control" placeholder="الكمية">
    //         <button type="button" class="btn btn-danger remove-variant">X</button>
    //     `;
    //
    //         container.appendChild(row);
    //     });
    // });

    // Optional: Remove button functionality
    document.addEventListener('click', function (e) {
        // if (e.target.classList.contains('remove-variant')) {
            // e.target.closest('.variant-item').remove();
      //  }
    });
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
<script>
    document.addEventListener('DOMContentLoaded', function () {

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


    });
</script>


@endsection

@section('script')



@endsection
@section('validation')
    offer_end_date:{
        required:"#discount_price:filled"
    }
@endsection
