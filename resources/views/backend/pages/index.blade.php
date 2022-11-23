@extends('backend.layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card mb-4">
                <div class="card-header header-elements">
                    <h5 class="m-0 me-2">Page List</h5>
                    <div class="card-header-elements ms-auto">
                        <a type="button" href="{{ route('admin.pages.create') }}" class="btn btn btn-primary">
                            <span class="tf-icon bx bx-plus bx-xs"></span> Add New page
                        </a>
                    </div>
                </div>
                <style>
                    .bg-red {
                        background-color: red;
                    }
                </style>
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table" id="pagesTable">
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
                                @php
                                    $key = 0;
                                @endphp
                                @foreach ($homePages as $i => $page)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td class="bg-red">
                                            <span class="badge bg-red">This is For {{ $page->slug }}</span>

                                        </td>
                                        <td><span class="badge bg-red">This is For {{ $page->slug }}</span></td>
                                        <td>{{ $page->created_at->diffForHumans() }}</td>
                                        <td width="10%">
                                            <a href="{{ route('admin.pages.edit', $page->id) }}"
                                                class="btn btn-sm btn-primary">Edit</a>
                                            {{-- <a href="{{ route('admin.pages.destroy', $page->id) }}"
                                                class="btn btn-sm btn-danger">Delete</a> --}}
                                        </td>
                                    </tr>
                                    @php
                                        $key++;
                                    @endphp
                                @endforeach
                                @foreach ($pages as $page)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $page->title }}</td>
                                        <td>{{ $page->slug }}</td>
                                        <td>{{ $page->created_at->diffForHumans() }}</td>
                                        <td width="10%">
                                            <a href="{{ route('admin.pages.edit', $page->id) }}"
                                                class="btn btn-sm btn-primary">Edit</a>
                                            <a href="{{ route('admin.pages.destroy', $page->id) }}"
                                                class="btn btn-sm btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                    @php
                                        $key++;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3 d-flex" style="float: right">
                        {{ $pages->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection


@section('js')
@endsection
