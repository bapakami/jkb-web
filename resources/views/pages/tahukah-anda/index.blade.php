<x-layouts.app>
    @section('title', 'Tahukah Anda – Seputar Beton JKB')
    @section('meta_description', 'Kumpulan artikel pengetahuan seputar beton, material, dan tips konstruksi dari CV Jati Kencana Beton (JKB).')

    <x-page-hero
        title="Tahukah Anda"
        eyebrow="Tahukah Anda"
        description="Wawasan ringan seputar dunia beton dan konstruksi — ditulis oleh praktisi JKB."
    />

    <section class="relative overflow-hidden bg-jkb-gray-light py-16">
        <div class="jkb-glow -left-28 top-16 h-96 w-96 bg-jkb-yellow/20"></div>
        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @if ($items->isEmpty())
                <p class="py-20 text-center text-sm text-jkb-gray">Belum ada konten "Tahukah Anda".</p>
            @else
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($items as $item)
                        <article class="group jkb-reveal flex flex-col overflow-hidden rounded-2xl glass ring-1 ring-white/60 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_18px_44px_rgba(15,23,42,0.15)]">
                            <div class="relative h-44 overflow-hidden">
                                @if ($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105" loading="lazy">
                                @else
                                    <div class="grid h-full w-full place-items-center bg-jkb-navy text-jkb-yellow">
                                        <x-heroicon-m-light-bulb class="h-14 w-14 opacity-70" />
                                    </div>
                                @endif
                            </div>
                            <div class="flex flex-1 flex-col p-6">
                                <h2 class="text-lg font-black leading-snug text-jkb-gray-dark">
                                    <a href="{{ route('tahukah-anda.show', $item) }}" class="hover:text-jkb-yellow-dark">{{ $item->title }}</a>
                                </h2>
                                <p class="mt-3 flex-1 text-sm leading-relaxed text-jkb-gray line-clamp-3">{{ $item->subtitle }}</p>
                                <a href="{{ route('tahukah-anda.show', $item) }}" class="mt-4 inline-flex items-center gap-1.5 text-sm font-bold text-jkb-yellow-dark hover:text-jkb-gray-dark">
                                    Baca Lebih Lanjut <x-heroicon-m-arrow-right class="h-4 w-4" />
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                @if ($items->hasPages())
                    <div class="mt-12">
                        {{ $items->links() }}
                    </div>
                @endif
            @endif
        </div>
    </section>
</x-layouts.app>