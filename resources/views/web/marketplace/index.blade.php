@extends('layouts.master')

@section('title', 'Marketplace - Produits partenaires MyBusiness')

@section('content')

<!-- =========================
    BREADCRUMB
========================= -->
<section class="ht-breadcrumb-area">
    @include('components.breadcrumb', [
        'title' => 'Marketplace',
        'active' => 'Produits partenaires'
    ])
</section>

<!-- =========================
    HERO MARKETPLACE
========================= -->
<section class="ht-hero-area marketplace-hero" data-bg-src="{{ asset('assets/img/marketplace/hero-bg.jpg') }}">
    <div class="container">
        <div class="ht-hero-content text-center text-white">
            <h1 class="wow fadeInUp" data-wow-delay=".2s">
                Marketplace MyBusiness
            </h1>
            <p class="desc wow fadeInUp" data-wow-delay=".4s">
                Découvrez les produits de nos partenaires, sélectionnés pour votre entreprise
            </p>
        </div>
    </div>
</section>

<!-- =========================
    FILTRES
========================= -->
<section class="section-padding bg-light">
    <div class="container">
        <div class="row g-4">
            <!-- Recherche -->
            <div class="col-lg-5">
                <form action="{{ route('marketplace.index') }}" method="GET" class="search-form">
                    <div class="input-group">
                        <input type="text"
                               name="search"
                               class="form-control"
                               placeholder="Rechercher un produit..."
                               value="{{ request('search') }}">
                        <button class="ht-btn" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Filtres -->
            <div class="col-lg-7">
                <div class="d-flex flex-wrap gap-3 justify-content-end">
                    <select name="category" class="form-select" style="width: auto;" onchange="this.form.submit()">
                        <option value="">Toutes catégories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>

                    <select name="partner" class="form-select" style="width: auto;" onchange="this.form.submit()">
                        <option value="">Tous partenaires</option>
                        @foreach($partners as $partner)
                            <option value="{{ $partner->id }}" {{ request('partner') == $partner->id ? 'selected' : '' }}>
                                {{ $partner->name }}
                            </option>
                        @endforeach
                    </select>

                    <select name="sort" class="form-select" style="width: auto;" onchange="this.form.submit()">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Plus récents</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Prix croissant</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Prix décroissant</option>
                        <option value="featured" {{ request('sort') == 'featured' ? 'selected' : '' }}>En vedette</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================
    PRODUITS SPONSORISÉS
========================= -->
@if($sponsoredProducts->count() > 0)
<section class="section-padding">
    <div class="container">
        <div class="section-title">
            <span class="subtitle">En vedette</span>
            <h2 class="title">Produits sponsorisés</h2>
        </div>

        <div class="row g-4 mt-4">
            @foreach($sponsoredProducts as $product)
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="{{ $loop->index * 0.1 }}s">
                <div class="product-card card h-100 border-0 shadow-sm">
                    <div class="badge-sponsor">Sponsorisé</div>

                    <div class="product-image">
                        <img src="{{ $product->image_url }}"
                             class="card-img-top"
                             alt="{{ $product->name }}"
                             loading="lazy">
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">{{ Str::limit($product->name, 40) }}</h5>
                        <div class="partner-info mb-2">
                            <small class="text-muted">
                                <i class="fas fa-store me-1"></i>
                                {{ $product->partner->name }}
                            </small>
                        </div>
                        <p class="card-text text-muted small">
                            {{ Str::limit($product->short_description, 80) }}
                        </p>

                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="h5 text-primary mb-0">
                                {{ number_format($product->price, 0, ',', ' ') }} FCFA
                            </span>
                            <a href="{{ route('marketplace.show', $product->slug) }}"
                               class="btn btn-sm btn-outline-primary">
                                Voir
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- =========================
    TOUS LES PRODUITS
