<?php

namespace App\Http\Controllers;

class OrderController extends Controller
{
    public function index()
    {
        return view('orders.index');
    }

    public function show(string $id)
    {
        return view('orders.show', compact('id'));
    }
}
