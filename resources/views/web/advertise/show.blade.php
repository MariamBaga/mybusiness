@extends('layouts.master')

@section('title', 'Publicités sur MyBusiness')

@section('content')

<!-- =========================
    BREADCRUMB
========================= -->
<section class="ht-breadcrumb-area">
    @include('components.breadcrumb', [
        'title' => 'Publicités',
        'active' => 'Découvrez nos annonceurs'
    ])
</section>

<!-- =========================
    PUBLICITÉS ACTIVES
========================= -->
<section class="section-padding">
    <div class="container">
        <div class="section-title text-center mb-5">
            <h2 class="title">Nos Annonceurs</h2>
            <p class="lead">Découvrez les entreprises qui font confiance à MyBusiness</p>
        </div>

        @if($ads->count() > 0)
        <div class="row g-4">
            @foreach($ads as $ad)
            <div class="col-lg-4 col-md-6">
                <div class="ad-card card h-100 border-0 shadow-sm">
                    <div class="card-img-top position-relative">
                        @if($ad->image)
                            <img src="{{ asset('StockPiece/ads/public/' . $ad->image) }}"
                                 class="card-img-top"
                                 alt="{{ $ad->title }}"
                                 style="height: 200px; object-fit: cover;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center"
                                 style="height: 200px;">
                                <i class="fas fa-ad fa-3x text-muted"></i>
                            </div>
                        @endif

                        <div class="position-absolute top-0 end-0 m-3">
                            @switch($ad->placement)
                                @case('header')
                                    <span class="badge bg-primary">Header</span>
                                    @break
                                @case('sidebar')
                                    <span class="badge bg-info">Sidebar</span>
                                    @break
                                @case('footer')
                                    <span class="badge bg-secondary">Footer</span>
                                    @break
                                @case('popup')
                                    <span class="badge bg-warning">Popup</span>
                                    @break
                            @endswitch
                        </div>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">{{ $ad->title }}</h5>
                        <p class="card-text text-muted">
                            @if($ad->description)
                                {{ Str::limit($ad->description, 100) }}
                            @else
                                <small class="text-muted">Aucune description</small>
                            @endif
                        </p>

                        <div class="advertiser-info mb-3">
                            <p class="mb-1">
                                <i class="fas fa-building text-primary me-1"></i>
                                <strong>{{ $ad->advertiser_name }}</strong>
                            </p>
                            @if($ad->advertiser_website)
                            <p class="mb-1">
                                <i class="fas fa-globe text-success me-1"></i>
                                <a href="{{ $ad->advertiser_website }}" target="_blank" class="text-decoration-none">
                                    {{ parse_url($ad->advertiser_website, PHP_URL_HOST) }}
                                </a>
                            </p>
                            @endif
                        </div>

                        <div class="ad-stats d-flex justify-content-between text-muted small">
                            <span>
                                <i class="fas fa-eye me-1"></i>
                                {{ $ad->views }} vues
                            </span>
                            <span>
                                <i class="fas fa-mouse-pointer me-1"></i>
                                {{ $ad->clicks }} clics
                            </span>
                        </div>
                    </div>

                    <div class="card-footer bg-white border-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                <i class="fas fa-calendar me-1"></i>
                                Jusqu'au {{ $ad->end_date->format('d/m/Y') }}
                            </small>

                            @if($ad->url)
                            <a href="{{ route('advertise.redirect', $ad->id) }}"
                               class="btn btn-sm btn-outline-primary"
                               target="_blank">
                                <i class="fas fa-external-link-alt me-1"></i> Visiter
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-5">
            {{ $ads->links() }}
        </div>
        @else
        <div class="text-center py-5">
            <i class="fas fa-ad fa-4x text-muted mb-3"></i>
            <h4 class="text-muted">Aucune publicité active pour le moment</h4>
            <p class="text-muted">Soyez le premier à promouvoir votre entreprise !</p>
            <a href="{{ route('advertise.create') }}" class="btn btn-primary mt-2">
                <i class="fas fa-plus me-2"></i>Créer une publicité
            </a>
        </div>
        @endif
    </div>
</section>

<!-- =========================
    CTA POUR CRÉER UNE PUBLICITÉ
========================= -->
@if($ads->count() > 0)
<section class="section-padding bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h3>Votre entreprise mérite d'être vue !</h3>
                <p class="mb-0">
                    Rejoignez nos annonceurs et augmentez votre visibilité auprès
                    des commerçants et entrepreneurs africains.
                </p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('advertise.create') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-bullhorn me-2"></i>Devenir annonceur
                </a>
            </div>
        </div>
    </div>
</section>
@endif

@endsection

@push('styles')
<style>
.ad-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-radius: 12px;
    overflow: hidden;
}

.ad-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.1);
}

.card-img-top {
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
}

.badge {
    font-size: 0.75rem;
    padding: 5px 10px;
    border-radius: 20px;
}

.advertiser-info {
    padding: 10px;
    background-color: #f8f9fa;
    border-radius: 8px;
    border-left: 3px solid #3498db;
}

.ad-stats {
    border-top: 1px solid #eaeaea;
    padding-top: 10px;
    font-size: 0.85rem;
}

.card-footer {
    border-top: 1px solid #eaeaea;
    padding-top: 15px;
}
</style>
@endpush
