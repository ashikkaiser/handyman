@extends('frontend.layouts.app')
@section('css')
    <link rel="stylesheet" href="/assets/css/login.css" />
    <link rel="stylesheet" href="/assets/css/step1.css" />
    <style>
        .btn-outline-primary:hover {
            color: #fff !important;


        }

        @media only screen and (max-width: 600px) {


            .login-btn-area {
                padding-top: 50px;
                text-align: center;
            }


        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 col-lg-6 offset-lg-3">
                <div class="login-area">


                    <div class="mt-5">


                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form class="modal-form" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="form-floating mb-3">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    placeholder="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                <label for="">Email address</label>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-floating mb-3">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="current-password" placeholder="password">



                                <label for="">Password</label>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <a href="{{ route('password.request') }}" class="text-primary">Forgot Password?</a>
                            </div>

                            <button class="sign-btn">Log In</button>

                            <div>
                                <hr>
                                <h2 class="text-primary mb-2 mt-5">New to Tradexpert?</h2>

                                <div class="d-grid gap-2 col-12 mx-auto mb-3">
                                    <a href="{{ route('signUp') }}" class="btn btn-outline-primary">
                                        Signup as Tradexpert</a>

                                </div>
                            </div>
                        </form>




                        {{-- <form class="modal-form" action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="text" required name="first_name" class="form-control"
                                    placeholder="First Name" value="{{ old('first_name') }}" />
                                <label for="">Your First Name...</label>
                                @if ($errors->has('first_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" required name="last_name" value="{{ old('last_name') }}"
                                    class="form-control" placeholder="Last Name" />
                                <label for="">Your Last Name...</label>
                                @if ($errors->has('last_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" required name="email" value="{{ old('email') }}"
                                    class="form-control" placeholder="Email" />
                                <label for="">Your Email...</label>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-floating mb-3">
                                <input type="tel" required name="phone" value="{{ old('phone') }}"
                                    class="form-control" placeholder="Phone" />
                                <label for="">Your Phone...</label>
                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" name="post_code" value="{{ old('post_code') }}" id="post_code"
                                    class="form-control" placeholder="Post Code" />
                                <label for="">Your Postalcode...</label>
                                @if ($errors->has('post_code'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('post_code') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" required name="password" class="form-control"
                                    placeholder="Password" />
                                <label for="">Your Password...</label>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <button class="sub-btn" type="submit" href="step2.html">Sign Up</button>
                        </form> --}}


                        {{-- <button class="sign-btn" data-bs-target="#singIn" data-bs-toggle="modal">
                            Log in
                        </button> --}}
                        <div class="modal" id="singIn" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">

                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Sign In</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form class="modal-form" action="{{ route('login') }}" method="POST">
                                        @csrf
                                        <div class="form-floating mb-3">
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                placeholder="email" value="{{ old('email') }}" required
                                                autocomplete="email" autofocus>
                                            <label for="">Your Email...</label>
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                required autocomplete="current-password" placeholder="password">



                                            <label for="">Your Password...</label>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <button class="sub-btn">Log In</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                        {{-- <h6 data-bs-target="#singUp" class=" text-primary" data-bs-toggle="modal">Create account</h6>
                        <h6 class="mb-5">
                            <a href="{{ route('tasker.register.step1') }}" class="text-primary text-bold mb-5 ">
                                Signup as Tradexpert</a>
                        </h6>

                        <div class="modal" id="singUp" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Create account</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form class="modal-form" action="{{ route('register') }}" method="POST">
                                        @csrf
                                        <div class="form-floating mb-3">
                                            <input type="text" required name="first_name" class="form-control"
                                                placeholder="First Name" value="{{ old('first_name') }}" />
                                            <label for="">Your First Name...</label>
                                            @if ($errors->has('first_name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('first_name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" required name="last_name"
                                                value="{{ old('last_name') }}" class="form-control"
                                                placeholder="Last Name" />
                                            <label for="">Your Last Name...</label>
                                            @if ($errors->has('last_name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('last_name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="email" required name="email" value="{{ old('email') }}"
                                                class="form-control" placeholder="Email" />
                                            <label for="">Your Email...</label>
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="tel" required name="phone" value="{{ old('phone') }}"
                                                class="form-control" placeholder="Phone" />
                                            <label for="">Your Phone...</label>
                                            @if ($errors->has('phone'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" name="post_code" value="{{ old('post_code') }}"
                                                id="post_code" class="form-control" placeholder="Post Code" />
                                            <label for="">Your Postalcode...</label>
                                            @if ($errors->has('post_code'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('post_code') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="password" required name="password" class="form-control"
                                                placeholder="Password" />
                                            <label for="">Your Password...</label>
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <button class="sub-btn" type="submit" href="step2.html">Sign Up</button>
                                    </form>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script>
        $(document).ready(function() {
            $('#post_code').on('keyup', function() {
                var post_code = $(this).val();
                console.log(post_code)
                const isValidate = isValidUKPostcode(post_code);
                if (isValidate.error) {
                    $('#post_code').addClass('is-invalid');
                    $('#post_code').removeClass('is-valid');
                } else {
                    $('#post_code').addClass('is-valid');
                    $('#post_code').removeClass('is-invalid');
                    $('#post_code').val(isValidate.formatedPostCode);
                }


            });
        });
    </script>
@endsection
