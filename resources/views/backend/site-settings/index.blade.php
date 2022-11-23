@extends('backend.layouts.app')
@section('css')
    <link rel="stylesheet" href="/admin/assets/vendor/libs/tagify/tagify.css" />
@endsection


@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card mb-4">
                <h5 class="card-header">Site Settings</h5>
                <div class="card-body">

                    <form action="{{ route('admin.settings.store') }}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="{{ $siteSettings->id ?? '' }}">
                        @csrf
                        <h6 class="fw-normal">1. Contact Info</h6>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Site Title</label>
                                    <input type="text" name="name" value="{{ $siteSettings->name ?? '' }}"
                                        class="form-control" placeholder="Site Title" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" value="{{ $siteSettings->email ?? '' }}"
                                        class="form-control" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" name="phone" value="{{ $siteSettings->phone ?? '' }}"
                                        class="form-control" placeholder="Phone" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea class="form-control" name="address" id="address" rows="3" required>{{ $siteSettings->address ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4 mx-n4">
                        <h6 class="fw-normal">2. Site Images</h6>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="favicon" class="form-label">Logo</label>
                                <div class="input-group">
                                    <button class="btn btn-outline-primary lfm" data-input="logo_thumbnail"
                                        data-preview="logo">Choose File</button>
                                    <input type="text" value="{{ $siteSettings->logo }}" id="logo_thumbnail"
                                        class="form-control" name="logo" required>
                                </div>
                                <div id="logo" style="margin-top:15px;max-height:100px;">
                                    <img src="{{ $siteSettings->logo }}" style="margin-top:15px;max-height:100px;">
                                </div>


                            </div>
                            <div class="col-md-4">
                                <label for="favicon" class="form-label">Favicon</label>
                                <div class="input-group">
                                    <button class="btn btn-outline-primary lfm" data-input="favicon_thumbnail"
                                        data-preview="favicon">Choose File</button>
                                    <input type="text" value="{{ $siteSettings->favicon }}" id="favicon_thumbnail"
                                        class="form-control" name="favicon" required>
                                </div>
                                <div id="favicon" style="margin-top:15px;max-height:100px;">
                                    <img src="{{ $siteSettings->favicon }}" style="margin-top:15px;max-height:100px;">
                                </div>

                            </div>
                            <div class="col-md-4">
                                <label for="favicon" class="form-label">banner image</label>
                                <div class="input-group">
                                    <button class="btn btn-outline-primary lfm" data-input="banner_thumbnail"
                                        data-preview="banner_image">Choose File</button>
                                    <input type="text" value="{{ $siteSettings->banner_image }}" id="banner_thumbnail"
                                        class="form-control" name="banner_image" required>
                                </div>
                                <div id="banner_image" style="margin-top:15px;max-height:100px;">
                                    <img src="{{ $siteSettings->banner_image }}"
                                        style="margin-top:15px;max-height:100px;">
                                </div>

                            </div>

                        </div>
                        <hr class="my-4 mx-n4">
                        <h6 class="fw-normal">3. Social Info</h6>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="facebook" class="form-label">Facebook</label>
                                    <input type="url" name="social[facebook]"
                                        value="{{ json_decode($siteSettings->social_links)->facebook }}"
                                        class="form-control" placeholder="Facebook" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="twitter" class="form-label">Twitter</label>
                                    <input type="url" name="social[twitter]"
                                        value="{{ json_decode($siteSettings->social_links)->twitter }}"
                                        class="form-control" placeholder="Twitter" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="instagram" class="form-label">Instagram</label>
                                    <input type="url" name="social[instagram]"
                                        value="{{ json_decode($siteSettings->social_links)->instagram }}"
                                        class="form-control" placeholder="Instagram" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="linkedin" class="form-label">Linkedin</label>
                                    <input type="url" name="social[linkedin]"
                                        value="{{ json_decode($siteSettings->social_links)->linkedin }}"
                                        class="form-control" placeholder="Linkedin" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="youtube" class="form-label">Youtube</label>
                                    <input type="url" name="social[youtube]"
                                        value="{{ json_decode($siteSettings->social_links)->youtube }}"
                                        class="form-control" placeholder="Youtube" required>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4 mx-n4">
                        <h6 class="fw-normal">4. Stripe Setting</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="stripe_api" class="form-label">Stripe Api Key</label>
                                    <input type="text" name="stripe[stripe_api]"
                                        value="{{ json_decode($siteSettings->stripe)->stripe_api }}" class="form-control"
                                        placeholder="Stripe Api Key" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="stripe_secret" class="form-label">Stripe Secret Key</label>
                                    <input type="text" name="stripe[stripe_secret]"
                                        value="{{ json_decode($siteSettings->stripe)->stripe_secret }}"
                                        class="form-control" placeholder="Stripe Secret Key" required>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4 mx-n4">
                        <h6 class="fw-normal">5. Footer Links</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Main Menu</h6>
                                <div class="main-menu">
                                    @foreach (json_decode($siteSettings->footer_links)->main as $key => $item)
                                        <div class="row main-list">
                                            <div class="col-md-5">
                                                <div class="mb-3">
                                                    <label for="menu1" class="form-label">Label</label>
                                                    <input type="text" name="main[{{ $key + 1 }}][label]"
                                                        class="form-control" value="{{ $item->label }}"
                                                        placeholder="Label 1" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="menu1" class="form-label">Link</label>
                                                    <input type="url" name="main[{{ $key + 1 }}][link]"
                                                        class="form-control" value="{{ $item->link }}"
                                                        placeholder="Link 1" required>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="mb-3">
                                                    <button type="button" class="btn btn-icon btn-primary mt-4 add-main">
                                                        <span class="tf-icons bx bx-plus"></span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6>Quick Links</h6>
                                <div class="quick-menu">
                                    @foreach (json_decode($siteSettings->footer_links)->quick as $key => $item)
                                        <div class="row quick-list">
                                            <div class="col-md-5">
                                                <div class="mb-3">
                                                    <label for="menu1" class="form-label">Label</label>
                                                    <input type="text" name="quick[{{ $key + 1 }}][label]"
                                                        class="form-control" value="{{ $item->label }}"
                                                        placeholder="Label 1" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="menu1" class="form-label">Link</label>
                                                    <input type="url" name="quick[{{ $key + 1 }}][link]"
                                                        class="form-control" value="{{ $item->link }}"
                                                        placeholder="Link 1" required>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="mb-3">
                                                    <button type="button"
                                                        class="btn btn-icon btn-primary mt-4 add-quick">
                                                        <span class="tf-icons bx bx-plus"></span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>

                        </div>
                        <hr class="my-4 mx-n4">
                        <h6 class="fw-normal">6. SMTP Setting</h6>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="smtp_host" class="form-label">SMTP Host</label>
                                    <input type="text" name="smtp[smtp_host]" class="form-control"
                                        value="{{ json_decode($siteSettings->smtp)->smtp_host }}" placeholder="SMTP Host"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="smtp_port" class="form-label">SMTP Port</label>
                                    <input type="text" name="smtp[smtp_port]" class="form-control"
                                        value="{{ json_decode($siteSettings->smtp)->smtp_port }}" placeholder="SMTP Port"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="smtp_encryption" class="form-label">From Address</label>
                                    <input type="text" name="smtp[from_address]" class="form-control"
                                        value="{{ json_decode($siteSettings->smtp)->from_address }}"
                                        placeholder="From Address" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="smtp_username" class="form-label">From Name</label>
                                    <input type="text" name="smtp[from_name]" class="form-control"
                                        value="{{ json_decode($siteSettings->smtp)->from_name }}" placeholder="From Name"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="smtp_username" class="form-label">SMTP Username</label>
                                    <input type="text" name="smtp[smtp_username]" class="form-control"
                                        value="{{ json_decode($siteSettings->smtp)->smtp_username }}"
                                        placeholder="SMTP Username" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="smtp_password" class="form-label">SMTP Password</label>
                                    <input type="text" name="smtp[smtp_password]" class="form-control"
                                        value="{{ json_decode($siteSettings->smtp)->smtp_password }}"
                                        placeholder="SMTP Password" required>
                                </div>
                            </div>

                        </div>
                        <hr class="my-4 mx-n4">
                        <h6 class="fw-normal">7. Credit Conversion</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="credit_conversion" class="form-label">Credit Conversion</label>
                                    <div class="input-group">
                                        <span class="input-group-text">1 £=</span>
                                        <input type="text" name="credit_conversion" class="form-control"
                                            placeholder="How much points"
                                            value="{{ $siteSettings->credit_conversion ?? '' }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="credit_conversion" class="form-label">Credit Per Job Post</label>
                                    <div class="input-group">
                                        <span class="input-group-text">1 Job Post=</span>
                                        <input type="text" name="credit_per_job_post" class="form-control"
                                            placeholder="How much points"
                                            value="{{ $siteSettings->credit_per_job_post ?? '' }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="credit_conversion" class="form-label">Points List </label>
                                    <div class="input-group">

                                        <input id="TagifyBasic" class="form-control" name="credit_list"
                                            value="{{ $siteSettings->credit_list ?? '' }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4 mx-n4">
                        <h6 class="fw-normal">8. Copy Right Section</h6>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="copy_right_text" class="form-label">Copy Right Text</label>
                                <input type="text" name="copy_right_text"
                                    value="{{ $siteSettings->copy_right_text ?? '' }}" class="form-control" required>
                            </div>
                        </div>
                        <h6 class="fw-normal">9. POPUP Section</h6>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <textarea type="text" name="popup_text" class="form-control">
                                    {{ $siteSettings->popup_text ?? '' }}
                                </textarea>

                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection


@section('js')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script src="/admin/assets/vendor/libs/tagify/tagify.js"></script>

    <script>
        $('.lfm').filemanager('image');
        var input = document.querySelector('input[name=credit_list]'),
            // init Tagify script on the above inputs
            tagify = new Tagify(input, {
                whitelist: [], // passed as an attribute in this demo
                blacklist: [] // <-- passed as a property
            })
    </script>
    <script src="/vendor/ckeditor/ckeditor.js"></script>

    <script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
    <script>
        var options = {
            filebrowserImageBrowseUrl: '/filemanager?type=Images',
            filebrowserImageUploadUrl: '/filemanager/upload?type=Images&_token={{ csrf_token() }}',
            filebrowserBrowseUrl: '/filemanager?type=Files',
            filebrowserUploadUrl: '/filemanager/upload?type=Files&_token='
        };
        CKEDITOR.replace('popup_text', options);
        CKEDITOR.config.height = 200;
    </script>
    <script>
        $('.add-main').click(function() {

            let count = $('.main-list').length + 1;
            let html = `<div class="row main-list">
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label for="menu1" class="form-label">Label</label>
                                    <input type="text" name="main[${count}][label]" class="form-control"
                                        placeholder="Label ${count}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="menu1" class="form-label">Link</label>
                                    <input type="url" name="main[${count}][link]" class="form-control"
                                        placeholder="Link ${count}" required>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="mb-3">
                                    <button type="button" class="btn btn-icon btn-danger mt-4 add-quick" onclick="removeMain($(this))">
                                        <span class="tf-icons bx bx-x"></span>
                                    </button>
                                </div>
                            </div>
                        </div>`;
            $('.main-menu').append(html);

        })

        $('.add-quick').click(function() {

            let count = $('.quick-list').length + 1;
            let html = `<div class="row quick-list" >
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label for="menu1" class="form-label">Label</label>
                                    <input type="text" name="quick[${count}][label]" class="form-control"
                                        placeholder="Label ${count}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="menu1" class="form-label">Link</label>
                                    <input type="text" name="quick[${count}][link]" class="form-control"
                                        placeholder="Link ${count}" required>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="mb-3">
                                    
                                    <button type="button" class="btn btn-icon btn-danger mt-4 add-quick" onclick="removeQuick($(this))">
                                        <span class="tf-icons bx bx-x"></span>
                                    </button>
                                </div>
                            </div>
                        </div>`;
            $('.quick-menu').append(html);

        })

        function removeQuick(el) {
            el.parent().parent().parent().remove();
        }

        function removeMain(el) {
            el.parent().parent().parent().remove();
        }
    </script>
@endsection
