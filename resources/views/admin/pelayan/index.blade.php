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
                        isLoading = true;
                        axios.get(`/pelanggan/${id}/toggle`)
                            .then(({data})=>{status = data.data})
                            .catch(err=>console.dir(err))
                            .finally(()=>{isLoading = false})
                    "
                    class="card-container cursor-pointer">
                        <div class="card shadow-sm">
                            <div class="card-header text-white" :class="!isLoading ? (status === 'Dipakai' ? 'bg-danger' : 'bg-success') : 'bg-secondary'">
                                <div>
                                    <h4 class="text-white" x-text="!isLoading ? (status === 'Dipakai' ? 'Dipakai' : 'Kosong') : 'Memuat ...';"></h4>
                                </div>
                                <h3 class="text-white"></h3>
                            </div>
                            <div class="card-body text-center">
                                <h4>
                                    Meja {{$datum->no_meja}}
                                </h4>
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