========================= -->
<section class="section-padding bg-white">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-0">Tous les produits</h3>
                <p class="text-muted mb-0">{{ $products->total() }} produits disponibles</p>
            </div>
            <div class="text-muted">
                Page {{ $products->currentPage() }} sur {{ $products->lastPage() }}
            </div>
        </div>

        @if($products->count() > 0)
        <div class="row g-4">
            @foreach($products as $product)
            <div class="col-lg-3 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="{{ $loop->index * 0.05 }}s">
                <div class="product-card card h-100 border-0 shadow-sm">
                    @if($product->is_featured)
                        <div class="badge-featured">Vedette</div>
                    @endif

                    <div class="product-image">
                        <img src="{{ $product->image_url }}"
                             class="card-img-top"
                             alt="{{ $product->name }}"
                             loading="lazy">
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">{{ Str::limit($product->name, 40) }}</h5>

                        @if($product->category)
                        <div class="category-badge mb-2">
                            <span class="badge bg-light text-dark">
                                {{ $product->category->name }}
                            </span>
                        </div>
                        @endif

                        <p class="card-text text-muted small">
                            {{ Str::limit($product->short_description, 60) }}
                        </p>

                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div>
                                @if($product->old_price)
                                <small class="text-muted text-decoration-line-through">
                                    {{ number_format($product->old_price, 0, ',', ' ') }} FCFA
                                </small>
                                @endif
                                <span class="h5 text-primary d-block mb-0">
                                    {{ number_format($product->price, 0, ',', ' ') }} FCFA
                                </span>
                            </div>
                            <a href="{{ route('marketplace.show', $product->slug) }}"
                               class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye me-1"></i>Voir
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-5">
            {{ $products->withQueryString()->links() }}
        </div>
        @else
        <div class="text-center py-5">
            <i class="fas fa-box-open fa-4x text-muted mb-3"></i>
            <h4 class="text-muted">Aucun produit trouvé</h4>
            <p class="text-muted">Essayez avec d'autres critères de recherche</p>
            <a href="{{ route('marketplace.index') }}" class="ht-btn">
                <i class="fas fa-redo me-2"></i>Réinitialiser les filtres
            </a>
        </div>
        @endif
    </div>
</section>

<!-- =========================
    CTA PARTENAIRE
========================= -->
<section class="section-padding bg-primary text-white">
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h3 class="mb-3">Vous êtes partenaire ?</h3>
                <p class="mb-4">
                    Proposez vos produits dans notre marketplace et touchez des milliers de commerçants.
                    Rejoignez notre réseau de partenaires privilégiés.
                </p>
                <a href="{{ route('pages.partners') }}" class="ht-btn style-3">
                    <i class="fas fa-handshake me-2"></i>Devenir partenaire
                </a>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
.marketplace-hero {
    background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7));
    padding: 80px 0;
}

.marketplace-hero .ht-hero-content h1 {
    color: white;
    font-size: 3rem;
}

.search-form .input-group {
    border-radius: 50px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.search-form .form-control {
    border: none;
    padding: 15px 25px;
    font-size: 1rem;
}

.search-form .ht-btn {
    border-radius: 0 50px 50px 0;
    padding: 15px 30px;
}

.product-card {
    transition: all 0.3s ease;
    border: 1px solid #eaeaea;
}

.product-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    border-color: #007bff;
}

.product-image {
    height: 200px;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f8f9fa;
}

.product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s;
}

.product-card:hover .product-image img {
    transform: scale(1.05);
}

.badge-sponsor, .badge-featured {
    position: absolute;
    top: 15px;
    left: 15px;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    z-index: 1;
}

.badge-sponsor {
    background: linear-gradient(45deg, #ff6b6b, #ff8e53);
    color: white;
}

.badge-featured {
    background: linear-gradient(45deg, #4facfe, #00f2fe);
    color: white;
}

.pagination-wrapper {
    display: flex;
    justify-content: center;
}

.pagination .page-item.active .page-link {
    background-color: #007bff;
    border-color: #007bff;
}

.pagination .page-link {
    color: #007bff;
    border-radius: 5px;
    margin: 0 3px;
    padding: 10px 15px;
}

.pagination .page-link:hover {
    background-color: #f8f9fa;
}
</style>
@endpush
