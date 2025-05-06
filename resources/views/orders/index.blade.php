@extends('master')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Liste des commandes</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($orders->isEmpty())
        <div class="alert alert-info">Aucune commande trouvée.</div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Produit</th>
                        <th>Client</th>
                        <th>Quantité</th>
                        <th>Status</th>
                        <th>Méthode de paiement</th>
                        <th>Adresse</th>
                        <th>Date</th>
                        @can('gerer-order')

                        <th>Actions</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->product->name }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $order->quantity }}</td>
                            <td>
                                <span class="badge bg-{{ $order->status == 'cancelled' ? 'danger' : ($order->status == 'completed' ? 'success' : 'warning') }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td>{{ $order->payment_method }}</td>
                            <td>{{ $order->address }}</td>
                            <td>{{ $order->created_at->format('d/m/Y') }}</td>
                            @can('gerer-order')
                                
                           
                            <td>
                                @if($order->status !== 'complete' && $order->status !== 'cancelled')
                                    <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-outline-primary mb-1">
                                            Passer au suivant
                                        </button>
                                    </form>

                                    <form action="{{ route('orders.cancel', $order->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            Annuler
                                        </button>
                                    </form>
                                @else
                                    <em>N/A</em>
                                @endif
                            </td>
                            @endcan
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
