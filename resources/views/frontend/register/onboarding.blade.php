@extends('frontend.layouts.app')

@section('css')
    <link rel="stylesheet" href="/assets/css/step1.css" />
    <link rel="stylesheet" href="/assets/plugin/select2/css.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js"
        integrity="sha512-odNmoc1XJy5x1TMVMdC7EMs3IVdItLPlCeL5vSUPN2llYKMJ2eByTTAIiiuqLg+GdNr9hF6z81p27DArRFKT7A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@section('content')
    <div class="business-details-area py-5">Ï
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-5 offset-md-3">
                    <div class="business-content">
                        <h3>On-boarding</h3>
                        <p> Thanks for your interest in TradeExpert. Please tell us a bit more about your business .
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-section-area py-4">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-5 offset-md-3">
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12">
                            <label for="logo" class="form-label">Upload your business logo</label>
                            <div id="logo" class="row"></div>
                        </div>
                        <div class="col-md-12">
                            <label for="logo" class="form-label">Upload your business cover image (Max
                                {{ $company->packages->images_limit }})</label>
                            <div id="cover_images" class="row"></div>
                        </div>
                        <div class="col-md-12">
                            <label for="logo" class="form-label">Business Description</label>
                            <textarea name="business_description" rows="5" class="form-control" placeholder="Write Your Busines Description"></textarea>
                        </div>

                        <button class="sub-btn" style="border: 0px" type="submit">Submit</button>

                        <div class="notice my-3">
                            <p>
                                All fields are mandatory. We will never misuse your data or
                                spam you.
                            </p>
                            <a href="#">Read our Privacy Notice</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- form section area end -->
@endsection
@section('js')
    <script src="/assets/js/upload.js"></script>
    <script>
        $("#logo").spartanMultiImagePicker({
            fieldName: 'logo', // this configuration will send your images named "fileUpload" to the server
            maxCount: 1,
            rowHeight: '200px',
            groupClassName: 'col-md-12',
            maxFileSize: '',
            dropFileLabel: "Drop Here",

        });
        $("#cover_images").spartanMultiImagePicker({
            fieldName: 'images[]', // this configuration will send your images named "fileUpload" to the server
            maxCount: {{ $company->packages->images_limit }},
            rowHeight: '200px',
            groupClassName: 'col-md-4',
            maxFileSize: '',
            dropFileLabel: "Drop Here",

        });
    </script>
@endsection
