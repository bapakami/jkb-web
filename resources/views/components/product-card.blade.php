@props(['product'])

<div class="group jkb-reveal flex flex-col overflow-hidden rounded-xl glass ring-1 ring-white/60 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_18px_44px_rgba(15,23,42,0.16)]">
    <a href="{{ route('products.show', [$product->category, $product]) }}" class="relative block aspect-[16/10] overflow-hidden bg-jkb-gray-light">
        @if ($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" loading="lazy"
                class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105">
        @else
            <div class="grid h-full w-full place-items-center bg-gradient-to-br from-jkb-yellow/30 to-white">
                <x-heroicon-m-cube class="h-12 w-12 text-jkb-gray" />
            </div>
        @endif
        <span class="absolute left-3 top-3 rounded bg-jkb-navy/70 px-2.5 py-1 text-[0.7rem] font-bold uppercase tracking-wide text-jkb-yellow ring-1 ring-white/15 backdrop-blur-md">
            {{ $product->category?->name }}
        </span>
    </a>

    <div class="flex flex-1 flex-col p-5">
        <h3 class="text-lg font-bold text-jkb-gray-dark">
            <a href="{{ route('products.show', [$product->category, $product]) }}" class="hover:text-jkb-gray">
                {{ $product->name }}
            </a>
        </h3>

        @if ($product->summary)
            <p class="mt-2 line-clamp-3 text-sm leading-relaxed text-jkb-gray">{{ $product->summary }}</p>
        @endif

        <div class="mt-4 flex items-center justify-between border-t border-jkb-gray-light pt-4">
            <a href="{{ route('products.show', [$product->category, $product]) }}"
                class="inline-flex items-center gap-1 text-sm font-semibold text-jkb-gray-dark hover:text-jkb-gray">
                Detail Produk
                <x-heroicon-m-arrow-right class="h-4 w-4 transition-transform group-hover:translate-x-0.5" />
            </a>
            <a href="{{ jkb_whatsapp_link('Halo JKB, saya ingin bertanya tentang produk ' . $product->name . '.') }}"
                target="_blank" rel="noopener"
                class="btn-jkb-pill gap-1 px-3 py-1.5 text-xs">
                <x-heroicon-m-chat-bubble-left-right class="h-3.5 w-3.5" />
                Hubungi Kami
            </a>
        </div>
    </div>
</div>