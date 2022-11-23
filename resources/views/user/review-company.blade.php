@extends('frontend.layouts.app')


@section('css')
    <link rel="stylesheet" href="/assets/css/electric.css" />
    <link rel="stylesheet" href="/assets/css/step1.css" />
    <link rel="stylesheet" href="/assets/css/reviewConfirm.css">
    <link rel="stylesheet" href="/assets/css/rate.css">
    <style>
        .confirm-review-image-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 15px
        }
    </style>
@endsection

@section('content')
    <div class="confirm-review py-3">
        <form action="{{ route('storeReview') }}" method="POST">
            @csrf
            <input type="hidden" name="others">
            <input type="hidden" name="company_id" value="{{ $company->id }}">

            <div class="container">
                <div class="top-part-confirm-review mb-3">
                    <p>You are reviewing</p>
                    <div class="logo-confirm-review">
                        <div class="confirm-review-image-box">
                            <img src="/{{ $company->logo }}" alt="">
                        </div>
                        <div class="confirm-review-content">
                            <a href="#">{{ $company->business_name }}</a>
                            <p>Based in {{ $company->business_town }}</p>
                        </div>
                    </div>
                </div>
                <div class="bottom-part-confirm-review servey-section">
                    <div class="confirm-review-bottom-content text-center">
                        <p>Was any work carried out?</p>
                        <div class="button-box">

                            <input type="radio" value="Yes" name="carried_out" id="carried_out_yes">
                            <input type="radio" value="no" name="carried_out" id="carried_out_no">
                            <label for="carried_out_yes" onclick="check('yes')">Yes</label>
                            <label for="carried_out_no" onclick="check('no')">No</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="no-section my-5">
                            <div class="container">
                                <div class="row">

                                    <!-- rate start  -->
                                    <div class="rate">
                                        <h5>How would you rate your experience of this Trade?</h5>
                                        <div class="row">
                                            <div class="col-sm-6 counter-box">
                                                <div class="single-rate">
                                                    <div class="rate-count-box d-flex align-items-center">
                                                        <p onclick="handleRateChange($(this),'review',false)">
                                                            <span>-</span>
                                                        </p>
                                                        <div class="count-number">
                                                            <span id="review-number">7</span>
                                                            <input type="hidden" name="review" value="7">
                                                        </div>
                                                        <p onclick="handleRateChange($(this),'review',true)">
                                                            <span>+</span>
                                                        </p>

                                                    </div>
                                                    <span class="count-number-after-x">ok</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="rate-input-box">
                                            <textarea name="no_review_title" id="" cols="30" rows="3" placeholder="Review Title"></textarea>
                                        </div>
                                        <div class="rate-input-box">
                                            <textarea name="no_review" id="" cols="30" rows="4" placeholder="Your review"></textarea>
                                        </div>
                                        <button type="button" onclick="finalStep()" class="rate-next-btn">Next</button>
                                    </div>
                                    <!-- rate end  -->



                                </div>
                            </div>
                        </div>
                        <div class="provider-area mt-3">
                            <div class="rate">
                                <p class="form-heading">What service was provided <sup>*</sup></p>
                                <form id="steponeform">

                                    @foreach (json_decode($company->business_subcategory) as $item)
                                        @php
                                            $category = App\Models\Category::find($item);
                                        @endphp
                                        <label class="radio">
                                            <input type="radio" name="yes_category" value="{{ $category->id }}"
                                                name="category" id="{{ $category->id }}">
                                            {{ $category->name }}
                                            <span></span>
                                        </label>
                                        <br>
                                    @endforeach



                                    <div class="rate-input-box">
                                        <input type="text" name="yes_job_name" placeholder="What was the job">
                                    </div>

                                    <div class="rate-input-box">
                                        <input type="text" placeholder="Date was compieted" onfocus="(this.type='date')"
                                            name="yes_completed_at" onblur="if(!this.value) this.type='text'">
                                    </div>
                                    <div class="rate-input-box">
                                        <textarea name="yes_review" id="" cols="30" rows="5" placeholder="Your review"></textarea>
                                    </div>
                                    <button type="button" onclick="lstep()" class="rate-next-btn">Next</button>
                                </form>
                            </div>
                        </div>
                        <div class="rate-section my-5">
                            <div class="container">
                                <div class="row">

                                    <!-- rate start  -->
                                    <div class="rate">
                                        <h5>How would you rate (out of 10)</h5>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="single-rate counter-box">
                                                    <p class="mb-2">Quality of workmanship</p>
                                                    <div class="rate-count-box d-flex align-items-center">
                                                        <p onclick="handleRateChange($(this),'workmanship',false)">
                                                            <span>-</span>
                                                        </p>
                                                        <div class="count-number">
                                                            <span id="workmanship-number">7</span>
                                                            <input type="hidden" name="workmanship" value="7">
                                                        </div>
                                                        <p onclick="handleRateChange($(this),'workmanship',true)">
                                                            <span>+</span>
                                                        </p>
                                                    </div>
                                                    <span class="count-number-after-x">ok</span>
                                                    <div class="rate-select-box d-flex align-items-center">
                                                        <input type="checkbox" name="workmanship[applicable]"
                                                            id="">
                                                        <p>Not applicable</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="single-rate counter-box">
                                                    <p class="mb-2">Tidiness</p>
                                                    <div class="rate-count-box d-flex align-items-center">
                                                        <p class="minus-btn"
                                                            onclick="handleRateChange($(this),'tidiness',false)">
                                                            <span>-</span>
                                                        </p>
                                                        <div class="count-number">
                                                            <span id="tidiness-number">7</span>
                                                            <input type="hidden" name="tidiness" value="7">
                                                        </div>
                                                        <p class="plus-btn"
                                                            onclick="handleRateChange($(this),'tidiness',true)">
                                                            <span>+</span>
                                                        </p>
                                                    </div>
                                                    <span class="count-number-after-x">ok</span>
                                                    <div class="rate-select-box d-flex align-items-center">
                                                        <input type="checkbox" name="tidiness[applicable]"
                                                            id="">
                                                        <p>Not applicable</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 ">
                                                <div class="single-rate counter-box">
                                                    <p class="mb-3">Reliability & timekeeping</p>
                                                    <div class="rate-count-box d-flex align-items-center">
                                                        <p onclick="handleRateChange($(this),'timekeeping',false)">
                                                            <span>-</span>
                                                        </p>
                                                        <div class="count-number">
                                                            <span id="timekeeping-number">7</span>
                                                            <input type="hidden" name="timekeeping" value="7">
                                                        </div>
                                                        <p onclick="handleRateChange($(this),'timekeeping',true)">
                                                            <span>+</span>
                                                        </p>
                                                    </div>
                                                    <span class="count-number-after-x">ok</span>
                                                    <div class="rate-select-box d-flex align-items-center">
                                                        <input type="checkbox" name="timekeeping[applicable]"
                                                            id="">
                                                        <p>Not applicable</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-rate counter-box">
                                                    <p class="mb-2">Quality of Courtesy</p>
                                                    <div class="rate-count-box d-flex align-items-center">
                                                        <p onclick="handleRateChange($(this),'courtesy',false)">
                                                            <span>-</span>
                                                        </p>
                                                        <div class="count-number">
                                                            <span id="courtesy-number">7</span>
                                                            <input type="hidden" name="courtesy" value="7">
                                                        </div>
                                                        <p onclick="handleRateChange($(this),'courtesy',true)">
                                                            <span>+</span>
                                                        </p>
                                                    </div>
                                                    <span class="count-number-after-x">ok</span>
                                                    <div class="rate-select-box d-flex align-items-center">
                                                        <input type="checkbox" name="courtesy[applicable]"
                                                            id="">
                                                        <p>Not applicable</p>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                        <button type="button" onclick="finalStep()" class="rate-next-btn">Next</button>
                                    </div>

                                </div>
                            </div>
                        </div>




                        <div class="final-area mt-3">
                            <div class="rate">
                                <h4>You are logged in as </h4>

                                <p class="mb-2">{{ Auth::user()->name }}</p>
                                <p class="mb-2">{{ Auth::user()->email }}</p>
                                <p class="mb-2">{{ Auth::user()->post_code }}</p>
                                <hr>


                                <div class="row mb-3">
                                    <label for="phone" class="form-label col-md-12">
                                        Enter your mobile number to submit your review
                                    </label>

                                    <div class="col-md-6">
                                        <input type="text" name="phone" id="phone" required
                                            class="form-control col-md-6" />
                                    </div>
                                </div>
                                <button type="submit" class="btn tasker-btn">Submit review</button>

                            </div>
                        </div>
                    </div>

                    {{-- <div class="col-lg-4">

                    <div class="rate">
                        <h5>This is your review </h5>
                        <p class="card-text placeholder-glow">
                        <div class="row">
                            <div class="col-md-8">
                                <span class="placeholder col-10"></span>
                                <span class="placeholder col-10"></span>
                                <span class="placeholder col-10"></span>
                            </div>
                            <div class="col-md-2">
                                <div class="circle placeholder">

                                </div>
                            </div>
                        </div>

                        </p>

                    </div>
                </div> --}}
                </div>
        </form>

    </div>
    </div>
