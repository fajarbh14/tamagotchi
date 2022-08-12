@extends('layouts.admin.master')
@push('css')
<link href="{{ asset('assets/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid">
    <div class="form-head dashboard-head d-md-flex d-block mb-5 align-items-start">
        <h2 class="dashboard-title me-auto">User
            <a href="javascript:void(0);" onclick="openForm('{{ url('/user/create') }}', 'create')" 
            class="btn btn-success btn-rounded ms-4 text-white d-inline-block">Tambah</a></h2>
            <li><a href="#" class="btn btn-primary" data-refresh-btn><span> Refresh</span></a></li>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table id="datatable" class="display mb-4 defaultTable dataTablesCard" style="min-width: 845px;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script src="{{ asset('assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script>
    var dt;
        var API_URL = "{{ url('/user/api') }}";

        $(document).ready(function() {
            dt = $("#datatable").DataTable({
                ajax: {
                    url: API_URL,
                    type: "GET"
                },
                processing: true,
                serverSide: true,
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'nama', name: 'nama'},
                    {data: 'username', name: 'username'},
                    {data: 'role', name: 'role'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
            });

            $("[data-refresh-btn]").click(function(e) {
                e.preventDefault();
                
                toastAlert("info", "Memperbarui data");
                dt.ajax.reload();
            })
        })

        $(document).on("submit", "#create-form", function() {
            $.ajax({
                url: "{{ url('/user/store') }}",
                type: "POST",
                data: new FormData(this),
                dataType: "json",
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $("button").attr("disabled", true);
                },
                success: function(response) {
                    $("button").attr("disabled", false);
                    if (response.status_code == 500) return toastAlert("error", response.message);
                    if (response.status_code == 400) return populateErrorMessage(response.errors);

                    toastAlert("success", response.message);
                    $("#create-form").trigger("reset");
                    dt.ajax.reload();
                    formModal.hide();
                },
                error: function(reject) {
                    $("button").attr("disabled", false);
                    toastAlert("error", "Terjadi kesalahan pada server");
                    formModal.hide();
                }
            })
        })

        $(document).on("submit", "#edit-form", function() {
            $.ajax({
                url: $(this).data("target"),
                type: "POST",
                data: new FormData(this),
                dataType: "json",
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $("button").attr("disabled", true);
                },
                success: function(response) {
                    $("button").attr("disabled", false);
                    if (response.status_code == 500) return toastAlert("error", response.message);
                    if (response.status_code == 400) return populateErrorMessage(response.errors);

                    toastAlert("success", response.message);
                    $("#create-form").trigger("reset");
                    dt.ajax.reload();
                    formModal.hide();
                },
                error: function(reject) {
                    $("button").attr("disabled", false);
                    toastAlert("error", "Terjadi kesalahan pada server");
                    formModal.hide();
                }
            })
        })
</script>
@endpush
@endsection
