<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $user=auth()->user();
        $messages= Message::where('from_id',$user->id)
                            ->orwhere('to_id',$user->id)
                            ->get();
        return response()->json([
            'messages' => $messages
        ]);//
    }                    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function sendMessage(Request $request) {
        $request->validate([
            'contenu' => 'required',
            'to_id' => 'required'
        ]);
        
        $from= auth()->user()->id;
        $to_id = $request->to_id;
        $contenu=$request->contenu;
        if($from == $to_id){
            return response([
                'success' => false,
                'message' => "You cant send any messages to you yourself!"
            ], 503);
        }
        if(((auth()->user()->condidat->id == $request->offre->user_accept)||auth()->user()->entreprise->id==$request->offre->entreprise_id)){
        $message = new Message;
        $message->from_id = $from;
        $message->contenu = $contenu;
        $message->to_id = $to_id;
        $message->save();
        return response([
            'success' => true,
            'message'=> 'message successfully sent!',
            'data'=> $message
        ], 200);
    }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMessageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMessageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMessageRequest  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMessageRequest $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message=Message::find($id);
        $message->delete();
        return response()->json(['message' => 'message Deleted']);//
    }
}
