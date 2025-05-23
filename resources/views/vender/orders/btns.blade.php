
    <a href="{{url(getLocal().'/vender/orders/'.$row->id)}}"
        class="btn btn-xs blue tooltips" data-container="body" data-placement="top"
        data-original-title="{{__('cp.edit')}}"><i class="fa fa-eye"></i>
     </a>
    
     <a href="#" onclick="openWindow('{{url(getLocal().'/vender/orders/printOrder/'.$row->id)}}')" class="btn btn-xs blue tooltips" data-container="body" data-placement="top"
        data-original-title="{{__('cp.print')}}"><i class="fa fa-print"></i>
    </a>