<?php

namespace App\Http\Controllers;

use App\Mail\AccountMail;
use App\Mail\declinedAccount;
use App\Models\ApprovedAccount;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ApprovedAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(ApprovedAccount $approvedAccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ApprovedAccount $approvedAccount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ApprovedAccount $approvedAccount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ApprovedAccount $approvedAccount)
    {
        //
    }
    public function approve($id){
        $request=ApprovedAccount::findOrFail($id);
        User::create([
            "name"=>$request->user_email,
            "email"=>$request->user_email,
            "password"=>Hash::make($request->user_email),
            "account_type"=>"seller",
        ]);
        $request->update([
            "approved"=>true,
        ]);

        Mail::to($request->user_email)->send(new AccountMail($request->user_email));
        return redirect()->route('users.index')->with('success', "Compte client créé avec succès !");


    }
    public function decline($id){
        $request=ApprovedAccount::findOrFail($id);
        $request->delete();
        Mail::to($request->user_email)->send(new declinedAccount);
       
        return redirect()->route('users.index')->with('success', "Compte client refusé  !");
    }
}
