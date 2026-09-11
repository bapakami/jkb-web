<x-layouts.app>
    @section('title', 'Berita & Informasi – JKB Kokoh Berkualitas')
    @section('meta_description', 'Berita terbaru, informasi perusahaan, dan dunia industri beton dari CV Jati Kencana Beton (JKB) Jawa Tengah.')

    <x-page-hero
        title="Berita & Informasi"
        eyebrow="Berita"
        description="Kabar terbaru dari JKB — informasi produksi, proyek, dan seputar dunia konstruksi beton."
    />

    <section class="bg-jkb-gray-light py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @if ($news->isEmpty())
                <p class="py-20 text-center text-sm text-jkb-gray">Belum ada berita yang diterbitkan.</p>
            @else
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($news as $item)
                        <article class="group flex flex-col overflow-hidden rounded-xl border border-jkb-gray-light bg-white shadow-sm transition-all hover:-translate-y-1 hover:shadow-md">
                            <div class="relative h-48 overflow-hidden">
                                @if ($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105" loading="lazy">
                                @else
                                    <div class="grid h-full w-full place-items-center bg-jkb-navy text-jkb-yellow">
                                        <x-heroicon-m-newspaper class="h-14 w-14 opacity-70" />
                                    </div>
                                @endif
                                <span class="absolute left-4 top-4 rounded-md bg-white/95 px-2.5 py-1 text-center text-xs font-black leading-tight text-jkb-gray-dark shadow-sm">
                                    {{ $item->published_at->format('d') }}<br>{{ $item->published_at->format('M Y') }}
                                </span>
                            </div>
                            <div class="flex flex-1 flex-col p-6">
                                <p class="text-xs font-semibold uppercase tracking-wide text-jkb-yellow-dark">{{ $item->category }}</p>
                                <h2 class="mt-2 text-lg font-black leading-snug text-jkb-gray-dark">
                                    <a href="{{ route('news.show', $item) }}" class="hover:text-jkb-yellow-dark">{{ $item->title }}</a>
                                </h2>
                                <div class="mt-3 flex items-center gap-4 text-xs text-jkb-gray">
                                    <span class="inline-flex items-center gap-1.5">
                                        <x-heroicon-m-calendar-days class="h-4 w-4 text-jkb-yellow-dark" />
                                        {{ $item->published_at->format('d M Y') }}
                                    </span>
                                    <span class="inline-flex items-center gap-1.5">
                                        <x-heroicon-m-eye class="h-4 w-4 text-jkb-yellow-dark" />
                                        {{ number_format($item->views, 0, ',', '.') }}
                                    </span>
                                </div>
                                <p class="mt-3 flex-1 text-sm leading-relaxed text-jkb-gray line-clamp-3">{{ $item->excerpt }}</p>
                                <a href="{{ route('news.show', $item) }}" class="mt-4 inline-flex items-center gap-1.5 text-sm font-bold text-jkb-yellow-dark hover:text-jkb-gray-dark">
                                    Baca Selengkapnya <x-heroicon-m-arrow-right class="h-4 w-4" />
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                @if ($news->hasPages())
                    <div class="mt-12">
                        {{ $news->links() }}
                    </div>
                @endif
            @endif
        </div>
    </section>
</x-layouts.app>