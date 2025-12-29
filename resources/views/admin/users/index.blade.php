@extends('adminlte::page')

@section('title', 'Gestion des Utilisateurs')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1><i class="fas fa-users mr-2"></i>Gestion des Utilisateurs</h1>
        @can('create users')
        <a href="{{ route('users.create') }}" class="btn btn-success btn-lg">
            <i class="fas fa-plus-circle mr-1"></i>Ajouter un utilisateur
        </a>
        @endcan
    </div>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
@stop

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-gradient-primary">
            <h3 class="card-title text-white">
                <i class="fas fa-list mr-1"></i>Liste des utilisateurs
            </h3>
            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 200px;">
                    <input type="text" id="searchInput" class="form-control" placeholder="Rechercher...">
                    <div class="input-group-append">
                        <button class="btn btn-light" onclick="searchUsers()">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped" id="usersTable">
                    <thead class="thead-dark">
                        <tr>
                            <th style="width: 5%">
                                <i class="fas fa-hashtag"></i> ID
                            </th>
                            <th style="width: 25%">
                                <i class="fas fa-user"></i> Nom
                            </th>
                            <th style="width: 25%">
                                <i class="fas fa-envelope"></i> Email
                            </th>
                            <th style="width: 20%">
                                <i class="fas fa-user-tag"></i> Rôles
                            </th>
                            <th style="width: 25%">
                                <i class="fas fa-cogs"></i> Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td class="text-center">
                                <span class="badge badge-info badge-pill">{{ $user->id }}</span>
                            </td>
                            <td>
                                <strong>{{ $user->name }}</strong>
                                @if($user->hasRole('admin'))
                                    <span class="badge badge-danger ml-2">Admin</span>
                                @endif
                            </td>
                            <td>
                                <a href="mailto:{{ $user->email }}" class="text-primary">
                                    <i class="fas fa-envelope mr-1"></i>{{ $user->email }}
                                </a>
                                @if($user->email_verified_at)
                                    <span class="badge badge-success ml-2">Vérifié</span>
                                @else
                                    <span class="badge badge-warning ml-2">Non vérifié</span>
                                @endif
                            </td>
                            <td>
                                @foreach($user->roles as $role)
                                    <span class="badge
                                        @if($role->name == 'admin') badge-danger
                                        @elseif($role->name == 'editor') badge-warning
                                        @elseif($role->name == 'partner') badge-info
                                        @elseif($role->name == 'sponsor') badge-primary
                                        @else badge-secondary @endif">
                                        {{ $role->name }}
                                    </span>
                                @endforeach
                                @if($user->roles->count() == 0)
                                    <span class="badge badge-light">Aucun rôle</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    @can('edit users')
                                    <a href="{{ route('users.edit', $user->id) }}"
                                       class="btn btn-outline-warning btn-sm"
                                       data-toggle="tooltip"
                                       title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @endcan

                                    <button type="button"
                                            class="btn btn-outline-info btn-sm"
                                            data-toggle="modal"
                                            data-target="#viewUser{{ $user->id }}"
                                            title="Voir détails">
                                        <i class="fas fa-eye"></i>
                                    </button>

                                    @can('delete users')
                                   <form action="{{ route('users.destroy', $user->id) }}"
      method="POST"
      class="d-inline">
    @csrf
    @method('DELETE')
    <button type="button"
            onclick="confirmDeleteUser(event, {{ $user->id }})"
            class="btn btn-outline-danger btn-sm"
            data-toggle="tooltip"
            title="Supprimer">
        <i class="fas fa-trash-alt"></i>
    </button>
