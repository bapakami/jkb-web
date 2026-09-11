<x-layouts.app>
    @section('title', 'Cabang Kami – JKB Jawa Tengah')
    @section('meta_description', 'Daftar cabang dan batching plant CV Jati Kencana Beton (JKB) di berbagai kota Jawa Tengah. Temukan lokasi terdekat untuk kebutuhan beton Anda.')

    <x-page-hero
        title="Cabang & Lokasi"
        eyebrow="Cabang"
        description="Enam lokasi di Jawa Tengah siap melayani Anda dengan pasokan beton yang tepat waktu dan berpengalaman."
    />

    <section class="bg-jkb-gray-light py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @if ($branches->isEmpty())
                <p class="py-20 text-center text-sm text-jkb-gray">Belum ada data cabang. Silakan hubungi kami melalui halaman kontak.</p>
            @else
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($branches as $branch)
                        <article class="flex flex-col rounded-xl border border-jkb-gray-light bg-white p-6 shadow-sm transition-all hover:-translate-y-1 hover:shadow-md">
                            <div class="flex items-start justify-between gap-3">
                                <div class="grid h-11 w-11 place-items-center rounded-lg bg-jkb-yellow">
                                    <x-heroicon-m-map-pin class="h-6 w-6 text-jkb-navy" />
                                </div>
                                @if ($branch->type)
                                    <span class="rounded-full bg-jkb-navy px-2.5 py-0.5 text-[11px] font-bold uppercase text-jkb-yellow">{{ $branch->type }}</span>
                                @endif
                            </div>
                            <h2 class="mt-4 text-lg font-black text-jkb-gray-dark">
                                <a href="{{ route('branches.show', $branch) }}" class="hover:text-jkb-yellow-dark">{{ $branch->name }}</a>
                            </h2>
                            <p class="mt-1.5 flex items-start gap-1.5 text-sm text-jkb-gray">
                                <x-heroicon-m-building-library class="mt-0.5 h-4 w-4 shrink-0 text-jkb-yellow-dark" />
                                {{ $branch->address }}
                            </p>
                            <div class="mt-4 space-y-1.5 text-sm">
                                @if ($branch->phone)
                                    <p class="flex items-center gap-2 text-jkb-gray"><x-heroicon-m-phone class="h-4 w-4 text-jkb-yellow-dark" /> {{ $branch->phone }}</p>
                                @endif
                                @if ($branch->operational_hours)
                                    <p class="flex items-center gap-2 text-jkb-gray"><x-heroicon-m-clock class="h-4 w-4 text-jkb-yellow-dark" /> {{ $branch->operational_hours }}</p>
                                @endif
                            </div>
                            <div class="mt-5 flex items-center gap-3 border-t border-jkb-gray-light pt-4">
                                <a href="{{ route('branches.show', $branch) }}" class="inline-flex items-center gap-1.5 text-sm font-bold text-jkb-yellow-dark hover:text-jkb-gray-dark">
                                    Detail <x-heroicon-m-arrow-right class="h-4 w-4" />
                                </a>
                                @if ($branch->map_url)
                                    <a href="{{ $branch->map_url }}" target="_blank" rel="noopener" class="ml-auto inline-flex items-center gap-1.5 text-sm font-bold text-jkb-navy hover:text-jkb-yellow-dark">
                                        <x-heroicon-m-map class="h-4 w-4" /> Buka Peta
                                    </a>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
</x-layouts.app>