<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use AuthorizesRequests;

    public function index()
    {
        $subcategories=Subcategory::all();
        return view("sous_categories.index",compact("subcategories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize("create-subcategory");
        $categories=Category::all();
        return view("sous_categories.create",compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize("create-subcategory");

        $request->validate([
            "category_id"=>"required",
            "subcategory_name"=>"required",
        ]);
        Subcategory::create($request->all());
        return redirect()->route("subcategories.index")->with("success","sous categorie crée par success");
    }

    /**
     * Display the specified resource.
     */
    public function show(Subcategory $subcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $this->authorize("update-subcategory");

        $subcategory=Subcategory::findOrFail($id);
        $categories=Category::all();

        return view("sous_categories.edit",compact("subcategory","categories"));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->authorize("update-subcategory");

        $subcategory=Subcategory::findOrFail($id);
        $request->validate([
            "category_id"=>"required",
            "subcategory_name"=>"required",
        ]);
        $subcategory->update([
            "category_id"=>$request->category_id,
            "subcategory_name"=>$request->subcategory_name
        ]);
        return redirect()->route("subcategories.index")->with("success","sous categorie modifié par success");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $this->authorize("delete-subcategory");

        $subcategory=Subcategory::findOrFail($id);
        $subcategory->delete();
        return redirect()->route("subcategories.index")->with("success","sous categorie supprimer par success");


    }
}
