@extends('backend.layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <!-- Multi Column with Form Separator -->
                <div class="col-md-6">

                    <div class="card mb-4">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                <strong>Success!</strong> {{ session('success') }}
                            </div>
                        @endif
                        <h5 class="card-header title">New Pakcages</h5>
                        <form class="card-body" method="POST" action="{{ route('admin.package.modify') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <div class="row g-3">
                                <div class="form-group">
                                    <label class="form-label" for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" required
                                        placeholder="Name" />
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="description">Description</label>
                                    <textarea name="description" id="description" rows="8" class="form-control" required placeholder="Description"></textarea>
                                    @if ($errors->has('description'))
                                        <span class="text-danger">{{ $errors->first('description') }}</span>
                                    @endif



                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="price">Price</label>
                                    <input type="number" name="price" id="price" class="form-control" required
                                        placeholder="Price" />
                                    @if ($errors->has('price'))
                                        <span class="text-danger">{{ $errors->first('price') }}</span>
                                    @endif
                                </div>
                                <div class="form-group  col-md-6">
                                    <label class="form-label" for="duration">Duration</label>
                                    <select name="duration" id="duration" class="form-control" required>
                                        <option value="Month">Month</option>
                                        <option value="Year">Year</option>
                                    </select>
                                    @if ($errors->has('duration'))
                                        <span class="text-danger">{{ $errors->first('duration') }}</span>
                                    @endif

                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="limited_business_pages">Limited Business Pages</label>
                                    <select name="limited_business_pages" id="limited_business_pages" class="form-control">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                    @if ($errors->has('limited_business_pages'))
                                        <span class="text-danger">{{ $errors->first('limited_business_pages') }}</span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="images_limit">Images Limit</label>
                                    <input type="number" name="images_limit" id="images_limit" class="form-control"
                                        value="{{ old('images_limit') }}" required placeholder="Images Limit" />
                                    @if ($errors->has('images_limit'))
                                        <span class="text-danger">{{ $errors->first('images_limit') }}</span>
                                    @endif

                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="map">Google Map</label>
                                    <select name="map" id="map" class="form-control">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                    @if ($errors->has('map'))
                                        <span class="text-danger">{{ $errors->first('map') }}</span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="credit">Credit</label>
                                    <input type="number" name="credit" id="credit" class="form-control"
                                        value="{{ old('credit') }}" required placeholder="Credit" />
                                    @if ($errors->has('credit'))
                                        <span class="text-danger">{{ $errors->first('credit') }}</span>
                                    @endif

                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="stripe_plan_id">Stripe Plan Id"</label>
                                    <input type="text" name="stripe_plan_id" id="stripe_plan_id" class="form-control"
                                        value="{{ old('stripe_plan_id') }}" required placeholder="Stripe Plan Id" />
                                    @if ($errors->has('stripe_plan_id'))
                                        <span class="text-danger">{{ $errors->first('stripe_plan_id') }}</span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="is_active">Status</label>
                                    <select name="is_active" id="is_active" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <span class="text-danger">{{ $errors->first('is_active') }}</span>
                                    @endif
                                </div>







                                <div class="pt-4">
                                    <button type="submit"
                                        class="btn btn-primary me-sm-3 me-1 submitButton">Submit</button>
                                    <button type="button" class="btn btn-warning me-sm-3 me-1 resetButton">Reset</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <h5 class="card-header">Package List</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>

                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($packages as $package)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $package->name }}</td>

                                        <td>
                                            <button class="btn btn-primary btn-sm"
                                                onclick="editCategory({{ $package }})">Edit</button>
                                            <a href="{{ route('admin.category.delete', $package->id) }}"
                                                class="btn btn-danger btn-sm">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <!--/ Activity Timeline -->
        </div>
    </div>
    </div>
@endsection


@section('js')
    <script>
        $('.resetButton').hide();

        function editCategory(category) {
            $('.resetButton').show();
            $('#name').val(category.name);
            $('#price').val(category.price);
            $('#description').val(category.description);
            $('#duration').val(category.duration);
            $('#limited_business_pages').val(category.limited_business_pages);
            $('#images_limit').val(category.images_limit);
            $('#map').val(category.map);
            $('#credit').val(category.credit);
            $('#stripe_plan_id').val(category.stripe_plan_id);
            $('#is_active').val(category.is_active);
            $('#id').val(category.id);
            $('.title').text('Edit Package');


        }
        $('.resetButton').on('click', function() {

            $('#name').val('');
            $('#price').val('');
            $('#description').val('');
            $('#duration').val('');
            $('#limited_business_pages').val('');
            $('#images_limit').val('');
            $('#map').val('');
            $('#credit').val('');
            $('#stripe_plan_id').val('');
            $('#is_active').val('');
            $('#id').val('');
            $('.title').text('Add Package');
            $('.resetButton').hide();
        })
    </script>
@endsection
