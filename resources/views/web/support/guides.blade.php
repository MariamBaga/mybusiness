@extends('layouts.master')

@section('title', 'Guides et tutoriels - Support MyBusiness')

@section('content')

<!-- =========================
    BREADCRUMB
========================= -->
<section class="ht-breadcrumb-area">
    @include('components.breadcrumb', [
        'title' => 'Guides et Tutoriels',
        'parent' => 'Support',
        'parent_url' => route('support.faq'),
        'active' => 'Documentation'
    ])
</section>

<!-- =========================
    GUIDES ET TUTORIELS
========================= -->
<section class="section-padding">
    <div class="container">
        <!-- Introduction -->
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-5 fw-bold mb-4">Guides et Tutoriels</h1>
                <p class="lead text-muted mb-4">
                    Découvrez notre documentation complète pour tirer le meilleur parti de MyBusiness.
                    Des guides étape par étape pour chaque fonctionnalité.
                </p>
                <div class="input-group mx-auto" style="max-width: 500px;">
                    <input type="text"
                           class="form-control"
                           placeholder="Rechercher un guide..."
                           id="searchGuides">
                    <button class="btn btn-primary" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Catégories -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h4 class="mb-4">
                            <i class="fas fa-folder-open me-2 text-primary"></i>
                            Parcourir par catégorie
                        </h4>
                        <div class="row g-3">
                            @foreach($categories as $category)
                            <div class="col-lg-3 col-md-6">
                                <a href="#{{ $category['slug'] }}"
                                   class="category-card card border-0 text-decoration-none">
                                    <div class="card-body text-center p-4">
                                        <div class="category-icon mb-3">
                                            <i class="{{ $category['icon'] }} fa-3x {{ $category['color'] }}"></i>
                                        </div>
                                        <h5 class="mb-2">{{ $category['name'] }}</h5>
                                        <p class="text-muted mb-0">
                                            {{ $category['count'] }} guides
                                        </p>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Guides populaires -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white">
                        <h4 class="mb-0">
                            <i class="fas fa-fire me-2 text-warning"></i>
                            Guides populaires
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            @foreach($popularGuides as $guide)
                            <div class="col-lg-4 col-md-6">
                                <div class="guide-card card border-0 h-100">
                                    <div class="card-body">
                                        <div class="d-flex align-items-start mb-3">
                                            <div class="guide-icon me-3">
                                                <i class="{{ $guide['icon'] }} fa-2x {{ $guide['color'] }}"></i>
                                            </div>
                                            <div>
                                                <h5 class="mb-1">{{ $guide['title'] }}</h5>
                                                <small class="text-muted">
                                                    <i class="fas fa-clock me-1"></i>
                                                    {{ $guide['duration'] }}
                                                </small>
                                            </div>
                                        </div>
                                        <p class="text-muted mb-3">
                                            {{ $guide['description'] }}
                                        </p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="badge bg-light text-dark">
                                                <i class="fas fa-eye me-1"></i>
                                                {{ $guide['views'] }} vues
                                            </span>
                                            <a href="{{ $guide['url'] }}" class="btn btn-sm btn-outline-primary">
                                                Lire le guide
                                                <i class="fas fa-arrow-right ms-1"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tous les guides -->
        <div class="row">
            <div class="col-lg-8">
                @foreach($categories as $category)
                <div class="card border-0 shadow-sm mb-4" id="{{ $category['slug'] }}">
                    <div class="card-header bg-white">
                        <h4 class="mb-0">
                            <i class="{{ $category['icon'] }} me-2 {{ $category['color'] }}"></i>
                            {{ $category['name'] }}
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            @foreach($category['guides'] as $guide)
                            <div class="list-group-item border-0 px-0 py-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <div class="guide-icon-small me-3">
                                            <i class="{{ $guide['icon'] }} {{ $guide['color'] }}"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">
                                                <a href="{{ $guide['url'] }}" class="text-decoration-none">
                                                    {{ $guide['title'] }}
                                                </a>
                                            </h6>
                                            <small class="text-muted">
                                                {{ Str::limit($guide['description'], 100) }}
                                            </small>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <small class="text-muted d-block">
                                            <i class="fas fa-clock me-1"></i>
                                            {{ $guide['duration'] }}
                                        </small>
                                        <small class="text-muted">
                                            <i class="fas fa-calendar me-1"></i>
                                            {{ $guide['date'] }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @if(count($category['guides']) > 5)
                        <div class="text-center mt-3">
                            <a href="{{ route('support.guides.category', $category['slug']) }}"
                               class="btn btn-outline-primary">
                                Voir tous les guides {{ $category['name'] }}
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Guide du débutant -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="mb-3">
                            <i class="fas fa-rocket me-2 text-success"></i>
                            Guide du débutant
                        </h5>
                        <p class="text-muted mb-3">
                            Nouveau sur MyBusiness ? Commencez par ici pour découvrir les bases.
                        </p>
                        <div class="d-grid">
                            <a href="{{ route('support.guides.beginner') }}" class="btn btn-success">
                                <i class="fas fa-play-circle me-2"></i>
                                Démarrer le guide
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Vidéos -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="mb-3">
                            <i class="fas fa-video me-2 text-danger"></i>
                            Tutoriels vidéo
                        </h5>
                        <div class="list-group list-group-flush">
                            @foreach($videos as $video)
                            <a href="{{ $video['url'] }}"
                               target="_blank"
                               class="list-group-item list-group-item-action border-0 px-0 py-2">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-play-circle fa-lg text-danger me-2"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <small class="d-block fw-bold">{{ $video['title'] }}</small>
                                        <small class="text-muted">{{ $video['duration'] }}</small>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('support.guides.videos') }}" class="btn btn-outline-danger btn-sm w-100">
                                <i class="fab fa-youtube me-1"></i>
                                Voir toutes les vidéos
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Téléchargements -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="mb-3">
                            <i class="fas fa-download me-2 text-info"></i>
                            Ressources à télécharger
                        </h5>
                        <div class="list-group list-group-flush">
                            @foreach($downloads as $download)
                            <a href="{{ $download['url'] }}"
                               class="list-group-item list-group-item-action border-0 px-0 py-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-file-{{ $download['type'] }} text-info me-2"></i>
                                        <span>{{ $download['name'] }}</span>
                                    </div>
                                    <small class="text-muted">{{ $download['size'] }}</small>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Contact support -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="fas fa-headset fa-3x text-primary"></i>
                        </div>
                        <h5 class="mb-3">Besoin d'aide ?</h5>
                        <p class="text-muted mb-3">
                            Notre équipe support est là pour vous aider.
                        </p>
                        <div class="d-grid gap-2">
                            <a href="{{ route('tickets.create') }}" class="btn btn-primary">
                                <i class="fas fa-ticket-alt me-2"></i>
                                Ouvrir un ticket
                            </a>
                            <a href="{{ route('support.contact') }}" class="btn btn-outline-primary">
                                <i class="fas fa-envelope me-2"></i>
                                Nous contacter
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA final -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="card border-0 shadow-sm bg-primary text-white">
                    <div class="card-body p-5 text-center">
                        <h3 class="mb-3">Vous ne trouvez pas ce que vous cherchez ?</h3>
                        <p class="mb-4">
                            Notre documentation est constamment mise à jour. Si vous ne trouvez pas la réponse à votre question,
                            n'hésitez pas à nous contacter.
                        </p>
                        <div class="d-flex justify-content-center gap-3">
                            <a href="{{ route('support.faq') }}" class="btn btn-light">
                                <i class="fas fa-question-circle me-2"></i>
                                Consulter la FAQ
                            </a>
                            <a href="{{ route('support.contact') }}" class="btn btn-outline-light">
                                <i class="fas fa-comments me-2"></i>
                                Contactez-nous
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
.category-card {
    transition: all 0.3s ease;
    border: 1px solid #eaeaea;
}

