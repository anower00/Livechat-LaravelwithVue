<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Message;
use App\Events\NewMessage;

class ContactsController extends Controller
{
    public function get()
    {
        $contacts  = User::all();

        return response()->json($contacts);
    }

    public function getMessagesFor($id)
    {
        $messages = Message::where('from',$id)->orWhere('to',$id)->get();

        return response()->json($messages);
    }

    public function send(Request $request)
    {
        $message = Message::create([
            'from' => auth()->id(),
            'to' => $request->contact_id,
            'text' => $request->text
        ]);

        return response()->json($message);
    }

    // public function send(Request $request)
    // {
    //     // $message = Message::create([
    //     //     'from' => auth()->user()->id(),
    //     //     'to' => $request->contact_id,
    //     //     'text' => $request->text
    //     // ]);
    //         dd($request);
    //     $user = auth()->user()->id();

    //     dd($user);

    //     $message = new Message();
    //     $message->from = $user;
    //     $message->to = $request->contact_id;
    //     $message->text= $request->text;

    //     dd($message);

    //     return response()->json($message);
    // }
}
