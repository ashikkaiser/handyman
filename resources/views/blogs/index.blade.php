@extends('frontend.layouts.app')


@section('js')
    <link rel="stylesheet" href="/assets/css/swiper-bundle.min.css" />
    <link rel="stylesheet" href="/assets/css/electric.css" />
    <link rel="stylesheet" href="/assets/css/benefits.css" />
@endsection
@section('content')
    <!-- benefits banner section start  -->
    <div class="benefits-banner-area">
        <div class="container">
            <div class="benefits-banner-content text-center text-white">
                <h2 class="h2">Checkatrade member benefits</h2>
                <a href="#scroll-b" class="benefits-banner-icon">
                    <i class="fa-solid fa-angle-left"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- benefits banner section end -->

    <!-- benefits search section start -->
    <div class="benefits-search-area">
        <div class="container-fluid">
            <div class="input-group mb-3 benefits-search-box">
                <input type="text" class="form-control" placeholder="Search the blog..."
                    aria-label="Recipient's username" aria-describedby="button-addon2" />
                <button class="btn btn-outline-secondary" type="button" id="button-addon2">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
            <!-- driection section start  -->

            <div class="driection-part pt-5">
                <ul>
                    <li><a href="#">Home > </a></li>
                    <li><a href="#">Trade > </a></li>
                    <li><a href="#">Benefits</a></li>
                </ul>
            </div>
            <!-- driection section end  -->
        </div>
    </div>
    <!-- benefits search section end -->

    <!-- benefits slider section start -->
    <div class="benefits-slider-area my-5 py-5">
        <div id="scroll-b" class="container">
            <h4>Content for you</h4>
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <!-- single swiper item start  -->
                    @foreach ($blogs as $item)
                        <div class="swiper-slide single-slide">
                            <div class="swiper-img-box">
                                <img src="{{ getblogimage($item->description) }}" alt="" />
                            </div>
                            <div class="swiper-content">
                                <div class="swiper-content-trade-box">
                                    <a href="#">Benefits</a>
                                    <a href="#">business</a>
                                    <a href="#">Grow business</a>
                                    <a href="#">Trade</a>
                                </div>
                                <h3>{{ $item->title }}</h3>
                                @php
                                    $body = strip_tags($item->description);
                                    $string = preg_replace('/\s|&nbsp;/', ' ', $body);
                                    
                                @endphp
                                <p>{{ $string }}</p>

                                <a href="{{ route('blogs.single', $item->slug) }}" class="continue-btn">Continue Reading <i
                                        class="fa-solid fa-arrow-right"></i></a>

                            </div>
                        </div>
                    @endforeach


                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
    <!-- benefits slider section end -->
@endsection
@section('js')
@endsection
