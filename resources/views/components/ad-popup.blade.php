@php
use App\Models\Advertisement;

// Récupérer une publicité popup active
$popupAd = Advertisement::where('status', true)
    ->where('payment_status', 'paid')
    ->where('end_date', '>=', now())
    ->where('target', 'public')
    ->where('placement', 'popup')
    ->orderBy('priority', 'desc')
    ->first();
@endphp

@if($popupAd && !session('ad_popup_shown'))
<div class="modal fade" id="adPopupModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">
                    <i class="fas fa-ad me-2"></i>Publicité
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <a href="{{ route('advertise.redirect', $popupAd->id) }}"
                   target="_blank"
                   class="ad-popup-link"
                   onclick="trackAdClick({{ $popupAd->id }})">
                    @if($popupAd->image)
                    <img src="{{ asset('StockPiece/ads/public/' . $popupAd->image) }}"
                         alt="{{ $popupAd->title }}"
                         class="img-fluid rounded mb-3"
                         style="max-height: 300px;">
                    @endif

                    <h5>{{ $popupAd->title }}</h5>

                    @if($popupAd->description)
                    <p class="text-muted">{{ $popupAd->description }}</p>
                    @endif

                    <div class="advertiser-info mt-3">
                        <small class="text-muted">
                            <i class="fas fa-building me-1"></i>{{ $popupAd->advertiser_name }}
                        </small>
                    </div>
                </a>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">
                    Fermer
                </button>
                <a href="{{ route('advertise.redirect', $popupAd->id) }}"
                   target="_blank"
                   class="btn btn-sm btn-primary"
                   onclick="trackAdClick({{ $popupAd->id }})">
                    <i class="fas fa-external-link-alt me-1"></i>Visiter
                </a>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Afficher le popup après 5 secondes
    setTimeout(function() {
        const modal = new bootstrap.Modal(document.getElementById('adPopupModal'));
        modal.show();

        // Marquer comme affiché dans la session
        fetch('{{ route("advertise.popup.shown") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        });
    }, 5000);

    // Fermer le popup automatiquement après 30 secondes
    setTimeout(function() {
        const modal = bootstrap.Modal.getInstance(document.getElementById('adPopupModal'));
        if (modal) {
            modal.hide();
        }
    }, 30000);
});
</script>
@endpush

<style>
#adPopupModal .modal-content {
    border-radius: 15px;
    border: 2px solid #3498db;
}

#adPopupModal .modal-header {
    background: linear-gradient(45deg, #3498db, #2980b9);
    color: white;
    border-top-left-radius: 13px;
    border-top-right-radius: 13px;
}

.ad-popup-link {
    text-decoration: none;
    color: #333;
    display: block;
}

.ad-popup-link:hover {
    color: #3498db;
}
</style>
@endif
