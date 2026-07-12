@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')
<h1 class="mb-6 text-2xl font-bold">Tambah Kategori</h1>

@if($errors->any())
    <div class="mb-4 rounded bg-red-100 px-4 py-3 text-red-700">
        <ul>
            @foreach($errors->all() as $error)
                <li>- {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-4 rounded-lg border bg-white p-6">
    @csrf
    <div>
        <label class="mb-2 block">Nama Kategori</label>
        <input type="text" name="name" value="{{ old('name') }}" class="w-full rounded border px-3 py-2" required>
    </div>

    <div class="flex gap-3">
        <button type="submit" class="rounded bg-black px-4 py-2 text-white">Simpan</button>
        <a href="{{ route('admin.categories.index') }}" class="rounded border px-4 py-2">Kembali</a>
    </div>
</form>
@endsection