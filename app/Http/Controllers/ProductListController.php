<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ProductList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProductListController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products=ProductList::paginate(2);
        return view("products.index",compact("products"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize("create-product");
        $categories=Category::all();
        return view("products.create",compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize("create-product");

        $request->validate([
            "name"=>'required',
            "description"=>'required|min:6',
            "quantity"=>'required',
            "image"=>'required',
            "price"=>'required',
            
        ]);
        ProductList::create([
            "name"=>$request->name,
            "description"=>$request->description,
            "quantity"=>$request->quantity,
            "image"=>$request->file("image")->store("product_images","public"),
            "price"=>$request->price,
            "category_id"=>$request->category_id,
        ]);
        return redirect()->route("products.index")->with("success","product added with success");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = ProductList::findOrFail($id);
        return view("products.show",compact("product"));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->authorize("update-product");

        $product=ProductList::findOrFail($id);
        $categories=DB::table("categories")->get();
        return view("products.edit",compact("product","categories"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->authorize("update-product");

        $product = ProductList::findOrFail($id);
        
        // Validation avec image facultative
        $request->validate([
            "name" => 'required',
            "description" => 'required|min:6',
            "quantity" => 'required|integer|min:0',
            "price" => 'required|numeric|min:0',
            "category_id"=>'required',
            "image" => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // max 2MB
        ]);
    
        $data = $request->only(['name', 'description', 'quantity', 'price','category_id']);
    
        // Si une nouvelle image est envoyée
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('product_images', 'public');
        }
        $product->update($data);
    
        return redirect()->route('products.index')->with('success', 'Produit mis à jour avec succès.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->authorize("delete-product");
        
        $product = ProductList::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produit supprimé avec succès.');


    }
    public function search(Request $request){
        $request->validate([
            "search"=>"required|min:2",
        ]);
        $products = ProductList::where('name', 'like', '%' . $request->search . '%')->paginate(2);
        return view("products.index",compact("products"));

    }
}
