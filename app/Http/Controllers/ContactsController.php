<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Message;
use Illuminate\Support\Facades\Auth;
use App\Events\newMessage;

class ContactsController extends Controller
{
    public function index(){
        $contacts=User::where('id','<>',Auth::id())->get();
        return response()->json($contacts);
    }
    public function getMessages($id){
        $messages=\DB::table('messages')->where(function($query) use($id){
            $query->where('from',Auth::id())->where('to',$id);
        })->orWhere(function($query) use($id){
            $query->where('from',$id)->where('to',Auth::id());
        })->get();
        return response()->json($messages);
    }
    public function storeMessage(Request $req){
        $message = Message::create([
            'text'=>$req->text,
            'from'=>Auth::id(),
            'to'=>$req->to
        ]);
        broadcast(new newMessage($message));
        return response()->json($message);
    }
}
