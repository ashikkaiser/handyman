@extends('frontend.layouts.tasker')
@section('css')
    <link rel="stylesheet" href="/assets/css/electric.css" />
    <link rel="stylesheet" href="assets/css/step2.css" />
    <style>
        .member-card {
            width: 60% !important;
            margin: 0 auto;
        }

        .member-btn-box button {
            border: none;
            padding: 10px 15px;
            background-color: #204746;
            color: #fff;
            font-size: 14px;
            border-radius: 5px;
        }

        @media only screen and (max-width: 490px) {
            .member-card {
                width: 95% !important;
                margin: 20px auto;
            }
        }
    </style>
@endsection
@isset($session)
@else
    @section('content')
        <div class="card h-100 member-card mt-4">
            @php
                
                $title = preg_split('/[\n\r]+/', $package->description);
                $features = array_slice($title, 1);
            @endphp
            <div class="card-body">

                <div class="card-title-part">
                    <h3>{{ $package->name }}</h3>
                </div>
                <div class="card-price my-3">
                    <p>Price</p>
                    <h4> £{{ $package->price }}<span>/month</span></h4>

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
            </div>
            @php
                // dd($subscription);
            @endphp
            {{-- TimeStamp Convert to localtime and date --}}
            @if ($subscription)
                @php
                    $unixTime = DateTime::createFromFormat('U', $subscription->current_period_end);
                @endphp
                <div class="mb-3">

                    <p class="text-center">Your current membership will expire on {{ $unixTime->format('d-m-Y') }}</p>
                    @if ($subscription->status == 'active')
                        <p class="text-center">Your current membership is active</p>
                        {{-- collection_method --}}
                        @if ($subscription->cancel_at_period_end)
                            <p class="text-center">Your current membership will be cancelled at the end of the period</p>
                        @else
                            <p class="text-center">Your current membership is auto-renewed</p>
                        @endif
                    @else
                        <p class="text-center">Your current membership is inactive</p>
                    @endif
                </div>

                <div class="member-btn-box">
                    @if (!$subscription->cancel_at_period_end)
                        <button onclick="cancleSubscription()" class="btn btn-sm btn-danger">Turn Auto Renewal Off</button>
                    @else
                        <button onclick="cancleSubscription()" class="btn btn-sm btn-primary">Turn Auto Renewal On</button>
                    @endif

                    <button class="btn btn-info" type="button" data-bs-toggle="modal" data-bs-target="#upgradeModal">Change
                        Plan</button>
                </div>
            @endif


        </div>
        <div class="modal fade" id="upgradeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Upgrade Plan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            @foreach ($packages as $item)
                                @php
                                    $title = preg_split('/[\n\r]+/', $item->description);
                                    $features = array_slice($title, 1);
                                @endphp
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title-part">
                                                <h5>Plan Name: {{ $item->name }}</h5>
                                            </div>
                                            <div class="card-price my-3">
                                                <p>Price</p>
                                                <h4> £{{ $item->price }}<span>/month</span></h4>
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
                                        </div>

                                        <div class="member-btn-box">
                                            <button onclick="upgradeSubcription('{{ $item->stripe_plan_id }}')"
                                                class="btn btn-sm btn-primary">Choose This Plan</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('js')
        @if ($subscription)
            <script>
                function cancleSubscription() {
                    var url = "{{ route('tasker.subscriptioncancel') }}";
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            customer_id: "{{ $subscription->customer }}",
                            subscription_id: "{{ $subscription->id }}",
                            cancel_at_period_end: "{{ $subscription->cancel_at_period_end === true ? false : true }}"
                        },
                        success: function(data) {
                            // console.log(data);
                            location.reload();
                        },
                    });
                }
            </script>
            <script>
                function upgradeSubcription(plan) {
                    var url = "{{ route('tasker.subscriptionrenew') }}";
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            customer_id: "{{ $subscription->customer }}",
                            subscription_id: "{{ $subscription->id }}",
                            plan: plan
                        },
                        success: function(data) {
                            if (data.success) {
                                location.reload();
                                swal({
                                    title: "Sucess! ",
                                    text: data.message,
                                    icon: "success",
                                    button: "Ok",

                                });

                            } else {
                                $("#upgradeModal").modal('hide');
                                swal({
                                    title: "Error! ",
                                    text: data.message,
                                    icon: "error",
                                    button: "Ok",
                                    timer: 1500,
                                    showConfirmButton: false
                                }, function() {
                                    if (data.redirect) {
                                        window.location.href = data.redirect;
                                    }

                                });
                            }
                            // location.reload();
                        },
                    });
                }
            </script>
        @endif
    @endsection
@endisset
