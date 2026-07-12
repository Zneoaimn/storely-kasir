<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} - @yield('title', 'Dashboard')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#fafafa] text-[#111]">
    @php
        $cart = session('cart', []);
        $cartCount = 0;

        foreach ($cart as $item) {
            if (is_array($item)) {
                $cartCount += $item['quantity'] ?? $item['qty'] ?? 1;
            } else {
                $cartCount += (int) $item;
            }
        }
    @endphp

    <nav class="border-b bg-white">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">
            <div class="flex items-center gap-8">
                <a href="{{ auth()->check() ? route('dashboard') : route('login') }}" class="flex items-center gap-3">
                    <div class="flex h-8 w-8 items-center justify-center rounded-xl bg-black text-sm font-semibold text-white">
                        P
                    </div>
                    <span class="text-[18px] font-semibold text-black">Storely</span>
                </a>

                @auth
                    @if(auth()->user()->role === 'admin')
                        <div class="flex items-center gap-8">
                            <a href="{{ route('admin.dashboard') }}" class="text-sm font-medium text-black hover:text-gray-700">
                                Dashboard
                            </a>
                            <a href="{{ route('admin.products.index') }}" class="text-sm font-medium text-black hover:text-gray-700">
                                Produk
                            </a>
                            <a href="{{ route('admin.categories.index') }}" class="text-sm font-medium text-black hover:text-gray-700">
                                Kategori
                            </a>
                        </div>
                    @endif

                    @if(auth()->user()->role === 'user')
                        <div class="flex items-center gap-8">
                            <a href="{{ route('user.products') }}" class="text-sm font-medium text-black hover:text-gray-700">
                                Produk
                            </a>

                            <a href="{{ route('user.cart') }}" class="relative text-sm font-medium text-black hover:text-gray-700">
                                Keranjang
                                @if($cartCount > 0)
                                    <span class="absolute -top-2 -right-4 inline-flex min-w-[20px] items-center justify-center rounded-full bg-black px-1.5 py-0.5 text-[10px] font-semibold text-white">
                                        {{ $cartCount }}
                                    </span>
                                @endif
                            </a>

                            <a href="{{ route('user.history') }}" class="text-sm font-medium text-black hover:text-gray-700">
                                Riwayat
                            </a>

                            <a href="{{ route('user.faq') }}" class="text-sm font-medium text-black hover:text-gray-700">
                                FAQ
                            </a>
                        </div>
                    @endif
                @endauth
            </div>

            <div class="flex items-center gap-4">
                @auth
                    <div class="flex h-8 w-8 items-center justify-center rounded-full border text-xs font-semibold text-gray-600">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                    <span class="text-sm text-gray-600">
                        Halo, <span class="font-semibold text-black">{{ auth()->user()->name }}</span>
                    </span>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm font-medium text-black hover:text-gray-700">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-black hover:text-gray-700">
                        Login
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="mx-auto max-w-7xl px-6 py-10">
        @yield('content')
    </main>
</body>
</html>