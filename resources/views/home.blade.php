@extends('layouts.admin.master')

@section('title', 'DiResto')

@push('css')

@endpush

@section('content')
@if(Auth::User()->role == 1 )
    @includeIf('admin.dashboard.index')
@else
    @includeIf('admin.order.index')
@endif

@push('scripts')

@endpush
@endsection