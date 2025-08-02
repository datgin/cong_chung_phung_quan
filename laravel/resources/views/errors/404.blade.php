<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>

    <meta charset="utf-8" />
    <title>Error 404 | Tapeli - Responsive Admin Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc." />
    <meta name="author" content="Zoyothemes" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- App css -->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

</head>

<!-- body start -->

<body data-menu-color="light" data-sidebar="default">

    <body class="bg-white">

        <!-- Begin page -->
        <div class="maintenance-pages">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <div class="mb-5 text-center">
                                <a class='auth-logo' href='/admin'>
                                    <img src="{{ asset('assets/images/logo-dark.png') }}" alt="logo-dark"
                                        class="mx-auto" height="28" />
                                </a>
                            </div>

                            <div class="maintenance-img">
                                <img src="{{ asset('assets/images/svg/404-error.svg') }}" class="img-fluid"
                                    alt="404 lỗi không tìm thấy">
                            </div>

                            <div class="text-center">
                                <h3 class="mt-5 fw-semibold text-black text-capitalize">Rất tiếc! Không tìm thấy trang
                                </h3>
                                <p class="text-muted">Trang bạn đang cố truy cập không tồn tại hoặc đã được di chuyển.
                                    <br> Vui lòng quay về trang chủ.</p>
                            </div>

                            <a class='btn btn-primary mt-3 me-1' href='/admin'>Quay về trang chủ</a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <!-- END wrapper -->

        <!-- Vendor -->
        <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
        <script src="{{ asset('assets/libs/waypoints/lib/jquery.waypoints.min.js') }}"></script>
        <script src="{{ asset('assets/libs/jquery.counterup/jquery.counterup.min.js') }}"></script>
        <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>

        <!-- App js-->
        <script src="{{ asset('assets/js/app.js') }}"></script>

    </body>


</html>
