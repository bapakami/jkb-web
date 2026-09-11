<x-layouts.app>
    @section('title', $branch->name . ' – Cabang JKB')
    @section('meta_description', 'Informasi lengkap ' . $branch->name . ' CV Jati Kencana Beton (JKB): alamat, telepon, jam operasional, dan arah lokasi.')

    <x-page-hero
        :title="$branch->name"
        :eyebrow="'Cabang · ' . ($branch->type ?: 'Lokasi')"
    />

    <section class="bg-white py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <nav class="flex flex-wrap items-center gap-1.5 text-xs font-medium text-jkb-gray">
                <a href="{{ route('branches.index') }}" class="hover:text-jkb-yellow-dark">Cabang</a>
                <x-heroicon-m-chevron-right class="h-3.5 w-3.5" />
                <span class="text-jkb-gray-dark">{{ $branch->name }}</span>
            </nav>

            <div class="mt-8 grid gap-8 lg:grid-cols-2">
                <div class="space-y-5">
                    <div class="rounded-xl border border-jkb-gray-light p-6">
                        <h2 class="flex items-center gap-2 text-lg font-black text-jkb-gray-dark">
                            <x-heroicon-m-map-pin class="h-5 w-5 text-jkb-yellow-dark" /> Alamat
                        </h2>
                        <p class="mt-2 text-sm leading-relaxed text-jkb-gray">{{ $branch->address }}</p>
                    </div>

                    <div class="rounded-xl border border-jkb-gray-light p-6">
                        <h2 class="text-lg font-black text-jkb-gray-dark">Kontak</h2>
                        <div class="mt-3 space-y-2.5 text-sm">
                            @if ($branch->phone)
                                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $branch->phone) }}" class="flex items-center gap-2 text-jkb-gray hover:text-jkb-yellow-dark">
                                    <x-heroicon-m-phone class="h-4 w-4 text-jkb-yellow-dark" /> {{ $branch->phone }}
                                </a>
                            @endif
                            @if ($branch->whatsapp)
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $branch->whatsapp) }}" target="_blank" rel="noopener" class="flex items-center gap-2 text-jkb-gray hover:text-jkb-yellow-dark">
                                    <x-heroicon-m-chat-bubble-left-right class="h-4 w-4 text-jkb-yellow-dark" /> {{ $branch->whatsapp }}
                                </a>
                            @endif
                            @if ($branch->email)
                                <a href="mailto:{{ $branch->email }}" class="flex items-center gap-2 text-jkb-gray hover:text-jkb-yellow-dark">
                                    <x-heroicon-m-envelope class="h-4 w-4 text-jkb-yellow-dark" /> {{ $branch->email }}
                                </a>
                            @endif
                            @if ($branch->operational_hours)
                                <p class="flex items-center gap-2 text-jkb-gray">
                                    <x-heroicon-m-clock class="h-4 w-4 text-jkb-yellow-dark" /> {{ $branch->operational_hours }}
                                </p>
                            @endif
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        @if ($branch->whatsapp)
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $branch->whatsapp) }}?text={{ urlencode('Saya ingin bertanya tentang ' . $branch->name) }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 rounded-lg bg-jkb-yellow px-6 py-3 text-sm font-bold text-jkb-navy transition-colors hover:bg-jkb-yellow-dark">
                                <x-heroicon-m-chat-bubble-left-right class="h-5 w-5" /> Chat WhatsApp
                            </a>
                        @endif
                        @if ($branch->map_url)
                            <a href="{{ $branch->map_url }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 rounded-lg bg-jkb-navy px-6 py-3 text-sm font-bold text-white transition-colors hover:bg-jkb-gray-dark">
                                <x-heroicon-m-map class="h-5 w-5" /> Buka di Google Maps
                            </a>
                        @endif
                    </div>
                </div>

                <div class="overflow-hidden rounded-xl border border-jkb-gray-light bg-jkb-gray-light/40">
                    @if ($branch->map_url)
                        <iframe title="Peta {{ $branch->name }}" src="{{ $branch->map_url }}" width="100%" height="100%" class="min-h-[24rem] w-full border-0" loading="lazy" allowfullscreen referrerpolicy="no-referrer-when-downgrade"></iframe>
                    @elseif ($branch->latitude && $branch->longitude)
                        <iframe title="Peta {{ $branch->name }}" src="https://maps.google.com/maps?q={{ $branch->latitude }},{{ $branch->longitude }}&z=14&output=embed" width="100%" height="100%" class="min-h-[24rem] w-full border-0" loading="lazy" allowfullscreen referrerpolicy="no-referrer-when-downgrade"></iframe>
                    @else
                        <div class="grid min-h-[24rem] place-items-center text-jkb-gray">
                            <div class="text-center">
                                <x-heroicon-m-map class="mx-auto h-12 w-12 text-jkb-yellow-dark" />
                                <p class="mt-3 text-sm">Peta tidak tersedia.</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            @if ($otherBranches->isNotEmpty())
                <div class="mt-16 border-t border-jkb-gray-light pt-10">
                    <h2 class="text-xl font-black text-jkb-gray-dark">Cabang Lainnya</h2>
                    <div class="mt-5 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ($otherBranches as $ob)
                            <a href="{{ route('branches.show', $ob) }}" class="group flex items-center justify-between rounded-xl border border-jkb-gray-light bg-white p-5 shadow-sm transition-all hover:border-jkb-yellow hover:shadow-md">
                                <div>
                                    <p class="font-bold text-jkb-gray-dark group-hover:text-jkb-yellow-dark">{{ $ob->name }}</p>
                                    <p class="mt-0.5 truncate text-xs text-jkb-gray">{{ $ob->address }}</p>
                                </div>
                                <x-heroicon-m-arrow-right class="h-5 w-5 shrink-0 text-jkb-yellow-dark" />
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>
</x-layouts.app>