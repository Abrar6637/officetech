<!-- JAVASCRIPT -->
<script src="{{ URL::asset('/assets/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/metismenu/metismenu.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/node-waves/node-waves.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/feather-icons/feather-icons.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $("#mm-active-1").click(function() {
            $(this).toggleClass("mm-active");
            $("#mm-show-1").toggleClass("mm-show");
            // Close other dropdowns if open
            $("#mm-active-2, #mm-active-3").removeClass("mm-active");
            $("#mm-show-2, #mm-show-3").removeClass("mm-show");
        });

        $("#mm-active-2").click(function() {
            $(this).toggleClass("mm-active");
            $("#mm-show-2").toggleClass("mm-show");
            // Close other dropdowns if open
            $("#mm-active-1, #mm-active-3").removeClass("mm-active");
            $("#mm-show-1, #mm-show-3").removeClass("mm-show");
        });

        $("#mm-active-3").click(function() {
            $(this).toggleClass("mm-active");
            $("#mm-show-3").toggleClass("mm-show");
            // Close other dropdowns if open
            $("#mm-active-1, #mm-active-2").removeClass("mm-active");
            $("#mm-show-1, #mm-show-2").removeClass("mm-show");
        });

        if (window.location.href.indexOf("/main-categories") > -1) {
            $('#mm-main-active-1').addClass("mm-active");
            $('#mm-active-1').addClass("mm-active");
            $("#mm-show-1").addClass("mm-show");
        }
    });
</script>
<!-- pace js -->
<script src="{{ URL::asset('assets/libs/pace-js/pace-js.min.js') }}"></script>
@yield('script')
@yield('script-bottom')

