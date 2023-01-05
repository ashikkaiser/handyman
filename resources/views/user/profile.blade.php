@extends('frontend.layouts.app')


@section('css')
    <link rel="stylesheet" href="/assets/css/electric.css" />
    <link rel="stylesheet" href="/assets/css/account.css" />
    {{-- <link rel="stylesheet" href="/assets/css/step1.css" /> --}}
@endsection

@section('content')
    <!-- find section start  -->
    <div class="find-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="find-content">


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- find section end -->

    <!-- dashboard title start  -->
    {{-- <div class="dashboard-title mb-5">
        <h1 class="text-center text-black">Dashboard</h1>
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
    </div> --}}
    <!-- dashboard title end -->

    <!-- content section start -->
    <div class="content-section mt-4 mb-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="accounttab col-md-12">
                    <div class="tab-top">
                        <a href="/user/dashboard" class="nav-link">
                            <div class="image-link ">
                                <i class="fas fa-suitcase fa-3x"></i>
                                <span>Jobs</span>
                            </div>
                        </a>
                        <a href="/user/reviews" class="nav-link">
                            <div class="image-link">
                                <i class="fas fa-star fa-3x"></i>
                                <span>Reviews</span>
                            </div>
                        </a>
                        <a href="/user/profile" class="nav-link active">
                            <div class="image-link">
                                <i class="fas fa-user-circle fa-3x"></i>
                                <span>Account</span>
                            </div>
                        </a>
                    </div>

                </div>
                <div class="row mt-3">
                    <div class="card ms-2">
                        <div class="card-body">

                            <div class="d-flex justify-content-center">
                                <div class="card col-md-5" style=" border: none">
                                    @if (session('success'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    @if (session('error'))
                                        <div class="alert alert-danger" role="alert">
                                            {{ session('error') }}
                                        </div>
                                    @endif
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="card-body">
                                        <h3 class="card-title  mb-3 text-capitalize">{{ Auth::user()->name }}
                                        </h3>
                                        <p class="card-subtitle mb-2 text-muted fs-5 mb-3">{{ Auth::user()->email }}
                                            <span
                                                class="badge bg-success  ms-2">{{ Auth::user()->hasVerifiedEmail() ? 'Verified' : 'Not Verified' }}</span>
                                        </p>
                                        @if (!Auth::user()->hasVerifiedEmail())
                                            <p>
                                            <form class="d-inline" method="POST"
                                                action="{{ route('verification.resend') }}">
                                                @csrf
                                                <button type="submit" class="btn btn-link p-0 m-0 align-baseline"
                                                    style="text-decoration: none">{{ __('Click here to request another') }}</button>.

                                            </form>
                                            </p>
                                        @endif

                                        <p class="card-subtitle mb-2 text-muted fs-5 mb-3">{{ Auth::user()->phone }}</p>
                                        <p class="card-subtitle mb-2 text-muted fs-5 mb-3">{{ Auth::user()->post_code }}
                                        </p>




                                        <ul class="list-group">
                                            <li class="list-group-item d-flex justify-content-between align-items-center"
                                                role="button" data-bs-toggle="modal" data-bs-target="#accountModel">
                                                Personal information
                                                <i class="fas fa-arrow-right"></i>
                                            </li>

                                            <li class="list-group-item d-flex justify-content-between align-items-center"
                                                role="button" data-bs-toggle="modal" data-bs-target="#passwordModel">
                                                @if (Auth::user()->password)
                                                    Change password
                                                @else
                                                    Set password
                                                @endif
                                                <i class="fas fa-arrow-right"></i>
                                            </li>

                                            {{-- Logout --}}
                                            <li class="list-group-item d-flex justify-content-between align-items-center"
                                                role="a">
                                                <a href="#"
                                                    onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                                    {{ __('Logout') }}
                                                </a>
                                                <i class="fas fa-arrow-right"></i>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                    class="d-none">
                                                    @csrf
                                                </form>
                                            </li>
                                        </ul>


                                    </div>
                                </div>






                            </div>

                        </div>
                    </div>

                </div>

            </div>

        </div>


    </div>



    <div class="modal fade" id="accountModel" tabindex="-1" aria-labelledby="accountModelLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="accountModelLabel">Edit your details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        @csrf

                        <div class="mb-3">
                            <label for="" class="form-label">First Name</label>
                            <input type="text" name="first_name" class="form-control" required
                                value="{{ explode(' ', Auth::user()->name)[0] ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Last Name</label>
                            <input type="text" name="last_name" required class="form-control"
                                value="{{ explode(' ', Auth::user()->name)[1] ?? '' }}">

                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required
                                value="{{ Auth::user()->email }}" readonly>

                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Phone Number</label>
                            <input type="tel" name="phone" class="form-control" required
                                value="{{ Auth::user()->phone }}">

                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Postcode</label>
                            <input type="tel" name="post_code" class="form-control postal-code" required
                                id="pernalpostcode" value="{{ Auth::user()->post_code }}">

                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="updateProfile" value="true" class="btn tasker-btn">Save
                        changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="passwordModel" tabindex="-1" aria-labelledby="passwordModelLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">

                        @csrf
                        @if (Auth::user()->password)
                            <div class="mb-3">
                                <label for="" class="form-label">Current Password</label>
                                <input type="password" name="current_password" class="form-control" required>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label for="password" class="form-label">New password</label>
                            <input type="password" name="new_password" required class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Confirm password</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        @if (Auth::user()->password)
                            <button type="submit" name="updatePassword" value="true" class="btn tasker-btn">Change
                                password</button>
                        @else
                            <button type="submit" name="setPassword" value="true" class="btn tasker-btn">Set
                                password</button>
                        @endif

                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- content section end -->
@endsection

@section('js')
@endsection
