<?php

namespace App\Http\Controllers;

use App\Likes;
use App\Reply;
use Illuminate\Http\Request;

class LikesController extends Controller
{
   public function __construct()
   {
      // $this->middleware('JWT');
   }

    public function likeit(Reply $reply){
        $reply->likes()->create(['user_id'=>auth()->id()]);

        return response()->json('Liked',200);
   }
    public function unlikeit(Reply $reply){

        $reply->likes()->where('user_id',auth()->id())->first()->delete();
        return response()->json('Deleted',200);
    }
}
