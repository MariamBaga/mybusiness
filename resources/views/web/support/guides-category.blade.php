@extends('layouts.master')

@section('title', 'Guides ' . $categoryName . ' - Support MyBusiness')

@section('content')
<div class="container py-5">
    <h1>Guides : {{ $categoryName }}</h1>
    <p>Cette page est en construction.</p>
    <a href="{{ route('support.guides') }}" class="btn btn-primary">
        Retour aux guides
    </a>
</div>
@endsection
