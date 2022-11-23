@extends('frontend.layouts.app')

@section('css')
    <link rel="stylesheet" href="/assets/css/step1.css">
    <style>
        .business-details-area {
            position: relative;
        }

        .business-details-area::after {
            position: absolute;
            content: "";
            left: 0;
            bottom: 0;
            width: 66.66%;
            height: 4px;
            background-color: #d10a38;
        }
    </style>
@endsection

@section('content')
    <div class="business-details-area py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="business-content step-head-part">
                        <a href="{{ route('tasker.register.step3') }}"><i class="fa-solid fa-angle-left"></i> Back</a>
                        <h3 class="text-center">Your personal details</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- business details section end -->
    <!-- business details section end -->
    @php
        $session = (object) session()->get('step4');
        // dd($session);
    @endphp
    <!-- form section area start  -->
    <div class="form-section-area py-4">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-5 offset-md-3">
                    <form action="" method="POST">
                        @csrf
                        <div class="form-floating mb-3">
                            <select name="title" id="" class="form-control">
                                <option></option>
                                <option value="Mr" {{ old('title', $session->title ?? '') == 'Mr' ? 'selected' : '' }}>
                                    Mr
                                </option>
                                <option value="Mrs" {{ old('title', $session->title ?? '') == 'Mrs' ? 'selected' : '' }}>
                                    Mrs
                                </option>
                                <option value="Miss"
                                    {{ old('title', $session->title ?? '') == 'Miss' ? 'selected' : '' }}>
                                    Miss
                                </option>
                            </select>
                            <label for="">Title</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" required name="first_name" class="form-control" placeholder="First name"
                                value="{{ old('first_name', $session->first_name ?? '') }}">
                            <label for="">Your first name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" required name="last_name" class="form-control" placeholder="Last name"
                                value="{{ old('last_name', $session->last_name ?? '') }}">
                            <label for="">Your surname</label>
                        </div>
                        {{-- <div class="form-floating mb-3">
                            <input type="date" required name="date_of_birth" class="form-control"
                                placeholder="Date of birth"
                                value="{{ old('date_of_birth', $session->date_of_birth ?? '') }}">
                            <label for="">Date of birth dd/mm/yyyy</label>
                        </div> --}}

                        <button class="sub-btn" style="border: 0px" type="submit">Continue</button>

                        <div class="notice my-3">
                            <p>
                                All fields are mandatory. We will never misuse your data or
                                spam you.
                            </p>
                            <a href="/pages/privacy">Read our Privacy Notice</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
