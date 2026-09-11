@php
    $whatsapp = jkb_setting('whatsapp', '082000000000');
    $company = jkb_setting('company_short_name', 'JKB');
    $tagline = jkb_setting('tagline', 'Kokoh Berkualitas');
@endphp

<div x-data="{ open: false }" class="fixed bottom-6 right-6 z-50">
    <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 scale-95"
        class="mb-3 w-[340px] max-w-[calc(100vw-3rem)] overflow-hidden rounded-2xl bg-white shadow-2xl ring-1 ring-black/5"
        style="display:none">
        <div class="flex items-center gap-3 bg-jkb-navy px-5 py-4 text-white">
            <div class="relative flex h-11 w-11 shrink-0 items-center justify-center overflow-hidden rounded-full bg-white/10">
                <x-logo class="h-9 w-auto" />
            </div>
            <div class="min-w-0">
                <p class="text-sm font-bold leading-tight">{{ $company }}</p>
                <p class="mt-0.5 inline-flex items-center gap-1.5 text-xs text-gray-300">
                    <span class="h-2 w-2 rounded-full bg-green-400" aria-hidden="true"></span>
                    Online
                </p>
            </div>
        </div>

        <div class="px-5 py-4">
            <p class="text-sm font-semibold text-jkb-gray-dark">Dapatkan penawaran harga terbaik</p>
            <p class="mt-1 text-xs leading-relaxed text-jkb-gray">
                Konsultasi gratis dengan tim {{ $company }} — {{ $tagline }}.
            </p>

            <p class="mt-4 text-[11px] font-bold uppercase tracking-wider text-jkb-gray">WhatsApp kami</p>
            <a href="{{ jkb_whatsapp_link('Halo JKB, saya ingin konsultasi gratis.') }}" target="_blank" rel="noopener"
                class="mt-1.5 flex items-center justify-between rounded-xl border border-jkb-gray-light px-4 py-3 transition hover:border-[#25D366] hover:bg-[#25D366]/5">
                <span class="flex items-center gap-3">
                    <span class="grid h-9 w-9 shrink-0 place-items-center rounded-full bg-[#25D366] text-white">
                        <svg class="h-5 w-5" viewBox="0 0 32 32" fill="currentColor" aria-hidden="true">
                            <path d="M16.004 3C9.383 3 4 8.383 4 15.004c0 2.117.554 4.184 1.607 6.008L4 29l8.222-1.551a11.94 11.94 0 0 0 3.782.632h.004c6.621 0 12.004-5.383 12.004-12.004C28.016 8.383 22.625 3 16.004 3zm0 21.856a9.85 9.85 0 0 1-3.03-.492l-.22-.07-4.881.922.934-4.758-.145-.226a9.87 9.87 0 0 1-1.567-5.208c0-5.448 4.43-9.879 9.909-9.879 5.447 0 9.878 4.43 9.878 9.878 0 5.449-4.43 9.879-9.878 9.879zm5.423-7.398c-.297-.149-1.758-.868-2.031-.967-.273-.1-.472-.149-.67.149-.199.298-.77.967-.944 1.167-.174.199-.348.224-.645.075-.297-.15-1.255-.463-2.39-1.475-.883-.787-1.48-1.76-1.653-2.058-.174-.298-.019-.459.13-.607.134-.134.298-.348.447-.522.149-.173.199-.298.298-.497.1-.198.05-.372-.025-.522-.074-.149-.67-1.613-.918-2.209-.242-.58-.487-.501-.67-.511-.174-.01-.372-.01-.57-.01-.199 0-.522.074-.795.372-.273.297-1.043 1.02-1.043 2.487s1.068 2.886 1.217 3.085c.149.199 2.101 3.208 5.091 4.498.711.308 1.266.492 1.699.63.713.227 1.362.195 1.875.118.572-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.273-.199-.57-.348z"/>
                        </svg>
                    </span>
                    <span>
                        <span class="block text-sm font-bold text-jkb-gray-dark">{{ $whatsapp }}</span>
                        <span class="block text-xs text-jkb-gray">CS {{ $company }}</span>
                    </span>
                </span>
                <x-heroicon-m-arrow-right class="h-4 w-4 text-jkb-gray" />
            </a>
        </div>
    </div>

    <button type="button" @click="open = !open" aria-label="Chat WhatsApp JKB" aria-expanded="false"
        :aria-expanded="open.toString()"
        class="ml-auto flex items-center gap-3 rounded-full bg-[#25D366] py-3 pl-4 pr-5 text-white shadow-xl transition-transform hover:scale-105">
        <svg class="h-7 w-7" viewBox="0 0 32 32" fill="currentColor" aria-hidden="true">
            <path d="M16.004 3C9.383 3 4 8.383 4 15.004c0 2.117.554 4.184 1.607 6.008L4 29l8.222-1.551a11.94 11.94 0 0 0 3.782.632h.004c6.621 0 12.004-5.383 12.004-12.004C28.016 8.383 22.625 3 16.004 3zm0 21.856a9.85 9.85 0 0 1-3.03-.492l-.22-.07-4.881.922.934-4.758-.145-.226a9.87 9.87 0 0 1-1.567-5.208c0-5.448 4.43-9.879 9.909-9.879 5.447 0 9.878 4.43 9.878 9.878 0 5.449-4.43 9.879-9.878 9.879zm5.423-7.398c-.297-.149-1.758-.868-2.031-.967-.273-.1-.472-.149-.67.149-.199.298-.77.967-.944 1.167-.174.199-.348.224-.645.075-.297-.15-1.255-.463-2.39-1.475-.883-.787-1.48-1.76-1.653-2.058-.174-.298-.019-.459.13-.607.134-.134.298-.348.447-.522.149-.173.199-.298.298-.497.1-.198.05-.372-.025-.522-.074-.149-.67-1.613-.918-2.209-.242-.58-.487-.501-.67-.511-.174-.01-.372-.01-.57-.01-.199 0-.522.074-.795.372-.273.297-1.043 1.02-1.043 2.487s1.068 2.886 1.217 3.085c.149.199 2.101 3.208 5.091 4.498.711.308 1.266.492 1.699.63.713.227 1.362.195 1.875.118.572-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.273-.199-.57-.348z"/>
        </svg>
        <span class="pr-1 text-sm font-bold">Konsultasi Gratis</span>
    </button>
</div>