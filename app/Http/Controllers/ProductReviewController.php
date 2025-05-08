<?php

namespace App\Http\Controllers;

use App\Models\ProductList;
use App\Models\ProductReview;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize("show-review");
        $products_id = Auth::user()->products()->pluck('id');
        $reviews=ProductReview::whereIn("product_id",$products_id)->get();
        return view("reviews.index",compact("reviews"));
        
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
        $this->authorize("create-review");
        $request->validate([
            "client_id"=>'required',
            "product_id"=>'required',
            "review"=>"required|min:5",
        ]);
        ProductReview::create($request->all());
        $product=ProductList::findOrFail($request->product_id);
        $reviews=$product->reviews;
        return redirect()->route('products.show', $product->id)
                 ->with('success', 'Avis supprimé avec succès.');

    }

    /**
     * Display the specified resource.
     */
    public function show(ProductReview $productReview)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductReview $productReview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $request->validate([
            
            "review"=>"required",
        ]);
        $review=ProductReview::findOrFail($id);
        $review->update([
            "client_id"=>$review->client_id,
            "product_id"=>$review->product_id,
            "review"=>$request->review,
        ]);
       
        return redirect()->route('products.show', $review->product_id)
                 ->with('success', 'Avis modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $review=ProductReview::findOrFail($id);
        $this->authorize("delete-review",$review);
        $product=$review->product;
        $reviews=$product->reviews;

        $review->delete();
        return redirect()->route('products.show', $product->id)
                 ->with('success', 'Avis supprimé avec succès.');

        
    }
}
