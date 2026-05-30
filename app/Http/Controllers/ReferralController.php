<?php

namespace App\Http\Controllers;

class ReferralController extends Controller
{
    public function index()
    {
        return view('referrals.index');
    }

    public function create()
    {
        return view('referrals.create');
    }

    public function show(string $id)
    {
        return view('referrals.show', compact('id'));
    }

    public function edit(string $id)
    {
        return view('referrals.edit', compact('id'));
    }
}
