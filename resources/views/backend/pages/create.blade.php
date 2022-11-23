@extends('backend.layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card mb-4">
                <h5 class="card-header">Create New Page </h5>
                <div class="card-body">
                    <form action="{{ route('admin.pages.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Blog Title">
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Tilte</label>
                            <input type="text" name="title" class="form-control" placeholder="Blog Title">
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Slug</label>
                            <input type="text" name="slug" class="form-control" placeholder="Blog Title">
                        </div>
                        <div>
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="3"></textarea>
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
    <script src="/vendor/ckeditor/ckeditor.js"></script>

    <script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
    <script>
        var options = {
            filebrowserImageBrowseUrl: '/filemanager?type=Images',
            filebrowserImageUploadUrl: '/filemanager/upload?type=Images&_token={{ csrf_token() }}',
            filebrowserBrowseUrl: '/filemanager?type=Files',
            filebrowserUploadUrl: '/filemanager/upload?type=Files&_token='
        };
        CKEDITOR.replace('description', options);
        CKEDITOR.config.height = 400;
    </script>
@endsection
