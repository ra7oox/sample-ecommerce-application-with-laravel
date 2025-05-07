@extends('master')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold text-primary">Liste des sous catégories</h1>
        @can("create-subcategory")
        <a href="{{ route('subcategories.create') }}" class="btn btn-success">Ajouter une sous catégorie</a>
        @endcan
    </div>

    {{-- Message de succès --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif

    {{-- Aucune catégorie --}}
    @if ($subcategories->isEmpty())
        <div class="alert alert-info text-center">Aucune sous catégorie trouvée.</div>
    @else
        <div class="row">
            @foreach ($subcategories as $subcategory)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $subcategory->subcategory_name }}</h5>
                            <p class="card-text">category: {{ $subcategory->category->category_name }}</p>
                            <p class="card-text">ID: {{ $subcategory->id }}</p>

                            <div class="d-flex justify-content-between align-items-center mt-3">
                                
                                <a href="{{ route('subcategories.show', $subcategory->id) }}" class="btn btn-outline-primary btn-sm">produits</a>
                                @can('update-subcategory')
                                    
                                
                                <a href="{{ route('subcategories.edit', $subcategory->id) }}" class="btn btn-outline-success btn-sm">Modifier</a>
                                @endcan
                                @can('delete-subcategory')
                                
                                <form action="{{ route('subcategories.destroy', $subcategory->id) }}" method="POST" class="d-inline" 
                                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                </form>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination (si applicable) --}}
        {{-- <div class="mt-4 d-flex justify-content-center">
            {{ $categories->links() }}
        </div> --}}
    @endif
</div>
@endsection
