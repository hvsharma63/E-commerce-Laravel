@extends('layouts.admin.app')

@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title float-left">Categories</h4>
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="{{route('categories.index')}}">Categories</a></li>
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
                        <a href="{{ route('categories.create')}}" style="margin-right:25px">
                            <button type="button" class="btn btn-primary waves-effect waves-light"><i class="fa fa-plus-circle"></i>&nbsp;Add New Category</button>
                        </a>
                    </div>
                    <table id="datatable1" class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Sr. No.</th>
                                <th class="text-center">Thumbnail</th>
                                <th>Name</th>
                                <th class="text-center">Status</th>
                                <th>Created at</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead id="categories-list" name="categories-list">
                        <tbody>
                            @foreach ($data as $category)
                                <tr id="category{{$category->id}}">
                                    <td class="text-center">{{ $category->id }}</td>
                                    <td class="text-center"><img src="/kart/resources/assets/images/categories/{{ $category->id }}/{{ $category->image }}" style="height: 50px; width: 50px;" alt="Not"></td>
                                    <td>{{ $category->name }}</td>
                                    <td class="text-center">
                                        <input value="{{$category->id}}" id="switchery{{$category->id}}" type="checkbox" data-plugin="switchery" data-size="small" data-color="#039cfd" name="checkbox" class="checkbox categorySwitch" {{ $category->status == 'Y' ? 'checked' : '' }}/>
                                    </td>
                                    <td>{{ $category->created_at->format('d-m-Y')  }}</td>
                                    <td style="text-align:center">
                                        <a style="padding-right: 5px;" class="text-primary" href="{{route('categories.edit',['id' => $category->id])}}">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        {{-- <form id="delete{{$category->id}}" method="post" action="{{ route('categories.delete',['id' => $category->id]) }}"> --}}
                                            {{-- @csrf --}}
                                            {{-- <a onclick="$('form#delete{{$category->id}}').submit();"> --}}
                                            <a style="padding-left: 5px;" class="deleteCategory text-primary" cid="{{ $category->id }}">
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
        </div>
    </div> <!-- container -->

@endsection
@section('script')
    <script>
        var table1 = $('#datatable1').DataTable();

        $(document).ready(function () {

            $(".deleteCategory").click(function (e) {
                e.preventDefault();
                id = $(this).attr('cid');
                $.ajax({
                    type: "POST",
                    url: "categories/delete",
                    data: {_token:'{{csrf_token()}}',id:id},
                    dataType: "json",
                    success: function (response) {
                        if(response.data == true){
                            $("tr#category"+id).remove();
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

            // Category Status Switch
            $(".categorySwitch").change(function(e){
                e.preventDefault();
                var categoryId = $(this).val();
                // alert(categoryId);
                $.ajax({
                    url:'{{url("/admin/categories/changeStatus/")}}',
                    dataType:'json',
                    type:'GET',
                    data:{id:categoryId},
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
                    }
                });
            });
        });

    </script>
@endsection
