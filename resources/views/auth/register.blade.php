@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="flex min-h-[calc(100vh-120px)] items-center justify-center py-8">
    <div class="w-full max-w-md">
        <div class="mb-8 text-center">
            <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-xl bg-[#111111] text-sm font-semibold text-white">
                P
            </div>
            <h1 class="mt-5 text-[32px] font-semibold tracking-[-0.04em] text-[#111111]">Buat akun baru</h1>
            <p class="mt-2 text-[15px] text-[#666]">Daftar untuk mulai menggunakan sistem Storely.</p>
        </div>

        <div class="rounded-2xl border border-black/8 bg-white p-6 shadow-[0_1px_2px_rgba(0,0,0,0.04)] sm:p-8">
            @if($errors->any())
                <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-[14px] text-red-700">
                    <ul class="space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="mb-2 block text-[14px] font-medium text-[#222]">Nama lengkap</label>
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        placeholder="Nama pengguna"
                        class="h-11 w-full rounded-xl border border-black/10 bg-white px-3.5 text-[14px] text-[#111] placeholder:text-[#999] outline-none transition focus:border-[#111] focus:ring-4 focus:ring-black/5"
                    >
                </div>

                <div>
                    <label class="mb-2 block text-[14px] font-medium text-[#222]">Email</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        placeholder="nama@email.com"
                        class="h-11 w-full rounded-xl border border-black/10 bg-white px-3.5 text-[14px] text-[#111] placeholder:text-[#999] outline-none transition focus:border-[#111] focus:ring-4 focus:ring-black/5"
                    >
                </div>

                <div>
                    <label class="mb-2 block text-[14px] font-medium text-[#222]">Password</label>
                    <input
                        type="password"
                        name="password"
                        required
                        placeholder="Minimal 8 karakter"
                        class="h-11 w-full rounded-xl border border-black/10 bg-white px-3.5 text-[14px] text-[#111] placeholder:text-[#999] outline-none transition focus:border-[#111] focus:ring-4 focus:ring-black/5"
                    >
                </div>

                <div>
                    <label class="mb-2 block text-[14px] font-medium text-[#222]">Konfirmasi password</label>
                    <input
                        type="password"
                        name="password_confirmation"
                        required
                        placeholder="Ulangi password"
                        class="h-11 w-full rounded-xl border border-black/10 bg-white px-3.5 text-[14px] text-[#111] placeholder:text-[#999] outline-none transition focus:border-[#111] focus:ring-4 focus:ring-black/5"
                    >
                </div>

                <button
                    type="submit"
                    class="inline-flex h-11 w-full items-center justify-center rounded-xl bg-[#111111] text-[14px] font-medium text-white transition hover:bg-black"
                >
                    Daftar
                </button>
            </form>

            <div class="mt-6 text-center text-[14px] text-[#666]">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="font-medium text-[#111] hover:underline">
                    Login
                </a>
            </div>
        </div>
    </div>
</div>
@endsection