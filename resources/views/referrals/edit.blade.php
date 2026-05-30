@extends('layouts.app')

@section('title', 'Edit Referral')
@section('page-title', 'Edit Referral')

@section('content')
    <section class="rounded-lg bg-white p-6 shadow-sm">
        <h3 class="mb-4 text-lg font-semibold">Edit Referral #{{ $id ?? '' }}</h3>
        <p class="text-gray-500">Update referral details here.</p>
    </section>
@endsection
