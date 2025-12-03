@extends('adminlte::page')

@section('title', 'Créer un ticket')

@section('content_header')
    <h1>
        <i class="fas fa-plus-circle text-success"></i>
        Créer un ticket
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
        <li class="breadcrumb-item"><a href="{{ route('tickets.index') }}">Tickets</a></li>
        <li class="breadcrumb-item active">Créer</li>
    </ol>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h3 class="card-title">Nouveau ticket de support</h3>
            </div>

            <form action="{{ route('tickets.store') }}" method="POST" id="ticketForm">
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
                            <!-- Informations du ticket -->
                            <div class="card mb-4">
                                <div class="card-header bg-primary text-white">
                                    <i class="fas fa-info-circle"></i> Informations du ticket
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="subject">Sujet *</label>
                                        <input type="text"
                                               name="subject"
                                               id="subject"
                                               class="form-control @error('subject') is-invalid @enderror"
                                               value="{{ old('subject') }}"
                                               required
                                               autofocus
                                               placeholder="Ex: Problème avec mon compte">
                                        @error('subject')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="user_id">Client *</label>
                                                <select name="user_id"
                                                        id="user_id"
                                                        class="form-control select2 @error('user_id') is-invalid @enderror"
                                                        required
                                                        data-placeholder="Sélectionner un client">
                                                    <option value=""></option>
                                                    @foreach($users as $user)
                                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                        {{ $user->name }} ({{ $user->email }})
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('user_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="priority">Priorité *</label>
                                                <select name="priority"
                                                        id="priority"
                                                        class="form-control @error('priority') is-invalid @enderror"
                                                        required>
                                                    <option value="">-- Sélectionner une priorité --</option>
                                                    <option value="1" {{ old('priority') == '1' ? 'selected' : '' }}>
                                                        <span class="badge badge-success">Basse</span>
                                                    </option>
                                                    <option value="2" {{ old('priority') == '2' ? 'selected' : '' }}>
                                                        <span class="badge badge-info">Moyenne</span>
                                                    </option>
                                                    <option value="3" {{ old('priority') == '3' ? 'selected' : '' }}>
                                                        <span class="badge badge-warning">Haute</span>
                                                    </option>
                                                    <option value="4" {{ old('priority') == '4' ? 'selected' : '' }}>
                                                        <span class="badge badge-danger">Urgente</span>
                                                    </option>
                                                </select>
                                                @error('priority')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <!-- Informations sur les priorités -->
                            <div class="card mb-4">
                                <div class="card-header bg-info text-white">
                                    <i class="fas fa-flag"></i> Niveaux de priorité
                                </div>
                                <div class="card-body">
                                    <div class="small">
                                        <div class="d-flex align-items-center mb-2">
                                            <span class="badge badge-success mr-2">Basse</span>
                                            <span>Problème non bloquant</span>
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <span class="badge badge-info mr-2">Moyenne</span>
                                            <span>Problème standard</span>
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <span class="badge badge-warning mr-2">Haute</span>
                                            <span>Problème important</span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="badge badge-danger mr-2">Urgente</span>
                                            <span>Problème critique</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Information client -->
                            <div class="card">
                                <div class="card-header bg-warning text-white">
                                    <i class="fas fa-user"></i> Information client
                                </div>
                                <div class="card-body">
                                    <div id="clientInfo" class="text-center text-muted">
                                        <i class="fas fa-user-circle fa-3x mb-3"></i>
                                        <p>Sélectionnez un client pour voir ses informations</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Message -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-secondary text-white">
                                    <i class="fas fa-comment-alt"></i> Message *
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <textarea name="message"
                                                  id="message"
                                                  class="form-control @error('message') is-invalid @enderror"
                                                  rows="8"
                                                  required
                                                  placeholder="Décrivez le problème ou la question en détail...">{{ old('message') }}</textarea>
                                        @error('message')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Barre d'outils pour le texte -->
                                    <div class="bg-light p-3 rounded mb-3">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <button type="button" class="btn btn-light" onclick="formatText('bold')">
                                                <i class="fas fa-bold"></i>
                                            </button>
                                            <button type="button" class="btn btn-light" onclick="formatText('italic')">
                                                <i class="fas fa-italic"></i>
                                            </button>
                                            <button type="button" class="btn btn-light" onclick="formatText('underline')">
                                                <i class="fas fa-underline"></i>
                                            </button>
                                            <button type="button" class="btn btn-light" onclick="formatText('code')">
                                                <i class="fas fa-code"></i>
                                            </button>
                                        </div>
                                        <div class="btn-group btn-group-sm ml-2" role="group">
                                            <button type="button" class="btn btn-light" onclick="insertText('[code]', '[/code]')">
                                                <i class="fas fa-terminal"></i> Code
                                            </button>
                                            <button type="button" class="btn btn-light" onclick="insertText('[quote]', '[/quote]')">
                                                <i class="fas fa-quote-right"></i> Citation
                                            </button>
                                        </div>
                                    </div>

                                    <small class="text-muted">
                                        Décrivez le problème de manière claire et précise. Incluez les étapes pour reproduire le problème si possible.
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success" id="submitBtn">
                        <i class="fas fa-paper-plane"></i> Créer le ticket
                    </button>
                    <a href="{{ route('tickets.index') }}" class="btn btn-default">
                        <i class="fas fa-times"></i> Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('css')
<style>
    .select2-container {
        width: 100% !important;
    }
    textarea {
        resize: vertical;
        min-height: 200px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        line-height: 1.6;
    }
    .client-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
    }
    #clientInfo .client-details {
        text-align: left;
    }
