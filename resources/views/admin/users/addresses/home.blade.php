@extends('admin.users.sideMenu')
@section('companyContent')

       	<div class="flex-row-fluid ml-lg-8">
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">{{__('cp.addresses')}}</span>
                    </h3>
                    <div class="card-toolbar">
                        <ul class="nav nav-pills nav-pills-sm nav-dark-75">
                        <!--<button  type="button" class="btn btn-info nav-link py-2 px-4 active has-icon sbold btn--filter">{{__('cp.filter')}}<i class="fa fa-search"></i></button>-->
                            <li class="nav-item">
                                <a class="btn btn-secondary  mr-2 btn-success" 
                                href="{{url(getLocal().'/admin/users/'.$item->id.'/addresses/create')}}">{{__('cp.add')}}</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body py-0">
                        <div class="table-responsive">
                        <table class="table table-hover tableWithSearch" id="tableWithSearch">
                            <thead>
                            <tr>
                                <th class="wd-1">#</th>
                                 <th class="wd-25p"> {{ucwords(__('cp.name'))}}</th>
                                <th class="wd-25p"> {{ucwords(__('cp.street'))}}</th>
                                <th class="wd-25p"> {{ucwords(__('cp.area'))}}</th>
                                <th class="wd-10p"> {{ucwords(__('cp.created'))}}</th>
                                <th class="wd-15p"> {{ucwords(__('cp.action'))}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($addresses as $one)
                                <tr class="odd gradeX" id="tr-{{$one->id}}">
                                    <td class="v-align-middle wd-5p">
                                       {{$loop->iteration}}
                                    </td>
                                    <td class="v-align-middle wd-25p">{{$one->address_name}}</td>
                                    <td class="v-align-middle wd-25p">{{$one->street}}</td>
                                    <td class="v-align-middle wd-25p">{{@$one->area->name}}</td>                                

                                    <td class="v-align-middle wd-10p">{{$one->created_at->format('Y-m-d')}}</td>

                                    <td class="v-align-middle wd-15p optionAddHours">

                                        <a href="{{url(getLocal().'/admin/users/'.$item->id.'/addresses/'.$one->id.'/edit')}}"
                                        class="btn btn-sm btn-clean btn-icon" title="{{__('cp.show')}}">
                                            <i class="la la-edit"></i>
                                        </a>
                                        
                                            <a href="#myModal{{$one->id}}" role="button"  data-toggle="modal" class="btn btn-xs red tooltips"><i class="fa fa-times" aria-hidden="true"></i></a>
                                        
                                            <div id="myModal{{$one->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
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
                                                <a href="#" onclick="delete_adv('{{$one->id}}','{{$one->id}}',event)"><button class="btn btn-danger">{{__('cp.delete')}}</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    

                                    </td>
                                </tr>
                            @empty

                            @endforelse


                            </tbody>
                        </table>
                        </div>
                    </div>

      </div>
      </div>
@endsection
@section('js')

<script>
        $('#edit_image').on('change', function (e) {
            readURL(this, $('#editImage'));
        });

        $(document).on('click', '#submitButton', function(){
            // $('#submitButton').addClass('spinner spinner-white spinner-left');
            $('#submitForm').click();
        });
        
        
                function delete_adv(id, iss_id, e) {
            //alert(id);
            e.preventDefault();
            console.log(id);
            console.log(iss_id);
            var url = '{{url(getLocal()."/admin/deleteAddress")}}/' + id;
            var csrf_token = '{{csrf_token()}}';
            $.ajax({
                type: 'delete',
                headers: {'X-CSRF-TOKEN': csrf_token},
                url: url,
                data: {_method: 'delete'},
                success: function (response) {
                    console.log(response);
                    if (response === 'success') {
                        $('#tr-' + id).hide(500);
                        $('#myModal' + id).modal('toggle');

                    } else {
                        // swal('Error', {icon: "error"});
                    }
                },
                error: function (e) {
                    // swal('exception', {icon: "error"});
                }
            });

        }
    </script>
@endsection
