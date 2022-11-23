@extends('frontend.layouts.tasker')
@section('css')
    <link rel="stylesheet" href="/assets/css/electric.css" />
    <link rel="stylesheet" href="/assets/css/credit.css" />
    <style>
        .loader-wrapper {
            content: '';
            display: block;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 999999999;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .loader-wrapper .loader {
            margin-top: 40vh;
            color: #204746;
            height: 75px;
            width: 75px;

        }
    </style>
    <style>
        .card-option input[type="radio"]:checked+.single-payment {
            border: 1px solid #204746 color: #fff;
        }

        .select-payment-box {
            border: 1px solid #204746;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }
    </style>

@endsection
@section('page_title', 'My Skills')

@section('content')
    <div class="account-details col-md-12">
        <div class="account-details-header">
            <h2>Top Up Credits</h2>
            <h2>Available Credit: {{ $company->credit }} Points</h2>
        </div>
        <div class="text-center loader-wrapper">
            <div class="spinner-border loader" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <form action="" method="POST" id="topUpForm">
            @csrf
            <input type="hidden" name="stripeToken">
            <input type="hidden" name="key">
            <div class="account-details-content-area mt-4 col-md-12">
                <div class="account-details-content">
                    <div class="choose-amount-area">
                        <h5 class="account-details-content-heding">
                            Choose Amount (£) | <strong>1 Credit = {{ round(1 / site()->credit_conversion, 2) }}
                                £</strong>
                        </h5>

                        <div class="choose-amount-box">
                            <div class="form-group">
                                <input type="radio" name="amount" value="20" id="20">
                                <label for="20">20</label>
                            </div>
                            <div class="form-group">
                                <input type="radio" name="amount" value="50" id="50">
                                <label for="50">50</label>
                            </div>
                            <div class="form-group">
                                <input type="radio" name="amount" value="100" id="100">
                                <label for="100">100</label>
                            </div>
                            <div class="form-group">
                                <input type="radio" name="amount" value="200" id="200">
                                <label for="200">200</label>
                            </div>
                            <div class="form-group">
                                <input type="radio" name="amount" value="500" id="500">
                                <label for="500">500</label>
                            </div>
                        </div>
                    </div>
                    <div class="choose-payment-method-area mb-3">
                        <h5 class="account-details-content-heding">
                            choose a payment method
                        </h5>
                        <div class="choose-payment-box row">
                            <label for="card" class="col-md-6 card-option">
                                <input type="radio" name="payment_method" value="card" id="card">
                                <div class="single-payment">
                                    <i class="fa-regular fa-credit-card"></i>
                                    <span>Existing Cards</span>
                                </div>
                            </label>
                            <label for="newcard" class="col-md-6 card-option">
                                <input type="radio" name="payment_method" value="newcard" id="newcard">
                                <div class="single-payment">
                                    <i class="fa-regular fa-credit-card"></i>

                                    <span>New Card</span>

                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="select-payment-method">
                        <h5 class="account-details-content-heding ashik">

                        </h5>
                        <div class="existing-card-box">


                            @foreach ($paymentMethods->data as $item)
                                <label for="{{ $item->id }}" class="col-md-4 card-option">
                                    <input type="radio" name="saved-payment" value="{{ $item->id }}"
                                        id="{{ $item->id }}">
                                    <div class="single-payment">
                                        <i class="fab fa-cc-{{ $item->card->brand }}"></i>


                                        <span> ****{{ $item->card->last4 }}</span>
                                        <span class="ms-4">
                                            {{ $item->card->exp_month }}/{{ $item->card->exp_year }}</span>


                                    </div>
                                </label>
                                {{-- <div class="comment-content mt-2 mb-2">


                                @if ($item->card->brand == 'visa')
                                    <i class="fab fa-cc-visa"></i>
                                @elseif($item->card->brand == 'mastercard')
                                    <i class="fab fa-cc-mastercard"></i>
                                @endif
                                ****{{ $item->card->last4 }}
                                <span class="ms-4">Expires
                                    {{ $item->card->exp_month }}/{{ $item->card->exp_year }}</span>

                                @if ($item->id === $billingInfo->invoice_settings->default_payment_method)
                                    <span class="ms-4">Default</span>
                                @endif
                            </div> --}}
                            @endforeach

                        </div>
                        <div class="select-payment-box">
                            <div id="card-element"></div>
                        </div>
                    </div>

                    <div class="top-up-btn-area my-5">
                        <a href="#">Cancel</a>
                        <button>Top Up</button>
                    </div>
                </div>

                {{-- <div class="account-details-summary-area">
                    <div class="account-details-summary-content">
                        <h4>Payment Summary</h4>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>£{{ $item->amount }}</td>
                                        <td>{{ $item->created_at->format('d M Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> --}}
            </div>
        </form>

    </div>

@endsection


@section('js')
    <script src="https://js.stripe.com/v3/"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $('.loader-wrapper').hide();
        var stripe = Stripe("{{ json_decode(site('stripe'))->stripe_api }}");
        var elements = stripe.elements();
        var cardElement = elements.create('card', {
            hidePostalCode: true,
            style: {
                base: {
                    // "fontFamily": "Montserrat",
                    "color": "#32325D",
                    "border": "1px solid #ccc",
                    "fontWeight": 400,
                    "fontSize": "18px",
                    "fontSmoothing": "antialiased",
                    "::placeholder": {
                        "color": "#222222"
                    },
                    ":-webkit-autofill": {
                        "color": "#e39f48"
                    }
                },

            },
        });
        var card = elements.getElement('card');
        card.mount('#card-element');

        function setOutcome(result) {


            if (result.token) {
                $('input[name="stripeToken"]').attr('value', result.token.id);
                $.post("{{ route('payment.stripePost') }}", {
                    _token: "{{ csrf_token() }}",
                    ...result,
                    amount: $('input[name="amount"]:checked').val()
                }).then(res => {
                    $('.loader-wrapper').hide();
                    if (res.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'success',
                            text: res.message,
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Redirect Soon",
                            closeOnConfirm: false
                        })
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                        $('.overlayLoader').hide()
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: res.message,
                        })
                        $('.overlayLoader').hide()
                    }
                })

            } else if (result.error) {

            }
        }
    </script>

    <script>
        $('#topUpForm').on('submit', function(e) {

            e.preventDefault();
            var amount = $('input[name="amount"]:checked').val();
            var payment_method = $('input[name="payment_method"]:checked').val();
            if (amount == undefined) {
                alert('Please select amount');
                return false;
            }
            if (payment_method == undefined) {
                alert('Please select payment method');
                return false;
            }
            // $('.loader-wrapper').show();
            if (payment_method === 'newcard') {
                var options = {
                    customer: "{{ auth()->user()->stripe_id }}",
                };
                stripe.createToken(card, options).then(function(results) {
                    if (results.error) {
                        // Inform the customer that there was an error.
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = results.error.message;
                    } else {
                        // Send the token to your server.
                        console.log(results);
                        $.post("{{ route('payment.cardPayment') }}", {
                            _token: "{{ csrf_token() }}",
                            ...results,
                            stripeToken: results.token.id,
                            amount: amount
                        }).then(res => {
                            $('.loader-wrapper').hide();
                            if (res.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'success',
                                    text: res.message,
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,

                                })
                                setTimeout(function() {
                                    window.location.reload();
                                }, 2000);
                                $('.overlayLoader').hide()
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: res.message,
                                })
                                $('.overlayLoader').hide()
                            }
                        })
                        // stripeTokenHandler(results);
                    }


                });
            } else {
                var paymentMethodId = $('input[name="saved-payment"]:checked').val();
                $('.loader-wrapper').show();
                $.post("{{ route('payment.topupFromExisting') }}", {
                    _token: "{{ csrf_token() }}",
                    amount: amount,
                    payment_method_id: paymentMethodId
                }).then(res => {
                    console.log(res);
                    $('.loader-wrapper').hide();
                    if (res.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'success',
                            text: res.message,
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Redirect Soon",
                            closeOnConfirm: false
                        })
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                        $('.overlayLoader').hide()
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: res.message,
                        })
                        $('.overlayLoader').hide()
                    }
                }).catch(err => {
                    $('.loader-wrapper').hide();
                    console.log(err);
                })
                // stripe.charges(paymentMethodId, amount).then(function(result) {
                //     console.log(result);
                // });
                // stripe.paymentIntents.create({
                //     amount: amount * 100,
                //     currency: 'gbp',
                //     payment_method: paymentMethodId,

                // }).then(function(results) {
                //     if (results.error) {
                //         // Inform the customer that there was an error.
                //         var errorElement = document.getElementById('card-errors');
                //         errorElement.textContent = results.error.message;
                //     } else {
                //         // Send the token to your server.
                //         console.log(results);
                //         // stripeTokenHandler(results);
                //     }
                // });

            }

            console.log(amount, payment_method);

            // if(payment_method == 'stripe'){
            //     stripe.createToken(card).then(function(result) {
            //         setOutcome(result);
            //     });
            // var options = {
            //     name: "{{ Auth::user()->name }}",
            //     address_country: "UK",
            //     address_zip: "{{ Auth::user()->post_code }}",
            //     email: "{{ Auth::user()->email }}",



            // };
            // stripe.createToken(card, options).then(setOutcome);

        })
    </script>

    <script>
        $(document).ready(function() {
            var payment_method = $('input[name="payment_method"]:checked').val();

            $('.select-payment-box').hide();
            $('.existing-card-box').hide();
            $('input[name="payment_method"]').on('change', function() {
                if ($(this).val() == 'newcard') {
                    $('.select-payment-box').show();
                    $('.existing-card-box').hide();
                    $('.account-details-content-heding.ashik').text('Enter Card Details');
                    $('input[name="saved-payment"]').attr('required', false);
                } else {
                    $('.select-payment-box').hide();
                    $('.existing-card-box').show();
                    $('input[name="saved-payment"]').attr('required', true);
                    $('.account-details-content-heding.ashik').text('Select Card');
                }
            })
        })
    </script>

@endsection
