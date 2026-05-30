@extends('layouts.app')

@section('title', 'Referral Details')
@section('page-title', 'Referral Details')

@section('content')
    <section class="rounded-lg bg-white p-6 shadow-sm">
        <h3 class="mb-4 text-lg font-semibold">Referral #{{ $id ?? '' }}</h3>
        <p class="text-gray-500">Referral details will appear here.</p>
    </section>
@endsection
