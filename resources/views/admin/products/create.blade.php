@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
<div class="mb-10">
    <h1 class="text-[32px] font-semibold tracking-[-0.04em] text-[#111111]">Tambah produk</h1>
    <p class="mt-2 text-[15px] text-[#666]">Tambahkan produk baru ke dalam katalog toko.</p>
</div>

<div class="max-w-2xl">
    @if($errors->any())
        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-[14px] text-red-700">
            <ul class="space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="rounded-2xl border border-black/8 bg-white p-6 shadow-[0_1px_2px_rgba(0,0,0,0.04)] sm:p-8">
        <form action="{{ route('admin.products.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="mb-2 block text-[14px] font-medium text-[#222]">Nama produk</label>
                <input type="text"
                       name="name"
                       value="{{ old('name') }}"
                       required
                       placeholder="Contoh: Keripik Singkong"
                       class="h-11 w-full rounded-xl border border-black/10 bg-white px-3.5 text-[14px] text-[#111] placeholder:text-[#999] outline-none transition focus:border-[#111] focus:ring-4 focus:ring-black/5">
            </div>

            <div>
                <label class="mb-2 block text-[14px] font-medium text-[#222]">Kategori</label>
                <select name="category_id"
                        required
                        class="h-11 w-full rounded-xl border border-black/10 bg-white px-3.5 text-[14px] text-[#111] outline-none transition focus:border-[#111] focus:ring-4 focus:ring-black/5">
                    <option value="">Pilih kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <div>
                    <label class="mb-2 block text-[14px] font-medium text-[#222]">Harga</label>
                    <input type="number"
                           name="price"
                           value="{{ old('price') }}"
                           min="0"
                           required
                           placeholder="10000"
                           class="h-11 w-full rounded-xl border border-black/10 bg-white px-3.5 text-[14px] text-[#111] placeholder:text-[#999] outline-none transition focus:border-[#111] focus:ring-4 focus:ring-black/5">
                </div>

                <div>
                    <label class="mb-2 block text-[14px] font-medium text-[#222]">Stok</label>
                    <input type="number"
                           name="stock"
                           value="{{ old('stock') }}"
                           min="0"
                           required
                           placeholder="50"
                           class="h-11 w-full rounded-xl border border-black/10 bg-white px-3.5 text-[14px] text-[#111] placeholder:text-[#999] outline-none transition focus:border-[#111] focus:ring-4 focus:ring-black/5">
                </div>
            </div>

            <div class="flex flex-col gap-3 pt-2 sm:flex-row">
                <button type="submit"
                        class="inline-flex h-11 items-center justify-center rounded-xl bg-[#111111] px-5 text-[14px] font-medium text-white transition hover:bg-black">
                    Simpan produk
                </button>

                <a href="{{ route('admin.products.index') }}"
                   class="inline-flex h-11 items-center justify-center rounded-xl border border-black/10 bg-white px-5 text-[14px] font-medium text-[#111] transition hover:bg-[#f6f6f6]">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection