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
            <div class="fileinputForm">
                <label >{{__('cp.image')}}</label>
                <div class="fileinput-new thumbnail"
                    onclick="document.getElementById('edit_image1').click()"
                    style="cursor:pointer">
                    <img src="{{$item->image}}" id="editImage1">
                </div>
                <div class="btn btn-change-img red"
                    onclick="document.getElementById('edit_image1').click()">
                    <i class="fas fa-pencil-alt"></i>
                </div>
                <input type="file" class="form-control" name="image"
                id="edit_image1"
                style="display:none">
            </div>
        </div>
    </div>
</form>

 