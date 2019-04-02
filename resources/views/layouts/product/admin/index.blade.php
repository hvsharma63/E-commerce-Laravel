@extends('layouts.admin.app')

@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title float-left">Products</h4>
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="{{route('products.index')}}">Products</a></li>
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
                        <a href="{{ route('products.create')}}" style="margin-right:25px">
                            <button type="button" class="btn btn-primary waves-effect waves-light"> <i class="fa fa-plus-circle"></i>&nbsp; Add Product</button>
                        </a>
                    </div>
                    <table class="table table-hover m-0 tickets-list table-actions-bar dt-responsive nowrap" cellspacing="0" width="100%" id="datatable3">
                        <thead>
                            <tr>
                                <th class="text-center">Sr. No.</th>
                                <th class="text-center">Thumbnail</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Color</th>
                                <th class="text-center">Ram</th>
                                <th class="text-center">Battery</th>
                                <th class="text-center">Processor</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Stock</th>
                                <th class="text-center">Status</th>
                                <th>Created at</th>
                                <th>Actions</th>
                            </tr>
                        </thead id="products-list" name="products-list">
                        <tbody>
                            @foreach ($data as $product)
                                <tr id="product{{$product->id}}">
                                    <td class="text-center">{{ $product->id }}</td>
                                    {{-- <td>{{ App\Product::getCategoryName($product->categoryId); }}</td> --}}
                                    <td class="text-center"><img src="/kart/resources/assets/images/products/{{ $product->id }}/{{ $product->thumbnail }}" height="100px" width="100px" alt="Not"></td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category }}</td>
                                    <td>{{ $product->colorName }}</td>
                                    <td class="text-center">{{ $product->ram }}</td>
                                    <td class="text-center">{{ $product->battery }}</td>
                                    <td class="text-center">{{ $product->processor }}</td>
                                    <td class="text-center">{{ $product->price }}</td>
                                    <td class="text-center">{{ $product->stock }}</td>
                                    <td class="text-center">
                                        <input type="checkbox" value="{{$product->id}}" data-plugin="switchery" data-size="small" data-color="#039cfd" onchange="$('#form{{$product->id}}').submit();"  name="checkbox" class="checkbox productSwitch" {{ $product->status == 'Y' ? 'checked' : '' }}/>
                                    </td>
                                    <td>{{ $product->created_at->format('d-m-Y') }}</td>
                                    <td style="text-align:center">
                                        <a style="padding-right: 5px;" class="text-primary" href="{{route('products.edit',['id' => $product->id])}}">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        {{-- <form id="delete{{$product->id}}" method="post" action="{{ route('products.delete',['id' => $product->id]) }}">
                                            @csrf --}}
                                            <a style="padding-left: 5px;" class="deleteProduct text-primary" cid="{{ $product->id }}">
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
        var table3 = $('#datatable3').DataTable();

        $(document).ready(function () {

            $(".deleteProduct").click(function (e) {
                e.preventDefault();
                id = $(this).attr('cid');
                $.ajax({
                    type: "POST",
                    url: "products/delete",
                    data: {_token:'{{csrf_token()}}',id:id},
                    dataType: "json",
                    success: function (response) {
                        if(response.data == true){
                            $("tr#product"+id).remove();
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
                                text: response.message + " as it is being used",
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

            // Product Status Switch
            $(".productSwitch").change(function(e){
                e.preventDefault();
                var productId = $(this).val();
                // alert(productId);
                $.ajax({
                    url:'{{url("/admin/products/changeStatus/")}}',
                    dataType:'json',
                    type:'POST',
                    data:{_token:'{{csrf_token()}}',id:productId},
                    success:function(response){
                        if(response.data == true){
                            $.toast({
                                // heading: 'Well done!',
                                text: response.message,
                                position: 'top-right',
                                loaderBg: '#5ba035',
                                icon: 'success',
                                hideAfter: 3000,
                            });
                        }
                    }
                });
            });
        });

    </script>
@endsection
