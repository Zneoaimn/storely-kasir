@extends('layouts.app')

@section('title', 'Riwayat')

@section('content')
    <div class="mb-10 flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
        <div>
            <h1 class="text-[32px] font-semibold tracking-[-0.04em] text-[#111111]">Riwayat transaksi</h1>
            <p class="mt-2 text-[15px] text-[#666]">Daftar transaksi yang sudah berhasil diproses.</p>
        </div>

        <form method="GET" action="{{ route('user.history') }}">
            <input type="date"
                   name="date"
                   value="{{ request('date') }}"
                   class="h-11 rounded-xl border border-black/10 bg-white px-3.5 text-[14px] text-[#111] outline-none transition focus:border-[#111] focus:ring-4 focus:ring-black/5">
        </form>
    </div>

    @if(session('success'))
        <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-[14px] text-emerald-700">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-[14px] text-red-700">
            {{ session('error') }}
        </div>
    @endif

    @forelse($transactions as $transaction)
        <div class="mb-5 overflow-hidden rounded-2xl border border-black/8 bg-white shadow-[0_1px_2px_rgba(0,0,0,0.04)]">
            <div class="flex flex-col gap-4 border-b border-black/5 px-6 py-5 md:flex-row md:items-start md:justify-between">
                <div>
                    <div class="flex items-center gap-3">
                        <h3 class="text-[22px] font-semibold tracking-[-0.03em] text-[#111]">Transaksi #{{ $transaction->id }}</h3>
                        <span class="inline-flex items-center rounded-full border border-emerald-200 bg-emerald-50 px-2.5 py-1 text-[12px] font-medium text-emerald-700">
                            {{ ucfirst($transaction->status) }}
                        </span>
                    </div>
                    <p class="mt-2 text-[14px] text-[#666]">
                        {{ $transaction->created_at->format('d M Y, H:i') }} WIB
                    </p>
                </div>

                <div class="md:text-right">
                    <p class="text-[13px] text-[#777]">Total tagihan</p>
                    <p class="mt-1 text-[28px] font-semibold tracking-[-0.04em] text-[#111]">
                        Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                    </p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full min-w-[680px]">
                    <thead class="border-b border-black/5 bg-[#fcfcfc]">
                        <tr class="text-left">
                            <th class="px-6 py-4 text-[12px] font-medium uppercase tracking-[0.08em] text-[#888]">Produk</th>
                            <th class="px-6 py-4 text-[12px] font-medium uppercase tracking-[0.08em] text-[#888]">Qty</th>
                            <th class="px-6 py-4 text-[12px] font-medium uppercase tracking-[0.08em] text-[#888]">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaction->details as $detail)
                            <tr class="border-t border-black/5">
                                <td class="px-6 py-5 text-[14px] font-medium text-[#111]">
                                    {{ $detail->product->name ?? 'Produk sudah dihapus' }}
                                </td>
                                <td class="px-6 py-5 text-[14px] text-[#666]">{{ $detail->quantity }}</td>
                                <td class="px-6 py-5 text-[14px] font-medium text-[#111]">
                                    Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-6 text-center text-[14px] text-[#666]">
                                    Detail transaksi tidak tersedia.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @empty
        <div class="rounded-2xl border border-dashed border-black/10 bg-white px-6 py-16 text-center text-[14px] text-[#666]">
            Belum ada transaksi.
        </div>
    @endforelse
@endsection