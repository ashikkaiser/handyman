@extends('backend.layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card mb-4">
                <h5 class="card-header">Edit Blog</h5>
                <div class="card-body">
                    <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Tilte</label>
                            <input type="text" name="title" value="{{ $blog->title }}" class="form-control"
                                placeholder="Blog Title">
                        </div>
                        <div>
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="3">{{ $blog->description }}</textarea>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection


@section('js')
    <script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>

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
