<?php

namespace App\Http\Controllers;

use App\Jobs\SendMessages;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MessageController extends Controller
{
    public function index(){
        $sms = Message::all();
        return view('index', compact('sms'));
    }
    public function  sendMessage(Request $request)
    {
        //validation of request to send
        $this->validate($request, [
            'from' => 'required|string|max:255',
            'phone' => 'required',
            'message' => 'required',
        ]);
        //Save the message in the database while sending it up.
        $message = new Message();
        $message->from = $request->from;
        $message->phone = $request->phone;
        $message->message = $request->message;
        $message->save();
       
        //queue to dispatch the message
        $this->dispatch(new SendMessages($request->all()));
        return response()->json([
            'status' => 'success',
            'message' => 'Processing message to be sent',
        ]);
    }


}
