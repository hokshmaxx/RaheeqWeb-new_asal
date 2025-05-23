<?php

namespace App\Http\Controllers\SubAdmin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Auth;
use Image;

use App\Models\Chat;
use App\User;
use App\Models\Token;

class ChatController extends Controller
{

    public function chat()
    {
        
       
        Chat::query()->where('user_id', auth()->guard('subadmin')->user()->id)->where('sender',1)->update(['read' => 1]);
        $chats = Chat::where('user_id',auth()->guard('subadmin')->user()->id)->get();
        return view('subadmin.chatting.message', ['chats' => $chats]);
        
    }

    public function new_message(Request $request)
    {
        $chat = New Chat;
        $chat->user_id = auth()->guard('subadmin')->user()->id;
        $chat->message = $request->message;
        $chat->sender = 0;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . ".png";
            Image::make($file)->resize(1000, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save("uploads/chats/$name");
            $chat->message = $name;
            $chat->type = 1;

        }else{
            $roles = [
            'response' => 'required',
            ];
        $this->validate($request, $roles);
            $chat->message = $request->response;
            $chat->type = 0;
        }
        $chat->save();

        return redirect()->back();
        
    }
   



}