@extends('layouts.app')

@section('title', 'Keranjang')

@section('content')
    <div class="mb-10">
        <h1 class="text-[32px] font-semibold tracking-[-0.04em] text-[#111111]">Keranjang</h1>
        <p class="mt-2 text-[15px] text-[#666]">Periksa jumlah produk sebelum melanjutkan checkout.</p>
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

    @if(empty($cart))
        <div class="rounded-2xl border border-dashed border-black/10 bg-white px-6 py-16 text-center">
            <p class="text-[15px] text-[#666]">Keranjang masih kosong.</p>
            <a href="{{ route('user.products') }}"
               class="mt-6 inline-flex h-11 items-center rounded-xl bg-[#111111] px-5 text-[14px] font-medium text-white transition hover:bg-black">
                Kembali belanja
            </a>
        </div>
    @else
        @php $total = 0; @endphp

        <div class="overflow-hidden rounded-2xl border border-black/8 bg-white shadow-[0_1px_2px_rgba(0,0,0,0.04)]">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[920px]">
                    <thead class="border-b border-black/5 bg-[#fcfcfc]">
                        <tr class="text-left">
                            <th class="px-6 py-4 text-[12px] font-medium uppercase tracking-[0.08em] text-[#888]">Produk</th>
                            <th class="px-6 py-4 text-[12px] font-medium uppercase tracking-[0.08em] text-[#888]">Kategori</th>
                            <th class="px-6 py-4 text-[12px] font-medium uppercase tracking-[0.08em] text-[#888]">Harga</th>
                            <th class="px-6 py-4 text-[12px] font-medium uppercase tracking-[0.08em] text-[#888]">Jumlah</th>
                            <th class="px-6 py-4 text-[12px] font-medium uppercase tracking-[0.08em] text-[#888]">Stok</th>
                            <th class="px-6 py-4 text-[12px] font-medium uppercase tracking-[0.08em] text-[#888]">Subtotal</th>
                            <th class="px-6 py-4 text-[12px] font-medium uppercase tracking-[0.08em] text-[#888]">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart as $id => $item)
                            @php $total += $item['subtotal']; @endphp
                            <tr class="border-t border-black/5">
                                <td class="px-6 py-5 text-[14px] font-medium text-[#111]">{{ $item['name'] }}</td>
                                <td class="px-6 py-5 text-[14px] text-[#666]">{{ $item['category'] }}</td>
                                <td class="px-6 py-5 text-[14px] text-[#111]">Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                                <td class="px-6 py-5">
                                    <form action="{{ route('user.cart.update', $id) }}" method="POST" class="flex items-center gap-2">
                                        @csrf
                                        @method('PUT')
                                        <input type="number"
                                               name="quantity"
                                               min="1"
                                               max="{{ $item['stock'] }}"
                                               value="{{ $item['quantity'] }}"
                                               class="h-10 w-20 rounded-xl border border-black/10 bg-white px-3 text-[14px] text-[#111] outline-none transition focus:border-[#111] focus:ring-4 focus:ring-black/5">
                                        <button type="submit"
                                                class="inline-flex h-10 items-center rounded-xl border border-black/10 bg-white px-4 text-[14px] font-medium text-[#111] transition hover:bg-[#f6f6f6]">
                                            Update
                                        </button>
                                    </form>
                                </td>
                                <td class="px-6 py-5 text-[14px] text-[#666]">{{ $item['stock'] }}</td>
                                <td class="px-6 py-5 text-[14px] font-medium text-[#111]">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</td>
                                <td class="px-6 py-5">
                                    <form action="{{ route('user.cart.remove', $id) }}" method="POST"
                                          onsubmit="return confirm('Hapus produk ini dari keranjang?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-[14px] font-medium text-[#666] transition hover:text-[#111]">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6 flex flex-col gap-4 rounded-2xl border border-black/8 bg-white p-6 shadow-[0_1px_2px_rgba(0,0,0,0.04)] md:flex-row md:items-end md:justify-between">
            <div>
                <p class="text-[14px] text-[#666]">Total belanja</p>
                <p class="mt-1 text-[32px] font-semibold tracking-[-0.04em] text-[#111]">
                    Rp {{ number_format($total, 0, ',', '.') }}
                </p>
            </div>

            <div class="flex flex-col gap-3 sm:flex-row">
                <form action="{{ route('user.cart.clear') }}" method="POST"
                      onsubmit="return confirm('Kosongkan seluruh keranjang?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="inline-flex h-11 items-center justify-center rounded-xl border border-black/10 bg-white px-5 text-[14px] font-medium text-[#111] transition hover:bg-[#f6f6f6]">
                        Kosongkan keranjang
                    </button>
                </form>

                <form action="{{ route('user.checkout') }}" method="POST"
                      onsubmit="return confirm('Lanjut checkout?')">
                    @csrf
                    <button type="submit"
                            class="inline-flex h-11 items-center justify-center rounded-xl bg-[#111111] px-5 text-[14px] font-medium text-white transition hover:bg-black">
                        Checkout
                    </button>
                </form>
            </div>
        </div>
    @endif
@endsection