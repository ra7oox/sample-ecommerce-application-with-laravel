@extends('master')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Derniers Produits</h1>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($products->isEmpty())
        <div class="alert alert-info text-center">Aucun produit disponible.</div>
    @else
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($products as $product)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('storage/'.$product->image) }}" class="card-img-top" alt="Image du produit" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ Str::limit($product->description, 80) }}</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Quantité :</strong> {{ $product->quantity }}</li>
                            <li class="list-group-item"><strong>Prix :</strong> {{ number_format($product->price, 2) }} DHS</li>
                            <li class="list-group-item"><strong>Ajouté le :</strong> {{ $product->created_at->format('d/m/Y') }}</li>
                        </ul>
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <a href="{{ route('categories.show', $product->category->id) }}" class="btn btn-sm btn-outline-primary">
                                {{ $product->category->category_name }}
                            </a>
                            @can('update-product',$product)
                                
                            
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-secondary">Éditer</a>
                            @endcan
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
