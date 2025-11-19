<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-scheme="navy">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="The sidebar will stay in position until you click on the close button.">
    <title>Admin</title>


    <!-- STYLESHEETS -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

    <!-- Fonts [ OPTIONAL ] -->


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&family=Ubuntu:wght@400;500;700&display=swap"
        rel="stylesheet">

    <!-- jQuery -->


    <!-- Toastr CSS -->


    <!-- Toastr JS -->

    <!-- Bootstrap CSS [ REQUIRED ] -->
    <link rel="stylesheet" href="{{ asset('template/assets/css/bootstrap.min.css') }}">

    <!-- Nifty CSS [ REQUIRED ] -->
    <link rel="stylesheet" href="{{ asset('template/assets/css/nifty.min.css') }}">

    <!-- Nifty Demo Icons [ OPTIONAL ] -->
    <link rel="stylesheet" href="{{ asset('template/assets/css/demo-purpose/demo-icons.min.css') }}">

    <!-- Demo purpose CSS [ DEMO ] -->
    <link rel="stylesheet" href="{{ asset('template/assets/css/demo-purpose/demo-settings.min.css') }}">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- DataTables CSS - Gunakan Bootstrap 5 version -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">


    <!-- Custom CSS untuk fix spacing -->
    {{-- <style>
        .table-responsive {
            margin-top: 0;
        }

        .dataTable {
            width: 100% !important;
            margin-top: 0 !important;
        }

        .dataTables_wrapper {
            padding-top: 0;
        }

        .card-body .table-responsive {
            padding: 0;
        }
    </style> --}}

    <!-- Favicons [ OPTIONAL ] -->



    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

   [ REQUIRED ]
   You must include this category in your project.


   [ OPTIONAL ]
   This is an optional plugin. You may choose to include it in your project.


   [ DEMO ]
   Used for demonstration purposes only. This category should NOT be included in your project.


   [ SAMPLE ]
   Here's a sample script that explains how to initialize plugins and/or components: This category should NOT be included in your project.


   Detailed information and more samples can be found in the documentation.
        
   ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <style>
        /* Fix Toastr untuk Dark & Light Mode */
        .toast-info {
            background-color: #2196F3 !important;
        }

        .toast-success {
            background-color: #4CAF50 !important;
        }

        .toast-warning {
            background-color: #FF9800 !important;
        }

        .toast-error {
            background-color: #F44336 !important;
        }

        .toast-title,
        .toast-message {
            color: #ffffff !important;
        }

        #toast-container>div {
            opacity: 1 !important;
        }
    </style>
    <style>
        .nav-link {
            transition: all 0.2s ease;
        }

        .nav-link:hover {
            background: rgba(0, 0, 0, 0.05);
            color: #0d6efd;
        }

        /* Hover child menu */
        .nav .nav .nav-link:hover {
            background: rgba(0, 0, 0, 0.03);
            padding-left: 6px;
            color: #0d6efd;
        }

        /* Chevron rotate */
        .nav-link[aria-expanded="true"] .chevron {
            transform: rotate(180deg);
        }

        .chevron {
            transition: transform .3s ease;
        }

        /* Active parent */
        .nav-link.active-parent {
            background: rgba(13, 110, 253, 0.12);
            font-weight: bold;
            color: #0d6efd !important;
        }

        /* Active child */
        .nav-link.active {
            background: rgba(13, 110, 253, 0.12);
            border-radius: 4px;
        }
    </style>




</head>

