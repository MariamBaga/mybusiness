@extends('layouts.master')

@section('title', 'Facturation - Espace Client MyBusiness')

@section('content')

<!-- =========================
    BREADCRUMB
========================= -->
<section class="ht-breadcrumb-area">
    @include('components.breadcrumb', [
        'title' => 'Facturation',
        'parent' => 'Tableau de bord',
        'parent_url' => route('client.dashboard'),
        'active' => 'Facturation'
    ])
</section>

<!-- =========================
    FACTURATION
========================= -->
<section class="section-padding">
    <div class="container">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3 mb-4">
                <div class="client-sidebar card border-0 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-file-invoice-dollar me-2"></i>Facturation
                        </h5>
                    </div>
                    <div class="list-group list-group-flush">
                        <a href="{{ route('client.dashboard') }}"
                           class="list-group-item list-group-item-action">
                            <i class="fas fa-tachometer-alt me-2"></i>Tableau de bord
                        </a>
                        <a href="{{ route('client.profile') }}"
                           class="list-group-item list-group-item-action">
                            <i class="fas fa-user-edit me-2"></i>Profil
                        </a>
                        <a href="{{ route('client.billing') }}"
                           class="list-group-item list-group-item-action active">
                            <i class="fas fa-file-invoice-dollar me-2"></i>Facturation
                        </a>
                        <a href="{{ route('client.documents') }}"
                           class="list-group-item list-group-item-action">
                            <i class="fas fa-file-download me-2"></i>Documents
                        </a>
                        <a href="{{ route('client.notifications') }}"
                           class="list-group-item list-group-item-action">
                            <i class="fas fa-bell me-2"></i>Notifications
                        </a>
                    </div>
                </div>

                <!-- Résumé -->
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-body">
                        <h6 class="card-title">
                            <i class="fas fa-chart-pie me-2 text-primary"></i>Résumé
                        </h6>
                        <div class="mt-3">
                            <p class="mb-2">
                                <small class="text-muted">Dernière facture</small><br>
                                <strong>15 Nov 2024</strong>
                            </p>
                            <p class="mb-2">
                                <small class="text-muted">Prochaine échéance</small><br>
                                <strong>15 Déc 2024</strong>
                            </p>
                            <p class="mb-0">
                                <small class="text-muted">Statut</small><br>
                                <span class="badge bg-success">À jour</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contenu principal -->
            <div class="col-lg-9">
                <!-- En-tête -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h3 class="mb-0">
                            <i class="fas fa-file-invoice-dollar text-primary me-2"></i>
                            Mes factures
                        </h3>
                        <p class="text-muted mb-0">Historique et gestion de vos factures</p>
                    </div>
                    <button class="ht-btn">
                        <i class="fas fa-download me-2"></i>Télécharger tout
                    </button>
                </div>

                <!-- Alertes -->
                <div class="alert alert-info">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-info-circle fa-2x me-3"></i>
                        <div>
                            <h5 class="alert-heading mb-2">Information importante</h5>
                            <p class="mb-0">
                                Toutes vos factures sont disponibles au format PDF.
                                Vous pouvez les télécharger ou les imprimer à tout moment.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Liste des factures -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="mb-0">
                            <i class="fas fa-receipt me-2"></i>
                            Historique des factures
                        </h5>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Facture N°</th>
                                        <th>Date</th>
                                        <th>Montant</th>
                                        <th>Période</th>
                                        <th>Statut</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Facture 1 -->
                                    <tr>
                                        <td>
                                            <strong>#INV-2024-001</strong><br>
                                            <small class="text-muted">MyBusiness Pro</small>
                                        </td>
                                        <td>
                                            15 Nov 2024
                                        </td>
                                        <td>
                                            <strong class="text-primary">25 000 FCFA</strong>
                                        </td>
                                        <td>
                                            01 Nov - 30 Nov 2024
                                        </td>
                                        <td>
                                            <span class="badge bg-success">Payée</span>
                                        </td>
                                        <td class="text-end">
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-sm btn-outline-primary" title="Voir">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-success" title="Télécharger">
                                                    <i class="fas fa-download"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-info" title="Imprimer">
                                                    <i class="fas fa-print"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Facture 2 -->
                                    <tr>
                                        <td>
                                            <strong>#INV-2024-002</strong><br>
                                            <small class="text-muted">MyBusiness Pro</small>
                                        </td>
                                        <td>
                                            15 Oct 2024
                                        </td>
                                        <td>
                                            <strong class="text-primary">25 000 FCFA</strong>
                                        </td>
                                        <td>
                                            01 Oct - 31 Oct 2024
                                        </td>
                                        <td>
                                            <span class="badge bg-success">Payée</span>
                                        </td>
                                        <td class="text-end">
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-sm btn-outline-primary" title="Voir">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-success" title="Télécharger">
                                                    <i class="fas fa-download"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-info" title="Imprimer">
                                                    <i class="fas fa-print"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Facture 3 -->
                                    <tr>
                                        <td>
                                            <strong>#INV-2024-003</strong><br>
                                            <small class="text-muted">MyBusiness Pro</small>
                                        </td>
                                        <td>
                                            15 Sep 2024
                                        </td>
                                        <td>
                                            <strong class="text-primary">25 000 FCFA</strong>
                                        </td>
                                        <td>
                                            01 Sep - 30 Sep 2024
                                        </td>
                                        <td>
                                            <span class="badge bg-success">Payée</span>
                                        </td>
                                        <td class="text-end">
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-sm btn-outline-primary" title="Voir">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-success" title="Télécharger">
                                                    <i class="fas fa-download"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-info" title="Imprimer">
                                                    <i class="fas fa-print"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Facture 4 -->
                                    <tr>
                                        <td>
                                            <strong>#INV-2024-004</strong><br>
                                            <small class="text-muted">MyBusiness Pro</small>
                                        </td>
                                        <td>
                                            15 Août 2024
                                        </td>
                                        <td>
                                            <strong class="text-primary">25 000 FCFA</strong>
                                        </td>
                                        <td>
                                            01 Août - 31 Août 2024
                                        </td>
                                        <td>
                                            <span class="badge bg-success">Payée</span>
                                        </td>
                                        <td class="text-end">
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-sm btn-outline-primary" title="Voir">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-success" title="Télécharger">
                                                    <i class="fas fa-download"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-info" title="Imprimer">
                                                    <i class="fas fa-print"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card-footer bg-white border-top">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <small class="text-muted">
                                    Affichage de 4 factures sur 12
                                </small>
                            </div>
                            <nav>
                                <ul class="pagination pagination-sm mb-0">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#">Précédent</a>
                                    </li>
                                    <li class="page-item active">
                                        <a class="page-link" href="#">1</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">2</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">3</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">Suivant</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Abonnement actuel -->
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="mb-0">
                            <i class="fas fa-crown me-2 text-warning"></i>
                            Mon abonnement actuel
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-3 text-center mb-3 mb-md-0">
                                <div class="plan-icon">
                                    <i class="fas fa-star fa-3x text-warning"></i>
                                </div>
                                <h4 class="mt-3">Pro</h4>
                            </div>
                            <div class="col-md-6">
                                <h5 class="mb-2">MyBusiness Pro</h5>
                                <p class="text-muted mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    Fonctionnalités avancées
                                </p>
                                <p class="text-muted mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    Rapports détaillés
                                </p>
                                <p class="text-muted mb-0">
                                    <i class="fas fa-check text-success me-2"></i>
                                    Support prioritaire
                                </p>
                            </div>
                            <div class="col-md-3 text-md-end">
                                <div class="price-display">
                                    <h2 class="text-primary mb-0">25 000</h2>
                                    <p class="text-muted mb-3">FCFA / mois</p>
                                    <button class="ht-btn btn-sm">
                                        <i class="fas fa-sync me-1"></i>Changer de plan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Méthodes de paiement -->
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="mb-0">
                            <i class="fas fa-credit-card me-2 text-success"></i>
                            Méthodes de paiement
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Orange Money -->
                            <div class="col-md-4 mb-3">
                                <div class="payment-method card h-100 border">
                                    <div class="card-body text-center">
                                        <div class="payment-icon mb-3">
                                            <i class="fas fa-mobile-alt fa-3x text-orange"></i>
                                        </div>
                                        <h6>Orange Money</h6>
                                        <p class="text-muted small">**** **** 1234</p>
                                        <span class="badge bg-success">Défaut</span>
                                    </div>
                                </div>
                            </div>

                            <!-- MTN Mobile Money -->
                            <div class="col-md-4 mb-3">
                                <div class="payment-method card h-100 border">
                                    <div class="card-body text-center">
                                        <div class="payment-icon mb-3">
                                            <i class="fas fa-money-bill-wave fa-3x text-yellow"></i>
                                        </div>
                                        <h6>MTN Mobile Money</h6>
                                        <p class="text-muted small">**** **** 5678</p>
                                        <button class="btn btn-sm btn-outline-primary mt-2">
                                            <i class="fas fa-edit me-1"></i>Modifier
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Ajouter une méthode -->
                            <div class="col-md-4 mb-3">
                                <div class="payment-method card h-100 border border-dashed">
                                    <div class="card-body text-center d-flex flex-column justify-content-center">
                                        <div class="payment-icon mb-3">
                                            <i class="fas fa-plus-circle fa-3x text-muted"></i>
                                        </div>
                                        <h6 class="text-muted">Ajouter une méthode</h6>
                                        <button class="btn btn-outline-secondary btn-sm mt-2">
                                            <i class="fas fa-plus me-1"></i>Ajouter
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================
    SUPPORT FACTURATION
