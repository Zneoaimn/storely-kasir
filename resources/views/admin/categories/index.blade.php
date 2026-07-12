@extends('layouts.app')

@section('title', 'Kategori')

@section('content')
<div class="mb-8 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-bold">Kategori</h1>
        <p class="text-sm text-gray-500">Kelola kategori produk.</p>
    </div>
    <a href="{{ route('admin.categories.create') }}" class="rounded bg-black px-4 py-2 text-white">
        Tambah Kategori
    </a>
</div>

@if(session('success'))
    <div class="mb-4 rounded bg-green-100 px-4 py-3 text-green-700">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="mb-4 rounded bg-red-100 px-4 py-3 text-red-700">
        {{ session('error') }}
    </div>
@endif

<div class="overflow-hidden rounded-lg border bg-white">
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-3 text-left">No</th>
                <th class="px-4 py-3 text-left">Nama Kategori</th>
                <th class="px-4 py-3 text-left">Jumlah Produk</th>
                <th class="px-4 py-3 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr class="border-t">
                    <td class="px-4 py-3">{{ $loop->iteration }}</td>
                    <td class="px-4 py-3">{{ $category->name }}</td>
                    <td class="px-4 py-3">{{ $category->products_count }}</td>
                    <td class="px-4 py-3">
                        <div class="flex items-center gap-4">
                            <a href="{{ route('admin.categories.edit', $category) }}"
                               class="font-medium text-black hover:text-gray-700">
                                Edit
                            </a>

                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Yakin hapus kategori ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="font-medium text-black hover:text-gray-700">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-4 py-6 text-center text-gray-500">Belum ada kategori.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $categories->links() }}
</div>
@endsection