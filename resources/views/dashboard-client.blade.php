@extends('master')

@section('content')
<div class="container mt-5">
    <div class="p-4 bg-light rounded shadow-sm text-center">
        <h1 class="text-success fw-bold mb-4">Bienvenue sur votre espace client</h1>
        <p class="lead">Consultez vos produits préférés, suivez vos commandes et explorez nos nouveautés.</p>

        <div class="row mt-5">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Derniers produits</h5>
                        <p class="card-text">Découvrez les nouveautés ajoutées récemment.</p>
                        <a href="{{ route('last-products') }}" class="btn btn-outline-primary">Voir</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mt-3 mt-md-0">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Tous les produits</h5>
                        <p class="card-text">Parcourez l'ensemble de notre catalogue.</p>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-success">Explorer</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mt-3 mt-md-0">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Mon profil</h5>
                        <p class="card-text">Consultez et modifiez vos informations personnelles.</p>
                        <a href="#" class="btn btn-outline-secondary">Profil</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
