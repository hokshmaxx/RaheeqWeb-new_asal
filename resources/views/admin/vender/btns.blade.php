<td class="v-align-middle wd-15p optionAddHours">

    <a href="{{url(getLocal().'/admin/vender/'.$row->id.'/edit')}}"
       class="btn btn-sm btn-clean btn-icon" title="{{__('cp.show')}}">
        <i class="la la-eye"></i>
    </a>
           <a href="#myModal{{$row->id}}" role="button" title="{{__('cp.delete')}}"  data-toggle="modal" class="btn btn-xs red tooltips"><i class="fa fa-times" aria-hidden="true"></i></a>

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
    <!--<a href="{{url(getLocal().'/admin/users/'.$row->id.'/createNotification')}}"-->
    <!--   class="btn btn-sm btn-clean btn-icon" title="{{__('cp.message')}}">-->
    <!--    <i class="la la-comment"></i>-->
    <!--</a>-->

</td>