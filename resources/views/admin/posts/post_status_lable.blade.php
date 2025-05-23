@if($row->is_soled==1)
<span id="label-{{$row->id}}" class="badge badge-pill badge-danger" id="label-{{$row->id}}">
    {{__('cp.sold')}}
</span>
@else
<span id="label-{{$row->id}}" class="badge badge-pill badge-info" id="label-{{$row->id}}">
    {{__('cp.open')}}
</span>
@endif
</td>