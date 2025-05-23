<td class="v-align-middle wd-15p optionAddHours">

    <a data-id="{{$row->id}}" href="{{url(getLocal().'/admin/viewMessage/'.$row->id)}}" class="btn btn-sm btn-clean btn-icon edit_item_btn" title="{{__('cp.edit')}}">
        <i class="la la-eye"></i>
    </a>
    
           <a href="#myModal{{$row->id}}" title="{{__('cp.delete')}}" role="button"  data-toggle="modal" class="btn btn-xs red tooltips"><i class="fa fa-times" aria-hidden="true"></i></a>
    
        <div id="myModal{{$row->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">{{__('cp.delete')}}</h4>
        </div>
        <div class="modal-body">
            <p>{{__('cp.confirm')}} </p>
        </div>
        <div class="modal-footer">
            <button class="btn default" data-dismiss="modal" aria-hidden="true">{{__('cp.cancel')}}</button>
            <a href="#" onclick="delete_adv('{{$row->id}}','{{$row->id}}',event)"><button class="btn btn-danger">{{__('cp.delete')}}</button></a>
        </div>
    </div>
</div>
</div>
 

</td>