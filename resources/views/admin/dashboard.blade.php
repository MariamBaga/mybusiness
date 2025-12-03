@extends('adminlte::page')

@section('title', 'Tableau de bord')

@section('content_header')
    <h1>Tableau de bord MyBusiness</h1>
@stop

@section('content')

<div class="row">

    {{-- Articles --}}
    <div class="col-lg-3 col-6">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{ $stats['posts'] }}</h3>
                <p>Articles publiés</p>
            </div>
            <div class="icon">
                <i class="fas fa-newspaper"></i>
            </div>
            <a href="{{ route('posts.index') }}" class="small-box-footer">
                Gérer les articles <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    {{-- Produits --}}
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $stats['products'] }}</h3>
                <p>Produits marketplace</p>
            </div>
            <div class="icon">
                <i class="fas fa-box"></i>
            </div>
            <a href="{{ route('products.index') }}" class="small-box-footer">
                Gérer les produits <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    {{-- Partenaires --}}
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $stats['partners'] }}</h3>
                <p>Partenaires</p>
            </div>
            <div class="icon">
                <i class="fas fa-handshake"></i>
            </div>
            <a href="{{ route('partners.index') }}" class="small-box-footer">
                Gérer les partenaires <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    {{-- Publicités --}}
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $stats['ads'] }}</h3>
                <p>Publicités actives</p>
            </div>
            <div class="icon">
                <i class="fas fa-ad"></i>
            </div>
            <a href="{{ route('ads.index') }}" class="small-box-footer">
                Gérer les publicités <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    {{-- Documents --}}
    <div class="col-lg-3 col-6">
        <div class="small-box bg-secondary">
            <div class="inner">
                <h3>{{ $stats['documents'] }}</h3>
                <p>Documents en ligne</p>
            </div>
            <div class="icon">
                <i class="fas fa-file-download"></i>
            </div>
            <a href="{{ route('documents.index') }}" class="small-box-footer">
                Gérer les documents <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    {{-- Messages --}}
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $stats['messages'] }}</h3>
                <p>Messages reçus</p>
            </div>
            <div class="icon">
                <i class="fas fa-envelope"></i>
            </div>
            <a href="#" class="small-box-footer">
                Voir les messages <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    {{-- Tickets --}}
    <div class="col-lg-3 col-6">
        <div class="small-box bg-dark">
            <div class="inner">
                <h3>{{ $stats['tickets'] }}</h3>
                <p>Total des tickets</p>
            </div>
            <div class="icon">
                <i class="fas fa-ticket-alt"></i>
            </div>
            <a href="{{ route('tickets.index') }}" class="small-box-footer">
                Gérer les tickets <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    {{-- Tickets ouverts --}}
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $stats['tickets_open'] }}</h3>
                <p>Tickets ouverts</p>
            </div>
            <div class="icon">
                <i class="fas fa-folder-open"></i>
            </div>
            <a href="{{ route('tickets.index') }}" class="small-box-footer">
                Voir les tickets ouverts <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

</div>

@stop
