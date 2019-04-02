@extends('layouts.admin.app')

@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title float-left">Edit Product</h4>
                    <a href="{{ url()->previous() }}" >
                        <button class="btn btn-secondary btn-bordered waves-effect w-sm float-right" type="submit"><i class="fa fa-backward"></i> Back</button>
                    </a>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    <div class="row">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}<br>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <form action="{{ route('products.update',['$id' => $product->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Select Category</label>
                            <div class="col-6">
                                {{-- <select class="form-control" name="categoryId" id="categoryId"> --}}
                                    @foreach ($categories as $category)
                                        @if ($product->categoryId == $category->id)
                                            <span class="form-control">{{ $category->name }}</span>
                                            {{-- <a class="btn btn-primary" style="background-color: #64C5B1 !important; border: #64C5B1 !importants" role="button">{{ $category->name }}</a> --}}
                                        @endif
                                            {{-- {{ if($product->categoryId == $category->id) $category->name }}</p> --}}
                                        {{-- <option value="{{ $category->id }}" {{ $product->categoryId == $category->id  ? 'selected' : '' }}>{{ $category->name }}</option> --}}
                                    @endforeach
                                {{-- </select> --}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-3 col-form-label">Product Image:</label>
                            <div class="col-9">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                        <img src="/kart/resources/assets/images/products/{{ $product->id }}/{{ $product->thumbnail }}" id="selectedImage" alt="Select file to preview" style="width: 200px; height: 150px;"/>
                                    </div>
                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-height: 150px; line-height: 20px;"></div>
                                    <div>
                                        <button type="button" class="btn btn-secondary btn-file">
                                            <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                            <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                            <input type="file" class="btn-secondary" id="thumbnail" name="thumbnail"/>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-3 col-form-label">Product Name:</label>
                            <div class="col-6">
                                <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-3 col-form-label">Select Color</label>
                            <div class="col-6">
                                <select class="form-control" name="colorId" id="colorId">
                                    @foreach ($colors as $color)
                                        <option value="{{ $color->id }}" {{ $product->colorId == $color->id  ? 'selected' : '' }}>{{ $color->colorName }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-3 col-form-label">Product RAM:</label>
                            <div class="col-6">
                                <input type="number" min="0" name="ram" id="ram" class="form-control" value="{{ $product->ram }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-3 col-form-label">Product Battery:</label>
                            <div class="col-6">
                                <input type="number" min="0" name="battery" id="battery" class="form-control" value="{{ $product->battery }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-3 col-form-label">Product Processor:</label>
                            <div class="col-6">
                                <input type="text" name="processor" id="processor" class="form-control" value="{{ $product->processor }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-3 col-form-label">Product Price:</label>
                            <div class="col-6">
                                <input type="text" name="price" id="price" class="form-control" value="{{ $product->price }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="UPCCode" class="col-3 col-form-label">Unique Product Code (UPC):</label>
                            <div class="col-6">
                                <span class="form-control">{{ $product->upc }}</span>
                                {{-- <a class="btn btn-primary" style="background-color: #64C5B1" role="button">{{ $product->upc }}</a> --}}
                                {{-- <input type="text" placeholder="" name="upc" class="form-control" value="{{ $product->upc }}"> --}}
                            </div>
                        </div>

                        {{-- <div class="form-group row">
                            <label class="col-3 col-form-label">Product Instock:</label>
                            <div class="col-6">
                                <input type="text" min="0" name="stock" id="stock" class="form-control" value="{{ $product->stock }}">
                            </div>
                        </div> --}}

                        <div class="form-group row">
                            <div class="col-12">
                                <label for="MultipleImages"><h4>Insert/Update Multiple Images </h4></label>
                                <small>(OPTIONAL)</small>
                            </div>
                        </div>
                        @php
                            $j = 1;
                            $total = count($productImages);
                            $max = count($productImages);
                            $i = count($productImages);
                        @endphp
                        @if (isset($productImages))
                            @foreach ($productImages as $productImage)
                                <div class="form-group row productImages" id="div_{{ $j }}">
                                    <label class="col-3 col-form-label">Image</label>
                                    <div class="controls col-2">
                                        <div class="fileupload fileupload-exists" data-provides="fileupload">
                                            <input type="hidden" value="" name="">
                                            <button type="button" class="btn btn-secondary btn-file">
                                                {{-- <span class="fileupload-new"><i class="fa fa-paper-clip"></i>Select</span> --}}
                                                <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                <input type="file" class="btn-secondary" name="multiple_images[]" value="{{$productImage->image}}"/>
                                            </button>
                                            <span class="fileupload-preview" style="margin-left:5px;">{{$productImage->image}}</span>
                                            <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
                                        </div>
                                    </div>
                                    {{-- <div class="col-6">
                                        <input type="file" class="default" value="/kart/resources/assets/images/products/{{ $productImage->piId }}/{{ $productImage->image }}"/>
                                    </div> --}}
                                    <div class="col-2">
                                        <input type="number" min='1' name="sort[]" id="sort" class="form-control" value="{{$productImage->sort}}">
                                        <input type="hidden" name="piId[]" value="{{$productImage->id}}">
                                    </div>
                                    <div class="col-2">
                                        {{-- <button type="button" id="productImageAdd">Add</button> --}}
                                        <span id="productImageAdd"><i class="fa fa-2x fa-plus-circle"></i></span>
                                        {{-- @else --}}

                                        {{-- @if ($max-$j==0) --}}
                                            <span class="productImageRemove" id="{{ $j }}" value="{{$productImage->id}}"><i class="fa fa-2x fa-minus-circle"></i></span>
                                        {{-- @endif --}}
                                    </div>
                                    {{-- Old space for input product image --}}
                                </div>
                                <input type="hidden" name="multiple_images[]" value="{{$productImage->image}}">
                                @php
                                    $j++;
                                @endphp
                            @endforeach
                        @endif

                        <div class="form-group row col-3 ">
                            <button type="submit" class="btn btn-success waves-effect waves-light">Update</button>
                        </div>

                    </form>
                </div>
            </div>
        </div> <!-- end row -->

    </div> <!-- container -->

@endsection
@section('script')
    <script>
        $(document).ready(function () {

            // AJAX Headers
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var i = {{ count($productImages) }}
            var total = {{ count($productImages) }}
            // alert(total);


            $(document).on("click", ".productImageRemove", function() {
                var id = $(this).attr("id");
                var productImageId = $(this).attr("value");
                if(productImageId!=undefined){
                    alert(productImageId);
                    $.ajax({
                        url: "{{route('products.deleteMultipleImage')}}",
                        type: "POST",
                        data: {id:productImageId,_token:'{{csrf_token()}}'},
                        dataType: "json",
                        success: function (response) {
                            console.log($response)
                        }
                    });
                }else{
                    alert('No value');
                }
                // confirm("Is this what you want to delete" + productImage+ "?");
                // alert(i);
                if(i==1){
                    alert("Last Element Cannot be deleted");
                }
                else{
                    $("#" + id).closest("#div_" + id).remove();
                    i--;
                }


            });

            // alert(i);
            $(document).on("click", "#productImageAdd", function() {
                var html_row = "";
                i++;
                html_row ='<div class="form-group row productImages" id="div_'+i+'">'
                    +   '<input type="hidden" name="new_multiple_images[]" value="">'
                    +          '<label class="col-3 col-form-label">Image </label>'
                    +          '<div class="controls col-2">'
                    +               '<div class="fileupload fileupload-new" data-provides="fileupload">'
                    +                   '<button type="button" class="btn btn-secondary btn-file">'
                    +                       '<span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select file</span>'
                    +                       '<span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>'
                    +                       '<input type="file" class="btn-secondary" name="new_multiple_images[]" value="{{$productImage->image}}"/>'
                    +                   '</button>'
                    +                   '<span class="fileupload-preview" style="margin-left:5px;"></span>'
                    +                   '<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>'
                    +               '</div>'
                    +           '</div>'
                    +           '<div class="col-2">'
                    +               '<input type="number" min="1" name="new_sort[]" id="sort" class="form-control">'
                    +           '</div>'
                    +           '<div class="col-2">'
                    +               '<span id="productImageAdd"><i class="fa fa-2x fa-plus-circle"></i></span>'
                    +               '<span class="productImageRemove" id="'+i+'"><i class="fa fa-2x fa-minus-circle"></i></span>'
                    +               '<br>'
                    +           '</div>'
                    +   '</div>';
                $(html_row).insertAfter("#div_"+(i-1));
            // $("#images").append(html_row);
            });

        });
    </script>
@endsection
