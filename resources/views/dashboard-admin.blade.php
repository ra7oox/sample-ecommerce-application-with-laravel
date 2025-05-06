@extends('master')

@section('content')
<div class="container mt-5">
    <div class="p-4 bg-white rounded shadow-sm text-center">
        <h1 class="mb-4 text-primary fw-bold">Tableau de Bord Administrateur</h1>
        <p class="lead">Bienvenue sur votre espace d'administration. Gérez vos produits, catégories et utilisateurs ici.</p>

        <div class="row mt-5">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Produits</h5>
                        <p class="card-text">Consultez ou ajoutez de nouveaux produits.</p>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-primary">Voir les produits</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mt-3 mt-md-0">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Catégories</h5>
                        <p class="card-text">Gérez les catégories de produits.</p>
                        <a href="{{ route('categories.index') }}" class="btn btn-outline-success">Voir les catégories</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mt-3 mt-md-0">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Utilisateurs</h5>
                        <p class="card-text">Gérez les comptes utilisateurs (si applicable).</p>
                        <a href="{{route("users.index")}}" class="btn btn-outline-secondary">Voir les utilisateurs</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-3 mt-md-0">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Mes commandes</h5>
                        <a href="{{route("orders.index")}}" class="btn btn-outline-secondary">Tout les Commandes</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
