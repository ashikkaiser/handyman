@extends('frontend.layouts.app')

<style>
    .form-check-input-custom {
        height: 25px;
        width: 25px;
        border-radius: 5px;
        border: 1px solid #204746 !important;
    }

    form-check-input-custom~.checkmark {
        background-color: #2196F3;
    }

    form-check-input-custom:checked~.checkmark {
        background-color: #2196F3;
    }

    .iconImage {

        padding: calc(64px) 16px 0px 32px;
        background-image: url(/assets/images/check-circle-fill.svg);
        background-repeat: no-repeat;
        background-size: auto 490px;
        background-position: calc(34vw - 490px) calc(100% + 50px);
    }


    .timeline li h5 {
        margin-left: 10px
    }

    .timeline li p {
        margin-left: 10px
    }

    ul.timeline {
        list-style-type: none;
        position: relative;
    }

    ul.timeline:before {
        content: ' ';
        background: #07d3cb;
        display: inline-block;
        position: absolute;
        left: 34px;
        width: 2px;
        height: 50%;
        z-index: 1;
        top: 29px;
    }

    ul.timeline>li {
        margin: 20px 0;
        padding-left: 20px;
    }

    ul.timeline>li:first-child::before {
        content: ' ';
        background-image: url(/assets/images/check.png);
        background-repeat: no-repeat;
        /* background: white; */
        display: inline-block;
        position: absolute;
        border-radius: 50%;
        /* border: 3px solid #22c0e8; */
        left: 14px;
        width: 50px;
        height: 50px;
        z-index: 400;
    }

    ul.timeline>li:last-child::before {
        content: ' ';
        background-image: url(/assets/images/check2.png);
        background-repeat: no-repeat;
        /* background: white; */
        display: inline-block;
        position: absolute;
        border-radius: 50%;
        /* border: 3px solid #22c0e8; */
        left: 14px;
        width: 50px;
        height: 50px;
        z-index: 1000000;
    }
</style>


@section('content')
    <div class="">
        @if (session('resent'))
            <div class="alert alert-success" role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
        @endif

        <div style="min-height: 65vh;" class="row">
            <div class="col-md-6 d-flex justify-content-center align-items-center iconImage"
                style="background-color:#edf6ec;">
                <div class="w-50">
                    <ul class="timeline">
                        <li>
                            <h5>Thank You for creating your account with Tradexpert.co.uk </h5>
                            <p>Login to upload your ID verification documents and update your company profile images</p>
                        </li>
                        <li>
                            <h5>Your Documents will be verified by Tradexpert.co.uk</h5>
                            <p>You can check the status of your account approval and your documents verification in your
                                dashboard</p>
                        </li>
                    </ul>

                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-center align-items-center ">
                <div class="w-50">
                    <h3>Login to update your company profile</h3>
                    </h1>
                    <a href="{{ route('login') }}" target="_blank" class="btn btn-primary text-white mt-4 mb-3"
                        rel="noopener noreferrer">Login to your account</a>



                </div>


            </div>

        </div>

    </div>
    {{-- <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }},
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit"
                                class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                        </form>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
@endsection
