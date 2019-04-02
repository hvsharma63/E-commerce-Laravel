@extends('layouts.admin.app')

@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title float-left">Edit Color</h4>
                    <a href="{{ url()->previous() }}" >
                        <button class="btn btn-secondary btn-bordered waves-effect w-sm float-right" type="submit">Back</button>
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
                    <form action="{{ route('colors.update',['$id' => $Color->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="col-3 col-form-label">Edit Colour Name:</label>
                            <div class="col-6">
                                <input type="text" name="colorName" id="colorName" class="form-control" value="{{ $Color->colorName }}">
                            </div>
                        </div>
                        <div class="form-group col-3 ">
                            <button type="submit" class="btn btn-purple waves-effect waves-light">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- end row -->

    </div> <!-- container -->

@endsection
