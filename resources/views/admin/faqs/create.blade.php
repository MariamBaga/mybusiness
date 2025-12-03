@extends('adminlte::page')

@section('title', 'Ajouter une FAQ')

@section('content_header')
    <h1>
        <i class="fas fa-plus-circle text-success"></i>
        Ajouter une FAQ
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
        <li class="breadcrumb-item"><a href="{{ route('faqs.index') }}">FAQ</a></li>
        <li class="breadcrumb-item active">Ajouter</li>
    </ol>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h3 class="card-title">Nouvelle question fréquente</h3>
            </div>

            <form action="{{ route('faqs.store') }}" method="POST" id="faqForm">
                @csrf

                <div class="card-body">
                    @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5><i class="icon fas fa-ban"></i> Erreurs dans le formulaire</h5>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-md-8">
                            <!-- Question -->
                            <div class="form-group">
                                <label for="question">Question *</label>
                                <input type="text"
                                       name="question"
                                       id="question"
                                       class="form-control @error('question') is-invalid @enderror"
                                       value="{{ old('question') }}"
                                       required
                                       autofocus
                                       maxlength="500"
                                       placeholder="Ex: Comment créer un compte ?">
                                @error('question')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted float-right">
                                    <span id="question-counter">0</span>/500 caractères
                                </small>
                            </div>

                            <!-- Catégorie -->
                            <div class="form-group">
                                <label for="category">Catégorie</label>
                                <input type="text"
                                       name="category"
                                       id="category"
                                       class="form-control @error('category') is-invalid @enderror"
                                       value="{{ old('category') }}"
                                       maxlength="100"
                                       placeholder="Ex: Compte, Paiement, Technique...">
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">
                                    Facultatif. Permet de regrouper les FAQ par thème.
                                </small>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <!-- Paramètres -->
                            <div class="card">
                                <div class="card-header bg-info text-white">
                                    <i class="fas fa-cog"></i> Paramètres
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Statut</label>
                                        <div class="custom-control custom-switch mt-2">
                                            <input type="checkbox"
                                                   name="status"
                                                   class="custom-control-input"
                                                   id="status"
                                                   value="1"
                                                   {{ old('status', true) ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="status">
                                                FAQ active
                                            </label>
                                        </div>
                                        <small class="text-muted">
                                            Les FAQ inactives ne seront pas affichées sur le site.
                                        </small>
                                    </div>

                                    <!-- Position -->
                                    <div class="form-group mt-3">
                                        <label for="position">Position</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-sort-numeric-up"></i>
                                                </span>
                                            </div>
                                            <input type="number"
                                                   name="position"
                                                   id="position"
                                                   class="form-control"
                                                   value="{{ old('position', $nextOrder) }}"
                                                   min="1"
                                                   max="1000">
                                        </div>
                                        <small class="text-muted">
                                            Détermine l'ordre d'affichage (1 = en premier).
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <!-- Aperçu -->
                            <div class="card mt-3">
                                <div class="card-header bg-warning text-white">
                                    <i class="fas fa-eye"></i> Aperçu
                                </div>
                                <div class="card-body">
                                    <div class="faq-preview">
                                        <h6 class="text-muted mb-2">Comment cela apparaîtra :</h6>
                                        <div class="card mb-0">
                                            <div class="card-header">
                                                <strong id="preview-question">Votre question ici</strong>
                                                <span class="badge badge-secondary ml-2" id="preview-category" style="display: none;">Catégorie</span>
                                            </div>
                                            <div class="card-body">
                                                <p id="preview-answer" class="mb-0">Votre réponse ici...</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Réponse -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="answer">Réponse *</label>
                                <textarea name="answer"
                                          id="answer"
                                          class="form-control @error('answer') is-invalid @enderror"
                                          rows="8"
                                          required
                                          placeholder="Fournissez une réponse claire et complète à la question...">{{ old('answer') }}</textarea>
                                @error('answer')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">
                                    Vous pouvez utiliser du texte simple. Les sauts de ligne seront conservés.
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-success" id="submitBtn">
                                <i class="fas fa-save"></i> Enregistrer la FAQ
                            </button>
                            <a href="{{ route('faqs.index') }}" class="btn btn-default">
                                <i class="fas fa-times"></i> Annuler
                            </a>
                        </div>
                        <div class="col-md-4 text-right">
                            <button type="button" class="btn btn-info" onclick="previewFaq()">
                                <i class="fas fa-eye"></i> Prévisualiser
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal de prévisualisation -->
<div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="previewModalLabel">
                    <i class="fas fa-eye"></i> Prévisualisation de la FAQ
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0" id="modal-question">Votre question ici</h5>
                        <small id="modal-category" class="d-block mt-1" style="display: none;">
                            Catégorie: <span class="badge badge-light" id="modal-category-text"></span>
                        </small>
                    </div>
                    <div class="card-body">
                        <div class="faq-answer-content" id="modal-answer">
                            <p>Votre réponse ici...</p>
                        </div>
                        <div class="mt-4 text-muted small">
                            <i class="fas fa-info-circle"></i> Ceci est une prévisualisation. L'apparence finale peut varier.
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<style>
    .faq-preview .card {
        border: 2px dashed #dee2e6;
        background-color: #f8f9fa;
    }
    .faq-preview .card-header {
        background-color: #e9ecef;
        color: #495057;
    }
    textarea {
        resize: vertical;
        min-height: 150px;
    }
    #answer {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        line-height: 1.6;
    }
    .faq-answer-content {
        white-space: pre-wrap;
        line-height: 1.6;
    }
    .modal-body .card {
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
</style>
@stop

@section('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const questionInput = document.getElementById('question');
    const categoryInput = document.getElementById('category');
    const answerTextarea = document.getElementById('answer');
    const positionInput = document.getElementById('position');
    const submitBtn = document.getElementById('submitBtn');
    const questionCounter = document.getElementById('question-counter');

    // Éléments d'aperçu
    const previewQuestion = document.getElementById('preview-question');
    const previewCategory = document.getElementById('preview-category');
    const previewCategoryBadge = previewCategory.querySelector('.badge');
    const previewAnswer = document.getElementById('preview-answer');

    // Éléments du modal
    const modalQuestion = document.getElementById('modal-question');
    const modalCategory = document.getElementById('modal-category');
    const modalCategoryText = document.getElementById('modal-category-text');
    const modalAnswer = document.getElementById('modal-answer');

    // Compteur de caractères pour la question
    function updateQuestionCounter() {
        const length = questionInput.value.length;
        questionCounter.textContent = length;

        if (length > 450) {
            questionCounter.classList.add('text-warning');
        } else {
            questionCounter.classList.remove('text-warning');
        }

        if (length > 500) {
            questionCounter.classList.add('text-danger');
        } else {
            questionCounter.classList.remove('text-danger');
        }
    }

    // Mettre à jour l'aperçu en temps réel
    function updatePreview() {
        // Question
        const questionText = questionInput.value || 'Votre question ici';
        previewQuestion.textContent = questionText;
        modalQuestion.textContent = questionText;

        // Catégorie
        const categoryText = categoryInput.value.trim();
        if (categoryText) {
            previewCategory.style.display = 'inline';
            previewCategoryBadge.textContent = categoryText;
            modalCategory.style.display = 'block';
            modalCategoryText.textContent = categoryText;
        } else {
            previewCategory.style.display = 'none';
            modalCategory.style.display = 'none';
        }

        // Réponse
        const answerText = answerTextarea.value || 'Votre réponse ici...';
        previewAnswer.textContent = answerText.length > 150 ? answerText.substring(0, 150) + '...' : answerText;
        modalAnswer.innerHTML = answerText.replace(/\n/g, '<br>');
    }

    // Événements
    questionInput.addEventListener('input', function() {
        updateQuestionCounter();
        updatePreview();
    });

    categoryInput.addEventListener('input', updatePreview);
    answerTextarea.addEventListener('input', updatePreview);

    // Initialiser le compteur
    updateQuestionCounter();
    updatePreview();

    // Validation du formulaire
    const form = document.getElementById('faqForm');
    form.addEventListener('submit', function(e) {
        // Vérifier la longueur de la question
        if (questionInput.value.length > 500) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Question trop longue',
                text: 'La question ne peut pas dépasser 500 caractères.',
            });
            questionInput.focus();
            return;
        }

        // Vérifier la longueur de la catégorie
        if (categoryInput.value.length > 100) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Catégorie trop longue',
                text: 'La catégorie ne peut pas dépasser 100 caractères.',
            });
            categoryInput.focus();
            return;
        }

        // Désactiver le bouton pour éviter les doubles clics
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enregistrement...';
    });

    // Fonction pour prévisualiser dans un modal
    window.previewFaq = function() {
        updatePreview();
        $('#previewModal').modal('show');
    };

    // Charger les catégories existantes pour l'autocomplétion
    fetch('{{ route("faqs.index") }}?get_categories=true')
        .then(response => response.json())
        .then(categories => {
            if (categories && categories.length > 0) {
                // Créer une datalist pour l'autocomplétion
                const datalist = document.createElement('datalist');
                datalist.id = 'category-list';

                categories.forEach(category => {
                    const option = document.createElement('option');
                    option.value = category;
                    datalist.appendChild(option);
                });

                document.body.appendChild(datalist);
                categoryInput.setAttribute('list', 'category-list');
            }
        })
        .catch(error => console.log('Erreur lors du chargement des catégories:', error));
});
</script>
@stop
