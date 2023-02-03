<!-- jQuery 3 -->
<script src="Files/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="Files/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="Files/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="Files/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="Files/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="Files/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- CK Editor -->
<script src="Files/ckeditor/ckeditor.js"></script>
<script>
    $(function () {
        // Datatable
        $('#example1').DataTable()
        //CK Editor
        CKEDITOR.replace('editor1')
    });
</script>
<!--Magnify -->
<script src="magnify/magnify.min.js"></script>
<script>
    $(function(){
        $('.zoom').magnify();
    });
</script>
<!-- Custom Scripts -->
<script>
    $(function(){
        $('#navbar-search-input').focus(function(){
            $('#searchBtn').show();
        });

        $('#navbar-search-input').focusout(function(){
            $('#searchBtn').hide();
        });

        getCart();

        $('#productForm').submit(function(e){
            e.preventDefault();
            var product = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: 'cart_add.php',
                data: product,
                dataType: 'json',
                success: function(response){
                    $('#callout').show();
                    $('.message').html(response.message);
                    if(response.error){
                        $('#callout').removeClass('callout-success').addClass('callout-danger');
                    }
                    else{
                        $('#callout').removeClass('callout-danger').addClass('callout-success');
                        getCart();
                    }
                }
            });
        });

        $(document).on('click', '.close', function(){
            $('#callout').hide();
        });

    });

    function getCart(){
        $.ajax({
            type: 'POST',
            url: 'cart_fetch.php',
            dataType: 'json',
            success: function(response){
                $('#cart_menu').html(response.list);
                $('.cart_count').html(response.count);
            }
        });
    }
</script>