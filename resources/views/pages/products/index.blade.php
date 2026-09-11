<x-layouts.app>
    @section('title', 'Produk – JKB Kokoh Berkualitas')
    @section('meta_description', 'Daftar produk CV Jati Kencana Beton: beton ready mix, beton pracetak/precast, dan material batu split untuk berbagai kebutuhan proyek konstruksi.')

    <x-page-hero
        title="Produk Kami"
        eyebrow="Produk"
        description="{{ 'Jelajahi ' . $productCount . ' produk beton dan material konstruksi JKB yang siap mendukung proyek Anda — dari ready mix tronton hingga precast presisi.' }}"
    />

    <section class="relative overflow-hidden bg-jkb-gray-light py-16">
        <div class="jkb-glow -left-28 top-16 h-96 w-96 bg-jkb-yellow/20"></div>
        <div class="jkb-glow -right-28 bottom-0 h-80 w-80 bg-white/50"></div>
        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @if ($categories->isEmpty())
                <p class="py-20 text-center text-sm text-jkb-gray">
                    Kami sedang memperbarui daftar produk. Silakan kunjungi kembali nanti atau hubungi kami melalui halaman kontak.
                </p>
            @else
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($categories as $i => $category)
                        <article class="group jkb-reveal flex flex-col overflow-hidden rounded-2xl glass ring-1 ring-white/60 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_18px_44px_rgba(15,23,42,0.15)]">
                            @if ($category->image)
                                <div class="relative h-52 overflow-hidden">
                                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105" loading="lazy">
                                    <span class="absolute left-4 top-4 rounded-full bg-jkb-yellow px-3 py-1 text-xs font-bold text-jkb-navy">{{ $category->active_products_count }} Produk</span>
                                </div>
                            @else
                                <div class="relative grid h-52 place-items-center bg-jkb-navy text-jkb-yellow">
                                    <x-dynamic-component :component="'heroicon-m-' . ($category->icon ?: 'cube')" class="h-16 w-16 opacity-80" />
                                    <span class="absolute left-4 top-4 rounded-full bg-jkb-yellow px-3 py-1 text-xs font-bold text-jkb-navy">{{ $category->active_products_count }} Produk</span>
                                </div>
                            @endif
                            <div class="flex flex-1 flex-col p-6">
                                <h2 class="text-xl font-black text-jkb-gray-dark">
                                    <a href="{{ route('products.category', $category) }}" class="hover:text-jkb-yellow-dark">
                                        {{ $category->name }}
                                    </a>
                                </h2>
                                <p class="mt-2 flex-1 text-sm leading-relaxed text-jkb-gray">
                                    {{ $category->short_description ?: $category->description }}
                                </p>
                                <a href="{{ route('products.category', $category) }}" class="mt-5 inline-flex items-center gap-1.5 text-sm font-bold text-jkb-yellow-dark hover:text-jkb-gray-dark">
                                    Lihat Produk
                                    <x-heroicon-m-arrow-right class="h-4 w-4" />
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <section class="border-t border-jkb-gray-light bg-jkb-yellow">
        <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-6 px-4 py-12 sm:px-6 lg:flex-row lg:px-8">
            <div class="text-center lg:text-left">
                <h2 class="text-2xl font-black text-jkb-navy">Butuh penawaran khusus untuk proyek Anda?</h2>
                <p class="mt-1 text-sm font-medium text-jkb-gray-dark">Tim kami siap menyusun rencana pasokan beton sesuai spesifikasi dan jadwal proyek.</p>
            </div>
            <div class="flex flex-wrap justify-center gap-3">
                <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 rounded-full bg-jkb-navy px-6 py-3 text-sm font-bold text-white transition-colors hover:bg-jkb-gray-dark">
                    <x-heroicon-m-chat-bubble-left-right class="h-5 w-5" />
                    Hubungi Kami
                </a>
                <a href="{{ jkb_whatsapp_link('Halo JKB, saya ingin bertanya tentang produk beton.') }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 rounded-full bg-white px-6 py-3 text-sm font-bold text-jkb-gray-dark transition-colors hover:bg-jkb-gray-light">
                    <x-heroicon-m-phone class="h-5 w-5" />
                    WhatsApp
                </a>
            </div>
        </div>
    </section>
</x-layouts.app>