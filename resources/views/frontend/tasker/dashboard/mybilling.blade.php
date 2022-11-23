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

        .single-comment::before {

            content: none;
            width: 0px;
            height: 0px;

        }
    </style>
@endsection

@section('content')
    <div class="text-center loader-wrapper">
        <div class="spinner-border loader" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    @if (session('error'))
        <div class="single-comment mt-4">
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        </div>
    @endif

    @if ($package->id !== 1)
        <div class="single-comment mt-4">

            <h5>Current Plan</h5>

            @foreach ($subscriptions as $item)
                <div class="comment-content items-center">


                    <p class="">{{ $item->product->name }}</p>
                    {{-- {{ $item->currency }} --}}
                    <p class="reviews "><i class="fas fa-euro-sign"></i>
                        {{ $item->product_price->unit_amount / 100 }} per
                        {{ $item->product_price->recurring->interval }}</p>
                    <p> Your plan renews on {{ stripeTime($item->current_period_end)->format('M d, Y') }}</p>

                </div>
            @endforeach
        </div>
    @endif
    <div class="single-comment mt-4">

        <h5>PAYMENT METHOD</h5>

        @forelse  ($paymentMethods->data as $key=> $item)
            @if ($key % 2)
                <div style="border-top: 1px solid #204746"></div>
            @endif
            <div class="comment-content items-center mt-2 mb-2">


                @if ($item->card->brand == 'visa')
                    <i class="fab fa-cc-visa"></i>
                @elseif($item->card->brand == 'mastercard')
                    <i class="fab fa-cc-mastercard"></i>
                @endif
                ****{{ $item->card->last4 }}
                <span class="ms-4">Expires {{ $item->card->exp_month }}/{{ $item->card->exp_year }}</span>

                @if ($item->id === $billingInfo->invoice_settings->default_payment_method)
                    <span class="ms-4">Default</span>
                @else
                    <button onclick="makeDefault('{{ $item->id }}')" class="ms-4 text-white btn btn-sm btn-primary">Make
                        Default</button>
                    <button onclick="deletePaymentMethod('{{ $item->id }}')"
                        class="ms-4 text-white btn btn-sm btn-danger text-white">Remove</button>
                @endif
            </div>

        @empty
            <p>No payment method found</p>
        @endforelse
        <button type="button" class="btn btn-primary btn-sm text-white mt-4" data-bs-toggle="modal"
            data-bs-target="#addCardModal">Add
            Payment Method</button>
    </div>
    <div class="single-comment mt-4">

        <h5>BILLING INFORMATION</h5>

        <p> <strong>Name</strong>: {{ $billingInfo->name }}</p>
        <p> <strong>Email</strong>: {{ $billingInfo->email }}</p>
        <p> <strong>Billing address</strong> :
            {{ $billingInfo->address->line1 }} {{ $billingInfo->address->line2 }} {{ $billingInfo->address->city }},
            {{ $billingInfo->address->postal_code }}
            {{ $billingInfo->address->country }}
        </p>
        <p> <strong>Phone number </strong> : {{ $billingInfo->phone }}</p>

    </div>
    @if ($package->id !== 1)
        <div class="single-comment mt-4">

            <h5>INVOICE HISTORY</h5>


            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Status</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoices as $item)
                        <tr>
                            <th scope="row">{{ stripeTime($item->created)->format('M d, Y') }}</th>
                            <td><i class="fas fa-euro-sign"></i> {{ $item->total / 100 }}</td>
                            <td>
                                @if ($item->status == 'paid')
                                    <span class="badge bg-success">Paid</span>
                                @else
                                    <span class="badge bg-danger">Unpaid</span>
                                @endif
                            </td>
                            <td>
                                {{ $item->product->name }}
                            </td>
                            <td>
                                <a href="{{ $item->invoice_pdf }}" class="btn btn-primary btn-sm text-white">Download
                                    Invoice</a>
                                {{-- view Invoice Button --}}
                                <a class="btn btn-primary btn-sm text-white" href="{{ $item->hosted_invoice_url }}">View
                                    Invoice</a>



                            </td>
                        </tr>
                        {{-- @php
                        dd($item);
                    @endphp --}}
                    @endforeach
                </tbody>
            </table>

        </div>
    @endif

    {{-- add card modal --}}
    <div class="modal fade" id="addCardModal" tabindex="-1" role="dialog" aria-labelledby="addCardTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCardTitle">Add New Card</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" id="cardAdd" method="POST">
                    <div class="modal-body">
                        <div id="card-errors" class="text-danger"></div>

                        @csrf
                        <div id="card-element"></div>
                        <input type="hidden" name="type" value="addCard">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary text-white">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script>
        $(document).ready(function() {
            $('.loader-wrapper').hide();
        });

        function makeDefault(id) {
            $('.loader-wrapper').show();
            $.ajax({
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    payment_method: id,
                    type: 'makeDefault'
                },
                success: function(data) {
                    $('.loader-wrapper').hide();
                    $('.toast').toast('show');
                    location.reload();

                },
                error: function(err) {
                    console.log(err);
                }
            })
        }

        function deletePaymentMethod(id) {
            $('.loader-wrapper').show();
            $.ajax({
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    payment_method: id,
                    type: 'removeCard'
                },
                success: function(data) {
                    $('.loader-wrapper').hide();
                    $('.toast').toast('show');
                    location.reload();

                },
                error: function(err) {
                    console.log(err);
                }
            })
        }
    </script>
    <script src="https://js.stripe.com/v3/"></script>

    <script>
        const stripe = Stripe('{{ env('STRIPE_KEY') }}');
        const elements = stripe.elements();
        const cardElement = elements.create('card', {
            hidePostalCode: true
        });
        cardElement.mount('#card-element');

        $("#cardAdd").submit(function(e) {
            e.preventDefault();
            stripe.createPaymentMethod('card', cardElement).then((result) => {
                if (result.error) {

                    // Inform the customer that there was an error.
                    const errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.paymentMethod.id);
                }
            });
        });

        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            const form = document.getElementById('cardAdd');
            const hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'payment_method');
            hiddenInput.setAttribute('value', token);
            form.appendChild(hiddenInput);
            // console.log($('#cardAdd').serialize());
            // Submit the form
            form.submit();
        }
        // const cardHolderName = document.getElementById('card-holder-name');
        // const cardButton = document.getElementById('card-button');
        // const clientSecret = cardButton.dataset.secret;
    </script>
@endsection
