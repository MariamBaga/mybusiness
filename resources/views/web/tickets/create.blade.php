@extends('layouts.master')

@section('title', 'Créer un ticket - Support MyBusiness')

@section('content')

<!-- =========================
    BREADCRUMB
========================= -->
<section class="ht-breadcrumb-area">
    @include('components.breadcrumb', [
        'title' => 'Créer un ticket',
        'parent' => 'Support',
        'parent_url' => route('tickets.index'),
        'active' => 'Nouvelle demande'
    ])
</section>

<!-- =========================
    FORMULAIRE DE TICKET
========================= -->
<section class="section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">
                            <i class="fas fa-plus-circle me-2"></i>
                            Créer un nouveau ticket
                        </h4>
                    </div>

                    <div class="card-body p-4">
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        @endif

                        @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        @endif

                        <form action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data" id="ticketForm">
                            @csrf

                            <!-- Informations de base -->
                            <div class="mb-4">
                                <h5 class="mb-3">
                                    <i class="fas fa-info-circle text-primary me-2"></i>
                                    Informations de base
                                </h5>

                                <div class="row g-3">
                                    <!-- Sujet -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="subject" class="form-label fw-bold">
                                                Sujet
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                   name="subject"
                                                   id="subject"
                                                   class="form-control @error('subject') is-invalid @enderror"
                                                   value="{{ old('subject') }}"
                                                   required
                                                   maxlength="255"
                                                   placeholder="Décrivez brièvement votre problème">
                                            @error('subject')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="form-text text-muted float-end">
                                                <span id="subjectCounter">0/255</span>
                                            </small>
                                        </div>
                                    </div>

                                    <!-- Catégorie -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="category" class="form-label fw-bold">
                                                Catégorie
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="category"
                                                    id="category"
                                                    class="form-control @error('category') is-invalid @enderror"
                                                    required>
                                                <option value="">-- Choisir une catégorie --</option>
                                                <option value="technical" {{ old('category') == 'technical' ? 'selected' : '' }}>
                                                    Problème technique
                                                </option>
                                                <option value="billing" {{ old('category') == 'billing' ? 'selected' : '' }}>
                                                    Facturation
                                                </option>
                                                <option value="account" {{ old('category') == 'account' ? 'selected' : '' }}>
                                                    Compte utilisateur
                                                </option>
                                                <option value="feature" {{ old('category') == 'feature' ? 'selected' : '' }}>
                                                    Demande de fonctionnalité
                                                </option>
                                                <option value="other" {{ old('category') == 'other' ? 'selected' : '' }}>
                                                    Autre
                                                </option>
                                            </select>
                                            @error('category')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror>
                                        </div>
                                    </div>

                                    <!-- Priorité -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="priority" class="form-label fw-bold">
                                                Priorité
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="priority"
                                                    id="priority"
                                                    class="form-control @error('priority') is-invalid @enderror"
                                                    required>
                                                <option value="">-- Choisir une priorité --</option>
                                                <option value="1" {{ old('priority') == '1' ? 'selected' : '' }}>
                                                    Basse
                                                </option>
                                                <option value="2" {{ old('priority') == '2' ? 'selected' : '' }}>
                                                    Moyenne
                                                </option>
                                                <option value="3" {{ old('priority') == '3' ? 'selected' : '' }}>
                                                    Haute
                                                </option>
                                                <option value="4" {{ old('priority') == '4' ? 'selected' : '' }}>
                                                    Urgente
                                                </option>
                                            </select>
                                            @error('priority')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror>
                                            <small class="form-text text-muted">
                                                <div id="priorityHelp" class="mt-1"></div>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Message -->
                            <div class="mb-4">
                                <h5 class="mb-3">
                                    <i class="fas fa-comment-dots text-primary me-2"></i>
                                    Message
                                </h5>

                                <div class="form-group">
                                    <label for="message" class="form-label fw-bold">
                                        Description détaillée
                                        <span class="text-danger">*</span>
                                    </label>
                                    <textarea name="message"
                                              id="message"
                                              class="form-control @error('message') is-invalid @enderror"
                                              rows="8"
                                              required
                                              placeholder="Décrivez votre problème ou votre demande en détail...">{{ old('message') }}</textarea>
                                    @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror>
                                    <div class="mt-2">
                                        <small class="form-text text-muted float-end">
                                            <span id="messageCounter">0 caractères</span>
                                        </small>
                                        <small class="form-text text-muted">
                                            Soyez le plus précis possible. Indiquez les étapes pour reproduire le problème.
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <!-- Pièce jointe -->
                            <div class="mb-4">
                                <h5 class="mb-3">
                                    <i class="fas fa-paperclip text-primary me-2"></i>
                                    Pièce jointe (optionnelle)
                                </h5>

                                <div class="form-group">
                                    <div class="upload-area @error('attachment') border-danger @enderror"
                                         id="uploadArea">
                                        <div class="upload-content text-center py-4">
                                            <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                                            <h5 class="mb-2">Glissez-déposez votre fichier ici</h5>
                                            <p class="text-muted mb-3">ou cliquez pour parcourir</p>
                                            <button type="button" class="btn btn-outline-primary" onclick="document.getElementById('attachment').click()">
                                                <i class="fas fa-folder-open me-2"></i>Choisir un fichier
                                            </button>
                                            <p class="text-muted mt-3 mb-0">
                                                Formats acceptés: JPG, PNG, PDF, DOC, DOCX<br>
                                                Taille max: 5MB
                                            </p>
                                        </div>
                                        <input type="file"
                                               name="attachment"
                                               id="attachment"
                                               class="d-none"
                                               accept=".jpg,.jpeg,.png,.pdf,.doc,.docx">
                                    </div>
                                    @error('attachment')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror>

                                    <!-- Aperçu -->
                                    <div class="file-preview mt-3" id="filePreview" style="display: none;">
                                        <div class="preview-wrapper">
                                            <div class="d-flex align-items-center justify-content-between p-3 border rounded">
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-file fa-2x text-primary me-3"></i>
                                                    <div>
                                                        <h6 id="fileName" class="mb-1"></h6>
                                                        <small id="fileSize" class="text-muted"></small>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeFile()">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Informations supplémentaires -->
                            <div class="mb-4">
                                <h5 class="mb-3">
                                    <i class="fas fa-tools text-primary me-2"></i>
                                    Informations supplémentaires (optionnel)
                                </h5>

                                <div class="form-group">
                                    <label class="form-label fw-bold">
                                        Informations techniques utiles
                                    </label>
                                    <div class="bg-light p-3 rounded">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <small class="d-block mb-2">
                                                    <strong>Navigateur :</strong>
                                                    <span id="browserInfo">Détection...</span>
                                                </small>
                                                <small class="d-block mb-2">
                                                    <strong>Système :</strong>
                                                    <span id="osInfo">Détection...</span>
                                                </small>
                                            </div>
                                            <div class="col-md-6">
                                                <small class="d-block mb-2">
                                                    <strong>URL :</strong>
                                                    <span id="urlInfo">{{ url()->current() }}</span>
                                                </small>
                                                <small class="d-block mb-2">
                                                    <strong>Utilisateur :</strong>
                                                    <span>{{ auth()->user()->email }}</span>
                                                </small>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <div class="form-check">
                                                <input type="checkbox"
                                                       name="include_tech_info"
                                                       id="include_tech_info"
                                                       class="form-check-input"
                                                       checked>
                                                <label class="form-check-label" for="include_tech_info">
                                                    Inclure ces informations techniques dans le ticket
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Boutons -->
                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('tickets.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Annuler
                                </a>
                                <div>
                                    <button type="reset" class="btn btn-outline-danger me-2">
                                        <i class="fas fa-redo me-2"></i>Réinitialiser
                                    </button>
                                    <button type="submit" class="ht-btn style-2">
                                        <i class="fas fa-paper-plane me-2"></i>Envoyer le ticket
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Conseils -->
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-body">
                        <h5 class="mb-3">
                            <i class="fas fa-lightbulb text-warning me-2"></i>
                            Conseils pour un bon ticket
                        </h5>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <strong>Soyez précis :</strong> Décrivez exactement ce qui ne fonctionne pas
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <strong>Fournissez des étapes :</strong> Comment reproduire le problème
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <strong>Joignez des captures :</strong> Les images aident beaucoup
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <strong>Utilisez la bonne priorité :</strong> Évitez "Urgente" pour les demandes mineures
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <strong>Attendez-vous à une réponse :</strong> Nous répondons généralement dans les 24h
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- FAQs rapides -->
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-body">
                        <h5 class="mb-3">
                            <i class="fas fa-question-circle text-info me-2"></i>
                            Questions fréquentes
                        </h5>
                        <div class="accordion" id="faqAccordion">
                            <div class="accordion-item">
                                <h6 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                        Quand vais-je recevoir une réponse ?
                                    </button>
                                </h6>
                                <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Nous nous efforçons de répondre à tous les tickets dans les 24 heures ouvrables.
                                        Les tickets urgents sont traités en priorité.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h6 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                        Puis-je modifier mon ticket après envoi ?
                                    </button>
                                </h6>
                                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Oui, vous pouvez ajouter des informations supplémentaires en répondant à votre propre ticket.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h6 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                        Quels types de fichiers puis-je joindre ?
                                    </button>
                                </h6>
                                <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Images (JPG, PNG), documents PDF, et documents Word (DOC, DOCX). Taille maximum : 5MB.
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

@endsection

@push('styles')
<style>
.upload-area {
    border: 2px dashed #dee2e6;
    border-radius: 8px;
    background-color: #f8f9fa;
    transition: all 0.3s ease;
    cursor: pointer;
}

.upload-area:hover {
    border-color: #667eea;
    background-color: #f0f2ff;
}

.upload-area.dragover {
    border-color: #28a745;
    background-color: #d4edda;
}

.file-preview {
    animation: fadeIn 0.5s;
}

.preview-wrapper {
    max-width: 500px;
    margin: 0 auto;
}

.ht-btn.style-2 {
    background: linear-gradient(45deg, #667eea, #764ba2);
    border: none;
    color: white;
    padding: 10px 25px;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.ht-btn.style-2:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
}

.accordion-button {
    font-size: 0.9rem;
    font-weight: 600;
}

.accordion-button:not(.collapsed) {
    background-color: #f8f9fa;
    color: #667eea;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}
</style>
@endpush

@push('scripts')
<script>
// Variables globales
let selectedFile = null;

// Drag & drop pour les fichiers
const uploadArea = document.getElementById('uploadArea');
const fileInput = document.getElementById('attachment');
const filePreview = document.getElementById('filePreview');
const fileName = document.getElementById('fileName');
const fileSize = document.getElementById('fileSize');

uploadArea.addEventListener('dragover', function(e) {
    e.preventDefault();
    e.stopPropagation();
    this.classList.add('dragover');
});

uploadArea.addEventListener('dragleave', function(e) {
    e.preventDefault();
    e.stopPropagation();
    this.classList.remove('dragover');
});

uploadArea.addEventListener('drop', function(e) {
    e.preventDefault();
    e.stopPropagation();
    this.classList.remove('dragover');

    const files = e.dataTransfer.files;
    if (files.length > 0) {
        handleFile(files[0]);
    }
});

uploadArea.addEventListener('click', function() {
    fileInput.click();
});

fileInput.addEventListener('change', function(e) {
    if (this.files.length > 0) {
        handleFile(this.files[0]);
    }
});

function handleFile(file) {
    // Validation
    const validTypes = ['image/jpeg', 'image/png', 'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];

    if (!validTypes.includes(file.type)) {
        showError('Type de fichier non supporté. Utilisez JPG, PNG, PDF, DOC ou DOCX.');
        return;
    }

    if (file.size > 5 * 1024 * 1024) {
        showError('Fichier trop volumineux (max 5MB)');
        return;
    }

    selectedFile = file;

    // Afficher les informations du fichier
    fileName.textContent = file.name;
    fileSize.textContent = formatFileSize(file.size);
    filePreview.style.display = 'block';

    // Masquer la zone de téléchargement
    uploadArea.style.display = 'none';
}

function removeFile() {
    selectedFile = null;
    fileInput.value = '';
    filePreview.style.display = 'none';
    uploadArea.style.display = 'block';
}

function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}

// Compteurs de caractères
function setupCounters() {
    // Sujet
    const subjectInput = document.getElementById('subject');
    const subjectCounter = document.getElementById('subjectCounter');

    subjectInput.addEventListener('input', function() {
        subjectCounter.textContent = this.value.length + '/255';
        updateCounterColor(subjectCounter, this.value.length, 255);
    });

    // Message
    const messageInput = document.getElementById('message');
    const messageCounter = document.getElementById('messageCounter');

    messageInput.addEventListener('input', function() {
        const words = this.value.trim().split(/\s+/).filter(word => word.length > 0).length;
        messageCounter.textContent = `${this.value.length} caractères, ${words} mots`;
    });

    // Initialiser
    subjectInput.dispatchEvent(new Event('input'));
    messageInput.dispatchEvent(new Event('input'));
}

function updateCounterColor(counterElement, length, max) {
    if (length > max * 0.9) {
        counterElement.style.color = '#dc3545';
    } else if (length > max * 0.8) {
        counterElement.style.color = '#ffc107';
    } else {
        counterElement.style.color = '#6c757d';
    }
}

// Aide pour la priorité
document.getElementById('priority').addEventListener('change', function() {
    const helpText = document.getElementById('priorityHelp');
    const priority = parseInt(this.value);

    const descriptions = {
        1: 'Problèmes mineurs ou demandes d\'information générale',
        2: 'Problèmes normaux affectant l\'utilisation',
        3: 'Problèmes majeurs empêchant l\'utilisation',
        4: 'Problèmes critiques nécessitant une intervention immédiate'
    };

    if (descriptions[priority]) {
        helpText.innerHTML = `<i class="fas fa-info-circle me-1"></i> ${descriptions[priority]}`;
        helpText.className = `text-${priority == 4 ? 'danger' : priority == 3 ? 'warning' : priority == 2 ? 'info' : 'success'}`;
    } else {
        helpText.innerHTML = '';
    }
});

// Détection des informations techniques
function detectTechInfo() {
    const browserInfo = document.getElementById('browserInfo');
    const osInfo = document.getElementById('osInfo');

    // Détection du navigateur
    const userAgent = navigator.userAgent;
    let browser = 'Navigateur inconnu';

    if (userAgent.includes('Chrome') && !userAgent.includes('Edg')) {
        browser = 'Google Chrome';
    } else if (userAgent.includes('Firefox')) {
        browser = 'Mozilla Firefox';
    } else if (userAgent.includes('Safari') && !userAgent.includes('Chrome')) {
        browser = 'Apple Safari';
    } else if (userAgent.includes('Edg')) {
        browser = 'Microsoft Edge';
    } else if (userAgent.includes('Opera') || userAgent.includes('OPR')) {
        browser = 'Opera';
    }

    // Détection du système d'exploitation
    let os = 'Système inconnu';

    if (userAgent.includes('Windows')) {
        os = 'Windows';
    } else if (userAgent.includes('Mac')) {
        os = 'macOS';
    } else if (userAgent.includes('Linux')) {
        os = 'Linux';
    } else if (userAgent.includes('Android')) {
        os = 'Android';
    } else if (userAgent.includes('iOS') || userAgent.includes('iPhone') || userAgent.includes('iPad')) {
        os = 'iOS';
    }

    browserInfo.textContent = browser;
    osInfo.textContent = os;
}

// Validation du formulaire
document.getElementById('ticketForm').addEventListener('submit', function(e) {
    // Validation du message
    const messageInput = document.getElementById('message');
    if (messageInput.value.trim().length < 10) {
        e.preventDefault();
        showError('Veuillez décrire votre problème en au moins 10 caractères.');
        messageInput.focus();
        return;
    }

    // Confirmation
    const priority = document.getElementById('priority').value;
    if (priority == '4') {
        if (!confirm('Vous avez sélectionné la priorité "Urgente". Ceci doit être réservé aux problèmes critiques. Confirmez-vous ?')) {
            e.preventDefault();
            return;
        }
    }

    if (!confirm('Envoyer ce ticket de support ?')) {
        e.preventDefault();
    }
});

function showError(message) {
    alert(message);
}

// Initialisation
document.addEventListener('DOMContentLoaded', function() {
    setupCounters();
    detectTechInfo();

    // Déclencher l'aide pour la priorité
    document.getElementById('priority').dispatchEvent(new Event('change'));

    // Prévenir la fermeture de la page si formulaire rempli
    window.addEventListener('beforeunload', function(e) {
        const form = document.getElementById('ticketForm');
        let hasData = false;

        // Vérifier les champs
        ['subject', 'message'].forEach(id => {
            if (document.getElementById(id).value.trim()) hasData = true;
        });
        if (selectedFile) hasData = true;

        if (hasData) {
            e.preventDefault();
            e.returnValue = 'Vous avez des modifications non enregistrées. Êtes-vous sûr de vouloir quitter ?';
        }
    });
});

// Auto-sauvegarde du brouillon
setInterval(function() {
    const form = document.getElementById('ticketForm');
    const data = {
        subject: document.getElementById('subject').value,
        message: document.getElementById('message').value,
        category: document.getElementById('category').value,
        priority: document.getElementById('priority').value,
        timestamp: new Date().getTime()
    };

    if (data.subject || data.message) {
        localStorage.setItem('ticketDraft', JSON.stringify(data));
    }
}, 10000); // Toutes les 10 secondes

// Récupération du brouillon
const draft = localStorage.getItem('ticketDraft');
if (draft) {
    try {
        const data = JSON.parse(draft);
        if (confirm('Un brouillon de ticket a été trouvé. Voulez-vous le charger ?')) {
            document.getElementById('subject').value = data.subject || '';
            document.getElementById('message').value = data.message || '';
            document.getElementById('category').value = data.category || '';
            document.getElementById('priority').value = data.priority || '';

            // Déclencher les événements
            document.getElementById('subject').dispatchEvent(new Event('input'));
            document.getElementById('message').dispatchEvent(new Event('input'));
            document.getElementById('priority').dispatchEvent(new Event('change'));
        }
    } catch (e) {
        console.error('Erreur lors du chargement du brouillon:', e);
    }
}

// Nettoyer le brouillon après envoi
document.getElementById('ticketForm').addEventListener('submit', function() {
    localStorage.removeItem('ticketDraft');
});
</script>
@endpush
