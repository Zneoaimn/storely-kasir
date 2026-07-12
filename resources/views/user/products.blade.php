@extends('layouts.app')

@section('title', 'Produk')

@section('content')
    <div class="mb-10">
        <h1 class="text-[32px] font-semibold tracking-[-0.04em] text-[#111111]">Produk</h1>
        <p class="mt-2 text-[15px] text-[#666]">Pilih produk, tentukan jumlah, lalu tambahkan ke keranjang.</p>
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

    @if($errors->any())
        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-[14px] text-red-700">
            <ul class="space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="GET" action="{{ route('user.products') }}" class="mb-8">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div class="flex flex-wrap gap-2">
                <label class="cursor-pointer">
                    <input type="radio" name="category" value="" class="hidden"
                           onchange="this.form.submit()"
                           {{ request('category') ? '' : 'checked' }}>
                    <span class="inline-flex h-10 items-center rounded-full border px-4 text-[14px] font-medium transition
                        {{ request('category') ? 'border-black/10 bg-white text-[#555]' : 'border-[#111111] bg-[#111111] text-white' }}">
                        Semua
                    </span>
                </label>

                @foreach($categories as $category)
                    <label class="cursor-pointer">
                        <input type="radio" name="category" value="{{ $category->id }}" class="hidden"
                               onchange="this.form.submit()"
                               {{ request('category') == $category->id ? 'checked' : '' }}>
                        <span class="inline-flex h-10 items-center rounded-full border px-4 text-[14px] font-medium transition
                            {{ request('category') == $category->id ? 'border-[#111111] bg-[#111111] text-white' : 'border-black/10 bg-white text-[#555]' }}">
                            {{ $category->name }}
                        </span>
                    </label>
                @endforeach
            </div>

            <div>
                <a href="{{ route('user.products') }}"
                   class="inline-flex h-10 items-center rounded-xl border border-black/10 bg-white px-4 text-[14px] font-medium text-[#444] transition hover:bg-[#f6f6f6]">
                    Reset
                </a>
            </div>
        </div>
    </form>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">
        @forelse($products as $product)
            <div class="rounded-2xl border border-black/8 bg-white p-5 shadow-[0_1px_2px_rgba(0,0,0,0.04)]">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <div class="text-[13px] text-[#777]">{{ $product->category->name ?? 'Tanpa Kategori' }}</div>
                        <h3 class="mt-1 text-[18px] font-medium tracking-[-0.02em] text-[#111111]">
                            {{ $product->name }}
                        </h3>
                    </div>

                    <div class="text-right">
                        <div class="text-[12px] text-[#888]">Stok</div>
                        <div class="mt-1 text-[14px] font-medium text-[#111]">{{ $product->stock }}</div>
                    </div>
                </div>

                <div class="mt-6 text-[28px] font-semibold tracking-[-0.04em] text-[#111111]">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </div>

                <form action="{{ route('user.cart.add', $product->id) }}" method="POST" class="mt-6 space-y-4">
                    @csrf

                    <div>
                        <label class="mb-2 block text-[13px] font-medium text-[#666]">Jumlah</label>
                        <input
                            type="number"
                            name="quantity"
                            min="1"
                            max="{{ $product->stock }}"
                            value="{{ old('product_id') == $product->id ? old('quantity', 1) : 1 }}"
                            class="h-11 w-full rounded-xl border border-black/10 bg-white px-3.5 text-[14px] text-[#111] outline-none transition focus:border-[#111] focus:ring-4 focus:ring-black/5"
                        >
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <p class="mt-2 text-[12px] text-[#888]">Masukkan minimal 1 dan maksimal {{ $product->stock }}.</p>
                    </div>

                    <button type="submit"
                            class="inline-flex h-11 w-full items-center justify-center rounded-xl bg-[#111111] text-[14px] font-medium text-white transition hover:bg-black">
                        Tambah ke keranjang
                    </button>
                </form>
            </div>
        @empty
            <div class="col-span-full rounded-2xl border border-dashed border-black/10 bg-white px-6 py-16 text-center text-[14px] text-[#666]">
                Belum ada produk tersedia.
            </div>
        @endforelse
    </div>

    @if($products->count())
        <div class="mt-10 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <p class="text-[14px] text-[#666]">
                Menampilkan {{ $products->firstItem() }} sampai {{ $products->lastItem() }} dari {{ $products->total() }} produk
            </p>

            <div>
                {{ $products->links() }}
            </div>
        </div>
    @endif
@endsection