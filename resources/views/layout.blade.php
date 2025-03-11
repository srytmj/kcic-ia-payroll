@php
    $users = Auth::user();
@endphp

<!DOCTYPE html>
<html lang="en">
<meta name="csrf-token" content="{{ csrf_token() }}">


@include('partials.head')

<body class="">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->

    @include('partials.sidebar')

    @include('partials.header')

    @yield('content')



    <!-- Required Js -->
    <script src="{{ asset('assets/js/vendor-all.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/ripple.js') }}"></script>
    <script src="{{ asset('assets/js/pcoded.min.js') }}"></script>
    <script src="{{ asset('assets/js/menu-setting.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Apex Chart -->
    {{-- <script src="{{ asset('assets/js/plugins/apexcharts.min.js') }}"></script> --}}
    <!-- custom-chart js -->
    {{-- <script src="{{ asset('assets/js/pages/dashboard-main.js') }}"></script> --}}

    <!-- datatable Js -->
    <script src="{{ asset('assets/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/data-api-custom.js') }}"></script>
    <script src="{{ asset('assets/js/menu-setting.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/data-select-custom.js') }}"></script>

    <!-- select2 Js -->
    <script src="{{ asset('assets/js/plugins/select2.full.min.js') }}"></script>
    <!-- form-select-custom Js -->
    <script src="{{ asset('assets/js/pages/form-select-custom.js') }}"></script>
    <!-- Apex Chart -->
    <script src="assets/js/plugins/apexcharts.min.js"></script>


    <!-- custom-chart js -->
    <script src="assets/js/pages/dashboard-analytics.js"></script>

</body>

</html>
