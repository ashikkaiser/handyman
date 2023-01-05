@extends('backend.layouts.app')

@section('css')
    <link rel="stylesheet" href="/admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="/admin/assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="/admin/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
    <link rel="stylesheet" href="/admin/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
    <link rel="stylesheet" href="/admin/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css" />
    <link rel="stylesheet" href="/admin/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css" />
    <link rel="stylesheet" href="/admin/assets/vendor/libs/flatpickr/flatpickr.css" />
    <!-- Row Group CSS -->
    <link rel="stylesheet" href="/admin/assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css" />
    <!-- Form Validation -->
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card p-3">
                <h5 class="card-header" style="display: flex; justify-content: space-between">
                    Admin List
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAdmin">
                        <span class="tf-icons bx bx-plus"></span>
                        Add New Admin
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



    <!-- Edit User Modal -->
    <div class="modal fade" id="addAdmin" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-simple modal-edit-user">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h3>Add New Admin</h3>
                    </div>
                    <form class="row g-3" action="{{ route('admin.new-admin') }}" method="POST">
                        @csrf
                        <div class="col-12 col-md-12">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="John" required />
                        </div>
                        <div class="col-12 col-md-12">
                            <label class="form-label">Email</label>
                            <input type="text" name="email" class="form-control" placeholder="example@domain.com"
                                required />
                        </div>
                        <div class="col-12 col-md-12">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required />
                        </div>
                        <div class="col-12 col-md-12">
                            <label class="form-label">Phone Number</label>
                            <input type="text" name="phone" class="form-control" placeholder="123 456 7890" />
                        </div>

                        <div class="col-12 text-center mt-4">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                                aria-label="Close">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/ Edit User Modal -->
@endsection


@section('js')
    {{ $dataTable->scripts() }}
    <script src="/admin/assets/vendor/libs/datatables/jquery.dataTables.js"></script>
    <script src="/admin/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
    <script src="/admin/assets/vendor/libs/datatables-responsive/datatables.responsive.js"></script>
    <script src="/admin/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js"></script>
    <script src="/admin/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.js"></script>
    <script src="/admin/assets/vendor/libs/datatables-buttons/datatables-buttons.js"></script>
    <script src="/admin/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.js"></script>
@endsection
