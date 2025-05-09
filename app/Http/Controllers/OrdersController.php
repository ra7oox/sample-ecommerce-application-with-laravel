<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\ProductCart;
use App\Models\ProductList;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use AuthorizesRequests;

    public function index()
    {
        if(Auth::user()->account_type=="admin"){
            $orders=Orders::all();
        }elseif(Auth::user()->account_type=="client"){
            $user=Auth::user();
            $orders=$user->orders;
        }elseif(Auth::user()->account_type == "seller") {
            $user = Auth::user();
            $products = ProductList::where("seller_id", $user->id)->pluck('id'); // on récupère seulement les IDs
        
            $orders = Orders::whereIn("product_id", $products)->get();
        }
        
        

        return view("orders.index",compact("orders"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $this->authorize("create-order");
        $product=ProductList::findOrFail($request->product_id);
        return view("orders.create",compact("product"));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize("create-order");
    
        $request->validate([
            "product_id" => "required|exists:product_lists,id",
            "client_id" => "required|exists:users,id",
            "quantity" => "required|integer|min:1",
            "payment_method" => "required|string",
            "address" => "required|string",
        ]);
    
        $product = ProductList::findOrFail($request->product_id);
    
        if ($request->quantity > $product->quantity) {
            return back()->with("error", "Stock insuffisant pour cette commande.");
        }
        if($request->add=="panier"){
            $client=User::findOrFail($request->client_id);
            $product_exist=ProductCart::where("client_id",$request->client_id)
            ->where("product_id",$request->product_id)->first();
            if($product_exist){
                $product_exist->update([
                    "quantity"=>$product_exist->quantity+$request->quantity,
                ]);
            }else{
                ProductCart::create([
                    'product_id' => $request->product_id,
                    'client_id' => $request->client_id,
                    'quantity' => $request->quantity,
                    'paiment_method' => $request->payment_method,
                    'address' => $request->address,
                ]);
            }
           
        return redirect()->route("products.index")->with("success", "produit ajouter au panier avec success");

        }elseif($request->add=="commander"){
            Orders::create([
                'product_id' => $request->product_id,
                'client_id' => $request->client_id,
                'quantity' => $request->quantity,
                'status' => 'pending', // ou "en attente"
                'payment_method' => $request->payment_method,
                'address' => $request->address,
            ]);
             // Soustraire la quantité commandée
        $product->update([
            'quantity' => $product->quantity - $request->quantity
        ]);
        $cart=ProductCart::where("client_id",$request->client_id)
        ->where("product_id",$request->product_id)->first();
        $cart->delete();
        }
        
       
    
        return redirect()->route("products.index")->with("success", "Votre commande a été passée avec succès.");
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Orders $orders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Orders $orders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Orders $orders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Orders $orders)
    {
        //
    }
    public function updateStatus(Orders $order)
{
    $this->authorize("gerer-order");

    $nextStatus = match ($order->status) {
        'pending' => 'processus',
        'processus' => 'complete',
        default => $order->status,
    };

    $order->update(['status' => $nextStatus]);

    return back()->with('success', 'Le statut de la commande a été mis à jour.');
}

public function cancel(Orders $order)
{
    $this->authorize("gerer-order");
    $order->update(['status' => 'cancelled']);
    $order->delete();
    return back()->with('success', 'La commande a été annulée.');
}

}
