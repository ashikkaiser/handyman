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
                        <div class="profile-button">

                            <button>
                                <img src="/assets/images/elc/icon3.gif" alt="" />{{ $company->business_phone }}
                            </button>
                        </div>
                        <div class="share-area">
                            <div class="share-box ">
                                <div class="addthis_inline_share_toolbox_9ai6"></div>
                                <p>Share on</p>
                            </div>
                            <div class="save-box" onclick="saveCompany({{ $company->id }})">
                                <img src="/assets/images/profile/Save.png" alt="" />
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
                                    <a href="{{ $company->business_url }}"
                                        target="_blank">{{ $company->business_url }}</a>
                                </li>
                            @endif

                        </ul>
                    </div>
                    <!-- contact section end  -->

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
                                    <p> {{ $item->review }} </p>
                                    <h4>Score Breakdown</h4>
                                    <ul>
                                        <li>
                                            <div>Workmanship</div>
                                            <div>{{ $item->workmanship }}</div>
                                        </li>
                                        <li>
                                            <div>Tidiness</div>
                                            <div>{{ $item->workmanship }}</div>
                                        </li>
                                        <li>
                                            <div>reliability</div>
                                            <div>{{ $item->reliability }}</div>
                                        </li>
                                        <li>
                                            <div>Courtesy</div>
                                            <div>{{ $item->courtesy }}</div>
                                        </li>
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
@endsection


@section('js')
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
