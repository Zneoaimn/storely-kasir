@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
<div class="mb-10 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
    <div>
        <h1 class="text-[32px] font-semibold tracking-[-0.04em] text-[#111111]">Daftar produk</h1>
        <p class="mt-2 text-[15px] text-[#666]">Kelola semua produk yang tersedia di toko.</p>
    </div>

    <a href="{{ route('admin.products.create') }}"
       class="inline-flex h-11 items-center justify-center rounded-xl bg-[#111111] px-5 text-[14px] font-medium text-white transition hover:bg-black">
        Tambah produk
    </a>
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

<div class="mb-4 text-[14px] text-[#666]">
    Total {{ $products->total() }} produk
</div>

<div class="overflow-hidden rounded-2xl border border-black/8 bg-white shadow-[0_1px_2px_rgba(0,0,0,0.04)]">
    <div class="overflow-x-auto">
        <table class="w-full min-w-[820px]">
            <thead class="border-b border-black/5 bg-[#fcfcfc]">
                <tr class="text-left">
                    <th class="px-6 py-4 text-[12px] font-medium uppercase tracking-[0.08em] text-[#888]">No</th>
                    <th class="px-6 py-4 text-[12px] font-medium uppercase tracking-[0.08em] text-[#888]">Nama</th>
                    <th class="px-6 py-4 text-[12px] font-medium uppercase tracking-[0.08em] text-[#888]">Kategori</th>
                    <th class="px-6 py-4 text-[12px] font-medium uppercase tracking-[0.08em] text-[#888]">Harga</th>
                    <th class="px-6 py-4 text-[12px] font-medium uppercase tracking-[0.08em] text-[#888]">Stok</th>
                    <th class="px-6 py-4 text-[12px] font-medium uppercase tracking-[0.08em] text-[#888]">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr class="border-t border-black/5">
                        <td class="px-6 py-5 text-[14px] text-[#666]">
                            {{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}
                        </td>
                        <td class="px-6 py-5 text-[14px] font-medium text-[#111]">{{ $product->name }}</td>
                        <td class="px-6 py-5 text-[14px] text-[#666]">{{ $product->category->name ?? '-' }}</td>
                        <td class="px-6 py-5 text-[14px] font-medium text-[#111]">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td class="px-6 py-5 text-[14px] text-[#666]">{{ $product->stock }}</td>
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-4">
                                <a href="{{ route('admin.products.edit', $product->id) }}"
                                   class="text-[14px] font-medium text-[#444] transition hover:text-[#111]">
                                    Edit
                                </a>

                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-[14px] font-medium text-[#444] transition hover:text-[#111]">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-14 text-center text-[14px] text-[#666]">
                            Belum ada produk.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if($products->count())
    <div class="mt-6">
        {{ $products->links() }}
    </div>
@endif
@endsection