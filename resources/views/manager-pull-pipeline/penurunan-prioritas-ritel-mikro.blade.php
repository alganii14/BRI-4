@extends('layouts.app')

@section('title', 'Pull of Pipeline - Penurunan Prioritas Ritel Mikro')
@section('page-title', 'Pull of Pipeline - Penurunan Prioritas Ritel & Mikro')

@section('content')
@include('manager-pull-pipeline.partials.read-only-table', [
    'data' => $data,
    'route' => route('manager-pull-pipeline.penurunan-prioritas-ritel-mikro')
])
@endsection
