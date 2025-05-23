<td class="v-align-middle wd-10p" >
    
    <?php $status = '';
             $cls = ''; 
       if($row->status == 0) {
           $status = 'new';
           $cls    = 'danger';
       }
       elseif($row->status == 1) {
           $status = 'preparing';
           $cls    = 'info';
       }
       elseif ($row->status == 2) {
           $status = 'onDelivery';
           $cls    = 'warning';
       }
       elseif ($row->status == 3) { 
           $status = 'complete';
           $cls    = 'success';
       }
        elseif ($row->status == 4) { 
            $status = 'cancel';
            $cls    = 'danger';
        } else {
            $status = 'cancel';
            $cls    = 'danger';
        }
       ?>
                    
                   
<span id="label-{{$row->id}}" class="badge badge-pill badge-{{$cls}}" id="label-{{$row->id}}">

{{$row->status_name}}
</span>
</td>