@extends('layouts.master')

@section('title', 'Mentions légales - MyBusiness')

@section('content')

<!-- Breadcrumb -->
<section class="ht-breadcrumb-area">
    @include('components.breadcrumb', [
        'title' => 'Mentions légales',
        'active' => 'Mentions légales'
    ])
</section>

<section class="section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                <h2>Mentions légales</h2>

                <p>
                    Le présent site web <strong>MyBusiness</strong> est édité par la société
                    <strong>ConnectiiX</strong>, spécialisée dans le développement de solutions
                    digitales pour les commerçants, entrepreneurs et PME en Afrique.
                </p>

                <h4>Éditeur du site</h4>
                <p>
                    <strong>Nom :</strong> ConnectiiX<br>
                    <strong>Produit :</strong> MyBusiness<br>
                    <strong>Email :</strong> contact@mybusiness.com
                </p>

                <h4>Hébergement</h4>
                <p>
                    Le site est hébergé sur une infrastructure cloud sécurisée conforme aux
                    standards internationaux (SSL, sauvegardes régulières).
                </p>

                <h4>Propriété intellectuelle</h4>
                <p>
                    Tous les contenus présents sur le site MyBusiness (textes, images, logos,
                    graphismes) sont protégés par le droit d’auteur.
                    Toute reproduction sans autorisation est interdite.
                </p>

                <h4>Responsabilité</h4>
                <p>
                    MyBusiness met tout en œuvre pour fournir des informations fiables et à jour,
                    mais ne saurait être tenu responsable d’éventuelles erreurs ou omissions.
                </p>

            </div>
        </div>
    </div>
</section>

@endsection
