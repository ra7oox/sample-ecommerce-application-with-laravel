@extends('master')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Détail du produit</h2>

    <div class="card shadow-sm">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ asset('storage/'.$product->image) }}" class="img-fluid rounded-start" alt="Image du produit">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text"><strong>Description :</strong> {{ $product->description }}</p>
                    <p class="card-text"><strong>Quantité :</strong> {{ $product->quantity }}</p>
                    <p class="card-text"><strong>Prix :</strong> {{ number_format($product->price, 2) }} €</p>
                    <p class="card-text"><strong>seller :</strong> {{ $product->user->name ?? "uknown" }} </p>


                    <div class="mt-4 d-flex gap-2">
                        @can('update-product',$product)
                            
                       
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Modifier</a>
                        @endcan
                        @can('delete-product')
                            
                        
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                        @endcan
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">Retour à la liste</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
