@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="grid grid-cols-3 gap-4">
    <div class="bg-white p-6 rounded shadow">
        <h3 class="text-gray-500">Total Produk</h3>
        <p class="text-2xl font-bold">{{ $productCount }}</p>
    </div>
    <div class="bg-white p-6 rounded shadow">
        <h3 class="text-gray-500">Total Transaksi</h3>
        <p class="text-2xl font-bold">{{ $transactionCount }}</p>
    </div>
    <div class="bg-white p-6 rounded shadow">
        <h3 class="text-gray-500">Total Pendapatan</h3>
        <p class="text-2xl font-bold">Rp {{ number_format($totalIncome, 0, ',', '.') }}</p>
    </div>
</div>
@endsection