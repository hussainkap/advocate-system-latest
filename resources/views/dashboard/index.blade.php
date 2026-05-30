@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
    <section class="grid gap-4 md:grid-cols-3">
        <div class="rounded-lg bg-white p-6 shadow-sm">
            <p class="text-sm text-gray-500">Total Referrals</p>
            <p class="mt-2 text-3xl font-bold">0</p>
        </div>
        <div class="rounded-lg bg-white p-6 shadow-sm">
            <p class="text-sm text-gray-500">Orders</p>
            <p class="mt-2 text-3xl font-bold">0</p>
        </div>
        <div class="rounded-lg bg-white p-6 shadow-sm">
            <p class="text-sm text-gray-500">Earnings</p>
            <p class="mt-2 text-3xl font-bold">$0.00</p>
        </div>
    </section>
@endsection
