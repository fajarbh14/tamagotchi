@extends('layouts.admin.master')
@push('css')
<link href="{{ asset('assets/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid">
    <div class="form-head dashboard-head d-md-flex d-block mb-5 align-items-start">
        <h2 class="dashboard-title me-auto">Daftar Pesanan</h2>
            <li><a href="#" class="btn btn-primary" data-refresh-btn><span> Refresh</span></a></li>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table id="datatable" class="display mb-4 defaultTable dataTablesCard" style="min-width: 845px;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Transaksi</th>
                            <th>No Meja</th>
                            <th>Total Bayar</th>
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
        var API_URL = "{{ url('/transaksi/api') }}";

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
                    {data: 'no_transaksi', name: 'no_transaksi'},
                    {data: 'customer', name: 'customer'},
                    {data: 'total_bayar', name: 'total_bayar'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
            });

            $("[data-refresh-btn]").click(function(e) {
                e.preventDefault();      
                toastAlert("info", "Memperbarui data");
                dt.ajax.reload();
            })
        })
</script>
@endpush
@endsection
