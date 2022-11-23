@extends('frontend.layouts.app')
@section('css')
    <link rel="stylesheet" href="/assets/css/electric.css" />

    <!-- benefits css -->
    <link rel="stylesheet" href="/assets/css/benefits.css" />

    <!-- blog single css  -->
    <link rel="stylesheet" href="/assets/css/blog-single.css" />
    <style>
        .swiper-img-box img,
        .single-blog-content img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
@endsection

@section('content')
    <div class="blog-single-area mt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-7 offset-lg-2">
                    <!-- social link area start -->
                    <div class="single-blog-social">
                        <div class="driection-part">
                            <ul>
                                <li><a href="#">Home > </a></li>
                                <li><a href="#">Trade > </a></li>
                                <li><a href="#">Benefits</a></li>
                            </ul>
                        </div>
                        <div class="blog-social-icon-box">
                            <a href="#"><i class="fa-solid fa-link"></i> Copy Link</a>
                            <a href="#"><i class="fa-brands fa-twitter"></i></a>
                            <a href="#"><i class="fa-brands fa-facebook"></i></a>
                        </div>
                    </div>
                    <!-- social link area end -->

                    <!-- single blog content start  -->
                    <div class="single-blog-content mt-5">
                        <h1>{{ $blog->title }}</h1>

                        <p>{!! $blog->description !!}</p>
                        {{-- <p>
                            Landfills are a huge contributor to CO2 emissions, alongside
                            toxins and leachate, which aren't just bad for the environment
                            but for our health, soil, and water too. The solution? Recycling
                            and reusing where possible. Find out how you can.
                        </p>
                        <div class="blog-img-box my-5">
                            <img src="/assets/images/blog/blog1.jpg" alt="" />
                        </div>

                        <div class="article-area">
                            <h4>In this article, we'll cover:</h4>
                            <ul>
                                <li>
                                    <a href="#reduce">How trades can reduce construction waste</a>
                                </li>
                                <li><a href="#types">The best types of materials to reuse</a></li>
                                <li>
                                    <a href="#material">What to do if you have leftover materials</a>
                                </li>
                            </ul>
                            <p>
                                Knowing how to reduce waste as a tradesperson is an important
                                consideration. It’s no secret we’re living through a climate
                                crisis, and most people now understand how greenhouse gases
                                contribute to global warming. Nigel Van Wassenhoven, CEO of
                                Enviromate, knows the importance of reusing our surplus
                                materials. With the construction sector growing year on year,
                                more materials will be going to waste. In fact, the UK
                                construction industry is responsible for around 32% of
                                landfill waste, with over 100 million tonnes being wasted
                                every year. This doesn’t have to be the way, though. There are
                                solutions. Here are some of the ways we can reduce
                                construction waste.
                            </p>
                        </div>
                        <!-- single article content view start  -->
                        <div class="article-content-view">
                            <h3 id="reduce">How trades can reduce construction waste</h3>
                            <div class="single-article-content">
                                <h5>Create a Site Waste Management Plan</h5>
                                <p>
                                    Before works start on a site, consider preparing an Outline
                                    SWMP. This looks at what waste management processes are
                                    working well and areas for improvement. It also offers you
                                    the opportunity to identify and implement ways to reduce
                                    your waste at the design stage. This can include ways to
                                    re-use, recycle and trade existing materials, helping to
                                    minimise the amount of waste going to landfill.
                                </p>
                            </div>
                            <div class="single-article-content">
                                <h5>
                                    There are several steps you can take to reduce your waste
                                    during construction.
                                </h5>
                                <p>Tips to reduce waste:</p>
                                <ol>
                                    <li>
                                        Make sure your site is equipped with facilities to
                                        accommodate all the waste your project will generate.
                                    </li>
                                    <li>
                                        Make sure your site is equipped with facilities to
                                        accommodate all the waste your project will generate.
                                    </li>
                                    <li>
                                        Make sure your site is equipped with facilities to
                                        accommodate all the waste your project will generate.
                                    </li>
                                    <li>
                                        Make sure your site is equipped with facilities to
                                        accommodate all the waste your project will generate.
                                    </li>
                                    <li>
                                        Make sure your site is equipped with facilities to
                                        accommodate all the waste your project will generate.
                                    </li>
                                    <li>
                                        Make sure your site is equipped with facilities to
                                        accommodate all the waste your project will generate.
                                    </li>
                                </ol>
                            </div>
                            <div class="single-article-content">
                                <h5>Follow best practices when it comes to your materials</h5>
                                <p>Tips to reduce waste:</p>
                                <ul>
                                    <li>
                                        Make sure your site is equipped with facilities to
                                        accommodate all the waste your project will generate.
                                    </li>
                                    <li>
                                        Make sure your site is equipped with facilities to
                                        accommodate all the waste your project will generate.
                                    </li>
                                    <li>
                                        Make sure your site is equipped with facilities to
                                        accommodate all the waste your project will generate.
                                    </li>
                                    <li>
                                        Make sure your site is equipped with facilities to
                                        accommodate all the waste your project will generate.
                                    </li>
                                    <li>
                                        Make sure your site is equipped with facilities to
                                        accommodate all the waste your project will generate.
                                    </li>
                                    <li>
                                        Make sure your site is equipped with facilities to
                                        accommodate all the waste your project will generate.
                                    </li>
                                </ul>
                            </div>
                            <div class="single-article-content">
                                <h5>Re-use and recycle materials where possible</h5>
                                <p>
                                    Before works start on a site, consider preparing an Outline
                                    SWMP. This looks at what waste management processes are
                                    working well and areas for improvement. It also offers you
                                    the opportunity to identify and implement ways to reduce
                                    your waste at the design stage. This can include ways to
                                    re-use, recycle and trade existing materials, helping to
                                    minimise the amount of waste going to landfill.
                                </p>
                            </div>
                        </div>
                        <!-- single article content view end  -->
                        <!-- single article content view start  -->
                        <div class="article-content-view">
                            <h3 id="types">The best types of materials to reuse</h3>
                            <div class="single-article-content">
                                <p>
                                    The materials below are some examples of what’s listed daily
                                    on Enviromate’s platform. They’re easy to use and start
                                    sharing, and when you set up an account, you can start
                                    listing and sharing similar materials with other trades near
                                    you.
                                </p>
                                <ul>
                                    <li>Concrete, Bricks & Blocks</li>
                                    <li>Wood</li>
                                    <li>Glass</li>
                                    <li>Metal</li>
                                </ul>
                            </div>
                        </div>
                        <!-- single article content view end  -->
                        <!-- single article content view start  -->
                        <div class="article-content-view">
                            <h3 id="material">What to do if you have leftover materials</h3>
                            <div class="single-article-content">
                                <p>
                                    The materials below are some examples of what’s listed daily
                                    on Enviromate’s platform. They’re easy to use and start
                                    sharing, and when you set up an account, you can start
                                    listing and sharing similar materials with other trades near
                                    you.
                                </p>
                            </div>
                        </div> --}}
                        <!-- single article content view end  -->
                    </div>
                    <!-- single blog content end -->

                    <!-- create comment box start  -->
                    <div class="create-comment-area">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="create-comment-content">
                                    <h4>Tell us what you think</h4>
                                    <h6>Please leave your comment</h6>
                                    <p>Your email address will not be published. <br>
                                        Required fields are marked *</p>
                                    <form class="create-comment-form" action="">
                                        <input type="text" placeholder="Your Name...">
                                        <input type="email" placeholder="Your Email...">
                                        <textarea name="comment" cols="30" rows="10" placeholder="Your Comment..."></textarea>
                                        <button>Post Comment</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- create comment box end -->

                    <!-- comment list box start  -->
                    <div class="comment-box-list my-4">
                        <h4>What others think of this article:</h4>

                        <p>No comment yet!</p>
                    </div>
                    <!-- comment list box end -->

                    <!-- more content start  -->
                    <div class="more-content my-4">
                        <div class="row">
                            <h4>More content like this</h4>
                            <div class="col-lg-6">
                                <div class="single-slide">
                                    <div class="swiper-img-box">
                                        <img src="/assets/images/benefits/banner.jpg" alt="" />
                                    </div>
                                    <div class="swiper-content">
                                        <div class="swiper-content-trade-box">
                                            <a href="#">Benefits</a>
                                            <a href="#">business</a>
                                            <a href="#">Grow business</a>
                                            <a href="#">Trade</a>
                                        </div>
                                        <h3>How to recycle scrap metal for the best price</h3>
                                        <p>Your van is what gets you from job to job. If it broke down, you could lose out
                                            on days or even weeks’ worth of work. That’s why we’ve teamed up with Fiat, to
                                            give you exclusive rates on brand new Fiat vans you can rely on.</p>

                                        <a href="#" class="continue-btn">Continue Reading <i
                                                class="fa-solid fa-arrow-right"></i></a>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="single-slide">
                                    <div class="swiper-img-box">
                                        <img src="/assets/images/benefits/banner.jpg" alt="" />
                                    </div>
                                    <div class="swiper-content">
                                        <div class="swiper-content-trade-box">
                                            <a href="#">Benefits</a>
                                            <a href="#">business</a>
                                            <a href="#">Grow business</a>
                                            <a href="#">Trade</a>
                                        </div>
                                        <h3>How to recycle scrap metal for the best price</h3>
                                        <p>Your van is what gets you from job to job. If it broke down, you could lose out
                                            on days or even weeks’ worth of work. That’s why we’ve teamed up with Fiat, to
                                            give you exclusive rates on brand new Fiat vans you can rely on.</p>

                                        <a href="#" class="continue-btn">Continue Reading <i
                                                class="fa-solid fa-arrow-right"></i></a>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="single-slide">
                                    <div class="swiper-img-box">
                                        <img src="/assets/images/benefits/banner.jpg" alt="" />
                                    </div>
                                    <div class="swiper-content">
                                        <div class="swiper-content-trade-box">
                                            <a href="#">Benefits</a>
                                            <a href="#">business</a>
                                            <a href="#">Grow business</a>
                                            <a href="#">Trade</a>
                                        </div>
                                        <h3>How to recycle scrap metal for the best price</h3>
                                        <p>Your van is what gets you from job to job. If it broke down, you could lose out
                                            on days or even weeks’ worth of work. That’s why we’ve teamed up with Fiat, to
                                            give you exclusive rates on brand new Fiat vans you can rely on.</p>

                                        <a href="#" class="continue-btn">Continue Reading <i
                                                class="fa-solid fa-arrow-right"></i></a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- more content end -->

                </div>
            </div>
        </div>
    </div>
@endsection
