@extends('layouts.app')

@section('title', 'Order Details')
@section('page-title', 'Order Details')

@section('content')
    <section class="rounded-lg bg-white p-6 shadow-sm">
        <h3 class="mb-4 text-lg font-semibold">Order #{{ $id ?? '' }}</h3>
        <p class="text-gray-500">Order details will appear here.</p>
    </section>
@endsection