<body class="out-quart">


    <!-- PAGE CONTAINER -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <div id="root" class="root mn--max sb--show sb--stuck tm--expanded-hd">

        <!-- CONTENTS -->
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <section id="content" class="content">
            <!-- <div class="content__header content__boxed rounded-0">
            <div class="content__wrap">


               Breadcrumb
               <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="./index.html">Home</a></li>
                     <li class="breadcrumb-item"><a href="./layouts.html">Layouts</a></li>
                     <li class="breadcrumb-item active" aria-current="page">Stuck Sidebar</li>
                  </ol>
               </nav>
               END : Breadcrumb


               <h1 class="page-title mb-0 mt-2">Stuck Sidebar</h1>

               <p class="lead">
                  The sidebar will stay in position until you click on the close button.
               </p>
            </div>

         </div> -->


            <div class="content__boxed">
                <div class="content__wrap">
                    @yield('content')


                </div>
            </div>


            <!-- FOOTER -->

            <footer class="mt-auto">
                <div class="content__boxed">
                    <div class="content__wrap py-3 py-md-1 d-flex flex-column flex-md-row align-items-md-center">
                        <div class="text-nowrap mb-4 mb-md-0">Copyright &copy; 2024 <a href="#"
                                class="ms-1 btn-link fw-bold"></a></div>
                        <nav class="nav flex-column gap-1 flex-md-row gap-md-3 ms-md-auto">
                            <!-- <a class="nav-link link-offset-3 link-underline-hover px-0" href="#">Policy Privacy</a>
                     <a class="nav-link link-offset-3 link-underline-hover px-0" href="#">Terms and conditions</a>
                     <a class="nav-link link-offset-3 link-underline-hover px-0" href="#">Contact Us</a> -->
                        </nav>
                    </div>
                </div>
            </footer>

            <!-- END - FOOTER -->


        </section>

        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <!-- END - CONTENTS -->


        <!-- HEADER -->
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <header class="header">
            <div class="header__inner">

                <!-- Brand -->
                <div class="header__brand">
                    <div class="brand-wrap">

                        <!-- Brand logo -->
                        <!-- <a href="index.html" class="brand-img stretched-link">
                     <img src="./assets/img/logo.svg" alt="Nifty Logo" class="Nifty logo" width="16" height="16">
                  </a> -->


                        <!-- Brand title -->
                        <div class="brand-title">ADMIN</div>


                        <!-- You can also use IMG or SVG instead of a text element. -->
                        <!--
            <div class="brand-title">
               <img src="./assets/img/brand-title.svg" alt="Brand Title">
            </div>
            -->

                    </div>
                </div>
                <!-- End - Brand -->


                <div class="header__content">

                    <!-- Content Header - Left Side: -->
                    <div class="header__content-start">


                        <!-- Navigation Toggler -->
                        <button type="button" class="nav-toggler header__btn btn btn-icon btn-sm"
                            aria-label="Nav Toggler">
                            <i class="demo-psi-list-view"></i>
                        </button>

                        <div class="vr mx-1 d-none d-md-block"></div>

                        <!-- Searchbox -->

                    </div>
                    <!-- End - Content Header - Left Side -->


                    <!-- Content Header - Right Side: -->
                    <div class="header__content-end">


                        <!-- Mega Dropdown -->
                        <div class="dropdown">

                            <!-- Toggler -->
                            <!-- <button class="header__btn btn btn-icon btn-sm" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-label="Megamenu dropdown" aria-expanded="false">
                        <i class="demo-psi-layout-grid"></i>
                     </button> -->

                            <!-- Mega Dropdown Menu -->

                        </div>
                        <!-- End - Mega Dropdown -->


                        <!-- Notification Dropdown -->

                        <!-- End - Notification dropdown -->


                        <!-- User dropdown -->
                        <div class="dropdown">

                            <!-- Toggler -->
                            <!-- <button class="header__btn btn btn-icon btn-sm" type="button" data-bs-toggle="dropdown" aria-label="User dropdown" aria-expanded="false">
                        <i class="demo-psi-male"></i>
                     </button> -->


                            <!-- User dropdown menu -->

                        </div>
                        <!-- End - User dropdown -->


                        <div class="vr mx-1 d-none d-md-block"></div>

                        <div class="form-check form-check-alt form-switch mx-md-2">
                            <input id="headerThemeToggler" class="form-check-input mode-switcher" type="checkbox"
                                role="switch">
                            <label class="form-check-label ps-1 fw-bold d-none d-md-flex align-items-center "
                                for="headerThemeToggler">
                                <i class="mode-switcher-icon icon-light demo-psi-sun fs-5"></i>
                                <i class="mode-switcher-icon icon-dark d-none demo-psi-half-moon"></i>
                            </label>
                        </div>

                        <div class="vr mx-1 d-none d-md-block"></div>

                        <!-- Sidebar Toggler -->
                        <!-- <button class="sidebar-toggler header__btn btn btn-icon btn-sm" type="button" aria-label="Sidebar button">
                     <i class="demo-psi-dot-vertical"></i>
                  </button> -->


                    </div>
                </div>
            </div>
        </header>
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <!-- END - HEADER -->


        <!-- MAIN NAVIGATION -->
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <nav id="mainnav-container" class="mainnav">
            <div class="mainnav__inner">

                <!-- Navigation menu -->
                <div class="mainnav__top-content scrollable-content pb-5">


                    <!-- Profile Widget -->
                    {{-- <div id="_dm-mainnavProfile" class="mainnav__widget my-3 hv-outline-parent"> --}}

                    <!-- Profile picture  -->
                    <!-- <div class="mininav-toggle text-center py-2">
                     <img class="mainnav__avatar img-md rounded-circle hv-oc" src="./assets/img/profile-photos/1.png" alt="Profile Picture">
                  </div> -->




                    {{-- </div> --}}
                    <!-- End - Profile widget -->


                    <!-- Navigation Category -->
                    <div class="mainnav__categoriy py-3">
                        <ul class="mainnav__menu nav flex-column">

                            @php
                                $menus = session('user_menus', []);
                            @endphp

                            @foreach ($menus as $menu)
                                @php
                                    $hasChildren = !empty($menu['children']);
                                    $isParentActive =
                                        request()->routeIs($menu['route_name'] ?? '') ||
                                        collect($menu['children'] ?? [])->contains(
                                            fn($child) => request()->routeIs($child['route_name']),
                                        );
                                @endphp


                                {{-- =======================
                                    MENU DENGAN SUBMENU
                                ======================== --}}
                                @if ($hasChildren)
                                    <li class="nav-item has-sub {{ $isParentActive ? 'active' : '' }}">

                                        <a href="#" class="nav-link mininav-toggle">
                                            <i class="{{ $menu['icon'] }} fs-5 me-2"></i>
                                            <span class="nav-label">{{ $menu['title'] }}</span>
                                            {{-- <i class="bi bi-chevron-down ms-auto small"></i> --}}
                                        </a>

                                        <ul
                                            class="mininav-content nav flex-column {{ $isParentActive ? 'show' : '' }}">
                                            @foreach ($menu['children'] as $child)
                                                <li class="nav-item">
                                                    <a href="{{ route($child['route_name']) }}"
                                                        class="nav-link {{ request()->routeIs($child['route_name']) ? 'active text-primary fw-bold' : '' }}">
                                                        <i class="bi bi-dot"></i> {{ $child['title'] }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>

                                    </li>

                                    {{-- =======================
                                    MENU TANPA SUBMENU
                                ======================== --}}
                                @else
                                    <li class="nav-item">
                                        <a href="{{ route($menu['route_name']) }}"
                                            class="nav-link mininav-toggle {{ request()->routeIs($menu['route_name']) ? 'active text-primary fw-bold' : '' }}">
                                            <i class="{{ $menu['icon'] }} fs-5 me-2"></i>
                                            <span class="nav-label">{{ $menu['title'] }}</span>
                                        </a>
                                    </li>
                                @endif
                            @endforeach

                        </ul>
                    </div>




                    <!-- END : Navigation Category -->


                    <!-- Components Category -->

                    <!-- END : Components Category -->


                    <!-- More Category -->

                    <!-- END : More Category -->


                    <!-- Extras Category -->

                    <!-- END : Extras Category -->


                    <!-- Widget -->

                    <!-- End - Profile widget -->


                </div>
                <!-- End - Navigation menu -->


                <!-- Bottom navigation menu -->
                <div class="mainnav__bottom-content border-top pb-2">
                    <ul id="mainnav" class="mainnav__menu nav flex-column">
                        <li class="nav-item">
                            <a href="#" class="nav-link" id="logoutBtn">
                                <i class="demo-pli-unlock fs-5 me-2"></i>
                                <span class="nav-label ms-1">Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Modal Konfirmasi Logout -->
                <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p class="mb-0">Apakah Anda yakin ingin logout?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Tidak</button>
                                <button type="button" class="btn btn-danger" id="confirmLogout">Ya, Logout</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End - Bottom navigation menu -->


            </div>
        </nav>
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <!-- END - MAIN NAVIGATION -->


        <!-- SIDEBAR -->
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <!-- END - SIDEBAR -->


    </div>
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- END - PAGE CONTAINER -->


    <!-- SCROLL TO TOP BUTTON -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- END - SCROLL TO TOP BUTTON -->


    <!-- BOXED LAYOUT : BACKGROUND IMAGES CONTENT [ DEMO ] -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- END - BOXED LAYOUT : BACKGROUND IMAGES CONTENT [ DEMO ] -->


    <!-- SETTINGS CONTAINER [ DEMO ] -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- END - SETTINGS CONTAINER [ DEMO ] -->


    <!-- OFFCANVAS [ DEMO ] -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- END - OFFCANVAS [ DEMO ] -->


    <!-- JAVASCRIPTS -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->


    <!-- jQuery HARUS PALING ATAS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Popper JS [ OPTIONAL ] -->
    <script src="{{ asset('template/assets/vendors/popperjs/popper.min.js') }}"></script>

    <!-- Bootstrap JS - PILIH SALAH SATU, jangan 2-2nya -->
    <script src="{{ asset('template/assets/vendors/bootstrap/bootstrap.min.js') }}"></script>
    <!-- ATAU jika mau pakai CDN, comment yang atas dan uncomment yang bawah -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->

    <!-- DataTables JS - Gunakan Bootstrap 5 version -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

    <!-- Toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Nifty JS [ OPTIONAL ] -->
    <script src="{{ asset('template/assets/js/nifty.js') }}"></script>

    <!-- Nifty Settings [ DEMO ] -->
    <script src="{{ asset('template/assets/js/demo-purpose-only.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    


    <script>
        var audio = new Audio('{{ asset('audio/notification.ogg') }}');

        $(document).ready(function() {

            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-bottom-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "1000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };

            $('#logoutBtn').on('click', function(e) {
                e.preventDefault();
                var logoutModal = new bootstrap.Modal(document.getElementById('logoutModal'));
                logoutModal.show();
            });

            $('#confirmLogout').on('click', function() {
                audio.play();
                var logoutModal = bootstrap.Modal.getInstance(document.getElementById('logoutModal'));
                logoutModal.hide();

                toastr.info('Sedang logout...', 'Mohon tunggu');

                setTimeout(function() {
                    window.location.href = '{{ url('/paksa-logout') }}';
                }, 1000);
            });
        });
    </script>


    @stack('scripts')

</body>

</html>
