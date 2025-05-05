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
        @if (Auth::user()->account_type=="seller")
        <h4 class="mb-0">Liste de mes produits</h4>

            
        @else
        <h4 class="mb-0">Liste des produits</h4>
            
        @endif
        @can('create-product')
            
       
        <a href="{{ route('products.create') }}" class="btn btn-success">Ajouter un produit</a>
        @endcan
    </div>

    <table class="table table-hover table-bordered align-middle">
        <thead class="table-dark">
            <tr>
                <th scope="col">#ID</th>
                <th scope="col">Nom</th>
                <th scope="col">Description</th>
                <th scope="col">category</th>

                <th scope="col">Quantité</th>
                <th scope="col">Image</th>
                <th scope="col">Prix</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ Str::limit($product->description, 60) }}</td>
                    <td><a href="{{route("categories.show",$product->category->id)}}" class="btn btn-success">{{ $product->category->category_name }}</a></td>

                    <td>{{ $product->quantity }}</td>
                    <td>
                        <img src="{{ asset('storage/'.$product->image) }}" alt="Image" class="img-thumbnail" style="max-width: 80px;">
                    </td>
                    <td>{{ number_format($product->price, 2) }} €</td>
                    <td class="d-flex gap-2">
                        @can('update-product')
                            
                       
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                        @endcan
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary btn-sm">detail</a>
                        @can('delete-product')
                            
                        
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" >Supprimer</button>
                        </form>
                        @endcan
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Aucun produit disponible.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-4">
        {{ $products->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
