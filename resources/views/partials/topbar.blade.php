@php
    $phone = jkb_setting('phone', '024-00000000');
    $email = jkb_setting('email', 'info@jkb.co.id');
    $hours = jkb_setting('operational_hours', 'Senin – Sabtu, 08.00 – 17.00 WIB');
    $instagram = jkb_setting('social_instagram', '#');
    $facebook = jkb_setting('social_facebook', '#');
    $youtube = jkb_setting('social_youtube', '#');
@endphp

<div class="bg-jkb-navy text-white text-xs">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-10 items-center justify-between gap-4">
            <div class="flex min-w-0 items-center gap-5">
                <a href="tel:{{ preg_replace('/[^0-9]/', '', $phone) }}" class="hidden items-center gap-1.5 hover:text-jkb-yellow sm:flex" rel="noopener">
                    <x-heroicon-m-phone class="h-3.5 w-3.5 text-jkb-yellow" />
                    <span>{{ $phone }}</span>
                </a>
                <a href="mailto:{{ $email }}" class="flex min-w-0 items-center gap-1.5 hover:text-jkb-yellow">
                    <x-heroicon-m-envelope class="h-3.5 w-3.5 shrink-0 text-jkb-yellow" />
                    <span class="truncate">{{ $email }}</span>
                </a>
            </div>

            <div class="flex items-center gap-4">
                <div class="hidden items-center gap-1.5 md:flex">
                    <x-heroicon-m-clock class="h-3.5 w-3.5 text-jkb-yellow" />
                    <span>{{ $hours }}</span>
                </div>

                <div class="hidden items-center gap-2 sm:flex">
                    <span class="h-4 w-px bg-white/20" aria-hidden="true"></span>
                    @if ($instagram && $instagram !== '#')
                        <a href="{{ $instagram }}" target="_blank" rel="noopener" aria-label="Instagram"
                            class="grid h-7 w-7 place-items-center rounded-full text-white/80 transition hover:bg-jkb-yellow hover:text-jkb-navy">
                            <x-heroicon-m-camera class="h-3.5 w-3.5" />
                        </a>
                    @endif
                    @if ($facebook && $facebook !== '#')
                        <a href="{{ $facebook }}" target="_blank" rel="noopener" aria-label="Facebook"
                            class="grid h-7 w-7 place-items-center rounded-full text-white/80 transition hover:bg-jkb-yellow hover:text-jkb-navy">
                            <x-heroicon-m-user-group class="h-3.5 w-3.5" />
                        </a>
                    @endif
                    @if ($youtube && $youtube !== '#')
                        <a href="{{ $youtube }}" target="_blank" rel="noopener" aria-label="YouTube"
                            class="grid h-7 w-7 place-items-center rounded-full text-white/80 transition hover:bg-jkb-yellow hover:text-jkb-navy">
                            <x-heroicon-m-play class="h-3.5 w-3.5" />
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>