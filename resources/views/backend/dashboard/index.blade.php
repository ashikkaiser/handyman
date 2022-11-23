@extends('backend.layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-md-6 mb-5">
                    <div class="card">
                        <h5 class="card-header" style="display: flex; justify-content: space-between">
                            Latest 10 Companies
                            <a href="{{ route('admin.company.index') }}" class="btn btn-primary btn-sm">View All</a>
                        </h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Company Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($companies as $company)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $company->business_name }}</td>
                                        <td>
                                            @if ($company->is_active == 1)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.company.edit', $company->id) }}"
                                                class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                            @if ($company->is_active == 1)
                                                <a href="{{ route('admin.company.approved', $company->id) }}"
                                                    onclick="return confirm('Are you sure to inactive this company?')"
                                                    class="btn btn-danger btn-sm"><i class="fas fa-times"></i></a>
                                            @else
                                                <a href="{{ route('admin.company.approved', $company->id) }}"
                                                    onclick="return confirm('Are you sure to approve this company?')"
                                                    class="btn btn-success btn-sm"><i class="fas fa-check"></i></a>
                                            @endif


                                        </td>

                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <h5 class="card-header" style="display: flex; justify-content: space-between">
                            Latest 10 Users
                            <a href="{{ route('admin.users.index') }}" class="btn btn-primary btn-sm">View All</a>
                        </h5>
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Email</th>

                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <h5 class="card-header" style="display: flex; justify-content: space-between">
                            Latest 10 Jobs
                            <a href="" class="btn btn-primary btn-sm">View All</a>
                        </h5>
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        {{-- <th>Category</th> --}}
                                        <th>Status</th>
                                        {{-- <th>Actions</th> --}}
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($jobs as $job)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $job->name }}</td>
                                            <td>
                                                @if ($job->status == 'approved')
                                                    <span class="badge bg-success">Approved</span>
                                                @endif
                                                @if ($job->status == 'pending')
                                                    <span class="badge bg-warning">Pending</span>
                                                @endif

                                            </td>
                                            {{-- <td>{{ $job->category->name }}</td> --}}

                                            <td></td>

                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <h5 class="card-header" style="display: flex; justify-content: space-between">
                            Latest 10 Reviews
                            <a href="{{ route('admin.reviews.index') }}" class="btn btn-primary btn-sm">View All</a>
                        </h5>
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Company</th>
                                        <th>Job Name</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($reviews as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{!! $item->company->business_name ?? '<span class="badge bg-label-danger me-1">DELETED</span>' !!}
                                            </td>
                                            <td> {{ $item->job_name }} </td>
                                            <td>
                                                @if ($item->published == true)
                                                    <span class="badge bg-success">Published</span>
                                                @endif
                                                @if ($item->published == false)
                                                    <span class="badge bg-warning">Pending</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->published == true)
                                                    <button type="button" onclick="reviewAprroved({{ $item->id }})"
                                                        class="btn btn-danger btn-sm"><i class="fas fa-times"></i></button>
                                                @else
                                                    <button type="button" onclick="reviewAprroved({{ $item->id }})"
                                                        class="btn btn-success btn-sm"><i class="fas fa-check"></i></button>
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script>
        function reviewAprroved(id) {
            var url = "{{ route('admin.reviews.approve', ':id') }}";
            $.ajax({
                url: url.replace(':id', id),
                type: "get",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                success: function(response) {
                    if (response.status == true) {
                        location.reload();
                    } else {
                        location.reload();
                    }
                }
            });
        }
    </script>
@endsection
