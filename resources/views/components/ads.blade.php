@php
use Illuminate\Support\Str;

// Pages où on n'affiche PAS les pubs
$excludedPages = [
    'advertise.*',
    'admin.*',
    'dashboard',
    'client.*',
    'partner.*',
    'member.*',
    'login',
    'register',
    'password.*',
    'pages.demo',
    'pages.pricing'
];

$currentRoute = Route::currentRouteName();
$showAds = true;

// Vérifier si la page actuelle est exclue
foreach($excludedPages as $excluded) {
    if(Str::is($excluded, $currentRoute)) {
        $showAds = false;
        break;
    }
}

// Vérifier si l'utilisateur est admin
if(auth()->check() && auth()->user()->hasRole('admin')) {
    $showAds = false;
}

// Récupérer les pubs si on doit les afficher
$headerAds = $showAds ? \App\Models\Advertisement::where('status', true)
    ->where('payment_status', 'paid')
    ->where('end_date', '>=', now())
    ->where('target', 'public')
    ->where('placement', 'header')
    ->orderBy('priority', 'desc')
    ->orderBy('created_at', 'desc')
    ->take(1)
    ->get() : collect();

$popupAds = $showAds ? \App\Models\Advertisement::where('status', true)
    ->where('payment_status', 'paid')
    ->where('end_date', '>=', now())
    ->where('target', 'public')
    ->where('placement', 'popup')
    ->orderBy('priority', 'desc')
    ->orderBy('created_date', 'desc')
    ->take(1)
    ->get() : collect();
@endphp

<!-- Styles pour les publicités -->
<style>
/* Header ads */
.header-ad-container {
    background: linear-gradient(90deg, #2c3e50, #4a6491);
    color: white;
    padding: 8px 0;
    text-align: center;
    position: relative;
    border-bottom: 1px solid rgba(255,255,255,0.1);
}

.header-ad {
    color: white;
    text-decoration: none;
    display: inline-block;
    padding: 5px 20px;
    transition: all 0.3s ease;
}

.header-ad:hover {
    color: #ffc107;
    transform: translateY(-2px);
}

.header-ad .advertiser {
    font-size: 0.85rem;
    opacity: 0.9;
    display: block;
}

/* Sidebar ads */
.sidebar-ads {
    background: white;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 30px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    border: 1px solid #eaeaea;
}

.sidebar-ads h6 {
    color: #2c3e50;
    font-weight: 600;
    border-bottom: 2px solid #3498db;
    padding-bottom: 10px;
    margin-bottom: 20px;
}

.ad-item {
    margin-bottom: 15px;
    border-radius: 8px;
    overflow: hidden;
    transition: all 0.3s ease;
    border: 1px solid #f0f0f0;
}

.ad-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    border-color: #3498db;
}

.ad-link {
    display: block;
    padding: 10px;
    color: #333;
    text-decoration: none;
}

.ad-link:hover {
    color: #3498db;
}

.ad-image {
    border-radius: 6px;
    overflow: hidden;
    margin-bottom: 10px;
}

