@extends('frontend.layouts.app')

@section('css')
    <link rel="stylesheet" href="/assets/css/step1.css">
    <link rel="stylesheet" href="/assets/css/step5.css" />

    <!-- Custom Css -->
    <style>
        .business-details-area {
            position: relative;
        }

        .business-details-area::after {
            position: absolute;
            content: "";
            left: 0;
            bottom: 0;
            width: 83.32%;
            height: 4px;
            background-color: #d10a38;
        }
    </style>
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
@endsection
@section('content')
    <div class="business-details-area py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="business-content step-head-part">
                        <a href="{{ route('tasker.register.step4') }}"><i class="fa-solid fa-angle-left"></i> Back</a>
                        <h3 class="text-center">Payment summary</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- business details section end -->
    <div class="text-center loader-wrapper">
        <div class="spinner-border loader" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <!-- membership section start  -->

    <div class="membership-area pt-5 pb-2">
        <div class="container">
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ session('error') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="membership-content text-center">
                        <p>12 months membership</p>
                        <h3> {{ $package->price === 0 ? 'Free' : '£' . $package->price }}<span>/month +VAT</span></h3>

                        <span>
                            Switch membership tier as your business needs change, anytime in
                            your contract
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- membership section end  -->

    <!-- Breakdown section start  -->
    <div class="breakdown-area pt-3 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <h4 class="steap5-common-heading">Breakdown</h4>
                    <div class="member-select-item">
                        <p> Membership tier:<span>{{ $package->name }}</span></p>
                        <p> Category:<span>{{ implode(', ', $categories) }}</span></p>
                        <p> Postcode:<span>{{ $session->step3['business_postal_code'] ?? '' }}</span></p>
                    </div>
                    <div class="member-total-ammount">
                        <ul>
                            <li>
                                <p>Subtotal monthly membership</p>
                                <p> {{ $package->price === 0 ? 'Free' : '£' . $package->price }}</p>
                            </li>
                            <li>
                                <p>Total monthly membership</p>
                                <p> {{ $package->price === 0 ? 'Free' : '£' . $package->price }}</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breakdown section end -->

    <!-- form section area start  -->
    <div class="form-section-area py-4">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6 offset-md-3 stripeFrom">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                Enter your card details
                            </div>
                        </div>
                        <form action="" id="stripePayment" method="POST">
                            @csrf
                            <input type="hidden" name="stripeToken">
                            <input type="hidden" name="amount" value="{{ $package->price }}">
                            <div class="card-body">
                                <div id="card-element"></div>
                            </div>
                            <button type="submit" class="sub-btn" id="card-button" style="border: 0px">Pay</button>

                        </form>


                    </div>
                </div>
                <div class="col-sm-12 col-md-5 offset-md-3 loginform">
                    <h4 class="steap5-common-heading">Create Your Account</h4>


                    <form action="{{ route('tasker.register.store') }}" method="POST">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="email" required name="email" value="{{ $session->step1['business_email'] }}"
                                class="form-control" placeholder="email" readonly />
                            <label for="">Email</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" required name="password" class="form-control" placeholder="password" />
                            <label for="">Password</label>
                        </div>



                        <button type="submit" style="border: 0px" class="sub-btn">Continue</button>


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
    <!-- form section area end -->
@endsection

@section('js')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        $('.loader-wrapper').hide();
        var price = {{ $package->price }};
        if (price === 0) {
            $('.stripeFrom').hide();
            $('.loginform').show();
        } else {
            $('.stripeFrom').show();
            $('.loginform').hide();
        }

        var stripe = Stripe("{{ json_decode(site('stripe'))->stripe_api }}");
        var elements = stripe.elements();
        var cardElement = elements.create('card', {
            hidePostalCode: true,
            style: {

                base: {
                    // "fontFamily": "Montserrat",
                    "color": "#32325D",
                    "border": "2px solid #ccc",
                    "fontWeight": 400,
                    "fontSize": "18px",
                    "fontSmoothing": "antialiased",
                    "::placeholder": {
                        "color": "#204746"
                    },
                    ":-webkit-autofill": {
                        "color": "#e39f48"
                    }
                },
                invalid: {
                    iconColor: '#FFC7EE',
                    color: '#FFC7EE',
                },
            },
        });
        var card = elements.getElement('card');
        card.mount('#card-element');

        function setOutcome(result) {


            if (result.token) {
                $('.overlayLoader').show()
                $('input[name="stripeToken"]').attr('value', result.token.id);
                $.post("{{ route('payment.stripePost') }}", {
                    _token: "{{ csrf_token() }}",
                    ...result,
                    amount: $('input[name="amount"]').val(),
                }).then(res => {
                    $('.loader-wrapper').hide();
                    if (res.success) {
                        $('.stripeFrom').hide();
                        $('.loginform').show();
                    } else {
                        $('.overlayLoader').hide()
                    }
                })

            } else if (result.error) {
                $('.overlayLoader').hide()
            }
        }
    </script>

    <script>
        let intentToken = "{{ $intent->client_secret }}";
        $('#stripePayment').on('submit', async function(e) {
            $('.loader-wrapper').show();
            e.preventDefault();
            const {
                setupIntent,
                error
            } = await stripe.confirmCardSetup(
                intentToken, {
                    payment_method: {
                        card: cardElement,
                        billing_details: {
                            name: "{{ $session->step4['first_name'] . ' ' . $session->step4['last_name'] }}"
                        }
                    }
                }
            )
            if (error) {
                swal({
                    title: "Error!",
                    text: error.message,
                    icon: "error",
                    button: "Ok",
                });
            } else {
                console.log(setupIntent)

            }



            $.post("{{ route('payment.subscription') }}", {
                _token: "{{ csrf_token() }}",
                price_id: "{{ $package->stripe_plan_id }}",
                payment_method: setupIntent.payment_method,

            }).then(async res => {

                $('.loader-wrapper').hide();
                $('.stripeFrom').hide();
                $('.loginform').show();

            })




            // $.post("{{ route('payment.subscription') }}", {
            //     price_id: "{{ $package->stripe_plan_id }}",
            //     _token: "{{ csrf_token() }}",
            // }).then(res => {
            //     var options = {
            //         name: "{{ $session->step4['first_name'] . ' ' . $session->step4['last_name'] }}",
            //         email: "{{ $session->step1['business_email'] }} ",
            //         address_country: "UK",
            //         address_zip: "{{ $session->step3['business_postal_code'] }}",
            //         currency: "gbp",
            //     };

            //     // stripe.createToken(card, options).then(setOutcome);
            // })





        })
    </script>
@endsection
