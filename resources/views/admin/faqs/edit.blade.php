@extends('adminlte::page')

@section('title', 'Modifier la FAQ')

@section('content_header')
    <h1>
        <i class="fas fa-edit text-warning"></i>
        Modifier la FAQ
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
        <li class="breadcrumb-item"><a href="{{ route('faqs.index') }}">FAQ</a></li>
        <li class="breadcrumb-item active">Modifier</li>
    </ol>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-warning">
                <h3 class="card-title">Modification de la FAQ</h3>
            </div>

            <form action="{{ route('faqs.update', $faq->id) }}" method="POST" id="faqForm">
                @csrf
                @method('PUT')

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
                                       value="{{ old('question', $faq->question) }}"
                                       required
                                       autofocus
                                       maxlength="500">
                                @error('question')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted float-right">
                                    <span id="question-counter">{{ strlen(old('question', $faq->question)) }}</span>/500 caractères
                                </small>
                            </div>

                            <!-- Catégorie -->
                            <div class="form-group">
                                <label for="category">Catégorie</label>
                                <input type="text"
                                       name="category"
                                       id="category"
                                       class="form-control @error('category') is-invalid @enderror"
                                       value="{{ old('category', $faq->category) }}"
                                       maxlength="100">
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
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
                                                   {{ old('status', $faq->status) ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="status">
                                                FAQ active
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Informations -->
                                    <div class="mt-4">
                                        <h6><i class="fas fa-info-circle"></i> Informations</h6>
                                        <ul class="list-unstyled small text-muted">
                                            <li>
                                                <i class="fas fa-sort-numeric-up"></i>
                                                Position actuelle: <strong>{{ $faq->order }}</strong>
                                            </li>
                                            <li>
                                                <i class="fas fa-calendar-plus"></i>
                                                Créée le: {{ $faq->created_at->format('d/m/Y H:i') }}
                                            </li>
                                            @if($faq->updated_at != $faq->created_at)
                                            <li>
                                                <i class="fas fa-calendar-check"></i>
                                                Dernière modification: {{ $faq->updated_at->format('d/m/Y H:i') }}
                                            </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Aperçu -->
                            <div class="card mt-3">
                                <div class="card-header bg-primary text-white">
                                    <i class="fas fa-eye"></i> Aperçu
                                </div>
                                <div class="card-body">
                                    <div class="faq-preview">
                                        <div class="card mb-0">
                                            <div class="card-header">
                                                <strong id="preview-question">{{ $faq->question }}</strong>
                                                @if($faq->category)
                                                    <span class="badge badge-secondary ml-2" id="preview-category">{{ $faq->category }}</span>
                                                @endif
                                            </div>
                                            <div class="card-body">
                                                <p id="preview-answer" class="mb-0">
                                                    {{ Str::limit($faq->answer, 150) }}
                                                </p>
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
                                          rows="10"
                                          required>{{ old('answer', $faq->answer) }}</textarea>
                                @error('answer')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-warning" id="submitBtn">
                                <i class="fas fa-save"></i> Mettre à jour
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
                    <i class="fas fa-eye"></i> Prévisualisation
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0" id="modal-question">{{ $faq->question }}</h5>
                        @if($faq->category)
                            <small class="d-block mt-1">
                                Catégorie: <span class="badge badge-light" id="modal-category-text">{{ $faq->category }}</span>
                            </small>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="faq-answer-content" id="modal-answer">
                            {!! nl2br(e($faq->answer)) !!}
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
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        line-height: 1.6;
    }
    .faq-answer-content {
        white-space: pre-wrap;
        line-height: 1.6;
    }
</style>
@stop

@section('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const questionInput = document.getElementById('question');
    const categoryInput = document.getElementById('category');
    const answerTextarea = document.getElementById('answer');
    const submitBtn = document.getElementById('submitBtn');
    const questionCounter = document.getElementById('question-counter');

    // Éléments d'aperçu
    const previewQuestion = document.getElementById('preview-question');
    const previewCategory = document.getElementById('preview-category');
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
            if (!previewCategory) {
                // Créer le badge si il n'existe pas
                const badge = document.createElement('span');
                badge.className = 'badge badge-secondary ml-2';
                badge.id = 'preview-category';
                previewQuestion.parentNode.appendChild(badge);
            }
            previewCategory.textContent = categoryText;
            modalCategoryText.textContent = categoryText;
        } else if (previewCategory) {
            previewCategory.remove();
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

    // Initialiser
    updateQuestionCounter();
    updatePreview();

    // Validation du formulaire
    const form = document.getElementById('faqForm');
    form.addEventListener('submit', function(e) {
        if (questionInput.value.length > 500) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Question trop longue',
                text: 'La question ne peut pas dépasser 500 caractères.',
            });
            return;
        }

        if (categoryInput.value.length > 100) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Catégorie trop longue',
                text: 'La catégorie ne peut pas dépasser 100 caractères.',
            });
            return;
        }

        // Désactiver le bouton
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mise à jour...';
    });

    // Fonction de prévisualisation
    window.previewFaq = function() {
        updatePreview();
        $('#previewModal').modal('show');
    };
});
</script>
@stop
