<x-layouts.app>
    @section('title', $category->meta_title ?: $category->name . ' – Produk JKB')
    @section('meta_description', $category->meta_description ?: 'Produk ' . $category->name . ' dari CV Jati Kencana Beton (JKB) — beton siap pakai dan material konstruksi berkualitas di Jawa Tengah.')

    <x-page-hero
        :title="$category->name"
        eyebrow="Produk"
        :description="$category->description"
    />

    <section class="bg-jkb-gray-light py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @if ($products->isEmpty())
                <div class="py-16 text-center">
                    <x-heroicon-m-cube class="mx-auto h-12 w-12 text-jkb-yellow-dark" />
                    <p class="mt-4 text-sm text-jkb-gray">Belum ada produk tersedia pada kategori ini.</p>
                    <a href="{{ route('products.index') }}" class="mt-4 inline-flex items-center gap-1.5 text-sm font-bold text-jkb-yellow-dark hover:text-jkb-gray-dark">
                        <x-heroicon-m-arrow-left class="h-4 w-4" /> Kembali ke Semua Produk
                    </a>
                </div>
            @else
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($products as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>
            @endif

            @if ($otherCategories->isNotEmpty())
                <div class="mt-16 border-t border-jkb-gray-light pt-10">
                    <h2 class="text-lg font-black text-jkb-gray-dark">Kategori Lain</h2>
                    <div class="mt-4 flex flex-wrap gap-3">
                        @foreach ($otherCategories as $oc)
                            <a href="{{ route('products.category', $oc) }}" class="rounded-full border border-jkb-gray-light bg-white px-5 py-2 text-sm font-semibold text-jkb-gray-dark transition-colors hover:border-jkb-yellow hover:bg-jkb-yellow/20">
                                {{ $oc->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>
</x-layouts.app>