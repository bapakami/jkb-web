@props(['title', 'eyebrow' => null, 'description' => null])

<section class="relative overflow-hidden bg-gradient-to-br from-jkb-navy via-jkb-navy to-[#1C1F23]">
    <div class="absolute inset-0">
        <div class="absolute -right-24 -top-24 h-96 w-96 rounded-full bg-jkb-yellow/10 blur-3xl"></div>
        <div class="absolute -bottom-32 -left-24 h-80 w-80 rounded-full bg-jkb-yellow/5 blur-3xl"></div>
        <svg class="absolute inset-0 h-full w-full text-jkb-yellow/5" aria-hidden="true">
            <defs>
                <pattern id="diag" width="40" height="40" patternUnits="userSpaceOnUse" patternTransform="rotate(45)">
                    <rect width="40" height="40" fill="none"></rect>
                    <line x1="0" y1="0" x2="0" y2="40" stroke="currentColor" stroke-width="2"></line>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#diag)"></rect>
        </svg>
    </div>
    <div class="relative mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8 lg:py-24">
        <nav class="flex items-center gap-2 text-xs text-gray-400" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-1 transition hover:text-jkb-yellow">
                <x-heroicon-m-home class="h-3.5 w-3.5" />
                Beranda
            </a>
            @if ($eyebrow)
                <x-heroicon-m-chevron-right class="h-3.5 w-3.5 text-jkb-yellow" />
                <span class="capitalize text-jkb-yellow">{{ $eyebrow }}</span>
            @endif
        </nav>
        <span class="mt-6 block h-1 w-14 rounded-full bg-jkb-yellow" aria-hidden="true"></span>
        <h1 class="mt-4 max-w-3xl text-3xl font-black leading-tight tracking-tight text-white sm:text-4xl lg:text-5xl">{{ $title }}</h1>
        @if ($description)
            <p class="mt-4 max-w-2xl text-base leading-relaxed text-gray-300">{{ $description }}</p>
        @endif
    </div>
</section>