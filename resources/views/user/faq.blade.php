@extends('layouts.app')

@section('title', 'FAQ')

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">FAQ / Panduan Penggunaan</h1>
    <div class="space-y-4">
        <div class="rounded-lg border bg-white p-5">
            <h2 class="font-semibold">1. Bagaimana cara login?</h2>
            <p class="mt-2 text-sm text-gray-700">Masukkan email dan password yang sudah terdaftar, lalu tekan tombol login.</p>
        </div>

        <div class="rounded-lg border bg-white p-5">
            <h2 class="font-semibold">2. Bagaimana cara melihat produk?</h2>
            <p class="mt-2 text-sm text-gray-700">Buka halaman Produk untuk melihat daftar barang yang tersedia.</p>
        </div>

        <div class="rounded-lg border bg-white p-5">
            <h2 class="font-semibold">3. Bagaimana cara menambah produk ke keranjang?</h2>
            <p class="mt-2 text-sm text-gray-700">Pilih jumlah produk lalu klik tombol Tambah ke keranjang.</p>
        </div>

        <div class="rounded-lg border bg-white p-5">
            <h2 class="font-semibold">4. Bagaimana cara checkout?</h2>
            <p class="mt-2 text-sm text-gray-700">Masuk ke halaman Keranjang lalu tekan tombol checkout untuk menyimpan transaksi.</p>
        </div>

        <div class="rounded-lg border bg-white p-5">
            <h2 class="font-semibold">5. Bagaimana cara melihat riwayat transaksi?</h2>
            <p class="mt-2 text-sm text-gray-700">Buka menu Riwayat untuk melihat transaksi yang sudah dilakukan.</p>
        </div>
    </div>
</div>
@endsection