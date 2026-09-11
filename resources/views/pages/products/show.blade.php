<x-layouts.app>
    @section('title', $product->meta_title ?: $product->name . ' – JKB')
    @section('meta_description', $product->meta_description ?: $product->subtitle ?: $product->summary)

    @push('schema')
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@type": "Product",
        "name": "{{ $product->name }}",
        "description": "{{ $product->summary }}",
        "brand": {
            "@type": "Brand",
            "name": "{{ jkb_setting('company_name', 'CV Jati Kencana Beton') }}"
        },
        "category": "{{ $product->category->name }}"
        @if ($product->image)
        ,"image": "{{ asset('storage/' . $product->image) }}"
        @endif
        @if (!empty($product->specifications))
        ,"additionalProperty": [
            @foreach ($product->specifications as $key => $value)
            {"@type": "PropertyValue", "name": "{{ $key }}", "value": "{{ $value }}" }@if (!$loop->last),@endif
            @endforeach
        ]
        @endif
    }
    </script>
    @endpush

    <x-page-hero
        :title="$product->name"
        eyebrow="Produk"
        :description="$product->subtitle ?: $product->summary"
    />

    <section class="relative overflow-hidden bg-white py-16">
        <div class="jkb-glow -right-32 top-20 h-96 w-96 bg-jkb-yellow/15"></div>
        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <nav class="flex flex-wrap items-center gap-1.5 text-xs font-medium text-jkb-gray">
                <a href="{{ route('products.index') }}" class="hover:text-jkb-yellow-dark">Produk</a>
                <x-heroicon-m-chevron-right class="h-3.5 w-3.5" />
                <a href="{{ route('products.category', $product->category) }}" class="hover:text-jkb-yellow-dark">{{ $product->category->name }}</a>
                <x-heroicon-m-chevron-right class="h-3.5 w-3.5" />
                <span class="text-jkb-gray-dark">{{ $product->name }}</span>
            </nav>

            <div class="mt-8 grid gap-10 lg:grid-cols-5">
                <div class="lg:col-span-2">
                    <div class="jkb-reveal overflow-hidden rounded-2xl glass p-2 shadow-sm ring-1 ring-white/60">
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="aspect-square w-full object-cover">
                        @else
                            <div class="grid aspect-square w-full place-items-center bg-jkb-gray-light text-jkb-gray">
                                <x-heroicon-m-cube class="h-20 w-20" />
                            </div>
                        @endif
                    </div>

                    @if (!empty($product->gallery))
                        <div class="mt-4 grid grid-cols-4 gap-3">
                            @foreach ($product->gallery as $img)
                                @php $path = normalize_image_path($img); @endphp
                                @if ($path)
                                <div class="overflow-hidden rounded-lg glass ring-1 ring-white/60">
                                    <img src="{{ asset('storage/' . $path) }}" alt="{{ $product->name }}" loading="lazy" class="aspect-square w-full object-cover">
                                </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="lg:col-span-3">
                    <h1 class="text-3xl font-black tracking-tight text-jkb-gray-dark">{{ $product->name }}</h1>
                    @if ($product->subtitle)
                        <p class="mt-2 text-base font-medium text-jkb-yellow-dark">{{ $product->subtitle }}</p>
                    @endif
                    <p class="mt-4 leading-relaxed text-jkb-gray">{{ $product->summary }}</p>

                    <div class="mt-6 prose prose-sm prose-gray max-w-none leading-relaxed text-jkb-gray">
                        {!! $product->description !!}
                    </div>

                    @if (!empty($product->specifications))
                        <h2 class="mt-10 text-xl font-black text-jkb-gray-dark">Spesifikasi Teknis</h2>
                        <div class="mt-4 overflow-hidden rounded-xl glass ring-1 ring-white/60 shadow-sm">
                            <table class="w-full text-left text-sm">
                                <tbody class="divide-y divide-jkb-gray-light">
                                    @foreach ($product->specifications as $key => $value)
                                        <tr class="bg-white/60">
                                            <th class="w-2/5 bg-jkb-gray-light/60 px-5 py-3 font-semibold text-jkb-gray-dark">{{ $key }}</th>
                                            <td class="px-5 py-3 text-jkb-gray">{{ $value }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    @if (!empty($product->uses))
                        <h2 class="mt-10 text-xl font-black text-jkb-gray-dark">Penggunaan</h2>
                        <p class="mt-3 leading-relaxed text-jkb-gray">{!! $product->uses !!}</p>
                    @endif

                    <div class="mt-10 flex flex-wrap gap-3">
                        <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 rounded-full bg-jkb-yellow px-6 py-3 text-sm font-bold text-jkb-navy transition-colors hover:bg-jkb-yellow-dark">
                            <x-heroicon-m-chat-bubble-left-right class="h-5 w-5" />
                            Minta Penawaran
                        </a>
                        <a href="{{ jkb_whatsapp_link('Halo JKB, saya ingin bertanya tentang ' . $product->name) }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 rounded-full bg-jkb-navy px-6 py-3 text-sm font-bold text-white transition-colors hover:bg-jkb-gray-dark">
                            <x-heroicon-m-phone class="h-5 w-5" />
                            Konsultasi via WhatsApp
                        </a>
                    </div>
                </div>
            </div>

            @if ($related->isNotEmpty())
                <div class="mt-16 border-t border-jkb-gray-light pt-10">
                    <h2 class="text-xl font-black text-jkb-gray-dark">Produk Lainnya</h2>
                    <div class="mt-6 grid gap-6 md:grid-cols-3">
                        @foreach ($related as $r)
                            <x-product-card :product="$r" />
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>
</x-layouts.app>