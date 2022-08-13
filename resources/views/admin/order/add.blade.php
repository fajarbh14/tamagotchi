@push('css')
<style>
    #add-order-content {
        display: block !important;
    }
</style>
@endpush
<aside class="cart-area  dz-scroll" id="cart_area">
    <div class="h-100" id="add-order-content">
        <form id="order" onsubmit="return false;" data-target="{{ Auth::user()->role == 2 ? url('kasir/order') : url('order/store') }}">
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
                                    <th class="text-center">Hapus</th>
                                </tr>
                            </thead>
                            {{ csrf_field() }}
                            <tbody id="wrapper">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <h4 class="mb-4">Total Pembayaran <strong class="grandTotal">
            </strong></h4><input type="hidden" name="total_bayar" class="grandTotal">
            <div class="btn_box">
                <div class="row no-gutter mx-0">
                    <button class="btn btn-primary btn-block col-6 m-0 rounded-0" type="submit">Bayar</button>
                </div>
            </div>
        </form>
    </div>
</aside>
