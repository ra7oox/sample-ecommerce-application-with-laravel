<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ProductList;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class ProductListController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
    
            if ($user->account_type == "admin") {
                $products = ProductList::paginate(3);
            } elseif ($user->account_type == "seller") {
                $products = $user->products()->paginate(3); // Produits du client
            } else {
                $products = ProductList::paginate(3);
            }
        } else {
            // Utilisateur non connecté → on affiche tous les produits
            $products = ProductList::paginate(3);
        }
    
        return view("products.index", compact("products"));
    }
    
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize("create-product");
        $categories=Category::all();
        $subcategories=Subcategory::all();
        return view("products.create",compact("categories","subcategories"));
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
            "category_id"=>"required",
            "subcategory_id"=>"required",
            
        ]);
        // Validation (à adapter si besoin)
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'quantity' => 'required|integer|min:0',
        'image' => 'required|image|mimes:jpg,jpeg,png',
        'price' => 'required|numeric|min:0',
        'category_id' => 'required|exists:categories,id',
    ]);

    // Détermination du vendeur
    $seller_id = Auth::user()->account_type === 'seller' ? Auth::id() : 0;

    // Création du produit
    ProductList::create([
        'name' => $request->name,
        'description' => $request->description,
        'quantity' => $request->quantity,
        'image' => $request->file('image')->store('product_images', 'public'),
        'price' => $request->price,
        'category_id' => $request->category_id,
        'seller_id' => $seller_id,
        'subcategory_id'=>$request->subcategory_id,
    ]);
        return redirect()->route("products.index")->with("success","product added with success");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = ProductList::findOrFail($id);
        $reviews=$product->reviews;
        return view("products.show",compact("product","reviews"));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $product=ProductList::findOrFail($id);
        $this->authorize("update-product",$product);
        $subcategories=Subcategory::all();


        $categories=DB::table("categories")->get();
        return view("products.edit",compact("product","categories","subcategories"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
       

        $product = ProductList::findOrFail($id);
        $this->authorize("update-product",$product);
        
        // Validation avec image facultative
        $request->validate([
            "name" => 'required',
            "description" => 'required|min:6',
            "quantity" => 'required|integer|min:0',
            "price" => 'required|numeric|min:0',
            "category_id"=>'required',
            "subcategory_id"=>'required',

            "image" => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // max 2MB
        ]);
    
        $data = $request->only(['name', 'description', 'quantity', 'price','category_id','subcategory_id']);
    
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
        $products = ProductList::where('name', 'like', '%' . $request->search . '%')->paginate(3);
        return view("products.index",compact("products"));

    }
}