@endsection

@section('js')
    <script>
        $('.rate-section').hide()
        $('.provider-area').hide()
        $('.no-section').hide()
        $('.final-area').hide()

        function check(value) {
            $('.servey-section').hide()
            if (value == 'no') {
                $('.no-section').show()
            } else {
                $('.provider-area').show()
            }
        }



        function lstep() {
            var yes_category = $('input[name="yes_category"]:checked').val();
            var yes_job_name = $('input[name="yes_job_name"]').val();
            var yes_completed_at = $('input[name="yes_completed_at"]').val();
            var yes_review = $('textarea[name="yes_review"]').val();
            var data = {
                yes_category: yes_category,
                yes_job_name: yes_job_name,
                yes_completed_at: yes_completed_at,
                yes_review: yes_review
            }
            if (yes_category == undefined) {
                alert('Please select category')
            } else if (yes_job_name == '') {
                alert('Please enter job name')
            } else if (yes_completed_at == '') {
                alert('Please enter completed at')
            } else if (yes_review == '') {
                alert('Please enter review')
            } else {
                // $('input[name="others"]').val(JSON.stringify(data))
                $('.rate-section').show()
                $('.provider-area').hide()
            }

        }

        function finalStep() {
            var carried_out = $('input[name="carried_out"]:checked').val();
            if (carried_out === 'Yes') {
                $('.rate-section').hide()
                $('.provider-area').hide()
                $('.final-area').show()
            } else {
                var no_review_title = $('input[name="no_review_title"]').val();
                var no_review = $('textarea[name="no_review"]').val();
                var data = {
                    no_review_title: no_review_title,
                    no_review: no_review
                }
                if (no_review_title == '') {
                    alert('Please enter review title')
                } else if (no_review == '') {
                    alert('Please enter review')
                } else {
                    $('.rate-section').hide()
                    $('.provider-area').hide()
                    $('.no-section').hide()
                    $('.final-area').show()
                }
            }

            // onclick = "finalStep()"
        }
    </script>
@endsection
