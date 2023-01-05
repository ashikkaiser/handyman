@extends('frontend.layouts.app')
@section('css')
    <style>
        #appendlist input[type="radio"] {
            display: none;
        }

        .find-content {
            display: flex;
            align-items: center;
            border: 1px solid #204746;
            border-radius: 5px;
        }

        .find-content .input-group input {

            border-radius: 0 5px 5px 0 !important;
        }

        .find-content .input-group input,
        .find-content .input-group span {
            border: none;
            padding: 10px 15px;
        }

        .find-content .input-group input:focus {
            box-shadow: none !important;
            outline: none !important;
            border: none !important;
        }

        .find-content .input-group input::placeholder {
            font-size: 14px;
            font-weight: 300;
        }

        .find-content button {
            padding: 6px 25px;
            border: 1px solid #fff;
            outline: none;
            background-color: #204746;
            color: #fff;
            margin-left: 15px;
            border-radius: 5px;
        }

        .input-box span {
            font-size: 12px;

        }

        .input-box {
            position: relative;
        }

        .input-icon {
            position: absolute;
            right: 5%;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
        }

        .pac-container {
            z-index: 9999;
        }

        .list-group-item {
            cursor: pointer !important;
        }

        .list-group-item label {
            cursor: pointer !important;
        }

        .list-group-item:hover {

            color: gray;
        }

        .icon-box img {
            width: 83px;
            height: 83px;

        }
    </style>

    <style>
        @media only screen and (max-width: 600px) {
            #select_category {
                width: 100px;
            }
        }
    </style>
    <link rel="stylesheet" href="/assets/plugin/select2/css.css">
    <style>
        .select2-container .select2-selection--multiple {


            margin-left: 0px !important;
        }

        .select2-container--open .select2-dropdown--below {
            margin-left: 0px !important;
        }

        .select2-container .select2-selection--multiple {
            box-sizing: border-box;
            cursor: pointer;
            display: block;
            min-height: 32px;
            user-select: none;
            -webkit-user-select: none;
            width: 100%;
            padding: 2px 3px !important;
            line-height: 30px;
            font-size: 18px !important;
            color: #62687a;
            border-radius: 5px;
            border: none;
            border: 1px solid #e8e8e8;
            margin-bottom: 10px;
            /* margin-left: 8px; */
        }

        .select2.select2-container.select2-container--default {
            display: block;
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 0.375rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        .select2-container--default .select2-selection--single {
            background-color: #fff;
            border: none;
            border-radius: 4px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 26px;
            position: absolute;
            top: 5px;
            right: 1px;
            width: 20px;
        }

        .select2-dropdown {
            border: 1px solid #ced4db;
        }

        .select2-container--default .select2-search--dropdown .select2-search__field {
            border: 1px solid #ced4db;
            border-radius: 4px;
        }
    </style>

    <style>
        .kpOgym {
            display: flex;
            width: 100%;
            margin: 0px auto;
            box-sizing: border-box;
        }

        .enVCwK {
            font-family: "Open Sans", "Open Sans-fallback", Arial, sans-serif;
            font-weight: 400;
            font-style: normal;
            font-size: 1rem;
            line-height: 1.5;
            letter-spacing: 0em;
            -webkit-font-smoothing: antialiased;
            display: flex;
            flex-direction: column;
            -webkit-box-pack: justify;
            justify-content: space-between;
            width: 100%;
            padding: 16px 24px;
            background-color: rgb(255, 255, 255);
            box-shadow: rgb(0 0 0 / 16%) 0px 3px 6px;
            box-sizing: border-box;
            color: rgb(51, 51, 51);
            border-radius: 8px;
        }

        .gZPnSV {
            display: flex;
            -webkit-box-pack: justify;
            justify-content: space-between;
            -webkit-box-flex: 1;
            flex-grow: 1;
            margin-bottom: 16px;
        }

        .kUchtk {
            max-width: 70%;
        }

        .kUchtk h2 {
            color: rgb(16, 29, 65);
            margin-bottom: 8px;
        }



        .exlrYT {
            margin: 0px;
            padding: 0px;
            font-family: "Open Sans", "Open Sans-fallback", Arial, sans-serif;
            color: rgb(0, 88, 162);
            font-weight: 600;
            font-size: 1.375rem;
            line-height: 1.75rem;
            letter-spacing: 0px;
        }

        .MeiiP {
            font-size: 1rem;
            color: rgb(102, 102, 102);
            margin: 0px;
        }

        @media (min-width: 800px) {
            .enVCwK {
                -webkit-box-align: center;
                align-items: center;
                flex-direction: row;
            }

            .gZPnSV {
                flex-direction: row-reverse;
                -webkit-box-pack: end;
                justify-content: flex-end;
                margin-bottom: 0px;
            }

            .gZPnSV svg {
                margin: 0px 16px 0px 0px;
            }
        }

        @media (min-width: 600px) {
            .exlrYT {
                font-size: 1.75rem;
                line-height: 2.25rem;
            }
        }
    </style>
@endsection

@section('content')
    <!-- Banner Section Start  -->
    <div class="banner">
        <div class="item banner-img">
            <img src="{{ site()->banner_image }}" alt="" />
        </div>

        <div class="banner-content">
            <div class="container">

                <h1>{!! getPage('home')->bannerTitle !!}</h1>
                <p>{!! getPage('home')->bannerSubTitle !!}</p>
                <div class="banner-search-wrap">

                    <select id="select_category">
                        <option value="all" default>All Categories</option>
                        @foreach ($categories as $item)
                            <option value="{{ $item->slug }}" data-slug="{{ $item->slug }}">{{ $item->name }}</option>
                        @endforeach


                    </select>
                    <div class="input-box">
                        <input type="text" placeholder="Search service here..." readonly onclick="inputClick()" />
                    </div>
                    <div class="serach-box" onclick="inputClick()">Search</div>
                </div>
                <p>or <a data-bs-toggle="modal" data-bs-target="#companySearchModal" style="cursor:pointer">Find
                        Tradexpert</a></p>
            </div>
        </div>
    </div>
    <!-- Banner Section End  -->

    <!-- Modal -->


    <!-- Experts Section Start  -->
    <div class="experts mt-5 pt-5 mb-5 webdevice">
        <div class="container">
            <h2 class="common-section-heading">Get your <span>experts</span></h2>
            <div id="experts-carousel" class="owl-carousel  ">
                @foreach ($categories as $item)
                    <a class="experts-item" onclick="showSearchModal('{{ $item->slug }}')">
                        <div class="icon-box">
                            <img src="{{ $item->icon }}" alt="" />
                        </div>
                        <h4>{{ $item->name }}</h4>
                    </a>
                @endforeach

            </div>
        </div>
    </div>
    <!-- Experts Section End  -->
    <!-- Experts Section Start  -->
    <div class="experts mt-5 pt-5 mb-5 mobileDevice">
        <div class="container">
            <h2 class="common-section-heading">Get your <span>experts</span></h2>
            <div id="experts-carouselx" class="row row-cols-2">
                @foreach ($categories as $item)
                    <div class="col">
                        <a class="experts-item" onclick="showSearchModal('{{ $item->slug }}')">
                            <div class="icon-box">
                                <img src="{{ $item->icon }}" alt="" />
                            </div>
                            <h4>{{ $item->name }}</h4>
                        </a>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- Experts Section End  -->



    <div class="container mb-5  ">
        <div class=" kpOgym">
            <aside class=" enVCwK">
                <div class=" gZPnSV">
                    <div class="kUchtk">
                        <h2 class="exlrYT">Good jobs, guaranteed</h2>
                        <p class="MeiiP">At TradExpert you will find verified companies to get your job done</p>
                    </div>
                    <svg width="72" height="72" viewBox="0 0 72 72">
                        <path
                            d="m53.364 18.432c-1.128 1.176-1.944 2.04-4.164 4.728-1.584 1.92-3.48 4.308-5.712 7.164-2.328 2.988-3.552 4.428-3.9 4.416-0.552-0.012-0.888-0.78-1.152-2.292-0.108-0.672-0.228-1.2-0.3-1.596-0.396-2.388-1.776-1.872-2.928-1.404-1.944 0.78-2.484 2.508-2.376 3.756 0.036 0.42 0 0.228 0.192 1.956 0.012 0.144 0.36 3.084 0.516 3.888 0.168 0.816 0.372 1.476 0.612 2.004 0.3 0.612 0.66 1.056 1.08 1.356 0.42 0.288 0.972 0.492 1.668 0.6 1.824 0.264 3.048-0.408 5.016-2.592l21.228-25.716c-1.62-0.12-2.976-0.096-4.068 0.096-1.092 0.18-2.004 0.528-2.76 1.02-0.84 0.564-1.824 1.44-2.952 2.616z"
                            fill="#214746"></path>
                        <path d="m63.156 14.688-0.54-0.036 0.54 0.036z" fill="#214746"></path>
                        <path d="m61.908 14.628c-0.12 0-0.24 0-0.36-0.012 0.12 0.012 0.24 0.012 0.36 0.012z" fill="#214746">
                        </path>
                        <path
                            d="m64.98 16.92-1.056 1.284c3.288 5.148 5.196 11.256 5.196 17.796 0 18.264-14.856 33.12-33.12 33.12s-33.12-14.856-33.12-33.12 14.856-33.12 33.12-33.12c8.82 0 16.836 3.468 22.776 9.096 0.636-0.096 1.332-0.156 2.088-0.18-6.312-6.48-15.12-10.512-24.864-10.512-19.14 0-34.716 15.576-34.716 34.716s15.576 34.716 34.716 34.716 34.716-15.576 34.716-34.716c0-7.044-2.112-13.596-5.736-19.08z"
                            fill="#214746"></path>
                        <path d="m62.46 14.653c-0.12-0.012-0.252-0.012-0.372-0.012 0.12 0 0.24 0 0.372 0.012z"
                            fill="#214746"></path>

                        <path
                            d="m15.24 45.336-0.876 0.804 0.936 1.776 1.164-0.264 0.852 1.62-6.42 1.116-1.044-1.968 4.524-4.692 0.864 1.608zm-1.932 1.752-0.768 0.708c-0.168 0.156-0.396 0.36-0.672 0.612-0.276 0.24-0.468 0.42-0.6 0.516 0.144-0.048 0.372-0.108 0.696-0.204 0.324-0.084 0.972-0.24 1.956-0.468l-0.612-1.164z"
                            fill="#214746"></path>
                        <path
                            d="m9.072 38.843c0.672-0.132 1.236-0.036 1.68 0.288s0.744 0.852 0.888 1.584l0.096 0.456 2.004-0.408 0.324 1.632-6.048 1.212-0.408-2.088c-0.156-0.768-0.096-1.368 0.156-1.824 0.252-0.444 0.696-0.732 1.308-0.852zm1.344 2.592-0.06-0.3c-0.048-0.24-0.156-0.432-0.324-0.54-0.168-0.12-0.372-0.156-0.612-0.108-0.408 0.084-0.564 0.348-0.48 0.804l0.084 0.42 1.392-0.276z"
                            fill="#214746"></path>
                        <path
                            d="m9.264 31.56c0.684 0.048 1.2 0.288 1.548 0.72s0.492 1.02 0.444 1.764l-0.036 0.468 2.04 0.144-0.12 1.668-6.156-0.444 0.156-2.124c0.06-0.78 0.264-1.344 0.636-1.716 0.36-0.36 0.864-0.528 1.488-0.48zm0.6 2.856 0.024-0.3c0.012-0.252-0.036-0.456-0.168-0.612s-0.312-0.24-0.564-0.264c-0.42-0.024-0.636 0.18-0.672 0.648l-0.036 0.432 1.416 0.096z"
                            fill="#214746"></path>
                        <path
                            d="m12.288 27.9 2.112 0.768-0.564 1.572-5.796-2.1 0.684-1.896c0.576-1.572 1.428-2.16 2.568-1.74 0.672 0.24 1.068 0.756 1.2 1.548l3.144-0.78-0.648 1.776-2.556 0.468-0.144 0.384zm-1.188-0.432 0.108-0.288c0.204-0.552 0.06-0.912-0.432-1.08-0.396-0.144-0.696 0.048-0.88799 0.588l-0.108 0.312 1.32 0.468z"
                            fill="#214746"></path>
                        <path
                            d="m17.316 17.736c0.828 0.636 1.296 1.32 1.416 2.052s-0.12 1.488-0.72 2.268c-0.588 0.768-1.26 1.188-2.004 1.272s-1.524-0.204-2.352-0.828c-0.816-0.624-1.284-1.308-1.392-2.04-0.12-0.732 0.12-1.488 0.72-2.268s1.26-1.2 2.004-1.284c0.72-0.084 1.5 0.204 2.328 0.828zm-2.592 3.372c0.948 0.732 1.668 0.756 2.172 0.108 0.252-0.336 0.336-0.672 0.228-1.008s-0.396-0.696-0.888-1.068-0.912-0.576-1.272-0.588-0.66 0.144-0.912 0.468c-0.504 0.648-0.276 1.356 0.672 2.088z"
                            fill="#214746"></path>
                        <path
                            d="m20.484 11.436 1.536-1.056 1.8 6.24-1.62 1.104-5.136-3.96 1.548-1.056 2.46 2.112c0.54 0.48 0.888 0.816 1.056 1.032-0.096-0.168-0.204-0.396-0.324-0.672s-0.204-0.504-0.264-0.66l-1.056-3.084z"
                            fill="#214746"></path>
                        <path
                            d="m30.252 13.74-3.456 1.224-2.064-5.808 3.456-1.224 0.444 1.26-1.884 0.672 0.324 0.91196 1.74-0.612 0.444 1.26-1.74 0.612 0.384 1.092 1.884-0.672 0.468 1.284z"
                            fill="#214746"></path>
                        <path
                            d="m36.984 9.756c0.072 1.032-0.156 1.836-0.684 2.436-0.528 0.588-1.308 0.924-2.328 0.996l-1.992 0.132-0.42-6.156 2.136-0.144c0.984-0.072 1.764 0.132 2.34 0.6 0.564 0.468 0.876 1.176 0.948 2.136zm-1.728 0.18c-0.036-0.564-0.18-0.972-0.42-1.236-0.24-0.252-0.588-0.372-1.044-0.336l-0.48 0.036 0.228 3.444 0.372-0.024c0.504-0.036 0.864-0.204 1.08-0.516s0.312-0.768 0.264-1.368z"
                            fill="#214746"></path>
                        <path
                            d="m45.864 15.288-0.228-0.552c-0.3 0.048-0.528 0.072-0.696 0.072s-0.36-0.036-0.552-0.072c-0.204-0.048-0.42-0.12-0.66-0.216-0.408-0.168-0.744-0.384-1.008-0.66-0.264-0.264-0.42-0.564-0.492-0.888-0.06-0.324-0.036-0.648 0.096-0.972 0.276-0.684 0.84-1.056 1.704-1.14-0.084-0.252-0.132-0.492-0.144-0.732s0.048-0.492 0.144-0.744c0.168-0.42 0.468-0.684 0.888-0.792 0.42-0.12 0.912-0.06 1.476 0.168 0.552 0.228 0.924 0.516 1.14 0.888 0.204 0.372 0.228 0.756 0.06 1.176-0.12 0.288-0.312 0.528-0.576 0.708s-0.624 0.3-1.068 0.372l0.48 1.056c0.312-0.216 0.588-0.504 0.816-0.852l1.584 0.648c-0.228 0.324-0.492 0.636-0.804 0.936-0.312 0.288-0.624 0.528-0.948 0.696l0.768 1.704-1.98-0.804zm-1.908-2.76c-0.072 0.168-0.06 0.324 0.012 0.48s0.204 0.264 0.396 0.348c0.144 0.06 0.288 0.096 0.42 0.096 0.132 0.012 0.228 0 0.312-0.024l-0.564-1.38c-0.288 0.072-0.48 0.228-0.576 0.48zm2.256-2.256c0.048-0.132 0.048-0.24 0-0.324s-0.132-0.156-0.24-0.192c-0.108-0.048-0.216-0.048-0.324-0.024-0.108 0.036-0.192 0.12-0.252 0.264-0.084 0.192-0.048 0.444 0.096 0.744 0.18-0.024 0.336-0.072 0.456-0.156 0.132-0.084 0.216-0.192 0.264-0.312z"
                            fill="#214746"></path>
                        <path
                            d="m21.816 57.708 2.232 1.452-1.824 2.784c-0.744-0.192-1.476-0.516-2.196-0.996-0.792-0.516-1.26-1.152-1.392-1.896s0.084-1.548 0.636-2.4c0.54-0.828 1.212-1.332 1.98-1.476 0.78-0.156 1.596 0.048 2.448 0.612 0.324 0.216 0.612 0.444 0.864 0.696s0.444 0.492 0.6 0.72l-1.152 0.804c-0.252-0.432-0.6-0.78-1.044-1.08-0.408-0.264-0.804-0.336-1.2-0.216s-0.756 0.42-1.08 0.912c-0.312 0.48-0.456 0.912-0.42 1.296s0.24 0.696 0.624 0.948c0.204 0.132 0.408 0.24 0.612 0.312l0.528-0.804-0.924-0.6 0.708-1.068z"
                            fill="#214746"></path>
                        <path
                            d="m32.004 59.197-1.044 3.564c-0.228 0.78-0.624 1.308-1.188 1.608s-1.26 0.324-2.088 0.084c-0.804-0.24-1.368-0.624-1.68-1.164s-0.36-1.2-0.132-1.968l1.056-3.6 1.608 0.468-1.02 3.468c-0.12 0.42-0.132 0.744-0.036 0.984s0.3 0.396 0.612 0.492c0.324 0.096 0.588 0.072 0.792-0.072s0.36-0.432 0.492-0.852l1.02-3.468 1.608 0.456z"
                            fill="#214746"></path>
                        <path
                            d="m37.536 65.544-0.312-1.152-2.004 0.012-0.3 1.164-1.836 0.012 1.956-6.204 2.22-0.024 2.088 6.18-1.812 0.012zm-0.672-2.508-0.276-1.008c-0.06-0.228-0.144-0.516-0.228-0.876-0.096-0.36-0.156-0.612-0.18-0.768-0.024 0.144-0.072 0.384-0.144 0.708s-0.228 0.984-0.48 1.944h1.308z"
                            fill="#214746"></path>
                        <path
                            d="m43.104 62.377 0.624 2.16-1.596 0.468-1.728-5.9161 1.944-0.5639c1.608-0.468 2.58-0.1201 2.928 1.0439 0.204 0.6841 0.024 1.32-0.54 1.884l2.484 2.0761-1.812 0.528-1.884-1.788-0.42 0.108zm-0.36-1.2001 0.3-0.0839c0.564-0.168 0.768-0.492 0.624-0.984-0.12-0.4081-0.456-0.5281-0.996-0.3721l-0.312 0.0961 0.384 1.3439z"
                            fill="#214746"></path>
                        <path
                            d="m52.86 60.301-0.876-0.816-1.692 1.068 0.36 1.14-1.548 0.984-1.608-6.312 1.884-1.188 5.028 4.14-1.548 0.984zm-1.896-1.788-0.768-0.708c-0.168-0.156-0.396-0.36-0.66-0.612s-0.456-0.444-0.564-0.552c0.06 0.132 0.144 0.36 0.252 0.684 0.108 0.312 0.324 0.96 0.624 1.908l1.116-0.72z"
                            fill="#214746"></path>
                        <path
                            d="m60.384 52.884-1.416 1.668-4.776-1.08-0.024 0.024c0.552 0.396 0.972 0.72 1.248 0.948l2.124 1.8-0.948 1.128-4.716-3.984 1.404-1.668 4.728 1.056 0.012-0.024c-0.504-0.372-0.9-0.684-1.176-0.924l-2.124-1.788 0.96-1.14 4.704 3.984z"
                            fill="#214746"></path>
                        <path
                            d="m63.24 47.364-0.684 1.524-4.38-1.968-0.612 1.38-1.248-0.552 1.908-4.26 1.248 0.552-0.612 1.368 4.38 1.956z"
                            fill="#214746"></path>
                        <path
                            d="m65.328 39.636-0.684 3.6-6.06-1.14 0.684-3.6 1.32 0.252-0.372 1.956 0.948 0.18 0.348-1.812 1.32 0.252-0.348 1.812 1.14 0.216 0.372-1.956 1.332 0.24z"
                            fill="#214746"></path>
                        <path
                            d="m65.364 32.952 0.156 3.648-6.168 0.252-0.156-3.66 1.332-0.06 0.084 1.992 0.972-0.036-0.072-1.848 1.332-0.06 0.072 1.848 1.164-0.048-0.084-1.992 1.368-0.036z"
                            fill="#214746"></path>
                        <path
                            d="m60.288 25.764c0.984-0.3 1.824-0.264 2.52 0.12s1.2 1.056 1.5 2.04l0.588 1.908-5.892 1.8-0.624-2.04c-0.288-0.948-0.276-1.752 0.06-2.412 0.312-0.66 0.936-1.128 1.848-1.416zm0.564 1.644c-0.54 0.168-0.912 0.396-1.104 0.684s-0.228 0.66-0.096 1.092l0.144 0.468 3.3-1.008-0.108-0.36c-0.144-0.48-0.396-0.792-0.744-0.936s-0.816-0.12-1.392 0.06z"
                            fill="#214746"></path>
                    </svg>
                </div>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Find out
                    more</button>
            </aside>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog animate-bottom modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
    <!-- featured section Start  -->
    <div class="featured-section mb-5">
        <div class="container">
            <h2 class="common-section-heading">Featured <span>TradeExperts</span></h2>
            <div class="row">
                @foreach ($companies as $item)
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <a href="{{ route('company.profile', $item->id) }}">
                            <div class="single-featured">
                                <div class="single-featured-img-box">
                                    <img src="{{ $item->logo }}" alt="" />
                                </div>
                                <div class="single-featured-content-box text-center mt-4">
                                    <h4>{{ $item->business_name }}</h4>

                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach


            </div>
        </div>
    </div>
    <!-- featured section End  -->

    <!-- get started section start  -->
    <div class="container">
        <div class="get-started-section mb-5">

            <h2 class="common-section-heading text-center">
                Get Started <span>Now</span>
            </h2>


            <div class="row" style="padding:0px !important">
                <div class="col-md-6 col-lg-4" style="padding:3px !important">
                    <div class="single-get-started">
                        <div class="single-get-img-box employe"
                            style="background-image: url({{ getPage('home')->getStarted1->image }});">
                        </div>
                        <div class="single-get-content-box ">
                            <h4 class="text-primary">
                                {{ getPage('home')->getStarted1->title }}
                            </h4>
                            <p>
                                {{ getPage('home')->getStarted1->subTitle }}
                            </p>
                            <div class="d-grid gap-2 ">
                                <a href="{{ getPage('home')->getStarted1->buttonLink }}"
                                    class="btn btn-primary text-white">
                                    {{ getPage('home')->getStarted1->button }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" style="padding:3px !important">
                    <div class="single-get-started">
                        <div class="single-get-img-box "
                            style="background-image: url({{ getPage('home')->getStarted2->image }});">

                        </div>
                        <div class="single-get-content-box">
                            <h4 class="text-primary">
                                {{ getPage('home')->getStarted2->title }}
                            </h4>
                            <p>
                                {{ getPage('home')->getStarted2->subTitle }}
                            </p>
                            <div class="d-grid gap-2 ">
                                <a href="{{ getPage('home')->getStarted2->buttonLink }}"
                                    class="btn btn-primary text-white">
                                    {{ getPage('home')->getStarted2->button }}

                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" style="padding:3px !important">
                    <div class="single-get-started">
                        <div class="single-get-img-box enpterprise"
                            style="background-image: url({{ getPage('home')->getStarted3->image }});"></div>
                        <div class="single-get-content-box">
                            <h4 class="text-primary">

                                {{ getPage('home')->getStarted3->title }}
                            </h4>
                            <p>
                                {{ getPage('home')->getStarted3->subTitle }}
                            </p>
                            <div class="d-grid gap-2 ">
                                <a href=" {{ getPage('home')->getStarted3->buttonLink }}"
                                    class="btn btn-primary text-white">

                                    {{ getPage('home')->getStarted3->button }}
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!-- get started section end  -->
    <div class="modal fade" id="companySearchModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="companySearchModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="text-black">Search a TradExpert</span>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="review-form">
                        <div class=" mb-3">
                            <select class="form-control select2-company" name="company" id="company"> </select>
                        </div>


                    </div>


                </div>

            </div>
        </div>
    </div>


    <!-- get started section end -->
@endsection


@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{-- <script>
        $(document).ready(function() {
            $('.experts-carousel').slick({
                infinite: true,
                slidesToShow: 5,
                slidesToScroll: 3
            });
        });
    </script> --}}

    <script>
        function click(e) {
            console.log('ok');
        }
        $('.select2-company').select2({
            placeholder: 'Select a Company',
            dropdownParent: $('#companySearchModal'),
            ajax: {
                url: "{{ route('ajaxCompany') }}",
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });
        $('.select2').on('select2:select', function(e) {
            var data = e.params.data;
            window.location.href = "{{ route('company.profile', '') }}/" + data.id;
        });
    </script>
    <script>
        $('.catloading').hide();
        const myModal = new bootstrap.Modal('#searchModal', {
            keyboard: false
        })

        function showSearchModal(category) {
            $('#appendlist').html(null)
            $('.find-content').hide()
            $('input[name="c"]').val(category)
            $('.catloading').show();
            $.post("{{ route('tasker.register.getSubCategory') }}", {
                _token: "{{ csrf_token() }}",
                id: category
            }, function(data) {

                $('.catloading').hide();
                if (category === 'all') {
                    data.forEach(element => {
                        const exdata = JSON.stringify(element)
                        $('#appendlist').append(
                            `<li class="list-group-item" onclick="showSearchModal('${element.slug}')">${element.text}</li>`
                        )
                    });
                } else {
                    data.forEach(element => {
                        $('#appendlist').append(
                            `<li class="list-group-item" onclick="selectSubCategory(${element.id})">
                              <input type="radio" name="s" value="${element.id}" id="r${element.id}" required>
                             <label for="r${element.id}"> ${element.text} </label>
                          </li>`
                        )
                    });
                }

                $('#searchModal').modal('show');

            });

            myModal.show()
        }

        function selectSubCategory(id) {
            // check this value
            $("#r" + id).prop("checked", true);
            var subcategory = $('input[name="s"]:checked')
            if (subcategory.val()) {
                subcategory.parent().addClass('active')
                subcategory.parent().siblings().removeClass('active')
                $('#appendlist').attr('style', 'display:none')
                $('.find-content').show()
            }

        }

        $('#searchForm').submit(function(e) {
            e.preventDefault();
            var data = $(this).serializeArray()
            var lat = data.find(d => d.name == 'lat').value
            if (lat == '') {
                alert('Please enter valid postal code')
                return false
            }
            this.submit()
        })
    </script>

    <script>
        function initMap() {
            const input = document.getElementById("postalcode");
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
                $('input[name="lat"]').val(place.geometry.location.lng());
                $('input[name="lng"]').val(place.geometry.location.lat());

            });
        }
    </script>
    <script>
        const myModalEl = document.getElementById('searchModal')
        myModalEl.addEventListener('hidden.bs.modal', event => {
            $('#appendlist').attr('style', 'display:block')
            $('.find-content').hide()
            $('#appendlist').html(null)
        })


        function inputClick() {
            var catinput = $('#select_category')
            const category = catinput.find(':selected').data('slug')
            showSearchModal(catinput.val())


        }
    </script>
    <script async
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDNLzN1W7LEWXFF8ssJPU7OZyh3e9-mUrM&libraries=places&callback=initMap">
    </script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
@endsection
