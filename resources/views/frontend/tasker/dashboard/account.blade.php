@extends('frontend.layouts.tasker')
@section('css')
    <link rel="stylesheet" href="/assets/plugin/select2/css.css">

    <link rel="stylesheet" href="/assets/css/electric.css" />
    <link rel="stylesheet" href="/assets/css/credit.css" />
    <link rel="stylesheet" href="/assets/css/accountInfo.css" />
    <link rel="stylesheet" href="/assets/css/image.css" />

    <style>
        .custom-file-upload {
            border: 1px solid #ccc;
            display: inline-block;
            padding: 12px 12px;
            cursor: pointer;
        }

        .dropify-message .file-icon p {
            font-size: 15px;
        }
    </style>
@endsection
@section('page_title', 'My Skills')

@section('content')
    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif
    <div class="account-info-area mt-4">
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" value="{{ $company->business_name }}"
                            name="business_name" placeholder="Your Business Name" required>
                        <label for="">Your Business Name</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" value="{{ $company->business_url }}" name="business_url"
                            placeholder="Your Business Name" required>
                        <label for="">Your Business URL</label>
                    </div>
                </div>


                <div class="col-md-12">
                    <div class="form-floating mb-3">
                        <textarea class="form-control" style="height: 200px" name="business_description"
                            placeholder="Your Business Descriptions">{{ $company->business_description }} </textarea>
                        </textarea>
                        <label for="">Your Business Descriptions</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input class="form-control" type="email"value="{{ $company->business_email }}"
                            name="business_email" required>
                        <label for="">Your Business Email</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <select name="business_type" class="form-select">
                            <option value="Individual"
                                {{ old('business_type', $company->business_type ?? '') == 'Individual' ? 'selected' : '' }}>
                                Individual</option>
                            <option value="Limited Company"
                                {{ old('business_type', $company->business_type ?? '') == 'Limited Company' ? 'selected' : '' }}>
                                Limited Company</option>
                            <option value="Limited"
                                {{ old('business_type', $company->business_type ?? '') == 'Limited' ? 'selected' : '' }}>
                                Limited</option>
                            <option value="Company"
                                {{ old('business_type', $company->business_type ?? '') == 'Company' ? 'selected' : '' }}>
                                Company</option>
                            <option value="MotherBoard"
                                {{ old('business_type', $company->business_type ?? '') == 'MotherBoard' ? 'selected' : '' }}>
                                MotherBoard</option>
                        </select>
                        <label for="">Your Business Type</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <select name="business_employee_size" class="form-select">
                            <option value="1"
                                {{ old('business_employee_size', $company->business_employee_size ?? '') == '1' ? 'selected' : '' }}>
                                1</option>
                            <option value="2-5"
                                {{ old('business_employee_size', $company->business_employee_size ?? '') == '2-5' ? 'selected' : '' }}>
                                2-5</option>
                            <option value="6-9">
                                {{ old('business_employee_size', $company->business_employee_size ?? '') == '6-9' ? 'selected' : '' }}>
                                6-9</option>
                            <option value="10+"
                                {{ old('business_employee_size', $company->business_employee_size ?? '') == '10+' ? 'selected' : '' }}>
                                10+</option>
                        </select>
                        <label for="">Your Business Employees <sup>*</sup></label>
                    </div>
                </div>
                @php
                    $cat = json_decode($company->business_category);
                @endphp
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <select name="business_category[]" id="" class="form-control select2" multiple>
                            @foreach ($categories as $item)
                                <option value="{{ $item->id }}" {{ in_array($item->id, $cat) ? 'selected' : '' }}>
                                    {{ $item->name }}</option>
                            @endforeach
                        </select>
                        <label for="">Your Business Category <sup>*</sup></label>

                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" value="{{ $company->business_registration_number }}"
                            name="business_registration_number" placeholder="Your Business Registration Number" required>
                        <label for="">Your Business Registration Number</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" value="{{ $company->business_address1 }}"
                            name="business_address1" placeholder="First address line" required>
                        <label for="">First address line</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" value="{{ $company->business_address2 }}"
                            name="business_address2" placeholder="Second address line - optional">
                        <label for="">Second address line - optional</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" value="{{ $company->business_town }}"
                            name="business_town" placeholder="Town" required>
                        <label for="">Town</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" value="{{ $company->business_country }}"
                            name="business_country" placeholder="County" required>
                        <label for="">County</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" value="{{ $company->business_postal_code }}"
                            name="business_postal_code" placeholder="Business Postcode" required>
                        <label for="">Business Postcode</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <select name="title" class="form-select">
                            <option value="Mr" {{ old('title', $company->title ?? '') == 'Mr' ? 'selected' : '' }}>
                                Mr
                            </option>
                        </select>
                        <label for="">Title</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text"value="{{ $company->first_name }}" name="first_name"
                            placeholder="Your first name" required>
                        <label for="">Your first name</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" value="{{ $company->last_name }}" name="last_name"
                            placeholder="Your surname" required>
                        <label for="">Your surname</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="current_password"
                            placeholder="Cureent Password">
                        <label for="">Cureent Password</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="new_password" placeholder="New Password">
                        <label for="">New Password</label>
                    </div>
                </div>
                {{-- <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" value="{{ $company->date_of_birth }}"
                            name="date_of_birth" placeholder="Date of birth dd/mm/yyyy" required>
                        <label for="">Date of birth dd/mm/yyyy</label>
                    </div>
                </div> --}}

                {{-- <div class="col-md-6">
                    <label for="file-upload" class="custom-file-upload col-md-12">
                        <i class="fa fa-cloud-upload"></i><span class="filetext"> Upload Logo</span>
                        <input class="form-control" type="file" name="logo" id="file-upload"
                            style="display: none" />
                    </label>
                </div> --}}

                <div class="col-md-12">
                    <label for="logo" class="form-label">Upload your business logo</label>
                    <div id="logo" class="row" style="width: 100%"></div>
                </div>
                @if ($package->images_limit)
                    <div class="row mb-3">
                        <label for="logo" class="form-label">Upload your cover images</label>

                        @for ($i = 0; $i < $package->images_limit; $i++)
                            @php
                                $image = json_decode($company->images);
                                $exist = isset($image[$i]) ? true : false;
                            @endphp
                            <div class="col-md-4">
                                <input type="file" class="dropify" name="images[]"
                                    @if ($exist) data-default-file="/{{ $image[$i] }}" @endif />
                                @if ($exist)
                                    <input type="hidden" name="old_images[]" value="{{ $image[$i] }}">
                                @endif
                            </div>
                        @endfor
                    </div>
                @endif
            </div>
            <button type="submit" class="edit-btn col-md-2">Update</button>
        </form>

    </div>

