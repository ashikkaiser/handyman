@extends('frontend.layouts.app')

@section('css')
    <link rel="stylesheet" href="/assets/css/step1.css">
    <link rel="stylesheet" href="/assets/css/electric.css" />
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
@endsection

@section('content')
    <div class="business-details-area py-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-5 offset-md-3">
                    <div class="business-content text-center">
                        <h3>Request a quote </h3>
                        @if (request()->has('company'))
                            <div class="fs-5">For {{ $company->business_name }} </div>
                        @endif
                        <p> Give us the details of your job and we'll send it to selected specialist trades for you. </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-section-area py-4">
        <div class="container">
            <div class="row">

                <form action="" method="POST">
                    @csrf
                    <input type="hidden" name="company_id" value="{{ request()->company }}">
                    <div class="col-sm-12 col-md-5 offset-md-3">
                        <div class="describe-section">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <h5>Describe your job:</h5>
                            <textarea rows="4" cols="50" class="dtextarea" name="description"
                                placeholder="Please describe your job in detail and let the trade know when's the best time to contact you"></textarea>
                            <div class="min-char">
                                <p>Min characters: 10</p>
                                <p>0/500</p>
                            </div>

                            <div class="row mt-2 detailsBox">

                                @if (request()->s)
                                    <input type="hidden" name="subcategory_id" value="{{ request()->s }}">
                                @else
                                    <div class="fs-6" style="margin-bottom: 12px;">What service do you need?
                                    </div>
                                    <div class="mb-3">
                                        <select class="select2 business_subcategory form-control" name="subcategory_id"
                                            id="">

                                        </select>
                                    </div>
                                @endif




                                <div class="">
                                    <div class="fs-4" style="margin-bottom: 12px;">When would you like the job
                                        to start?</div>
                                    <div class="checkbox">
                                        <label class="sc-2f3239db-0 fXAJqH">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="start_time"
                                                    id="id1" value=" I'm flexible on the start date">
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
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ old('name', auth()->user()->name ?? '') }}" placeholder="Name" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" placeholder="Email"
                                            value="{{ old('email', auth()->user()->email ?? '') }}" name="email" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="tel" class="form-label">Phone Number</label>
                                        <input type="tel" class="form-control" id="tel" name="phone"
                                            value="{{ old('phone', auth()->user()->phone ?? '') }}"
                                            placeholder="Phone Number">
                                    </div>
                                    <div class="mb-3">
                                        <label for="postcode" class="form-label">Post Code</label>
                                        <input type="text" class="form-control postal-code" id="postcode"
                                            name="post_code"
                                            value="{{ old('post_code', auth()->user()->post_code ?? '') }}"
                                            placeholder="Post code">
                                    </div>


                                </div>
                            </div>
                            <div class="submit-btn text-center">
                                <button type="submit" class="btn btn-primary text-white">Request a quote</button>
                            </div>
                        </div>

                    </div>


                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- <script>
        $(document).ready(function() {
            $('.select2').select2({

            });
        });
    </script> --}}
    <script>
        $('.dtextarea').on('keyup', function() {
            var text_length = $('.dtextarea').val().length;
            var text_remaining = 500 - text_length;

            $('.min-char p:nth-child(2)').text(text_length + '/500');
        });



        $(".business_subcategory").select2({
            ajax: {
                url: "{{ route('cat_subcat') }}",
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
    </script>
@endsection
