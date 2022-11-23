@extends('backend.layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card mb-4">
                <div class="card-header header-elements">
                    <h5 class="m-0 me-2">Blog List</h5>
                    <div class="card-header-elements ms-auto">
                        <a type="button" href="{{ route('admin.blogs.create') }}" class="btn btn btn-primary">
                            <span class="tf-icon bx bx-plus bx-xs"></span> Add New Blog
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table" id="blogsTable">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($blogs as $key => $blog)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $blog->title }}</td>
                                        <td>{{ $blog->slug }}</td>
                                        <td>{{ $blog->created_at->diffForHumans() }}</td>
                                        <td width="10%">
                                            <a href="{{ route('admin.blogs.edit', $blog->id) }}"
                                                class="btn btn-sm btn-primary">Edit</a>
                                            <a href="{{ route('admin.blogs.destroy', $blog->id) }}"
                                                class="btn btn-sm btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                    <div class="mt-3 d-flex" style="float: right">
                        {{ $blogs->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection


@section('js')
    <script>
        $('.resetButton').hide();

        function editCategory(category) {
            $('input[name="id"]').val(category.id);
            $('input[name="name"]').val(category.name);
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