========================= -->
<section class="section-padding bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h4 class="mb-3">Besoin d'aide avec votre facturation ?</h4>
                <p class="mb-0">
                    Notre équipe support est disponible pour répondre à toutes vos questions
                    concernant vos factures, paiements ou changement d'abonnement.
                </p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('support.contact') }}" class="ht-btn style-3">
                    <i class="fas fa-headset me-2"></i>Contacter le support
                </a>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
.table-hover tbody tr:hover {
    background-color: rgba(102, 126, 234, 0.05);
}

.table th {
    font-weight: 600;
    color: #495057;
    border-bottom: 2px solid #dee2e6;
}

.table td {
    vertical-align: middle;
}

.badge {
    padding: 6px 12px;
    font-weight: 500;
}

.payment-method {
    transition: all 0.3s ease;
    border-radius: 10px;
    overflow: hidden;
}

.payment-method:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    border-color: #667eea !important;
}

.payment-method.border-dashed {
    border-style: dashed !important;
}

.payment-icon .text-orange {
    color: #ff6b00;
}

.payment-icon .text-yellow {
    color: #ffc107;
}

.plan-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto;
    background: rgba(255, 193, 7, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.price-display h2 {
    font-size: 2.5rem;
    font-weight: 700;
}

.alert {
    border-radius: 10px;
    border-left: 4px solid #17a2b8;
}

.btn-group .btn {
    border-radius: 5px;
    margin: 0 2px;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation des montants
    const amounts = document.querySelectorAll('.table td strong.text-primary');

    amounts.forEach(amount => {
        const text = amount.textContent;
        const value = parseFloat(text.replace(/[^0-9]/g, ''));

        if (!isNaN(value)) {
            let current = 0;
            const increment = value / 50;

            const updateAmount = () => {
                if (current < value) {
                    current += increment;
                    amount.textContent = Math.ceil(current).toLocaleString('fr-FR') + ' FCFA';
                    setTimeout(updateAmount, 30);
                } else {
                    amount.textContent = value.toLocaleString('fr-FR') + ' FCFA';
                }
            };

            // Observer pour déclencher l'animation quand visible
            const observer = new IntersectionObserver((entries) => {
                if (entries[0].isIntersecting) {
                    updateAmount();
                    observer.unobserve(amount);
                }
            });

            observer.observe(amount);
        }
    });

    // Confirmation avant téléchargement
    const downloadButtons = document.querySelectorAll('.btn-outline-success');
    downloadButtons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const row = this.closest('tr');
            const invoiceNumber = row.querySelector('strong').textContent;

            if (confirm(`Télécharger la facture ${invoiceNumber} ?`)) {
                // Simuler le téléchargement
                const link = document.createElement('a');
                link.href = '#';
                link.download = `${invoiceNumber}.pdf`;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);

                // Notification
                showNotification(`Facture ${invoiceNumber} téléchargée`);
            }
        });
    });

    function showNotification(message) {
        const notification = document.createElement('div');
        notification.className = 'alert alert-success position-fixed';
        notification.style.cssText = `
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        `;
        notification.innerHTML = `
            <i class="fas fa-check-circle me-2"></i>
            ${message}
        `;

        document.body.appendChild(notification);

        setTimeout(() => {
            notification.style.opacity = '0';
            notification.style.transition = 'opacity 0.5s';
            setTimeout(() => notification.remove(), 500);
        }, 3000);
    }
});
</script>
@endpush
