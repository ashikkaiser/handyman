<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TRADEXPERT</title>

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
    <link rel="stylesheet" href="/css/bootstrap.css" />

    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="/assets/css/owl.carousel.min.css" />
    <link rel="stylesheet" href="/assets/css/owl.theme.default.min.css" />

    <!-- Main CSS -->
    <link rel="stylesheet" href="/assets/css/main.css" />
    <link rel="stylesheet" href="/assets/css/swl.css" />

    <!-- Responsive CSS -->
    @yield('css')
    <link rel="stylesheet" href="/assets/css/responsive.css" />


    <style>
        .event-list li.active {
            background: #2b605f !important;
        }

        .event-list li.active a {
            color: white !important;
        }

        .event-list li.active a:hover {
            color: white !important;
        }
    </style>
</head>

<body>
    <!-- NavBar Section Start  -->
    @include('frontend.layouts.nav')
    <!-- NavBar Section End  -->

    <!-- find section start  -->
    <div class="find-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    {{-- <h4 class="text-center text-white">Tasker Dashboard</h4> --}}

                    @if (isset(auth()->user()->company))
                        <h5 class="text-center text-white">Welcome {{ auth()->user()->company->business_name }}</h5>
                        @if (auth()->user()->company->is_active == false)
                            <h5 class="text-center text-danger">Your account is not published yet</h5>
                        @endif
                    @endif


                </div>
            </div>
        </div>
    </div>


    <div class="content-section mt-4 mb-5 pb-5">
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 11" data-bs-delay="5000">
            <div id="javaToast" class="toast hide  " role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header bg-light">
                    <strong class="me-auto">Success</strong>

                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body bg-primary text-white">
                    <p id="javaToastMessage"></p>
                </div>
            </div>
        </div>
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
        <div class="container">
            <div class="row">
                <div class="col-lg-4">

                    <div class="event-list mt-4">
                        <p>Events and Entertainment</p>

                        <ul>
                            <li class="{{ Route::is('tasker.dashboard') ? 'active' : '' }}"><a
                                    href="{{ route('tasker.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="{{ Route::is('tasker.account') ? 'active' : '' }}"><a
                                    href="{{ route('tasker.account') }}">Account details</a>
                            </li>
                            <li class="{{ Route::is('tasker.membership') ? 'active' : '' }}"><a
                                    href="{{ route('tasker.membership') }}">
                                    My membership plan</a></li>
                            <li class="{{ Route::is('tasker.mybillingPoral') ? 'active' : '' }}"><a
                                    href="{{ route('tasker.mybillingPoral') }}">
                                    My Billing Portal</a></li>
                            <li class="{{ Route::is('tasker.skills') ? 'active' : '' }}"><a
                                    href="{{ route('tasker.skills') }}">My skills</a></li>
                            <li class="{{ Route::is('tasker.jobs') ? 'active' : '' }}"><a
                                    href="{{ route('tasker.jobs') }}">My job</a></li>
                            <li class="{{ Route::is('tasker.credits') ? 'active' : '' }}"><a
                                    href="{{ route('tasker.credits') }}">My credits</a></li>
                            <li class="{{ Route::is('tasker.saveJob') ? 'active' : '' }}"><a
                                    href="{{ route('tasker.saveJob') }}">My saved jobs</a></li>
                        </ul>


                        <div class="log-out mt-3">
                            <a class="log-out" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>

                            </a>

                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    @yield('content')
                </div>


            </div>
        </div>
    </div>


    <!-- Footer section start  -->
    @include('frontend.layouts.footer')
    <script>
        var myToastEl = document.getElementById('liveToast')
        var myToast = new bootstrap.Toast(myToastEl)

        @if (session('success'))

            myToast.show()
        @endif
    </script>
    <!-- Footer section End  -->
    @yield('js')




</body>

</html>
