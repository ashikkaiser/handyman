<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TRADEXPERT</title>
    <link rel="icon" type="image/x-icon" href="{{ site()->favicon }}">
    <!-- font awesome css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Font Family -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />

    <!-- Bootstrap CSS -->
    {{-- <link rel="stylesheet" href="/assets/css/bootstrap.min.css" /> --}}

    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="/assets/css/owl.carousel.min.css" />
    <link rel="stylesheet" href="/assets/css/owl.theme.default.min.css" />
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />

    <!-- Main CSS -->
    <link rel="stylesheet" href="/assets/css/main.css" />
    <link rel="stylesheet" href="/css/bootstrap.css" />
    <link rel="stylesheet" href="/assets/css/swl.css" />
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="/assets/css/responsive.css" />



    @yield('css')
</head>

<body>
    <!-- NavBar Section Start  -->
    @include('frontend.layouts.nav')
    <!-- NavBar Section End  -->
    {{-- <div class="container"> --}}
    <!-- Content here -->
    @yield('content')

    {{-- </div> --}}
    @if (session('success'))
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 11" data-bs-delay="5000">
            <div id="liveToast" class="toast hide  " role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header bg-light">
                    <strong class="me-auto">Success</strong>

                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body bg-primary text-white">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @endif
    <!-- Footer section start  -->

    @include('frontend.layouts.footer')
    <!-- Footer section End  -->

    @yield('js.search')
    @yield('js')
    <!-- Bootstrap JS -->

    <script>
        var myToastEl = document.getElementById('liveToast')
        var myToast = new bootstrap.Toast(myToastEl)

        @if (session('success'))

            myToast.show()
        @endif
        @if (session('error'))

            myToast.show()
        @endif
    </script>
</body>

</html>
