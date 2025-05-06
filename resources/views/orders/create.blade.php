@extends("master")

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Créer une commande</h4>
        </div>
        <div class="card-body">
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
                    <input type="number" name="quantity" id="quantity" class="form-control" min="1" required>
                </div>

                <div class="mb-3">
                    <label for="payment_method" class="form-label">Méthode de paiement</label>
                    <select name="payment_method" id="payment_method" class="form-select" required>
                        <option value="">-- Sélectionner une méthode --</option>
                        <option value="Paypal">Paypal</option>
                        <option value="Mastercard">Mastercard</option>
                        <option value="Stripe">Stripe</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Adresse de livraison</label>
                    <input type="text" name="address" id="address" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success">Commander</button>
            </form>
        </div>
    </div>
</div>
@endsection
