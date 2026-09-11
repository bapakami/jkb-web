@props(['variant' => 'full', 'class' => ''])

@php
    $logoPath = public_path('images/logo_dengan_tulisan.png');
    $exists = is_file($logoPath);
    $hasHeightClass = (bool) preg_match('/(?:^|\s)(?:h|max-h)-[-a-z0-9]+/', $class);
@endphp

@if ($exists)
    <img src="{{ asset('images/logo_dengan_tulisan.png') }}" alt="Logo JKB - Kokoh Berkualitas"
        @class(['h-16 w-auto' => ! $hasHeightClass, $class])>
@elseif ($variant === 'icon')
    <img src="{{ asset('images/logo.svg') }}" alt="Logo JKB" @class(['h-12 w-12', $class])>
@else
    <span class="inline-flex items-center gap-3 {{ $class }}">
        <img src="{{ asset('images/logo.svg') }}" alt="Logo JKB" class="h-12 w-12 shrink-0">
        <span class="flex flex-col leading-none">
            <span class="text-2xl font-black tracking-tight text-jkb-gray">JKB</span>
            <span class="mt-1 text-[0.6rem] font-semibold tracking-[0.22em] text-jkb-gray">KOKOH BERKUALITAS</span>
        </span>
    </span>
@endif