<x-layouts.app>
    @section('title', 'Kontak Kami – JKB Kokoh Berkualitas')
    @section('meta_description', 'Hubungi CV Jati Kencana Beton (JKB). Semua cabang di Jawa Tengah melayani pemesanan beton ready mix, precast, dan material split.')

    <x-page-hero
        title="Kontak Kami"
        eyebrow="Kontak"
        description="Pemohon penawaran, pertanyaan teknis, maupun kerja sama — tim JKB siap membantu Anda."
    />

    <section class="relative overflow-hidden bg-white py-16">
        <div class="jkb-glow -right-32 top-20 h-96 w-96 bg-jkb-yellow/15"></div>
        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-10 lg:grid-cols-5">
                <div class="lg:col-span-3">
                    @if (session('success'))
                        <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 6000)" class="mb-6 flex items-start justify-between gap-3 rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-800">
                            <span class="flex items-center gap-2">
                                <x-heroicon-m-check-circle class="h-5 w-5 shrink-0" />
                                {{ session('success') }}
                            </span>
                            <button type="button" @click="show = false" class="shrink-0 text-green-600 hover:text-green-900" aria-label="Tutup">
                                <x-heroicon-m-x-mark class="h-5 w-5" />
                            </button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4">
                            <p class="flex items-center gap-2 text-sm font-semibold text-red-800">
                                <x-heroicon-m-exclamation-triangle class="h-5 w-5" /> Mohon periksa kembali isian Anda.
                            </p>
                            <ul class="mt-2 list-inside list-disc space-y-1 text-xs text-red-700">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="jkb-reveal rounded-xl glass p-6 shadow-sm ring-1 ring-white/60 sm:p-8">
                        <h2 class="text-xl font-black text-jkb-gray-dark">Kirim Pesan</h2>
                        <p class="mt-1 text-sm text-jkb-gray">Isi formulir berikut, kami akan merespons maksimal 1x24 jam kerja.</p>

                        <form method="POST" action="{{ route('contact.submit') }}" class="mt-6 grid gap-5 sm:grid-cols-2">
                            @csrf
                            <div>
                                <label for="name" class="mb-1.5 block text-sm font-semibold text-jkb-gray-dark">Nama Lengkap <span class="text-red-500">*</span></label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" required maxlength="120" placeholder="Nama Anda"
                                    class="w-full rounded-lg border border-jkb-gray-light bg-jkb-gray-light/40 px-4 py-2.5 text-sm text-jkb-gray-dark outline-none transition-colors focus:border-jkb-yellow-dark focus:bg-white">
                            </div>
                            <div>
                                <label for="email" class="mb-1.5 block text-sm font-semibold text-jkb-gray-dark">Email <span class="text-red-500">*</span></label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" required maxlength="160" placeholder="nama@perusahaan.com"
                                    class="w-full rounded-lg border border-jkb-gray-light bg-jkb-gray-light/40 px-4 py-2.5 text-sm text-jkb-gray-dark outline-none transition-colors focus:border-jkb-yellow-dark focus:bg-white">
                            </div>
                            <div>
                                <label for="phone" class="mb-1.5 block text-sm font-semibold text-jkb-gray-dark">WhatsApp / Telepon</label>
                                <input type="text" id="phone" name="phone" value="{{ old('phone') }}" maxlength="32" placeholder="08xxxxxxxxxx"
                                    class="w-full rounded-lg border border-jkb-gray-light bg-jkb-gray-light/40 px-4 py-2.5 text-sm text-jkb-gray-dark outline-none transition-colors focus:border-jkb-yellow-dark focus:bg-white">
                            </div>
                            <div>
                                <label for="subject" class="mb-1.5 block text-sm font-semibold text-jkb-gray-dark">Perihal</label>
                                <input type="text" id="subject" name="subject" value="{{ old('subject') }}" maxlength="160" placeholder="Contoh: Permintaan penawaran"
                                    class="w-full rounded-lg border border-jkb-gray-light bg-jkb-gray-light/40 px-4 py-2.5 text-sm text-jkb-gray-dark outline-none transition-colors focus:border-jkb-yellow-dark focus:bg-white">
                            </div>
                            <div class="sm:col-span-2">
                                <label for="message" class="mb-1.5 block text-sm font-semibold text-jkb-gray-dark">Pesan <span class="text-red-500">*</span></label>
                                <textarea id="message" name="message" rows="6" required maxlength="5000" placeholder="Tulis kebutuhan, spesifikasi, volume, atau lokasi proyek Anda..."
                                    class="w-full rounded-lg border border-jkb-gray-light bg-jkb-gray-light/40 px-4 py-2.5 text-sm text-jkb-gray-dark outline-none transition-colors focus:border-jkb-yellow-dark focus:bg-white">{{ old('message') }}</textarea>
                            </div>
                            <div class="sm:col-span-2">
                                <button type="submit" class="inline-flex items-center gap-2 rounded-lg bg-jkb-yellow px-6 py-3 text-sm font-bold text-jkb-navy transition-colors hover:bg-jkb-yellow-dark">
                                    <x-heroicon-m-paper-airplane class="h-5 w-5" />
                                    Kirim Pesan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <aside class="space-y-5 lg:col-span-2">
                    @if ($branches->isNotEmpty())
                        @foreach ($branches->take(6) as $branch)
                            <div class="rounded-xl glass p-6 ring-1 ring-white/60 shadow-sm">
                                <div class="flex items-start justify-between gap-3">
                                    <h3 class="font-black text-jkb-gray-dark">{{ $branch->name }}</h3>
                                    @if ($branch->type)
                                        <span class="rounded-full bg-jkb-navy px-2.5 py-0.5 text-[11px] font-bold uppercase text-jkb-yellow">{{ $branch->type }}</span>
                                    @endif
                                </div>
                                <p class="mt-2 flex items-start gap-2 text-sm text-jkb-gray">
                                    <x-heroicon-m-map-pin class="mt-0.5 h-4 w-4 shrink-0 text-jkb-yellow-dark" /> {{ $branch->address }}
                                </p>
                                <div class="mt-3 space-y-1.5 text-sm">
                                    @if ($branch->phone)
                                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $branch->phone) }}" class="flex items-center gap-2 text-jkb-gray hover:text-jkb-yellow-dark">
                                            <x-heroicon-m-phone class="h-4 w-4 text-jkb-yellow-dark" /> {{ $branch->phone }}
                                        </a>
                                    @endif
                                    @if ($branch->whatsapp)
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $branch->whatsapp) }}" target="_blank" rel="noopener" class="flex items-center gap-2 text-jkb-gray hover:text-jkb-yellow-dark">
                                            <x-heroicon-m-chat-bubble-left-right class="h-4 w-4 text-jkb-yellow-dark" /> WhatsApp {{ $branch->name }}
                                        </a>
                                    @endif
                                    @if ($branch->operational_hours)
                                        <p class="flex items-center gap-2 text-jkb-gray">
                                            <x-heroicon-m-clock class="h-4 w-4 text-jkb-yellow-dark" /> {{ $branch->operational_hours }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        @if ($branches->count() > 6)
                            <a href="{{ route('branches.index') }}" class="flex items-center justify-center gap-1.5 rounded-lg glass px-5 py-3 text-sm font-bold text-jkb-gray-dark ring-1 ring-white/60 transition-colors hover:ring-jkb-yellow/60">
                                Lihat Semua Cabang <x-heroicon-m-arrow-right class="h-4 w-4" />
                            </a>
                        @endif
                    @endif

                    <div class="rounded-xl border border-jkb-gray-light bg-jkb-navy p-6 text-white">
                        <h3 class="font-black">Layanan Darurat / Cepat</h3>
                        <p class="mt-1 text-sm text-gray-300">Butuh pasokan cepat? Hubungi tim kami melalui WhatsApp untuk respons tercepat.</p>
                        <a href="{{ jkb_whatsapp_link('Halo JKB, saya butuh pasokan cepat.') }}" target="_blank" rel="noopener" class="btn-jkb-pill mt-4 w-full px-5 py-3 text-sm">
                            <x-heroicon-m-chat-bubble-left-right class="h-5 w-5" /> Chat Sekarang
                        </a>
                    </div>
                </aside>
            </div>
        </div>
    </section>
</x-layouts.app>