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
            width: 50%;
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
                        <a href="{{ route('tasker.register.step2') }}"><i class="fa-solid fa-angle-left"></i> Back</a>
                        <h3 class="text-center">Your business Address</h3>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- business details section end -->
    @php
        $session = (object) session()->get('step3');
    @endphp
    <!-- form section area start  -->
    <div class="form-section-area py-4">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-5 offset-md-3">
                    <form action="" method="POST" id="step3form" autocomplete="off">
                        @csrf

                        <div class="form-floating mb-3">

                            <input type="text" class="form-control" required name="business_address1"
                                placeholder="Address 1" autocomplete="off"
                                value="{{ old('business_address1', $session->business_address1 ?? '') }}">
                            <label for="">First address line</label>
                            @if ($errors->has('business_address1'))
                                <span class="text-danger">{{ $errors->first('business_address1') }}</span>
                            @endif
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="business_address2" placeholder="Address 2"
                                autocomplete="off"
                                value="{{ old('business_address2', $session->business_address2 ?? '') }}">
                            <label for="">Second address line - optional</label>
                            @if ($errors->has('business_address2'))
                                <span class="text-danger">{{ $errors->first('business_address2') }}</span>
                            @endif
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" required name="business_postal_code" id="postalcode"
                                placeholder="Postal code" autocomplete="off"
                                value="{{ old('business_postal_code', $session->business_postal_code ?? '') }}">
                            <label for=""> Business Postcode</label>
                            @if ($errors->has('business_postal_code'))
                                <span class="text-danger">{{ $errors->first('business_postal_code') }}</span>
                            @endif

                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" required name="business_town" placeholder="Town"
                                autocomplete="off" value="{{ old('business_town', $session->business_town ?? '') }}">
                            <label for="">Town</label>
                            @if ($errors->has('business_town'))
                                <span class="text-danger">{{ $errors->first('business_town') }}</span>
                            @endif

                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" required name="business_country" autocomplete="off"
                                placeholder="Country"
                                value="{{ old('business_country', $session->business_country ?? '') }}">
                            <label for=""> Country </label>
                            @if ($errors->has('business_country'))
                                <span class="text-danger">{{ $errors->first('business_country') }}</span>
                            @endif
                        </div>
                        <input type="hidden" name="business_latitude"
                            value="{{ old('business_latitude', $session->business_latitude ?? '') }}">
                        <input type="hidden" name="business_longitude"
                            value="{{ old('business_latitude', $session->business_latitude ?? '') }}">
                        <button class="sub-btn" style="border: 0px">Continue</button>
                        <div class="notice my-3">
                            <p>All fields are mandatory. We will never misuse your data or spam you.</p>
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
                $('input[name="business_town"]').val(town.long_name);
                $('input[name="business_country"]').val('United Kingdom');
                $('input[name="business_latitude"]').val(place.geometry.location.lat());
                $('input[name="business_longitude"]').val(place.geometry.location.lng());


                // document.getElementById('city2').value = place.name;
                // document.getElementById('cityLat').value = place.geometry.location.lat();
                // document.getElementById('cityLng').value = place.geometry.location.lng();
            });
        }
    </script>

    <script>
        $('#step3form').submit(function(e) {
            // e.preventDefault();
            // var data = $(this).serializeArray()
            // var lat = data.find(d => d.name == 'business_latitude').value
            // if (lat == '') {
            //     alert('Please enter valid postal code')
            //     return false
            // }
            this.submit()
        })
    </script>


    <script async
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDNLzN1W7LEWXFF8ssJPU7OZyh3e9-mUrM&libraries=places&callback=initMap">
    </script>
@endsection
