<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
        xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">

    <!-- Page d'accueil -->
    <url>
        <loc>{{ url('/') }}</loc>
        <lastmod>{{ now()->format('Y-m-d\TH:i:sP') }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>

    <!-- Pages statiques -->
    @foreach($pages as $page => $lastmod)
    <url>
        <loc>{{ url($page == 'home' ? '/' : '/pages/' . $page) }}</loc>
        <lastmod>{{ $lastmod->format('Y-m-d\TH:i:sP') }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>{{ $page == 'home' ? '1.0' : '0.8' }}</priority>
    </url>
    @endforeach

    <!-- Blog - Articles -->
    @foreach($posts as $post)
    <url>
        <loc>{{ route('blog.show', $post->slug) }}</loc>
        <lastmod>{{ $post->updated_at->format('Y-m-d\TH:i:sP') }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>

        @if($post->image)
        <image:image>
            <image:loc>{{ Storage::url($post->image) }}</image:loc>
            <image:title>{{ $post->title }}</image:title>
            @if($post->excerpt)
            <image:caption>{{ Str::limit($post->excerpt, 100) }}</image:caption>
            @endif
        </image:image>
        @endif
    </url>
    @endforeach

    <!-- Marketplace - Produits -->
    @foreach($products as $product)
    <url>
        <loc>{{ route('marketplace.show', $product->slug) }}</loc>
        <lastmod>{{ $product->updated_at->format('Y-m-d\TH:i:sP') }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.6</priority>

        @if($product->image)
        <image:image>
            <image:loc>{{ Storage::url($product->image) }}</image:loc>
            <image:title>{{ $product->name }}</image:title>
            @if($product->short_description)
            <image:caption>{{ Str::limit($product->short_description, 100) }}</image:caption>
            @endif
        </image:image>
        @endif
    </url>
    @endforeach

</urlset>
