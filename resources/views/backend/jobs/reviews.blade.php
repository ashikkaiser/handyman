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
                <h5 class="card-header">Reviews List</h5>
                <div class="table-responsive text-nowrap">
                    {{ $dataTable->table() }}
                </div>
            </div>

            <!--/ Activity Timeline -->
        </div>
    </div>
    </div>

    <!-- Review Modal -->
    <div class="modal fade" id="reviewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content" id="viewReview">

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
