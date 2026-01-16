@extends('layouts.master')

@section('title', $product->name . ' - Marketplace MyBusiness')

@section('content')

<!-- =========================
    BREADCRUMB
========================= -->
<section class="ht-breadcrumb-area">
    @include('components.breadcrumb', [
        'title' => $product->name,
        'parent' => 'Marketplace',
        'parent_url' => route('marketplace.index'),
        'active' => 'Détails produit'
    ])
</section>

<!-- =========================
    DÉTAILS PRODUIT
========================= -->
<section class="section-padding">
    <div class="container">
        <div class="row g-5">
            <!-- Images produit -->
            <div class="col-lg-6">
                <div class="product-gallery">
                    <div class="main-image mb-4">
                        <img src="{{ $product->image_url }}"
                             alt="{{ $product->name }}"
                             class="img-fluid rounded-3 shadow"
                             id="mainImage">
                    </div>
                </div>

                @if($product->is_sponsored)
                <div class="alert alert-warning">
                    <i class="fas fa-star me-2"></i>
                    <strong>Produit sponsorisé</strong> - Ce produit bénéficie d'une visibilité privilégiée
                </div>
                @endif
            </div>

            <!-- Informations produit -->
            <div class="col-lg-6">
                <div class="product-details">
                    <!-- Catégories et badges -->
                    <div class="mb-3">
                        @if($product->category)
                        <a href="{{ route('marketplace.index', ['category' => $product->category->slug]) }}"
                           class="badge bg-light text-dark me-2">
                            {{ $product->category->name }}
                        </a>
                        @endif

                        @if($product->is_featured)
                        <span class="badge bg-info me-2">En vedette</span>
                        @endif

                        @if($product->stock > 0)
                        <span class="badge bg-success">En stock ({{ $product->stock }})</span>
                        @else
                        <span class="badge bg-danger">Rupture de stock</span>
                        @endif
                    </div>

                    <!-- Titre -->
                    <h1 class="product-title mb-3">{{ $product->name }}</h1>

                    <!-- Partenaire -->
                    <div class="partner-info mb-4">
                        <div class="d-flex align-items-center">
                            @if($product->partner->logo)
                            <img src="{{ asset('StockPiece/partners/' . $product->partner->logo) }}"
                                 alt="{{ $product->partner->name }}"
                                 class="rounded-circle me-3"
                                 width="50"
                                 height="50">
                            @endif
                            <div>
                                <h6 class="mb-1">Vendu par</h6>
                                <a href="{{ route('pages.partners') }}" class="text-primary fw-bold">
                                    {{ $product->partner->name }}
                                </a>
                                @if($product->partner->featured)
                                <span class="badge bg-warning ms-2">Partenaire officiel</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Prix -->
                    <div class="price-section mb-4">
                        @if($product->old_price)
                        <div class="old-price text-muted text-decoration-line-through mb-1">
                            {{ number_format($product->old_price, 0, ',', ' ') }} FCFA
                        </div>
                        @endif
                        <div class="current-price display-4 fw-bold text-primary mb-2">
                            {{ number_format($product->price, 0, ',', ' ') }} FCFA
                        </div>

                        @if($product->old_price)
                        <div class="discount-badge">
                            <span class="badge bg-danger">
                                Économisez {{ number_format($product->old_price - $product->price, 0, ',', ' ') }} FCFA
                            </span>
                        </div>
                        @endif
                    </div>

                    <!-- Description courte -->
                    <div class="short-description mb-4">
                        <p class="lead">{{ $product->short_description }}</p>
                    </div>

                    <!-- Actions -->
                    <div class="product-actions mb-5">
                        @if($product->stock > 0)
                        <div class="d-flex gap-3">
                            @if($product->partner_product_url)
                            <a href="{{ $product->partner_product_url }}"
                               target="_blank"
                               class="ht-btn style-2 flex-grow-1"
                               onclick="trackRedirect('{{ $product->id }}')">
                                <i class="fas fa-shopping-cart me-2"></i>Acheter chez le partenaire
                            </a>
                            @endif

                            @if($product->partner_contact_email)
                            <a href="mailto:{{ $product->partner_contact_email }}?subject=Demande d'information: {{ $product->name }}"
                               class="ht-btn btn-outline-primary flex-grow-1">
                                <i class="fas fa-envelope me-2"></i>Contacter
                            </a>
                            @endif
                        </div>
                        @else
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Ce produit n'est actuellement pas disponible
                        </div>
                        @endif
                    </div>

                    <!-- Informations supplémentaires -->
                    <div class="product-meta">
                        <div class="row g-3">
                            @if($product->sku)
                            <div class="col-6">
                                <div class="meta-item">
                                    <small class="text-muted d-block">Référence</small>
                                    <strong>{{ $product->sku }}</strong>
                                </div>
                            </div>
                            @endif

                            @if($product->weight)
                            <div class="col-6">
                                <div class="meta-item">
                                    <small class="text-muted d-block">Poids</small>
                                    <strong>{{ $product->weight }} kg</strong>
                                </div>
                            </div>
                            @endif

                            @if($product->dimensions)
                            <div class="col-6">
                                <div class="meta-item">
                                    <small class="text-muted d-block">Dimensions</small>
                                    <strong>{{ $product->dimensions }}</strong>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Description détaillée -->
        <div class="row mt-5">
            <div class="col-lg-8">
                <div class="product-tabs">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-desc-tab" data-bs-toggle="tab" data-bs-target="#nav-desc">
                                Description
                            </button>
                            <button class="nav-link" id="nav-specs-tab" data-bs-toggle="tab" data-bs-target="#nav-specs">
                                Spécifications
                            </button>
                            <button class="nav-link" id="nav-partner-tab" data-bs-toggle="tab" data-bs-target="#nav-partner">
                                Partenaire
                            </button>
                        </div>
                    </nav>
                    <div class="tab-content p-4 border border-top-0 rounded-bottom" id="nav-tabContent">
                        <!-- Description -->
                        <div class="tab-pane fade show active" id="nav-desc">
                            <div class="product-description">
                                {!! nl2br(e($product->description)) !!}
                            </div>
                        </div>

                        <!-- Spécifications -->
                        <div class="tab-pane fade" id="nav-specs">
                            @if($product->specifications && count($product->specifications) > 0)
                            <div class="specifications">
                                <table class="table">
                                    <tbody>
                                        @foreach($product->specifications as $key => $value)
                                        <tr>
                                            <th width="30%">{{ $key }}</th>
                                            <td>{{ $value }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <p class="text-muted">Aucune spécification disponible</p>
                            @endif
                        </div>

                        <!-- Partenaire -->
                        <div class="tab-pane fade" id="nav-partner">
                            <div class="partner-details">
                                <h5>{{ $product->partner->name }}</h5>
                                <p>{{ $product->partner->description }}</p>

                                <div class="contact-info mt-4">
                                    @if($product->partner->website)
                                    <p>
                                        <i class="fas fa-globe me-2 text-primary"></i>
                                        <a href="{{ $product->partner->website }}" target="_blank">
                                            {{ $product->partner->website }}
                                        </a>
                                    </p>
                                    @endif

                                    @if($product->partner->email)
                                    <p>
                                        <i class="fas fa-envelope me-2 text-primary"></i>
                                        <a href="mailto:{{ $product->partner->email }}">
                                            {{ $product->partner->email }}
                                        </a>
                                    </p>
                                    @endif

                                    @if($product->partner->phone)
                                    <p>
                                        <i class="fas fa-phone me-2 text-primary"></i>
                                        {{ $product->partner->phone }}
                                    </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar info -->
            <div class="col-lg-4">
                <div class="sidebar-info">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="fas fa-shipping-fast me-2 text-primary"></i>Livraison
                            </h5>
                            <p class="card-text">
                                Contactez directement le partenaire pour les conditions de livraison.
                            </p>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="fas fa-shield-alt me-2 text-primary"></i>Sécurité
                            </h5>
                            <p class="card-text">
                                Transaction sécurisée directement avec le partenaire.
                            </p>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="fas fa-question-circle me-2 text-primary"></i>Questions ?
                            </h5>
                            <p class="card-text">
                                Contactez notre support pour toute question sur ce produit.
                            </p>
                            <a href="{{ route('support.contact') }}" class="ht-btn btn-sm w-100">
                                Contacter le support
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================
    PRODUITS SIMILAIRES
========================= -->
@if($similarProducts->count() > 0)
<section class="section-padding bg-light">
    <div class="container">
        <div class="section-title">
            <h3 class="mb-4">Produits similaires</h3>
        </div>

        <div class="row g-4">
            @foreach($similarProducts as $similar)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="product-card-small card h-100 border-0 shadow-sm">
                    <div class="product-image-small">
                        <img src="{{ $similar->image_url }}"
                             alt="{{ $similar->name }}"
                             class="card-img-top">
                    </div>

                    <div class="card-body">
                        <h6 class="card-title">{{ Str::limit($similar->name, 30) }}</h6>
                        <p class="card-text text-primary fw-bold mb-2">
                            {{ number_format($similar->price, 0, ',', ' ') }} FCFA
                        </p>
                        <a href="{{ route('marketplace.show', $similar->slug) }}"
                           class="btn btn-sm btn-outline-primary w-100">
                            Voir le produit
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection

@push('styles')
<style>
.product-gallery .main-image {
    border: 1px solid #eee;
    border-radius: 10px;
    overflow: hidden;
    background: #f8f9fa;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 400px;
}

.product-gallery .main-image img {
    max-height: 400px;
    object-fit: contain;
}

.partner-info {
    padding: 15px;
    background: #f8f9fa;
    border-radius: 10px;
}

.partner-info img {
    border: 2px solid #dee2e6;
}

.price-section .current-price {
    color: #28a745;
}

.product-tabs .nav-tabs {
    border-bottom: 2px solid #dee2e6;
}

.product-tabs .nav-link {
    color: #6c757d;
    border: none;
    padding: 12px 25px;
    font-weight: 500;
    position: relative;
}

.product-tabs .nav-link.active {
    color: #007bff;
    background: none;
    border-bottom: 3px solid #007bff;
}

.product-tabs .nav-link:hover {
    color: #0056b3;
}

.product-description {
    line-height: 1.8;
    color: #555;
}

.product-description p {
    margin-bottom: 1rem;
}

.sidebar-info .card {
    transition: transform 0.3s;
}

.sidebar-info .card:hover {
    transform: translateY(-5px);
}

.product-card-small {
    transition: all 0.3s;
}

.product-card-small:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}

.product-image-small {
    height: 150px;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f8f9fa;
}

.product-image-small img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s;
}

.product-card-small:hover .product-image-small img {
    transform: scale(1.05);
}

.discount-badge {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}
</style>
@endpush

@push('scripts')
<script>
function trackRedirect(productId) {
    // Envoyer une statistique de clic
    fetch('/api/track-product-click', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            product_id: productId
        })
    }).catch(err => console.error('Tracking error:', err));
}

// Animation des prix
document.addEventListener('DOMContentLoaded', function() {
    const priceElement = document.querySelector('.current-price');
    if (priceElement) {
        const price = parseFloat(priceElement.textContent.replace(/[^0-9]/g, ''));
        let current = 0;
        const increment = price / 100;

        const updatePrice = () => {
            if (current < price) {
                current += increment;
                priceElement.textContent = Math.ceil(current).toLocaleString('fr-FR') + ' FCFA';
                setTimeout(updatePrice, 20);
            }
        };

        // Démarrer l'animation quand visible
        const observer = new IntersectionObserver((entries) => {
            if (entries[0].isIntersecting) {
                updatePrice();
                observer.unobserve(priceElement);
            }
        });

        observer.observe(priceElement);
    }
});
</script>
@endpush
