@extends('backend.layouts.app')

@section('css')
    <link rel="stylesheet" href="/assets/css/electric.css" />
    <link rel="stylesheet" href="/assets/css/account.css" />
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <!-- Multi Column with Form Separator -->
                <div class="col-md-12">

                    <div class="card mb-4">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                                <strong>Success!</strong> {{ session('success') }}
                            </div>
                        @endif
                        <h5 class="card-header title">Edit Company</h5>
                        <form class="card-body" method="POST" action="{{ route('admin.company.update', $company->id) }}"
                            id="step3form" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id">
                            <div class="row g-3">
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="business_name">Business Name</label>
                                    <input type="text" name="business_name" id="business_name"
                                        value="{{ $company->business_name }}" class="form-control" required
                                        placeholder="Business Name" />
                                    @if ($errors->has('business_name'))
                                        <span class="text-danger">{{ $errors->first('business_name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="business_description">Business Description</label>
                                    <textarea name="business_description" id="" class="form-control" cols="10">{{ $company->business_description }}</textarea>
                                    @if ($errors->has('business_description'))
                                        <span class="text-danger">{{ $errors->first('business_description') }}</span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="business_email">Business Email</label>
                                    <input type="email" name="business_email" id="business_email"
                                        value="{{ $company->business_email }}" class="form-control" required
                                        placeholder="Business Email" />
                                    @if ($errors->has('business_email'))
                                        <span class="text-danger">{{ $errors->first('business_email') }}</span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="business_phone">Business Phone</label>
                                    <input type="text" name="business_phone" id="business_phone"
                                        value="{{ $company->business_phone }}" class="form-control" required
                                        placeholder="Business Phone" />
                                    @if ($errors->has('business_phone'))
                                        <span class="text-danger">{{ $errors->first('business_phone') }}</span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="business_type">Business Type</label>
                                    <input type="text" name="business_type" id="business_type"
                                        value="{{ $company->business_type }}" class="form-control" required
                                        placeholder="Business Type" />
                                    @if ($errors->has('business_type'))
                                        <span class="text-danger">{{ $errors->first('business_type') }}</span>
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="form-label" for="business_employee_size">Business Employee Size </label>
                                    <input type="text" name="business_employee_size" id="business_employee_size"
                                        value="{{ $company->business_employee_size }}" class="form-control" required
                                        placeholder="Business Type" />
                                    @if ($errors->has('business_employee_size'))
                                        <span class="text-danger">{{ $errors->first('business_employee_size') }}</span>
                                    @endif
                                </div>
                                @php
                                    $cat = json_decode($company->business_category);
                                    $subcat = json_decode($company->business_subcategory, true);
                                @endphp
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="business_category">Business Category </label>
                                    <select class="form-select select2" name="business_category[]"
                                        aria-label=".form-select-sm example" data-placeholder="Select Business Category"
                                        multiple>
                                        <option value="">Open this select menu</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ in_array($category->id, $cat) ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                                @php
                                    $subcat = json_decode($company->business_subcategory, true);
                                @endphp

                                {{-- <div class="form-group col-md-6">

                                    <label class="form-label" for="business_type">Business Subcategory</label>
                                    <select class="form-select " name="business_subcategory[]"
                                        aria-label=".form-select-sm example">
                                        <option value="">Open this select menu</option>
                                        @foreach ($sub_categories as $subcategory)
                                            <option value="{{ $subcategory->id }}"
                                                {{ in_array($subcategory->id, $subcat) ? 'selected' : '' }}>
                                                {{ $subcategory->name }}</option>
                                        @endforeach

                                    </select>
                                </div> --}}

                                <div class="form-group col-md-6">
                                    <label class="form-label" for="package_id">Package </label>
                                    <select class="form-select " name="package_id" aria-label=".form-select-sm example">

                                        <option value="">Open this select menu</option>
                                        @foreach ($packages as $package)
                                            <option value="{{ $package->id }}"
                                                @if ($company->package_id == $package->id) selected @endif>
                                                {{ $package->name }}</option>
                                        @endforeach

                                    </select>

                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="business_address1">Business Address</label>
                                    <input type="text" name="business_address1" id="business_address1"
                                        value="{{ $company->business_address1 }}" class="form-control" required
                                        placeholder="Business Address" />
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="form-label" for="business_address2">Business Address 2</label>
                                    <input type="text" name="business_address2" id="business_address2"
                                        value="{{ $company->business_address2 }}" class="form-control"
                                        placeholder="Business Address" />
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="business_town">Business Town</label>
                                    <input type="text" name="business_town" id="business_town"
                                        value="{{ $company->business_town }}" class="form-control" required
                                        placeholder="Business Town" />
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="business_country">Business Country</label>
                                    <input type="text" name="business_country" id="business_country"
                                        value="{{ $company->business_country }}" class="form-control" required
                                        placeholder="Business Country" />
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="business_postal_code">Business Postal Code</label>
                                    <input type="text" name="business_postal_code" id="business_postal_code"
                                        value="{{ $company->business_postal_code }}" class="form-control" required
                                        placeholder="Business Postal Code" />
                                </div>
                                <input type="hidden" name="business_latitude" id="business_latitude"
                                    value="{{ $company->business_latitude }}" class="form-control" required
                                    placeholder="Business Latitude" />
                                <input type="hidden" name="business_longitude" id="business_longitude"
                                    value="{{ $company->business_longitude }}" class="form-control" required
                                    placeholder="Business Latitude" />
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="title">Title</label>
                                    <input type="text" name="title" id="title" value="{{ $company->title }}"
                                        class="form-control" required placeholder="Title" />
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="first_name">First Name</label>
                                    <input type="text" name="first_name" id="first_name"
                                        value="{{ $company->first_name }}" class="form-control" required
                                        placeholder="First Name" />
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="last_name">Last Name</label>
                                    <input type="text" name="last_name" id="last_name"
                                        value="{{ $company->last_name }}" class="form-control" required
                                        placeholder="Last Name" />
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="form-label" for="map_address">Map Address</label>
                                    <input type="text" name="map_address" id="map_address"
                                        value="{{ $company->map_address }}" class="form-control"
                                        placeholder="Map Address" />
                                </div>
                                {{-- <div class="form-group col-md-6">
                                    <label class="form-label" for="payment_date">Payment Date</label>
                                    <input type="datetime-local" name="payment_date" id="payment_date"
                                        value="{{ $company->payment_date }}" class="form-control" required
                                        placeholder="Paymeny Date" />
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="form-label" for="expiry_date">Expiry Date</label>
                                    <input type="datetime-local" name="expiry_date" id="expiry_date"
                                        value="{{ $company->expiry_date }}" class="form-control" required
                                        placeholder="Expiry Date" />
                                </div> --}}
                                <div class="col-md-6">
                                    <label for="logo" class="form-label">Upload your business logo</label>
                                    <div id="logo" class="row"></div>
                                </div>
                                <div class="col-md-6">
                                    <label for="logo" class="form-label">Upload your business cover image (Max
                                        {{ $company->packages->images_limit }})</label>
                                    <div id="cover_images" class="row"></div>
                                </div>

                                <div class="form-check form-switch ps-5">
                                    <input class="form-check-input" name="is_active"
                                        {{ $company->is_active === 1 ? 'checked' : '' }} value="1" type="checkbox"
                                        id="is_active">
                                    <label class="form-check-label" for="is_active">Active</label>
                                </div>
                                <div class="form-group col-md-6 form-check form-switch ps-5">
                                    <input class="form-check-input" name="verified" value="1" type="checkbox"
                                        {{ $company->verified === 1 ? 'checked' : '' }} id="verified">
                                    <label class="form-check-label" for="verified">Verified ?</label>
                                </div>
                            </div>

                            <div class="pt-4">
                                <button type="submit" class="btn btn-primary me-sm-3 me-1 submitButton">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>


                <!--/ Activity Timeline -->
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="/assets/js/upload.js"></script>
    <script>
        $(.select2).select2({
            placeholder: {

                text: 'Select an option'
            }
        });
    </script>

    <script>
        $('#step3form').submit(function(e) {
            e.preventDefault();
            // var data = $(this).serializeArray()

            // var lat = data.find(d => d.name == 'business_latitude').value
            // if (lat == '') {
            //     alert('Please enter valid postal code')
            //     return false
            // }
            this.submit()
        })
    </script>
    <script>
        $("#logo").spartanMultiImagePicker({
            fieldName: 'logo',
            maxCount: 1,
            rowHeight: '200px',
            groupClassName: 'col-md-12',
            maxFileSize: '',
            dropFileLabel: "Drop Here",
            placeholderImage: {
                image: '/{{ $company->logo }}',
                width: '100%'
            },
        });
        $("#cover_images").spartanMultiImagePicker({
            fieldName: 'image[]',
            maxCount: {{ $company->packages->images_limit }},
            rowHeight: '200px',
            groupClassName: 'col-4',
            maxFileSize: '',
            dropFileLabel: "Drop Here",
            placeholderImage: {
                image: '/{{ json_decode($company->images)[0] ?? '' }}',
                width: '100%',
                height: '100%'
            },

        });
    </script>


    <script>
        function initMap() {
            const input = document.getElementById("business_postal_code");
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




    <script async
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDNLzN1W7LEWXFF8ssJPU7OZyh3e9-mUrM&libraries=places&callback=initMap">
    </script>
@endsection