</style>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const userIdSelect = document.getElementById('user_id');
    const clientInfo = document.getElementById('clientInfo');
    const submitBtn = document.getElementById('submitBtn');
    const messageTextarea = document.getElementById('message');

    // Initialiser Select2
    $(userIdSelect).select2({
        theme: 'bootstrap4',
        placeholder: 'Sélectionner un client',
        allowClear: true
    });

    // Charger les informations du client sélectionné
    userIdSelect.addEventListener('change', function() {
        const userId = this.value;

        if (!userId) {
            clientInfo.innerHTML = `
                <i class="fas fa-user-circle fa-3x mb-3"></i>
                <p>Sélectionnez un client pour voir ses informations</p>
            `;
            return;
        }

        // Afficher un indicateur de chargement
        clientInfo.innerHTML = `
            <div class="text-center">
                <div class="spinner-border spinner-border-sm text-primary" role="status">
                    <span class="sr-only">Chargement...</span>
                </div>
                <p class="mt-2">Chargement des informations...</p>
            </div>
        `;

        // Charger les informations du client via AJAX
        fetch(`/admin/users/${userId}/info`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const user = data.user;
                    clientInfo.innerHTML = `
                        <div class="client-details">
                            <div class="text-center mb-3">
                                ${user.avatar ?
                                    `<img src="${user.avatar}" alt="${user.name}" class="client-avatar mb-2">` :
                                    `<div class="client-avatar bg-secondary text-white d-flex align-items-center justify-content-center mb-2 mx-auto">
                                        ${user.name.charAt(0).toUpperCase()}
                                    </div>`
                                }
                                <h5 class="mb-1">${user.name}</h5>
                                <p class="text-muted mb-1">${user.email}</p>
                                ${user.phone ? `<p class="mb-1"><i class="fas fa-phone"></i> ${user.phone}</p>` : ''}
                            </div>
                            <hr>
                            <div class="small">
                                <p class="mb-1"><strong>Inscrit le:</strong> ${user.created_at}</p>
                                <p class="mb-1"><strong>Dernière connexion:</strong> ${user.last_login || 'Jamais'}</p>
                                <p class="mb-0"><strong>Tickets ouverts:</strong> ${user.open_tickets || 0}</p>
                            </div>
                        </div>
                    `;
                } else {
                    clientInfo.innerHTML = `
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i>
                            <p class="mb-0">Impossible de charger les informations du client</p>
                        </div>
                    `;
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                clientInfo.innerHTML = `
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i>
                        <p class="mb-0">Erreur lors du chargement des informations</p>
                    </div>
                `;
            });
    });

    // Validation du formulaire
    const form = document.getElementById('ticketForm');
    form.addEventListener('submit', function(e) {
        // Vérifier que le message n'est pas vide
        if (!messageTextarea.value.trim()) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Message vide',
                text: 'Veuillez saisir un message pour le ticket',
            });
            messageTextarea.focus();
            return;
        }

        // Désactiver le bouton pour éviter les doubles clics
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Création...';

        // Si tout est bon, le formulaire s'envoie
    });

    // Fonctions pour la barre d'outils de texte
    window.formatText = function(command) {
        const textarea = document.getElementById('message');
        const start = textarea.selectionStart;
        const end = textarea.selectionEnd;
        const selectedText = textarea.value.substring(start, end);

        let formattedText = '';
        let tag = '';

        switch(command) {
            case 'bold':
                tag = '**';
                formattedText = `${tag}${selectedText}${tag}`;
                break;
            case 'italic':
                tag = '*';
                formattedText = `${tag}${selectedText}${tag}`;
                break;
            case 'underline':
                tag = '__';
                formattedText = `${tag}${selectedText}${tag}`;
                break;
            case 'code':
                tag = '`';
                formattedText = `${tag}${selectedText}${tag}`;
                break;
        }

        textarea.setRangeText(formattedText, start, end, 'end');
        textarea.focus();
    };

    window.insertText = function(startTag, endTag) {
        const textarea = document.getElementById('message');
        const start = textarea.selectionStart;
        const end = textarea.selectionEnd;
        const selectedText = textarea.value.substring(start, end);

        let formattedText = selectedText;
        if (selectedText) {
            formattedText = `${startTag}${selectedText}${endTag}`;
        } else {
            formattedText = `${startTag}${endTag}`;
        }

        textarea.setRangeText(formattedText, start, end, 'end');
        textarea.focus();
        textarea.selectionStart = start + startTag.length;
        textarea.selectionEnd = start + startTag.length;
    };
});
</script>
@stop
