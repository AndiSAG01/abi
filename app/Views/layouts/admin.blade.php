<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Kerinci Smart Tourism</title>
    <!-- base:css -->
    <link rel="stylesheet" href="/admin/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/admin/vendors/css/vendor.bundle.base.css">

    @include('layouts.font')
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="/admin/css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="/admin/images/logo.jpg" />
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css">



</head>

<body>
    <div class="container-scroller d-flex">
        <div class="alert-container">
            @include('admins.alert')

        </div>
        <!-- partial:./partials/_sidebar.html -->
        @include('partials.sidebar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:./partials/_navbar.html -->
            <nav class="navbar col-lg-12 col-12 px-0 py-0 py-lg-4 d-flex flex-row">
                <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                        data-toggle="minimize">
                        <span class="mdi mdi-menu"></span>
                    </button>
                    <div class="navbar-brand-wrapper">
                        <a class="navbar-brand brand-logo" href="index.html"><img src="/admin/images/logo.jpg"
                                alt="logo" class="rounded-circle" style="width: 50px;" /></a>
                        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="/admin/images/logo.jpg"
                                alt="logo" class="rounded-circle" style="width: 50px;" /></a>
                    </div>
                    <h4 class="font-weight-bold mb-0 d-none d-md-block mt-1">Selamat Datang, <?= esc($user_name) ?></h4>
                    <ul class="navbar-nav navbar-nav-right">
                        <li class="nav-item">
                            <h4 class="mb-0 font-weight-bold d-none d-xl-block"><?= esc($today) ?></h4>
                        </li>

                    </ul>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                        data-toggle="offcanvas">
                        <span class="mdi mdi-menu"></span>
                    </button>
                </div>
                <div class="navbar-menu-wrapper navbar-search-wrapper d-none d-lg-flex align-items-center"
                    style="background:transparent">

                    <ul class="navbar-nav navbar-nav-right">
                        <li class="nav-item nav-profile dropdown text-white">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                id="profileDropdown">
                                <img src="/admin/images/faces/face5.jpg" alt="profile" class="rounded-circle" />
                                <span class="nav-profile-name text-white"><?= esc($user_name) ?></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                                aria-labelledby="profileDropdown">
                                <a href="{{ site_url('/admins/bank') }}" class="dropdown-item">
                                    <i class="mdi mdi-settings text-primary"></i>
                                    Setting Akun Bank
                                </a>
                                <a href="<?php echo base_url('logout'); ?>" class="dropdown-item">
                                    <i class="mdi mdi-logout text-primary"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                @yield('content')
                <footer class="footer mt-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-sm-flex justify-content-center justify-content-sm-between py-2">
                                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">© 2025 | Kerinci Smart Tourism
                                   </span>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- base:js -->
    <script src="/admin/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <script src="/admin/vendors/chart.js/Chart.min.js"></script>
    <script src="/admin/js/jquery.cookie.js" type="text/javascript"></script>
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="/admin/js/off-canvas.js"></script>
    <script src="/admin/js/hoverable-collapse.js"></script>
    <script src="/admin/js/template.js"></script>
    <!-- endinject -->
    <!-- plugin js for this page -->
    <script src="/admin/js/jquery.cookie.js" type="text/javascript"></script>
    <script src="/admin/vendors/sweetalert/sweetalert2.all.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- Custom js for this page-->
    <script src="/admin/js/dashboard.js"></script>
    <script src="https://kit.fontawesome.com/be87c3e44a.js" crossorigin="anonymous"></script>

    <!-- End custom js for this page-->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                responsive: true,
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
                }
            });
        });
    </script> 
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js"></script>
    <!-- jQuery -->

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>


</body>

</html>
