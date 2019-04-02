@extends('layouts.admin.app')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title float-left">Create Product</h4>
                    <a href="{{ url()->previous() }}" >
                        <button class="btn btn-sm btn-secondary btn-bordered waves-effect float-right" type="submit"><i class="fa fa-backward"></i> Back</button>
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
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Select Category</label>
                            <div class="col-6">
                                <select class="form-control" name="categoryId" id="categoryId" parsley-trigger="change" >
                                    <option val="">-- Select --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-3 col-form-label">Product Thumbnail:</label>
                            <div class="col-9">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                        <img src="{{ URL('/resources/assets/images/default.png')}}" id="selectedImage" alt="Select file to preview" style="width: 200px; height: 150px;"/>
                                    </div>
                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-height: 150px; line-height: 20px;"></div>
                                    <div>
                                        <button type="button" class="btn btn-secondary btn-file">
                                            <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                            <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                            <input type="file" class="btn-secondary" id="thumbnail" name="thumbnail" parsley-trigger="change"/>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-3 col-form-label">Product Name:</label>
                            <div class="col-6">
                                <input type="text" name="name" id="name" class="form-control" value="" parsley-trigger="change">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-3 col-form-label">Select Color</label>
                            <div class="col-6">
                                <select class="form-control" name="colorId" id="colorId" parsley-trigger="change">
                                    <option val="">-- Select --</option>
                                    @foreach ($colors as $color)
                                    <option value="{{ $color->id }}">{{ $color->colorName }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-3 col-form-label">Product RAM:</label>
                            <div class="col-6">
                                <input type="number" min="0" name="ram" id="ram" class="form-control" value="" parsley-trigger="change">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-3 col-form-label">Product Battery:</label>
                            <div class="col-6">
                                <input type="number" min="0" name="battery" id="battery" class="form-control" value="" parsley-trigger="change">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-3 col-form-label">Product Processor:</label>
                            <div class="col-6">
                                <input type="text" name="processor" id="processor" class="form-control" value="" parsley-trigger="change">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-3 col-form-label">Product Price:</label>
                            <div class="col-6">
                                <input type="text" name="price" id="price" class="form-control" value="" parsley-trigger="change">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-3 col-form-label">Product Instock:</label>
                            <div class="col-6">
                                <input type="text" min="0" name="stock" id="stock" class="form-control" value="" parsley-trigger="change">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="UPCCode" class="col-3 col-form-label">Unique Product Code (UPC):</label>
                            <div class="col-6">
                                <input type="text" placeholder="" name="upc" class="form-control" parsley-trigger="change">
                            </div>
                        </div>
                        {{-- <div class="form-group row clearfix">
                            <div class="col-sm-12 padding-left-0 padding-right-0">
                                <input type="file" name="multiple_images[]" id="filer_input1"
                                        multiple="multiple">
                            </div>
                        </div> --}}
                        <div class="form-group row">
                            <div class="col-12">
                                <input type="checkbox" id="switchery" data-plugin="switchery" data-size="medium" data-color="#039cfd"  name="multiple_images_checkbox" class="multiple_images_checkbox"/ value="on">
                                <label for="MultipleImages"><h4>Insert Multiple Images </h4></label>
                                <small>(OPTIONAL) (5 Images Maximum)</small>
                            </div>
                        </div>
                        <div id="images" style="display: none">
                            {{-- <div class="form-group row productImages"> --}}
                            <div class="form-group row productImages" id="div_1">
                                <label class="col-3 col-form-label">Image</label>
                                <div class="controls col-2">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <button type="button" class="btn btn-secondary btn-file">
                                            <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select file</span>
                                            <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                            <input type="file" class="btn-secondary" name="multiple_images[]" />
                                        </button>
                                        <span class="fileupload-preview" style="margin-left:5px;"></span>
                                        <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <input type="number" min="1" name="sort[]" id="sort" class="form-control">
                                </div>
                                <div class="col-2 action">
                                    <span class="productImageAdd"><i class="fa fa-2x fa-plus-circle"></i></span>
                                    {{-- <span class="productImageRemove" id="1"><i class="fa fa-2x fa-minus-circle"></i></span> --}}
                                </div>
                            </div>
                        </div>
                        <div class="form-group row col-3 ">
                            <button type="submit" class="btn btn-success waves-effect waves-light">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- end row -->

    </div> <!-- container -->

    @endsection
    @section('script')
         <script>
            $(document).ready(function(){

                // $(document).on('change','.input.multiple_images_checkbox',function(){
                $("input.multiple_images_checkbox").change(function () {
                    if ($("input.multiple_images_checkbox").prop('checked')) {
                        $("#images").show();
                    }else{
                        $("#images").hide();
                    }
                });
                // Add new element
                $(".productImageAdd").click(function(){

                    // Finding total number of elements added
                    var total_element = $(".productImages").length;

                    // last <div> with element class id
                    var lastid = $(".productImages:first").attr("id");
                    var split_id = lastid.split("_");
                    var nextindex = Number(split_id[1]) + 1;

                    var max = 5;
                    // Check total number elements
                    if(total_element < max ){
                        // Adding new div container after last occurance of element class
                        $(".productImages:first").before('<div class="form-group row productImages" id="div_' + nextindex + '"></div>');

                        html_row =      '<label class="col-3 col-form-label">Image </label>'
                            +           '<div class="controls col-2">'
                            +               '<div class="fileupload fileupload-new" data-provides="fileupload">'
                            +                   '<button type="button" class="btn btn-secondary btn-file">'
                            +                       '<span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select file</span>'
                            +                       '<span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>'
                            +                       '<input type="file" class="btn-secondary" name="multiple_images[]" />'
                            +                   '</button>'
                            +                   '<span class="fileupload-preview" style="margin-left:5px;"></span>'
                            +                   '<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>'
                            +               '</div>'
                            +           '</div>'
                            +           '<div class="col-2">'
                            +               '<input type="number" min="1" name="sort[]" id="sort" class="form-control">'
                            +           '</div>'
                            +           '<div class="col-2">'
                            +               '<span class="productImageRemove" id="remove_' + nextindex + '"><i class="fa fa-2x fa-minus-circle"></i></span>'
                            +           '</div>';

                        // Adding element to <div>
                        $("#div_" + nextindex).append(html_row);
                    }
                });

                // Remove element
                $(document).on('click','.productImageRemove',function(){

                    var id = this.id;
                    var split_id = id.split("_");
                    var deleteindex = split_id[1];

                    console.log(id,split_id,deleteindex);
                    // Remove <div> with id
                    $("#div_" + deleteindex).remove();

                });
            });

        </script>

    @endsection
