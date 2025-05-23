<span id="label-{{$row->id}}"
    class="badge badge-pill badge-{{($row->read == 1)
? "info" : "danger"}}" id="label-{{$row->id}}">
@if($row->read == 1)
{{__('cp.read')}}
@else
{{__('cp.new')}}
@endif
</span>