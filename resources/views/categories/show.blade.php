@extends('master')

@section('content')
    <div class="container my-4">
        <h1>Category: {{ $category->category_name }}</h1>
        <a href="{{ route('products.index') }}" class="btn btn-primary mb-3">Go Back</a>

        <table class="table table-hover table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#ID</th>
                    <th scope="col">Name</th>
                    @can('update-product')
                    <th scope="col">Update Product</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        @can('update-product')
                            
                       
                        <td class="text-center">
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Update</a>
                        </td>
                        @endcan
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Aucun produit.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <style>
        /* Personnalisation des boutons "Update" */
.btn-warning {
    background-color: #f39c12; /* Couleur orange */
    border-color: #e67e22;
}

.btn-warning:hover {
    background-color: #e67e22;
    border-color: #d35400;
}

/* Personnalisation des en-têtes du tableau */
.table-dark th {
    background-color: #34495e;
    color: white;
}

/* Personnalisation des lignes du tableau */
.table-hover tbody tr:hover {
    background-color: #ecf0f1;
}

    </style>
@endsection
