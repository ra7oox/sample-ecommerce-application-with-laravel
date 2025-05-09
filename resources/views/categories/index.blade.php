@extends('master')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold text-primary">📂 Liste des Catégories</h1>
        <a href="{{ route('categories.create') }}" class="btn btn-success">
            ➕ Ajouter une catégorie
        </a>
    </div>

    {{-- Message de succès --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif

    {{-- Aucune catégorie --}}
    @if ($categories->isEmpty())
        <div class="alert alert-info text-center">Aucune catégorie trouvée.</div>
    @else
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm border-0">
                        <a href="{{ route('categories.show', $category->id) }}">
                            <img src="{{ asset('storage/'.$category->category_image) }}" 
                                 class="card-img-top img-fluid" 
                                 alt="Image de la catégorie {{ $category->category_name }}" 
                                 style="height: 200px; object-fit: cover;">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">{{ $category->category_name }}</h5>
                            {{-- <p class="card-text text-muted">ID: {{ $category->id }}</p> --}}
                        </div>
                        <div class="card-footer bg-white border-top-0 d-flex justify-content-between">
                            @can('update-category')
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-outline-success btn-sm">
                                    ✏️ Modifier
                                </a>
                            @endcan

                            @can('delete-category')
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">🗑️ Supprimer</button>
                                </form>
                            @endcan
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination (décommenter si nécessaire) --}}
        {{-- <div class="mt-4 d-flex justify-content-center">
            {{ $categories->links() }}
        </div> --}}
    @endif
</div>
@endsection
