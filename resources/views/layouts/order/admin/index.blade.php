@extends('layouts.admin.app')

@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title float-left">Orders</h4>
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="{{route('orders.showOrders')}}">Orders</a></li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <table id="datatable2" class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Amount</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Payment Status</th>
                                <th class="text-center">Created at</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead id="colours-list" name="colours-list">
                        <tbody>
                            @foreach ($orders as $order)
                                <tr class="text-center" id="order{{$order->id}}">
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->name }}</td>
                                    <td>{{ $order->totalAmount }}</td>
                                    <td>{{ $order->totalQty }}</td>
                                    <td>
                                        <select name="paymentStatus" class="paymentStatus" id="{{$order->id}}">
                                            <option value=""> --SELECT-- </option>
                                            <option value="0" {{ $order->paymentStatus == '0' ? 'selected' : '' }}>Pending</option>
                                            <option value="1" {{ $order->paymentStatus == '1' ? 'selected' : '' }}>Confirmed</option>
                                            <option value="2" {{ $order->paymentStatus == '2' ? 'selected' : '' }}>Cancelled</option>
                                            <option value="3" {{ $order->paymentStatus == '3' ? 'selected' : '' }}>Dispatched</option>
                                            <option value="4" {{ $order->paymentStatus == '4' ? 'selected' : '' }}>Delivered</option>
                                        </select>
                                    </td>
                                    <td>{{ $order->created_at->format('d-m-Y') }}</td>
                                    <td>
                                        <a class="text-primary viewOrder" oid="{{$order->id}}" data-toggle="modal" data-target="#con-close-modal" style="padding-left: 5px">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a class="text-primary deleteorder" oid="{{$order->id}}" style="padding-left: 5px">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end row -->

    </div> <!-- container -->
    <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Products in the Order</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered m-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Product Quantity</th>
                                <th>Product Amount</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody id="productData">

                        </tbody>
                    </table>
                    <div class="mt-3 float-right">
                        Total Price:
                        <p style="display: inline" id="finalPriceValue"> </p>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.modal -->
@endsection
@section('script')
    <script>
        var table2 = $('#datatable2').DataTable();

        $(document).ready(function () {

            $(".viewOrder").click(function () {
                orderId = $(this).attr('oid');
                $("#productData").empty();
                $("#finalPriceValue").empty();
                $.ajax({
                    type: "POST",
                    url: "orders/getProductsByOrder",
                    data: {_token:'{{csrf_token()}}',orderId:orderId},
                    dataType: "json",
                    success: function (response) {
                        total = 0;
                        for(i=0; i<response.length;i++){
                            html = '<tr style="text-align: center">'
                            +   '<td style="text-align: center">' + (i+1) +'</td>'
                            +   '<td>' + response[i]['productName'] +'</td>'
                            +   '<td style="text-align: center">' + response[i]['productQty'] +'</td>'
                            +   '<td style="text-align: center">' + response[i]['productPrice'] +'</td>'
                            +   '<td style="text-align: center">' + response[i]['productQty'] * response[i]['productPrice'] +'</td>'
                            +   '</tr>';
                            $("#productData").append(html);
                            total = total + (response[i]['productQty'] * response[i]['productPrice']);
                        }
                    $("#finalPriceValue").append("$ " + total);
                    console.log(response);
                    }
                });
            });

            $(".deleteorder").click(function() {
                id = $(this).attr('oid');
                swal({
                    title: "Are you sure?",
                    text: "You wanna delete that order!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel!",
                    confirmButtonClass: "btn btn-success",
                    cancelButtonClass: "btn btn-danger m-l-10",
                    buttonsStyling: false
                }).then(
                    function() {
                        $.ajax({
                            type: "POST",
                            url: "orders/delete",
                            data: {_token:'{{csrf_token()}}',id:id},
                            dataType: "json",
                            success: function (response) {
                                if(response.data == true){
                                    $("tr#order"+id).remove();
                                    swal("Deleted!", response.message, "success");
                                }
                                else{
                                    swal("Failed",response.message,"error");
                                }
                            }
                        });
                    },
                    function(dismiss) {
                        // dismiss can be 'cancel', 'overlay',
                        // 'close', and 'timer'
                        if (dismiss === "cancel") {
                            swal(
                                "Cancelled",
                                "Your imaginary file is safe :)",
                                "error"
                            );
                        }
                    }
                );
            });

            $(".paymentStatus").focus(function () {
                // Store the current value on focus, before it changes
                previous = this.value;

                // alert(previous);
            }).change(function(){
                id = $(this).attr('id');
                value = $(this).val();
                previousValue = previous;
                // alert(value);
                swal({
                    title: "Are you sure?",
                    text: "You wanna change the payment status!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, change it!",
                    cancelButtonText: "No, cancel!",
                    confirmButtonClass: "btn btn-success",
                    cancelButtonClass: "btn btn-danger m-l-10",
                    buttonsStyling: false
                }).then(
                    function() {
                        $.ajax({
                            type: "POST",
                            url: "orders/changePaymentStatus",
                            data: {_token:'{{csrf_token()}}',id:id,value:value},
                            dataType: "json",
                            success: function (response) {
                                if(response.data == true){
                                    swal("Changed!", response.message, "success");
                                }
                                else{
                                    swal("Failed",response.message,"error");
                                }
                            }
                        });
                    },
                    function(dismiss) {
                        // dismiss can be 'cancel', 'overlay',
                        // 'close', and 'timer'
                        if (dismiss === "cancel") {
                            swal(
                                "Cancelled",
                                "Don't worry, the status isn't changed :)",
                                "error"
                                );
                            $(".paymentStatus#"+id).val(previousValue);

                        }
                    }
                );
            });
        });
    </script>
@endsection
