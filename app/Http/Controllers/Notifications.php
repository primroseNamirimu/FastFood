<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Notifications extends Controller
{
    public function notify(Request $request){
        if ( $request->ajax()){
            $updated = 0;
      $notifications =    DB::table('notifications')->where('is_read','=','0')
          ->whereDay('created_at', now()->day)

          ->update(['is_read'=>1]);

      if($notifications > 0){
          return response()->json("success");

      } else {
          return response()->json("no updates", 200);

      }

        }


    }
}
