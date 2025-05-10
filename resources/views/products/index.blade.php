@extends('master')

@section('content')
<div class="container mt-5">

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">
            @if(Auth::user())
                {{ Auth::user()->account_type == "seller" ? 'Liste de mes produits' : 'Liste des produits' }}
            @endif
        </h4>
        @can('create-product')
            <a href="{{ route('products.create') }}" class="btn btn-success">Ajouter un produit</a>
        @endcan
    </div>

    <form class="d-flex mb-4" role="search" action="{{ route('products.search') }}" method="POST">
        @csrf
        <input class="form-control me-2" type="search" name="search" placeholder="Rechercher" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Rechercher</button>
    </form>
    @if(Auth::user())
        
    
    <!-- Filtres placés ici -->
    <div class="card mb-5">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Filtres</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('products.filter') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nom ou description</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Rechercher par nom ou description">
                </div>

                <div class="mb-3">
                    <label class="form-label">Catégories</label>
                    <div class="d-flex flex-wrap gap-3">
                        @foreach ($categories as $category)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="category_id" value="{{ $category->id }}" id="cat{{ $category->id }}">
                                <label class="form-check-label" for="cat{{ $category->id }}">
                                    {{ $category->category_name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="min_prix" class="form-label">Prix minimum</label>
                        <input type="number" name="min_prix" id="min_prix" class="form-control" placeholder="Ex: 10">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="max_prix" class="form-label">Prix maximum</label>
                        <input type="number" name="max_prix" id="max_prix" class="form-control" placeholder="Ex: 100">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100">Filtrer</button>
            </form>
        </div>
    </div>
    @endif
    @if ($products->isEmpty())
        <div class="alert alert-info">Aucun produit disponible.</div>
    @else
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($products as $product)
            <div class="col">
                <div class="card h-100 shadow-sm position-relative">
                    
                    {{-- Badge réduction --}}
                    @if ($product->special_price && $product->special_price < $product->price)
                        @php
                            $reduction = 100 - (($product->special_price / $product->price) * 100);
                        @endphp
                        <div class="position-absolute top-0 start-0 bg-danger text-white px-2 py-1 rounded-end">
                            -{{ round($reduction) }}%
                        </div>
                    @endif
    
                    <a href="{{ route('products.show', $product->id) }}">
                        <img src="{{ asset('storage/'.$product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                    </a>
    
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ Str::limit($product->description, 80) }}</p>
                        <p class="mb-1"><strong>Catégorie:</strong>
                            <a href="{{ route('categories.show', $product->category->id) }}" class="btn btn-sm btn-outline-success">{{ $product->category->category_name }}</a>
                        </p>
                        <p class="mb-1"><strong>Quantité:</strong> {{ $product->quantity }}</p>
    
                        {{-- Affichage du prix original et spécial si réduction --}}
                        <p class="mb-3">
                            <strong>Prix:</strong>
                            @if ($product->special_price && $product->special_price < $product->price)
                                <span class="text-muted text-decoration-line-through">{{ number_format($product->price, 2) }} dhs</span>
                                <span class="text-danger fw-bold ms-2">{{ number_format($product->special_price, 2) }} dhs</span>
                            @else
                                {{ number_format($product->price, 2) }} dhs
                            @endif
                        </p>
    
                        <div class="mt-auto">
                            @can('update-product', $product)
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm w-100 mb-1">Modifier</a>
                            @endcan
                            @can('create-order')
                                <form action="{{ route('orders.create') }}" method="GET">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="btn btn-success btn-sm w-100 mb-1">Commander</button>
                                </form>
                            @endcan
                            @can('create-favourite')
                                <a href="{{ route('favourites.add', $product->id) }}" class="btn btn-warning btn-sm w-100 mb-1">Ajouter au favoris</a>
                            @endcan
                            @can('delete-product',$product)
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm w-100">Supprimer</button>
                                </form>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    

        <div class="d-flex justify-content-center mt-4">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
