@extends('backend.layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <!-- Multi Column with Form Separator -->
                <div class="col-md-6">

                    <div class="card mb-4">
                        {{-- @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                <strong>Success!</strong> {{ session('success') }}
                            </div>
                        @endif --}}
                        <h5 class="card-header title">New Category</h5>
                        <form class="card-body" method="POST" action="{{ route('admin.category.modify') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id">
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
                                    {{-- <label class="form-label" for="icon">Icon</label>
                                    <input type="file" name="icon" id="icon" class="form-control"
                                        placeholder="Name" /> --}}
                                    <label for="favicon" class="form-label">Icon</label>
                                    <div class="input-group">
                                        <button class="btn btn-outline-primary lfm" data-input="icon_thumpnail"
                                            data-preview="icon">Choose File</button>
                                        <input type="text" value="" id="icon_thumpnail" class="form-control"
                                            name="icon" required>
                                    </div>
                                    <div id="icon" style="margin-top:15px;max-height:100px;">
                                        <img class="icon_place" src="" style="margin-top:15px;max-height:100px;">
                                    </div>
                                </div>


                            </div>

                            <div class="pt-4">
                                <button type="submit" class="btn btn-primary me-sm-3 me-1 submitButton">Submit</button>
                                <button type="button" class="btn btn-warning me-sm-3 me-1 resetButton">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <h5 class="card-header">Category List</h5>
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Subcategory</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->children->count() }}</td>
                                            <td>
                                                <button class="btn btn-primary btn-sm"
                                                    onclick="editCategory({{ $category }})">Edit</button>
                                                <a href="{{ route('admin.category.delete', $category->id) }}"
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
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>

    <script>
        $('.lfm').filemanager('image');
    </script>
    <script>
        $('.resetButton').hide();

        function editCategory(category) {
            console.log(category);
            $('input[name="id"]').val(category.id);
            $('input[name="name"]').val(category.name);
            $('input[name="icon"]').val(category.icon);
            $('.icon_place').attr('src', category.icon);
            $('.title').text('Edit Category');
            $('.submitButton').text('Update');
            $('.resetButton').show();

        }
        $('.resetButton').on('click', function() {
            $('input[name="id"]').val('');
            $('input[name="name"]').val('');
            $('.title').text('New Category');
            $('.submitButton').text('Submit');
            $('.resetButton').hide();
        })
    </script>
@endsection
