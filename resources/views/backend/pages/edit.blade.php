@extends('backend.layouts.app')

@section('content')
    @if ($page->slug === 'home')
        @php
            $data = json_decode($page->description);
            
        @endphp
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card mb-4">
                    <h5 class="card-header">Edit Page</h5>
                    <div class="card-body">
                        <form action="{{ route('admin.pages.update', $page->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="title" class="form-label">Slug</label>
                                <input type="text" name="slug" value="{{ $page->slug }}" readonly
                                    class="form-control" placeholder="Blog Title">
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">

                                        <h5 class="card-header">Banner Text</h5>

                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="title" class="form-label">Banner Title</label>
                                                <input type="text" name="description[bannerTitle]"
                                                    value="{{ $data->bannerTitle }}" class="form-control"
                                                    placeholder="banner Title">
                                            </div>
                                            <div class="mb-3">
                                                <label for="title" class="form-label">Banner SubTitle</label>
                                                <input type="text" name="description[bannerSubTitle]"
                                                    value="{{ $data->bannerSubTitle }}" class="form-control"
                                                    placeholder="banner SubTitle">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6  mb-3">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5> Get Started Now 01</h5>
                                        </div>
                                        <div class="card-body row">
                                            <div class="mb-3 col-md-6">
                                                <label for="title" class="form-label">Get Started Title</label>
                                                <input type="text" name="description[getStarted1][title]"
                                                    value="{{ $data->getStarted1->title }}" class="form-control"
                                                    placeholder="Get Started Title">
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label for="title" class="form-label">Get Started Button</label>
                                                <input type="text" name="description[getStarted1][button]"
                                                    value="{{ $data->getStarted1->button }}" class="form-control"
                                                    class="form-control" placeholder="Get Started Button">
                                            </div>
                                            <div class="mb-3 col-md-12">
                                                <label for="title" class="form-label">Get Started SubTitle</label>
                                                <textarea name="description[getStarted1][subTitle]" class="form-control" cols="30" rows="5">{{ $data->getStarted1->subTitle }}</textarea>

                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="title" class="form-label">Get Started ButtonLink</label>
                                                <input type="text" name="description[getStarted1][buttonLink]"
                                                    value="{{ $data->getStarted1->buttonLink }}" class="form-control"
                                                    class="form-control" placeholder="Get Started Button">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="favicon" class="form-label">Image</label>
                                                <div class="input-group">
                                                    <button class="btn btn-outline-primary lfm" data-input="getStarted1"
                                                        data-preview="getStarted1logo">Choose File</button>
                                                    <input type="text" id="getStarted1" class="form-control"
                                                        value="{{ $data->getStarted1->image }}"
                                                        name="description[getStarted1][image]" required>
                                                </div>
                                                <div id="getStarted1logo" style="margin-top:15px;max-height:100px;">
                                                    <img style="margin-top:15px;max-height:100px;"
                                                        src="{{ $data->getStarted1->image }}">
                                                </div>


                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6  mb-3">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5> Get Started Now 02</h5>
                                        </div>
                                        <div class="card-body row">
                                            <div class="mb-3 col-md-6">
                                                <label for="title" class="form-label">Get Started Title</label>
                                                <input type="text" name="description[getStarted2][title]"
                                                    value="{{ $data->getStarted2->title }}" class="form-control"
                                                    class="form-control" placeholder="Get Started Title">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="title" class="form-label">Get Started Button</label>
                                                <input type="text" name="description[getStarted2][button]"
                                                    value="{{ $data->getStarted2->button }}" class="form-control"
                                                    class="form-control" placeholder="Get Started Button">
                                            </div>
                                            <div class="mb-3 col-md-12">
                                                <label for="title" class="form-label">Get Started SubTitle</label>
                                                <textarea name="description[getStarted2][subTitle]" id="" cols="30" rows="5"
                                                    class="form-control">{{ $data->getStarted2->subTitle }}</textarea>

                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label for="title" class="form-label">Get Started ButtonLink</label>
                                                <input type="text" name="description[getStarted2][buttonLink]"
                                                    value="{{ $data->getStarted2->buttonLink }}" class="form-control"
                                                    class="form-control" placeholder="Get Started Button">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="favicon" class="form-label">Image</label>
                                                <div class="input-group">
                                                    <button class="btn btn-outline-primary lfm" data-input="getStarted2"
                                                        data-preview="getStarted2logo">Choose
                                                        File</button>
                                                    <input type="text" id="getStarted2" class="form-control"
                                                        value="{{ $data->getStarted2->image }}"
                                                        name="description[getStarted2][image]" required>
                                                </div>
                                                <div id="getStarted2logo" style="margin-top:15px;max-height:100px;">
                                                    <img style="margin-top:15px;max-height:100px;"
                                                        src="{{ $data->getStarted2->image }}">

                                                </div>


                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5> Get Started Now 03</h5>
                                        </div>
                                        <div class="card-body row">
                                            <div class="mb-3 col-md-6">
                                                <label for="title" class="form-label">Get Started Title</label>
                                                <input type="text" name="description[getStarted3][title]"
                                                    value="{{ $data->getStarted3->title }}" class="form-control"
                                                    class="form-control" placeholder="Get Started Title">
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label for="title" class="form-label">Get Started Button</label>
                                                <input type="text" name="description[getStarted3][button]"
                                                    value="{{ $data->getStarted3->button }}" class="form-control"
                                                    class="form-control" placeholder="Get Started Button">
                                            </div>
                                            <div class="mb-3 col-md-12">
                                                <label for="title" class="form-label">Get Started SubTitle</label>
                                                <textarea name="description[getStarted3][subTitle]" id="" cols="30" rows="5"
                                                    class="form-control">{{ $data->getStarted3->subTitle }}</textarea>

                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="title" class="form-label">Get Started ButtonLink</label>
                                                <input type="text" name="description[getStarted3][buttonLink]"
                                                    value="{{ $data->getStarted3->buttonLink }}" class="form-control"
                                                    class="form-control" placeholder="Get Started Button">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="favicon" class="form-label">Image</label>
                                                <div class="input-group">
                                                    <button class="btn btn-outline-primary lfm" data-input="getStarted3"
                                                        data-preview="getStarted3logo">Choose
                                                        File</button>
                                                    <input type="text" id="getStarted3" class="form-control"
                                                        value="{{ $data->getStarted3->image }}"
                                                        name="description[getStarted3][image]" required>
                                                </div>
                                                <div id="getStarted3logo" style="margin-top:15px;max-height:100px;">
                                                    <img style="margin-top:15px;max-height:100px;"
                                                        src="{{ $data->getStarted3->image }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="type" value="home">

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @elseif ($page->slug == 'signup')
        @php
            $data = json_decode($page->description);
            
        @endphp
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card mb-4">
                    <h5 class="card-header">Edit Page</h5>
                    <div class="card-body">
                        <form action="{{ route('admin.pages.update', $page->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="title" class="form-label">Slug</label>
                                <input type="text" name="slug" value="{{ $page->slug }}" readonly
                                    class="form-control" placeholder="Blog Title">
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card">

                                        <h5 class="card-header">Benifits 1</h5>

                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="title" class="form-label"> Title</label>
                                                <input type="text" name="description[benefits1][title]"
                                                    value="{{ $data->benefits1->title }}" class="form-control"
                                                    class="form-control" placeholder="Benifits Title">
                                            </div>
                                            <div class="mb-3">
                                                <label for="title" class="form-label"> SubTitle</label>
                                                <textarea name="description[benefits1][subTitle]" class="form-control" rows="5">{{ $data->benefits1->subTitle }}</textarea>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card">

                                        <h5 class="card-header">Benifits 2</h5>

                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="title" class="form-label"> Title</label>
                                                <input type="text" name="description[benefits2][title]"
                                                    value="{{ $data->benefits2->title }}" class="form-control"
                                                    class="form-control" placeholder="Benifits Title">
                                            </div>
                                            <div class="mb-3">
                                                <label for="title" class="form-label"> SubTitle</label>
                                                <textarea name="description[benefits2][subTitle]" class="form-control" id="" cols="30"
                                                    rows="5">{{ $data->benefits2->subTitle }}</textarea>

                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-4 mb-3">
                                    <div class="card">

                                        <h5 class="card-header">Benifits 3</h5>

                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="title" class="form-label"> Title</label>
                                                <input type="text" name="description[benefits3][title]"
                                                    value="{{ $data->benefits3->title }}" class="form-control"
                                                    class="form-control" placeholder="Benifits Title">
                                            </div>
                                            <div class="mb-3">
                                                <label for="title" class="form-label"> SubTitle</label>
                                                <textarea name="description[benefits3][subTitle]" class="form-control" rows="5">{{ $data->benefits3->subTitle }}</textarea>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div class="card">
                                <h5 class="card-header">FAQ</h5>
                                <div class="card-body">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" name="description[faq]" id="description" rows="10">{{ $data->faq }}</textarea>
                                </div>
                            </div>

                    </div>





                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    @else
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card mb-4">
                    <h5 class="card-header">Edit Page</h5>
                    <div class="card-body">
                        <form action="{{ route('admin.pages.update', $page->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Name</label>
                                <input type="text" name="name" value="{{ $page->name }}" class="form-control"
                                    placeholder="Blog Title">
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label">Tilte</label>
                                <input type="text" name="title" value="{{ $page->title }}" class="form-control"
                                    placeholder="Blog Title">
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label">Slug</label>
                                <input type="text" name="slug" value="{{ $page->slug }}" class="form-control"
                                    placeholder="Blog Title">
                            </div>
                            <div>
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" name="description" id="description" rows="10">{{ $page->description }}</textarea>
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection


@section('js')
    <script src="/vendor/ckeditor/ckeditor.js"></script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('.lfm').filemanager('image');
    </script>

    <script src="/vendor/ckeditor/adapters/jquery.js"></script>
    <script>
        var options = {
            filebrowserImageBrowseUrl: '/filemanager?type=Images',
            filebrowserImageUploadUrl: '/filemanager/upload?type=Images&_token={{ csrf_token() }}',
            filebrowserBrowseUrl: '/filemanager?type=Files',
            filebrowserUploadUrl: '/filemanager/upload?type=Files&_token=',
            contentsCss: '/assets/css/b.css',
        };
        CKEDITOR.replace('description', options);
        CKEDITOR.config.height = 400;
    </script>
@endsection
