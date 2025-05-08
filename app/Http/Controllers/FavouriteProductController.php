<?php

namespace App\Http\Controllers;

use App\Models\FavouriteProduct;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouriteProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize("show-favourites");
        $favourites=FavouriteProduct::where("client_id",Auth::id())->get();
        return view("favourites.index",compact("favourites"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(FavouriteProduct $favouriteProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FavouriteProduct $favouriteProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FavouriteProduct $favouriteProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $favourite=FavouriteProduct::findOrFail($id);
        $this->authorize("delete-favourites",$favourite);
        $favourite->delete();

    return redirect()->route('favourites.index')->with('success', 'Produit supprimer du favoris.');

    }
 

public function addFavourite($product_id)
{
    // Si l'utilisateur n'est pas connecté
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Veuillez vous connecter pour ajouter aux favoris.');
    }

    // Vérifie l'autorisation
    $this->authorize('create-favourites');

    $clientId = Auth::id();

    $check = FavouriteProduct::where('product_id', $product_id)
        ->where('client_id', $clientId)
        ->first();

    if ($check) {
        return redirect()->route('products.index')->with('error', 'Produit déjà ajouté aux favoris.');
    }

    FavouriteProduct::create([
        'product_id' => $product_id,
        'client_id' => $clientId,
    ]);

    return redirect()->route('favourites.index')->with('success', 'Produit ajouté aux favoris.');
}

}
