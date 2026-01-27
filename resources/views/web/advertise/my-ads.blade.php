@extends('layouts.master')

@section('title', 'Mes Publicités - MyBusiness')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-chart-line me-2"></i>
                        Mes Statistiques Publicitaires
                    </h4>
                </div>

                <div class="card-body">
                    @if($ads->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Titre</th>
                                    <th>Emplacement</th>
                                    <th>Vues</th>
                                    <th>Clics</th>
                                    <th>CTR</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ads as $ad)
                                <tr>
                                    <td>{{ $ad->title }}</td>
                                    <td>
                                        <span class="badge bg-info">{{ $ad->placement }}</span>
                                    </td>
                                    <td>{{ $ad->views }}</td>
                                    <td>{{ $ad->clicks }}</td>
                                    <td>
                                        @if($ad->views > 0)
                                        <span class="badge {{ $ad->ctr > 2 ? 'bg-success' : ($ad->ctr > 0.5 ? 'bg-warning' : 'bg-danger') }}">
                                            {{ number_format($ad->ctr, 2) }}%
                                        </span>
                                        @else
                                        <span class="badge bg-secondary">0%</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($ad->isActive())
                                        <span class="badge bg-success">Active</span>
                                        @else
                                        <span class="badge bg-danger">Expirée</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('advertise.ad-stats', $ad) }}"
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-chart-bar"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-5">
                        <i class="fas fa-ad fa-4x text-muted mb-3"></i>
                        <h4 class="text-muted">Aucune publicité trouvée</h4>
                        <p class="text-muted">Créez votre première publicité !</p>
                        <a href="{{ route('advertise.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Créer une publicité
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
