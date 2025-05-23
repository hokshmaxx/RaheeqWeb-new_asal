<form class="edit_form" method="post" action="{{url(app()->getLocale().'/admin/categories/'.$item->id)}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{-- {{ method_field('PATCH')}} --}}
    <input type="hidden" class="item_id" value="{{$item->id}}" >
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>{{__('cp.from')}}</label>
                <input
                    type="number" class="form-control form-control-solid number-only" name="start_from"
                    value="{{$item->start_from}}" required/>
            </div>
        </div>
  
        <div class="col-md-6">
            <div class="form-group">
                <label>{{__('cp.to')}}</label>
                <input
                    type="number" class="form-control form-control-solid number-only" name="end_to"
                    value="{{$item->end_to}}" required/>
            </div>
        </div>
   </div>
</form>

 