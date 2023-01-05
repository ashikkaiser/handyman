@extends('frontend.layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/signup.css">
    <style>
        .panel {
            margin-bottom: 20px;
            background-color: #fff;
            border: 1px solid transparent;
            border-radius: 4px;
            -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
            box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
        }

        .panel-body {
            padding: 15px;
            transition: max-height 1s ease-in-out;

        }

        .panel-collapse.collapsed {
            transition: max-height 1s ease-in-out;
        }

        .panel-heading {
            padding: 10px 15px;
            border-bottom: 1px solid transparent;
            border-top-left-radius: 3px;
            border-top-right-radius: 3px;
        }

        .panel-heading>.dropdown .dropdown-toggle {
            color: inherit;
        }

        .panel-title {
            margin-top: 0;
            margin-bottom: 0;
            font-size: 16px;
            color: inherit;
        }

        .panel-title>a,
        .panel-title>small,
        .panel-title>.small,
        .panel-title>small>a,
        .panel-title>.small>a {
            color: inherit;
        }

        .panel-footer {
            padding: 10px 15px;
            background-color: #f5f5f5;
            border-top: 1px solid #ddd;
            border-bottom-right-radius: 3px;
            border-bottom-left-radius: 3px;
        }

        .panel>.list-group,
        .panel>.panel-collapse>.list-group {
            margin-bottom: 0;
        }

        .list-group-item:hover {

            background-color: white !important;
            border: 1px solid #E84446;
        }

        .panel>.list-group .list-group-item,
        .panel>.panel-collapse>.list-group .list-group-item {
            border-width: 1px 0;
            border-radius: 0;
        }

        .panel>.list-group:first-child .list-group-item:first-child,
        .panel>.panel-collapse>.list-group:first-child .list-group-item:first-child {
            border-top: 0;
            border-top-left-radius: 3px;
            border-top-right-radius: 3px;
        }

        .panel>.list-group:last-child .list-group-item:last-child,
        .panel>.panel-collapse>.list-group:last-child .list-group-item:last-child {
            border-bottom: 0;
            border-bottom-right-radius: 3px;
            border-bottom-left-radius: 3px;
        }

        .panel>.panel-heading+.panel-collapse>.list-group .list-group-item:first-child {
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

        .panel-heading+.list-group .list-group-item:first-child {
            border-top-width: 0;
        }

        .list-group+.panel-footer {
            border-top-width: 0;
        }

        .panel>.table,
        .panel>.table-responsive>.table,
        .panel>.panel-collapse>.table {
            margin-bottom: 0;
        }

        .panel>.table caption,
        .panel>.table-responsive>.table caption,
        .panel>.panel-collapse>.table caption {
            padding-right: 15px;
            padding-left: 15px;
        }

        .panel>.table:first-child,
        .panel>.table-responsive:first-child>.table:first-child {
            border-top-left-radius: 3px;
            border-top-right-radius: 3px;
        }

        .panel>.table:first-child>thead:first-child>tr:first-child,
        .panel>.table-responsive:first-child>.table:first-child>thead:first-child>tr:first-child,
        .panel>.table:first-child>tbody:first-child>tr:first-child,
        .panel>.table-responsive:first-child>.table:first-child>tbody:first-child>tr:first-child {
            border-top-left-radius: 3px;
            border-top-right-radius: 3px;
        }

        .panel>.table:first-child>thead:first-child>tr:first-child td:first-child,
        .panel>.table-responsive:first-child>.table:first-child>thead:first-child>tr:first-child td:first-child,
        .panel>.table:first-child>tbody:first-child>tr:first-child td:first-child,
        .panel>.table-responsive:first-child>.table:first-child>tbody:first-child>tr:first-child td:first-child,
        .panel>.table:first-child>thead:first-child>tr:first-child th:first-child,
        .panel>.table-responsive:first-child>.table:first-child>thead:first-child>tr:first-child th:first-child,
        .panel>.table:first-child>tbody:first-child>tr:first-child th:first-child,
        .panel>.table-responsive:first-child>.table:first-child>tbody:first-child>tr:first-child th:first-child {
            border-top-left-radius: 3px;
        }

        .panel>.table:first-child>thead:first-child>tr:first-child td:last-child,
        .panel>.table-responsive:first-child>.table:first-child>thead:first-child>tr:first-child td:last-child,
        .panel>.table:first-child>tbody:first-child>tr:first-child td:last-child,
        .panel>.table-responsive:first-child>.table:first-child>tbody:first-child>tr:first-child td:last-child,
        .panel>.table:first-child>thead:first-child>tr:first-child th:last-child,
        .panel>.table-responsive:first-child>.table:first-child>thead:first-child>tr:first-child th:last-child,
        .panel>.table:first-child>tbody:first-child>tr:first-child th:last-child,
        .panel>.table-responsive:first-child>.table:first-child>tbody:first-child>tr:first-child th:last-child {
            border-top-right-radius: 3px;
        }

        .panel>.table:last-child,
        .panel>.table-responsive:last-child>.table:last-child {
            border-bottom-right-radius: 3px;
            border-bottom-left-radius: 3px;
        }

        .panel>.table:last-child>tbody:last-child>tr:last-child,
        .panel>.table-responsive:last-child>.table:last-child>tbody:last-child>tr:last-child,
        .panel>.table:last-child>tfoot:last-child>tr:last-child,
        .panel>.table-responsive:last-child>.table:last-child>tfoot:last-child>tr:last-child {
            border-bottom-right-radius: 3px;
            border-bottom-left-radius: 3px;
        }

        .panel>.table:last-child>tbody:last-child>tr:last-child td:first-child,
        .panel>.table-responsive:last-child>.table:last-child>tbody:last-child>tr:last-child td:first-child,
        .panel>.table:last-child>tfoot:last-child>tr:last-child td:first-child,
        .panel>.table-responsive:last-child>.table:last-child>tfoot:last-child>tr:last-child td:first-child,
        .panel>.table:last-child>tbody:last-child>tr:last-child th:first-child,
        .panel>.table-responsive:last-child>.table:last-child>tbody:last-child>tr:last-child th:first-child,
        .panel>.table:last-child>tfoot:last-child>tr:last-child th:first-child,
        .panel>.table-responsive:last-child>.table:last-child>tfoot:last-child>tr:last-child th:first-child {
            border-bottom-left-radius: 3px;
        }

        .panel>.table:last-child>tbody:last-child>tr:last-child td:last-child,
        .panel>.table-responsive:last-child>.table:last-child>tbody:last-child>tr:last-child td:last-child,
        .panel>.table:last-child>tfoot:last-child>tr:last-child td:last-child,
        .panel>.table-responsive:last-child>.table:last-child>tfoot:last-child>tr:last-child td:last-child,
        .panel>.table:last-child>tbody:last-child>tr:last-child th:last-child,
        .panel>.table-responsive:last-child>.table:last-child>tbody:last-child>tr:last-child th:last-child,
        .panel>.table:last-child>tfoot:last-child>tr:last-child th:last-child,
        .panel>.table-responsive:last-child>.table:last-child>tfoot:last-child>tr:last-child th:last-child {
            border-bottom-right-radius: 3px;
        }

        .panel>.panel-body+.table,
        .panel>.panel-body+.table-responsive,
        .panel>.table+.panel-body,
        .panel>.table-responsive+.panel-body {
            border-top: 1px solid #ddd;
        }

        .panel>.table>tbody:first-child>tr:first-child th,
        .panel>.table>tbody:first-child>tr:first-child td {
            border-top: 0;
        }

        .panel>.table-bordered,
        .panel>.table-responsive>.table-bordered {
            border: 0;
        }

        .panel>.table-bordered>thead>tr>th:first-child,
        .panel>.table-responsive>.table-bordered>thead>tr>th:first-child,
        .panel>.table-bordered>tbody>tr>th:first-child,
        .panel>.table-responsive>.table-bordered>tbody>tr>th:first-child,
        .panel>.table-bordered>tfoot>tr>th:first-child,
        .panel>.table-responsive>.table-bordered>tfoot>tr>th:first-child,
        .panel>.table-bordered>thead>tr>td:first-child,
        .panel>.table-responsive>.table-bordered>thead>tr>td:first-child,
        .panel>.table-bordered>tbody>tr>td:first-child,
        .panel>.table-responsive>.table-bordered>tbody>tr>td:first-child,
        .panel>.table-bordered>tfoot>tr>td:first-child,
        .panel>.table-responsive>.table-bordered>tfoot>tr>td:first-child {
            border-left: 0;
        }

        .panel>.table-bordered>thead>tr>th:last-child,
        .panel>.table-responsive>.table-bordered>thead>tr>th:last-child,
        .panel>.table-bordered>tbody>tr>th:last-child,
        .panel>.table-responsive>.table-bordered>tbody>tr>th:last-child,
        .panel>.table-bordered>tfoot>tr>th:last-child,
        .panel>.table-responsive>.table-bordered>tfoot>tr>th:last-child,
        .panel>.table-bordered>thead>tr>td:last-child,
        .panel>.table-responsive>.table-bordered>thead>tr>td:last-child,
        .panel>.table-bordered>tbody>tr>td:last-child,
        .panel>.table-responsive>.table-bordered>tbody>tr>td:last-child,
        .panel>.table-bordered>tfoot>tr>td:last-child,
        .panel>.table-responsive>.table-bordered>tfoot>tr>td:last-child {
            border-right: 0;
        }

        .panel>.table-bordered>thead>tr:first-child>td,
        .panel>.table-responsive>.table-bordered>thead>tr:first-child>td,
        .panel>.table-bordered>tbody>tr:first-child>td,
        .panel>.table-responsive>.table-bordered>tbody>tr:first-child>td,
        .panel>.table-bordered>thead>tr:first-child>th,
        .panel>.table-responsive>.table-bordered>thead>tr:first-child>th,
        .panel>.table-bordered>tbody>tr:first-child>th,
        .panel>.table-responsive>.table-bordered>tbody>tr:first-child>th {
            border-bottom: 0;
        }

        .panel>.table-bordered>tbody>tr:last-child>td,
        .panel>.table-responsive>.table-bordered>tbody>tr:last-child>td,
        .panel>.table-bordered>tfoot>tr:last-child>td,
        .panel>.table-responsive>.table-bordered>tfoot>tr:last-child>td,
        .panel>.table-bordered>tbody>tr:last-child>th,
        .panel>.table-responsive>.table-bordered>tbody>tr:last-child>th,
        .panel>.table-bordered>tfoot>tr:last-child>th,
        .panel>.table-responsive>.table-bordered>tfoot>tr:last-child>th {
            border-bottom: 0;
        }

        .panel>.table-responsive {
            margin-bottom: 0;
            border: 0;
        }

        .panel-group {
            margin-bottom: 20px;
        }

        .panel-group .panel {
            margin-bottom: 0;
            border-radius: 4px;
        }

        .panel-group .panel+.panel {
            margin-top: 5px;
        }

        .panel-group .panel-heading {
            border-bottom: 0;
        }

        .panel-group .panel-heading+.panel-collapse>.panel-body,
        .panel-group .panel-heading+.panel-collapse>.list-group {
            border-top: 1px solid #ddd;
        }

        .panel-group .panel-footer {
            border-top: 0;
        }

        .panel-group .panel-footer+.panel-collapse .panel-body {
            border-bottom: 1px solid #ddd;
        }

        .panel-default {
            border-color: #ddd;
        }

        .panel-default>.panel-heading {
            color: #333;
            background-color: #f5f5f5;
            border-color: #ddd;
        }

        .panel-default>.panel-heading+.panel-collapse>.panel-body {
            border-top-color: #ddd;
        }

        .panel-default>.panel-heading .badge {
            color: #f5f5f5;
            background-color: #333;
        }

        .panel-default>.panel-footer+.panel-collapse>.panel-body {
            border-bottom-color: #ddd;
        }

        .panel-primary {
            border-color: #337ab7;
        }

        .panel-primary>.panel-heading {
            color: #fff;
            background-color: #337ab7;
            border-color: #337ab7;
        }

        .panel-primary>.panel-heading+.panel-collapse>.panel-body {
            border-top-color: #337ab7;
        }

        .panel-primary>.panel-heading .badge {
            color: #337ab7;
            background-color: #fff;
        }

        .panel-primary>.panel-footer+.panel-collapse>.panel-body {
            border-bottom-color: #337ab7;
            transition: max-height 1s ease-in-out;
        }

        .panel-success {
            border-color: #d6e9c6;
        }

        .panel-success>.panel-heading {
            color: #3c763d;
            background-color: #dff0d8;
            border-color: #d6e9c6;
        }

        .panel-success>.panel-heading+.panel-collapse>.panel-body {
            border-top-color: #d6e9c6;
        }

        .panel-success>.panel-heading .badge {
            color: #dff0d8;
            background-color: #3c763d;
        }

        .panel-success>.panel-footer+.panel-collapse>.panel-body {
            border-bottom-color: #d6e9c6;
        }

        .panel-info {
            border-color: #bce8f1;
        }

        .panel-info>.panel-heading {
            color: #31708f;
            background-color: #d9edf7;
            border-color: #bce8f1;
        }

        .panel-info>.panel-heading+.panel-collapse>.panel-body {
            border-top-color: #bce8f1;
        }

        .panel-info>.panel-heading .badge {
            color: #d9edf7;
            background-color: #31708f;
        }

        .panel-info>.panel-footer+.panel-collapse>.panel-body {
            border-bottom-color: #bce8f1;
        }

        .panel-warning {
            border-color: #faebcc;
        }

        .panel-warning>.panel-heading {
            color: #8a6d3b;
            background-color: #fcf8e3;
            border-color: #faebcc;
        }

        .panel-warning>.panel-heading+.panel-collapse>.panel-body {
            border-top-color: #faebcc;
        }

        .panel-warning>.panel-heading .badge {
            color: #fcf8e3;
            background-color: #8a6d3b;
        }

        .panel-warning>.panel-footer+.panel-collapse>.panel-body {
            border-bottom-color: #faebcc;
        }

        .panel-danger {
            border-color: #ebccd1;
        }

        .panel-danger>.panel-heading {
            color: #a94442;
            background-color: #f2dede;
            border-color: #ebccd1;
        }

        .panel-danger>.panel-heading+.panel-collapse>.panel-body {
            border-top-color: #ebccd1;
        }

        .panel-danger>.panel-heading .badge {
            color: #f2dede;
            background-color: #a94442;
        }

        .panel-danger>.panel-footer+.panel-collapse>.panel-body {
            border-bottom-color: #ebccd1;
        }
    </style>
@endsection
@section('content')
    <section id="content">
        <div class="wrapper">
            <div id="hero">
                <div id="details" style="padding-top:60px">
                    <picture>
                        <source srcset="/assets/images/approved.png" media="(max-width: 599px)">
                        <source srcset="/assets/images/approved.png" media="(max-width: 1023px)"><img
                            src="/assets/images/approved.png" alt="Get Approved and join the UK's best trades">
                    </picture>
                </div>
            </div>
            <div id="form-container">
                <form id="contact-form" method="POST">
                    @csrf

                    <div class="form-floating">
                        <select class="form-select" id="floatingSelect" name="category"
                            aria-label="Floating label select example">
                            <option selected>Select a category</option>
                            @foreach ($subcategories as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <label for="floatingSelect">Your business category</label>
                    </div>

                    <p class="submit">
                        <input type="submit" accesskey="s" value="Get started">
                    </p>
                    <div id="privacy-notice"><a class="scrollto open" href="#header" id="showform">Read our
                            Privacy&nbsp;Notice</a></div>
                </form>
            </div>
            <div class="clear"></div>
        </div>
    </section>

    <section id="benefits">
        <div class="wrapper">
            <div class="column">
                <div class="inner">
                    <div class="title">
                        {{ getPage('signup')->benefits1->title }}
                    </div>
                    <p>
                        {{ getPage('signup')->benefits1->subTitle }}
                    </p>
                </div>
            </div>
            <div class="column">
                <div class="inner">
                    <div class="title">
                        {{ getPage('signup')->benefits2->title }}
                    </div>
                    <p>
                        {{ getPage('signup')->benefits2->subTitle }}
                    </p>
                </div>
            </div>
            <div class="column">
                <div class="inner">
                    <div class="title"> {{ getPage('signup')->benefits3->title }}</div>
                    <p>
                        {{ getPage('signup')->benefits3->subTitle }}
                    </p>
                </div>
            </div>
        </div>
    </section>


    <section id="leads">
        <div class="wrapper">
            <h2>Find the work you want, where you want </h2>
            <p>Read some testimonials from recently registerd compaies</p>
            <div id="search-box">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">

                    <div class="carousel-inner">
                        @foreach ($testimonials as $item)
                            <div
                                class="carousel-item
                            @if ($loop->first) active @endif
                            ">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 d-flex justify-content-center">
                                            <img src="{{ $item->image }}" alt="" class="testimonialImage">

                                        </div>
                                        <div class="col-md-8">
                                            <div class="p-3">
                                                <p class="text-black text-start">
                                                    {{ $item->description }}
                                                </p>
                                                <p class="text-black text-end">
                                                    <b> {{ $item->author }}</b>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach



                    </div>


                    <div class="carousel-indicators">
                        @foreach ($testimonials as $key => $item)
                            <button type="button" data-bs-target="#carouselExampleIndicators"
                                data-bs-slide-to="{{ $key }}"
                                @if ($loop->first) class="active" aria-current="true" @endif
                                aria-label="Slide 1"></button>
                        @endforeach

                    </div>
                </div>

            </div>
        </div>
    </section>


    <div id="subtle_bg">
        <section id="membership" data-gtm-vis-recent-on-screen-1778557_753="484"
            data-gtm-vis-first-on-screen-1778557_753="484" data-gtm-vis-total-visible-time-1778557_753="100"
            data-gtm-vis-has-fired-1778557_753="1">
            <div id="bar">
                <div class="wrapper2">
                    <h2>Chose the plan that fits with your needs. </h2>
                </div>
                <div class="wrapper">
                    <div id="overlay"><img src="/assets/images/overlay.png"></div>

                    @foreach ($packages as $key => $item)
                        @php
                            $title = preg_split('/[\n\r]+/', $item->description);
                            $features = array_slice($title, 1);
                        @endphp
                        <div
                            class="column  @if ($key == 0) affiliate @endif  @if ($key == 1) lite @endif @if ($key == 2) standard @endif ">
                            <div class="inner">
                                <div class="title">{{ $item->name }}</div>

                                @isset($title[0])
                                    <p>{{ $title[0] }}</p>
                                @endisset
                                <ul>
                                    @foreach ($features as $fe)
                                        <li> {{ $fe }} </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    @endforeach


                    {{-- <div class="column lite">
                        <div class="inner">
                            <div class="title">Lite</div>
                            <ul>
                                <li>All the benefits of our Approved membership.</li>
                                <li>Get leads to fill gaps in your diary.</li>
                                <li>Create a profile page and be found by new customers.</li>
                            </ul><a id="lite-btn" class="scrollto" href="#form-container"><img
                                    src="https://storage.pardot.com/796483/1631793578Iz99HsKc/arrow.png"> Choose Lite</a>
                        </div>
                    </div>
                    <div class="column standard">
                        <div class="inner">
                            <div class="title">Standard</div>
                            <ul>
                                <li>Receive a regular flow of leads.</li>
                                <li>Get twice as many leads as our Lite membership.</li>
                                <li>All the benefits of our Approved &amp; Lite memberships.</li>
                            </ul><a id="standard-btn" class="scrollto" href="#form-container"><img
                                    src="https://storage.pardot.com/796483/1631793578FuffLJF5/arrow_white.png"> Get started
                                now</a>
                        </div>
                    </div> --}}

                </div>

            </div>
            <div class="wrapper mt-5" style="justify-content: center;">
                <a type="button" href="{{ route('tasker.register.step1') }}" class="card-btn">Tradexpert Signup</a>

            </div>
        </section>



    </div>
    <section id="faq">
        <div class="wrapper">
            <div class="title">FAQs</div>



            {!! htmlspecialchars_decode(getPage('signup')->faq) !!}


            {{-- <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            Accordion Item #1
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended to
                            demonstrate the <code>.accordion-flush</code> class. This is the first item's accordion body.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                            Accordion Item #2
                        </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended to
                            demonstrate the <code>.accordion-flush</code> class. This is the second item's accordion body.
                            Let's imagine this being filled with some actual content.</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseThree" aria-expanded="false"
                            aria-controls="flush-collapseThree">
                            Accordion Item #3
                        </button>
                    </h2>
                    <div id="flush-collapseThree" class="accordion-collapse collapse"
                        aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended to
                            demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion body.
                            Nothing more exciting happening here in terms of content, but just filling up the space to make
                            it look, at least at first glance, a bit more representative of how this would look in a
                            real-world application.</div>
                    </div>
                </div>
            </div> --}}

        </div>
    </section>
@endsection

@section('js')
    <script>
        $('.panel-default').on('click', function() {
            if ($(this).find('.panel-collapse').hasClass('collapsed')) {
                $(this).find('.panel-collapse').addClass('collapse').removeClass('collapsed')
            } else {
                $(this).find('.panel-collapse').addClass('collapsed').removeClass('collapse')
            }

        });
    </script>
@endsection
