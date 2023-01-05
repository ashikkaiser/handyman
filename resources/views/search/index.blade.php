@extends('frontend.layouts.app')

@section('css')
    <link rel="stylesheet" href="/assets/css/electric.css" />
    <style>
        .comment-img-box img {
            width: 100px;
            /* height: 100px; */
            margin-right: 5px;
            border-radius: 10px
        }

        .comment-img-box {

            margin-right: 5px;
            border-radius: 10px;
        }

        .text-truncate {
            display: -webkit-box;
            max-width: 100% !important;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            white-space: inherit !important;
        }

        .form-label.required::after {
            color: red;
            content: "*";
            margin-left: 2px;
            text-align: "center";


        }
    </style>
@endsection

@section('content')
    <!-- find section start  -->
    <div class="find-section py-5">
        <div class="container">
            <x-search />
        </div>
    </div>
    <!-- find section end -->

    <!-- driection section start  -->
    <div class="container">
        <div class="driection-part">
            <p>{{ $category->name }} In {{ $session->postal_code }}({{ $companies->count() }})</p>

            <div class="d-flex mx-auto  justify-content-between align-items-center  ">
                <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '>';">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        @if ($session->s)
                            <li class="breadcrumb-item"><a href="#">{{ $category->name }}</a></li>
                            <li class="breadcrumb-item active"><a href="#">
                                    {{ $subcats->find($session->s)->name }}</a>
                            </li>
                        @else
                            <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
                        @endif

                    </ol>
                </nav>

                <div class="col-lg-3 webdevice">
                    <select name="" id="" class="form-control">
                        <option value="most_relevant">Most Relevant</option>
                        <option value="nearest_me">Nearest Me</option>
                        <option value="highest">Highest Rated</option>
                        <option value="review">Most Reviews</option>

                    </select>
                </div>
            </div>
            {{-- <div class="col-lg-3 mobile">
                <select name="" id="" class="form-control">
                    <option value="">Most Relevant</option>
                    <option value="">Nearest Me</option>
                    <option value="">Highest Rated</option>
                    <option value="">Most Reviews</option>

                </select>
            </div> --}}

        </div>
    </div>
    <!-- driection section end  -->

    <!-- content section start -->
    <div class="content-section mt-4 mb-5 pb-5">
        <div class="container">
            <div class="row">
                <!-- sidebar section start  -->
                <div class="col-lg-4">
                    <div class="job-granted">
                        <div class="job-text d-flex align-items-center justify-content-around py-2">
                            <div class="text-start">
                                <h3> Your job, guaranteed </h3>
                                <p> If something goes wrong with your job, we'll help make it right. </p>
                            </div>
                        </div>
                        <div class="d-grid gap-2">
                            <button data-bs-toggle="modal" data-bs-target="#exampleModal">Find out more</button>
                        </div>

                    </div>

                    <div class="event-list mt-4 web-only">
                        <p>More In {{ $category->name }}</p>
                        <ul>
                            @foreach ($category->children as $item)
                                <li>
                                    <a
                                        href="{{ route('search', ['categoryId' => $item->id, 'location' => request()->location]) }}">{{ $item->name }}</a>
                                </li>
                            @endforeach


                        </ul>
                    </div>
                </div>


                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog animate-bottom modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <section class="sc-b24909f6-4 guJjcX">
                                    {!! site('popup_text') !!}
                                </section>
                                <div class="d-grid gap-2">
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>

                                </div>
                            </div>
                            {{-- <div class="modal-footer">

                            </div> --}}
                        </div>
                    </div>
                </div>
                <!-- sidebar section end  -->
                <div class="col-lg-8">
                    <!-- describe section start  -->
                    <div class="describe-section">

                        @if (Auth::check())
                            <form action="{{ route('post-job') }}" method="POST">
                            @else
                                <form action="{{ route('guest.postJob') }}" method="POST">
                        @endif

                        @csrf
                        <h5>Describe your job:</h5>
                        <p>
                            Give us the details of your job and we'll send it to selected
                            specialist trades for you.
                        </p>

                        <textarea rows="4" cols="50" class="dtextarea" name="description"
                            placeholder="Please describe your job in detail and let the trade know when's the best time to contact you"></textarea>
                        <div class="min-char">
                            <p>Min characters: 10</p>
                            <p>0/500</p>
                        </div>
                        @if (Auth::check())
                            <div class="row mt-2 detailsBox">

                                <input type="hidden" name="subcategory_id" value="{{ $session->s }}">
                                <input type="hidden" name="subcategory_id" value="{{ $session->s }}">
                                <div class="">

                                    <div class="fs-5" style="margin-bottom: 12px;">Category:
                                        {{ $subcats->find($session->s)->name }}</div>
                                    <div class="fs-4" style="margin-bottom: 12px;">When would you like the job
                                        to start?</div>
                                    <div class="checkbox">
                                        <label class="sc-2f3239db-0 fXAJqH">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="start_time"
                                                    id="id1" value=" I'm flexible on the start date" checked>
                                                <label class="form-check-label" for="id1">
                                                    I'm flexible on the start date
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="start_time"
                                                    id="id2" value="It's urgent (within 48 hours)" checked>
                                                <label class="form-check-label" for="id2">
                                                    It's urgent (within 48 hours)
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="start_time"
                                                    id="id3" value="Within the next week" checked>
                                                <label class="form-check-label" for="id3">
                                                    Within the next week
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="start_time"
                                                    id="id4" value="Within the next month" checked>
                                                <label class="form-check-label" for="id4">
                                                    Within the next month
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="start_time"
                                                    id="id5" value="I'm budgeting / researching" checked>
                                                <label class="form-check-label" for="id5">
                                                    I'm budgeting / researching
                                                </label>
                                            </div>




                                    </div>
                                    <div class="fs-4 mt-2" style="margin-bottom: 10px;">Tell us about you</div>


                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ old('name', auth()->user()->name) }}" placeholder="Name" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" placeholder="Email"
                                            value="{{ old('email', auth()->user()->email) }}" name="email" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="tel" class="form-label">Phone Number</label>
                                        <input type="tel" class="form-control" id="tel" name="phone"
                                            value="{{ old('phone', auth()->user()->phone) }}" placeholder="Phone Number">
                                    </div>
                                    <div class="mb-3">
                                        <label for="postcode" class="form-label">Post Code</label>
                                        <input type="text" class="form-control" id="postcode" name="post_code"
                                            value="{{ old('post_code', auth()->user()->post_code) }}"
                                            placeholder="Post code">
                                    </div>


                                </div>
                                <div class="submit-btn text-center">
                                    <button type="submit" class="btn btn-primary">Request a quote</button>
                                </div>
                            </div>
                        @else
                            <div class="row mt-2 detailsBox">

                                <input type="hidden" name="subcategory_id" value="{{ $session->s }}">
                                <input type="hidden" name="subcategory_id" value="{{ $session->s }}">
                                <div class="">

                                    <div class="fs-5" style="margin-bottom: 12px;">Category:
                                        {{ $subcats->find($session->s)->name }}</div>
                                    <div class="fs-4" style="margin-bottom: 12px;">When would you like the job
                                        to start?</div>
                                    <div class="checkbox">
                                        <label class="sc-2f3239db-0 fXAJqH">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="start_time"
                                                    id="id1" value=" I'm flexible on the start date" checked>
                                                <label class="form-check-label" for="id1">
                                                    I'm flexible on the start date
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="start_time"
                                                    id="id2" value="It's urgent (within 48 hours)">
                                                <label class="form-check-label" for="id2">
                                                    It's urgent (within 48 hours)
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="start_time"
                                                    id="id3" value="Within the next week">
                                                <label class="form-check-label" for="id3">
                                                    Within the next week
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="start_time"
                                                    id="id4" value="Within the next month">
                                                <label class="form-check-label" for="id4">
                                                    Within the next month
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="start_time"
                                                    id="id5" value="I'm budgeting / researching">
                                                <label class="form-check-label" for="id5">
                                                    I'm budgeting / researching
                                                </label>
                                            </div>




                                    </div>
                                    <div class="fs-4 mt-2" style="margin-bottom: 10px;">Tell us about you</div>


                                    <div class="mb-3">
                                        <label for="name" class="form-label required">Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            required value="{{ old('name') }}" placeholder="Name" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label required">Email</label>
                                        <input type="email" class="form-control" id="email" placeholder="Email"
                                            value="{{ old('email') }}" name="email" required />
                                    </div>
                                    <div class="mb-3">
                                        <label for="tel" class="form-label required">Phone Number</label>
                                        <input type="tel" class="form-control" id="tel" name="phone"
                                            value="{{ old('phone') }}" placeholder="Phone Number" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="postcode" class="form-label required">Post Code</label>
                                        <input type="text" class="form-control postal-code" id="postalcodeJob"
                                            name="post_code" required value="{{ old('post_code') }}"
                                            placeholder="Post code">
                                    </div>


                                </div>
                                <div class="submit-btn text-center">
                                    <button type="submit" class="btn btn-primary text-white ">Request a
                                        quote</button>
                                </div>
                            </div>
                            {{-- <div class="row mt-2 detailsBox">
                                    <button class="btn btn-primary">Please Login</button>
                                </div> --}}
                        @endif

                        </form>

                        <!-- describe section end -->
                        @forelse ($companies as $item)
                            <div class="single-comment">
                                <div class="guaranteed ">
                                    <img src="/assets/images/elc/Guaranteed icon.png" alt="">
                                    <p>Guaranteed</p>
                                </div>
                                <div class="comment-content-box">
                                    <div class="comment-img-box">
                                        <img src="/{{ $item->logo }}" alt="">
                                    </div>
                                    <div class="comment-content">
                                        <a href="{{ route('company.profile', $item->id) }}">
                                            <h5>{{ $item->business_name }}</h5>
                                        </a>
                                        <h6>Operates in this area -
                                            {{ number_format((float) $item->distance, 2, '.', '') }}
                                            miles away</h6>
                                        {!! reviewCount($item) !!}

                                        <p class="text-truncate col-12 mb-2" style="max-width: 100vh;">
                                            {{ $item->business_description }}</p>
                                        <div class="comment-button">
                                            <a type="button" style="margin-left: 0px;" class=" mt-3"
                                                href="{{ route('post-job', ['c' => $category->id, 's' => request()->s, 'company' => $item->id]) }}">
                                                <img src="/assets/images/elc/icon2.gif" alt="">Request a
                                                quote
                                            </a>
                                            <a type="button" class="bg-black mt-3">
                                                <img src="/assets/images/elc/icon3.gif"
                                                    alt="">{{ $item->business_phone }}
                                            </a>


                                        </div>
                                    </div>

                                </div>
                                <div class="mobile-button comment-button">
                                    <a type="button" style="margin-left: 0px;" class=""
                                        href="{{ route('post-job', ['c' => $category->id, 's' => request()->s, 'company' => $item->id]) }}">
                                        <img src="/assets/images/elc/icon2.gif" alt="">Request a
                                        quote
                                    </a>
                                    <a type="button" class="bg-black mt-3">
                                        <img src="/assets/images/elc/icon3.gif"
                                            alt="">{{ $item->business_phone }}
                                    </a>


                                </div>
                                <div class="heart-icon">
                                    <img src="/assets/images/elc/heart icon.png" alt="">
                                </div>
                            </div>
                        @empty

                            <div class="text-bold d-flex justify-center mt-5">
                                Listings are not available for this ({{ request()->location }}) location
                            </div>
                        @endforelse
                        <!-- single comment section start  -->

                        <!-- single comment section end -->

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content section end -->
@endsection
@section('js')
    <script>
        $('.detailsBox').hide();
        $(document).ready(function() {
            $(".dtextarea").on('keyup', function() {
                var text = $(this).val();
                var textLength = text.length;
                var textLength = textLength + "/500";
                $(".min-char p:last-child").text(textLength);
                if (text.length !== 0) {
                    $('.detailsBox').show();
                } else {
                    $('.detailsBox').hide();
                }
            });
        });
    </script>

    <script>
        function initJobPostal() {
            const input = document.getElementById("postalcodeJob");
            input.placeholder = "{{ __('Enter your postcode') }}";
            const options = {
                componentRestrictions: {
                    country: "uk"
                },
                fields: ["address_components", "geometry", "icon", "name"],
                strictBounds: false,
                types: ["postal_code"],
            };
            const autocomplete = new google.maps.places.Autocomplete(input, options);
            google.maps.event.addListener(autocomplete, 'place_changed', function() {
                var place = autocomplete.getPlace();
                var code = place.address_components.find(function(item) {
                    return item.types.includes('postal_code');
                });
                var town = place.address_components.find(function(item) {
                    return item.types.includes('postal_town');
                });
                input.value = code.long_name;
            });
        }
    </script>

    {{-- <script async
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDNLzN1W7LEWXFF8ssJPU7OZyh3e9-mUrM&libraries=places&callback=initJobPostal">
    </script> --}}
@endsection
