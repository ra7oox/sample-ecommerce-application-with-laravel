<?php

namespace App\Http\Controllers;

use App\Mail\replyToMessage;
use App\Models\Contact;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize("show-contact");
        $messages=Contact::all();
        return view("contact.index",compact("messages"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize("create-contact");
        return view("contact.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            "user_id"=>"required",
            "message"=>"required|min:6",
        ]);
        Contact::create([
            "user_id"=>$request->user_id,
            "message"=>$request->message,
        ]);
        return back()->with("success","message envoyer avec success");
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        //
    }
    public function reply(Request $request){
        $this->authorize("reply-contact");
        
        
        Mail::to($request->user_email)->send(new replyToMessage($request->reply));
        $message=Contact::findOrFail($request->message_id);
        $message->delete();
        
        return redirect()->route("contact.index")->with("success","reponse envoie avec success");
    }
}
