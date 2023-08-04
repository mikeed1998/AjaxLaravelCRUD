<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    $(document).ready(function() {
        $(document).on('click', '.add_product', function(e) {
            e.preventDefault();
            let name = $('#name').val();
            let price = $('#price').val();
            // console.log(name + price);

            $.ajax({
                url: "{{ route('add.product') }}",
                method: 'post',
                data: {
                    name: name,
                    price: price
                },
                success:function(res) {
                    if(res.status == 'success') {
                        $('#addModal').modal('hide');
                        $('#addProductForm')[0].reset();
                        // $('.table-data').load(location.href+'.table-data');
                        $('.table-data').load(location.href + ' .table-data', function() {
                            setupAddProductEvent(); // Vuelve a configurar el evento
                        });
                    }
                }, error:function(err) {
                    $('.errMsgContainer').html('');
                    let error = err.responseJSON;
                    $.each(error.errors, function(index, value) {
                        $('.errMsgContainer').append('<span class="text-danger">'+ value +'</span>'+'<br>');
                    });
                }
            });
        });

        // show product value in update form
        $(document).on('click', '.update_product_form', function() {
            let id = $(this).data('id');
            let name = $(this).data('name');
            let price = $(this).data('price');

            $('#up_id').val(id);
            $('#up_name').val(name);
            $('#up_price').val(price);
        });

        // update product
        $(document).on('click', '.update_product', function(e) {
            e.preventDefault();
            let up_id = $('#up_id').val();
            let up_name = $('#up_name').val();
            let up_price = $('#up_price').val();
            // console.log(name + price);

            $.ajax({
                url: "{{ route('update.product') }}",
                method: 'post',
                data: {
                    up_id: up_id,
                    up_name: up_name,
                    up_price: up_price
                },
                success:function(res) {
                    if(res.status == 'success') {
                        $('#updateModal').modal('hide');
                        $('#updateProductForm')[0].reset();
                        // $('.table-data').load(location.href+'.table-data');
                        $('.table-data').load(location.href + ' .table-data', function() {
                            setupAddProductEvent(); // Vuelve a configurar el evento
                        });
                    }
                }, error:function(err) {
                    $('.errMsgContainer').html('');
                    let error = err.responseJSON;
                    $.each(error.errors, function(index, value) {
                        $('.errMsgContainer').append('<span class="text-danger">'+ value +'</span>'+'<br>');
                    });
                }
            });
        });
    });
</script>