@extends('frontend.layouts.app')


@section('css')
    <link rel="stylesheet" href="/assets/css/electric.css" />
    <link rel="stylesheet" href="/assets/css/step1.css" />
    <link rel="stylesheet" href="/assets/css/review.css" />
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
    <div class="review-area">
        <div class="container">
            <div class="review-wrap">
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <div class="review-content text-center">
                            <h3>Which company do you want to review?</h3>
                            <p>
                                Our members rely on your feedback - search for <br>
                                a company and share your experience
                            </p>
                            <div class="review-form">
                                <div class=" mb-3">
                                    <select class="form-control select2" name="company" id="company"> </select>
                                </div>

                                <button onclick="nextPage()">Next</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $('.select2').select2({
            placeholder: 'Select Company',
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

        function nextPage() {
            var url = "{{ route('giveFeedbackCompany', ':id') }}"
            var company = $('#company').val();
            if (company == '') {
                alert('Please select company');
                return false;
            }
            window.location.href = url.replace(':id', company);
        }
    </script>
@endsection
