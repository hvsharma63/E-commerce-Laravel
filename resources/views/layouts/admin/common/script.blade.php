<!-- jQuery  -->
<script src="{{ URL('/resources/assets/js/jquery.min.js')}}"></script>
<script src="{{ URL('/resources/assets/js/tether.min.js')}}"></script><!-- Tether for Bootstrap -->
<script src="{{ URL('/resources/assets/js/bootstrap.min.js')}}"></script>
<script src="{{ URL('/resources/assets/js/metisMenu.min.js')}}"></script>
<script src="{{ URL('/resources/assets/js/waves.js')}}"></script>
<script src="{{ URL('/resources/assets/js/jquery.slimscroll.js')}}"></script>

<!-- Autonumberic -->
<script src="{{URL('/resources/assets/plugins/autoNumeric/autoNumeric.js')}}"></script>

<!-- Input Mask js -->
<script src="{{ URL('/resources/assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')}}" type="text/javascript"></script>
<script src="{{ URL('/resources/assets/plugins/autoNumeric/autoNumeric.js')}}" type="text/javascript"></script>

<!-- Jquery filer js -->
<script src="{{ URL('/resources/assets/plugins/jquery.filer/js/jquery.filer.min.js')}}"></script>

<!-- Parsley js -->
<script type="text/javascript" src="{{ URL('/resources/assets/plugins/parsleyjs/parsley.min.js')}}"></script>

<!-- Toastr js -->
<script src="{{ URL('/resources/assets/plugins/jquery-toastr/jquery.toast.min.js')}}" type="text/javascript"></script>
<script src="{{ URL('/resources/assets/pages/jquery.toastr.js')}}" type="text/javascript"></script>

<!-- Required Swithcery.min js -->
<script src="{{ URL('/resources/assets/plugins/switchery/switchery.min.js')}}"></script>

<!-- Required datatable js -->
<script src="{{ URL('/resources/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ URL('/resources/assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ URL('/resources/assets/plugins/datatables/dataTables.responsive.min.js')}}"></script>


<!-- Bootstrap fileupload js -->
<script src="{{ URL('/resources/assets/plugins/bootstrap-fileupload/bootstrap-fileupload.js')}}"></script>

<!-- page specific js -->
<script src="{{ URL('/resources/assets/pages/jquery.fileuploads.init.js')}}"></script>

<!-- Sweet-Alert  -->
<script src="{{ URL('/resources/assets/plugins/sweet-alert2/sweetalert2.min.js')}}"></script>
<script src="{{ URL('/resources/assets/pages/jquery.sweet-alert.init.js')}}"></script>

<!-- Counter js  -->
<script src="{{ URL('/resources/assets/plugins/waypoints/jquery.waypoints.min.js')}}"></script>
<script src="{{ URL('/resources/assets/plugins/counterup/jquery.counterup.min.js')}}"></script>

<!--C3 Chart-->
<script type="text/javascript" src="{{ URL('/resources/assets/plugins/d3/d3.min.js')}}"></script>
<script type="text/javascript" src="{{ URL('/resources/assets/plugins/c3/c3.min.js')}}"></script>

<!--Echart Chart-->
<script src="{{ URL('/resources/assets/plugins/echart/echarts-all.js')}}"></script>

<!-- Dashboard init -->
<script src="{{ URL('/resources/assets/pages/jquery.dashboard.js')}}"></script>

<!-- App js -->
<script src="{{ URL('/resources/assets/js/jquery.core.js')}}"></script>
<script src="{{ URL('/resources/assets/js/jquery.app.js')}}"></script>

 <!-- Google Charts js -->
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<!-- Init -->
{{-- <script type="text/javascript" src="{{ URL('/resources/assets/pages/jquery.google-charts.init.js')}}"></script> --}}

<script>
    // @if(Session::has('success'))
    //     toastr.success('{{ Session::get('success')  }}')
    // @endif

    $(document).ready(function() {
        // DataTable Initialization
        var datat = $('#datatable').DataTable();

        // Parsley Form Validation Initialization
        // $('form').parsley();

        // AJAX Headers
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        @if(Session::has('success'))
            $.toast({
                // heading: 'Well done!',
                text: "{{ Session::get('success') }}",
                position: 'top-right',
                loaderBg: '#5ba035',
                icon: 'success',
                hideAfter: 1500,
            });
            @php
                Session::forget('success');
            @endphp
        @endif

        // The charCode property returns the Unicode character code of the key that triggered the onkeypress event
        // The event.which property returns which keyboard key or mouse button was pressed for the event.
        // The fromCharCode() method converts Unicode values into characters.
        $('input[type=text]').keypress(function (e) {
            var regex = new RegExp("^[ a-zA-Z._0-9]+$");
            var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
            if (regex.test(str)) {
                return true;
            }
            e.preventDefault();
            return false;
        });

        $('input[type=number]').keypress(function (e) {
            var regex = new RegExp("^[0-9]+$");
            var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
            if (regex.test(str)) {
                return true;
            }
            e.preventDefault();
            return false;
        });


    });

    // Autonumberic Plugin Initialization
    jQuery(function($) {
        $('.autonumber').autoNumeric('init');
    });
</script>
