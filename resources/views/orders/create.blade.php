@extends("master")

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Créer une commande</h4>
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

            {{-- Affichage d'un message d'erreur personnalisé (ex : stock insuffisant) --}}
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('orders.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label"><strong>Produit :</strong></label>
                    <input type="text" class="form-control" value="{{ $product->name }}" disabled>
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                </div>

                <input type="hidden" name="client_id" value="{{ Auth::id() }}">

                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantité</label>
                    <input type="number" name="quantity" id="quantity" class="form-control" min="1" required value="{{ old('quantity') }}">
                </div>

                <div class="mb-3">
                    <label for="payment_method" class="form-label">Méthode de paiement</label>
                    <select name="payment_method" id="payment_method" class="form-select" required>
                        <option value="">-- Sélectionner une méthode --</option>
                        <option value="Paypal" {{ old('payment_method') == 'Paypal' ? 'selected' : '' }}>Paypal</option>
                        <option value="Mastercard" {{ old('payment_method') == 'Mastercard' ? 'selected' : '' }}>Mastercard</option>
                        <option value="Stripe" {{ old('payment_method') == 'Stripe' ? 'selected' : '' }}>Stripe</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Adresse de livraison</label>
                    <input type="text" name="address" id="address" class="form-control" required value="{{ old('address') }}">
                </div>

                <button type="submit" class="btn btn-success">Commander</button>
            </form>
        </div>
    </div>
</div>
@endsection
