<!-- jQuery -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
            $.ajax({
                type: 'get',
                url: '{!! URL::to('getMessage')!!}',
                data: {
                },
                success: function(data) {
                    //console.log(data);

                    $('#message').html('');
                    $('#message').append(data);
                },
                error: function() {

                }
            });
        $.ajax({
            type: 'get',
            url: '{!! URL::to('getCart')!!}',
            data: {
            },
            success: function(data) {
                //console.log(data);

                $('#cart').html('');
                $('#cart').append(data);
            },
            error: function() {

            }
        });
        });
</script>
<!-- Vendor JS Files -->
<script src="{{ asset('assets/css/pp/js/glightbox.min.js') }}"></script>
<script type="text/javascript">
    const lightbox = GLightbox();
</script>

@yield('script')
