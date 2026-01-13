{{-- Modal pour Basic --}}
<div class="modal fade" id="basic-details" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Formule Basic</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Inclus :</h6>
                        <ul class="list-unstyled">
                            <li><i class="fa-solid fa-check text-success me-2"></i> Suivi des ventes temps réel</li>
                            <li><i class="fa-solid fa-check text-success me-2"></i> Gestion des stocks basique</li>
                            <li><i class="fa-solid fa-check text-success me-2"></i> 1 utilisateur</li>
                            <li><i class="fa-solid fa-check text-success me-2"></i> Support email</li>
                            <li><i class="fa-solid fa-check text-success me-2"></i> 1 Go de stockage</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6>Idéal pour :</h6>
                        <ul class="list-unstyled">
                            <li><i class="fa-solid fa-store me-2"></i> Commerçants individuels</li>
                            <li><i class="fa-solid fa-user me-2"></i> Micro-entrepreneurs</li>
                            <li><i class="fa-solid fa-cart-shopping me-2"></i> Vendeurs de marché</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary select-plan"
                        data-plan="Basic" data-price="15.000 FCFA">
                    Choisir ce plan
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Modal pour Pro --}}
<div class="modal fade" id="pro-details" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Formule Pro <span class="badge bg-warning ms-2">Populaire</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Inclus :</h6>
                        <ul class="list-unstyled">
                            <li><i class="fa-solid fa-check text-success me-2"></i> Tout le plan Basic</li>
                            <li><i class="fa-solid fa-check text-success me-2"></i> Rapports détaillés</li>
                            <li><i class="fa-solid fa-check text-success me-2"></i> Analyse clients</li>
                            <li><i class="fa-solid fa-check text-success me-2"></i> Jusqu'à 3 utilisateurs</li>
                            <li><i class="fa-solid fa-check text-success me-2"></i> Support WhatsApp</li>
                            <li><i class="fa-solid fa-check text-success me-2"></i> 5 Go de stockage</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6>Idéal pour :</h6>
                        <ul class="list-unstyled">
                            <li><i class="fa-solid fa-shop me-2"></i> Boutiques</li>
                            <li><i class="fa-solid fa-users me-2"></i> Petites équipes</li>
                            <li><i class="fa-solid fa-chart-line me-2"></i> Croissance rapide</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary select-plan"
                        data-plan="Pro" data-price="35.000 FCFA">
                    Choisir ce plan
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Modal pour Premium --}}
<div class="modal fade" id="premium-details" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Formule Premium</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Inclus :</h6>
                        <ul class="list-unstyled">
                            <li><i class="fa-solid fa-check text-success me-2"></i> Tout le plan Pro</li>
                            <li><i class="fa-solid fa-check text-success me-2"></i> Boutique en ligne</li>
                            <li><i class="fa-solid fa-check text-success me-2"></i> Vente multi-canaux</li>
                            <li><i class="fa-solid fa-check text-success me-2"></i> Utilisateurs illimités</li>
                            <li><i class="fa-solid fa-check text-success me-2"></i> Support prioritaire 24/7</li>
                            <li><i class="fa-solid fa-check text-success me-2"></i> 20 Go de stockage</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6>Idéal pour :</h6>
                        <ul class="list-unstyled">
                            <li><i class="fa-solid fa-building me-2"></i> PME</li>
                            <li><i class="fa-solid fa-globe me-2"></i> Vente en ligne</li>
                            <li><i class="fa-solid fa-network-wired me-2"></i> Réseaux de points de vente</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary select-plan"
                        data-plan="Premium" data-price="65.000 FCFA">
                    Choisir ce plan
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Modal de souscription --}}
<div class="modal fade" id="subscriptionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Souscrire à <span id="selected-plan"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Vous êtes sur le point de souscrire à la formule <strong id="selected-plan-text"></strong>
                au prix de <strong id="selected-price-text"></strong>/mois.</p>

                <div class="alert alert-info">
                    <i class="fa-solid fa-info-circle me-2"></i>
                    Vous bénéficierez d'un essai gratuit de 14 jours avant tout paiement.
                </div>

                <form id="subscription-form">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Téléphone</label>
                        <input type="tel" class="form-control" id="phone" required>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="terms" required>
                        <label class="form-check-label" for="terms">
                            J'accepte les <a href="{{ route('pages.legal') }}">conditions générales</a>
                        </label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" onclick="submitSubscription()">
                    Confirmer la souscription
                </button>
            </div>
        </div>
    </div>
</div>