.ad-image img {
    width: 100%;
    height: 120px;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.ad-item:hover .ad-image img {
    transform: scale(1.05);
}

.ad-title {
    font-size: 0.9rem;
    font-weight: 500;
    margin-bottom: 5px;
    line-height: 1.4;
}

.ad-advertiser {
    font-size: 0.8rem;
    color: #666;
}

.ad-badge {
    font-size: 0.7rem;
    padding: 2px 8px;
    border-radius: 12px;
    background: #f8f9fa;
    color: #666;
    border: 1px solid #dee2e6;
}

/* Footer ads */
.footer-ads {
    background: #2c3e50;
    color: white;
    padding: 30px 0;
    margin-top: 50px;
}

.footer-ad-container {
    text-align: center;
}

.footer-ad {
    display: inline-block;
    margin: 0 15px;
    color: white;
    text-decoration: none;
    padding: 10px 20px;
    background: rgba(255,255,255,0.1);
    border-radius: 8px;
    transition: all 0.3s ease;
}

.footer-ad:hover {
    background: rgba(255,255,255,0.2);
    color: #ffc107;
    transform: translateY(-2px);
}

/* Popup ads */
.popup-ad-modal .modal-content {
    border-radius: 15px;
    border: 3px solid #3498db;
    overflow: hidden;
}

.popup-ad-header {
    background: linear-gradient(45deg, #3498db, #2980b9);
    color: white;
    border: none;
}

.popup-ad-body img {
    max-height: 300px;
    object-fit: contain;
    margin: 0 auto;
    display: block;
}

.popup-ad-title {
    color: #2c3e50;
    font-weight: 600;
    margin: 15px 0 10px;
}

/* CTA pour devenir annonceur */
.ad-cta {
    background: linear-gradient(45deg, #3498db, #2980b9);
    color: white;
    padding: 12px 20px;
    border-radius: 8px;
    display: block;
    text-align: center;
    text-decoration: none;
    font-weight: 500;
    margin-top: 15px;
    transition: all 0.3s ease;
    border: none;
    width: 100%;
}

.ad-cta:hover {
    background: linear-gradient(45deg, #2980b9, #21618c);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
}

/* Responsive */
@media (max-width: 768px) {
    .sidebar-ads {
        padding: 15px;
    }

    .footer-ad {
        margin: 5px;
        padding: 8px 15px;
    }

    .header-ad-container {
        padding: 5px 0;
        font-size: 0.9rem;
    }
}
</style>

<!-- Bannière header -->
@if($headerAds->count() > 0)
<div class="header-ad-container">
    @foreach($headerAds as $ad)
    <a href="{{ route('advertise.redirect', $ad->id) }}"
       class="header-ad"
       target="_blank"
       onclick="trackAdClick({{ $ad->id }})">
        <strong>{{ $ad->title }}</strong>
        <span class="advertiser">• {{ $ad->advertiser_name }} •</span>
    </a>
    @endforeach
</div>
@endif

<!-- Popup publicitaire -->
@if($popupAds->count() > 0 && !session('ad_popup_shown') && $showAds)
<div class="modal fade popup-ad-modal" id="adPopupModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header popup-ad-header">
                <h6 class="modal-title">
                    <i class="fas fa-ad me-2"></i>Publicité
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                @foreach($popupAds as $ad)
                <a href="{{ route('advertise.redirect', $ad->id) }}"
                   target="_blank"
                   class="popup-ad-link"
                   onclick="trackAdClick({{ $ad->id }})">
                    @if($ad->image)
                    <img src="{{ asset('StockPiece/ads/public/' . $ad->image) }}"
                         alt="{{ $ad->title }}"
                         class="img-fluid rounded mb-3">
                    @endif

                    <h5 class="popup-ad-title">{{ $ad->title }}</h5>

                    @if($ad->description)
                    <p class="text-muted">{{ Str::limit($ad->description, 100) }}</p>
                    @endif

                    <div class="advertiser-info mt-3">
                        <small class="text-muted">
                            <i class="fas fa-building me-1"></i>{{ $ad->advertiser_name }}
                        </small>
                    </div>
                </a>
                @endforeach
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Fermer
                </button>
                <a href="{{ route('advertise.redirect', $ad->id) }}"
                   target="_blank"
                   class="btn btn-sm btn-primary"
                   onclick="trackAdClick({{ $ad->id }})">
                    <i class="fas fa-external-link-alt me-1"></i>Visiter le site
                </a>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Afficher le popup après 8 secondes
    setTimeout(function() {
        const modalElement = document.getElementById('adPopupModal');
        if (modalElement) {
            const modal = new bootstrap.Modal(modalElement);
            modal.show();

            // Marquer comme affiché dans la session
            fetch('{{ route("advertise.popup.shown") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                }
            });

            // Fermer automatiquement après 30 secondes
            setTimeout(function() {
                modal.hide();
            }, 30000);
        }
    }, 8000);
});
</script>
@endif
