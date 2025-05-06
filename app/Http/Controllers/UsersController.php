<?php

namespace App\Http\Controllers;

use App\Mail\AccountMail;
use App\Mail\AccountUpdated;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize("show-user");
        $users=User::all();
        return view("users.index",compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize("create-user");
        return view('users.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize("create-user");
    
        $validated = $request->validate([
            "name"  => "required|string|max:255",
            "email" => "required|email|unique:users,email",
        ]);
    
        // L'email sert de mot de passe initial
        $password = $validated['email'];
    
        // Création de l'utilisateur
        User::create([
            "name"         => $validated['name'],
            "email"        => $validated['email'],
            "password"     => Hash::make($password),
            "account_type" => "client",
        ]);
    
        // Envoi de l'email avec login/mot de passe
        Mail::to($validated['email'])->send(new AccountMail($password));
    
        return redirect()->route('users.index')->with('success', "Compte client créé avec succès !");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->authorize("show-user");

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $this->authorize("update-user");
        $user=User::findOrFail($id);
        return view("users.edit",compact("user"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $this->authorize("update-user");
        $user=User::findOrFail($id);
        $validated = $request->validate([
            "name"  => "required|string|max:255",
            "email" => "required|email",
        ]);
    
        // L'email sert de mot de passe initial
        $password = $validated['email'];
    
        // Création de l'utilisateur
        $user->update([
            "name"         => $validated['name'],
            "email"        => $validated['email'],
           
        ]);
    
        // Envoi de l'email avec login/mot de passe
        Mail::to($validated['email'])->send(new AccountUpdated("modifié"));
    
        return redirect()->route('users.index')->with('success', "Compte client créé avec succès !");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize("delete-user");
        $user=User::findOrFail($id);
        $user->delete();
        Mail::to($user->email)->send(new AccountUpdated("supprimé"));

        return redirect()->route('users.index')->with('success', "Compte client Supprimé avec succès !");
        
    }
    public function profile(){
        return view("users.profile");
    }
}
