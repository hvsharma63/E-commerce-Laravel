@extends('layouts.admin.app')

@section('content')

    <div class="container-fluid">

        @if (Auth::check() && Auth::user()->role == 1)

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Create Category</h4>
                        <a href="../categories" >
                            <button class="btn btn-sm btn-secondary btn-bordered waves-effect float-right" type="submit"><i class="fa fa-backward"></i> Back</button>
                        </a>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-6">
                    <div class="card-box table-responsive">
                        {{-- <div class="row">
                            @if (Session::has('errors'))
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        {{ $error }}<br>
                                    @endforeach
                                </div>
                            @endif
                        </div> --}}
                        <form id="categoryInsertForm" action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data"  role="form">
                            @csrf
                            <div class="form-group">
                                <label class="col-3 col-form-label">Category Name:</label>
                                <div class="col-12">

                                    <input type="text" name="name" id="name" class="categoryName form-control" value="{{ old('name') }}"
                                    parsley-trigger="change" required autofocus>
                                    @if ($errors->has('name'))
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-3 col-form-label">Category Image:</label>
                                <div class="col-12">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                            <img src="{{ URL('/resources/assets/images/default.png')}}" id="selectedImage" alt="Select file to preview" style="width: 200px; height: 150px;"/ >
                                        </div>
                                        <div class="fileupload-preview fileupload-exists thumbnail" style="max-height: 150px; line-height: 20px;"></div>
                                        <div>
                                            <button type="button" class="btn btn-secondary btn-file">
                                                <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                                <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                <input type="file" class="btn-secondary" id="image" name="image"/ parsley-trigger="change" required >
                                            </button>
                                        </div>
                                    </div>
                                    @if ($errors->has('image'))
                                        <p class="text-danger">{{ $errors->first('image') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group col-3 ">
                                <button type="submit" class="btn btn-success waves-effect waves-light">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end row -->

        @endif

    </div>
    <!-- container -->

@endsection
@section('script')

    <script>
    $(document).ready(function () {

        $(".categoryName").blur(function (e) {
            categoryName = $(this).val();
            if($.trim(categoryName) != ''){
                $.ajax({
                    type: "post",
                    url: "../categories/checkCategoryName",
                    data: {_token:'{{csrf_token()}}',name:categoryName},
                    dataType: "json",
                    success: function (response) {
                        if(response.data == false){
                            $.toast({
                                heading: 'Sorry',
                                text: $("#name").val()+ ": " + response.message,
                                position: 'top-right',
                                loaderBg: '#bf441d',
                                icon: 'error',
                                hideAfter: 3000,
                                stack: 1
                            });
                            $("#name").val(" ");
                        }
                    }
                });
            }
        });

        $("form#categoryInsertForm").submit(function () {
            $(this).find(":submit").prop("disabled", true);
            $(this).find(":submit").text('Submitting..');
        });
    });

    </script>
@endsection