@endsection


@section('js')
    <script src="/assets/js/upload.js"></script>
    <script src="/assets/js/image.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                // placeholder: 'Select an option',
                // allowClear: true,
                // theme: 'bootstrap5',
            });
        });
    </script>
    <script>
        function onLoad() {
            var current = $('.spartan_item_wrapper').length;
            var limit = {{ $package->images_limit }};
            if (current >= limit) {
                // $('.spartan_add_row').hide();
                $('data-spartanindexrow="0"').hide();
            }
        }
        // console.log($('.spartan_item_wrapper').length)
        // console.log({{ $package->images_limit }})

        $("#logo").spartanMultiImagePicker({
            fieldName: 'logo', // this configuration will send your images named "fileUpload" to the server
            maxCount: 1,
            rowHeight: '200px',
            groupClassName: 'col-4',
            maxFileSize: '',
            dropFileLabel: "Drop Here",
            placeholderImage: {
                image: '/{{ $company->logo }}',
                width: '100%',
                // height: '200px'
            },


        });
        $("#multi_image_picker").spartanMultiImagePicker({
            fieldName: 'images[]', // this configuration will send your images named "fileUpload" to the server
            maxCount: {{ $package->images_limit }},
            rowHeight: '200px',
            groupClassName: 'col-4',
            maxFileSize: '',
            dropFileLabel: "Drop Here",
            onAddRow: function(index) {
                console.log(index);
                console.log('add new row');
            },
            onRenderedPreview: function(index) {

            },
            onRemoveRow: function(index) {
                onLoad()
            },
            onExtensionErr: function(index, file) {
                console.log(index, file, 'extension err');
                alert('Please only input png or jpg type file')
            },
            onSizeErr: function(index, file) {
                console.log(index, file, 'file size too big');
                alert('File size too big');
            }

        });
    </script>

    <script>
        var drEvent = $('.dropify').dropify({
            // messages: {
            //     'default': 'Drag and drop',
            //     'replace': 'Drag and drop or click to replace',
            //     'remove': 'Remove',
            //     'error': 'Ooops, something wrong happended.'
            // }
        });

        drEvent.on('dropify.beforeClear', function(event, element) {
            $(this).parent().parent().find('input[name="old_images[]"]').remove();
            return true;
        });

        $('#file-upload').change(function() {
            var file = $('.filetext')[0].files[0].name;
            $('.custom-file-upload').text(file);
        });
    </script>
@endsection
