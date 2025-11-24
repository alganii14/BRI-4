@extends('layouts.app')

@section('title', 'Pull of Pipeline - Strategi 8')
@section('page-title', 'Pull of Pipeline - Wingback Penguatan Produk & Fungsi RM')

@section('content')
@include('manager-pull-pipeline.partials.read-only-table', [
    'data' => $data,
    'route' => route('manager-pull-pipeline.strategi8')
])
@endsection
