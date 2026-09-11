<x-layouts.app>
    @section('title', $career->title . ' – Karir di JKB')
    @section('meta_description', 'Lowongan ' . $career->title . ' di CV Jati Kencana Beton (JKB). ' . ($career->location ?: 'Lokasi Jawa Tengah') . '.')

    <x-page-hero
        :title="$career->title"
        :eyebrow="'Karir · ' . ($career->employment_type ?: 'Lowongan')"
    />

    <section class="relative overflow-hidden bg-white py-16">
        <div class="jkb-glow -right-32 top-24 h-96 w-96 bg-jkb-yellow/15"></div>
        <div class="relative mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <nav class="flex flex-wrap items-center gap-1.5 text-xs font-medium text-jkb-gray">
                <a href="{{ route('careers.index') }}" class="hover:text-jkb-yellow-dark">Karir</a>
                <x-heroicon-m-chevron-right class="h-3.5 w-3.5" />
                <span class="text-jkb-gray-dark">{{ $career->title }}</span>
            </nav>

            <div class="mt-6 grid gap-4 sm:grid-cols-3">
                @if ($career->location)
                    <div class="rounded-xl glass p-5 ring-1 ring-white/60 shadow-sm">
                        <x-heroicon-m-map-pin class="h-5 w-5 text-jkb-yellow-dark" />
                        <p class="mt-2 text-xs font-semibold text-jkb-gray">Lokasi</p>
                        <p class="font-bold text-jkb-gray-dark">{{ $career->location }}</p>
                    </div>
                @endif
                @if ($career->employment_type)
                    <div class="rounded-xl glass p-5 ring-1 ring-white/60 shadow-sm">
                        <x-heroicon-m-identification class="h-5 w-5 text-jkb-yellow-dark" />
                        <p class="mt-2 text-xs font-semibold text-jkb-gray">Jenis Pekerjaan</p>
                        <p class="font-bold text-jkb-gray-dark">{{ $career->employment_type }}</p>
                    </div>
                @endif
                @if ($career->application_deadline)
                    <div class="rounded-xl glass p-5 ring-1 ring-white/60 shadow-sm">
                        <x-heroicon-m-calendar-days class="h-5 w-5 text-jkb-yellow-dark" />
                        <p class="mt-2 text-xs font-semibold text-jkb-gray">Batas Lamaran</p>
                        <p class="font-bold text-jkb-gray-dark">{{ $career->application_deadline->format('d M Y') }}</p>
                    </div>
                @endif
            </div>

            @if ($career->description)
                <h2 class="mt-10 text-xl font-black text-jkb-gray-dark">Deskripsi Pekerjaan</h2>
                <div class="mt-3 prose prose-sm prose-gray max-w-none leading-relaxed text-jkb-gray sm:prose-base">
                    {!! $career->description !!}
                </div>
            @endif

            @if (!empty($career->requirements_list))
                <h2 class="mt-10 text-xl font-black text-jkb-gray-dark">Persyaratan</h2>
                <ul class="mt-3 space-y-2 text-sm leading-relaxed text-jkb-gray">
                    @foreach ($career->requirements_list as $req)
                        <li class="flex gap-2"><x-heroicon-m-check-circle class="mt-0.5 h-4 w-4 shrink-0 text-jkb-yellow" /> {{ $req }}</li>
                    @endforeach
                </ul>
            @endif

            <div class="mt-12 rounded-xl border border-jkb-gray-light bg-jkb-navy p-8 text-white">
                <h2 class="text-xl font-black">Tertarik Melamar?</h2>
                <p class="mt-2 text-sm leading-relaxed text-gray-300">Kirimkan CV dan surat lamaran Anda melalui WhatsApp atau email kami dengan menyertakan judul posisi pada subjek pesan.</p>
                <div class="mt-5 flex flex-wrap gap-3">
                    <a href="{{ jkb_whatsapp_link('Lamaran: ' . $career->title) }}" target="_blank" rel="noopener" class="btn-jkb-pill px-6 py-3 text-sm">
                        <x-heroicon-m-phone class="h-5 w-5" /> Lamar via WhatsApp
                    </a>
                    <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 rounded-full bg-white/10 px-6 py-3 text-sm font-bold text-white transition-colors hover:bg-white/20">
                        <x-heroicon-m-paper-airplane class="h-5 w-5" /> Hubungi Kami
                    </a>
                </div>
            </div>

            @if ($otherCareers->isNotEmpty())
                <div class="mt-14 border-t border-jkb-gray-light pt-10">
                    <h2 class="text-xl font-black text-jkb-gray-dark">Lowongan Lainnya</h2>
                    <div class="mt-5 space-y-4">
                        @foreach ($otherCareers as $oc)
                            <a href="{{ route('careers.show', $oc) }}" class="jkb-reveal flex items-center justify-between rounded-xl glass p-5 shadow-sm ring-1 ring-white/60 transition-all hover:ring-jkb-yellow/60 hover:shadow-[0_12px_32px_rgba(15,23,42,0.12)]">
                                <span class="font-bold text-jkb-gray-dark">{{ $oc->title }}</span>
                                <x-heroicon-m-arrow-right class="h-5 w-5 text-jkb-yellow-dark" />
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>
</x-layouts.app>