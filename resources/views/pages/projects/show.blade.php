<x-layouts.app>
    @section('title', $project->meta_title ?: $project->title . ' – Proyek JKB')
    @section('meta_description', $project->meta_description ?: 'Detail proyek ' . $project->title . ' yang dipasok CV Jati Kencana Beton (JKB).')

    <x-page-hero
        :title="$project->title"
        :eyebrow="$project->category"
        :description="($project->client_name ? 'Klien: ' . $project->client_name : null) . ($project->location ? ' — ' . $project->location : null) . ($project->year ? ' — ' . $project->year : null)"
    />

    <section class="relative overflow-hidden bg-white py-16">
        <div class="jkb-glow -left-32 top-24 h-96 w-96 bg-jkb-yellow/15"></div>
        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <nav class="flex flex-wrap items-center gap-1.5 text-xs font-medium text-jkb-gray">
                <a href="{{ route('projects.index') }}" class="hover:text-jkb-yellow-dark">Proyek</a>
                <x-heroicon-m-chevron-right class="h-3.5 w-3.5" />
                <a href="{{ route('projects.index', ['kategori' => $project->category]) }}" class="hover:text-jkb-yellow-dark">{{ $project->category }}</a>
                <x-heroicon-m-chevron-right class="h-3.5 w-3.5" />
                <span class="text-jkb-gray-dark">{{ $project->title }}</span>
            </nav>

            <div class="jkb-reveal mt-8 overflow-hidden rounded-2xl glass p-2 shadow-sm ring-1 ring-white/60">
                @if ($project->featured_image)
                    <img src="{{ asset('storage/' . $project->featured_image) }}" alt="{{ $project->title }}" class="aspect-video w-full object-cover">
                @else
                    <div class="grid aspect-video w-full place-items-center bg-jkb-navy text-jkb-yellow">
                        <x-heroicon-m-building-office-2 class="h-24 w-24 opacity-70" />
                    </div>
                @endif
            </div>

            <div class="mt-8 grid gap-8 lg:grid-cols-3">
                <div class="lg:col-span-2">
                    <div class="flex flex-wrap gap-x-8 gap-y-3 text-sm">
                        <div class="flex items-center gap-2 text-jkb-gray"><x-heroicon-m-map-pin class="h-4 w-4 text-jkb-yellow-dark" /> <span class="font-semibold text-jkb-gray-dark">Lokasi:</span> {{ $project->location }}</div>
                        @if ($project->year)
                            <div class="flex items-center gap-2 text-jkb-gray"><x-heroicon-m-briefcase class="h-4 w-4 text-jkb-yellow-dark" /> <span class="font-semibold text-jkb-gray-dark">Tahun:</span> {{ $project->year }}</div>
                        @endif
                        @if ($project->client_name)
                            <div class="flex items-center gap-2 text-jkb-gray"><x-heroicon-m-user-group class="h-4 w-4 text-jkb-yellow-dark" /> <span class="font-semibold text-jkb-gray-dark">Klien:</span> {{ $project->client_name }}</div>
                        @endif
                    </div>
                    <div class="mt-6 prose prose-sm prose-gray max-w-none leading-relaxed text-jkb-gray">
                        {!! $project->description !!}
                    </div>

                    @if($project->video_url)
                        <h2 class="mt-10 text-xl font-black text-jkb-gray-dark">Video Proyek</h2>
                        <div class="mt-4 aspect-video overflow-hidden rounded-xl glass ring-1 ring-white/60">
                            <video controls playsinline class="h-full w-full bg-black">
                                <source src="{{ $project->video_url }}" type="video/mp4">
                                Browser Anda tidak mendukung pemutaran video.
                            </video>
                        </div>
                    @endif
                </div>

                <aside class="space-y-6">
                    <div class="rounded-xl glass p-6 ring-1 ring-white/60 shadow-sm">
                        <h3 class="text-lg font-black text-jkb-gray-dark">Butuh Pasokan Beton Serupa?</h3>
                        <p class="mt-2 text-sm leading-relaxed text-jkb-gray">Konsultasikan kebutuhan proyek Anda dengan tim teknis kami. Solusi mix design disesuaikan spesifikasi proyek.</p>
                        <a href="{{ route('contact') }}" class="mt-4 inline-flex w-full items-center justify-center gap-2 rounded-lg bg-jkb-yellow px-5 py-3 text-sm font-bold text-jkb-navy transition-colors hover:bg-jkb-yellow-dark">
                            <x-heroicon-m-chat-bubble-left-right class="h-5 w-5" /> Hubungi Kami
                        </a>
                    </div>
                </aside>
            </div>

            @if ($project->gallery)
                <h2 class="mt-14 text-xl font-black text-jkb-gray-dark">Galeri</h2>
                <div class="mt-5 grid grid-cols-2 gap-4 md:grid-cols-4">
                    @foreach ($project->gallery as $img)
                        @php $path = normalize_image_path($img); @endphp
                        @if ($path)
                        <div class="overflow-hidden rounded-xl glass ring-1 ring-white/60">
                            <img src="{{ asset('storage/' . $path) }}" alt="Galeri {{ $project->title }}" loading="lazy" class="aspect-video w-full object-cover transition-transform hover:scale-105">
                        </div>
                        @endif
                    @endforeach
                </div>
            @endif

            @if ($otherProjects->isNotEmpty())
                <div class="mt-14 border-t border-jkb-gray-light pt-10">
                    <h2 class="text-xl font-black text-jkb-gray-dark">Proyek Lainnya</h2>
                    <div class="mt-6 grid gap-6 md:grid-cols-3">
                        @foreach ($otherProjects as $p)
                            <article class="group jkb-reveal overflow-hidden rounded-2xl glass shadow-sm ring-1 ring-white/60">
                                <div class="relative h-40 overflow-hidden">
                                    @if ($p->featured_image)
                                        <img src="{{ asset('storage/' . $p->featured_image) }}" alt="{{ $p->title }}" class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105" loading="lazy">
                                    @else
                                        <div class="grid h-full w-full place-items-center bg-jkb-navy text-jkb-yellow">
                                            <x-heroicon-m-building-office-2 class="h-10 w-10 opacity-70" />
                                        </div>
                                    @endif
                                    <span class="absolute left-3 top-3 rounded-full bg-jkb-yellow px-2.5 py-0.5 text-xs font-bold text-jkb-navy">{{ $p->category }}</span>
                                </div>
                                <div class="p-5">
                                    <h3 class="font-black leading-snug text-jkb-gray-dark">
                                        <a href="{{ route('projects.show', $p) }}" class="hover:text-jkb-yellow-dark">{{ $p->title }}</a>
                                    </h3>
                                    <p class="mt-1 text-xs text-jkb-gray">{{ $p->location }}@if($p->year) · {{ $p->year }}@endif</p>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>
</x-layouts.app>