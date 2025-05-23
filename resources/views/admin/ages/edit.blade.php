<form class="edit_form" method="post" action="{{url(app()->getLocale().'/admin/categories/'.$item->id)}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{-- {{ method_field('PATCH')}} --}}
    <input type="hidden" class="item_id" value="{{$item->id}}" >
    <div class="row">
        @foreach($locales as $locale)
        <div class="col-md-6">
            <div class="form-group">
                <label>{{__('cp.name_'.$locale->lang)}}</label>
                <input type="text" class="form-control form-control-solid" name="name_{{$locale->lang}}" 
                {{($locale->lang == 'ar') ? 'dir=rtl' :'' }} value="{{ @$item->translate($locale->lang)->name}}" required/>
            </div>
        </div>
        @endforeach 
    </div>
</form>

 