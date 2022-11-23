@extends('backend.layouts.app')

@section('content')
    <style>
        .hide {
            display: none;
        }
    </style>
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card mb-4">
                <h5 class="card-header">Create Testimonial</h5>
                <div class="card-body">
                    <form action="{{ route('admin.testimonial.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 hide">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" value="hello" class="form-control" placeholder=" Title">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <div class="col-md-12">
                                <label for="favicon" class="form-label"> Image</label>
                                <div class="input-group">
                                    <button class="btn btn-outline-primary lfm" data-input="banner_thumbnail"
                                        data-preview="banner_image">Choose File</button>
                                    <input type="text" id="banner_thumbnail" class="form-control" name="image"
                                        required>
                                </div>
                                <div id="banner_image" style="margin-top:15px;max-height:100px;">
                                    <img style="margin-top:15px;max-height:100px;">
                                </div>

                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Author</label>
                            <input type="text" name="author" class="form-control" placeholder="Author">


                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection


@section('js')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>

    <script>
        $('.lfm').filemanager('image');
    </script>
@endsection
