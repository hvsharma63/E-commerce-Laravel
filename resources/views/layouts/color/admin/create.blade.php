@extends('layouts.admin.app')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title float-left">Add New Colour</h4>
                    <a href="{{ url()->previous() }}" >
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
                    <div class="row">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}<br>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <form action="{{ route('colors.store') }}" id="colorInsertForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="col-3 col-form-label">Colour Name:</label>
                            <div class="col-12">
                                <input type="text" name="colorName" id="colorName" class="form-control colorName" value="" parsley-trigger="change" required>
                            </div>
                        </div>
                        <div class="form-group col-3">
                            <button id="colorSubmit" type="submit" class="btn btn-success waves-effect waves-light">Submit</button>
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

        $(".colorName").blur(function (e) {
            colorName = $(this).val();
            if($.trim(colorName) != ''){
                $.ajax({
                    type: "post",
                    url: "../colors/checkColorName",
                    data: {_token:'{{csrf_token()}}',name:colorName},
                    dataType: "json",
                    success: function (response) {
                        if(response.data == false){
                            $.toast({
                                heading: 'Sorry',
                                text: $("#colorName").val()+ ": " + response.message,
                                position: 'top-right',
                                loaderBg: '#bf441d',
                                icon: 'error',
                                hideAfter: 3000,
                                stack: 1
                            });
                            $("#colorName").val(" ");
                        }
                    }
                });
            }
        });

        $("form#colorInsertForm").submit(function () {
            $(this).find(":submit").prop("disabled", true);
            $(this).find(":submit").text('Submitting..');
        });
    });

    </script>
@endsection

