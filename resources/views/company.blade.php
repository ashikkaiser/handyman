@extends('frontend.layouts.app')
@section('css')
    <link rel="stylesheet" href="/assets/css/electric.css" />
    <link rel="stylesheet" href="/assets/css/profile.css" />
    <!-- Go to www.addthis.com/dashboard to customize your tools -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5d4562b6c140ec72"></script>

    <style>
        .gallery1 img {
            width: 100%;
            height: 100%;
            object-fit: 'cover';
            border-radius: 10px
        }

        .gallery2 img {
            width: 100%;
            height: 100%;
            object-fit: 'cover';
            border-radius: 10px
        }

        #map {
            height: 400px;
            /* The height is 400 pixels */
            width: 100%;
            /* The width is the width of the web page */
        }

        .comment-img-box {
            max-width: 107px;
            margin-left: 28px;
        }

        .overall {
            float: right;
            bottom: 50px;
            margin-left: 10px;
            position: relative;
            /* z-index: 2; */
        }

        .shape {

            height: 70px;
            width: 70px;
            border-radius: 100%;
            box-sizing: border-box;
            border: 3px solid #204746;
            font-size: 30px;
            font-weight: 600;
            text-align: center;
            line-height: 60px;
            color: #204746;
        }

        .review-area {
            background-color: #fff;
            box-shadow: 0px 0px 10px 0px rgb(0 0 0 / 20%);
            border-radius: 10px;
            padding: 15px 15px;
        }

        .review-summary {}

        .review-top {}

        .progress-wrapper {
            width: 90px;
            height: 90px;
            background-color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 5px solid rgb(0, 88, 162);
            margin: 0 auto;

        }

        .progress-total {
            width: 70px;
            height: 70px;
            background-color: rgb(0, 88, 162);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
        }

        .progress-workmanship {
            width: 70px;
            height: 70px;
            background-color: rgb(119, 213, 205);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
        }

        .progress-tidiness {
            width: 70px;
            height: 70px;
            background-color: rgb(122, 204, 111);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
        }

        .progress-reliability {
            width: 70px;
            height: 70px;
            background-color: rgb(0, 126, 180);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
        }

        .progress-courtesy {
            width: 70px;
            height: 70px;
            background-color: rgb(224, 195, 72);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
        }

        .review-text {
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
    <style>
        .carousel-inner {

            border-radius: 10px;
        }
    </style>
@endsection
@section('content')
    <!-- Profile content section start -->
    <section class="profile-section mt-4 mb-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <!-- profile guaranteed section start  -->
                    <div class="profile-guaranteed">
                        <div class="guaranteed">
                            <img src="/assets/images/elc/Guaranteed icon.png" alt="" />
                            <p>Guaranteed</p>
                        </div>
                        <div class="comment-content-box">
                            <div class="comment-content">
                                <h5>{{ $company->business_name }}</h5>
                                @php
                                    $url = url()->previous();
                                    $route = app('router')
                                        ->getRoutes($url)
                                        ->match(app('request')->create($url))
                                        ->getName();

                                    if (session()->has('search')) {
                                        $search = (object) session()->get('search');
                                        $c = \App\Models\CompanyProfile::where('id', $company->id)
                                            ->distance($search->lng, $search->lat)
                                            ->first();

                                        $distance = $c->distance;
                                    } else {
                                        $distance = null;
                                    }
                                @endphp

                                @if ($route === 'search')
                                    @if ($distance)
                                        <h6>Operates in this area - {{ number_format((float) $distance, 2, '.', '') }}
                                            miles away</h6>
                                    @endif
                                @endif


                                <p class="reviews">
                                    {{ $company->reviews->count() }} <span>({{ $company->reviews->count() }} reviews)</span>
                                </p>
                            </div>
                            <div class="comment-img-box">
                                <img src="/{{ $company->logo }}" alt="" />
                            </div>
                        </div>
                        <button class="btn btn-success mb-2" style="display: block; width:100%">
                            <i class="fas fa-phone-alt"></i>
                            {{ $company->business_phone }}
                        </button>
                        <a href="{{ route('post-job') }}?company={{ $company->id }}" class="btn btn-primary text-white"
                            style="display: block; width:100%">
                            <i class="fas fa-paper-plane"></i>
                            Request a quote
                        </a>

                        <div class="share-area">
                            <div class="share-box" data-bs-toggle="modal" data-bs-target="#shareModal">
                                {{-- <div class="addthis_inline_share_toolbox_9ai6"></div> --}}
                                <i class="fas fa-share-alt fs-3"></i>
                                <p>Share on</p>
                            </div>
                            <div class="save-box" onclick="saveCompany({{ $company->id }})">
                                {{-- <img src="/assets/images/profile/Save.png" alt="" /> --}}
                                <i class="fas fa-heart fs-3"></i>
                                <p>Save</p>
                            </div>
                        </div>
                    </div>

                    <!-- map area start  -->
                    @if ($company->packages->map)
                        <div class="map-area pt-5">
                            <h4 class="sidebar-heading">Find us on map:</h4>
                            <div class="map-wrap">
                                <div id="map"></div>

                                <p class="pt-2">{{ ucfirst($company->business_name) }}</p>
                                @if ($route === 'search')
                                    @if ($distance)
                                        <span>Operates in this area - {{ number_format((float) $distance, 2, '.', '') }}
                                            miles away</span>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- map area end -->
                </div>
                <div class="col-lg-8 mt-3">
                    @php
                        $images = json_decode($company->images);

                    @endphp
                    @if (count($images) > 0)
                        @php

                        @endphp
                        <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">

                                @foreach ($images as $key => $image)
                                    <button type="button" data-bs-target="#carouselExampleDark"
                                        data-bs-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"
                                        aria-current="true" aria-label="Slide {{ $key }}"></button>
                                @endforeach
                            </div>
                            <div class="carousel-inner">
                                @foreach ($images as $key => $image)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}" data-bs-interval="10000">
                                        <img src="/{{ $image }}" class="d-block w-100" alt="..."
                                            style="height: 400px">
                                    </div>
                                @endforeach


                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    @endif

                    <!-- gallery part end -->

                    <!-- company info start  -->
                    <div class="company-info mt-5">
                        <h4 class="company-common-heading">Company info</h4>
                        <div class="company-details mt-3">
                            <p>{{ $company->business_description }}</p>
                            <div class="company-details-list mt-3 row">
                                <ul class=" single-details-col row" type="none">
                                    @foreach (json_decode($company->business_subcategory) as $item)
                                        @php
                                            $subcategory = \App\Models\Category::find($item);
                                        @endphp
                                        <li class="col-xs-6 col-sm-4">
                                            <i class="fas fa-dot-circle"></i> {{ $subcategory->name }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- company info end  -->
                    <!-- contact section start  -->
                    <div class="contact-section mt-5">
                        <h4 class="company-common-heading">Contact details</h4>
                        <ul>
                            <li>
                                <i class="fas fa-phone-alt text-primary"></i>
                                <a href="tel:{{ $company->business_phone }}">{{ $company->business_phone }}</a>
                            </li>
                            <li>
                                <i class="fas fa-envelope text-primary"></i>

                                <a href="mailto:{{ $company->business_email }}">{{ $company->business_email }}</a>
                            </li>
                            @if ($company->business_url)
                                <li>
                                    <i class="fas fa-globe text-primary"></i>
                                    <a href="https://{{ $company->business_url }}"
                                        target="_blank">{{ $company->business_url }}</a>
                                </li>
                            @endif

                        </ul>
                    </div>
                    <!-- contact section end  -->
                    <div class="average-review mt-5">
                        <h4 class="company-common-heading my-4">Reviews Summary</h4>
                        <div class="review-area">
                            <div class="review-summary">
                                <div class="review-top">
                                    <div class="progress-wrapper">
                                        <div class="progress-total">
                                            {{ round($averageTotal, 2) }}
                                        </div>
                                    </div>
                                    <div class="review-text mt-1">
                                        <p style="font-size: 14px; margin:0">Average score based on
                                            {{ $company->reviews->count() }} reviews in the last 12
                                            months
                                        </p>
                                        <div><a href="#" class="text-success"
                                                style="text-decoration: underline">{{ $company->reviews->count() }}
                                                total review</a></div>
                                        <span class="text-primary" style="font-size: 16px">The reviews below represent
                                            customers' views and not
                                            the views of Tradexpert</span>
                                    </div>
                                    <div class="row g-3">

                                        <div class="col-6 col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                            <p class="text-center">Workmanship</p>
                                            <div class="progress-wrapper">
                                                <div class="progress-workmanship">
                                                    {{ round($averageWorkmanship, 2) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                            <p class="text-center">Tidiness</p>
                                            <div class="progress-wrapper">
                                                <div class="progress-tidiness">
                                                    {{ round($averageTidiness, 2) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                            <p class="text-center">Reliability</p>
                                            <div class="progress-wrapper">
                                                <div class="progress-reliability">
                                                    {{ round($averageReliability, 2) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                            <p class="text-center">Courtesy</p>
                                            <div class="progress-wrapper">
                                                <div class="progress-courtesy">
                                                    {{ round($averageCourtesy, 2) }}
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-3 col-sm-6">
                                            <p class="text-center" style="margin:0">Quote Accuracy</p>
                                            <div class="text-center"><small>({{ $company->reviews->count() }}
                                                    Reviews)</small></div>
                                            <div class="progress-wrapper">
                                                <div class="progress-total">
                                                    {{ round($averageTotal, 2) }}
                                                </div>
                                            </div>
                                        </div> --}}
                                    </div>
                                    <div class="text-center mt-3">
                                        <a href="{{ route('giveFeedbackCompany', $company->id) }}"
                                            class="btn btn-primary text-white px-5">Leave a review</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- customer review start  -->
                    <div class="customer-review">
                        <h4 class="company-common-heading my-4">Customer Reviews</h4>
                        <div class="customer-wrap">
                            @forelse ($company->reviews as $item)
                                <div class="single-review">
                                    <h5>{{ $item->job_name }}</h5>
                                    <div class="verified-box d-flex align-items-center">
                                        <img src="/assets/images/profile/Guaranteed icon.png" alt="" />
                                        <p>Verified Review</p>
                                    </div>
                                    <div class="overall">
                                        <div class="shape">
                                            @if (!empty($item->overall))
                                                {{ $item->overall }}
                                            @else
                                                {{ ($item->workmanship + $item->tidiness + $item->reliability + $item->courtesy) / 4 }}
                                            @endif
                                        </div>
                                    </div>
                                    <p> {{ $item->review }} </p>
                                    @if (empty($item->overall))
                                        <h4>Score Breakdown</h4>
                                    @endif
                                    <ul style="padding: 0!important; justify-content:end">
                                        @if (!empty($item->workmanship))
                                            <li>
                                                <div>Workmanship</div>
                                                <div>{{ $item->workmanship }}</div>
                                            </li>
                                        @endif
                                        @if (!empty($item->tidiness))
                                            <li>
                                                <div>Tidiness</div>
                                                <div>{{ $item->tidiness }}</div>
                                            </li>
                                        @endif
                                        @if (!empty($item->reliability))
                                            <li>
                                                <div>reliability</div>
                                                <div>{{ $item->reliability }}</div>
                                            </li>
                                        @endif
                                        @if (!empty($item->courtesy))
                                            <li>
                                                <div>Courtesy</div>
                                                <div>{{ $item->courtesy }}</div>
                                            </li>
                                        @endif
                                        @if (!empty($item->overall))
                                            <li>
                                                <div>Score</div>
                                                <div>{{ $item->overall }}</div>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            @empty
                                <div class="single-review">
                                    No reviews yet
                                </div>
                            @endforelse


                        </div>
                    </div>
                    <!-- customer review end -->


                    <!-- verify document start  -->
                    <div class="customer-review">
                        <h4 class="company-common-heading my-4">Company Details</h4>
                        <div class="customer-wrap">
                            <ul class="list-group py-3">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Trading address verified
                                    {{-- @if (isset($company->business_registration_number)) --}}
                                    @if ($company->verified)
                                        <i class="fas fa-check-circle text-success fs-5"></i>
                                    @else
                                        <i class="fas fa-times-circle text-danger fs-5"></i>
                                    @endif
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    ID Checked
                                    @if ($company->verified)
                                        <i class="fas fa-check-circle text-success fs-5"></i>
                                    @else
                                        <i class="fas fa-times-circle text-danger fs-5"></i>
                                    @endif
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Tradexpert Standards
                                    @if ($company->verified)
                                        <i class="fas fa-check-circle text-success fs-5"></i>
                                    @else
                                        <i class="fas fa-times-circle text-danger fs-5"></i>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- verify document end  -->

                    <!-- verify document start  -->
                    <div class="customer-review">
                        <h4 class="company-common-heading my-4">Company Status</h4>
                        <div class="customer-wrap">
                            <ul class="list-group py-3">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    VAT Registered
                                    @if (isset($company->business_registration_number))
                                        {{-- <span class="badge bg-primary rounded-pill">YES</span> --}}
                                        <i class="fas fa-check-circle text-success fs-5"></i>
                                    @else
                                        {{-- <span class="badge bg-danger rounded-pill">NO</span> --}}
                                        <i class="fas fa-times-circle text-danger fs-5"></i>
                                    @endif
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Company Type
                                    <span class="badge bg-primary rounded-pill">{{ $company->business_type }}</span>

                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Business Owners
                                    <span class="badge bg-primary rounded-pill">{{ $company->user->name }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- verify document end  -->
                    <!-- vetting status start  -->
                    {{-- <div class="vetting-status-area mt-5">
                        <h4 class="company-common-heading">Vetting Status</h4>
                        <div class="row">
                            <div class="col-xsm-6 col-sm-4 col-md-3">
                                <div class="box-vetting">
                                    <h6>Accreditations</h6>
                                    <span>Checked</span>
                                </div>
                            </div>
                            <div class="col-xsm-6 col-sm-4 col-md-3">
                                <div class="box-vetting">
                                    <h6>Accreditations</h6>
                                    <span>Checked</span>
                                </div>
                            </div>
                            <div class="col-xsm-6 col-sm-4 col-md-3">
                                <div class="box-vetting">
                                    <h6>Accreditations</h6>
                                    <span>Checked</span>
                                </div>
                            </div>
                            <div class="col-xsm-6 col-sm-4 col-md-3">
                                <div class="box-vetting">
                                    <h6>Accreditations</h6>
                                    <span>Checked</span>
                                </div>
                            </div>
                            <div class="col-xsm-6 col-sm-4 col-md-3">
                                <div class="box-vetting">
                                    <h6>Accreditations</h6>
                                    <span>Checked</span>
                                </div>
                            </div>
                            <div class="col-xsm-6 col-sm-4 col-md-3">
                                <div class="box-vetting">
                                    <h6>Accreditations</h6>
                                    <span>Checked</span>
                                </div>
                            </div>
                        </div>

                        <div class="accordion mt-4" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Approved member since 2020
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <strong>This is the first item's accordion body.</strong>
                                        It is shown by default, until the collapse plugin adds the
                                        appropriate classes that we use to style each element.
                                        These classes control the overall appearance, as well as
                                        the showing and hiding via CSS transitions. You can modify
                                        any of this with custom CSS or overriding our default
                                        variables. It's also worth noting that just about any HTML
                                        can go within the <code>.accordion-body</code>, though the
                                        transition does limit overflow.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Company Status
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <strong>This is the second item's accordion body.</strong>
                                        It is hidden by default, until the collapse plugin adds
                                        the appropriate classes that we use to style each element.
                                        These classes control the overall appearance, as well as
                                        the showing and hiding via CSS transitions. You can modify
                                        any of this with custom CSS or overriding our default
                                        variables. It's also worth noting that just about any HTML
                                        can go within the <code>.accordion-body</code>, though the
                                        transition does limit overflow.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">
                                        Insurance Details
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse"
                                    aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <strong>This is the third item's accordion body.</strong>
                                        It is hidden by default, until the collapse plugin adds
                                        the appropriate classes that we use to style each element.
                                        These classes control the overall appearance, as well as
                                        the showing and hiding via CSS transitions. You can modify
                                        any of this with custom CSS or overriding our default
                                        variables. It's also worth noting that just about any HTML
                                        can go within the <code>.accordion-body</code>, though the
                                        transition does limit overflow.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <!-- vetting status end  -->
                </div>
            </div>
        </div>
    </section>
    <!-- Profile content section end -->


    <!-- Modal -->
    <div class="modal fade" id="shareModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Share this trade</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        {{-- <img src="/{{ $company->logo }}" alt=""
                            style="border-radius: 10px;border:1px solid #000" width="100%">
                        <p>{{ $company->business_name }}</p> --}}
                        <div class="col-3">
                            <img src="/{{ $company->logo }}" alt=""
                                style="border-radius: 10px;border:1px solid #000" width="100%">
                        </div>
                        <div class="col-9">
                            <ul>
                                <li>{{ $company->business_name }}</li>
                            </ul>
                        </div>
                        <ul class="list-group mt-2">
                            {{-- copy link --}}
                            <p class="" id="clickCopy" style="opacity: 0;font-size:0px">{{ url()->current() }}</p>
                            <a class="list-group-item copy-text" data-clipboard-target="#clickCopy">
                                <i class="fas fa-link"></i> Copy Link
                            </a>
                            <a class="list-group-item"
                                href="mailto:?subject=I wanted you to see this site&amp;body=Check out this site {{ url()->current() }}"
                                target="_blank">
                                <i class="fas fa-envelope"></i> Email
                            </a>
                            <a class="list-group-item"
                                href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}"
                                target="_blank">
                                <i class="fab fa-facebook-f"></i> Facebook
                            </a>
                            <a class="list-group-item" href="https://api.whatsapp.com/send?text={{ url()->current() }}"
                                target="_blank">
                                <i class="fab fa-whatsapp"></i> Whatsapp
                            </a>
                            <a class="list-group-item"
                                href="https://twitter.com/intent/tweet?text={{ url()->current() }}" target="_blank">
                                <i class="fab fa-twitter"></i> Twitter
                            </a>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->

@endsection


@section('js')
    <script src="https://cdn.jsdelivr.net/clipboard.js/1.5.12/clipboard.min.js"></script>

    <script>
        $(function() {
            new Clipboard('.copy-text');
        });
    </script>
    <script>
        const myCarouselElement = document.querySelector('#carouselExampleIndicators')
        const carousel = new bootstrap.Carousel(myCarouselElement, {
            interval: 2000,
            wrap: false
        })
    </script>
    <script>
        function saveCompany(id) {
            $.ajax({
                url: "{{ route('saveCompany') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                },
                success: function(response) {
                    if (response.success) {
                        swal("Success", response.message, "success")
                    } else {
                        swal("Oops", response.message, "error")

                    }
                }
            });
        }
    </script>

    <script>
        function initMap() {
            const businessLocation = {
                lat: {{ $company->business_latitude }},
                lng: {{ $company->business_longitude }}
            };

            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 15,
                center: businessLocation,
            });
            const marker = new google.maps.Marker({
                position: businessLocation,
                map: map,
            });
        }
        window.initMap = initMap;
    </script>

    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDNLzN1W7LEWXFF8ssJPU7OZyh3e9-mUrM&callback=initMap&v=weekly"
        defer></script>
@endsection
