<x-layouts.app>
    @section('title', $tahukahAnda->title . ' – Tahukah Anda JKB')
    @section('meta_description', $tahukahAnda->meta_description ?: $tahukahAnda->subtitle)

    <x-page-hero
        :title="$tahukahAnda->title"
        :eyebrow="'Tahukah Anda · ' . $tahukahAnda->published_at->format('d M Y')"
        :description="$tahukahAnda->subtitle"
    />

    <section class="relative overflow-hidden bg-white py-16">
        <div class="jkb-glow -left-32 top-24 h-96 w-96 bg-jkb-yellow/15"></div>
        <div class="relative mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <nav class="flex flex-wrap items-center gap-1.5 text-xs font-medium text-jkb-gray">
                <a href="{{ route('tahukah-anda.index') }}" class="hover:text-jkb-yellow-dark">Tahukah Anda</a>
                <x-heroicon-m-chevron-right class="h-3.5 w-3.5" />
                <span class="text-jkb-gray-dark">{{ $tahukahAnda->title }}</span>
            </nav>

            @if ($tahukahAnda->image)
                <div class="jkb-reveal mt-8 overflow-hidden rounded-2xl glass p-2 shadow-sm ring-1 ring-white/60">
                    <img src="{{ asset('storage/' . $tahukahAnda->image) }}" alt="{{ $tahukahAnda->title }}" class="w-full object-cover">
                </div>
            @endif

            <div class="mt-8 prose prose-sm prose-gray max-w-none leading-relaxed text-jkb-gray sm:prose-base">
                {!! $tahukahAnda->content !!}
            </div>

            <div class="mt-12 rounded-xl bg-jkb-yellow/25 p-6 ring-1 ring-jkb-yellow/30 backdrop-blur-md">
                <h2 class="text-lg font-black text-jkb-gray-dark">Ingin mendirikan bangunan kokoh?</h2>
                <p class="mt-1 text-sm text-jkb-gray">Percayakan kebutuhan beton proyek Anda pada JKB.</p>
                <a href="{{ route('contact') }}" class="mt-4 inline-flex items-center gap-2 rounded-lg bg-jkb-navy px-6 py-3 text-sm font-bold text-white transition-colors hover:bg-jkb-gray-dark">
                    <x-heroicon-m-chat-bubble-left-right class="h-5 w-5" /> Konsultasi Gratis
                </a>
            </div>

            @if ($related->isNotEmpty())
                <div class="mt-14 border-t border-jkb-gray-light pt-10">
                    <h2 class="text-xl font-black text-jkb-gray-dark">Artikel Terkait</h2>
                    <div class="mt-6 grid gap-6 md:grid-cols-3">
                        @foreach ($related as $r)
                            <article class="group jkb-reveal overflow-hidden rounded-2xl glass shadow-sm ring-1 ring-white/60">
                                <div class="relative h-36 overflow-hidden">
                                    @if ($r->image)
                                        <img src="{{ asset('storage/' . $r->image) }}" alt="{{ $r->title }}" class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105" loading="lazy">
                                    @else
                                        <div class="grid h-full w-full place-items-center bg-jkb-navy text-jkb-yellow">
                                            <x-heroicon-m-light-bulb class="h-10 w-10 opacity-70" />
                                        </div>
                                    @endif
                                </div>
                                <div class="p-5">
                                    <h3 class="font-black leading-snug text-jkb-gray-dark">
                                        <a href="{{ route('tahukah-anda.show', $r) }}" class="hover:text-jkb-yellow-dark">{{ $r->title }}</a>
                                    </h3>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>
</x-layouts.app>