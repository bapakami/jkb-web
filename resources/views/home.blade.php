<x-layouts.app>
    @section('title', 'JKB Indo Beton – Beton Ready Mix, Pracetak & Material Split Jawa Tengah')
    @section('meta_description', 'CV Jati Kencana Beton (JKB) – produsen beton ready mix, beton pracetak/precast, dan material split berkualitas di Jawa Tengah sejak 1980. Bersertifikasi ISO 9001:2015. Kokoh Berkualitas.')
    @section('og_image', asset('images/hero/beton-readymix-1.jpg'))

    @push('schema')
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@type": "LocalBusiness",
        "@id": "{{ url('/') }}#business",
        "name": "{{ jkb_setting('company_name', 'CV Jati Kencana Beton') }}",
        "url": "{{ url('/') }}",
        "image": "{{ asset('images/logo.svg') }}",
        "slogan": "{{ jkb_setting('tagline', 'Kokoh Berkualitas') }}",
        "telephone": "{{ jkb_setting('phone', '') }}",
        "email": "{{ jkb_setting('email', '') }}",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "{{ jkb_setting('address', 'Jl. Raya Semarang – Solo KM 12, Ungaran, Jawa Tengah') }}",
            "addressRegion": "Jawa Tengah",
            "addressCountry": "ID"
        },
        "foundingDate": "{{ jkb_setting('est_year', '1980') }}",
        "description": "Produsen beton ready mix, beton pracetak/precast, dan material split berkualitas di Jawa Tengah sejak 1980. Bersertifikasi ISO 9001:2015.",
        "serviceType": ["Beton Ready Mix", "Beton Pracetak / Precast", "Material Split & Batu Pecah"]
    }
    </script>
    @endpush

    @push('head')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <style>
        .jkb-map-container { z-index: 0; }
        .jkb-map-container .leaflet-container {
            font-family: 'Inter', ui-sans-serif, system-ui, sans-serif;
            background: #080A0E;
        }

        .jkb-map-container .leaflet-tile {
            filter: brightness(1.04) contrast(1.12) saturate(0.62);
        }

        .jkb-map-overlay {
            position: absolute;
            inset: 0;
            z-index: 450;
            pointer-events: none;
            background:
                radial-gradient(120% 90% at 50% 32%, rgba(43, 46, 51, 0) 0%, rgba(6, 8, 11, 0.42) 100%);
        }

        .jkb-map-container .leaflet-control-attribution {
            background: rgba(8, 10, 14, 0.62) !important;
            color: #8A919C;
            font-size: 10px;
        }
        .jkb-map-container .leaflet-control-attribution a { color: #FFC72C; }

        .jkb-map-container .leaflet-control-zoom a {
            background: rgba(23, 26, 31, 0.9);
            color: #E5E7EB;
            border-color: rgba(255, 255, 255, 0.12);
        }
        .jkb-map-container .leaflet-control-zoom a:hover { background: rgba(255, 199, 44, 0.9); color: #171A1F; }

        .jkb-map-pin-wrap { background: transparent; border: none; }

        .jkb-map-pin {
            position: relative;
            width: 16px;
            height: 16px;
            border-radius: 9999px;
            background: #FFC72C;
            box-shadow:
                0 0 0 2px rgba(255, 255, 255, 0.9),
                0 0 16px rgba(255, 199, 44, 0.85),
                0 6px 16px rgba(0, 0, 0, 0.55);
        }

        .jkb-map-pin-ring {
            position: absolute;
            inset: 0;
            border-radius: 9999px;
            background: rgba(255, 199, 44, 0.55);
            animation: jkb-map-pulse 2.2s cubic-bezier(0.2, 0.6, 0.4, 1) infinite;
        }
        .jkb-map-pin-ring:nth-child(2) { animation-delay: 1.1s; }

        @keyframes jkb-map-pulse {
            0% { transform: scale(1); opacity: 0.65; }
            70% { transform: scale(3.6); opacity: 0; }
            100% { transform: scale(3.6); opacity: 0; }
        }

        .jkb-map-popup .leaflet-popup-content-wrapper {
            background: #171A1F;
            color: #E5E7EB;
            border: 1px solid rgba(255, 199, 44, 0.18);
            border-radius: 14px;
            box-shadow: 0 18px 44px rgba(0, 0, 0, 0.55);
        }
        .jkb-map-popup .leaflet-popup-tip {
            background: #171A1F;
            border: 1px solid rgba(255, 199, 44, 0.18);
        }
        .jkb-map-popup .leaflet-popup-content { margin: 14px 16px; line-height: 1.5; }
        .jkb-map-popup .leaflet-popup-close-button { color: #9CA3AF; }

        .jkb-map-tooltip-title { color: #FFC72C; font-weight: 800; font-size: 0.9rem; }

        .jkb-map-live-dot {
            width: 7px;
            height: 7px;
            border-radius: 9999px;
            background: #22C55E;
            box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.22);
        }
        .jkb-map-live-label {
            font-size: 0.6rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            font-weight: 700;
            color: #9CA3AF;
        }

        .jkb-map-tooltip-type {
            display: inline-block;
            font-size: 0.62rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            font-weight: 700;
            color: #FFC72C;
            background: rgba(255, 199, 44, 0.15);
            padding: 2px 8px;
            border-radius: 999px;
        }
        .jkb-map-tooltip-addr { margin-top: 6px; font-size: 0.78rem; color: #C9CDD4; }

        .jkb-map-tooltip-link {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            margin-top: 10px;
            font-size: 0.72rem;
            font-weight: 700;
            color: #171A1F;
            background: #FFC72C;
            padding: 5px 11px;
            border-radius: 999px;
            text-decoration: none;
            transition: background 0.15s ease, transform 0.15s ease;
        }
        .jkb-map-tooltip-link:hover { background: #FFD55C; transform: translateY(-1px); }
    </style>
    @endpush

    {{-- HERO --}}
    @php
        $waText = 'Halo JKB, saya ingin konsultasi gratis tentang kebutuhan beton saya.';
        $slides = [
            [
                'badge' => 'Sejak 1980 &middot; Bersertifikasi ISO 9001:2015',
                'title' => 'JKB <span class="text-jkb-yellow">Kokoh Berkualitas</span>',
                'desc' => 'Beton Ready Mix, Beton Pracetak/Precast &amp; Batu Split Jawa Tengah untuk komersial, industri, dan infrastruktur. Tepat waktu, terukur, dan terpercaya.',
                'cta' => 'Konsultasi Gratis',
                'cta_href' => jkb_whatsapp_link($waText),
                'cta2' => 'Lihat Produk',
                'cta2_href' => route('products.index'),
                'image' => 'hero/beton-readymix-1.jpg',
            ],
            [
                'badge' => 'Tepat Waktu &middot; GPS Tracking Real-Time',
                'title' => 'Beton Tiba Tepat Waktu Dari <span class="text-jkb-yellow">Control Room 24 Jam</span>',
                'desc' => 'Setiap mixer dilacak GPS dan dikoordinasikan tim control room kami. Keterlambatan pengecoran bukan sekadar risiko, tapi hal yang kami hilangkan.',
                'cta' => 'Lihat Proyek Kami',
                'cta_href' => route('projects.index'),
                'cta2' => 'Konsultasi Gratis',
                'cta2_href' => jkb_whatsapp_link($waText),
                'image' => 'hero/dsc-1959.webp',
            ],
            [
                'badge' => 'Sistem Mutu &middot; ISO 9001:2015',
                'title' => 'Kualitas Terukur, <span class="text-jkb-yellow">Mutu Terjaga</span>',
                'desc' => 'Bahan baku teruji lab pada setiap batch dan mix design presisi. Komitmen mutu adalah dasar dari setiap produk yang kami kirim.',
                'cta' => 'Tentang Kami',
                'cta_href' => route('about'),
                'cta2' => 'Lihat Produk',
                'cta2_href' => route('products.index'),
                'image' => 'hero/dsc-0101.webp',
            ],
            [
                'badge' => 'Jangkauan Luas &middot; 6 Cabang',
                'title' => '6 Cabang Melayani <span class="text-jkb-yellow">Seluruh Jawa Tengah</span>',
                'desc' => 'Batching plant strategis di lokasi terbaik agar pengiriman lebih cepat dan biaya logistik proyek Anda lebih efisien.',
                'cta' => 'Lihat Cabang',
                'cta_href' => route('branches.index'),
                'cta2' => 'Konsultasi Gratis',
                'cta2_href' => jkb_whatsapp_link($waText),
                'image' => 'hero/precast-jkb.webp',
            ],
        ];
    @endphp

    <section id="hero-carousel" class="relative overflow-hidden bg-jkb-navy">
        <div class="absolute inset-0">
            @foreach ($slides as $i => $slide)
                <img src="{{ asset('storage/' . $slide['image']) }}" alt="" role="presentation"
                    class="hero-bg absolute inset-0 h-full w-full object-cover transition-opacity duration-700"
                    style="opacity: {{ $i === 0 ? '1' : '0' }};">
            @endforeach
            <div class="absolute inset-0 bg-jkb-navy/75"></div>
            <div class="absolute inset-x-0 bottom-0 h-40 bg-gradient-to-t from-jkb-navy to-transparent"></div>
        </div>

        <div class="relative mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8 lg:py-24">
            <div class="relative w-full max-w-3xl">
                <div class="overflow-hidden">
                <div id="hero-track" class="flex transition-transform duration-700 ease-in-out">
                @foreach ($slides as $i => $slide)
                    <div class="w-full shrink-0" aria-hidden="true">
                        <div class="max-w-3xl rounded-3xl glass-dark p-7 ring-1 ring-white/15 shadow-[0_20px_60px_rgba(0,0,0,0.35)] sm:p-10">
                        <span class="inline-flex items-center gap-2 rounded-full bg-jkb-yellow/15 px-4 py-1.5 text-xs font-bold uppercase tracking-wider text-jkb-yellow ring-1 ring-inset ring-jkb-yellow/30">
                            {!! $slide['badge'] !!}
                        </span>

                        <h1 class="mt-6 text-3xl font-black leading-tight tracking-tight text-white sm:text-4xl lg:text-5xl">
                            {!! $slide['title'] !!}
                        </h1>
                        <p class="mt-5 max-w-2xl text-base leading-relaxed text-gray-300 sm:text-lg">
                            {{ $slide['desc'] }}
                        </p>

                        <div class="mt-8 flex flex-wrap items-center gap-4">
                            <a href="{{ $slide['cta_href'] }}"
                                @if (str_starts_with($slide['cta_href'], 'https://wa.me')) target="_blank" rel="noopener" @endif
                                class="btn-jkb-pill px-6 py-3 text-sm sm:text-base">
                                <x-heroicon-m-chat-bubble-left-right class="h-5 w-5" />
                                {{ $slide['cta'] }}
                            </a>
                            <a href="{{ $slide['cta2_href'] }}"
                                class="inline-flex items-center gap-2 rounded-full border border-white/25 px-6 py-3 text-sm font-semibold text-white transition hover:bg-white/10 sm:text-base">
                                {{ $slide['cta2'] }}
                                <x-heroicon-m-arrow-right class="h-5 w-5" />
                            </a>
                        </div>
                    </div>
                    </div>
                @endforeach
                    </div>
                </div>

                <button type="button" id="hero-prev" aria-label="Slide sebelumnya"
                    class="absolute -left-4 top-1/2 z-20 hidden h-11 w-11 -translate-y-1/2 place-items-center rounded-full border border-white/15 bg-white/10 text-white backdrop-blur-md transition hover:bg-jkb-yellow hover:text-jkb-navy lg:grid">
                    <x-heroicon-m-chevron-left class="h-6 w-6" />
                </button>
                <button type="button" id="hero-next" aria-label="Slide berikutnya"
                    class="absolute -right-4 top-1/2 z-20 hidden h-11 w-11 -translate-y-1/2 place-items-center rounded-full border border-white/15 bg-white/10 text-white backdrop-blur-md transition hover:bg-jkb-yellow hover:text-jkb-navy lg:grid">
                    <x-heroicon-m-chevron-right class="h-6 w-6" />
                </button>
            </div>

            <div id="hero-dots" class="mt-8 flex items-center justify-center gap-2 lg:justify-start">
                @foreach ($slides as $i => $slide)
                    <button type="button" class="hero-dot h-2 w-2 rounded-full bg-white/30 transition-all hover:bg-white/60" data-index="{{ $i }}" aria-label="Ke slide {{ $i + 1 }}"></button>
                @endforeach
            </div>

            @php
                $stats = [
                    ['value' => 40, 'suffix' => '+', 'label' => 'Tahun Pengalaman'],
                    ['value' => 6, 'suffix' => '', 'label' => 'Cabang di Jawa Tengah'],
                    ['value' => 100, 'suffix' => '%', 'label' => 'Bersertifikasi ISO'],
                    ['value' => 25, 'suffix' => '+', 'label' => 'Proyek per Tahun'],
                ];
            @endphp
            <div class="mt-12 grid max-w-4xl grid-cols-2 gap-4 sm:grid-cols-4">
                @foreach ($stats as $stat)
                    <div class="glass-dark rounded-xl p-5 text-center ring-1 ring-white/15">
                        <div class="text-2xl font-black text-jkb-yellow sm:text-3xl">
                            <span x-countup="{{ $stat['value'] }}">0</span>{{ $stat['suffix'] }}
                        </div>
                        <div class="mt-1 text-xs text-gray-400">{{ $stat['label'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const section = document.getElementById('hero-carousel');
        const track = document.getElementById('hero-track');
        if (!section || !track) return;

        const slides = track.children;
        const total = slides.length;
        if (total === 0) return;

        const prevBtn = document.getElementById('hero-prev');
        const nextBtn = document.getElementById('hero-next');
        const dots = document.querySelectorAll('#hero-dots .hero-dot');

        let current = 0;
        let timer = null;
        const INTERVAL = 4000;

        function render() {
            track.style.transform = 'translateX(-' + (current * 100) + '%)';

            const bgs = section.querySelectorAll('.hero-bg');
            bgs.forEach((bg, b) => {
                bg.style.opacity = b === current ? '1' : '0';
            });

            for (let s = 0; s < total; s++) {
                slides[s].setAttribute('aria-hidden', s === current ? 'false' : 'true');
            }

            dots.forEach((dot, d) => {
                if (d === current) {
                    dot.className = 'hero-dot h-2 w-8 rounded-full bg-jkb-yellow transition-all';
                    dot.setAttribute('aria-current', 'true');
                } else {
                    dot.className = 'hero-dot h-2 w-2 rounded-full bg-white/30 transition-all hover:bg-white/60';
                    dot.removeAttribute('aria-current');
                }
            });
        }

        function goTo(index) {
            current = (index + total) % total;
            render();
            if (timer !== null) play();
        }

        function next() {
            goTo(current + 1);
        }

        function prev() {
            goTo(current - 1);
        }

        function play() {
            clearInterval(timer);
            timer = setInterval(next, INTERVAL);
        }

        function pause() {
            clearInterval(timer);
            timer = null;
        }

        if (prevBtn) prevBtn.addEventListener('click', prev);
        if (nextBtn) nextBtn.addEventListener('click', next);

        dots.forEach((dot) => {
            dot.addEventListener('click', function () {
                goTo(parseInt(dot.getAttribute('data-index'), 10) || 0);
            });
        });

        section.addEventListener('mouseenter', pause);
        section.addEventListener('mouseleave', play);

        render();
        play();
    });
    </script>

    {{-- KEUNGGULAN --}}
    <section class="relative overflow-hidden bg-white py-20">
        <div class="jkb-glow -left-24 top-24 h-80 w-80 bg-jkb-yellow/20"></div>
        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-section-heading
                eyebrow="Keunggulan JKB"
                title="Lima Jaminan yang Membuat Beton Kami Kokoh"
                description="Kualitas bukan janji kosong. Setiap jaminan kami wujudkan lewat proses yang terstandar, terukur, dan terverifikasi."
                :align="'center'"
            />

            <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-5">
                @php
                    $advantages = [
                        ['icon' => 'check-badge', 'title' => 'Jaminan Kualitas', 'desc' => 'Mutucertifikasi ISO 9001:2015, material teruji lab pada setiap batch.'],
                        ['icon' => 'shield-check', 'title' => 'Jaminan Material', 'desc' => 'Bahan baku berkualitas dengan grading yang konsisten.'],
                        ['icon' => 'map', 'title' => 'Jangkauan Luas', 'desc' => 'Melayani seluruh Jawa Tengah lewat 6 cabang & armada yang siap.'],
                        ['icon' => 'cog-6-tooth', 'title' => 'Jaminan Teknologi', 'desc' => 'Konfigurasi mix design presisi dengan peralatan modern.'],
                        ['icon' => 'truck', 'title' => 'Jaminan Armada', 'desc' => 'Armada mixer yang terawat dengan jarak tempuh termonitor GPS.'],
                    ];
                @endphp
                @foreach ($advantages as $i => $adv)
                    <div class="group jkb-reveal relative rounded-2xl glass p-6 ring-1 ring-white/60 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:ring-jkb-yellow/60 hover:shadow-[0_18px_44px_rgba(15,23,42,0.12)]">
                        <div class="grid h-12 w-12 place-items-center rounded-lg bg-jkb-yellow/15 text-jkb-gray-dark transition-colors group-hover:bg-jkb-yellow">
                            <x-dynamic-component :component="'heroicon-m-' . $adv['icon']" class="h-6 w-6" />
                        </div>
                        <h3 class="mt-5 text-base font-bold text-jkb-gray-dark">{{ $adv['title'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-jkb-gray">{{ $adv['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- TEPAT WAKTU / GPS --}}
    <section class="relative overflow-hidden bg-jkb-gray-light py-20">
        <div class="jkb-glow -right-28 top-16 h-96 w-96 bg-jkb-yellow/20"></div>
        <div class="jkb-glow -left-32 bottom-0 h-80 w-80 bg-white/40"></div>
        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid items-center gap-12 lg:grid-cols-2">
                <div>
                    <x-section-heading
                        eyebrow="Tepat Waktu"
                        title="“Tepat Waktu, Kunci Kekuatan Beton”"
                        description="Beton ready mix tidak bisa menunggu. Dengan sistem pelacakan dan koordinasi armada yang presisi, setiap kiriman tiba di lokasi proyek di waktu yang terjadwal."
                        :align="'left'"
                    />

                    <div class="mt-8 space-y-5">
                        @php
                            $items = [
                                ['icon' => 'paper-airplane', 'title' => 'GPS Tracking Real-Time', 'desc' => 'Setiap mixer dilacak posisinya sehingga estimasi kedatangan akurat.'],
                                ['icon' => 'building-library', 'title' => 'Control Room 24 Jam', 'desc' => 'Tim control room memantau dan mengoordinasi seluruh armada tanpa henti.'],
                                ['icon' => 'clipboard-document-check', 'title' => 'Koordinasi Armada', 'desc' => 'Penjadwalan pengiriman optimal agar tidak ada keterlambatan pengecoran.'],
                            ];
                        @endphp
                        @foreach ($items as $item)
                            <div class="flex gap-4">
                                <div class="grid h-11 w-11 shrink-0 place-items-center rounded-lg bg-jkb-navy text-jkb-yellow">
                                    <x-dynamic-component :component="'heroicon-m-' . $item['icon']" class="h-5 w-5" />
                                </div>
                                <div>
                                    <h3 class="font-bold text-jkb-gray-dark">{{ $item['title'] }}</h3>
                                    <p class="mt-1 text-sm text-jkb-gray">{{ $item['desc'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="relative">
                    <x-concrete-calculator />
                </div>
            </div>
        </div>
    </section>

    {{-- ISO --}}
    <section class="relative overflow-hidden bg-white py-16">
        <div class="jkb-glow -right-24 top-1/2 h-72 w-72 -translate-y-1/2 bg-jkb-yellow/15"></div>
        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="jkb-reveal flex flex-col items-center gap-8 rounded-2xl glass p-8 ring-1 ring-white/60 shadow-sm md:flex-row md:justify-between md:p-10">
                <div class="flex items-center gap-5">
                    <div class="grid h-16 w-16 shrink-0 place-items-center rounded-xl bg-jkb-navy">
                        <x-heroicon-m-check-badge class="h-9 w-9 text-jkb-yellow" />
                    </div>
                    <div>
                        <h3 class="text-xl font-black text-jkb-gray-dark">Sertifikasi ISO 9001:2015</h3>
                        <p class="mt-1 max-w-xl text-sm text-jkb-gray">
                            Sistem manajemen mutu kami telah tersertifikasi ISO 9001:2015 – bukti komitmen
                            konsistensi kualitas di setiap proses produksi dan pengiriman.
                        </p>
                    </div>
                </div>
                <a href="{{ route('about') }}" class="inline-flex shrink-0 items-center gap-2 rounded-full border-2 border-jkb-navy px-5 py-2.5 text-sm font-bold text-jkb-navy transition hover:bg-jkb-navy hover:text-jkb-yellow">
                    Tentang Kami
                    <x-heroicon-m-arrow-right class="h-4 w-4" />
                </a>
            </div>
        </div>
    </section>

    {{-- PENGALAMAN / KATEGORI PROYEK --}}
    <section class="relative overflow-hidden bg-jkb-navy py-20 text-white">
        <div class="jkb-glow -left-24 top-10 h-96 w-96 bg-jkb-yellow/10"></div>
        <div class="jkb-glow -right-24 bottom-0 h-80 w-80 bg-jkb-yellow/[0.06]"></div>
        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid items-end gap-8 lg:grid-cols-[1fr_auto]">
                <x-section-heading
                    eyebrow="Pengalaman"
                    title="Lebih Dari 40 Tahun Membangun Jawa Tengah"
                    description="Puluhan proyek telah kami dukung, dari skala komersial hingga infrastruktur vital."
                    :align="'left'"
                    :light="true"
                />
                <a href="{{ route('projects.index') }}" class="inline-flex shrink-0 items-center gap-2 rounded-full border border-white/25 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-white/10">
                    Lihat Semua Proyek
                    <x-heroicon-m-arrow-right class="h-4 w-4" />
                </a>
            </div>

            <div class="mt-12 grid gap-6 md:grid-cols-3">
                @php
                    $projectCats = [
                        ['label' => 'Komersial & Perumahan', 'icon' => 'building-storefront', 'desc' => 'Ruko, apartemen, gedung, dan perumahan.'],
                        ['label' => 'Industri', 'icon' => 'building-office-2', 'desc' => 'Pabrik, gudang, dan fasilitas produksi.'],
                        ['label' => 'Infrastruktur', 'icon' => 'rectangle-group', 'desc' => 'Jalan, jembatan, irigasi, dan drainase.'],
                    ];
                @endphp
                @foreach ($projectCats as $cat)
                    <div class="group jkb-reveal rounded-2xl glass-dark p-8 ring-1 ring-white/10 transition-all duration-300 hover:bg-white/[0.12] hover:ring-jkb-yellow/50">
                        <div class="grid h-14 w-14 place-items-center rounded-xl bg-jkb-yellow/15 text-jkb-yellow ring-1 ring-inset ring-jkb-yellow/30">
                            <x-dynamic-component :component="'heroicon-m-' . $cat['icon']" class="h-7 w-7" />
                        </div>
                        <h3 class="mt-6 text-xl font-bold">{{ $cat['label'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-gray-400">{{ $cat['desc'] }}</p>
                        <a href="{{ route('projects.index', ['kategori' => $cat['label']]) }}"
                            class="mt-5 inline-flex items-center gap-1.5 text-sm font-semibold text-jkb-yellow transition group-hover:gap-2.5">
                            Lihat Proyek
                            <x-heroicon-m-arrow-right class="h-4 w-4" />
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- PRODUK PILIHAN --}}
    <section class="relative overflow-hidden bg-white py-20">
        <div class="jkb-glow -right-32 top-24 h-96 w-96 bg-jkb-yellow/15"></div>
        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid items-end gap-8 lg:grid-cols-[1fr_auto]">
                <x-section-heading
                    eyebrow="Produk Pilihan"
                    title="Produk Unggulan Kami"
                    description="Kategori produk utama yang paling sering digunakan untuk berbagai jenis proyek."
                    :align="'left'"
                />
                <a href="{{ route('products.index') }}" class="inline-flex shrink-0 items-center gap-2 rounded-full border-2 border-jkb-navy px-5 py-2.5 text-sm font-bold text-jkb-navy transition hover:bg-jkb-navy hover:text-jkb-yellow">
                    Semua Produk
                    <x-heroicon-m-arrow-right class="h-4 w-4" />
                </a>
            </div>

            @if ($categories->isNotEmpty())
                <div class="mt-12 grid gap-6 md:grid-cols-3">
                    @foreach ($categories as $category)
                        <div class="group jkb-reveal flex flex-col overflow-hidden rounded-2xl glass ring-1 ring-white/60 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_18px_44px_rgba(15,23,42,0.15)]">
                            <a href="{{ route('products.category', $category) }}" class="relative block aspect-[16/11] overflow-hidden bg-jkb-gray-light">
                                @if ($category->image)
                                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" loading="lazy"
                                        class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105">
                                @else
                                    <div class="grid h-full w-full place-items-center bg-gradient-to-br from-jkb-yellow/25 to-jkb-gray-light">
                                        <x-dynamic-component :component="'heroicon-m-' . ($category->icon ?: 'cube')" class="h-16 w-16 text-jkb-gray" />
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-jkb-navy/70 via-transparent to-transparent"></div>
                                <h3 class="absolute bottom-4 left-5 right-5 text-xl font-black text-white">{{ $category->name }}</h3>
                            </a>

                            <div class="flex flex-1 flex-col p-5">
                                <p class="flex-1 text-sm leading-relaxed text-jkb-gray">
                                    {{ $category->short_description ?: $category->description }}
                                </p>
                                <div class="mt-4 flex items-center gap-3 border-t border-jkb-gray-light pt-4">
                                    <a href="{{ route('products.category', $category) }}"
                                        class="inline-flex flex-1 items-center justify-center gap-1 rounded-full border border-jkb-gray-dark px-3 py-2 text-xs font-bold text-jkb-gray-dark transition hover:bg-jkb-navy hover:text-white">
                                        Detail Produk
                                    </a>
                                    <a href="{{ jkb_whatsapp_link('Halo JKB, saya ingin bertanya tentang ' . $category->name . '.') }}"
                                        target="_blank" rel="noopener"
                                        class="btn-jkb-pill inline-flex flex-1 items-center justify-center gap-1 px-3 py-2 text-xs">
                                        <x-heroicon-m-chat-bubble-left-right class="h-3.5 w-3.5" />
                                        Hubungi Kami
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            @if ($featuredProducts->isNotEmpty())
                <div class="mt-10">
                    <h3 class="text-center text-lg font-bold text-jkb-gray-dark">Atau pilih langsung dari produk favorit</h3>
                    <div class="mt-6 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ($featuredProducts as $product)
                            <x-product-card :product="$product" />
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>

    {{-- CABANG --}}
    <section class="relative overflow-hidden bg-jkb-gray-light py-20">
        <div class="jkb-glow -left-28 top-20 h-96 w-96 bg-jkb-yellow/20"></div>
        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-section-heading
                eyebrow="Jangkauan Kami"
                title="Sebaran Cabang di Jawa Tengah"
                description="Lokasi batching plant strategis agar pengiriman lebih cepat dan biaya logistik lebih efisien."
                :align="'center'"
            />

            @php
                $coordFallback = [
                    'ungaran' => [-7.1456, 110.4311],
                    'boyolali' => [-7.5273, 110.5927],
                    'pemalang' => [-6.8896, 109.3857],
                    'pekalongan' => [-6.8890, 109.6789],
                    'batang' => [-6.9019, 109.7293],
                    'semarang' => [-6.9915, 110.4206],
                ];
                $mapBranches = $branches->map(function ($branch) use ($coordFallback) {
                    $lat = $branch->latitude;
                    $lng = $branch->longitude;

                    if ($lat === null || $lng === null) {
                        $fallback = null;
                        foreach ($coordFallback as $key => $coord) {
                            if (str_contains(strtolower($branch->name), $key)) {
                                $fallback = $coord;
                                break;
                            }
                        }
                        $lat = $fallback[0] ?? -7.15;
                        $lng = $fallback[1] ?? 110.0;
                    }

                    return [
                        'name' => $branch->name,
                        'type' => $branch->type,
                        'address' => $branch->address,
                        'lat' => (float) $lat,
                        'lng' => (float) $lng,
                    ];
                })->values();
            @endphp

            <div class="mt-12 grid items-start gap-8 lg:grid-cols-[1.2fr_1fr]">
                <div class="relative z-0 h-[400px] overflow-hidden rounded-2xl bg-jkb-navy shadow-sm ring-1 ring-white/60 sm:h-[460px] lg:h-[500px]">
                    <div id="home-branch-map" class="jkb-map-container relative h-full w-full"
                        data-markers='{{ $mapBranches->toJson() }}'>
                        <div class="jkb-map-overlay"></div>
                    </div>
                </div>

                {{-- 5 card penuh (ikon 44px + p-4 + baris link maps) + 5 celah 16px, potongan jatuh di celah antar card --}}
                <div class="jkb-scroll-fade flex flex-col gap-4 lg:max-h-[calc(5*var(--jkb-item)_+_5*var(--jkb-gap))] lg:overflow-y-auto lg:pr-1"
                    style="--jkb-item:100px; --jkb-gap:16px;">
                    @foreach ($branches as $branch)
                        <div data-map-index="{{ $loop->index }}" role="button" tabindex="0"
                            class="group flex cursor-pointer items-center gap-4 rounded-xl glass p-4 ring-1 ring-white/60 shadow-sm transition hover:ring-jkb-yellow/60 hover:shadow-[0_12px_32px_rgba(15,23,42,0.10)]">
                            <div class="grid h-11 w-11 shrink-0 place-items-center rounded-lg bg-jkb-gray-light text-jkb-gray-dark transition-colors group-hover:bg-jkb-yellow">
                                <x-heroicon-m-map-pin class="h-5 w-5" />
                            </div>
                            <div class="min-w-0">
                                <div class="flex items-center gap-2">
                                    <span class="font-bold text-jkb-gray-dark">{{ $branch->name }}</span>
                                    <span class="rounded bg-jkb-gray-light px-1.5 py-0.5 text-[0.6rem] font-bold uppercase text-jkb-gray">
                                        {{ $branch->type }}
                                    </span>
                                </div>
                                <p class="truncate text-xs text-jkb-gray">{{ $branch->address }}</p>
                                <a href="https://www.google.com/maps?q={{ $mapBranches[$loop->index]['lat'] }},{{ $mapBranches[$loop->index]['lng'] }}"
                                    target="_blank" rel="noopener"
                                    class="mt-1.5 inline-flex items-center gap-1 rounded-full bg-jkb-yellow px-2.5 py-1 text-[0.7rem] font-bold uppercase tracking-wide text-jkb-navy transition hover:bg-jkb-yellow/80">
                                    <x-heroicon-m-arrow-top-right-on-square class="h-3.5 w-3.5" />
                                    Buka di Google Maps
                                </a>
                            </div>
                            <x-heroicon-m-chevron-right class="ml-auto h-5 w-5 shrink-0 text-jkb-gray transition-transform group-hover:translate-x-1 group-hover:text-jkb-gray-dark" />
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- KLIEN & MITRA --}}
    @if ($clients->isNotEmpty())
        <section class="relative overflow-hidden bg-white py-16">
            <div class="jkb-glow -right-24 top-10 h-72 w-72 bg-jkb-yellow/15"></div>
            <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <x-section-heading
                    eyebrow="Klien & Mitra"
                    title="Dipercaya Perusahaan Ternama"
                    :align="'center'"
                />
                <div class="mt-10 grid grid-cols-2 items-center gap-6 sm:grid-cols-3 lg:grid-cols-6">
                    @foreach ($clients as $client)
                        <div class="grid h-20 place-items-center rounded-xl glass ring-1 ring-white/60 grayscale transition-all hover:ring-jkb-yellow/60 hover:grayscale-0">
                            @if ($client->logo)
                                <img src="{{ asset('storage/' . $client->logo) }}" alt="{{ $client->name }}" loading="lazy" class="max-h-12 object-contain">
                            @else
                                <span class="px-3 text-center text-xs font-bold text-jkb-gray">{{ $client->name }}</span>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- TESTIMONI --}}
    @if ($testimonials->isNotEmpty())
        <section class="bg-jkb-navy py-20 text-white">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <x-section-heading
                    eyebrow="Testimoni"
                    title="Kata Mereka Tentang JKB"
                    :align="'center'"
                    :light="true"
                />
                <div class="mt-12 grid gap-6 md:grid-cols-3">
                    @foreach ($testimonials as $testimonial)
                        <figure class="jkb-reveal flex flex-col rounded-2xl glass-dark p-6 ring-1 ring-white/15">
                            <div class="flex text-jkb-yellow">
                                @for ($i = 1; $i <= 5; $i++)
                                    <x-heroicon-m-star class="h-4 w-4 {{ $i <= $testimonial->rating ? '' : 'opacity-25' }}" />
                                @endfor
                            </div>
                            <blockquote class="mt-4 flex-1 text-sm leading-relaxed text-gray-300">
                                &ldquo;{{ $testimonial->content }}&rdquo;
                            </blockquote>
                            <figcaption class="mt-5 flex items-center gap-3 border-t border-white/10 pt-4">
                                @if ($testimonial->image)
                                    <img src="{{ asset('storage/' . $testimonial->image) }}" alt="{{ $testimonial->client_name }}"
                                        class="h-11 w-11 shrink-0 rounded-full object-cover ring-2 ring-jkb-yellow/60">
                                @endif
                                <div>
                                    <div class="font-bold text-white">{{ $testimonial->client_name }}</div>
                                    @if ($testimonial->company)
                                        <div class="text-xs text-gray-400">{{ $testimonial->position ? $testimonial->position . ', ' : '' }}{{ $testimonial->company }}</div>
                                    @endif
                                </div>
                            </figcaption>
                        </figure>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- CTA BOTTOM --}}
    <section class="bg-jkb-yellow">
        <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-6 px-4 py-12 text-center sm:px-6 lg:flex-row lg:px-8 lg:text-left">
            <div>
                <h2 class="text-2xl font-black text-jkb-navy sm:text-3xl">Butuh penawaran harga beton hari ini?</h2>
                <p class="mt-2 text-jkb-gray-dark">Tim kami siap membantu Anda menghitung kebutuhan material proyek secara gratis.</p>
            </div>
            <div class="flex flex-wrap items-center justify-center gap-4">
                <a href="{{ jkb_whatsapp_link('Halo JKB, saya ingin penawaran harga beton untuk proyek saya.') }}" target="_blank" rel="noopener"
                    class="btn-jkb-pill px-6 py-3 text-sm sm:text-base">
                    <x-heroicon-m-chat-bubble-left-right class="h-5 w-5" />
                    Konsultasi Gratis via WhatsApp
                </a>
                <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 rounded-full border-2 border-jkb-navy px-6 py-3 text-sm font-bold text-jkb-navy transition hover:bg-jkb-navy/5 sm:text-base">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </section>

    @push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const mapEl = document.getElementById('home-branch-map');
        if (!mapEl || typeof L === 'undefined') return;

        let markersData = [];
        try {
            markersData = JSON.parse(mapEl.getAttribute('data-markers') || '[]');
        } catch (e) {
            markersData = [];
        }
        if (!markersData.length) return;

        const pinIcon = L.divIcon({
            className: 'jkb-map-pin-wrap',
            html: '<div class="jkb-map-pin"><span class="jkb-map-pin-ring"></span><span class="jkb-map-pin-ring"></span></div>',
            iconSize: [16, 16],
            iconAnchor: [8, 8],
            popupAnchor: [0, -22],
        });

        const map = L.map(mapEl, { zoomControl: true, minZoom: 4 });

        L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
            maxZoom: 19,
            minZoom: 4,
            subdomains: 'abcd',
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> &copy; <a href="https://carto.com/attributions">CARTO</a>',
        }).addTo(map);

        const markers = markersData.map(function (m) {
            const marker = L.marker([m.lat, m.lng], { icon: pinIcon, riseOnHover: true }).addTo(map);
            marker.bindPopup(
                '<div class="jkb-map-tooltip-title">' + m.name + '</div>' +
                '<div class="mt-1 flex items-center gap-1.5">' +
                    '<span class="jkb-map-live-dot"></span>' +
                    '<span class="jkb-map-live-label">Cabang Aktif</span>' +
                    '<span class="jkb-map-tooltip-type">' + m.type + '</span>' +
                '</div>' +
                '<div class="jkb-map-tooltip-addr">' + m.address + '</div>' +
                '<a class="jkb-map-tooltip-link" href="https://www.google.com/maps?q=' + m.lat + ',' + m.lng + '" target="_blank" rel="noopener">' +
                    '<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15 3h6v6"/><path d="M10 14 21 3"/><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/></svg>' +
                    'Buka di Google Maps' +
                '</a>',
                { className: 'jkb-map-popup', offset: [0, -16] }
            );
            return Object.assign({}, m, { marker: marker });
        });

        if (markers.length === 1) {
            map.setView([markers[0].lat, markers[0].lng], 12);
        } else {
            try {
                map.fitBounds(L.featureGroup(markers.map(function (i) { return i.marker; })).getBounds(), {
                    padding: [48, 48],
                    maxZoom: 11,
                });
            } catch (e) {
                map.setView([-7.15, 110.0], 9);
            }
        }

        setTimeout(function () { map.invalidateSize(); }, 250);

        let resizeT;
        window.addEventListener('resize', function () {
            clearTimeout(resizeT);
            resizeT = setTimeout(function () { map.invalidateSize(); }, 150);
        });

        if (window.ResizeObserver) {
            const ro = new ResizeObserver(function () { map.invalidateSize(); });
            ro.observe(mapEl);
        }

        document.querySelectorAll('[data-map-index]').forEach(function (card) {
            card.addEventListener('click', function (e) {
                if (e.target.closest('a[href]')) return;
                e.preventDefault();

                document.querySelectorAll('[data-map-index]').forEach(function (c) {
                    c.classList.remove('ring-2', 'ring-jkb-yellow', 'shadow-md');
                });
                card.classList.add('ring-2', 'ring-jkb-yellow', 'shadow-md');

                const item = markers[parseInt(card.getAttribute('data-map-index'), 10)];
                if (!item) return;

                const target = [item.lat, item.lng];
                const current = map.getCenter();
                const moved = Math.abs(current.lat - target[0]) + Math.abs(current.lng - target[1]) > 0.0001;

                if (moved) {
                    map.once('moveend', function () { item.marker.openPopup(); });
                    map.flyTo(target, Math.max(map.getZoom(), 12), { duration: 1, easeLinearity: 0.15 });
                } else {
                    item.marker.openPopup();
                }
            });
            card.addEventListener('keydown', function (e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    card.click();
                }
            });
        });
    });
    </script>
    @endpush
</x-layouts.app>