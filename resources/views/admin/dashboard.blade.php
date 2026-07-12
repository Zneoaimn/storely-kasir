@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="mb-10">
    <h1 class="text-[32px] font-semibold tracking-[-0.04em] text-[#111111]">Dashboard</h1>
    <p class="mt-2 text-[15px] text-[#666]">Ringkasan aktivitas toko hari ini.</p>
</div>

@php
    $productCount = App\Models\Product::count();
    $transactionCount = App\Models\Transaction::count();
    $totalIncome = App\Models\Transaction::sum('total_price');
    $recentTransactions = App\Models\Transaction::with('user')->latest()->take(5)->get();
@endphp

<div class="grid grid-cols-1 gap-4 md:grid-cols-3">
    <div class="rounded-2xl border border-black/8 bg-white p-6 shadow-[0_1px_2px_rgba(0,0,0,0.04)]">
        <div class="mb-5 h-1 w-10 rounded-full bg-black/80"></div>
        <p class="text-[13px] font-medium text-[#777]">Total Produk</p>
        <p class="mt-2 text-[34px] font-semibold tracking-[-0.05em] text-[#111]">
            {{ $productCount }}
        </p>
    </div>

    <div class="rounded-2xl border border-black/8 bg-white p-6 shadow-[0_1px_2px_rgba(0,0,0,0.04)]">
        <div class="mb-5 h-1 w-10 rounded-full bg-black/80"></div>
        <p class="text-[13px] font-medium text-[#777]">Total Transaksi</p>
        <p class="mt-2 text-[34px] font-semibold tracking-[-0.05em] text-[#111]">
            {{ $transactionCount }}
        </p>
    </div>

    <div class="rounded-2xl border border-black/8 bg-white p-6 shadow-[0_1px_2px_rgba(0,0,0,0.04)]">
        <div class="mb-5 h-1 w-10 rounded-full bg-black/80"></div>
        <p class="text-[13px] font-medium text-[#777]">Total Pendapatan</p>
        <p class="mt-2 text-[34px] font-semibold tracking-[-0.05em] text-[#111]">
            Rp {{ number_format($totalIncome, 0, ',', '.') }}
        </p>
    </div>
</div>

<div class="mt-8 overflow-hidden rounded-2xl border border-black/8 bg-white shadow-[0_1px_2px_rgba(0,0,0,0.04)]">
    <div class="flex items-center justify-between border-b border-black/5 px-6 py-5">
        <div>
            <h2 class="text-[18px] font-medium text-[#111]">Transaksi terbaru</h2>
            <p class="mt-1 text-[14px] text-[#666]">Aktivitas pembelian paling baru.</p>
        </div>

        <a href="{{ route('admin.products.index') }}"
           class="text-[14px] font-medium text-[#444] transition hover:text-[#111]">
            Kelola produk
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full min-w-[760px]">
            <thead class="border-b border-black/5 bg-[#fcfcfc]">
                <tr class="text-left">
                    <th class="px-6 py-4 text-[12px] font-medium uppercase tracking-[0.08em] text-[#888]">ID</th>
                    <th class="px-6 py-4 text-[12px] font-medium uppercase tracking-[0.08em] text-[#888]">Pelanggan</th>
                    <th class="px-6 py-4 text-[12px] font-medium uppercase tracking-[0.08em] text-[#888]">Total</th>
                    <th class="px-6 py-4 text-[12px] font-medium uppercase tracking-[0.08em] text-[#888]">Status</th>
                    <th class="px-6 py-4 text-[12px] font-medium uppercase tracking-[0.08em] text-[#888]">Waktu</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentTransactions as $t)
                    <tr class="border-t border-black/5">
                        <td class="px-6 py-5 text-[14px] font-medium text-[#111]">#{{ $t->id }}</td>
                        <td class="px-6 py-5 text-[14px] text-[#666]">{{ $t->user->name ?? 'Guest' }}</td>
                        <td class="px-6 py-5 text-[14px] font-medium text-[#111]">
                            Rp {{ number_format($t->total_price, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-5">
                            <span class="inline-flex items-center rounded-full border border-black/10 bg-black/[0.03] px-2.5 py-1 text-[12px] font-medium text-[#444]">
                                {{ ucfirst($t->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-5 text-[14px] text-[#666]">
                            {{ $t->created_at->format('d M Y, H:i') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-[14px] text-[#666]">
                            Belum ada transaksi.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection