@extends('master') {{-- Ou ton layout général --}}

@section('title', 'Accès refusé')

@section('content')
<div class="container text-center py-5">
    <h1 class="display-4 text-danger">403 - Accès refusé</h1>
    <p class="lead">Désolé, vous n'avez pas l'autorisation d'accéder à cette page.</p>
    <p class="text-muted">Si vous pensez que c'est une erreur, veuillez contacter l'administrateur du site.</p>
    
    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary mt-3">← Retour</a>
    <a href="{{ route('products.index') }}" class="btn btn-primary mt-3">Aller à l'accueil</a>
</div>
@endsection