</form>
                                    @endcan
                                </div>

                                <!-- Modal pour voir les détails -->
                                <div class="modal fade" id="viewUser{{ $user->id }}" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title">
                                                    <i class="fas fa-user-circle mr-2"></i>Détails de l'utilisateur
                                                </h5>
                                                <button type="button" class="close text-white" data-dismiss="modal">
                                                    <span>&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-4 text-center">
                                                        <i class="fas fa-user-circle fa-5x text-primary mb-3"></i>
                                                        <h5>{{ $user->name }}</h5>
                                                        @if($user->hasRole('admin'))
                                                            <span class="badge badge-danger">Administrateur</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-8">
                                                        <p><strong>ID :</strong> {{ $user->id }}</p>
                                                        <p><strong>Email :</strong> {{ $user->email }}</p>
                                                        <p>
                                                            <strong>Email vérifié :</strong>
                                                            @if($user->email_verified_at)
                                                                <span class="badge badge-success">Oui</span>
                                                                ({{ $user->email_verified_at->format('d/m/Y H:i') }})
                                                            @else
                                                                <span class="badge badge-warning">Non</span>
                                                            @endif
                                                        </p>
                                                        <p><strong>Rôles :</strong></p>
                                                        <div>
                                                            @foreach($user->roles as $role)
                                                                <span class="badge badge-primary mr-1">{{ $role->name }}</span>
                                                            @endforeach
                                                            @if($user->roles->count() == 0)
                                                                <span class="badge badge-light">Aucun rôle</span>
                                                            @endif
                                                        </div>
                                                        <p class="mt-2"><strong>Créé le :</strong>
                                                            @php
                                                                $createdAt = $user->created_at;
                                                                if ($createdAt instanceof \Carbon\Carbon) {
                                                                    echo $createdAt->format('d/m/Y H:i');
                                                                } else {
                                                                    echo date('d/m/Y H:i', strtotime($createdAt));
                                                                }
                                                            @endphp
                                                        </p>
                                                        <p><strong>Dernière mise à jour :</strong>
                                                            @php
                                                                $updatedAt = $user->updated_at;
                                                                if ($updatedAt instanceof \Carbon\Carbon) {
                                                                    echo $updatedAt->format('d/m/Y H:i');
                                                                } else {
                                                                    echo date('d/m/Y H:i', strtotime($updatedAt));
                                                                }
                                                            @endphp
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                @can('edit users')
                                                <a href="{{ route('users.edit', $user->id) }}"
                                                   class="btn btn-warning">
                                                    <i class="fas fa-edit"></i> Modifier
                                                </a>
                                                @endcan
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Fermer
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">Aucun utilisateur trouvé</h5>
                                @can('create users')
                                <a href="{{ route('users.create') }}" class="btn btn-primary mt-2">
                                    <i class="fas fa-plus"></i> Ajouter le premier utilisateur
                                </a>
                                @endcan
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer clearfix">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted">
                    Affichage de <strong>{{ $users->firstItem() ?? 0 }}</strong> à
                    <strong>{{ $users->lastItem() ?? 0 }}</strong> sur
                    <strong>{{ $users->total() }}</strong> utilisateurs
                </div>
                <div class="pagination-wrapper">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .card {
            border-radius: 10px;
            border: none;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0,123,255,0.05);
            transform: scale(1.002);
            transition: transform 0.2s;
        }

        .thead-dark th {
            background: linear-gradient(45deg, #343a40, #495057);
            border: none;
            color: white;
            font-weight: 600;
        }

        .badge-pill {
            font-size: 0.85em;
            padding: 5px 10px;
        }

        .btn-outline-warning:hover {
            color: #212529;
        }

        .modal-content {
            border-radius: 10px;
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .modal-header {
            border-radius: 10px 10px 0 0;
        }

        .empty-state {
            padding: 40px 0;
        }

        .btn-group .btn {
            margin-right: 5px;
            border-radius: 5px;
        }

        .btn-group .btn:last-child {
            margin-right: 0;
        }

        /* Styles pour les rôles */
        .badge-danger {
            background-color: #dc3545;
        }
        .badge-warning {
            background-color: #ffc107;
            color: #212529;
        }
        .badge-info {
            background-color: #17a2b8;
        }
        .badge-primary {
            background-color: #007bff;
        }
        .badge-secondary {
            background-color: #6c757d;
        }
        .badge-light {
            background-color: #f8f9fa;
            color: #212529;
            border: 1px solid #dee2e6;
        }
        .badge-success {
            background-color: #28a745;
        }
    </style>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();

        // Animation pour les lignes du tableau
        $('table tbody tr').each(function(i) {
            $(this).delay(i * 100).animate({
                opacity: 1
            }, 200);
        });
    });

   function confirmDeleteUser(event, userId) {
    // Empêcher la soumission par défaut
    event.preventDefault();
    event.stopPropagation();

    Swal.fire({
        title: 'Êtes-vous sûr ?',
        text: "Cette action est irréversible ! L'utilisateur sera définitivement supprimé.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Oui, supprimer !',
        cancelButtonText: 'Annuler',
        buttonsStyling: true,
        customClass: {
            confirmButton: 'btn btn-danger mx-2',
            cancelButton: 'btn btn-secondary mx-2'
        },
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            // Trouver et soumettre le formulaire
            event.target.closest('form').submit();
        }
    });

    return false;
}

    // Recherche dans le tableau
    $('#searchInput').on('keyup', function() {
        const value = $(this).val().toLowerCase();
        $('#usersTable tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    function searchUsers() {
        const searchTerm = $('#searchInput').val().toLowerCase();
        $('#usersTable tbody tr').each(function() {
            const text = $(this).text().toLowerCase();
            if (text.includes(searchTerm)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }

    // Filtrer par rôle
    function filterByRole(role) {
        if (role === 'all') {
            $('#usersTable tbody tr').show();
        } else {
            $('#usersTable tbody tr').each(function() {
                const rolesText = $(this).find('td:nth-child(4)').text().toLowerCase();
                if (rolesText.includes(role.toLowerCase())) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }
    }
</script>

<!-- SweetAlert2 pour les notifications -->
@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Succès !',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false,
            toast: true,
            position: 'top-end'
        });
    </script>
@endif

@if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Erreur !',
            text: '{{ session('error') }}',
            timer: 4000,
            showConfirmButton: false,
            toast: true,
            position: 'top-end'
        });
    </script>
@endif

<script>
    // Dans les deux fichiers, remplacez la fonction de confirmation par :
$(document).ready(function() {
    // Délégation d'événement pour tous les boutons de suppression
    $(document).on('click', 'form button[type="submit"]', function(e) {
        // Vérifier si le bouton est dans un formulaire de suppression
        const form = $(this).closest('form');
        if (form.find('input[name="_method"][value="DELETE"]').length) {
            e.preventDefault();

            Swal.fire({
                title: 'Confirmer la suppression',
                text: "Êtes-vous sûr de vouloir supprimer cet élément ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Oui, supprimer',
                cancelButtonText: 'Annuler',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    });
});
</script>
@stop
