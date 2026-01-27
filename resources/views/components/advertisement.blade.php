@php
use App\Models\Advertisement;

// Récupérer les publicités actives selon l'emplacement
$ads = Advertisement::where('status', true)
    ->where('payment_status', 'paid')
    ->where('end_date', '>=', now())
    ->where('target', 'public')
    ->where('placement', $placement ?? 'sidebar')
    ->orderBy('priority', 'desc')
    ->orderBy('created_at', 'desc')
    ->take($limit ?? 3)
    ->get();
@endphp

@if($ads->count() > 0)
<div class="advertisement-container {{ $placement ?? 'sidebar' }}-ads">
    @if(isset($title) && $title)
    <div class="advertisement-header">
        <h6 class="mb-3">
            <i class="fas fa-ad me-2"></i>{{ $title }}
        </h6>
    </div>
    @endif

    <div class="advertisement-content">
        @foreach($ads as $ad)
        <div class="ad-item mb-3" data-ad-id="{{ $ad->id }}">
            <a href="{{ route('advertise.redirect', $ad->id) }}"
               target="_blank"
               class="text-decoration-none ad-link"
               onclick="trackAdClick({{ $ad->id }})">
                @if($ad->image)
                <div class="ad-image mb-2">
                    <img src="{{ asset('StockPiece/ads/public/' . $ad->image) }}"
                         alt="{{ $ad->title }}"
                         class="img-fluid rounded"
                         style="{{ $placement == 'sidebar' ? 'max-height: 150px; object-fit: cover; width: 100%;' : 'max-height: 80px; object-fit: contain;' }}">
                </div>
                @endif

                <div class="ad-info">
                    <p class="ad-title mb-1 small">{{ Str::limit($ad->title, 50) }}</p>
                    @if($placement == 'sidebar')
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">{{ $ad->advertiser_name }}</small>
                        <span class="badge badge-sm
                            @switch($ad->placement)
                                @case('header') bg-primary @break
                                @case('sidebar') bg-info @break
                                @case('footer') bg-secondary @break
                                @case('popup') bg-warning @break
                            @endswitch">
                            {{ $ad->placement }}
                        </span>
                    </div>
                    @endif
                </div>
            </a>
        </div>
        @endforeach
    </div>

    @if(isset($showCTA) && $showCTA)
    <div class="advertisement-footer mt-3">
        <a href="{{ route('advertise.index') }}" class="btn btn-sm btn-outline-primary w-100">
            <i class="fas fa-bullhorn me-1"></i>Devenir annonceur
        </a>
    </div>
    @endif
</div>

<style>
.advertisement-container {
    background: white;
    border-radius: 10px;
    padding: 15px;
    border: 1px solid #eaeaea;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.advertisement-header h6 {
    color: #2c3e50;
    font-weight: 600;
    border-bottom: 2px solid #3498db;
    padding-bottom: 8px;
}

.ad-item {
    transition: transform 0.3s ease;
    border-radius: 8px;
    overflow: hidden;
}

.ad-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.ad-link {
    color: #333;
    display: block;
}

.ad-link:hover {
    color: #3498db;
}

.ad-title {
    font-weight: 500;
    line-height: 1.4;
}

.ad-image {
    overflow: hidden;
    border-radius: 6px;
}

.ad-image img {
    transition: transform 0.5s ease;
}

.ad-item:hover .ad-image img {
    transform: scale(1.05);
}

.badge {
    font-size: 0.7rem;
    padding: 3px 8px;
}
</style>

<script>
function trackAdClick(adId) {
    // Envoyer une requête pour tracker le clic
    fetch(`/advertise/${adId}/click`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        }
    });
}
</script>
@endif
