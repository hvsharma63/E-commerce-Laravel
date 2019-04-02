@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title float-left">Profile</h4>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="offset-md-4 col-md-4">

                <!-- meta -->
                <div class="profile-user-box" style="margin-top: 0">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="media-body">
                                <h4 class="m-t-5 m-b-5 font-18 ellipsis">{{ Auth::user()->firstName ." ".  Auth::user()->lastName  }}</h4>
                                <p class="font-13"> Administrator</p>
                            </div>
                        </div>

                    </div>
                </div>
                <!--/ meta -->
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="offset-md-4 col-md-4">
                <!-- Personal-Information -->
                <div class="card-box">
                    <h4 class="header-title mt-0 m-b-20">Change Password</h4>
                    <div class="panel-body">
                        <hr/>
                        <form class="form-horizontal" action="changePassword" method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="">Old Password:</label>
                                <input id="oldPassword" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="oldPassword">
                                @if ($errors->has('oldPassword'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('oldPassword') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="">New Password:</label>
                                <input id="newPassword" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="newPassword">
                                @if ($errors->has('newPassword'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('newPassword') }}</strong>
                                    </span>
                                @endif

                            </div>
                            <div class="form-group">
                                <label class="">Retype New Password:</label>
                                <input id="password-confirm" type="password" class="form-control" name="newPassword_confirmation">
                            </div>
                            <button type="submit" name="" id="" class="btn btn-primary" btn-lg btn-block">Submit</button>
                        </form>

                    </div>
                </div>
                <!-- Personal-Information -->

            </div>

        </div>
        <!-- end row -->

        <!-- end row -->
    </div> <!-- container -->
@endsection
