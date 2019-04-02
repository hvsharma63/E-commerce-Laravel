@extends('layouts.admin.app')

@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title float-left">Colors</h4>
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="{{route('colors.index')}}">Colors</a></li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <div class="row float-right">
                        <a href="{{ route('colors.create')}}" style="margin-right:25px">
                            <button type="button" class="btn btn-primary waves-effect waves-light"><i class="fa fa-plus-circle"></i>&nbsp; Add New Colour</button>
                        </a>
                    </div>
                    <table id="datatable2" class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Sr. No.</th>
                                <th>Color Name</th>
                                <th class="text-center">Status</th>
                                <th>Created at</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead id="colours-list" name="colours-list">
                        <tbody>
                            @foreach ($data as $color)
                                <tr id="color{{$color->id}}">
                                    <td class="text-center">{{ $color->id }}</td>
                                    <td>{{ $color->colorName }}</td>
                                    <td class="text-center">
                                        <input type="checkbox" value="{{$color->id}}" id="switchery{{$color->id}}" data-plugin="switchery" data-size="small" data-color="#039cfd"  name="checkbox" class="checkbox colorSwitch" {{ $color->status == 'Y' ? 'checked' : '' }}/>
                                    </td>
                                    <td>{{ $color->created_at->format('d-m-Y') }}</td>
                                    <td style="text-align: center">
                                        <a class="text-primary" style="padding-right: 5px" href="{{route('colors.edit',['id' => $color->id])}}">
                                           <i class="fa fa-pencil"></i>
                                        </a>
                                        {{-- <form id="delete{{$color->id}}" method="post" action="{{ route('colors.delete',['id' => $color->id]) }}">
                                            @csrf --}}
                                            <a class="text-primary deleteColor" cid="{{$color->id}}" style="padding-left: 5px">
                                               <i class="fa fa-trash"></i>
                                            </a>
                                        {{-- </form> --}}
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

            $(".deleteColor").click(function (e) {
                e.preventDefault();
                id = $(this).attr('cid');
                $.ajax({
                    type: "POST",
                    url: "colors/delete",
                    data: {_token:'{{csrf_token()}}',id:id},
                    dataType: "json",
                    success: function (response) {
                        if(response.data == true){
                            $("tr#color"+id).remove();
                            $.toast({
                                // heading: 'Well done!',
                                text: response.message,
                                position: 'top-right',
                                loaderBg: '#5ba035',
                                icon: 'success',
                                hideAfter: 1500,
                                afterHidden: function(){
                                    location.reload();
                                }
                            });
                            // id--;
                            // $("#datatable1").ajax.reload();

                        }else{
                            $.toast({
                                // heading  : 'Oh snap!',
                                text: response.message + " as it is being used by the products",
                                position: 'top-right',
                                loaderBg: '#bf441d',
                                icon: 'error',
                                hideAfter: 3000,
                                stack: 1
                            });
                        }
                    }
                });
            });

            // Colour Status Switch
            $(".colorSwitch").change(function(e){
                e.preventDefault();
                var colorId = $(this).val();
                // alert(colorId);
                $.ajax({
                    url:"{{url('/admin/colors/changeStatus/')}}",
                    dataType:'json',
                    type:'GET',
                    data:{id:colorId},
                    success:function(response){
                        if(response.data == true){
                            $.toast({
                                text: response.message,
                                position: 'top-right',
                                loaderBg: '#5ba035',
                                icon: 'success',
                                hideAfter: 1500,
                            });
                        }else{
                            $.toast({
                                text: response.message,
                                position: 'top-right',
                                loaderBg: '#bf441d',
                                icon: 'error',
                                hideAfter: 1500,
                                afterHidden: function(){
                                    location.reload();
                                }
                            });
                        }
                    },
                });
            });


        });
    </script>
@endsection
