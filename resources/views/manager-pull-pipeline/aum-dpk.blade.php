@extends('layouts.app')

@section('title', 'Pull of Pipeline - AUM DPK')
@section('page-title', 'Pull of Pipeline - AUM>2M DPK<50 juta')

@section('content')
@include('manager-pull-pipeline.partials.read-only-table', [
    'data' => $data,
    'route' => route('manager-pull-pipeline.aum-dpk')
])
@endsection
