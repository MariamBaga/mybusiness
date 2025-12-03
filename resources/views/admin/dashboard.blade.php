@extends('adminlte::page')

@section('title', 'Tableau de bord')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1><i class="fas fa-tachometer-alt mr-2"></i>Tableau de bord MyBusiness</h1>
        <span class="badge badge-info">{{ now()->format('d/m/Y H:i') }}</span>
    </div>
@stop

@section('content')
<div class="container-fluid">

    {{-- Widgets Statistiques --}}
    <div class="row">
        {{-- Tickets ouverts --}}
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="info-box bg-gradient-danger">
                <span class="info-box-icon"><i class="fas fa-exclamation-circle"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Tickets ouverts</span>
                    <span class="info-box-number">{{ $stats['tickets_open'] }}</span>
                    <div class="progress">
                        <div class="progress-bar" style="width: {{ $stats['tickets'] > 0 ? ($stats['tickets_open'] / $stats['tickets'] * 100) : 0 }}%"></div>
                    </div>
                    <span class="progress-description">
                        {{ $stats['tickets'] > 0 ? round($stats['tickets_open'] / $stats['tickets'] * 100, 1) : 0 }}% des tickets
                    </span>
                </div>
            </div>
        </div>

        {{-- Messages non lus --}}
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="info-box bg-gradient-info">
                <span class="info-box-icon"><i class="fas fa-envelope"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Messages non lus</span>
                    <span class="info-box-number">{{ $stats['messages'] }}</span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 70%"></div>
                    </div>
                    <span class="progress-description">
                        Nécessitent une attention
                    </span>
                </div>
            </div>
        </div>

        {{-- Produits actifs --}}
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="info-box bg-gradient-success">
                <span class="info-box-icon"><i class="fas fa-box"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Produits actifs</span>
                    <span class="info-box-number">{{ $chartData['products_by_status']['active'] }}</span>
                    <div class="progress">
                        <div class="progress-bar" style="width: {{ $stats['products'] > 0 ? ($chartData['products_by_status']['active'] / $stats['products'] * 100) : 0 }}%"></div>
                    </div>
                    <span class="progress-description">
                        Sur {{ $stats['products'] }} produits
                    </span>
                </div>
            </div>
        </div>

        {{-- Utilisateurs --}}
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="info-box bg-gradient-warning">
                <span class="info-box-icon"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Utilisateurs</span>
                    <span class="info-box-number">{{ $stats['users'] }}</span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 50%"></div>
                    </div>
                    <span class="progress-description">
                        Membres enregistrés
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- Graphiques et Statistiques Principales --}}
    <div class="row">
        {{-- Graphique des tickets --}}
        <div class="col-lg-8">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-line mr-1"></i>
                        Activité des tickets (30 derniers jours)
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="ticketsChart" height="250" style="height: 250px;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        {{-- Statistiques des tickets --}}
        <div class="col-lg-4">
            <div class="card card-danger card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-ticket-alt mr-1"></i>
                        Statut des tickets
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="text-center">
                                <h1 class="display-4 text-danger">{{ $chartData['tickets_by_status']['open'] }}</h1>
                                <span class="text-muted">Ouverts</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center">
                                <h1 class="display-4 text-success">{{ $chartData['tickets_by_status']['closed'] }}</h1>
                                <span class="text-muted">Fermés</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="d-flex justify-content-between mb-1">
                            <span>En cours</span>
                            <span>{{ $chartData['tickets_by_status']['in_progress'] }}</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" style="width: {{ $stats['tickets'] > 0 ? ($chartData['tickets_by_status']['in_progress'] / $stats['tickets'] * 100) : 0 }}%"></div>
                        </div>

                        <div class="d-flex justify-content-between mb-1 mt-3">
                            <span>En attente</span>
                            <span>{{ $chartData['tickets_by_status']['pending'] }}</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-info" style="width: {{ $stats['tickets'] > 0 ? ($chartData['tickets_by_status']['pending'] / $stats['tickets'] * 100) : 0 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Cartes de statistiques --}}
    <div class="row">
        @foreach([
            ['title' => 'Articles', 'count' => $stats['posts'], 'icon' => 'fas fa-newspaper', 'color' => 'primary', 'route' => 'posts.index'],
            ['title' => 'Produits', 'count' => $stats['products'], 'icon' => 'fas fa-box', 'color' => 'success', 'route' => 'products.index'],
            ['title' => 'Partenaires', 'count' => $stats['partners'], 'icon' => 'fas fa-handshake', 'color' => 'info', 'route' => 'partners.index'],
            ['title' => 'Publicités', 'count' => $stats['ads'], 'icon' => 'fas fa-ad', 'color' => 'warning', 'route' => 'ads.index'],
            ['title' => 'Documents', 'count' => $stats['documents'], 'icon' => 'fas fa-file-download', 'color' => 'secondary', 'route' => 'documents.index'],
            ['title' => 'Tickets', 'count' => $stats['tickets'], 'icon' => 'fas fa-ticket-alt', 'color' => 'dark', 'route' => 'tickets.index'],
        ] as $card)
        <div class="col-lg-4 col-md-6">
            <div class="card card-{{ $card['color'] }} card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{ $card['title'] }}</h3>
                    <div class="card-tools">
                        <span class="badge badge-{{ $card['color'] }}">{{ $card['count'] }}</span>
                    </div>
                </div>
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="{{ $card['icon'] }} fa-4x text-{{ $card['color'] }}"></i>
                    </div>
                    <h4 class="text-muted">Total: {{ $card['count'] }}</h4>
                </div>
                <div class="card-footer">
                    <a href="{{ route($card['route']) }}" class="btn btn-{{ $card['color'] }} btn-block">
                        <i class="fas fa-arrow-right mr-1"></i>Gérer
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Activités récentes et Tickets --}}
    <div class="row">
        {{-- Activités récentes --}}
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">
                        <i class="fas fa-history mr-1"></i>
                        Activités récentes
                    </h3>
                    <div class="card-tools">
                        <span class="badge badge-info">{{ count($chartData['recent_activities']) }} activités</span>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Description</th>
                                    <th>Utilisateur</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($chartData['recent_activities'] as $activity)
                                <tr>
                                    <td>
                                        <span class="badge badge-{{ $activity['color'] }}">
                                            <i class="{{ $activity['icon'] }}"></i>
                                            {{ ucfirst($activity['type']) }}
                                        </span>
                                    </td>
                                    <td>{{ $activity['description'] }}</td>
                                    <td>{{ $activity['user'] }}</td>
                                    <td>{{ $activity['time'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Derniers tickets --}}
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">
                        <i class="fas fa-ticket-alt mr-1"></i>
                        Derniers tickets
                    </h3>
                    <div class="card-tools">
                        <span class="badge badge-danger">{{ $chartData['latest_tickets']->count() }} nouveaux</span>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Sujet</th>
                                    <th>Utilisateur</th>
                                    <th>Date</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($chartData['latest_tickets'] as $ticket)
                                <tr>
                                    <td>#{{ $ticket->id }}</td>
                                    <td>
                                        <a href="{{ route('tickets.show', $ticket->id) }}">
                                            {{ Str::limit($ticket->subject, 30) }}
                                        </a>
                                    </td>
                                    <td>{{ $ticket->user->name ?? 'Anonyme' }}</td>
                                    <td>{{ $ticket->created_at->format('d/m H:i') }}</td>
                                    <td>
                                        @php
                                            $statusColors = [
                                                'open' => 'danger',
                                                'in_progress' => 'warning',
                                                'closed' => 'success',
                                                'pending' => 'info'
                                            ];
                                        @endphp
                                        <span class="badge badge-{{ $statusColors[$ticket->status] ?? 'secondary' }}">
                                            {{ $ticket->status }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@stop

@push('css')
<style>
    .info-box {
        box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
        border-radius: .5rem;
        margin-bottom: 1rem;
        min-height: 80px;
    }

    .info-box-icon {
        border-radius: .5rem 0 0 .5rem;
    }

    .card {
        box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
        margin-bottom: 1rem;
    }

    .card-outline {
        border-top: 3px solid;
    }

    .display-4 {
        font-size: 2.5rem;
        font-weight: 300;
        line-height: 1.2;
    }

    .table-responsive {
        border-radius: .25rem;
    }
</style>
@endpush

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
$(function () {
    'use strict';

    // Graphique des tickets
    var ticketsCtx = document.getElementById('ticketsChart').getContext('2d');
    var ticketsChart = new Chart(ticketsCtx, {
        type: 'line',
        data: {
            labels: @json($chartData['tickets_last_30_days']['labels']),
            datasets: [{
                label: 'Tickets créés',
                data: @json($chartData['tickets_last_30_days']['data']),
                backgroundColor: 'rgba(60, 141, 188, 0.1)',
                borderColor: '#3c8dbc',
                borderWidth: 2,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            }
        }
    });
});
</script>
@endpush
