@extends("master")

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0"><i class="bi bi-cart-plus"></i> Créer une commande</h4>
        </div>
        <div class="card-body">

            {{-- Affichage des erreurs de validation --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Message d'erreur personnalisé (ex : stock insuffisant) --}}
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Message de succès (si besoin) --}}
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('orders.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label"><strong>Produit sélectionné :</strong></label>
                    <input type="text" class="form-control bg-light" value="{{ $product->name }}" disabled>
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                </div>

                <input type="hidden" name="client_id" value="{{ Auth::id() }}">

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="quantity" class="form-label">Quantité</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" min="1" required value="{{ old('quantity') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="payment_method" class="form-label">Méthode de paiement</label>
                        <select name="payment_method" id="payment_method" class="form-select" required>
                            <option value="">-- Choisir une méthode --</option>
                            <option value="Paypal" {{ old('payment_method') == 'Paypal' ? 'selected' : '' }}>PayPal</option>
                            <option value="Mastercard" {{ old('payment_method') == 'Mastercard' ? 'selected' : '' }}>Mastercard</option>
                            <option value="Stripe" {{ old('payment_method') == 'Stripe' ? 'selected' : '' }}>Stripe</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Adresse de livraison</label>
                    <input type="text" name="address" id="address" class="form-control" required value="{{ old('address') }}">
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success" name="add" value="commander">
                        <i class="bi bi-check2-circle"></i> Commander
                    </button>
                    <button type="submit" class="btn btn-primary" name="add" value="panier">
                        <i class="bi bi-cart-plus"></i> Ajouter au panier
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
