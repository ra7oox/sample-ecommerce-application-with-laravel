<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use AuthorizesRequests;

    public function index()
    {
        $categories=Category::all();
        return view("categories.index",compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize("create-category");
        return view("categories.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize("create-category");

        $request->validate([
            "category_name"=>"required|min:4",
        ]);
        Category::create([
            'category_name'=>$request->category_name,
        ]);
        return redirect()->route("categories.index")->with("success","categorie ajouté par success");
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $category=Category::findOrFail($id);
        $products=$category->products;
        return view("categories.show",compact("category","products"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $this->authorize("update-category");

        $category=Category::findOrFail($id);
        return view("categories.edit",compact("category"));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->authorize("update-category");

        $category=Category::findOrFail($id);
        $request->validate([
            "category_name"=>"required|min:4",
        ]);
        $category->update([
            "category_name"=>$request->category_name,
        ]);
        return redirect()->route("categories.index")->with("success","categorie modifié par success");


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $this->authorize("delete-category");

    $category = Category::findOrFail($id);

    // Supprimer tous les produits liés
    foreach ($category->products as $product) {
        $product->delete();
    }

    // Supprimer la catégorie
    $category->delete();

    return redirect()->route("categories.index")->with("success", "Catégorie supprimée avec succès");
}

}
