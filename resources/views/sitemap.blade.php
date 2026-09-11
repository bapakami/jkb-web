<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($urls as $path => $priority)
        <url>
            <loc>{{ url($path) }}</loc>
            <changefreq>{{ ($path === '/') ? 'daily' : 'weekly' }}</changefreq>
            <priority>{{ $priority }}</priority>
        </url>
    @endforeach

    @foreach ($categories as $category)
        <url>
            <loc>{{ route('products.category', $category) }}</loc>
            <lastmod>{{ $category->updated_at?->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach

    @foreach ($products as $product)
        <url>
            <loc>{{ route('products.show', [$product->category, $product]) }}</loc>
            <lastmod>{{ $product->updated_at?->toAtomString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.7</priority>
        </url>
    @endforeach

    @foreach ($projects as $project)
        <url>
            <loc>{{ route('projects.show', $project) }}</loc>
            <lastmod>{{ $project->updated_at?->toAtomString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.6</priority>
        </url>
    @endforeach

    @foreach ($news as $item)
        <url>
            <loc>{{ route('news.show', $item) }}</loc>
            <lastmod>{{ $item->updated_at?->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.6</priority>
        </url>
    @endforeach

    @foreach ($careers as $career)
        <url>
            <loc>{{ route('careers.show', $career) }}</loc>
            <lastmod>{{ $career->updated_at?->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.5</priority>
        </url>
    @endforeach

    @foreach ($branches as $branch)
        <url>
            <loc>{{ route('branches.show', $branch) }}</loc>
            <lastmod>{{ $branch->updated_at?->toAtomString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.6</priority>
        </url>
    @endforeach

    @foreach ($tahukahAnda as $item)
        <url>
            <loc>{{ route('tahukah-anda.show', $item) }}</loc>
            <lastmod>{{ $item->updated_at?->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.5</priority>
        </url>
    @endforeach
</urlset>