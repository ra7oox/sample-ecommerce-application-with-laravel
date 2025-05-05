@extends('master')

@section('content')
<div class="container mt-5">
    <div class="card shadow rounded">
        <div class="card-body text-center">
            <h1 class="card-title text-primary">Bienvenue sur le Dashboard Vendeur</h1>
            <p class="card-text text-muted">Gérez vos produits, consultez vos ventes et suivez vos performances.</p>
            <a href="{{ route('products.index') }}" class="btn btn-outline-primary mt-3">Gérer mes produits</a>
        </div>
    </div>
</div>
@endsection
