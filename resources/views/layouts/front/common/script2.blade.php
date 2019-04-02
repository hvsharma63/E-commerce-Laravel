<script>
        $(document).on("click", "a.btn-remove", function (e) {
            e.preventDefault();
            productId = $(this).attr('pid');
            // alert(productId);
            $(this).closest('li').remove();
            $.ajax({
                type: "post",
                url: "/kart/session/deleteSingleProduct",
                data: {_token:'{{csrf_token()}}',productId:productId},
                dataType: "json",
                success: function (data) {
                    $.toast({
                        heading: 'Just so you know!!',
                        text: 'You removed the product, from the cart!',
                        position: 'bottom-left',
                        loaderBg: '#bf441d',
                        icon: 'error',
                        hideAfter: 3000,
                        stack: 2
                    });
                    $("p.subtotal").load(" p.subtotal");
                }
            });
        });
</script>
