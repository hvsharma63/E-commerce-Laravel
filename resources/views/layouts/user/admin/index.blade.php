@extends('layouts.admin.app')

@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title float-left">Users</h4>
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="{{route('users.showUsers')}}">Users</a></li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <table id="datatable2" class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">First Name</th>
                                <th class="text-center">Last Name</th>
                                <th class="text-center">Contact</th>
                                <th class="text-center">Email ID</th>
                                {{-- <th class="text-center">Status</th> --}}
                                <th class="text-center">Created at</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead id="colours-list" name="colours-list">
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="text-center" id="user{{$user->id}}">
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->firstName }}</td>
                                    <td>{{ $user->lastName }}</td>
                                    <td>{{ $user->mobileNo }}</td>
                                    <td>{{ $user->email }}</td>
                                    {{-- <td>
                                        <input type="checkbox" value="{{$user->id}}" id="switchery{{$user->id}}" data-plugin="switchery" data-size="small" data-user="#039cfd"  name="checkbox" class="checkbox userSwitch" {{ $user->status == 'Y' ? 'checked' : '' }}/>
                                    </td> --}}
                                    <td>{{ $user->created_at->format('d-m-Y') }}</td>
                                    <td style="text-align: center">
                                        <a class="text-primary deleteuser" uid="{{$user->id}}" style="padding-left: 5px">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end row -->

    </div> <!-- container -->

@endsection
@section('script')
    <script>
        var table2 = $('#datatable2').DataTable();

        $(document).ready(function () {

            $(".deleteuser").click(function (e) {
                e.preventDefault();
                id = $(this).attr('uid');
                swal({
                    title: "Are you sure?",
                    text: "You wanna change the payment status!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, change it!",
                    cancelButtonText: "No, cancel!",
                    confirmButtonClass: "btn btn-success",
                    cancelButtonClass: "btn btn-danger m-l-10",
                    buttonsStyling: false
                }).then(
                    function() {
                        $.ajax({
                            type: "POST",
                            url: "users/delete",
                            data: {_token:'{{csrf_token()}}',id:id},
                            dataType: "json",
                            success: function (response) {
                                if(response.data == true){
                                    $("tr#user"+id).remove();
                                        swal("Changed!", response.message, "success");
                                }else{
                                    swal("Failed",response.message,"error");
                                }
                            }
                        });
                    },
                    function(dismiss) {
                        if (dismiss === "cancel") {
                            swal("Cancelled","Don't worry, the status isn't changed :)","error");
                        }
                    }
                )
            });
            // User Status Switch
            // $(".userSwitch").change(function(e){
            //     e.preventDefault();
            //     var userId = $(this).val();
            //     $.ajax({
            //         url:"users/changeStatus",
            //         dataType:'json',
            //         type:'POST',
            //         data:{_token:'{{csrf_token()}}',id:userId},
            //         success:function(response){
            //             if(response.data == true){
            //                 $.toast({
            //                     text: response.message,
            //                     position: 'top-right',
            //                     loaderBg: '#5ba035',
            //                     icon: 'success',
            //                     hideAfter: 1500,
            //                 });
            //             }else{
            //                 $.toast({
            //                     text: response.message,
            //                     position: 'top-right',
            //                     loaderBg: '#bf441d',
            //                     icon: 'error',
            //                     hideAfter: 1500,
            //                     // afterHidden: function(){
            //                     //     location.reload();
            //                     // }
            //                 });
            //             }
            //         },
            //     });
            // });


        });
    </script>
@endsection
