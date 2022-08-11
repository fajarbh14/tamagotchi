@extends('layouts.admin.master')

@section('title', 'DiResto')

@push('css')

@endpush

@section('content')
    @includeIf('admin.dashboard.index')
@push('scripts')

@endpush
@endsection