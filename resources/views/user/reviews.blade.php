@extends('frontend.layouts.app')


@section('css')
    <link rel="stylesheet" href="/assets/css/electric.css" />
    <link rel="stylesheet" href="/assets/css/account.css" />
    <style>
        .img-rounded {
            border-radius: 50%;
            height: 100px;
            width: 100px;
        }
    </style>
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
                        <a href="/user/reviews" class="nav-link active">
                            <div class="image-link">
                                <i class="fas fa-star fa-3x"></i>
                                <span>Reviews</span>
                            </div>
                        </a>
                        <a href="/user/profile" class="nav-link ">
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


                            @forelse ($reviews as $item)
                                <div class="row">
                                    <div class="col align-self-center">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <img src="/{{ $item->company->logo }}" class="img img-rounded img-fluid" />
                                                <p class="text-secondary text-center">{{ $item->company->name }}</p>
                                            </div>
                                            <div class="col-md-7">
                                                <p>
                                                    <a class="float-left"
                                                        href="#"><strong>{{ $item->user->name }}</strong></a>
                                                    {{-- <span class="float-right"><i class="text-warning fa fa-star"></i></span>
                                                    <span class="float-right"><i class="text-warning fa fa-star"></i></span>
                                                    <span class="float-right"><i class="text-warning fa fa-star"></i></span>
                                                    <span class="float-right"><i class="text-warning fa fa-star"></i></span>
                                                    <span class="float-right"><i class="text-warning fa fa-star"></i></span> --}}
                                                </p>
                                                <div class="clearfix"></div>
                                                <p>{{ $item->review }}</p>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @empty
                                <div class="row justify-content-center">
                                    <div class="col-6">
                                        <p class="card-text">All your past reviews will be saved here. You can still review
                                            Tradexpert that you've previously worked with.

                                        </p>
                                    </div>
                                    <div class="col-3">
                                        <a href="{{ route('giveFeedback') }}" class="btn tasker-btn">Find Tradexpert to
                                            review</a>
                                    </div>
                                </div>
                            @endforelse


                        </div>
                    </div>

                </div>

            </div>

        </div>


    </div>

    <!-- content section end -->
@endsection

@section('js')
@endsection
