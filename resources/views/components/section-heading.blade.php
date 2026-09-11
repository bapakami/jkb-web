@props([
    'eyebrow' => null,
    'title' => null,
    'description' => null,
    'align' => 'center',
    'light' => false,
])

@php
    $alignClass = $align === 'left' ? 'text-left items-start' : 'text-center items-center';
    $lineColor = $light ? 'bg-jkb-yellow' : 'bg-jkb-yellow-dark';
@endphp

<div @class(['flex flex-col', $alignClass])>
    @if ($eyebrow)
        <span @class([
            'inline-flex items-center gap-3 text-xs font-bold uppercase tracking-[0.25em]',
            $light ? 'text-jkb-yellow' : 'text-jkb-gray-dark',
        ])>
            @if ($align === 'center')
                <span class="h-0.5 w-10 rounded-full {{ $lineColor }}"></span>
            @endif
            {{ $eyebrow }}
            <span class="h-0.5 w-10 rounded-full {{ $lineColor }}"></span>
        </span>
    @endif

    @if ($title)
        <h2 @class([
            'mt-4 text-3xl font-black leading-tight tracking-tight sm:text-4xl lg:text-[2.75rem]',
            $light ? 'text-white' : 'text-jkb-gray-dark',
        ])>
            {{ $title }}
        </h2>
    @endif

    @if ($description)
        <p @class([
            'mt-4 max-w-2xl text-base leading-relaxed',
            $light ? 'text-gray-300' : 'text-jkb-gray',
        ])>
            {{ $description }}
        </p>
    @endif
</div>