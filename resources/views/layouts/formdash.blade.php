<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Kelompok satu</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/backend-plugin.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/backend.css?v=1.0.0')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/remixicon/fonts/remixicon.css')}}">
</head>

<body class=" color-light ">
    <!-- loader Start -->
    {{-- <div id="loading">
        <div id="loading-center">
        </div>
    </div> --}}
    <!-- loader END -->
    <!-- Wrapper Start -->
    <div class="wrapper">

        @include('components.sidebar')
        @include('components.navbar')
        <div class="content-page">
            <div class="container-fluid add-form-list">
                @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <div class="iq-alert-text">{{ session('status') }}</div>
                </div>
                @endif
                <div class="row">
                    <div class="col-sm-12">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Wrapper End-->
    @include('components.footer')
        <!-- Backend Bundle JavaScript -->
        <script src="{{asset('assets/js/backend-bundle.min.js')}}"></script>

        <!-- Table Treeview JavaScript -->
        <script src="{{asset('assets/js/table-treeview.js')}}"></script>

        <!-- Chart Custom JavaScript -->
        <script src="{{asset('assets/js/customizer.js')}}"></script>

        <!-- Chart Custom JavaScript -->
        <script async src="{{asset('assets/js/chart-custom.js')}}"></script>

        <!-- app JavaScript -->
        <script src="{{asset('assets/js/app.js')}}"></script>
</body>

</html>
