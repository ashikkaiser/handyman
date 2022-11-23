<!DOCTYPE html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="/admin/assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />


    <title>{{ config('app.name', 'Event-Management') }}</title>
    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ site()->favicon }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/fonts/flag-icons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ url('admin/assets/vendor/css/rtl/core.css') }}"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ url('admin/assets/vendor/css/rtl/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ url('admin/assets/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('/admin/assets/vendor/libs/select2/select2.css') }}" />

    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <script src="{{ asset('admin/assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('/admin/assets/vendor/js/template-customizer.js') }}"></script>
    <script src="{{ asset('/admin/assets/js/config.js') }}"></script>

    @yield('css')
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            @include('backend.layouts.menu')
            <!-- / Menu -->
            @if ($message = Session::get('success'))
                <div class="bs-toast toast fade show" role="alert" aria-live="assertive" aria-atomic="true"
                    style="position: absolute; top:5px; right:5px">
                    <div class="toast-header bg-success">
                        <div class="me-auto fw-semibold">Success!</div>
                        <small>now</small>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">{{ $message }}</div>
                </div>
            @endif
            @if ($message = Session::get('error'))
                <div class="bs-toast toast fade show" role="alert" aria-live="assertive" aria-atomic="true"
                    style="position: absolute; top:5px; right:5px">
                    <div class="toast-header bg-danger">
                        <div class="me-auto fw-semibold">Error!</div>
                        <small>now</small>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">{{ $message }}</div>
                </div>
            @endif
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="container-fluid">
                        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                                <i class="bx bx-menu bx-sm"></i>
                            </a>
                        </div>

                        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

                            <!-- /Search -->

                            <ul class="navbar-nav flex-row align-items-center ms-auto">


                                <!-- Style Switcher -->
                                <li class="nav-item me-2 me-xl-0">
                                    <a class="nav-link style-switcher-toggle hide-arrow" href="javascript:void(0);">
                                        <i class="bx bx-sm"></i>
                                    </a>
                                </li>

                            </ul>
                        </div>

                        <!-- Search Small Screens -->
                        <div class="navbar-search-wrapper search-input-wrapper d-none">
                            <input type="text" class="form-control search-input container-fluid border-0"
                                placeholder="Search..." aria-label="Search..." />
                            <i class="bx bx-x bx-sm search-toggler cursor-pointer"></i>
                        </div>
                    </div>
                </nav>

                <!-- / Navbar -->

                @yield('content')


                <!-- Footer -->
                <footer class="content-footer footer bg-footer-theme">
                    <div class="container-fluid d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">

                    </div>
                </footer>
                <!-- / Footer -->

                <div class="content-backdrop fade"></div>
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('/admin/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('/admin/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('/admin/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('/admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('/admin/assets/vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('/admin/assets/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('/admin/assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
    <script src="{{ asset('/admin/assets/vendor/js/menu.js') }}"></script>
    <script src="{{ asset('/admin/assets/vendor/libs/select2/select2.js') }}"></script>

    @yield('js')
    <script src="/admin/assets/js/main.js"></script>
    <script>
        $(function() {
            $('aside a[href^="' + location.href + '"]').addClass('active');

        });
        select2 = $('.select2')
        if (select2.length) {
            var $this = select2;
            $this.wrap('<div class="position-relative"></div>').select2({
                placeholder: 'Select Country',
                dropdownParent: $this.parent()
            });
        }
    </script>

</body>

</html>
