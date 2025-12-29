<!-- resources/views/admin/ads/partials/details.blade.php -->
<div class="row">
    <div class="col-md-4 text-center">
        <img src="{{ $ad->image_url }}"
             class="img-fluid rounded mb-3"
             alt="{{ $ad->title }}">
    </div>
    <div class="col-md-8">
        <h4 class="mb-3">{{ $ad->title }}</h4>

        <div class="row">
            <div class="col-md-6">
                <p><strong><i class="fas fa-link mr-2 text-primary"></i>URL :</strong><br>
                    @if($ad->url)
                        <a href="{{ $ad->url }}" target="_blank" class="text-break">{{ $ad->url }}</a>
                    @else
                        <span class="text-muted">Aucun lien</span>
                    @endif
                </p>

                <p><strong><i class="fas fa-th-large mr-2 text-primary"></i>Emplacement :</strong><br>
                    <span class="badge badge-{{ $ad->placement_color }}">
                        {{ ucfirst($ad->placement) }}
                    </span>
                </p>

                <p><strong><i class="fas fa-tag mr-2 text-primary"></i>Type :</strong><br>
                    {{ ucfirst($ad->type) }}
                </p>
            </div>

            <div class="col-md-6">
                <p><strong><i class="fas fa-calendar-alt mr-2 text-primary"></i>Période :</strong><br>
                    <span class="text-success">{{ $ad->start_date->format('d/m/Y H:i') }}</span>
                    au
                    <span class="text-danger">{{ $ad->end_date->format('d/m/Y H:i') }}</span>
                </p>

                <p><strong><i class="fas fa-flag mr-2 text-primary"></i>Priorité :</strong><br>
                    {{ $ad->priority }}/10
                </p>

                <p><strong><i class="fas fa-chart-line mr-2 text-primary"></i>Statut :</strong><br>
                    @if($ad->isActive())
                        <span class="badge badge-success">Active</span>
                        <small class="text-muted">({{ $ad->daysRemaining() }} jours restants)</small>
                    @else
                        <span class="badge badge-danger">Inactive</span>
                    @endif
                </p>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-6">
                <h6><i class="fas fa-eye mr-2"></i>Statistiques</h6>
                <p class="mb-1"><strong>Vues :</strong> {{ number_format($ad->views) }}</p>
                <p class="mb-1"><strong>Clics :</strong> {{ number_format($ad->clicks) }}</p>
                <p><strong>CTR :</strong> {{ $ad->ctr }}%</p>
            </div>

            <div class="col-md-6">
                <h6><i class="fas fa-info-circle mr-2"></i>Informations</h6>
                <p class="mb-1"><strong>Créé le :</strong> {{ $ad->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Modifié le :</strong> {{ $ad->updated_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>
    </div>
</div>

<div class="modal-footer">
    <a href="{{ route('ads.edit', $ad->id) }}" class="btn btn-warning">
        <i class="fas fa-edit mr-1"></i> Modifier
    </a>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">
        Fermer
    </button>
</div>
