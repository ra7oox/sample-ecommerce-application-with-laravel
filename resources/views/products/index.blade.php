@extends('master')

@section('content')
<div class="container mt-5">

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">
            {{ Auth::user()->account_type == "seller" ? 'Liste de mes produits' : 'Liste des produits' }}
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

    @if ($products->isEmpty())
        <div class="alert alert-info">Aucun produit disponible.</div>
    @else
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($products as $product)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('storage/'.$product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ Str::limit($product->description, 80) }}</p>
                            <p class="mb-1"><strong>Catégorie:</strong> 
                                <a href="{{route('categories.show', $product->category->id)}}" class="btn btn-sm btn-outline-success">{{ $product->category->category_name }}</a>
                            </p>
                            <p class="mb-1"><strong>Quantité:</strong> {{ $product->quantity }}</p>
                            <p class="mb-3"><strong>Prix:</strong> {{ number_format($product->price, 2) }} €</p>

                            <div class="mt-auto">
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary btn-sm w-100 mb-1">Détail</a>
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
                                @can('delete-product')
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
