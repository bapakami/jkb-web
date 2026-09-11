<x-layouts.app>
    @section('title', $news->meta_title ?: $news->title . ' – Berita JKB')
    @section('meta_description', $news->meta_description ?: $news->excerpt)

    @push('schema')
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@type": "NewsArticle",
        "headline": "{{ $news->title }}",
        "datePublished": "{{ $news->published_at?->toIso8601String() }}",
        "author": {
            "@type": "Person",
            "name": "{{ $news->author ?: 'Admin JKB' }}"
        },
        "publisher": {
            "@type": "Organization",
            "name": "{{ jkb_setting('company_name', 'CV Jati Kencana Beton') }}",
            "logo": { "@type": "ImageObject", "url": "{{ asset('images/logo.svg') }}" }
        }
        @if ($news->image)
        ,"image": "{{ asset('storage/' . $news->image) }}"
        @endif
    }
    </script>
    @endpush

    <x-page-hero
        :title="$news->title"
        :eyebrow="'Berita · ' . $news->category"
        :description="$news->published_at->format('d F Y')"
    />

    <section class="bg-white py-16">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <nav class="flex flex-wrap items-center gap-1.5 text-xs font-medium text-jkb-gray">
                <a href="{{ route('news.index') }}" class="hover:text-jkb-yellow-dark">Berita</a>
                <x-heroicon-m-chevron-right class="h-3.5 w-3.5" />
                <span class="text-jkb-gray-dark">{{ $news->title }}</span>
            </nav>

            @if ($news->image)
                <div class="mt-8 overflow-hidden rounded-2xl border border-jkb-gray-light">
                    <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="w-full object-cover">
                </div>
            @endif

            <div class="mt-8 flex flex-wrap items-center gap-x-5 gap-y-2 text-xs font-medium text-jkb-gray">
                <span class="inline-flex items-center gap-1.5"><x-heroicon-m-calendar class="h-4 w-4 text-jkb-yellow-dark" /> {{ $news->published_at->format('d F Y') }}</span>
                <span class="inline-flex items-center gap-1.5"><x-heroicon-m-tag class="h-4 w-4 text-jkb-yellow-dark" /> {{ $news->category }}</span>
            </div>

            <div class="mt-8 prose prose-sm prose-gray max-w-none leading-relaxed text-jkb-gray sm:prose-base">
                {!! $news->content !!}
            </div>

            <div class="mt-12 rounded-xl border border-jkb-gray-light bg-jkb-gray-light/50 p-6 text-center">
                <h2 class="text-lg font-black text-jkb-gray-dark">Tertarik berkolaborasi dengan JKB?</h2>
                <p class="mt-1 text-sm text-jkb-gray">Hubungi tim kami untuk kebutuhan beton dan material konstruksi proyek Anda.</p>
                <a href="{{ route('contact') }}" class="mt-4 inline-flex items-center gap-2 rounded-lg bg-jkb-yellow px-6 py-3 text-sm font-bold text-jkb-navy transition-colors hover:bg-jkb-yellow-dark">
                    <x-heroicon-m-chat-bubble-left-right class="h-5 w-5" /> Hubungi Kami
                </a>
            </div>

            @if ($related->isNotEmpty())
                <div class="mt-14 border-t border-jkb-gray-light pt-10">
                    <h2 class="text-xl font-black text-jkb-gray-dark">Berita Terkait</h2>
                    <div class="mt-6 grid gap-6 md:grid-cols-3">
                        @foreach ($related as $r)
                            <article class="group overflow-hidden rounded-xl border border-jkb-gray-light bg-white shadow-sm">
                                <div class="relative h-36 overflow-hidden">
                                    @if ($r->image)
                                        <img src="{{ asset('storage/' . $r->image) }}" alt="{{ $r->title }}" class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105" loading="lazy">
                                    @else
                                        <div class="grid h-full w-full place-items-center bg-jkb-navy text-jkb-yellow">
                                            <x-heroicon-m-newspaper class="h-10 w-10 opacity-70" />
                                        </div>
                                    @endif
                                </div>
                                <div class="p-5">
                                    <p class="text-[11px] font-semibold uppercase tracking-wide text-jkb-yellow-dark">{{ $r->category }}</p>
                                    <h3 class="mt-1 font-black leading-snug text-jkb-gray-dark">
                                        <a href="{{ route('news.show', $r) }}" class="hover:text-jkb-yellow-dark">{{ $r->title }}</a>
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