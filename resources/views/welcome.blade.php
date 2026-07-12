<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Storely - Point of Sale</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#fafafa] text-[#171717] antialiased">
    <nav class="border-b border-black/5 bg-white">
        <div class="mx-auto flex h-16 w-full max-w-7xl items-center justify-between px-6">
            <div class="flex items-center gap-3">
                <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-[#111111] text-sm font-semibold text-white">
                    P
                </div>
                <div class="text-[22px] font-semibold tracking-[-0.03em] text-[#111111]">
                    Storely
                </div>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('login') }}"
                   class="inline-flex h-10 items-center rounded-xl px-4 text-[14px] font-medium text-[#666] transition hover:text-[#111]">
                    Login
                </a>

                <a href="{{ route('register') }}"
                   class="inline-flex h-10 items-center rounded-xl bg-[#111111] px-4 text-[14px] font-medium text-white transition hover:bg-black">
                    Register
                </a>
            </div>
        </div>
    </nav>

    <main>
        <section class="mx-auto grid w-full max-w-7xl grid-cols-1 gap-16 px-6 py-20 lg:grid-cols-2 lg:items-center lg:py-28">
            <div class="max-w-2xl">
                <div class="mb-6 inline-flex items-center rounded-full border border-black/8 bg-white px-3 py-1.5 text-[12px] font-medium text-[#555]">
                    Laravel 13 Point of Sale
                </div>

                <h1 class="max-w-xl text-[44px] font-semibold leading-[1.02] tracking-[-0.05em] text-[#111111] sm:text-[56px]">
                    Kelola toko dengan antarmuka yang sederhana dan efisien.
                </h1>

                <p class="mt-6 max-w-xl text-[17px] leading-7 text-[#5f5f5f]">
                    Sistem POS untuk mengelola produk, kategori, keranjang, checkout, dan riwayat transaksi tanpa alur yang rumit.
                </p>

                <div class="mt-10 flex flex-col gap-3 sm:flex-row">
                    <a href="{{ route('register') }}"
                       class="inline-flex h-11 items-center justify-center rounded-xl bg-[#111111] px-5 text-[14px] font-medium text-white transition hover:bg-black">
                        Mulai sekarang
                    </a>

                    <a href="{{ route('login') }}"
                       class="inline-flex h-11 items-center justify-center rounded-xl border border-black/10 bg-white px-5 text-[14px] font-medium text-[#111111] transition hover:bg-[#f6f6f6]">
                        Masuk
                    </a>
                </div>

                <div class="mt-12 grid grid-cols-1 gap-6 sm:grid-cols-3">
                    <div>
                        <div class="text-[24px] font-semibold tracking-[-0.03em] text-[#111]">2</div>
                        <div class="mt-1 text-[14px] text-[#666]">Role pengguna</div>
                    </div>
                    <div>
                        <div class="text-[24px] font-semibold tracking-[-0.03em] text-[#111]">Real-time</div>
                        <div class="mt-1 text-[14px] text-[#666]">Transaksi & stok</div>
                    </div>
                    <div>
                        <div class="text-[24px] font-semibold tracking-[-0.03em] text-[#111]">Simple</div>
                        <div class="mt-1 text-[14px] text-[#666]">Untuk kasir & admin</div>
                    </div>
                </div>
            </div>

            <div class="lg:pl-10">
                <div class="rounded-2xl border border-black/8 bg-white p-5 shadow-[0_1px_2px_rgba(0,0,0,0.04)]">
                    <div class="flex items-center justify-between border-b border-black/5 pb-4">
                        <div>
                            <p class="text-[13px] font-medium text-[#666]">Preview dashboard</p>
                            <h2 class="mt-1 text-[18px] font-semibold tracking-[-0.02em] text-[#111]">Daftar produk</h2>
                        </div>
                        <div class="rounded-full border border-black/8 bg-[#fafafa] px-2.5 py-1 text-[12px] font-medium text-[#666]">
                            Live
                        </div>
                    </div>

                    <div class="mt-4 space-y-3">
                        <div class="rounded-xl border border-black/6 bg-[#fcfcfc] p-4">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <div class="text-[13px] text-[#777]">Snack</div>
                                    <div class="mt-1 text-[16px] font-medium text-[#111]">Vitae in</div>
                                </div>
                                <div class="text-right">
                                    <div class="text-[13px] text-[#777]">Stok</div>
                                    <div class="mt-1 text-[14px] font-medium text-[#111]">98</div>
                                </div>
                            </div>
                            <div class="mt-4 text-[22px] font-semibold tracking-[-0.03em] text-[#111]">Rp 30.057</div>
                        </div>

                        <div class="rounded-xl border border-black/6 bg-[#fcfcfc] p-4">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <div class="text-[13px] text-[#777]">Minuman</div>
                                    <div class="mt-1 text-[16px] font-medium text-[#111]">Voluptate nemo</div>
                                </div>
                                <div class="text-right">
                                    <div class="text-[13px] text-[#777]">Stok</div>
                                    <div class="mt-1 text-[14px] font-medium text-[#111]">67</div>
                                </div>
                            </div>
                            <div class="mt-4 text-[22px] font-semibold tracking-[-0.03em] text-[#111]">Rp 91.564</div>
                        </div>

                        <div class="rounded-xl border border-dashed border-black/8 bg-[#fafafa] p-4 text-[13px] text-[#666]">
                            Tampilan dibuat fokus pada keterbacaan, ritme spacing, dan alur kerja kasir.
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="border-t border-black/5 bg-white">
            <div class="mx-auto w-full max-w-7xl px-6 py-20">
                <div class="max-w-2xl">
                    <h2 class="text-[32px] font-semibold tracking-[-0.04em] text-[#111]">
                        Fitur inti yang benar-benar dipakai.
                    </h2>
                    <p class="mt-3 text-[16px] leading-7 text-[#666]">
                        Tidak ada elemen dekoratif yang berlebihan. Hanya struktur yang mendukung tugas admin dan kasir.
                    </p>
                </div>

                <div class="mt-12 grid grid-cols-1 gap-4 md:grid-cols-3">
                    <div class="rounded-2xl border border-black/8 bg-[#fcfcfc] p-6">
                        <h3 class="text-[16px] font-medium text-[#111]">Manajemen produk</h3>
                        <p class="mt-2 text-[14px] leading-6 text-[#666]">
                            Tambah, edit, dan kelola stok serta kategori dari satu tempat.
                        </p>
                    </div>

                    <div class="rounded-2xl border border-black/8 bg-[#fcfcfc] p-6">
                        <h3 class="text-[16px] font-medium text-[#111]">Checkout sederhana</h3>
                        <p class="mt-2 text-[14px] leading-6 text-[#666]">
                            Alur pembelian yang cepat dengan validasi stok tetap terjaga.
                        </p>
                    </div>

                    <div class="rounded-2xl border border-black/8 bg-[#fcfcfc] p-6">
                        <h3 class="text-[16px] font-medium text-[#111]">Riwayat transaksi</h3>
                        <p class="mt-2 text-[14px] leading-6 text-[#666]">
                            Semua transaksi tercatat rapi dan mudah ditinjau kembali.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="border-t border-black/5 bg-[#fafafa]">
        <div class="mx-auto flex w-full max-w-7xl items-center justify-between px-6 py-6 text-[13px] text-[#777]">
            <span>© 2026 POS.Store</span>
            <span>Dibuat untuk UAS Pemrograman Web Lanjut</span>
        </div>
    </footer>
</body>
</html>