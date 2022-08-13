@extends('layouts.admin.master')

@section('title', 'DiResto')

@push('css')
<style>
    #add-order-content {
        display: block !important;
    }

</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="form-head dashboard-head d-md-flex d-block mb-5 align-items-start">
        <h2 class="dashboard-title me-auto">Pesanan {{$data->no_transaksi}}</h2>
    </div>
    <div class="h-100" id="add-order-content">
        <form id="update-payment" onsubmit="return false;" 
            data-target="{{ url('transaksi/pembayaran/'.$data->id) }}">
            <div class="card rounded-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table text-black">
                            <thead>
                                <tr>
                                    <th>MENU</th>
                                    <th>HARGA</th>
                                    <th>JUMLAH</th>
                                    <th>TOTAL(Rp)</th>
                                </tr>
                            </thead>
                            {{ csrf_field() }}
                            <tbody id="wrapper">
                                @foreach ($dataDetail as $item)
                                <tr>
                                    <td>{{$item->menu->nama}}</td>
                                    <td>{{$item->menu->harga}}</td>
                                    <td>{{$item->jumlah}}</td>
                                    <td>{{ number_format($item->subtotal,0,',','.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <h3 class="mb-4">Total Pembayaran <strong>Rp {{ number_format($data->total_bayar,0,',','.') }}</strong></h3>
            <div class="d-flex flex-row-reverse">
                <div class="row no-gutter mx-0">
                    <button class="btn btn-primary" type="submit">Bayar</button>
                </div>
            </div>
        </form>
    </div>
</div>
@push('scripts')
<script>
$(document).on("submit", "#update-payment", function() {
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
            setTimeout(function() {
                window.location.href = "{{ url('transaksi') }}";
            }, 1000);
        },
        error: function(reject) {
            $("button").attr("disabled", false);
            toastAlert("error", "Terjadi kesalahan");
        }
    })
})
</script>
@endpush
@endsection
