<x-layouts.app>
    @section('title', 'Lowongan Kerja – Karir di JKB')
    @section('meta_description', 'Bergabung bersama CV Jati Kencana Beton (JKB). Lihat lowongan pekerjaan terbaru dan mulai karier Anda di industri beton Jawa Tengah.')

    <x-page-hero
        title="Karir"
        eyebrow="Karir"
        description="Batu bata per karier — bergabunglah bersama tim JKB dan bangun masa depan dalam industri beton yang terus bertumbuh."
    />

    <section class="bg-jkb-gray-light py-16">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            @if ($careers->isEmpty())
                <div class="py-20 text-center">
                    <x-heroicon-m-briefcase class="mx-auto h-12 w-12 text-jkb-yellow-dark" />
                    <h2 class="mt-4 text-xl font-black text-jkb-gray-dark">Belum Ada Lowongan Terbuka</h2>
                    <p class="mt-2 text-sm text-jkb-gray">Saat ini kami belum membuka lowongan. Silakan kirim lamaran spontan melalui halaman kontak, atau pantau halaman ini secara berkala.</p>
                </div>
            @else
                <div class="space-y-5">
                    @foreach ($careers as $career)
                        <article class="jkb-reveal flex flex-col gap-4 rounded-2xl glass p-6 ring-1 ring-white/60 shadow-sm transition-all duration-300 hover:shadow-[0_18px_44px_rgba(15,23,42,0.15)] sm:flex-row sm:items-center sm:justify-between">
                            <div>
                                <h2 class="text-lg font-black text-jkb-gray-dark">
                                    <a href="{{ route('careers.show', $career) }}" class="hover:text-jkb-yellow-dark">{{ $career->title }}</a>
                                </h2>
                                <div class="mt-2 flex flex-wrap gap-x-4 gap-y-1 text-xs font-medium text-jkb-gray">
                                    <span class="inline-flex items-center gap-1"><x-heroicon-m-map-pin class="h-3.5 w-3.5" /> {{ $career->location ?: 'Jawa Tengah' }}</span>
                                    @if ($career->employment_type)
                                        <span class="inline-flex items-center gap-1"><x-heroicon-m-identification class="h-3.5 w-3.5" /> {{ $career->employment_type }}</span>
                                    @endif
                                    @if ($career->salary_range)
                                        <span class="inline-flex items-center gap-1"><x-heroicon-m-banknotes class="h-3.5 w-3.5" /> {{ $career->salary_range }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="flex shrink-0 items-center gap-3">
                                @if ($career->application_deadline)
                                    <span class="text-xs font-medium text-jkb-gray">Ditutup: {{ $career->application_deadline->format('d M Y') }}</span>
                                @endif
                                <a href="{{ route('careers.show', $career) }}" class="inline-flex items-center gap-1.5 rounded-lg bg-jkb-navy px-5 py-2.5 text-sm font-bold text-white transition-colors hover:bg-jkb-gray-dark">
                                    Detail <x-heroicon-m-arrow-right class="h-4 w-4" />
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif

            <div class="mt-12 rounded-xl border border-jkb-gray-light bg-jkb-navy p-8 text-white">
                <h2 class="text-lg font-black">Tidak menemukan posisi yang sesuai?</h2>
                <p class="mt-2 text-sm leading-relaxed text-gray-300">JKB selalu terbuka untuk talenta terbaik. Kirimkan CV Anda melalui WhatsApp atau email dan tim HRD kami akan menghubungi Anda bila ada posisi yang cocok.</p>
                <a href="{{ route('contact') }}" class="mt-5 inline-flex items-center gap-2 rounded-lg bg-jkb-yellow px-6 py-3 text-sm font-bold text-jkb-navy transition-colors hover:bg-jkb-yellow-dark">
                    <x-heroicon-m-paper-airplane class="h-5 w-5" /> Kirim Lamaran Spontan
                </a>
            </div>
        </div>
    </section>
</x-layouts.app>