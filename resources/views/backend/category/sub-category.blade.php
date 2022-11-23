@extends('backend.layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <!-- Multi Column with Form Separator -->
                <div class="col-md-4">

                    <div class="card mb-4">
                        {{-- @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                <strong>Success!</strong> {{ session('success') }}
                            </div>
                        @endif --}}
                        <h5 class="card-header title">New Sub Category</h5>
                        <form class="card-body" method="POST" action="{{ route('admin.subcategory.modify') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id">
                            <div class="row g-3">
                                <div class="form-group">
                                    <label class="form-label" for="name">Category</label>
                                    <select name="category_id" id="category_id" class="form-control select2"
                                        data-placeholder="Select Category">
                                        @foreach ($categories as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" required
                                        placeholder="Name" />
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
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

                <div class="col-md-8">
                    <div class="card">
                        <h5 class="card-header">Subcategory List</h5>
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($subCategories as $subCategory)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $subCategory->parent->name }}</td>
                                            <td>{{ $subCategory->name }}</td>

                                            <td>
                                                <button class="btn btn-primary btn-sm"
                                                    onclick="editCategory({{ $subCategory }})">Edit</button>
                                                <a href="{{ route('admin.category.delete', $subCategory->id) }}"
                                                    class="btn btn-danger btn-sm">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>

                            {{ $subCategories->links('pagination::bootstrap-4') }}
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
            $('.submitButton').html('Update');
            $('.resetButton').show();
            $('input[name=id]').val(category.id);
            $('input[name=name]').val(category.name);
            $('input[name="icon"]').val(category.icon);
            $('.icon_place').attr('src', category.icon);
            $('#category_id').val(category.parent_id).trigger('change');
            $('.title').text('Edit Sub Category');

        }
        $('.resetButton').on('click', function() {
            $('.submitButton').html('Submit');
            $('.resetButton').hide();
            $('input[name=id]').val('');
            $('input[name=name]').val('');
            $('select[name=category_id]').val('').trigger('change');;
            $('.title').text('New Sub Category');
        })
    </script>
@endsection
