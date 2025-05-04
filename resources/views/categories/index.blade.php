@extends('master')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold text-primary">Liste des catégories</h1>
        <a href="{{ route('categories.create') }}" class="btn btn-success">Ajouter une catégorie</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif

    @if ($categories->isEmpty())
        <div class="alert alert-info text-center">Aucune catégorie trouvée.</div>
    @else
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $category->category_name }}</h5>
                            <p class="card-text">ID: {{ $category->id }}</p>
                            <a href="{{ route('categories.show', $category->id) }}" class="btn btn-outline-primary btn-sm">Voir les produits</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
