@extends('frontend.layouts.app')
@section('css')
    <link rel="stylesheet" href="/assets/css/electric.css" />
    <link rel="stylesheet" href="/assets/css/profile.css" />
@endsection
@section('content')
    <!-- find section start  -->
    <div class="find-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="find-content">
                        <div class="input-group input-box">
                            <span class="input-group-text">Find</span>
                            <input type="text" class="form-control" placeholder="Electric Showers in BH16 6FA" />
                            <div class="input-icon">
                                <img src="/assets/images/elc/icon.gif" alt="" />
                            </div>
                        </div>
                        <button>Search</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- find section end -->

    <!-- Profile content section start -->
    <section class="profile-section mt-4 mb-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <!-- profile guaranteed section start  -->
                    <div class="profile-guaranteed">
                        <div class="guaranteed">
                            <img src="assets/images/elc/Guaranteed icon.png" alt="" />
                            <p>Guaranteed</p>
                        </div>
                        <div class="comment-content-box">
                            <div class="comment-content">
                                <h5>LEE Electrical Contracting</h5>
                                <h6>Operates in this area - 4 miles away</h6>
                                <p class="reviews">9.97 <span>(19 reviews)</span></p>
                            </div>
                            <div class="comment-img-box">
                                <img src="assets/images/elc/comment1.gif" alt="" />
                            </div>
                        </div>
                        <div class="profile-button">
                            <button>
                                <img src="assets/images/elc/icon2.gif" alt="" />Request a
                                quote
                            </button>
                            <button>
                                <img src="assets/images/elc/icon3.gif" alt="" />00000 000 000
                            </button>
                        </div>
                        <div class="share-area">
                            <div class="share-box">
                                <img src="assets/images/profile/Share.png" alt="" />
                                <p>Share</p>
                            </div>
                            <div class="save-box">
                                <img src="assets/images/profile/Save.png" alt="" />
                                <p>Save</p>
                            </div>
                        </div>
                    </div>
                    <!-- profile guaranteed section end    -->

                    <!-- skill area start  -->
                    <div class="skill-area pt-5">
                        <h4 class="sidebar-heading">Skill & expertise</h4>
                        <select name="" id="">
                            <option value="" default>Events and Entertainment</option>
                            <option value="">Events item</option>
                            <option value="">Events item</option>
                            <option value="">Events item</option>
                            <option value="">Events item</option>
                            <option value="">Events item</option>
                            <option value="">Events item</option>
                            <option value="">Events item</option>
                            <option value="">Events item</option>
                            <option value="">Events item</option>
                        </select>
                    </div>
                    <!-- skill area end -->

                    <!-- map area start  -->
                    <div class="map-area pt-5">
                        <h4 class="sidebar-heading">Find us on map:</h4>
                        <div class="map-wrap">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387190.2799070274!2d-74.25987305798014!3d40.69767006494068!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sbd!4v1663078687294!5m2!1sen!2sbd"
                                width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                            <p>LEE Electrical Contracting</p>
                            <span>Operates in this area - 4 miles away</span>
                        </div>
                    </div>
                    <!-- map area end -->
                </div>
                <div class="col-lg-8">
                    <!-- gallery part star  -->
                    <div class="gallery-area">
                        <div class="img-box gallery1 show-image">
                            <img src="assets/images/profile/company image 1.png" alt="" />
                            <div class="show-all-image">Show all Images</div>
                        </div>
                        <div class="img-box gallery2">
                            <div class="show-image">
                                <img src="assets/images/profile/company image 2.png" alt="" />
                                <div class="show-all-image">Show all Images</div>
                            </div>
                            <div class="show-image">
                                <img src="assets/images/profile/company image 3.png" alt="" />
                                <div class="show-all-image">Show all Images</div>
                            </div>
                        </div>
                    </div>
                    <!-- gallery part end -->

                    <!-- company info start  -->
                    <div class="company-info mt-5">
                        <h4 class="company-common-heading">Company info</h4>
                        <div class="company-details mt-3">
                            <p>We pride ourselves on being honest and on time.</p>
                            <p>No job is too small.</p>
                            <h5>Free no obligation quotes.</h5>
                            <h5>Events and Entertainment:</h5>
                            <div class="company-details-list mt-3 row">
                                <ul class="col-xsm-6 col-sm-4 single-details-col">
                                    <li>Balloon Decorators</li>
                                    <li>Caterers</li>
                                    <li>Celebration Cakes</li>
                                    <li>DJ & Musicians</li>
                                    <li>Entertainers</li>
                                    <li>Event organiser</li>
                                </ul>
                                <ul class="col-xsm-6 col-sm-4 single-details-col">
                                    <li>Limousine Hire</li>
                                    <li>Luxury Car Hire</li>
                                    <li>Makeup Artist</li>
                                    <li>Magician</li>
                                    <li>Photographer</li>
                                </ul>
                                <ul class="col-xsm-6 col-sm-4 single-details-col">
                                    <li>Singer</li>
                                    <li>Venue Hire</li>
                                    <li>Videographer</li>
                                    <li>Wedding Car Hire</li>
                                    <li>Wedding Planner</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- company info end  -->
                    <!-- contact section start  -->
                    <div class="contact-section mt-5">
                        <h4 class="company-common-heading">Contact details</h4>
                        <ul>
                            <li>07488 851415</li>
                            <li>01202 129621</li>
                            <li>www.elliottelectricals.co.uk</li>
                        </ul>
                    </div>
                    <!-- contact section end  -->

                    <!-- customer review start  -->
                    <div class="customer-review">
                        <h4 class="company-common-heading my-4">Customer Reviews</h4>
                        <div class="customer-wrap">
                            <div class="single-review">
                                <h5>Numerous electrical jobs</h5>
                                <div class="verified-box d-flex align-items-center">
                                    <img src="assets/images/profile/Guaranteed icon.png" alt="" />
                                    <p>Verified Review</p>
                                </div>
                                <p>
                                    Highly recommend Steve, he has carried out many jobs for us
                                    over the last couple of years both big and small and we
                                    couldn’t be happier with the results. Clean and tidy work
                                    and responds to messages in a timely manner, he always
                                    recommends the best way to go about things. Steve is very
                                    welcoming and smiley and just genuinely excellent at what he
                                    does.
                                </p>
                                <h4>Score Breakdown</h4>
                                <ul>
                                    <li>
                                        <div>Courtesy</div>
                                        <div>10</div>
                                    </li>
                                    <li>
                                        <div>Courtesy</div>
                                        <div>10</div>
                                    </li>
                                    <li>
                                        <div>Courtesy</div>
                                        <div>10</div>
                                    </li>
                                    <li>
                                        <div>Courtesy</div>
                                        <div>10</div>
                                    </li>
                                </ul>
                            </div>
                            <div class="single-review">
                                <h5>Numerous electrical jobs</h5>
                                <div class="verified-box d-flex align-items-center">
                                    <img src="assets/images/profile/Guaranteed icon.png" alt="" />
                                    <p>Verified Review</p>
                                </div>
                                <p>
                                    Highly recommend Steve, he has carried out many jobs for us
                                    over the last couple of years both big and small and we
                                    couldn’t be happier with the results. Clean and tidy work
                                    and responds to messages in a timely manner, he always
                                    recommends the best way to go about things. Steve is very
                                    welcoming and smiley and just genuinely excellent at what he
                                    does.
                                </p>
                                <h4>Score Breakdown</h4>
                                <ul>
                                    <li>
                                        <div>Courtesy</div>
                                        <div>10</div>
                                    </li>
                                    <li>
                                        <div>Courtesy</div>
                                        <div>10</div>
                                    </li>
                                    <li>
                                        <div>Courtesy</div>
                                        <div>10</div>
                                    </li>
                                    <li>
                                        <div>Courtesy</div>
                                        <div>10</div>
                                    </li>
                                </ul>
                            </div>
                            <div class="single-review">
                                <h5>Numerous electrical jobs</h5>
                                <div class="verified-box d-flex align-items-center">
                                    <img src="assets/images/profile/Guaranteed icon.png" alt="" />
                                    <p>Verified Review</p>
                                </div>
                                <p>
                                    Highly recommend Steve, he has carried out many jobs for us
                                    over the last couple of years both big and small and we
                                    couldn’t be happier with the results. Clean and tidy work
                                    and responds to messages in a timely manner, he always
                                    recommends the best way to go about things. Steve is very
                                    welcoming and smiley and just genuinely excellent at what he
                                    does.
                                </p>
                                <h4>Score Breakdown</h4>
                                <ul>
                                    <li>
                                        <div>Courtesy</div>
                                        <div>10</div>
                                    </li>
                                    <li>
                                        <div>Courtesy</div>
                                        <div>10</div>
                                    </li>
                                    <li>
                                        <div>Courtesy</div>
                                        <div>10</div>
                                    </li>
                                    <li>
                                        <div>Courtesy</div>
                                        <div>10</div>
                                    </li>
                                </ul>
                            </div>
                            <div class="single-review">
                                <h5>Numerous electrical jobs</h5>
                                <div class="verified-box d-flex align-items-center">
                                    <img src="assets/images/profile/Guaranteed icon.png" alt="" />
                                    <p>Verified Review</p>
                                </div>
                                <p>
                                    Highly recommend Steve, he has carried out many jobs for us
                                    over the last couple of years both big and small and we
                                    couldn’t be happier with the results. Clean and tidy work
                                    and responds to messages in a timely manner, he always
                                    recommends the best way to go about things. Steve is very
                                    welcoming and smiley and just genuinely excellent at what he
                                    does.
                                </p>
                                <h4>Score Breakdown</h4>
                                <ul>
                                    <li>
                                        <div>Courtesy</div>
                                        <div>10</div>
                                    </li>
                                    <li>
                                        <div>Courtesy</div>
                                        <div>10</div>
                                    </li>
                                    <li>
                                        <div>Courtesy</div>
                                        <div>10</div>
                                    </li>
                                    <li>
                                        <div>Courtesy</div>
                                        <div>10</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- customer review end -->
                    <!-- vetting status start  -->
                    <div class="vetting-status-area mt-5">
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
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                    aria-labelledby="headingOne" data-bs-parent="#accordionExample">
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
                    </div>
                    <!-- vetting status end  -->
                </div>
            </div>
        </div>
    </section>
    <!-- Profile content section end -->
@endsection
