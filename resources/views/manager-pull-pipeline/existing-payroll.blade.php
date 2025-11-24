@extends('layouts.app')

@section('title', 'Pull of Pipeline - Existing Payroll')
@section('page-title', 'Pull of Pipeline - Existing Payroll')

@section('content')
@include('manager-pull-pipeline.partials.read-only-table', [
    'data' => $data,
    'route' => route('manager-pull-pipeline.existing-payroll')
])
@endsection
