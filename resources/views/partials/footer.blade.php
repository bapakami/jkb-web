@php
    $phone = jkb_setting('phone', '024-00000000');
    $whatsapp = jkb_setting('whatsapp', '082000000000');
    $email = jkb_setting('email', 'info@jkb.co.id');
    $address = jkb_setting('address', 'Jl. Raya Semarang – Solo KM 12, Ungaran, Kab. Semarang, Jawa Tengah');
    $hours = jkb_setting('operational_hours', 'Senin – Sabtu, 08.00 – 17.00 WIB');
    $tagline = jkb_setting('tagline', 'Kokoh Berkualitas');
    $instagram = jkb_setting('social_instagram', '#');
    $facebook = jkb_setting('social_facebook', '#');
    $youtube = jkb_setting('social_youtube', '#');
    $categories = \App\Models\ProductCategory::query()->active()->get();
    $mainBranches = \App\Models\Branch::query()->where('type', '!=', 'plant')->take(2)->get();
@endphp

<footer class="bg-jkb-navy text-gray-300">
    <div class="mx-auto max-w-7xl px-4 pb-8 pt-14 sm:px-6 lg:px-8">
        <div class="grid gap-10 md:grid-cols-2 lg:grid-cols-4">
            <div>
                <h3 class="text-sm font-bold uppercase tracking-wider text-white">Lokasi</h3>
                <div class="mt-4">
                    <x-logo class="max-h-14 text-white" />
                </div>
                <p class="mt-4 flex items-start gap-2.5 text-sm leading-relaxed text-gray-400">
                    <x-heroicon-m-map-pin class="mt-0.5 h-4 w-4 shrink-0 text-jkb-yellow" />
                    <span>{{ $address }}</span>
                </p>
                <a href="{{ route('branches.index') }}"
                    class="mt-2 inline-flex items-center gap-1 text-xs font-semibold uppercase tracking-wider text-jkb-yellow transition-colors hover:text-white">
                    Lihat semua cabang
                    <x-heroicon-m-arrow-right class="h-3.5 w-3.5" />
                </a>
                <div class="mt-5 flex items-center gap-3">
                    <a href="{{ $instagram }}" target="_blank" rel="noopener" class="grid h-9 w-9 place-items-center rounded-full bg-white/10 transition hover:bg-jkb-yellow hover:text-jkb-navy" aria-label="Instagram">
                        <x-heroicon-m-camera class="h-4 w-4" />
                    </a>
                    <a href="{{ $facebook }}" target="_blank" rel="noopener" class="grid h-9 w-9 place-items-center rounded-full bg-white/10 transition hover:bg-jkb-yellow hover:text-jkb-navy" aria-label="Facebook">
                        <x-heroicon-m-user-group class="h-4 w-4" />
                    </a>
                    <a href="{{ $youtube }}" target="_blank" rel="noopener" class="grid h-9 w-9 place-items-center rounded-full bg-white/10 transition hover:bg-jkb-yellow hover:text-jkb-navy" aria-label="YouTube">
                        <x-heroicon-m-play class="h-4 w-4" />
                    </a>
                </div>
            </div>

            <div>
                <h3 class="text-sm font-bold uppercase tracking-wider text-white">Navigasi</h3>
                <ul class="mt-4 space-y-2.5 text-sm">
                    <li><a href="{{ route('about') }}" class="text-gray-400 transition-all hover:tracking-wide hover:text-jkb-yellow">Tentang Kami</a></li>
                    <li><a href="{{ route('projects.index') }}" class="text-gray-400 transition-all hover:tracking-wide hover:text-jkb-yellow">Proyek</a></li>
                    <li><a href="{{ route('news.index') }}" class="text-gray-400 transition-all hover:tracking-wide hover:text-jkb-yellow">Berita</a></li>
                    <li><a href="{{ route('careers.index') }}" class="text-gray-400 transition-all hover:tracking-wide hover:text-jkb-yellow">Karir</a></li>
                    <li><a href="{{ route('branches.index') }}" class="text-gray-400 transition-all hover:tracking-wide hover:text-jkb-yellow">Cabang</a></li>
                    <li><a href="{{ route('tahukah-anda.index') }}" class="text-gray-400 transition-all hover:tracking-wide hover:text-jkb-yellow">Tahukah Anda?</a></li>
                    <li><a href="{{ route('contact') }}" class="text-gray-400 transition-all hover:tracking-wide hover:text-jkb-yellow">Kontak</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-sm font-bold uppercase tracking-wider text-white">Produk</h3>
                <ul class="mt-4 space-y-2.5 text-sm">
                    @forelse ($categories as $category)
                        <li><a href="{{ route('products.category', $category) }}" class="text-gray-400 transition-all hover:tracking-wide hover:text-jkb-yellow">{{ $category->name }}</a></li>
                    @empty
                        <li class="text-gray-500">Produk segera hadir.</li>
                    @endforelse
                    <li><a href="{{ route('products.index') }}" class="font-semibold text-jkb-yellow transition-all hover:tracking-wide hover:text-white">Semua Produk</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-sm font-bold uppercase tracking-wider text-white">Kontak</h3>
                <ul class="mt-4 space-y-3 text-sm">
                    <li class="flex items-start gap-2.5">
                        <x-heroicon-m-phone class="mt-0.5 h-4 w-4 shrink-0 text-jkb-yellow" />
                        <a href="tel:{{ preg_replace('/[^0-9]/', '', $phone) }}" class="text-gray-400 transition-colors hover:text-jkb-yellow">{{ $phone }}</a>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <x-heroicon-m-chat-bubble-left-right class="mt-0.5 h-4 w-4 shrink-0 text-jkb-yellow" />
                        <a href="{{ jkb_whatsapp_link('Halo JKB, saya ingin bertanya tentang produk.') }}" target="_blank" rel="noopener" class="text-gray-400 transition-colors hover:text-jkb-yellow">{{ $whatsapp }}</a>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <x-heroicon-m-envelope class="mt-0.5 h-4 w-4 shrink-0 text-jkb-yellow" />
                        <a href="mailto:{{ $email }}" class="text-gray-400 transition-colors hover:text-jkb-yellow">{{ $email }}</a>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <x-heroicon-m-clock class="mt-0.5 h-4 w-4 shrink-0 text-jkb-yellow" />
                        <span class="text-gray-400">{{ $hours }}</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="mt-12 flex flex-col items-center justify-between gap-3 border-t border-white/10 pt-6 text-center text-xs text-gray-500 sm:flex-row sm:text-left">
            <p>&copy; {{ date('Y') }} <span class="text-gray-400">{{ jkb_setting('company_name', 'CV Jati Kencana Beton') }}</span> (JKB). Seluruh hak cipta dilindungi.</p>
            <p><span class="text-jkb-yellow">{{ $tagline }}</span> &middot; Bersertifikat {{ jkb_setting('iso_number', 'ISO 9001:2015') }}</p>
        </div>
    </div>
</footer>