@extends('layouts.app')

@section('title', 'Referrals')
@section('page-title', 'Referrals')

@section('content')
    <section class="rounded-lg bg-white p-6 shadow-sm">
        <div class="mb-4 flex items-center justify-between">
            <h3 class="text-lg font-semibold">Referral List</h3>
            <a class="rounded bg-blue-600 px-4 py-2 text-white" href="{{ route('referrals.create') }}">New Referral</a>
        </div>
        <p class="text-gray-500">Referral records will appear here.</p>
    </section>
@endsection
