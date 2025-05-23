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

    <div class="row">
        <div class="col-md-6">
            <div class="form-group ">
                <label>{{__('cp.delivery_cost')}}</label>
                <input onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" type="text"
                 class="form-control form-control-solid" name="delivery_cost" value="{{@$item->delivery_charges}}" required/>
            </div>
       </div>
    </div>
</form>

 