.category-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    border-color: #667eea;
}

.category-icon i {
    transition: transform 0.3s;
}

.category-card:hover .category-icon i {
    transform: scale(1.1);
}

.guide-card {
    border: 1px solid #eaeaea;
    transition: all 0.3s ease;
}

.guide-card:hover {
    border-color: #667eea;
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.1);
}

.guide-icon-small {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    background-color: #f8f9fa;
    display: flex;
    align-items: center;
    justify-content: center;
}

.list-group-item {
    transition: background-color 0.3s;
}

.list-group-item:hover {
    background-color: #f8f9fa;
}

.card-header {
    background: linear-gradient(45deg, #f8f9fa, #e9ecef);
}
</style>
@endpush

@push('scripts')
<script>
// Recherche de guides
document.getElementById('searchGuides').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase().trim();

    if (searchTerm.length >= 2) {
        // Filtrer les guides
        document.querySelectorAll('.list-group-item').forEach(item => {
            const title = item.querySelector('h6').textContent.toLowerCase();
            const description = item.querySelector('small').textContent.toLowerCase();

            if (title.includes(searchTerm) || description.includes(searchTerm)) {
                item.style.display = 'flex';
                // Mettre en surbrillance
                highlightText(item, searchTerm);
            } else {
                item.style.display = 'none';
            }
        });

        // Filtrer les catégories
        document.querySelectorAll('.card[id]').forEach(card => {
            const guidesVisible = Array.from(card.querySelectorAll('.list-group-item'))
                .some(item => item.style.display !== 'none');

            if (guidesVisible) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    } else {
        // Tout afficher
        document.querySelectorAll('.list-group-item, .card[id]').forEach(element => {
            element.style.display = '';
            removeHighlights(element);
        });
    }
});

// Mettre en surbrillance le texte
function highlightText(element, searchTerm) {
    const textNodes = getTextNodes(element);

    textNodes.forEach(node => {
        const text = node.textContent;
        const regex = new RegExp(`(${searchTerm})`, 'gi');
        const highlighted = text.replace(regex, '<mark>$1</mark>');

        if (highlighted !== text) {
            const span = document.createElement('span');
            span.innerHTML = highlighted;
            node.parentNode.replaceChild(span, node);
        }
    });
}

// Supprimer les surbrillances
function removeHighlights(element) {
    element.querySelectorAll('mark').forEach(mark => {
        const parent = mark.parentNode;
        parent.replaceChild(document.createTextNode(mark.textContent), mark);
        parent.normalize();
    });
}

// Récupérer tous les nœuds de texte
function getTextNodes(element) {
    const textNodes = [];
    const walker = document.createTreeWalker(
        element,
        NodeFilter.SHOW_TEXT,
        null,
        false
    );

    let node;
    while (node = walker.nextNode()) {
        textNodes.push(node);
    }

    return textNodes;
}

// Navigation fluide vers les catégories
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        const targetId = this.getAttribute('href');
        if (targetId === '#') return;

        const targetElement = document.querySelector(targetId);
        if (targetElement) {
            e.preventDefault();
            window.scrollTo({
                top: targetElement.offsetTop - 100,
                behavior: 'smooth'
            });
        }
    });
});

// Marquer les guides comme lus
document.querySelectorAll('a[href*="guides"]').forEach(link => {
    link.addEventListener('click', function() {
        const guideId = this.getAttribute('data-guide-id');
        if (guideId) {
            // Envoyer une requête pour marquer comme lu
            fetch(`/support/guides/${guideId}/read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
        }
    });
});

// Toggle pour les sections
document.querySelectorAll('.card-header').forEach(header => {
    header.addEventListener('click', function() {
        const card = this.closest('.card');
        const body = card.querySelector('.card-body');

        if (body.style.maxHeight && body.style.maxHeight !== '0px') {
            body.style.maxHeight = '0px';
            body.style.overflow = 'hidden';
        } else {
            body.style.maxHeight = body.scrollHeight + 'px';
            body.style.overflow = 'visible';
        }
    });
});

// Initialiser les hauteurs
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.card-body').forEach(body => {
        body.style.maxHeight = body.scrollHeight + 'px';
    });
});
</script>
@endpush
