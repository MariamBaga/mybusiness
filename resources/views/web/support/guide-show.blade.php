{{-- resources/views/web/support/guide-show.blade.php --}}
@extends('layouts.master')

@section('title', $guide['title'] . ' - Guides MyBusiness')

@section('content')

<!-- =========================
    BREADCRUMB
========================= -->
<section class="ht-breadcrumb-area">
    @include('components.breadcrumb', [
        'title' => $guide['title'],
        'parent' => 'Guides',
        'parent_url' => route('support.guides'),
        'active' => 'Guide'
    ])
</section>

<!-- =========================
    GUIDE DÉTAILLÉ
========================= -->
<section class="section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- En-tête du guide -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-4">
                            <div>
                                <h1 class="h2 mb-2">{{ $guide['title'] }}</h1>
                                <div class="d-flex align-items-center gap-3 text-muted">
                                    <small>
                                        <i class="fas fa-calendar me-1"></i>
                                        {{ $guide['created_at']->format('d/m/Y') }}
                                    </small>
                                    <small>
                                        <i class="fas fa-eye me-1"></i>
                                        {{ $guide['views'] }} vues
                                    </small>
                                    <small>
                                        <i class="fas fa-clock me-1"></i>
                                        10 min de lecture
                                    </small>
                                </div>
                            </div>
                            <div>
                                <button class="btn btn-outline-primary">
                                    <i class="fas fa-print"></i>
                                </button>
                                <button class="btn btn-outline-primary">
                                    <i class="fas fa-share-alt"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Table des matières -->
                        <div class="card border mb-4">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">
                                    <i class="fas fa-list me-2"></i>
                                    Table des matières
                                </h6>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled mb-0">
                                    <li><a href="#introduction" class="text-decoration-none">Introduction</a></li>
                                    <li><a href="#prerequis" class="text-decoration-none">Prérequis</a></li>
                                    <li><a href="#etape1" class="text-decoration-none">Étape 1 : Configuration initiale</a></li>
                                    <li><a href="#etape2" class="text-decoration-none">Étape 2 : Utilisation des fonctionnalités</a></li>
                                    <li><a href="#conclusion" class="text-decoration-none">Conclusion</a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- Contenu du guide -->
                        <div class="guide-content">
                            <h3 id="introduction">Introduction</h3>
                            <p>Ce guide vous explique comment utiliser cette fonctionnalité de MyBusiness.</p>

                            <h3 id="prerequis">Prérequis</h3>
                            <ul>
                                <li>Un compte MyBusiness actif</li>
                                <li>Accès à internet</li>
                                <li>Navigateur web à jour</li>
                            </ul>

                            <h3 id="etape1">Étape 1 : Configuration initiale</h3>
                            <p>Suivez ces étapes pour configurer votre compte :</p>
                            <ol>
                                <li>Connectez-vous à votre compte</li>
                                <li>Accédez aux paramètres</li>
                                <li>Configurez les options de base</li>
                            </ol>

                            <h3 id="etape2">Étape 2 : Utilisation des fonctionnalités</h3>
                            <p>Découvrez comment utiliser les principales fonctionnalités...</p>

                            <h3 id="conclusion">Conclusion</h3>
                            <p>Vous êtes maintenant prêt à utiliser cette fonctionnalité !</p>

                            <div class="alert alert-info mt-4">
                                <i class="fas fa-lightbulb me-2"></i>
                                <strong>Astuce :</strong> Pour plus d'informations, consultez notre FAQ.
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="d-flex justify-content-between align-items-center mt-5 pt-4 border-top">
                            <a href="{{ route('support.guides') }}" class="btn btn-outline-primary">
                                <i class="fas fa-arrow-left me-2"></i>
                                Retour aux guides
                            </a>
                            <div>
                                <button class="btn btn-primary">
                                    <i class="fas fa-thumbs-up me-2"></i>
                                    Cet article était utile
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Commentaires -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="mb-4">
                            <i class="fas fa-comments me-2"></i>
                            Commentaires
                        </h5>
                        <div class="alert alert-info">
                            Les commentaires sont désactivés pour le moment. Si vous avez des questions,
                            <a href="{{ route('support.contact') }}" class="alert-link">contactez notre support</a>.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Navigation rapide -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h6 class="mb-3">
                            <i class="fas fa-link me-2"></i>
                            Navigation rapide
                        </h6>
                        <div class="list-group list-group-flush">
                            <a href="#introduction" class="list-group-item list-group-item-action border-0 px-0 py-2">
                                Introduction
                            </a>
                            <a href="#prerequis" class="list-group-item list-group-item-action border-0 px-0 py-2">
                                Prérequis
                            </a>
                            <a href="#etape1" class="list-group-item list-group-item-action border-0 px-0 py-2">
                                Étape 1 : Configuration
                            </a>
                            <a href="#etape2" class="list-group-item list-group-item-action border-0 px-0 py-2">
                                Étape 2 : Utilisation
                            </a>
                            <a href="#conclusion" class="list-group-item list-group-item-action border-0 px-0 py-2">
                                Conclusion
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Guides connexes -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h6 class="mb-3">
                            <i class="fas fa-book me-2"></i>
                            Guides connexes
                        </h6>
                        <div class="list-group list-group-flush">
                            <a href="{{ route('support.guides.show', 'creer-compte') }}"
                               class="list-group-item list-group-item-action border-0 px-0 py-2">
                                Comment créer votre compte
                            </a>
                            <a href="{{ route('support.guides.show', 'modifier-profil') }}"
                               class="list-group-item list-group-item-action border-0 px-0 py-2">
                                Modifier votre profil
                            </a>
                            <a href="{{ route('support.guides.show', 'demarrage-mybusiness') }}"
                               class="list-group-item list-group-item-action border-0 px-0 py-2">
                                Démarrer avec MyBusiness
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Support -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="fas fa-headset fa-3x text-primary"></i>
                        </div>
                        <h6 class="mb-3">Besoin d'aide ?</h6>
                        <p class="text-muted small mb-3">
                            Notre équipe support est disponible pour vous aider.
                        </p>
                        <div class="d-grid gap-2">
                            <a href="{{ route('tickets.create') }}" class="btn btn-sm btn-primary">
                                Ouvrir un ticket
                            </a>
                            <a href="{{ route('support.contact') }}" class="btn btn-sm btn-outline-primary">
                                Nous contacter
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
.guide-content h3 {
    margin-top: 2rem;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #eaeaea;
}

.guide-content ul,
.guide-content ol {
    padding-left: 1.5rem;
    margin-bottom: 1rem;
}

.list-group-item.active {
    background-color: #667eea;
    border-color: #667eea;
}
</style>
@endpush

@push('scripts')
<script>
// Navigation fluide
document.querySelectorAll('.list-group-item[href^="#"]').forEach(item => {
    item.addEventListener('click', function(e) {
        e.preventDefault();
        const targetId = this.getAttribute('href');
        const targetElement = document.querySelector(targetId);

        if (targetElement) {
            window.scrollTo({
                top: targetElement.offsetTop - 100,
                behavior: 'smooth'
            });
        }
    });
});

// Marquer comme utile
document.querySelector('button.btn-primary').addEventListener('click', function() {
    this.innerHTML = '<i class="fas fa-check me-2"></i>Merci pour votre retour !';
    this.classList.remove('btn-primary');
    this.classList.add('btn-success');
    this.disabled = true;
});
</script>
@endpush
