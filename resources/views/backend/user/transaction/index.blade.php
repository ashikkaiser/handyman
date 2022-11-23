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
                <h5 class="card-header">Transaction List</h5>
                <div class="table-responsive text-nowrap">
                    {{ $dataTable->table() }}
                </div>
            </div>


            <!--/ Activity Timeline -->
        </div>
    </div>
    </div>
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
