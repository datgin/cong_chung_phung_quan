<!-- Vendor -->
<script src="assets/libs/jquery/jquery.min.js"></script>
<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/libs/simplebar/simplebar.min.js"></script>
<script src="assets/libs/node-waves/waves.min.js"></script>
<script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
<script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script>
<script src="assets/libs/feather-icons/feather.min.js"></script>

<!-- Apexcharts JS -->
<script src="assets/libs/apexcharts/apexcharts.min.js"></script>

<!-- for basic area chart -->
<script src="assets/apexcharts.com/samples/assets/stock-prices.js"></script>

<!-- Widgets Init Js -->
<script src="assets/js/pages/analytics-dashboard.init.js"></script>

<!-- App js-->
<script src="assets/js/app.js"></script>

<script src="{{ asset('global/js/toastr.js') }}"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
</script>

<script>
    $(document).ready(function() {
        @php
            $types = ['success', 'error', 'info', 'warning'];
        @endphp

        @foreach ($types as $type)
            @if (session()->has($type))
                setTimeout(function() {
                    datgin.{{ $type }}(@json(session($type)));
                }, 600);
                @break
            @endif
        @endforeach
    });
</script>



@stack('script')
