<?php

namespace App\Http\Controllers;

use App\Models\ProductCart;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductCartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize("show-cart");
        $carts=ProductCart::where("client_id",Auth::id())->get();
        return view("carts.index",compact("carts"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(ProductCart $productCart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductCart $productCart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductCart $productCart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cart=ProductCart::findOrFail($id);
        $this->authorize("delete-cart",$cart);

        $cart->delete();
        return redirect()->route("carts.index")->with("success", "produit supprimé du panier avec success");

    }
}
