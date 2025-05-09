@extends('master')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-primary">🛒 Mon Panier</h2>

    {{-- Affichage des messages d'erreurs --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Message de succès --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Message d’erreur général --}}
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if($carts->isEmpty())
        <div class="alert alert-info">Votre panier est vide.</div>
    @else
        <div class="row g-4">
            @foreach ($carts as $cart)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('storage/'.$cart->product->image) }}" class="card-img-top" alt="Image du produit" style="height: 250px; object-fit: cover">
                        <div class="card-body">
                            <h5 class="card-title">{{ $cart->product->name }}</h5>
                            <p><strong>Quantité:</strong> {{ $cart->quantity }}</p>
                            <p><strong>Adresse:</strong> {{ $cart->address }}</p>
                            <p><strong>Paiement:</strong> {{ $cart->paiment_method }}</p>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center bg-light">
                            <form action="{{ route('orders.store') }}" method="POST" class="me-1">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $cart->product_id }}">
                                <input type="hidden" name="client_id" value="{{ Auth::id() }}">
                                <input type="hidden" name="quantity" value="{{ $cart->quantity }}">
                                <input type="hidden" name="payment_method" value="{{ $cart->paiment_method }}">
                                <input type="hidden" name="address" value="{{ $cart->address }}">
                                <button type="submit" name="add" value="commander" class="btn btn-sm btn-success">
                                    ✅ Commander
                                </button>
                            </form>

                            <form action="{{ route('carts.destroy', $cart->id) }}" method="POST" onsubmit="return confirm('Supprimer ce produit du panier ?')">
                                @csrf
                                @method("DELETE")
                                <button class="btn btn-sm btn-outline-danger" type="submit">🗑️ Supprimer</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
