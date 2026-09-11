<x-layouts.app>
    @section('title', 'Tentang Kami – JKB Kokoh Berkualitas')
    @section('meta_description', 'Sejarah CV Jati Kencana Beton (JKB) sejak 1980, visi misi, dan sertifikasi ISO 9001:2015 sebagai produsen beton siap pakai di Jawa Tengah.')

    <x-page-hero
        title="Tentang Kami"
        eyebrow="Tentang Kami"
        description="Perjalanan lebih dari empat dekade CV Jati Kencana Beton membangun kepercayaan lewat kualitas beton yang kokoh dan pelayanan yang tepat waktu."
    />

    <section class="bg-white py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid items-start gap-12 lg:grid-cols-2">
                <div>
                    <x-section-heading
                        eyebrow="Sejarah"
                        title="Berdiri Sejak 1980"
                        :align="'left'"
                    />
                    <div class="mt-6 space-y-4 text-base leading-relaxed text-jkb-gray">
                        <p>
                            <strong class="text-jkb-gray-dark">CV Jati Kencana Beton (JKB)</strong> berdiri sejak tahun 1980 di Jawa Tengah.
                            Bermula dari unit usaha material galian dan batu pecah, perusahaan tumbuh menjadi produsen
                            beton siap pakai (ready mix), beton pracetak/precast, dan material split terpercaya.
                        </p>
                        <p>
                            Selama lebih dari cukup 40 tahun, JKB telah mendukung ribuan proyek — dari pembangunan
                            rumah dan kawasan perumahan, fasilitas industri, hingga infrastruktur vital seperti jalan,
                            jembatan, dan irigasi.
                        </p>
                        <p>
                            Dengan komitmen berkelanjutan terhadap mutu, seluruh proses produksi kami berpedoman pada
                            sistem manajemen mutu <strong class="text-jkb-gray-dark">ISO 9001:2015</strong> untuk memastikan setiap meter kubik beton
                            yang kami kirim memenuhi spesifikasi yang dijanjikan.
                        </p>
                    </div>

                    <div class="mt-8 grid grid-cols-3 gap-4">
                        <div class="rounded-xl glass p-5 text-center ring-1 ring-white/60">
                            <div class="text-3xl font-black text-jkb-gray-dark">1980</div>
                            <div class="mt-1 text-xs font-semibold text-jkb-gray">Tahun Berdiri</div>
                        </div>
                        <div class="rounded-xl bg-jkb-yellow/25 p-5 text-center ring-1 ring-jkb-yellow/30">
                            <div class="text-3xl font-black text-jkb-gray-dark">{{ $yearsInBusiness }}+</div>
                            <div class="mt-1 text-xs font-semibold text-jkb-gray">Tahun Pengalaman</div>
                        </div>
                        <div class="rounded-xl glass p-5 text-center ring-1 ring-white/60">
                            <div class="text-3xl font-black text-jkb-gray-dark">{{ $projectCount }}+</div>
                            <div class="mt-1 text-xs font-semibold text-jkb-gray">Proyek Terselesaikan</div>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="jkb-reveal rounded-2xl glass p-7 ring-1 ring-white/60 shadow-sm">
                        <div class="grid h-12 w-12 place-items-center rounded-lg bg-jkb-yellow">
                            <x-heroicon-m-bolt class="h-6 w-6 text-jkb-navy" />
                        </div>
                        <h3 class="mt-5 text-lg font-bold text-jkb-gray-dark">Visi</h3>
                        <p class="mt-2 text-sm leading-relaxed text-jkb-gray">
                            Menjadi produsen beton dan material konstruksi yang paling dipercaya di Jawa Tengah
                            dengan menjunjung tinggi mutu, ketepatan waktu, dan inovasi teknologi.
                        </p>
                    </div>

                    <div class="jkb-reveal rounded-2xl glass p-7 ring-1 ring-white/60 shadow-sm">
                        <div class="grid h-12 w-12 place-items-center rounded-lg bg-jkb-yellow">
                            <x-heroicon-m-flag class="h-6 w-6 text-jkb-navy" />
                        </div>
                        <h3 class="mt-5 text-lg font-bold text-jkb-gray-dark">Misi</h3>
                        <ul class="mt-3 space-y-2 text-sm leading-relaxed text-jkb-gray">
                            <li class="flex gap-2"><x-heroicon-m-check-circle class="mt-0.5 h-4 w-4 shrink-0 text-jkb-yellow" /> Menghadirkan produk beton berkualitas yang kokoh dan tahan lama.</li>
                            <li class="flex gap-2"><x-heroicon-m-check-circle class="mt-0.5 h-4 w-4 shrink-0 text-jkb-yellow" /> Memastikan ketepatan waktu pengiriman melalui teknologi pemantauan armada.</li>
                            <li class="flex gap-2"><x-heroicon-m-check-circle class="mt-0.5 h-4 w-4 shrink-0 text-jkb-yellow" /> Mengembangkan kapasitas produksi dan jaringan distribusi di seluruh Jawa Tengah.</li>
                            <li class="flex gap-2"><x-heroicon-m-check-circle class="mt-0.5 h-4 w-4 shrink-0 text-jkb-yellow" /> Membina tenaga kerja profesional dan bermitra dengan masyarakat sekitar.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="relative overflow-hidden bg-jkb-gray-light py-16">
        <div class="jkb-glow -right-28 top-16 h-96 w-96 bg-jkb-yellow/15"></div>
        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-section-heading
                eyebrow="Sertifikasi"
                title="Mutu yang Terverifikasi"
                description="Komitmen kualitas bukan sekadar slogan — kami buktikan dengan standar manajemen mutu bersertifikat internasional."
                :align="'center'"
            />
            <div class="mt-10 grid gap-6 md:grid-cols-3">
                @php
                    $cert = [
                        ['icon' => 'shield-check', 'title' => 'ISO 9001:2015', 'desc' => 'Sistem manajemen mutu untuk konsistensi kualitas di seluruh lini produksi.'],
                        ['icon' => 'beaker', 'title' => 'Uji Material Terpadu', 'desc' => 'Pengujian kuat tekan dan slump dilakukan di laboratorium internal secara berkala.'],
                        ['icon' => 'wrench-screwdriver', 'title' => 'Teknisi Tersertifikasi', 'desc' => 'Tim quality control dan teknisi batching plant yang profesional dan berpengalaman.'],
                    ];
                @endphp
                @foreach ($cert as $item)
                    <div class="jkb-reveal rounded-2xl glass p-7 ring-1 ring-white/60 shadow-sm">
                        <div class="grid h-12 w-12 place-items-center rounded-lg bg-jkb-navy text-jkb-yellow">
                            <x-dynamic-component :component="'heroicon-m-' . $item['icon']" class="h-6 w-6" />
                        </div>
                        <h3 class="mt-5 text-lg font-bold text-jkb-gray-dark">{{ $item['title'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-jkb-gray">{{ $item['desc'] }}</p>
                    </div>
                @endforeach
            </div>
            <div class="mt-10 flex justify-center">
                <div class="w-64 overflow-hidden rounded-xl glass p-4 ring-1 ring-white/60 shadow-sm">
                    <img src="{{ asset('images/iso-jkb.webp') }}" alt="Sertifikat ISO 9001:2015" loading="lazy" class="w-full object-contain">
                    <p class="mt-3 text-center text-xs font-semibold text-jkb-gray">Sertifikat ISO 9001:2015</p>
                </div>
            </div>
        </div>
    </section>

    @if ($projectCategories->isNotEmpty())
        <section class="bg-jkb-navy py-16 text-white">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <x-section-heading
                    eyebrow="Fokus Kami"
                    title="Segmen Proyek yang Kami Layani"
                    :align="'center'"
                    :light="true"
                />
                <div class="mt-10 grid gap-5 sm:grid-cols-3">
                    @foreach ($projectCategories as $pc)
                        <div class="jkb-reveal rounded-2xl glass-dark p-6 text-center ring-1 ring-white/10">
                            <div class="text-4xl font-black text-jkb-yellow">{{ $pc->total }}</div>
                            <div class="mt-2 font-semibold text-white">{{ $pc->category }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if ($clients->isNotEmpty())
        <section class="relative overflow-hidden bg-white py-16">
            <div class="jkb-glow -left-24 top-10 h-72 w-72 bg-jkb-yellow/15"></div>
            <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <x-section-heading eyebrow="Klien & Mitra" title="Dipercaya Banyak Perusahaan" :align="'center'" />
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
</x-layouts.app>