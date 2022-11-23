@extends('frontend.layouts.app')

@section('css')
    <link rel="stylesheet" href="/assets/css/step2.css">
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
            width: 33.32%;
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
                    <div class="step-head-part">
                        <a href="{{ route('tasker.register.step1') }}"><i class="fa-solid fa-angle-left"></i> Back</a>
                        <h3>Choose the membership plan that suits your requirements</h3>
                        <h6>All memberships are for monthly based and include the benefits from Approved membership.</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- business details section end -->
    @php
        $session = (object) session()->get('step2');
        // dd($session);
    @endphp
    <!-- card section area start  -->
    <div class="form-section-area py-5">
        <div class="container">

            @csrf
            <div class="row card-height-fixed">
                @foreach ($packages as $item)
                    @php
                        $title = preg_split('/[\n\r]+/', $item->description);
                        $features = array_slice($title, 1);
                    @endphp
                    {{-- <form action="" method="POST"> --}}
                    <form class="col-lg-4 col-md-12 mb-5" action="" method="POST">
                        <div class="card h-100"
                            @isset($session->package_id)
                                @if ($session->package_id == $item->id)
                                    style="border: 2px solid #d10a38"
                                @endif
                                
                            @endisset>
                            <div class="card-body">
                                <div class="card-title-part">
                                    <h3>{{ $item->name }}</h3>

                                </div>
                                <div class="card-price my-3">
                                    <p>Price</p>
                                    <h4>{{ $item->price ? "£$item->price" : 'Free' }}<span>/month</span></h4>

                                </div>

                                <div class="card-details">
                                    @isset($title[0])
                                        <p>{{ $title[0] }}</p>
                                    @endisset

                                </div>
                                <div class="card-item-list">

                                    <ul>
                                        @foreach ($features as $fe)
                                            <li> {{ $fe }} </li>
                                        @endforeach

                                    </ul>
                                </div>

                                @csrf
                                <input type="hidden" name="package_id"value="{{ $item->id }}">

                                <button class="card-btn"> Choose {{ $item->name }}</button>

                            </div>
                        </div>
                    </form>
                @endforeach

            </div>
        </div>
    </div>
    <!-- form section area end -->
@endsection
