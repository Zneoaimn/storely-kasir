@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="flex min-h-[calc(100vh-120px)] items-center justify-center py-8">
    <div class="w-full max-w-md">
        <div class="mb-8 text-center">
            <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-xl bg-[#111111] text-sm font-semibold text-white">
                P
            </div>
            <h1 class="mt-5 text-[32px] font-semibold tracking-[-0.04em] text-[#111111]">Masuk ke Storely</h1>
            <p class="mt-2 text-[15px] text-[#666]">Gunakan akun yang sudah terdaftar untuk melanjutkan.</p>
        </div>

        <div class="rounded-2xl border border-black/8 bg-white p-6 shadow-[0_1px_2px_rgba(0,0,0,0.04)] sm:p-8">
            @if(session('status'))
                <div class="mb-5 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-[14px] text-emerald-700">
                    {{ session('status') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-[14px] text-red-700">
                    <ul class="space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

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
                        placeholder="Masukkan password"
                        class="h-11 w-full rounded-xl border border-black/10 bg-white px-3.5 text-[14px] text-[#111] placeholder:text-[#999] outline-none transition focus:border-[#111] focus:ring-4 focus:ring-black/5"
                    >
                </div>

                <div class="flex items-center justify-between">
                    <label class="inline-flex items-center gap-2 text-[14px] text-[#666]">
                        <input type="checkbox" name="remember" class="h-4 w-4 rounded border-black/15 text-black focus:ring-black/10">
                        <span>Ingat saya</span>
                    </label>

                    @if(Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                           class="text-[14px] font-medium text-[#444] transition hover:text-[#111]">
                            Lupa password?
                        </a>
                    @endif
                </div>

                <button
                    type="submit"
                    class="inline-flex h-11 w-full items-center justify-center rounded-xl bg-[#111111] text-[14px] font-medium text-white transition hover:bg-black"
                >
                    Masuk
                </button>
            </form>

            <div class="mt-6 text-center text-[14px] text-[#666]">
                Belum punya akun?
                <a href="{{ route('register') }}" class="font-medium text-[#111] hover:underline">
                    Register
                </a>
            </div>
        </div>
    </div>
</div>
@endsection