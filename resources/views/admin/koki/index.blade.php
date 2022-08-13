@extends('layouts.admin.master')

@section('title', 'DiResto')

@push('css')

@endpush

@section('content')
    <div class="content-wrapper pt-0">
        <!-- row -->
        <div class="container-fluid">
            <div class="row order-row" id="masonry">
                @foreach ($data as $datum)
                    <div
                    x-data="{status : '{{$datum->status}}', id : {{$datum->id}}, isLoading : false}" 
                    @click="
                        if(isLoading)
                            return;
                        if(status == 'Selesai Dibuat')
                            return;
                        isLoading = true;
                        axios.get(`/order/${id}/toggle`)
                            .then(({data})=>{status = data.data})
                            .catch(err=>console.dir(err))
                            .finally(()=>{isLoading = false;})
                    "
                    class="card-container cursor-pointer">
                        <div class="card  shadow-sm">
                             <div class="card-header text-white" :class="!isLoading ? (status == 'Diproses' ? 'bg-warning' : 'bg-success') : 'bg-secondary'">
                                <div>
                                    <h4 class="text-white">DiResto</h4>
                                    <span class="fs-12 op9">{{$datum->no_transaksi}}</span>
                                </div>
                                <h3 class="text-white" x-text="!isLoading ? (status == 'Diproses' ? 'Diproses' : 'Selesai Dibuat') : 'Memuat ...';"></h3>
                            </div>
                            <div class="card-body">
                                <ul class="order-list">
                                    @foreach ($datum->orders as $order)
                                        <li><span>{{$order->jumlah}}</span>{{$order->menu->nama}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
@push('scripts')
@endpush
@endsection