@php
    $menu = [
        ['label' => 'Beranda', 'route' => route('home'), 'active' => request()->routeIs('home')],
        ['label' => 'Tentang Kami', 'route' => route('about'), 'active' => request()->routeIs('about')],
        ['label' => 'Proyek', 'route' => route('projects.index'), 'active' => request()->routeIs('projects.*')],
        ['label' => 'Berita', 'route' => route('news.index'), 'active' => request()->routeIs('news.*')],
        ['label' => 'Karir', 'route' => route('careers.index'), 'active' => request()->routeIs('careers.*')],
        ['label' => 'Tahukah Anda?', 'route' => route('tahukah-anda.index'), 'active' => request()->routeIs('tahukah-anda.*')],
        ['label' => 'Kontak', 'route' => route('contact'), 'active' => request()->routeIs('contact')],
    ];
@endphp

<header x-data="{ mobileOpen: false, productOpen: false, routeIsProduct: {{ request()->routeIs('products.*') ? 'true' : 'false' }}, scrolled: false }"
    @scroll.window="scrolled = window.scrollY > 8"
    x-init="scrolled = window.scrollY > 8 || {{ request()->routeIs('home') ? 'false' : 'true' }}"
    :class="scrolled ? 'bg-white/80 shadow-[0_10px_40px_rgba(0,0,0,0.10)]' : 'bg-white/70 shadow-none'"
    class="sticky top-0 z-40 border-b border-white/60 backdrop-blur-2xl transition-[background-color,box-shadow] duration-300">
    <nav class="mx-auto flex h-28 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8" aria-label="Navigasi utama">
        <a href="{{ route('home') }}" class="shrink-0" aria-label="JKB Beranda">
            <x-logo class="h-24 w-auto" />
        </a>

        <div class="hidden items-center gap-1 lg:flex">
            @foreach ($menu as $item)
                <a href="{{ $item['route'] }}" @class([
                    'relative px-3 py-2 text-sm font-semibold transition-colors after:absolute after:-bottom-0.5 after:left-1/2 after:h-0.5 after:w-0 after:-translate-x-1/2 after:rounded-full after:bg-jkb-yellow-dark after:transition-all after:duration-300 hover:after:w-full',
                    'text-jkb-gray-dark after:w-full' => $item['active'],
                    'text-jkb-gray-dark hover:text-jkb-gray-dark hover:after:w-full' => ! $item['active'],
                ])>
                    {{ $item['label'] }}
                </a>
            @endforeach

            <div class="relative">
                <button type="button" @click="productOpen = !productOpen" x-bind:class="[
                    routeIsProduct ? 'text-jkb-gray-dark after:w-full' : 'text-jkb-gray-dark hover:after:w-full'
                ]" @class([
                    'relative flex items-center gap-1 px-3 py-2 text-sm font-semibold transition-colors after:absolute after:-bottom-0.5 after:left-1/2 after:h-0.5 after:w-0 after:-translate-x-1/2 after:rounded-full after:bg-jkb-yellow-dark after:transition-all after:duration-300',
                ])>
                    Produk
                    <x-heroicon-m-chevron-down class="h-4 w-4 transition-transform" x-bind:class="productOpen && 'rotate-180'" />
                </button>

                <div x-show="productOpen" x-cloak @click.outside="productOpen = false"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 -translate-y-2 scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                    x-transition:leave-end="opacity-0 -translate-y-2 scale-95"
                    class="absolute left-0 top-full z-50 mt-2 w-64 rounded-xl glass-strong p-1.5 shadow-xl">
                    @forelse ($categories as $category)
                        <a href="{{ route('products.category', $category) }}"
                            class="block rounded-lg px-3 py-2 text-sm text-jkb-gray-dark transition-colors hover:bg-jkb-yellow/10">
                            {{ $category->name }}
                        </a>
                    @empty
                        <span class="block px-3 py-2 text-sm text-jkb-gray">Produk segera hadir.</span>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ jkb_whatsapp_link('Halo JKB, saya ingin konsultasi gratis.') }}" target="_blank" rel="noopener"
                class="btn-jkb-pill hidden items-center gap-2 px-5 py-2 text-sm sm:inline-flex">
                <x-heroicon-m-chat-bubble-left-right class="h-4 w-4" />
                Konsultasi Gratis
            </a>

            <button type="button" @click="mobileOpen = !mobileOpen"
                class="inline-flex h-10 w-10 items-center justify-center rounded-md text-jkb-gray-dark hover:bg-jkb-gray-light lg:hidden"
                aria-label="Buka menu">
                <svg x-show="!mobileOpen" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg x-show="mobileOpen" x-cloak class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </nav>

    <div x-show="mobileOpen" x-cloak x-transition class="glass-strong border-t border-white/60 lg:hidden">
        <div class="space-y-1 px-4 py-3">
            <a href="{{ route('home') }}" class="block rounded-md px-3 py-2 text-sm font-semibold text-jkb-gray-dark hover:bg-jkb-gray-light">Beranda</a>
            <a href="{{ route('about') }}" class="block rounded-md px-3 py-2 text-sm font-semibold text-jkb-gray-dark hover:bg-jkb-gray-light">Tentang Kami</a>

            <div class="flex items-center justify-between rounded-md px-3 py-2">
                <span class="text-sm font-semibold text-jkb-gray-dark">Produk</span>
                <button type="button" @click="productOpen = !productOpen" class="-mr-2 rounded-md p-1.5 text-jkb-gray-dark hover:bg-jkb-gray-light" aria-label="Buka sub-menu produk">
                    <x-heroicon-m-chevron-down class="h-5 w-5 transition-transform" x-bind:class="productOpen && 'rotate-180'" />
                </button>
            </div>
            <div x-show="productOpen" x-collapse class="space-y-1 pl-4">
                @forelse ($categories as $category)
                    <a href="{{ route('products.category', $category) }}" class="block rounded-md px-3 py-2 text-sm text-jkb-gray hover:bg-jkb-gray-light">
                        {{ $category->name }}
                    </a>
                @empty
                    <span class="block px-3 py-2 text-sm text-jkb-gray">Produk segera hadir.</span>
                @endforelse
            </div>

            <a href="{{ route('projects.index') }}" class="block rounded-md px-3 py-2 text-sm font-semibold text-jkb-gray-dark hover:bg-jkb-gray-light">Proyek</a>
            <a href="{{ route('news.index') }}" class="block rounded-md px-3 py-2 text-sm font-semibold text-jkb-gray-dark hover:bg-jkb-gray-light">Berita</a>
            <a href="{{ route('careers.index') }}" class="block rounded-md px-3 py-2 text-sm font-semibold text-jkb-gray-dark hover:bg-jkb-gray-light">Karir</a>
            <a href="{{ route('tahukah-anda.index') }}" class="block rounded-md px-3 py-2 text-sm font-semibold text-jkb-gray-dark hover:bg-jkb-gray-light">Tahukah Anda?</a>
            <a href="{{ route('contact') }}" class="block rounded-md px-3 py-2 text-sm font-semibold text-jkb-gray-dark hover:bg-jkb-gray-light">Kontak</a>

            <a href="{{ jkb_whatsapp_link('Halo JKB, saya ingin konsultasi gratis.') }}" target="_blank" rel="noopener"
                class="btn-jkb-pill mt-2 w-full items-center gap-2 px-4 py-2.5 text-sm">
                <x-heroicon-m-chat-bubble-left-right class="h-4 w-4" />
                Konsultasi Gratis
            </a>
        </div>
    </div>
</header>