@extends('backend.layouts.app')

@section('css')
    <link rel="stylesheet" href="/admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="/admin/assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="/admin/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
    <link rel="stylesheet" href="/admin/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
    <link rel="stylesheet" href="/admin/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css" />
    <link rel="stylesheet" href="/admin/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css" />
    <link rel="stylesheet" href="/admin/assets/vendor/libs/flatpickr/flatpickr.css" />
    <link rel="stylesheet" href="/admin/assets/vendor/libs/toastr/toastr.css" />

    <!-- Row Group CSS -->
    <link rel="stylesheet" href="/admin/assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css" />
    <!-- Form Validation -->
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card p-3">
                <h5 class="card-header" style="display: flex; justify-content: space-between">
                    Reviews List
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addReview">
                        <span class="tf-icons bx bx-plus"></span>
                        Add New Review
                    </button>
                </h5>
                <div class="table-responsive text-nowrap">
                    {{ $dataTable->table() }}
                </div>
            </div>

            <!--/ Activity Timeline -->
        </div>
    </div>
    </div>


    <!-- Add Modal -->

    <div class="modal fade" id="addReview" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content" id="addReview">
                <div class="modal-header">
                    <h5 class="modal-title" id="addReview">Add Review</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.reviews.modify') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" name="id" value="{{ $review->id ?? '' }}">
                                <div class="mb-3">
                                    <label class="form-label">USER NAME</label>
                                    <select class="form-select" name="user_id" required>
                                        <option selected>Select User</option>
                                        @foreach ($users as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">COMPANY NAME</label>
                                    <select class="form-select" name="company_id" required>
                                        <option selected>Select Company</option>
                                        @foreach ($companies as $item)
                                            <option value="{{ $item->id }}">{{ $item->business_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">CATEGORY NAME</label>
                                    <select class="form-select" name="category_id" required>
                                        <option selected>Select Category</option>
                                        @foreach ($categories as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">REVIEW TITLE</label>
                                    <input type="text" name="review_title" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">REVIEW</label>
                                    <textarea class="form-control" name="review" rows="3" placeholder=""></textarea>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label">Workmanship</label>
                                        <input type="number" name="workmanship" class="form-control" max="10"
                                            min="0">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Tidiness</label>
                                        <input type="number" class="form-control" name="tidiness" max="10"
                                            min="0">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Reliability</label>
                                        <input type="text" class="form-control" name="reliability" max="10"
                                            min="0">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Courtesy</label>
                                        <input type="text" class="form-control" name="courtesy" max="10"
                                            min="0">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-label-primary">
                            Save
                        </button>
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Add Modal -->

    <!-- Review Modal -->

    <div class="modal fade" id="reviewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content" id="viewReview">

            </div>
        </div>
    </div>
    <!-- Review Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content" id="editReview">

            </div>
        </div>
    </div>
@endsection


@section('js')
    <script>
        function reviewApprove(id) {
            console.log(id);
            $.ajax({
                url: '/admin/reviews/approve/' + id,
                type: 'GET',
                success: function(data) {
                    console.log(data);
                    if (data.status == 'success') {
                        toastr.success(data.message);
                        $('#review-table').DataTable().ajax.reload();
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }

        function reviewDelete(id) {
            alert('Are you sure you want to delete this review?');
            $.ajax({
                url: '/admin/reviews/delete/' + id,
                type: 'GET',
                success: function(data) {
                    if (data.status == 'success') {
                        toastr.success(data.message);
                        $('#review-table').DataTable().ajax.reload();
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }

        $('#review-table').on('click', '.review-modal', function() {
            var review_id = $(this).attr('review_id');
            var url = "{{ route('admin.reviews.view', ':review_id') }}";
            url = url.replace(':review_id', review_id);
            // console.log(url);
            $('#viewReview').html('');
            if (review_id.length != 0) {
                console.log(review_id.length != 0);
                $.ajax({
                    cache: false,
                    type: "GET",
                    error: function(xhr) {
                        alert("An error occurred: " + xhr.status + " " + xhr.statusText);
                    },
                    url: url,
                    success: function(response) {
                        $('#viewReview').html(response);
                    },

                })
            }
        });
        $('#review-table').on('click', '.edit-modal', function() {
            var review_id = $(this).attr('review_id');
            var url = "{{ route('admin.reviews.edit', ':review_id') }}";
            url = url.replace(':review_id', review_id);
            // console.log(url);
            $('#editReview').html('');
            if (review_id.length != 0) {
                console.log(review_id.length != 0);
                $.ajax({
                    cache: false,
                    type: "GET",
                    error: function(xhr) {
                        alert("An error occurred: " + xhr.status + " " + xhr.statusText);
                    },
                    url: url,
                    success: function(response) {
                        $('#editReview').html(response);
                    },

                })
            }
        });
    </script>
    {{ $dataTable->scripts() }}
    <script src="/admin/assets/vendor/libs/datatables/jquery.dataTables.js"></script>
    <script src="/admin/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
    <script src="/admin/assets/vendor/libs/datatables-responsive/datatables.responsive.js"></script>
    <script src="/admin/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js"></script>
    <script src="/admin/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.js"></script>
    <script src="/admin/assets/vendor/libs/datatables-buttons/datatables-buttons.js"></script>
    <script src="/admin/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.js"></script>
    <script src="/admin/assets/vendor/libs/toastr/toastr.js"></script>
@endsection
