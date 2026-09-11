<x-layouts.app>
    @section('title', 'Proyek – JKB Kokoh Berkualitas')
    @section('meta_description', 'Portofolio proyek CV Jati Kencana Beton: proyek komersial & perumahan, industri, serta infrastruktur di seluruh Jawa Tengah.')

    <x-page-hero
        title="Proyek Kami"
        eyebrow="Proyek"
        description="Bukti nyata kokohnya beton JKB — portofolio proyek yang kami pasok di berbagai segmen konstruksi."
    />

    <section class="bg-jkb-gray-light py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('projects.index') }}" class="rounded-full px-4 py-2 text-sm font-semibold transition-colors {{ is_null($selectedCategory) ? 'bg-jkb-navy text-jkb-yellow' : 'border border-jkb-gray-light bg-white text-jkb-gray-dark hover:border-jkb-yellow' }}">
                        Semua
                    </a>
                    @foreach ($categories as $cat)
                        <a href="{{ route('projects.index', array_filter(['kategori' => $cat])) }}" class="rounded-full px-4 py-2 text-sm font-semibold transition-colors {{ $selectedCategory === $cat ? 'bg-jkb-navy text-jkb-yellow' : 'border border-jkb-gray-light bg-white text-jkb-gray-dark hover:border-jkb-yellow' }}">
                            {{ $cat }}
                        </a>
                    @endforeach
                </div>
                <span class="text-xs font-medium text-jkb-gray">{{ $projects->total() }} proyek ditampilkan</span>
            </div>

            @if ($projects->isEmpty())
                <p class="py-20 text-center text-sm text-jkb-gray">Belum ada proyek yang ditampilkan pada kategori ini.</p>
            @else
                <div class="mt-8 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($projects as $project)
                        <article class="group flex flex-col overflow-hidden rounded-xl border border-jkb-gray-light bg-white shadow-sm transition-all hover:-translate-y-1 hover:shadow-md">
                            <div class="relative h-52 overflow-hidden">
                                @if ($project->featured_image)
                                    <img src="{{ asset('storage/' . $project->featured_image) }}" alt="{{ $project->title }}" class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105" loading="lazy">
                                @else
                                    <div class="grid h-full w-full place-items-center bg-jkb-navy text-jkb-yellow">
                                        <x-heroicon-m-building-office-2 class="h-14 w-14 opacity-70" />
                                    </div>
                                @endif
                                <span class="absolute left-4 top-4 rounded-full bg-jkb-yellow px-3 py-1 text-xs font-bold text-jkb-navy">{{ $project->category }}</span>
                            </div>
                            <div class="flex flex-1 flex-col p-6">
                                <h2 class="text-lg font-black leading-snug text-jkb-gray-dark">
                                    <a href="{{ route('projects.show', $project) }}" class="hover:text-jkb-yellow-dark">{{ $project->title }}</a>
                                </h2>
                                <div class="mt-3 flex flex-wrap gap-x-4 gap-y-1 text-xs font-medium text-jkb-gray">
                                    <span class="inline-flex items-center gap-1"><x-heroicon-m-map-pin class="h-3.5 w-3.5" /> {{ $project->location }}</span>
                                    @if ($project->year)
                                        <span class="inline-flex items-center gap-1"><x-heroicon-m-briefcase class="h-3.5 w-3.5" /> {{ $project->year }}</span>
                                    @endif
                                    @if ($project->client_name)
                                        <span class="inline-flex items-center gap-1"><x-heroicon-m-user-group class="h-3.5 w-3.5" /> {{ $project->client_name }}</span>
                                    @endif
                                </div>
                                <p class="mt-3 flex-1 text-sm leading-relaxed text-jkb-gray line-clamp-3">{{ $project->description }}</p>
                                <a href="{{ route('projects.show', $project) }}" class="mt-4 inline-flex items-center gap-1.5 text-sm font-bold text-jkb-yellow-dark hover:text-jkb-gray-dark">
                                    Detail Proyek <x-heroicon-m-arrow-right class="h-4 w-4" />
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                @if ($projects->hasPages())
                    <div class="mt-12">
                        {{ $projects->links() }}
                    </div>
                @endif
            @endif
        </div>
    </section>
</x-layouts.app>