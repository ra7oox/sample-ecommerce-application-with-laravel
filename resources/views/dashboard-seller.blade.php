@extends('master')

@section('content')
<div class="container mt-5">
    <div class="card shadow rounded">
        <div class="card-body text-center">
            <h1 class="card-title text-primary">Bienvenue sur le Dashboard Vendeur</h1>
            <p class="card-text text-muted">Gérez vos produits, consultez vos ventes, suivez vos performances et gérez votre profil.</p>

            <div class="d-flex flex-column flex-md-row justify-content-center gap-3 mt-4">
                <a href="{{ route('products.index') }}" class="btn btn-outline-primary">Gérer mes produits</a>
                <a href="{{ route('orders.index') }}" class="btn btn-outline-primary">Gérer mes commandes</a>
                <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary">Mon profil</a>
            </div>
        </div>
    </div>
</div>
@endsection
